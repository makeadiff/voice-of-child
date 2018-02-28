<?php
include ('db/config.php'); //Find the configuratio files in db/config.php
?>
<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Retention and Sign Up Form - Make A Difference</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel="shortcut icon" href="/var/www/html/SignUpForm/favicon.png" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
        <style>
            html{font-size:20pt}
            .choice {
                float: right;
                display: inline;
                margin-left: 3em;
            }
            .choice input {
                vertical-align: left;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1 class="span12 fs-main-title text-center">Retention and Succession Form</h1>
        </div>
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form id="msform" action="preview.php" method="POST">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Personal Details</li>
                        <li>Role Compatibility</li>
                        <li>Sign Up</li>
                        <li>Recommendation</li>
                        <li>Submit</li>
                        </ul>
                    <!-- fieldsets -->

                    <!-- Verify your details -->
                    <fieldset>
                        <h2 class="fs-title">Personal Information</h2>
                        <!-- <h3 class="fs-subtitle"> Verify Your Details</h3><hr> -->
                        <p align="left" class="fs-subtitle">Hello, amazing MADster. <br />
							It's time! Gear yourself up for the much awaited Succession 2018. <br />
							In 2017, you learnt, you invested, you grew. Now it's your time. Take it a step forward. <br />
							Explore and find your destiny! The role you were made for! The role that speaks to you! <br />
							Apply away!</p>

						<p align="left" class="fs-subtitle">Kindly verify your personal details and move forward...</p>

                        <input type='text' name="user_id" class="hidden" value= "<?php echo $user['id'] ?>"/>
                        <input type='text' name="user_city_id" class="hidden" value= "<?php echo $user['city_id'] ?>"/>

                        <input type="text" name="user_name" onchange="req(this);" placeholder="Your Full Name" value= "<?php echo $user['name'] ?>" required=""/><hr>
                        <input type="email" name="user_email" onchange="req(this);" placeholder="Email Address" value="<?php echo $user['email'] ?>" required=""/><hr>
                        <input type="text" name="user_phone" onchange="{req(this); validphone(this);}" placeholder="Phone" value = "<?php echo $user['phone'] ?>" required=""/><hr>

                        <select id ="user_sex" name="user_sex" value ="f" onchange="req(this);">
                                 <option >Gender</option>
                                 <option value="m" <?php if($user['sex'] == 'm') echo ' selected="selected"'?>>Male</option>
                                 <option value="f" <?php if($user['sex'] == 'f') echo ' selected="selected"'?>>Female</option>
                                 <option value="o" <?php if($user['sex'] == 'o') echo ' selected="selected"'?>>Other</option>
                        </select><br><br><hr>
                        <input type="date" name="user_birthday" placeholder="birthday" value="<?php echo $user['birthday'] ?>" required="" onchange="req(this);"><hr>
                        <input type="text" name="user_address" placeholder="Enter Your Address" value="<?php echo $user['address'] ?>"/><hr><br>
                        <p align="left"> Are you planning to continue next year?</p>

                        <select id ="soflow" name="cont_status" onchange="req(this);" >
                        <?php
                          $one = '';
                          $zero = '';
                          if($user_cont_status!=''){
                              if($user_cont_status==1){
                                $one = 'selected';
                              }
                              else{
                                $zero = 'selected';
                              }
                          }
                        ?>
                            <option value="1" <?php echo $one; ?> >Yes</option>
                            <option value="0" <?php echo $zero; ?> >No</option>

                        </select><br><br><hr>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- Role Compatibility Survey -->
                    <fieldset id="continuing1">
                        <h2 class="fs-title">Role Compatibility</h2>
                        <h3 class="fs-subtitle">
                          Self Analysis
                          <?php
                            if($survey_entered){
                              echo '<br/><br/>';
                              echo '<b>You have already filled this section</b>. Update your responses or Click on "Next" to continue.<br/>';
                            }
                          ?>
                        </h3>
						
						<p align="left" class="fs-subtitle">Let's get started. If you are not likely to answer positively to the first four, being an Alumni might be the best option for you.</p>
                        <hr>

                        <?php
                          $indx=1;
                          $last_question_id = 0;
                          foreach ($result as $qna) {

                            $selected = '';
                            if(isset($check_survey[$qna['question_id']])){
                              if($survey_entered && $qna['answer_id']==$check_survey[$qna['question_id']])
                                $selected = 'checked';
                            }

                            $form_input = '<div class="col-sm-12">
                                            <input type="radio" required="" name="survey_question_'.$qna['question_id'].'" id="survey_question_'.$qna['question_id'].'-'.$qna['answer_id'].'" 
                                              value="'.$qna['answer_id'].'" '.$selected.'>
                                            <label class="radio-inline" for="survey_question_'.$qna['question_id'].'-'.$qna['answer_id'].'">
                                              '.$qna['answer'].'
                                            </label>
                                           </div>';

                            if($qna['question_id']==$last_question_id){
                              echo $form_input;
                            }
                            else{
                              if($indx!=1){
                                echo '</div>'.'<hr/>';
                              }
                              echo '<p align=left>'.$indx.'. '.$qna['question'].'</p>'.'<div class="row">';
                              $indx++;
                              $last_question_id = $qna['question_id'];
                              echo $form_input;
                            }
                          }
                        ?>
                          </div>
                          <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                          <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- SignUp page -->
                    <fieldset id="continuing2">
                        <h2 class="fs-title">Sign Up</h2>
                        <h3 class="fs-subtitle">
                          <?php
                            if($role_preference_check){
                              echo '<br/><br/>';
                              echo '<b>You have already filled this section</b>. Update your responses or Click on "Next" to continue.<br/>';
                            }
                          ?>
                        </h3>
                        <hr>
                        <img src="img/succession.png" alt="Mountain View" style="width:100%;height:auto;"><br /><br />
                        <p align="left" class="fs-subtitle">Dear MADster</p>

						<p align="left" class="fs-subtitle">Having filled the role compatibility questionnaire, we hope you have gotten a better insight into your current interests and prospective commitment you can make to MAD.</p>

						<p align="left" class="fs-subtitle">If you selected 'Yes' to 7 or more, then we would highly recommend you to apply for the role of a Fellow, Mentor, or Wingman. These role require a higher level of ownership and commitment and you would be multiplying the impact on ground.</p>

                        <hr>

                        <p align=left>What Profile would I be interested to sign up for?</p>
                        <!-- pull roles from user group table -->

                        <select id ="user_group_preference_id" name="user_group_preference_name" onchange="req(this);" required>
                                 <option value="">Roles</option>
                                 <optgroup label="Fellow">
                                   <option value=0 selected>Fellow</option>
                                 </optgroup>
                                 <optgroup label="Volunteer Roles">
                                   <?php
                                    echo role_options($sql,$user['city_id'],'volunteer',$role_preference[1]);
                                   ?>
                                 </optgroup>
                        </select><br><hr>

                        <!-- <input type='text' id="other" class="hidden" /><br><br><hr> -->


                        <div id="hidden_div" class="indented">
                          <p align=left>What is Fellowship profile first preference?</p>
                          <select id ="fellow_prefernece1_id" name="fellow_prefernece1_name" required>
                             <option selected value="" selected>Select Role</option>
                             <?php
                               echo role_options($sql,$user['city_id'],'fellow',$role_preference[1]);
                             ?>
                          </select><br><hr>

                          <p align=left>What is Fellowship profile second preference?</p>
                          <select id ="fellow_prefernece2_id" name="fellow_prefernece2_name" value ="">
                            <option selected value="" selected>Select Role</option>
                            <?php
                              echo '<optgroup label="Fellow Roles">';
                              echo role_options($sql,$user['city_id'],'fellow',$role_preference[2]);
                              echo '</optgroup><optgroup label="Volunteer Roles">';
                              echo role_options($sql,$user['city_id'],'volunteer',$role_preference[2]);
                              echo '</optgroup>';
                            ?>
                          </select><br><hr>

                          <p align=left>What is Fellowship profile third preference?</p>
                          <select id ="fellow_prefernece3_id" name="fellow_prefernece3_name" value ="">
                            <option selected value="" selected>Select Role</option>
                            <?php
                              echo '<optgroup label="Fellow Roles">';
                              echo role_options($sql,$user['city_id'],'fellow',$role_preference[3]);
                              echo '</optgroup><optgroup label="Volunteer Roles">';
                              echo role_options($sql,$user['city_id'],'volunteer',$role_preference[3]);
                              echo '</optgroup>';
                            ?>
                          </select><br><hr>
                        </div>

                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- recommendation -->
                    <fieldset>

                        <h2 class="fs-title">Recommendation</h2>
                        <h3 class="fs-subtitle">
                          <?php
                            if($recommendation_check){
                              echo '<br/><br/>';
                              echo '<b>You have already filled this section</b>. Update your responses or Click on "Next" to continue.<br/>';
                            }
                          ?>
                        </h3><hr>
                        <p align="left" class="fs-subtitle">Throughout this year you would have met some amazing people in your recruitment drives, trainings, weekly sessions, city circles and other MAD events. There is something unique about each of these people. Unique because they didn't just care - they <strong>cared more</strong>. This is your chance to recommend those who should multiply impact and lead the city.</p>

                        <p><strong>Recommend volunteers whom you see potential to be city managers below</strong>.</p><hr>

                        <?php
                          for($i=0;$i<3;$i++){
                            $name = '';
                            $options = role_options($sql,$user['city_id'],'fellow');
                            if($recommendation_check){
                              $name = 'value ="'.$recommendation[$i]['name'].' / '.$recommendation[$i]['id'].'"';
                              $options = role_options($sql,$user['city_id'],'fellow',$recommendation[$i]['group_id']);
                            }
                            $required = '';
                            if($i==0){
                              $required = 'required';
                            }

                            echo '<input type="text" id="tags'.($i+1).'" class="auto" name="recommendation'.($i+1).'_name" '.$required.' placeholder=" Potential Fellowship/Mentorship Candidate '.($i+1).'" '.$name.'>
                            <p align=left>Recommended Profile:</p>
                                <select id ="recommendation_role'.($i+1).'_id" name="recommendation'.($i+1).'_role_name" '.$required.' value ="">
                                         <option selected value="">Roles</option>
                                          '.$options.'
                                </select>
                            <br><br><hr>';
                          }
                        ?>

                        <br><input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <fieldset>
                        <h2 class="fs-title">Submit</h2><hr>
                        <h3 class="fs-subtitle">Thank You For Your Responses. Click on Submit to confirm your application.</h3><hr>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="submit" name="submit" class="submit action-button" value="Submit" href="preview.php"/>
                    </fieldset>
                </form>
            </div>
        </div>

        <!-- /.MultiStep Form -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
        <script src='https://code.jquery.com/jquery-1.10.2.js'></script>
        <script src='https://code.jquery.com/ui/1.10.4/jquery-ui.js'></script>
        <script  src="js/index.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        <script>
          document.getElementById('user_group_preference_id').addEventListener('change', function () {
            var style = this.value == 0 ? 'block' : 'none';
            document.getElementById('hidden_div').style.display = style;
            if(id==''){
              $('#fellow_prefernece2_id option').removeAttr("hidden");
              $('#fellow_prefernece3_id option').removeAttr("hidden");
              $('#fellow_prefernece1_id option').removeAttr("hidden");
            }
          });

          //Disable Values
          document.getElementById('fellow_prefernece1_id').addEventListener('change', function () {
            var id = this.value;

            if(id==''){
              $('#fellow_prefernece2_id option').removeAttr("hidden");
              $('#fellow_prefernece3_id option').removeAttr("hidden");
            }

            $('#fellow_prefernece2_id option[value='+id+']').attr("hidden","hidden");
            $('#fellow_prefernece3_id option[value='+id+']').attr("hidden","hidden");

          });

          document.getElementById('fellow_prefernece2_id').addEventListener('change', function () {
            var id = this.value;

            if(id==''){
              $('#fellow_prefernece2_id option').removeAttr("hidden");
              $('#fellow_prefernece3_id option').removeAttr("hidden");
            }

            $('#fellow_prefernece1_id option[value='+id+']').attr("hidden","hidden");
            $('#fellow_prefernece3_id option[value='+id+']').attr("hidden","hidden");

          });

          document.getElementById('fellow_prefernece3_id').addEventListener('change', function () {
            var id = this.value;

            if(id==''){
              $('#fellow_prefernece2_id option').removeAttr("hidden");
              $('#fellow_prefernece3_id option').removeAttr("hidden");
            }

            $('#fellow_prefernece2_id option[value='+id+']').attr("hidden","hidden");
            $('#fellow_prefernece1_id option[value='+id+']').attr("hidden","hidden");

          });

          if(document.getElementById('fellow_prefernece1_id').value!=''){
            var id = document.getElementById('fellow_prefernece1_id').value;

            $('#fellow_prefernece2_id option').removeAttr("hidden");
            $('#fellow_prefernece3_id option').removeAttr("hidden");

            $('#fellow_prefernece2_id option[value='+id+']').attr("hidden","hidden");
            $('#fellow_prefernece3_id option[value='+id+']').attr("hidden","hidden");
          }

          if(document.getElementById('fellow_prefernece2_id').value!=''){
            var id = document.getElementById('fellow_prefernece1_id').value;

            $('#fellow_prefernece1_id option').removeAttr("hidden");
            $('#fellow_prefernece3_id option').removeAttr("hidden");

            $('#fellow_prefernece1_id option[value='+id+']').attr("hidden","hidden");
            $('#fellow_prefernece3_id option[value='+id+']').attr("hidden","hidden");
          }

          if(document.getElementById('fellow_prefernece3_id').value!=''){
            var id = document.getElementById('fellow_prefernece1_id').value;

            $('#fellow_prefernece2_id option').removeAttr("hidden");
            $('#fellow_prefernece1_id option').removeAttr("hidden");

            $('#fellow_prefernece2_id option[value='+id+']').attr("hidden","hidden");
            $('#fellow_prefernece1_id option[value='+id+']').attr("hidden","hidden");
          }

          var style = document.getElementById('user_group_preference_id').value == 0 ? 'block' : 'none';
          document.getElementById('hidden_div').style.display = style;


          function req(valchange){if (valchange.value=="") window.alert("This field is required");}
          function validphone(num){if (num.value.match(/\d/g).length!=10) window.alert("Enter a valid phone number");}

          $(function() {
            var availableTags =  <?php echo json_encode($volunteer); ?>;

          $( "#tags1" ).autocomplete({
              source: availableTags,
              autoFocus:true
            });
          $( "#tags2" ).autocomplete({
              source: availableTags,
              autoFocus:true
            });
          $( "#tags3" ).autocomplete({
              source: availableTags,
              autoFocus:true
            });
          } );
        </script>


    </body>

</html>

<script>
  window.intercomSettings = {
    app_id: "xnngu157"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/xnngu157';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
</script>
