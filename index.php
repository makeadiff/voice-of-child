<?php
include ('db/config.php'); //Find the configuratio files in db/config.php
$form_status = true;

?>
<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Fellowship Sign Up Form 2018 - Make A Difference</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel="shortcut icon" href="/var/www/html/SignUpForm/favicon.png" type="image/png">
        <link rel="stylesheet" href="css/style.css">
        <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">

        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700,400,400italic' rel='stylesheet' type='text/css'>
  			<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  			<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Titillium+Web:400,600,700,900|Ubuntu:400,500,700" rel="stylesheet">

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
            header {
            	font-family: 'Roboto Condensed' !important;
            }

            header nav a {
              font-size: 18px;
              line-height: 40px;
            }
            header ul{
              line-height: 60px !important;
            }
            .row{
              float: none !important
            }
            #continuing1 p {
              line-height: normal;
            }
        </style>
    </head>

    <body>

        <?php //include('../../global_nav.php') ?>
        <?php //include('../../succession2018/subheader.php') ?>
        <div class="container">
            <h1 class="span12 fs-main-title text-center">Fellowship Sign Up</h1>
        </div>
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form id="msform" action="preview.php" method="POST" onsubmit="submit_form()">
                    <!-- progressbar -->
                    <?php if($form_status){ ?>
                      <ul id="progressbar">
                          <li class="active">Personal Details</li>
                          <li>Self Analysis</li>
                          <li>Sign Up</li>
                          <li>Recommendation</li>
                      </ul>
                    <!-- fieldsets -->

                    <!-- Verify your details -->
                      <fieldset>
                          <br>
                          <!-- <p class="form-label">Dear <strong><?php //echo $user['name'] ?></strong></p>
                          <p class="form-label">Excited to see you explore MAD's fellowship profile! </p>
                          <p class="form-label">Get ready to lead, mobilise, engage and inspire a team of 100s of volunteer towards making exponential change! </p>
                          <p class="form-label"><strong class="madred">Fellowship 2018</strong>, just for you!</p>
                          <p class="form-label">Sign up for the role(s) that speak to you and get your chance to make the next level of difference in shelters, cities, in MAD.</p>
                          <p class="form-label">Let's kickstart with your personal information, for all communication regarding the fellowship process and onwards will be made to the information given below.</p>
                          <hr> -->
                          <h2 class="fs-title">Personal Information</h2>
  						            <h3 class="fs-subtitle">Please verify your personal details.</h3>
                          <hr>
                          <p class="form-label">
                            Hello, you amazing person.
                          </p>
                          <p class="form-label">
                            At MAD, the role of a Fellow is pivotal as a Fellow is a key enabler for mentors and volunteers. The roles and responsibilities of a Fellow requires a superstar with passion, drive and experience on ground; willingness to be deeply involved; a history of meaningful participation and leading by example; keenness to collaborate and work with other teams; excited about training and mentoring; good organisation and time management; great communication skills and a love for building teams and mobilising others.
                          </p>
                          <p class="form-label">If this is you, we'd love to get your application!!</p>
                          <hr>
                          <p class="required-text">*Required</p>
                          <input type='text' name="user_id" class="hidden" value= "<?php echo $user['id'] ?>"/>
                          <input type='text' name="user_city_id" class="hidden" value= "<?php echo $user['city_id'] ?>"/>
                          <p class="form-label">Full Name <span class="required">*</span></p>
                          <input type="text" name="user_name" onchange="req(this);" placeholder="Your Full Name" value= "<?php echo $user['name'] ?>" required=""/>
                          <p class="form-label">Personal Email <span class="required">*</span></p>
                          <input type="email" name="user_email" onchange="req(this);" placeholder="Email Address" value="<?php echo $user['email'] ?>" required=""/>
                          <p class="form-label">Phone No. <span class="required">*</span></p>
                          <input type="text" name="user_phone" onchange="{req(this); validphone(this);}" placeholder="Phone" value = "<?php echo $user['phone'] ?>" required=""/>
                          <p class="form-label">Sex <span class="required">*</span></p>
                          <select id ="user_sex" name="user_sex" value ="f" onchange="req(this);">
                                   <option >Sex</option>
                                   <option value="m" <?php if($user['sex'] == 'm') echo ' selected="selected"'?>>Male</option>
                                   <option value="f" <?php if($user['sex'] == 'f') echo ' selected="selected"'?>>Female</option>
                                   <option value="o" <?php if($user['sex'] == 'o') echo ' selected="selected"'?>>Other</option>
                          </select><br><br><br>
                          <p class="form-label">Date of Birth (DD/MM/YYYY) <span class="required">*</span></p>
                          <input type="date" name="user_birthday" placeholder="birthday" value="<?php echo $user['birthday'] ?>" required="" onchange="req(this);" max="2003-01-01">
                          <p class="form-label">Address <span class="required">*</span></p>
                          <input type="text" name="user_address" placeholder="Enter Your Address" required="" value="<?php echo $user['address'] ?>"/><br>


                          <!-- </select><br><br><hr> -->
                          <input type="button" name="next" class="next action-button" value="Next"/>
                      </fieldset>

                      <!-- Role Compatibility Survey -->
                      <fieldset id="continuing1">
                          <h2 class="fs-title">Were you born to be a fellow?</h2>
                          <!-- <label>Role Compatibility Form</label> -->
                          <h3 class="fs-subtitle">
                            <?php
                              if($survey_entered){
                                echo '<b>You have already filled this section</b>. Update your responses or Click on "Next" to continue.';
                              }
                            ?>
                          </h3>
                          <hr>
                          <!-- <img src="img/succession.png" alt="Mountain View" style="width:100%;height:auto;"><br /><br /> -->
                          <p class="form-label">
                            <strong class="madred">Please tick the boxes that apply to you.</strong>
                          </p>
                          <p class="form-label">
                            P.S: If you've got less than 4 of these, you may not enjoy the nature of the fellow role very much, and more direct child centred roles such as Mentorship or Wingman or Academic Support Volunteer would be a better option to apply for.
                          </p>

                          <?php
                            $i=1;
                            echo '<input type="hidden" value="'.$result[0]['question_id'].'" name="survey_question_id"/>';
                            foreach ($result as $questions) {
                              if(in_array($questions['answer_id'],$survey_responses)){
                                $checked = "checked";
                              }
                              else{
                                $checked = "";
                              }
                              echo '<p class="form-label">'.
                                   '<input class="checkbox" id="check'.$i.'" type="checkbox" name="fellowship_self_analysis_2017[]" value="'.$questions['answer_id'].'"'.$checked.'/>'.
                                   '<label for="check'.$i.'">'.$questions['answer'].'</label>'.
                                   '</p>';
                              $i++;
                            }
                          ?>

                          </p>

                          </h3>
                          <hr>
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                            <input type="button" name="next" class="next action-button" value="Next"/>
                      </fieldset>

                      <!-- SignUp page -->
                      <fieldset id="continuing2">
                          <h2 class="fs-title">Sign Up</h2>
                          <h3 class="fs-subtitle">
                            <?php
                              if($role_preference_check){
                                echo '<b>You have already filled this section</b>. Update your responses or Click on "Next" to continue.<br/>';
                              }
                            ?>
                          </h3>
                          <hr>
              						<p class="form-label">Need more information to make a choice? </p>
                          <p class="form-label">Visit the <strong class="madred"><a href="../../fellowship" target="_blank">Website</a></strong> to know more about each role. Some roles will speak to you more than others either due to your previous experience or innate interest in them. Go get them!! </p>

                          <!-- <p class="form-label"><strong>Point to note</strong>: All of our fellowships have few basic characteristics that are common amongst them all. So if you feel you would make a good fellow in one role, you would in the other one too if you are ready to pick up a couple of skills more. Our fellowships are a true learning journey, and while evaluating your application for the fellowship choices you have made, we may recommend a different fellowship altogether for you based on your natural aptitude as tested by the tasks. Make three choices from the list of fellowships available below.</p> -->

  						            <!-- <p class="form-label">Kindly Note : If you choose the CTL or the Foundational Team fellowship as any of your preferences, you will be first evaluated as a candidate for those two teams, and either be selected for those roles, or recommended to take forward your other preferences. Hence we recommend if you are thinking about either of those fellowships, apply to them in your first preference, and then state your next preferences. </p> -->

                          <hr>

                          <!-- <p align=left>What Profile would I be interested to sign up for?</p> -->
                          <!-- pull roles from user group table -->

                          <select id ="user_group_preference_id" name="user_group_preference_name" onchange="req(this);" required hidden>
                                   <option value="">Roles</option>
                                   <optgroup label="Fellow">
                                     <option value=0 selected>Fellow</option>
                                   </optgroup>
                                   <optgroup label="Volunteer Roles">
                                     <?php
                                      echo role_options($sql,$user['city_id'],'volunteer',$role_preference[1]);
                                     ?>
                                   </optgroup>
                          </select>

                          <!-- <input type='text' id="other" class="hidden" /><br><br><hr> -->


                          <div id="hidden_div">
                            <p align=left>First Preference <span class="required">*</span></p>
                            <select id ="fellow_prefernece1_id" name="fellow_prefernece1_name" required>
                               <option selected value="" selected>Select Role</option>
                               <?php
                                 echo role_options($sql,$user['city_id'],'fellow',$role_preference[1]);
                               ?>
                            </select><br><hr>

                            <p align=left>Second Preference</p>
                            <select id ="fellow_prefernece2_id" name="fellow_prefernece2_name" value ="">
                              <option selected value="" selected>Select Role</option>
                              <?php
                                echo role_options($sql,$user['city_id'],'fellow',$role_preference[2]);
                              ?>
                            </select><br><hr>

                            <p align=left>Third Preference</p>
                            <select id ="fellow_prefernece3_id" name="fellow_prefernece3_name" value ="">
                              <option selected value="" selected>Select Role</option>
                              <?php
                                echo role_options($sql,$user['city_id'],'fellow',$role_preference[3]);
                              ?>
                            </select><br>

                          <hr />

                          <p align="left">In case you are <strong>planning to move</strong> to another city, mark your new city here. You'll be applying for positions in that city...</p>
                            <select id="fellow_move_city_id" name="fellow_move_city_id">
                              <option value="0" selected>Not Moving</option>
                              <?php
                                $all_cities = $sql->getById("SELECT id,name FROM City WHERE type='actual' ORDER BY name");

                                foreach ($all_cities as $city_id => $city_name) {
                                  echo "<option value='$city_id'>$city_name</option>\n";
                                }
                              ?>
                            </select><br><hr />
                          </div>


                          <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                          <input type="button" name="next" class="next action-button" value="Next"/>
                      </fieldset>

                      <!-- recommendation -->
                      <fieldset>

                          <h2 class="fs-title">Recommend Change Agents</h2>
                          <h3 class="fs-subtitle">
                            <?php
                              if($recommendation_check){
                                echo '<br/><br/>';
                                echo '<b>You have already filled this section</b>. Update your responses or Click on "Next" to continue.<br/>';
                              }
                            ?>
                          </h3><hr>
                          <!-- <p class="form-label">Throughout this year you would have met some amazing people in your recruitment drives, trainings, weekly sessions, city circles and other MAD events. There is something unique about each of these people. Unique because they didn't just care - they cared more. They should definitely try their chance at leadership roles! They should believe in their potential as you do. This is your chance to recommend those who should multiply impact and lead the city. Those who you see potential in to lead the city with you!</p> -->

                          <p class="form-label">Recommend volunteers whom you see have the potential to be fellows.</p><hr>

                          <?php
                            for($i=0;$i<3;$i++){
                              $name = '';
                              $options = role_options($sql,$user['city_id'],'fellow');
                              if($recommendation_check && isset($recommendation[$i]['name'])){
                                $name = 'value ="'.$recommendation[$i]['name'].' / '.$recommendation[$i]['id'].'"';
                                $options = role_options($sql,$user['city_id'],'fellow',$recommendation[$i]['group_id']);
                              }
                              $required = '';
                              // if($i==0){
                              //   $required = 'required';
                              // }
                              echo '<p class="form-label">Volunteer Name </p>';
                              echo '<input type="text" id="tags'.($i+1).'" class="auto" name="recommendation'.($i+1).'_name" '.$required.' placeholder="Start typing name of volunteer" '.$name.'>
                              <p align=left>Recommended Profile</p>
                                  <select id ="recommendation_role'.($i+1).'_id" name="recommendation'.($i+1).'_role_name" '.$required.' value ="">
                                           <option selected value="">Select Profile</option>
                                            '.$options.'
                                  </select>
                              <br><br><hr>';
                            }
                          ?>

                          <br><input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                          <input type="submit" name="submit" class="submit action-button" value="Submit" href="preview.php"/>
                      </fieldset>
                    <?php } else{  ?>
                    <fieldset>
                        <h2 class="fs-title">Oops! Time machine isn't invented yet.</h2><hr>
                        <h3 class="fs-subtitle">The deadline to fill the form is now over.</h3><hr>
                    </fieldset>
                    <?php }   ?>
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


          // function req(valchange){if (valchange.value=="") window.alert("This field is required");}
          // function validphone(num){if (num.value.match(/\d/g).length!=10) window.alert("Enter a valid phone number");}

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
