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

?>
<!DOCTYPE html>
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


<script>
  window.intercomSettings = {
    app_id: "xnngu157"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/xnngu157';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
</script>
