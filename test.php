<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Retention and Sign Up Form||Order Form</title>
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
                        <li>Submit</li>
                        <li>Preview</li>
                        </ul>
                    <!-- fieldsets -->


                    <!-- referral -->
                    <fieldset>
                        <h2 class="fs-title">Referrals</h2>
                        <h3 class="fs-subtitle"></h3>
                        <hr>
                        <h3 align=left class="fs-subtitle">This is your opportunity to voice your choice of City Managers (Fellows) for your city for the upcoming year.<br>You've gone through the role compatibility screening and read about what it takes to be a fellow.<br><br>Keeping that in mind, fill in the following.
                        </h3>
                        <hr>
                        <input type="text" name="name" placeholder="Potential Fellowship/Mentorship Candidate 1" value="<?php //echo $user->name; ?>" required=""/>
                        <p align=left>Recommended Profile:</p>
                        <select id ="role_preference" name="roles" value ="">
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
                        <input type="email" name="email" placeholder="Potential Fellowship/Mentorship Candidate 2" value="<?php //echo $user->email; ?>" required=""/>
                        <p align=left>Recommended Profile:</p>
                        <select id ="role_preference" name="roles" value ="">
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
                        <input type="text" name="phone" placeholder="Potential Fellowship/Mentorship Candidate 3" value = "<?php //echo $user->phone; ?>" required=""/>
                        <p align=left>Recommended Profile:</p>
                        <select id ="role_preference" name="roles" value ="">
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
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>



                </form>
            </div>
        </div>
        <!-- /.MultiStep Form -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script>
          document.getElementById('role_preference').addEventListener('change', function () {
              var style = this.value == 0 ? 'block' : 'none';
              document.getElementById('hidden_div').style.display = style;
              });
        </script>



        <script  src="js/index.js"></script>

    </body>

</html>
