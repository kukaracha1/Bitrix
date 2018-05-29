

BX.ready(function(){
   BX.bindDelegate(
      document.body, 'click', {className: 'activation' },
      function(e){
         if(!e) {
            e = window.event;
         }
         // alert('@');
		 // console.log(BX(this));
		 console.log(this.dataset);
		 activation(this);
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
			// console.log(data);
			
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


