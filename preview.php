<?php

include ('db/config.php');

if(!isset($_POST['user_id'])){
  header('location:./');
}

$survey_form_check = false;
$preference_form_check = false;
$recommendation_form_check = false;
$referral_form_check = false;

//verify user details
$user_city_id  = $_POST['user_city_id'];
$user_id       = $_POST['user_id'];
$user_name     = $_POST['user_name'];
$user_email    = $_POST['user_email'];
$user_phone    = $_POST['user_phone'];
$user_sex      = $_POST['user_sex'];
$user_birthday = $_POST['user_birthday'];
$user_address  = $_POST['user_address'];
// $cont_status   = $_POST['cont_status'];
//update user details in User table

$sql->update('User', array(
                    'name' => $user_name,
                    'email' => $user_email,
                    'phone' => $user_phone,
                    'sex' => $user_sex,
                    'address' => $user_address,
                    'birthday' => $user_birthday,
                  ),'id='.$user_id);

//role compatibility survey
$survey_question = array();

if(isset($_POST['fellowship_self_analysis_2017'])){
  $user_self_analysis = array();
  $user_self_analysis = $_POST['fellowship_self_analysis_2017'];


  $survey_question_id = $_POST['survey_question_id'];

  //role compatibility survey add/update in SS_UserAnswer table
  if(!empty($user_self_analysis)) {
    $delete = $sql->remove('SS_UserAnswer','question_id='.$survey_question_id.' AND user_id='.$user_id);
    foreach ($user_self_analysis as $response) {
      if($response!=''){
        $insert = $sql->insert('SS_UserAnswer',array(
                          'question_id' => $survey_question_id,
                          'user_id' => $user_id,
                          'answer' => $response,
                          'survey_event_id' => 9,
                          'comment' => '',
                          'added_on' => date('Y-m-d H:i:s')
                        ));
        if($insert!=0){
          $survey_form_check = true;
        }
      }
    }
  }
}


// var_dump($survey_form_check);

//SignUp user group preference

$user_group_preference    = array();
if(isset($_POST['user_group_preference_name'])){
  $user_group_preference[0] = $_POST['user_group_preference_name'];

  $new_city_id = $_POST['fellow_move_city_id'];

  for($i=1;$i<=3;$i++){
    $user_group_preference[$i] = $_POST['fellow_prefernece'.$i.'_name'];
  }

  $query_user_group_preference_check="SELECT id FROM FAM_UserGroupPreference WHERE user_id=".$user_id;

  $check_data = $sql->getAll($query_user_group_preference_check);
  $check = array();
  foreach ($check_data as $data) {
    $check[] = $data['id'];
  }

  if(!empty($check)){
    $delete = $sql->remove('FAM_UserGroupPreference','id IN ('.implode(',',$check).')');
  }

  if($user_group_preference[0]!=0){
    $insert_pref = $sql->insert('FAM_UserGroupPreference',array(
                              'user_id' => $user_id,
                              'group_id' => $user_group_preference[0],
                              'preference' => 1,
                              'taskfolder_link' => '',
                              'city_id'   => $new_city_id,
                              'added_on'  => 'NOW()'
                          ));

    if($insert_pref!=0){
      $preference_form_check = true;
    }
  }
  else{
    $insert_array = array();
    for ($i=1; $i<=3; $i++) {
      if($user_group_preference[$i]!=''){
        $insert_pref = $sql->insert('FAM_UserGroupPreference',array(
                                  'user_id' => $user_id,
                                  'group_id' => $user_group_preference[$i],
                                  'preference' => $i,
                                  'taskfolder_link' => '',
                                  'city_id'   => $new_city_id,
                                  'added_on'  => 'NOW()'
                              ));
        if($insert_pref!=0){
          $preference_form_check = true;
        }
      }
    }
  }
}

//recommendation insert in FAM_Referral table

$recommendations = array();

for($i=1; $i<=3; $i++){
  $id = array();
  preg_match("|\d+|",$_POST['recommendation'.$i.'_name'],$id);

  if(empty($id)) continue;

  $recommendations[$i-1] = array(
    'referer_user_id' => $user_id,
    'referee_user_id' => $id[0],
    'group_id' => $_POST['recommendation'.$i.'_role_name'],
    'created_at' => date("Y-m-d H:i:s")
  );
}

if(!empty($recommendations)){
  $check_previous = $sql->getAll('SELECT id FROM FAM_Referral WHERE referer_user_id='.$user_id);
  if(!empty($check_previous)){
    $delete_ids = array();
    foreach ($check_previous as $entry) {
      $delete_ids[] = $entry['id'];
    }
    if(!empty($delete_ids)){
      $delete = $sql->execQuery('DELETE FROM FAM_Referral WHERE id IN ('.implode(',',$delete_ids).')');
    }
  }
}

foreach ($recommendations as $recommendation) {
  $insert_rec = $sql->insert('FAM_Referral',$recommendation);
  if($insert_rec!=0){
    $recommendation_form_check = true;
  }
}

?><!DOCTYPE html>
<html lang="en" >
  <head>
      <meta charset="UTF-8">
      <title>Fellowship Signup 2018</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- <meta http-equiv="refresh" content="10;URL='../../succession2018'" /> -->

      <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

      <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
      <link rel="icon" href="/favicon.ico" type="image/x-icon">
      <meta charset="UTF-8">
      <title>Fellowship Sign Up Form - Make A Difference</title>
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
  </head>

  <body>
    <div class="container">
        <h1 class="span12 fs-main-title text-center">Fellowship Sign Up</h1>
    </div>
    <!-- MultiStep Form -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form id="msform" action="preview.php" method="POST" novalidate>
              <fieldset>
                  <h2 class="fs-title">Response Recorded</h2><hr>
                  <h3 class="fs-subtitle">There you go Champ!<br />
                    You are all set for the adventure!!</h3>
                  <h3 class="fs-subtitle">
                    Wondering what's next? Check your inbox.
                  </h3>
                  <h3 class="fs-subtitle">All the best :)
                  </h3><hr>
                  <h3 class="fs-subtitle">Had another bright idea?</h3>
                  <a href="./"><input type="button" id="update" class="previous action-button-previous" value="Update Responses" href="./"></a>
                </fieldset>
            </form>
        </div>
      </div>
  </body>
</html>


<?php
require 'Email.php';

$email = new Email();
$email->images = [
                  'header' => 'img/email/header.jpg',
                  'top' => 'img/email/top.png',
                  'kc'  => 'img/email/kc.jpg',
                  'common_tasks'   => 'img/email/common_tasks.jpg',
                  'vertical' => 'img/email/vertical.jpg',
                  'pi'  => 'img/email/pi.jpg'
                ];
$email->html = <<<END
<html>
<head>
<title>Acknowledgement Email</title>

    <style type="text/css">
      td {
        font-family: 'Raleway',Helvetica,Arial,sans-serif;
        font-size: 13px;
        border: 0px;
      }
      .display-table {
        border-collapse:collapse;
        border: 1px solid #000;
        margin: 0 30px 0 30px;
      }
      .display-table td {
        padding: 5px;
      }

      p,h2,h3 {
        text-align:justify;
        padding:0 30px 0 30px ;
      }

      span,p{
        font-family: 'Raleway',Helvetica,Arial,sans-serif;
        font-size: 13px;
        line-height: 20px;
      }

      a,a.visited{
        text-decoration: none;
        color:#ed1849;
      }

      p img{
        width:100%;
      }

      h2{
        color: #569;
      }

      .color-red{
        color: #ed1849;
      }

      strong{
        font-weight: 700 !important;
      }

      img{
        border-radius: 5px;
      }

      span.caption{
        font-size: 10px;
      }
    </style>
</head>
<body>
<center>
<table width="590" bgcolor="F5F5F5" style="border-radius:5px; padding:0; margin-top:-10px;">
<tr><td height="300" bgcolor="#F5F5F5">
<img src="cid:%CID-header%"><br/>

<p><strong>Hello MADster,</strong></p>

<p>Congratulations on taking the first step towards your journey of transformation! A journey that pushes you out of your comfort zone. Makes a real difference in children's lives. And lets you learn and grow alongside MADsters like you across the country.</p>

<p>We're so excited to have you on board this MAD ride!</p>

<center><img src="cid:%CID-top%" width="400" /></center>

<h2>What's Next?</h2>

<p>The MAD Fellowship recruitment is designed not just for selection, but as an incredible learning experience in itself. There are multiple opportunities for you to grow and level up!  Let's take a closer look at these. </p>

<table class="display-table">
<tr><td><img src="cid:%CID-kc%" width="300" /></td>
<td>The <strong>Kindness Challenge</strong>, a MAD tradition, lets you reconnect with the spirit of selfless service and the joy of giving.</td></tr>
</table>

<p>At this first progression point, apart from your participation in the Kindness Challenge, we'll be taking your overall participation data into consideration. And why? Because over time, we've lost access to some shelters due to inconsistent support to children, for reasons ranging from teacher absenteeism to high substitution. </p>

<p>We keep the child at the centre of all that we do, striving to do whatever it takes, for as long as it takes. This makes availability and meaningful participation core components of continuing to positively impact the children we work with. </p>

<p>As you are primary movers of this goal, it's important that we evaluate your application against your consistency in MAD. If you're selected, you'll be invited to engage with the tasks below. </p>

<table class="display-table"><tr>
<td>The <strong>Common Tasks</strong> deepen your understanding of our work, while developing your mobilization and presentation skills</td>
<td><img src="cid:%CID-common_tasks%" width="300" /></td>
</tr><tr>
<td><img src="cid:%CID-vertical%" width="300" /></td>
<td>The <strong>Vertical Task</strong> helps you get a feel for the knowledge, skills, and perspectives you will build through each role. Spot a task that calls out to you? Go for it, and you might surprise yourself with finding your true calling!</td>
</tr></table>

<p>No matter what role you choose, you'll always be part of a larger team. A family that is co-created by all, for all. Which is why every voice counts! </p>

<p>This year, we'll reach out to the entire volunteer base to build a sharper image of each MADster we're engaging with, including you! Who's the cheerleader that keeps the team going? Who's the quiet doer who always goes the extra mile? What are some things we should know so we can build the best possible teams on ground? </p>

<p>Passed your tasks with flying colours? Then you'll be invited for the final round!</p>

<table class="display-table"><tr>
<td>Last but not least, your <strong>Personal Interview</strong> is a chance for you to have a mentoring conversation with the Directors, who are not only invested in your growth as a MADster but also as a confident individual beyond MAD :)</td>
<td><img src="cid:%CID-pi%" width="300" /></td>
</tr></table>

<p>This process has been carefully crafted to ensure the best mutual fit between you and the role. Put your best foot forward for the tasks, and show us what you've got! Based on your interests and performance, we'll be recommending you level up as a Fellow, Wingman or Mentor. Remember, it's about keeping our vision at the fore, growing into your best self, and optimizing your impact in the MAD collective!</p>

<p>Ready to learn and level up? Raring to go? Watch this space for more updates :) </p>


<p>Welcome on board this learning journey <br/>
All the very best!</p>

<p>For the Succession Planning team,<br />
Naveen Raj and Bharat Bhaskaran</p>

</td></tr>
<tr><td class="footer" style="color:#FFF;" height="70" align="center" valign="middle" bgcolor="#333132">&copy; 2017 <a style="color:#FFF" href="http://makeadiff.in">Make a Difference</a> | India </td></tr>
</table>
</center>
</body>
</html>
END;
$email->to = $user_email;
$email->from = "Succession, Make A Difference <succession@makeadiff.in>";
$email->subject = "MAD Fellowship Application";

$email->send();
?>

<script>
  window.intercomSettings = {
    app_id: "xnngu157"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/xnngu157';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
</script>
