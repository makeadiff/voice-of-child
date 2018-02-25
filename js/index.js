

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
var temp=0;
var cont=document.getElementById("soflow").value;
$(".next").click(function(){
	var form = $("#msform");
			form.validate({
				rules: {
					user_name: {
						required: true,
						maxlength: 30,
					},
					user_email:{
						required:true,
						email:true
					},
					user_phone: {
					required:true,
					}

				},
				messages: {
					user_name: {
						required: "Name required",
					},
				  user_phone: {
						required: "Enter a valid phone number",
					},


				}
			});

 if (form.valid() == true){
				if(animating) return false;
				animating = true;
				current_fs = $(this).parent();
				if(document.getElementById("soflow").value=="0"&&temp==0)
						{ console.log('here');
							next_fs = $(this).parent().nextAll().eq(2);
							cont=0;
							$('#continuing1').attr("disabled","disabled");
							$('#continuing2').attr("disabled","disabled");
						temp=1;}
				else
						{
							if(cont==1){
								$('#continuing1').removeAttr("disabled");
								$('#continuing2').removeAttr("disabled");
							}
							next_fs = $(this).parent().next();

						}
				//activate next step on progressbar using the index of next_fs
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


$(".previous").click(function(){
	if(animating) return false;
	animating = true;

	current_fs = $(this).parent();
	if(cont==0){
		previous_fs = $(this).parent().prevAll().eq(2);
		cont=1;
		temp=0;
	}else{
		previous_fs = $(this).parent().prev();
	}

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
