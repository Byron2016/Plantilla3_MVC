
//V5

// $(document).ready(function(){
// 	alert('funciona jquery');
// });

$(document).ready(function() {                                 //V5
	$('#form1').validate({                                     //V5
		rules: {                                               //V5
			titulo: {                                          //V5
				required: true                                 //V5
			},                                                 //V5
			cuerpo: {                                          //V5
				required: true                                 //V5
			}                                                  //V5
		},                                                     //V5
		messages: {                                            //V5
			titulo: {                                          //V5
				required: "Debe introducir el titulo del post" //V5
			},                                                 //V5
			cuerpo: {                                          //V5
				required: "Debe introducir el cuerpo del post" //V5
			}                                                  //V5
		}
	});
});
