BX.ready(function(){
	// jquery part
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
		 console.log(this.dataset);
		 // prevent multiple clicks
		 BX.adjust(BX(this), {props: {enable: 'disabled'}});
		 // call the action
		 activation(this);
		 // activate button
         BX.adjust(BX(this), {props: {enable: 'enabled'}});
		 return BX.PreventDefault(e);
      }
   );
});


function activation(button){
	BX.ajax({   
		url: 'deactivate.php',
		data: {
			id: button.dataset['id']
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

		},
		onfailure: function(state , data){
			console.log("fail");
			console.log(state);
			console.log(data);
		}
	});
}


