<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Retention and Sign Up Form</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

        <link rel="shortcut icon" href="/var/www/html/SignUpForm/favicon.png" type="image/png">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <?php
      $db = "makeadiff_madapp";
      $db_host = "127.0.0.1";
      $db_name = "root";
      $db_pass = "root@1234";

      $dbhandle = mysqli_connect($db_host, $db_name, $db_pass,$db)
        or die("Couldn't connect to SQL Server on $db_host");

      $query_qna="Select question_id, question,SS_Answer.id as answer_id, answer from SS_Answer
                      inner join SS_Question on SS_Answer.question_id=SS_Question.id
                      where survey_event_id=7 ";
      $ans=mysqli_query($dbhandle,$query_qna);
      $result=array();
      while($row=mysqli_fetch_array($ans))
      {
        $result[]=$row;
      }
      //print_r($result);
    ?>


    <body>
        <div class="container">
            <h1 class="span12 fs-main-title text-center" >Retention and Succession Form</h1>
            <!-- <h2 class="span12 fs-title text-center" style="color: white">Applications</h2> -->
        </div>
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form id="msform" action="preview.php" method="get">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Personal Details</li>
                        <li>Role Compatibility</li>
                        <li>Sign Up</li>
                        <li>Referrals</li>
                        <li>Preview</li>
                        <li>Submit</li>
                        </ul>
                    <!-- fieldsets -->


                    <!-- Verify your details -->
                    <fieldset>
                        <h2 class="fs-title">Personal Information</h2>
                        <h3 class="fs-subtitle"> Verify Your Details</h3><hr>
                        <input type="text" name="user_name" placeholder="Your Full Name" value="<?php //echo $user->name; ?>" required=""/><hr>
                        <input type="email" name="user_email" placeholder="Email Address" value="<?php //echo $user->email; ?>" required=""/><hr>
                        <!--<input type="text" name="address" placeholder="Address"/>-->
                        <input type="text" name="user_phone" placeholder="Phone" value = "<?php //echo $user->phone; ?>" required=""/><hr>
                        <select id ="soflow" name="uer_sex" value ="f">
                                 <option selected value="<?php //echo $user->sex; ?>">Gender</option>
                                 <option value="m">Male</option>
                                 <option value="f">Female</option>
                                 <option value="o">Other</option>
                        </select>
                        <br><br><hr>
                        <input type="date" name="user_birthday" placeholder="birthday" value="<?php //echo $user->birthday; ?>" required=""><hr>
                        <!-- <input type="text" name="fName" placeholder="Your Facebook Name" required=""/> -->
                        <!-- <input type="url" name="fUrl" placeholder="Facebook Id Link/URL" required=""/> -->
                        <textarea name="user_address" placeholder="Enter Your Address" Value="<?php //echo $user->address; ?>" required=""></textarea><hr>
                        <!-- <input type="text" name="sex" placeholder="Gender" required=""/> -->

                        <br>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- Role Compatibility Survey -->
                    <fieldset>
                        <h2 class="fs-title">Role Compatibility</h2>
                        <h3 class="fs-subtitle">Self Analysis</h3>

                          <hr>
                          <?php
                          //problem is here
                          // print_r($result);
                          $indx=1;
                          for($i=0;$result[$i]!='NULL'&&$i<45;$i++)
                          {echo'<p align=left>'.$indx.'. '.$result[$i]['question'].'</p>';
                            $indx++;
                            for($j=$i;$result[$j]['question_id']==$result[$i]['question_id'];$j++)
                            {echo '<span><label class="radio-inline"><input type="radio" name="survey_question_'.$result[$j]['question_id'].'"><br>'.$result[$j]['answer'].'</label></span>';}
                            $i=$j-1;
                            echo "<hr>";
                          }
                            ?>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>


                    <!-- SignUp page -->
                    <fieldset>
                        <h2 class="fs-title">Sign Up</h2>
                        <h3 class="fs-subtitle"></h3>
                        <hr>
                        <img src="img/succession.png" alt="Mountain View" style="width:100%;height:auto;">
                        <h3 align=left class="fs-subtitle">Dear MADster,<br><br>Having filled the role compatibility questionnaire, we hope you have gotten a better insight into your current interests and prospective commitment you can make to MAD.<br>If majority of your answers were Yes, then we would highly recommend you to apply for the role of a Fellow, Strategist, Wingman or a Mentor as these role require a higher level of ownership and commitment as you would be multiplying the impact on ground.<br><br>If your answers were majorly kind of and a few no, we would recommend you to really think about whether you are ready to invest the time and effort to build the skills with the support we will be providing you as well as understand the expected commitment towards Make A Difference for the upcoming year and make an informed decision to take on Fellowship, Strategist, Wingman, Mentor and volunteering profiles.<br><br>We believe that every person can make a difference and if you have identified that you will not be able to commit to MAD in the expected collective capacity we would recommend you to join our Alumni network and work towards transforming outcomes for children in an individual capacity.<br><br>We are in this journey together and we look hope you choose wisely.
                        </h3>
                        <!--pull roles from user group  -->
                        <?php
                        $roles_query="select * from UserGroup"
                         ?>
                        <hr>
                        <p align=left>What Profile would I be interested to sign up for?</p>
                        <!-- pull roles frommuser group table -->
                        <select id ="user_group_preference_id" name="user_group_preference_name" value ="">
                                 <option selected value="<?php //echo $user->sex; ?>">Roles</option>
                                 <option value=0>Fellow</option>
                                 <option value=8>Ed Support Mentor</option>
                                 <option value=9>Ed Support ASV</option>
                                 <option value=349>Transition ASV</option>
                                 <option value=348>Transition Wingman</option>
                                 <option value=999>Alumni</option>
                        </select>
                        <input type='text' id="other" class="hidden" />
                        <br><br><hr>

                        <div id="hidden_div" style="display: none;">
                          <p align=left>What is Fellowship profile first preference?</p>
                          <select id ="fellow_prefernece1_id" name="fellow_prefernece1_name" value ="">
                                   <option selected value="<?php //echo $user->sex; ?>">Roles</option>
                                   <option value=0>City Team Lead</option>
                                   <option value=8>Shelter Support Fellow</option>
                                   <option value=9>Ed Support Fellow</option>
                                   <option value=349>Transition Redainess and Aftercare Fellow</option>
                                   <option value=348>Shelter Operations Fellow</option>
                                   <option value=999>Fundraising Fellow</option>
                                   <option value=999>Human Capital Fellow</option>
                                   <option value=999>Foundations Fellow</option>
                                   <option value=999>Campaigns Fellow</option>
                          </select>
                          <br><hr>

                          <p align=left>What is Fellowship profile second preference?</p>
                          <select id ="fellow_prefernece2_id" name="fellow_prefernece2_name" value ="">
                                    <option selected value="<?php //echo $user->sex; ?>">Roles</option>
                                    <option value=0>City Team Lead</option>
                                    <option value=8>Shelter Support Fellow</option>
                                    <option value=9>Ed Support Fellow</option>
                                    <option value=349>Transition Redainess and Aftercare Fellow</option>
                                    <option value=348>Shelter Operations Fellow</option>
                                    <option value=999>Fundraising Fellow</option>
                                    <option value=999>Human Capital Fellow</option>
                                    <option value=999>Foundations Fellow</option>
                                    <option value=999>Campaigns Fellow</option>
                          </select>
                          <br><hr>
                          <p align=left>What is Fellowship profile third preference?</p>
                          <select id ="fellow_prefernece3_id" name="fellow_prefernece3_name" value ="">
                                  <option selected value="<?php //echo $user->sex; ?>">Roles</option>
                                  <option value=0>City Team Lead</option>
                                  <option value=8>Shelter Support Fellow</option>
                                  <option value=9>Ed Support Fellow</option>
                                  <option value=349>Transition Redainess and Aftercare Fellow</option>
                                  <option value=348>Shelter Operations Fellow</option>
                                  <option value=999>Fundraising Fellow</option>
                                  <option value=999>Human Capital Fellow</option>
                                  <option value=999>Foundations Fellow</option>
                                  <option value=999>Campaigns Fellow</option>
                          </select>
                          ><br><hr>
                        </div>


                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <!-- referral -->
                    <fieldset>
                        <h2 class="fs-title">Referrals</h2>
                        <h3 class="fs-subtitle"></h3>
                        <hr>
                        <h3 align=left class="fs-subtitle">This is your opportunity to voice your choice of City Managers (Fellows) for your city for the upcoming year.<br>You've gone through the role compatibility screening and read about what it takes to be a fellow.<br><br>Keeping that in mind, fill in the following.
                        </h3>
                        <hr>
                        <input type="referral_user1_id" name="referral_user1_name" placeholder="Potential Fellowship/Mentorship Candidate 1" value="<?php //echo $user->name; ?>" required=""/>
                        <p align=left>Recommended Profile:</p>
                        <select id ="referral_role1_id" name="referral_role1_name" value ="">
                                 <option selected value="<?php //echo $user->sex; ?>">Roles</option>
                                 <option value=0>City Team Lead</option>
                                 <option value=8>Shelter Support Fellow</option>
                                 <option value=9>Ed Support Fellow</option>
                                 <option value=349>Transition Redainess and Aftercare Fellow</option>
                                 <option value=348>Shelter Operations Fellow</option>
                                 <option value=999>Fundraising Fellow</option>
                                 <option value=999>Human Capital Fellow</option>
                                 <option value=999>Foundations Fellow</option>
                                 <option value=999>Campaigns Fellow</option>
                                 <option value=8>Ed Support Mentor</option>
                        </select>
                        <br><br><hr>
                        <input type="referral_user2_id" name="referral_user2_name" placeholder="Potential Fellowship/Mentorship Candidate 2" value="<?php //echo $user->email; ?>" required=""/>
                        <p align=left>Recommended Profile:</p>
                        <select id ="referral_role2_id" name="referral_role2_name" value ="">
                                 <option selected value="<?php //echo $user->sex; ?>">Roles</option>
                                 <option value=0>City Team Lead</option>
                                 <option value=8>Shelter Support Fellow</option>
                                 <option value=9>Ed Support Fellow</option>
                                 <option value=349>Transition Redainess and Aftercare Fellow</option>
                                 <option value=348>Shelter Operations Fellow</option>
                                 <option value=999>Fundraising Fellow</option>
                                 <option value=999>Human Capital Fellow</option>
                                 <option value=999>Foundations Fellow</option>
                                 <option value=999>Campaigns Fellow</option>
                        </select>
                        <br><br><hr>
                        <input type="referral_user3_id" name="referral_user3_name" placeholder="Potential Fellowship/Mentorship Candidate 3" value = "<?php //echo $user->phone; ?>" required=""/>
                        <p align=left>Recommended Profile:</p>
                        <select id ="referral_role3_id" name="referral_role3_name" value ="">
                                 <option selected value="<?php //echo $user->sex; ?>">Roles</option>
                                 <option value=0>City Team Lead</option>
                                 <option value=8>Shelter Support Fellow</option>
                                 <option value=9>Ed Support Fellow</option>
                                 <option value=349>Transition Redainess and Aftercare Fellow</option>
                                 <option value=348>Shelter Operations Fellow</option>
                                 <option value=999>Fundraising Fellow</option>
                                 <option value=999>Human Capital Fellow</option>
                                 <option value=999>Foundations Fellow</option>
                                 <option value=999>Campaigns Fellow</option>
                        </select>
                        <br><br><hr>
                        <br><input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Preview"/>
                    </fieldset>

                    <fieldset>
                        <h2 class="fs-subtitle">Preview</h2>

                        <label class="label label-default" >Name:</label>
                        <input type="text" name="name" placeholder="Your Full Name" readonly="" value="<?php echo $_GET['name']; ?>"/>
                        <label class="label label-default" >Email:</label>
                        <textarea name="address" placeholder="Enter Your Address" readonly=""><?php echo $_GET['address']; ?></textarea>
                        <label class="label label-default" >Phone:</label>
                        <input type="text" name="phone" placeholder="Phone" value="<?php echo $_GET['phone']; ?>" readonly=""/>
                        <label class="label label-default" >Gender:</label>
                        <input type="text" name="fName" placeholder="" value="<?php echo $_GET['fName']; ?>" readonly=""/>
                        <label class="label label-default" ></label>
                        <textarea name="fUrl" readonly=""><?php echo $_GET['fUrl']; ?></textarea>
                        <h2 class="fs-subtitle"></h2>
                        <label class="label label-default" ></label>
                        <input type="text" name="pName" placeholder="" value="<?php echo $_GET['pName']; ?>" readonly=""/>
                        <label class="label label-default" ></label>
                        <textarea name="pUrl" readonly=""><?php echo $_GET['pUrl']; ?></textarea>
                        <label class="label label-default" ></label>
                        <input type="text" name="" placeholder="" value="<?php echo $_GET['price']; ?>" readonly=""/>
                        <label class="label label-default" ></label>
                        <input type="text" name="" placeholder="" value="<?php echo $_GET['bPrice']; ?>" readonly=""/>
                        <h2 class="fs-subtitle"></h2>
                        <label class="label label-default" ></label>
                        <input type="text" name="" placeholder="" value="<?php echo $_GET['bKashNumber']; ?>" readonly=""/>
                        <label class="label label-default" ></label>
                        <input type="text" name="transaction" placeholder="" value="<?php echo $_GET['transaction']; ?>" readonly=""/>
                        <label class="label label-default" ></label>
                        <input type="text" name="" placeholder="" value="<?php echo $_GET['ownBKash']; ?>" readonly=""/>
                        <label class="label label-default" >Comments:</label>
                        <textarea name="comment" placeholder="Comments" readonly=""><?php echo $_GET['comment']; ?></textarea>
                        <br><hr>
                        <br><input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>

                    <fieldset>
                        <h2 class="fs-title">Submit</h2>
                        <hr>
                        <h3 class="fs-subtitle">Thank You For Your Response</h3>
                        <hr>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="submit" name="submit" class="submit action-button" value="Submit"/>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- /.MultiStep Form -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
        <script>
          document.getElementById('role_preference').addEventListener('change', function () {
              var style = this.value == 0 ? 'block' : 'none';
              document.getElementById('hidden_div').style.display = style;
              });
        </script>


        <script  src="js/index.js"></script>

    </body>

</html>
