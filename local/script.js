		var current_input,
			imgWidth,
			imgHeight,
			circleWrap,
			picture,
			oldData = [],
			new_data = [],
			clicking = false;

		// create circles for existing goods at start
		function initPoints() {

			// set the start values (for 'return/cancel' button)
			$('.old_data input').each(function (index, item) {
				oldData[item.id] = {
					'x': item.dataset['x'],
					'y': item.dataset['y'],
					'id': item.dataset['id']
				}
			})

			// save picture size
			imgWidth = $('.set_picture').width();
			imgHeight = $('.set_picture').height();

			// block where we will draw the circles
			picture = $('.set_picture_circle--container');

			// dubliczte size of picture to circles' wrapper 
			circleWrap = $('.set_picture_circle--container');
			$(circleWrap).width(imgWidth).height(imgHeight);

			// select all inputs
			$('#tr_PROPERTY_54 input[type=text]').addClass('set_input');

			$('.set_input').each(function (index, item) {

				if (item.value != "") {

					// get field id					
					var id = setId(item);

					if (oldData['old-' + id] != undefined) {
						// find coord and draw the circle if its specified
						var coordX = oldData['old-' + id]['x'],
							coordY = oldData['old-' + id]['y'];

						// we have old data
						// draw circle
						createCircle(item);
						// move it to the right position
						updateView({
							'offsetY': coordY * imgHeight,
							'offsetX': coordX * imgWidth,
							'target': picture[0]
						}, item);
					}

				}
			})

		}

		function createCircle(item) {
			var circle = $('<div/>', {
				text: item.value,
				class: 'set_picture__circle circle-' + curId(item),

			})

			$(circleWrap).append($(circle));
		}

		function inputSelector(prop = '', escape = false) {
			result = 'PROP[POINTS][' + curId() + '][' + prop + ']';
			return (escape) ? escapeSelector(result) : result;
		}

		function setId(item = current_input) {
			var id = item.id; //	PROP[54][2100]
			id = id.substr(id.lastIndexOf('[')); //	[2100]
			id = id.substr(1, id.lastIndexOf(']') - 1) //	2100

			// current_input.dataid = id;

			$(item).attr('data-id', id);
			return id;

		}

		function curId(item = current_input) {
			return $(item).attr('data-id');

			//return current_input.dataid;

		}

		function escapeSelector(selector) {
			return selector
				.replace(/\[/g, '\\[')
				.replace(/\]/g, '\\]');
		}

		function updateView(e, item = current_input) {
			console.log(e);
			var circle = $('.circle-' + curId(item));

			if (circle.length == 0) {
				createCircle(item);
				circle = $('.circle-' + curId(item))
			}

			// estimate the center of click
			circle_width = $(circle).width();
			circle_height = $(circle).height();

			circle_centerX = circle_width / 2;
			circle_centerY = circle_height / 2;

			offsetX = (e.offsetX - circle_centerX);
			offsetY = (e.offsetY - circle_centerY);

			if (e.target != picture[0]) {
				// mouse in the circle
				// just move
				offsetX += $(circle).position()['left'];
				offsetY += $(circle).position()['top'];
				// should check if we can move
				if (offsetX < 0 || offsetY < 0 || offsetX + circle_width > imgWidth || offsetY + circle_height > imgHeight)
					return;
			}

			$(circle).css('left', offsetX + 'px');
			$(circle).css('top', offsetY + 'px');


			// get clicked point as percents of offsets from the image 
			offsetX = offsetX / imgWidth;
			offsetY = offsetY / imgHeight;

			// save COORD properties to the input (for PHP)
			$('.new_data #' + inputSelector('COORD-X', true)).val(offsetX);
			$('.new_data #' + inputSelector('COORD-Y', true)).val(offsetY);

		}

		$(function () {


			initPoints();



			// we will set the current good by clicking on it's input
			$('.set_input').click(function (e) {
				e.preventDefault();
				console.log(this.value);

				if (this.value != '')
					current_input = this;
				else
					current_input = undefined;
			});

			// when press mouse button over picture -> create/move circle at the point
			$(picture).mousedown(function (e) {
				if (current_input != undefined) {
					clicking = true; // set flag that we start move the circle



					if (new_data.indexOf(curId()) >= 0) {

						console.log(current_input.dataset);
						// we already have the circle, so just move it
					} else {
						// the new POINT -> 
						// add input fields with new coordinates x & y
						if (curId() == undefined)
							setId();

						if (oldData['old-' + curId()] == undefined) {
							// the new GOOD -> define id of it

							// mark that it's new one
							$('.new_data')
								.append($('<input/>', {
									type: 'hidden',
									name: inputSelector('OPTION'),
									id: inputSelector('OPTION'),
									value: 'NEW'
								}))
						} else {
							// write id of SET_GOOD record
							$('.new_data')
								.append($('<input/>', {
									type: 'hidden',
									name: inputSelector('ID'),
									id: inputSelector('ID'),
									value: $('.old_data [id=old-' + curId() + ']').attr('data-id')
								}));
						}


						$('.new_data')
							.append($('<input/>', {
								type: 'hidden',
								name: inputSelector('COORD-Y'),
								id: inputSelector('COORD-Y'),
							}))
							.append($('<input/>', {
								type: 'hidden',
								name: inputSelector('COORD-X'),
								id: inputSelector('COORD-X'),
							}));

						new_data.push(curId());

					}

					updateView(e);
				}

			});

			// release moving
			$(picture).mouseup(function (e) {
				e.preventDefault();
				clicking = false;
				// updateView(e);


			})

			// when move mouse -> change position of current circle(good)
			$(picture).mousemove(function (e) {
				e.preventDefault();
				if (!clicking)
					return;
				updateView(e);
			});

			// when save/apply changes -> create json file with goods' positions (for ...before_save.php)
			$('#save, #apply').click(function (e) {})
		});