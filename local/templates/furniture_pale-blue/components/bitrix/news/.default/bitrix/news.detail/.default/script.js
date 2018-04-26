	BX.ready(function(){

		function addID(id){
			if(text.hidden && id){
				text.innerHTML += id;
				text.hidden=false;
			}
		}

		function sendReport(){
			if(text.hidden)
				BX.ajax.get(url+'?report', addID);
		}
		
		if(ajax=='Y')
			BX.bind(button, 'click', sendReport);
		else
			addID(reportID);
	});