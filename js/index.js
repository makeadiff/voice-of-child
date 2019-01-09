

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
// var temp=0;
// var cont=document.getElementById("soflow").value;


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

var more_details = false;


$('#add_questions').click(function(){

	var content =  '<div class="q'+(question_count)+'">';
	content += 	'<p class="form-label">';
	content += 	'<hr/>';
	content +=  '<p class="form-label">';
	content += 	'Question '+(question_count+1);
	content += 	'</p>';
	content += 	'<input required type="text" name="question_'+(question_count)+'" placeholder="Eg. How does the child percieve ed support classes"/>';
	content += 	'<p class="form-label">';
	content += 	'Answer '+(question_count+1);
	content += 	'</p>';
	content += 	'<textarea required  name="answer_'+(question_count)+'" placeholder="Eg. The classes are really good and helpful. The volunteers come on time and cover the topics really well."></textarea>';
	content += 	'<p class="form-label">';
	content +=  'Question '+(question_count+1)+' Type';
	content +=  '</p>';
	content +=  '<select name="question_type_'+(question_count)+'" id="question_type" required>';
	for (i in question_type){
		content += '<option value="'+i+'">'+question_type[i]+'</option>';
	}
	content +=  '</select>';

	content += 	'<p class="form-label">';
	content += 	'Tags';
	content +=  '</p>';
	content +=	'<input required type="text" id="tags'+(question_count)+'" name="question_tag_'+(question_count)+'" placeholder="Eg. #EdSupport #Operations"/>';
	content += 	'<p class="form-label">';
	content += 	'Actionable';
	content +=	'</p>';

	content +=  '<select name="actionable_'+(question_count)+'" id="actionable_" required>';
	for (j in actionable){
		content += '<option value="'+j+'">'+actionable[j]+'</option>';
	}
	content +=  '</select>';
	content += 	'</div>';
	question_count++;

	$('#question_count').val(question_count);
	document.getElementById('additional_questions').innerHTML += content;

	$('#remove_questions').removeClass('hidden');
	$('#tags'+(question_count-1)).tagsInput();

	$('#tags'+(question_count-1)).tagsInput({
		autocomplete_url:'http://myserver.com/api/autocomplete'
	});

});


$('#remove_questions').click(function(){
	$('div.q'+(question_count-1)).detach();
	question_count--;
	if(question_count==1){
		$('#remove_questions').addClass('hidden');
	}
	$('#question_count').val(question_count);
});

$('#city_id').change(function(){
	if(this.value!=''){
		$.ajax({
			url: "get-shelter.php?city_id="+this.value,
			cache: false,
			success: function(data){
				data = JSON.parse(data);
				content = '';
				for (j in data){
					content += '<option value="'+j+'">'+data[j]['name']+'</option>';
				}
				$('#shelter_id').html(content);
				$('#shelter_id').trigger('change');
			}
		});
	}
});

$('#shelter_id').change(function(){
	if(this.value!=''){
		$.ajax({
			url: "get-children.php?shelter_id="+this.value,
			cache: false,
			success: function(data){
				data = JSON.parse(data);
				content = '';
				for (j in data){
					content += '<option value="'+j+'">'+data[j]+'</option>';
				}
				$('#child_id').html(content);
			}
		});
	}
});


// $("#filerVOC").on("keyup", function() {
//   var value = $(this).val().toLowerCase();
//   $("#contentVOC li").filter(function() {
//     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//   });
// });

function ValidURL(str) {
  var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
  if(!regex .test(str)) {
    return false;
  } else {
    return true;
  }
}
