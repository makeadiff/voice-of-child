<?php

  include ('db/config.php');

  //Find the configuratio files in db/config.php
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
                        <h3 class="fs-subtitle"> Verify Your Details</h3><hr>
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
                                 <option value="1" >Yes</option>
                                 <option value="0" >No</option>
                        </select><br><br><hr>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- Role Compatibility Survey -->
                    <fieldset>
                        <h2 class="fs-title">Role Compatibility</h2>
                        <h3 class="fs-subtitle">
                          Self Analysis
                          <?php
                            if($survey_entered){
                              echo '<br/><br/>';
                              echo '<b>You have already filled this section</b>. Update your responses or Click on "Next" to continue.<br/>';
                            }
                          ?>
                        </h3><hr>

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
                                            <input type="radio" required="" name="survey_question_'.$qna['question_id'].'" value="'.$qna['answer_id'].'" '.$selected.'>
                                            <label class="radio-inline">
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
                    <fieldset>
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
                        <img src="img/succession.png" alt="Mountain View" style="width:100%;height:auto;">
                        <h3 align=left class="fs-subtitle">Dear MADster,<br><br>Having filled the role compatibility questionnaire, we hope you have gotten a better insight into your current interests and prospective commitment you can make to MAD.<br>If majority of your answers were Yes, then we would highly recommend you to apply for the role of a Fellow, Strategist, Wingman or a Mentor as these role require a higher level of ownership and commitment as you would be multiplying the impact on ground.<br><br>If your answers were majorly kind of and a few no, we would recommend you to really think about whether you are ready to invest the time and effort to build the skills with the support we will be providing you as well as understand the expected commitment towards Make A Difference for the upcoming year and make an informed decision to take on Fellowship, Strategist, Wingman, Mentor and volunteering profiles.<br><br>We believe that every person can make a difference and if you have identified that you will not be able to commit to MAD in the expected collective capacity we would recommend you to join our Alumni network and work towards transforming outcomes for children in an individual capacity.<br><br>We are in this journey together and we look hope you choose wisely.</h3><hr>

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
                               dump($role_preference);
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
                        <h3 align=left class="fs-subtitle">This is your opportunity to voice your choice of City Managers (Fellows) for your city for the upcoming year.<br>You've gone through the role compatibility screening and read about what it takes to be a fellow.<br><br>Keeping that in mind, fill in the following.
                        </h3><hr>

                        <?php
                          for($i=0;$i<3;$i++){
                            $name = '';
                            $options = role_options($sql,$user['city_id'],'fellow');
                            if($recommendation_check){
                              $name = 'value ="'.$recommendation[$i]['name'].' / '.$recommendation[$i]['id'].'"';
                              $options = role_options($sql,$user['city_id'],'fellow',$recommendation[$i]['group_id']);
                            }

                            echo '<input type="text" id="tags'.($i+1).'" class="auto" name="recommendation'.($i+1).'_name" required placeholder=" Potential Fellowship/Mentorship Candidate '.($i+1).'" '.$name.'>
                            <p align=left>Recommended Profile:</p>
                                <select id ="recommendation_role'.($i+1).'_id" name="recommendation'.($i+1).'_role_name" required value ="">
                                         <option selected value="">Roles</option>
                                          '.$options.'
                                </select>
                            <br><br><hr>';
                          }
                        ?>

                        <br><input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!--referral-->
                    <!-- <fieldset>

                        <h2 class="fs-title">Refer</h2>
                        <h3 align=left class="fs-subtitle">If you know someone who has the spark to join and Make A Difference, refer them.
                        </h3><hr>
                        <h3 class="fs-subtitle">Person 1</h3><hr>
                        <input type="text" name="referral1_name" placeholder="Full Name" value= "" required=""/>
                        <input type="email" name="referral1_email" placeholder="Email Address" value="" required=""/>
                        <input type="text" name="referral1_phone" placeholder="Phone" value = "" required=""/>
                        <select id ="soflow" name="referral1_sex" value ="f">
                          <option>Gender</option>
                          <option value="m">Male</option>
                          <option value="f">Female</option>
                          <option value="o">Other</option>
                        </select>
                        <br/><br/><br/>
                        <hr>
                        <h3 class="fs-subtitle">Person 2</h3><hr>
                        <input type="text" name="referral2_name" placeholder="Full Name" value= "" required=""/>
                        <input type="email" name="referral2_email" placeholder="Email Address" value="" required=""/>
                        <input type="text" name="referral2_phone" placeholder="Phone" value = "" required=""/>
                        <select id ="soflow" name="referral2_sex" value ="f">
                          <option>Gender</option>
                          <option value="m">Male</option>
                          <option value="f">Female</option>
                          <option value="o">Other</option>
                        </select>
                        <br/><br/><br/>
                        <hr>
                        <h3 class="fs-subtitle">Person 3</h3><hr>
                        <input type="text" name="referral3_name" placeholder="Full Name" value= "" required=""/><hr>
                        <input type="email" name="referral3_email" placeholder="Email Address" value="" required=""/><hr>
                        <input type="text" name="referral3_phone" placeholder="Phone" value = "" required=""/><hr>
                        <select id ="soflow" name="referral3_sex" value ="f">
                          <option>Gender</option>
                          <option value="m">Male</option>
                          <option value="f">Female</option>
                          <option value="o">Other</option>
                        </select>
                        <br/><br/><br/>
                        <hr>
                        <br><input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset> -->
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
          });

          var style = document.getElementById('user_group_preference_id')
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
