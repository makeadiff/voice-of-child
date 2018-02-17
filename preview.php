
<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Retention and Succession Form||Preview</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

        <link rel="stylesheet" href="css/style.css">

        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">


    </head>

    <body>
      <div class="container">
          <h1 class="span12 fs-main-title text-center">Retention and Succession Form</h1>
      </div>
      <!-- MultiStep Form -->
      <div class="row">
          <div class="col-md-6 col-md-offset-3">
              <form id="msform" action="preview.php" method="POST" novalidate>

            <fieldset>
                <h2 class="fs-title">Response Recorded</h2><hr>
                <h3 class="fs-subtitle">Thank You</h3><hr>
              </fieldset>
          </form>
      </div>
  </div>


    </body>



<?php
//print_r($_POST);

$db_host = '127.0.0.1';
$db_username = 'root';
$db_password = 'root@1234';
$db_name = 'makeadiff_madapp';
$dbhandle = mysqli_connect( $db_host, $db_username, $db_password,$db_name)
          or die("Couldn't connect to SQL Server on $db_host");


//verify user details
$user_city_id  = $_POST['user_city_id'];
$user_id       = $_POST['user_id'];
$user_name     = $_POST['user_name'];
$user_email    = $_POST['user_email'];
$user_phone    = $_POST['user_phone'];
$user_sex      = $_POST['user_sex'];
$user_birthday = $_POST['user_birthday'];
$user_address  = $_POST['user_address'];
$cont_status   = $_POST['cont_status'];
//update user details in User table
$query_update_user="UPDATE User
                    SET name ='".$user_name."',
                        email ='".$user_email."',
                        phone =".$user_phone.",
                        sex ='".$user_sex."',

                        address ='".$user_address."'
                    WHERE id =".$user_id;

mysqli_query($dbhandle,$query_update_user) or die(mysqli_error($dbhandle));


//role compatibility survey
$survey_question     = array();
$survey_question[0]  = $_POST['survey_question_7'];
$survey_question[1]  = $_POST['survey_question_8'];
$survey_question[2]  = $_POST['survey_question_9'];
$survey_question[3]  = $_POST['survey_question_10'];
$survey_question[4]  = $_POST['survey_question_11'];
$survey_question[5]  = $_POST['survey_question_12'];
$survey_question[6]  = $_POST['survey_question_14'];
$survey_question[7]  = $_POST['survey_question_15'];
$survey_question[8]  = $_POST['survey_question_16'];
$survey_question[9]  = $_POST['survey_question_17'];
$survey_question[10] = $_POST['survey_question_18'];
$survey_question[11] = $_POST['survey_question_19'];
$survey_question[12] = $_POST['survey_question_20'];

//role compatibility survey add/update in SS_UserAnswer table
for($qid=0;$qid<13;$qid++)
     {if(!$survey_question[$qid]) continue;
      $query_survey_check="SELECT * FROM SS_UserAnswer WHERE user_id=".$user_id." AND question_id=".($qid+7);
      $result_survey_check= mysqli_query($dbhandle,$query_survey_check) or die(mysqli_error($dbhandle));
      if(!$result_survey_check||mysqli_num_rows($result_survey_check)==0)
            {$query_survey_insert="INSERT INTO SS_UserAnswer (question_id,user_id,answer,survey_event_id,comment)
                                               VALUES(".($qid+7).",".$user_id.",".$survey_question[$qid].",7,'')";
             mysqli_query($dbhandle,$query_survey_insert) or die(mysqli_error($dbhandle));
             }
      else
            {$query_survey_update="UPDATE SS_UserAnswer
                                SET question_id =".($qid+7).",
                                    user_id = ".$user_id.",
                                    answer = ".$survey_question[$qid]."
                                WHERE id = ".$user_id." AND question_id =".($qid+7);
             mysqli_query($dbhandle,$query_survey_update) ;
            }
      }
//or die(mysqli_error($dbhandle))

//SignUp user group preference
$user_group_preference    = array();
$user_group_preference[0] = $_POST['user_group_preference_name'];
$user_group_preference[1] = $_POST['fellow_prefernece1_name'];
$user_group_preference[2] = $_POST['fellow_prefernece2_name'];
$user_group_preference[3] = $_POST['fellow_prefernece3_name'];

//SignUp user group preference insert/update in FAM_UserGroupPreference
$query_user_group_preference_check="SELECT * FROM FAM_UserGroupPreference WHERE user_id=".$user_id;
$result_user_group_preference_check= mysqli_query($dbhandle,$query_user_group_preference_check) or die(mysqli_error($dbhandle));
if(!$result_user_group_preference_check||mysqli_num_rows($result_user_group_preference_check)!=0)
    {$query_user_group_preference_delete="DELETE FROM FAM_UserGroupPreference WHERE user_id=".$user_id;
    mysqli_query($dbhandle,$query_user_group_preference_delete) or die(mysqli_error($dbhandle));
    }

$query_user_group_preference = array();
$query_user_group_preference[0]="INSERT INTO FAM_UserGroupPreference (user_id,group_id,continuation_status,preference,taskfolder_link)
                                 VALUES (".$user_id.",".$user_group_preference[0].",".$cont_status.",'1','')";
for($i=1;$i<4;$i++)
   {if(!$user_group_preference[$i]) continue;
     $query_user_group_preference[$i]="INSERT INTO FAM_UserGroupPreference (user_id,group_id,continuation_status,preference,taskfolder_link)
                                     VALUES (".$user_id.",".$user_group_preference[$i].",".$cont_status.",'".$i."','')";}

if($user_group_preference[0])
{if($user_group_preference[0]!=0)
   {mysqli_query($dbhandle,$query_user_group_preference[0]) or die(mysqli_error($dbhandle));}
else
   {for($l=1;$l<4;$l++)
         {mysqli_query($dbhandle,$query_user_group_preference[$l]) or die(mysqli_error($dbhandle));}
    }
}
//recommendation
$recommendation         = array();
$recommendation_userid  = array();
$recommendation_role    = array();

preg_match("|\d+|",$_POST['recommendation1_name'],$recommendation[0]);
$recommendation_userid[0] = $recommendation[0][0];
$recommendation_role[0]   = $_POST['recommendation1_role_name'];

preg_match("|\d+|",$_POST['recommendation2_name'],$recommendation[1]);
$recommendation_userid[1] = $recommendation[1][0];
$recommendation_role[1]   = $_POST['recommendation2_role_name'];

preg_match("|\d+|",$_POST['recommendation3_name'],$recommendation[2]);
$recommendation_userid[2] = $recommendation[2][0];
$recommendation_role[2]   = $_POST['recommendation3_role_name'];

//recommendation insert in FAM_Referral table
 $query_recommendation = array();
 for($j=0;$j<3;$j++)
    {if (!$recommendation_userid[$j]) continue;
      $query_recommendation[$j] = "INSERT INTO FAM_Referral (referrer_user_id,referee_user_id,group_id)
                                  VALUES (".$user_id.", ".$recommendation_userid[$j].", ".$recommendation_role[$j].")";
     mysqli_query($dbhandle,$query_recommendation[$j])or die(mysqli_error($dbhandle).$query_recommendation[$j]);
     }

//referral
$referral_name    = array();
$referral_email   = array();
$referral_phone   = array();

$referral_name[0]  = $_POST['referral1_name'];
$referral_email[0] = $_POST['referral1_email'];
$referral_phone[0] = $_POST['referral1_phone'];

$referral_name[1]  = $_POST['referral2_name'];
$referral_email[1] = $_POST['referral2_email'];
$referral_phone[1] = $_POST['referral2_phone'];

$referral_name[2]  = $_POST['referral3_name'];
$referral_email[2] = $_POST['referral3_email'];
$referral_phone[2] = $_POST['referral3_phone'];

//referral insert in User table
 $query_referral=array();
 for($k=0;$k<3;$k++)
     {if (!$referral_name[$k]) continue;
       $query_referral[$k]="INSERT INTO FAM_Join (referrer_user_id,name,email,phone)
                            VALUES(".$user_id.",'".$referral_name[$k]."','".$referral_email[$k]."',".$referral_phone[$k].")";
       mysqli_query($dbhandle,$query_referral[$k]) or die(mysqli_error($dbhandle).$query_referral[$k]);
      }


?>
