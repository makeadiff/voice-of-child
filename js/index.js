

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
// var temp=0;
// var cont=document.getElementById("soflow").value;


function form_validate(form){

	$.validator.addMethod("text_name",
		function(value, element) {
      return this.optional(element) || /^[a-zA-Z\s.]*$/i.test(value);
    }, "Name is invalid: Please enter a valid name.");

	$.validator.addMethod('phone',
		function(value, element) {
			return this.optional(element) || /^[0-9]*$/i.test(value);
		}, "Enter a valid phone number");

	$.validator.addMethod('reco_name',
		function(value, element) {
			return this.optional(element) || /^.+\s\/\s\d+$/i.test(value);
		}, "Enter a valid Volunteer Name");

	form.validate({
		rules:{
			user_name: {
				required: true,
				maxlength: 30,
				text_name: true
			},
			user_phone:{
				required: true,
				maxlength: 10,
				minlength: 10,
				phone: true
			},
			user_email:{
				required:true,
				email:true
			},
			recommendation1_name:{
				minlength: 10,
				reco_name: true
			},
			recommendation2_name:{
				minlength: 10,
				reco_name: true
			},
			recommendation3_name:{
				minlength: 10,
				reco_name: true
			},
		},
		messages: {
			user_name: {
				required: "Name required",
			},
		  user_phone: {
				required: "Enter a valid phone number",
				maxlength: "Enter a valid phone number",
				minlength: "Enter a valid phone number",
			},
			recommendation1_name: {
				minlength: "Enter a Valid Volunteer Name",
			},
			recommendation2_name: {
				minlength: "Enter a Valid Volunteer Name",
			},
			recommendation3_name: {
				minlength: "Enter a Valid Volunteer Name",
			}
		}
	});
}


$(".next").click(function(){

	var form = $("#msform");
	form_validate(form);

  if (form.valid() == true){
		if(animating) return false;
		animating = true;
		current_fs = $(this).parent();
		// next_fs = $(this).parent().next();
		if(1){
			next_fs = $(this).parent().next();
		}
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

		//show the next fieldset
		next_fs.show();
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				// scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({
	        'transform': 'scale('+scale+')',
	        'position': 'absolute'
	      });
				next_fs.css({'left': left, 'opacity': opacity});
			},
			duration: 800,
			complete: function(){
				current_fs.hide();
				animating = false;
			},
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
  }

});


$('input[type="file"]').change(function(e){
		var id = this.id;
		var count = id.substring(5,6);
		var fileName = '';
		for(var i=0;i < e.target.files.length; i++){
			if(i>0){
				fileName = fileName + ', ';
			}
	    fileName = fileName + e.target.files[i].name;
		}
    document.getElementById('file_name_label_' + count).innerHTML = fileName;
		$('#file_name_label_' + count).show();
  });



$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	current_fs = $(this).parent();
	// if(cont==0){
	// 	previous_fs = $(this).parent().prevAll().eq(2);
	// 	cont=1;
	// 	temp=0;
	// }else{
	// 	previous_fs = $(this).parent().prev();
	// }

	previous_fs = $(this).parent().prev();
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		},
		duration: 800,
		complete: function(){
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

function submit_form(){
	var form = $("#msform");
	form_validate(form);
	if (form.valid() == true){

	}else{
		return false;
	}
}

function validate_upload(){
	var common_task_url = document.getElementById('common_task_url').value;
	var vertical_task_url_1 = document.getElementById('vertical_task_url_1').value;
	var vertical_task_url_2 = document.getElementById('vertical_task_url_2').value;
	var vertical_task_url_3 = document.getElementById('vertical_task_url_3').value;

	var valid_ct = ValidURL(common_task_url);
	var valid_vt1 = ValidURL(vertical_task_url_1);
	var valid_vt3 = ValidURL(vertical_task_url_2);
	var valid_vt2 = ValidURL(vertical_task_url_3);

	if(valid_ct == false){
		console.log('Error');
		return false;
	}
	else if(valid_vt1 == false && vertical_task_url_1!=''){
		console.log('Error');
		return false;
	}
	else if(valid_vt2 == false && vertical_task_url_2!=''){
		console.log('Error');
		return false;
	}
	else if(valid_vt3 == false && vertical_task_url_3!=''){
		console.log('Error');
		return false;
	}
	else{
		return true;
	}

	// if(!valid){
	// 	alert('Incorrect URL for Common Task').
	// 	return false;
	// }
	// else{
	// 	return true;
	// }

}


function ValidURL(str) {
  var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
  if(!regex .test(str)) {
    return false;
  } else {
    return true;
  }
}
