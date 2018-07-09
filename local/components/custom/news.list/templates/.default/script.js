
	var deactivatePath,	rel_code, rel_prop;
	
	BX.ready(function(){
	// jquery part
	//fill update parameters
	var form = $('.partners-list');
	deactivatePath = form.data('path') + '/deactivate.php';
	rel_code = form.data('rel-code');
	rel_prop = form.data('rel-prop');

	// set the selected partner as a start value of 'select'
	var sel = $('.partners-list__select'),
		value = $('.partners-list__select .selected').val();
	$(sel).val(value);
	
	//bx part
   BX.bindDelegate(
      document.body, 'click', {className: 'activation' },
      function(e){
         if(!e) {
            e = window.event;
         }
		 
		 if(this.enable || this.enable == undefined) {
				 
			 // prevent multiple clicks
			BX.adjust(BX(this), {props: {enable: false}});
			BX.adjust(BX(this), {props: {value: '...'}});

			 // call the action
			 activation(this);
		 }
		 return BX.PreventDefault(e);
      }
   );
});


function activation(button){

	BX.ajax({   
		url: deactivatePath,
		data: {
			id: button.dataset['id'],
			REL_BLOCK_CODE: rel_code,
			REL_BLOCK_PROP: rel_prop
		},
		method: 'POST',
		dataType: 'json',
		timeout: 30,
		async: true,
		processData: true,
		scriptsRunFirst: true,
		emulateOnload: true,
		start: true,
		cache: false,
		onsuccess: function(data){
			console.log("success");
			
			BX.toggleClass(BX(button), "btn-success");
			BX.toggleClass(BX(button), "btn-danger");
			
			if ( data['active'] == 'Y')
				BX.adjust(BX(button), {props: {value: 'Deactivate'}});
			else
				BX.adjust(BX(button), {props: {value: 'Activate'}});
			
			// activate button
			BX.adjust(BX(button), {props: {enable: true}});
		},
		onfailure: function(state , data){
			console.log("fail");
			console.log(state);
			console.log(data);
		}
	});
}

