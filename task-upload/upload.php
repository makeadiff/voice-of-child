<?php



include ('../db/config.php'); //Find the configuratio files in db/config.php

if(!isset($_POST['user_id'])){
  header('location:./');
}

include '../../fam/models/FAM.php';

$fam = new FAM;

$verticals = [
  '2'   => "City Team Lead",
  '19'  => "Ed Support",
  '378' => "Aftercare",
  '272' => "Transition Readiness",
  '370' => "Fundraising",
  '269' => "Shelter Operations",
  '4'   => "Shelter Support",
  '5'   => "Human Capital",
  '15'  => "Finance",
  '11'  => "Campaigns and Communications",
  '375' => "Foundational Programme",
];

$profiles_applied_for = $fam->getApplications($user_id);
$inserted = 0;

// dump($_POST);
// dump($_FILES);
// exit;

$group_preference_1 = '';
$group_preference_2 = '';
$group_preference_3 = '';


$vertical_video_task_url_1 = '';
$vertical_video_task_url_2 = '';
$vertical_video_task_url_3 = '';

$common_task_url    = $_POST['common_task_url'];

if(isset($_POST['group_id_1'])){
  $group_preference_1 = $_POST['group_id_1'];
}
if(isset($_POST['group_id_2'])){
  $group_preference_2 = $_POST['group_id_2'];
}
if(isset($_POST['group_id_3'])){
  $group_preference_3 = $_POST['group_id_3'];
}



if(isset($_POST['vertical_task_url_1'])){
  $vertical_video_task_url_1 = $_POST['vertical_task_url_1'];
}
if(isset($_POST['vertical_task_url_2'])){
  $vertical_video_task_url_2 = $_POST['vertical_task_url_2'];
}
if(isset($_POST['vertical_task_url_3'])){
  $vertical_video_task_url_3 = $_POST['vertical_task_url_3'];
}


$task_files_1 = '';
$task_files_2 = '';
$task_files_3 = '';

$data = [
    'user_id'                     => $user_id,
    'common_task_url'             => $common_task_url,
    'added_on'                    => 'NOW()',
    'preference_1_group_id'       => $group_preference_1,
    'preference_1_task_files'     => '',
    'preference_1_video_files'    => $vertical_video_task_url_1,
    'preference_2_group_id'       => $group_preference_2,
    'preference_2_task_files'     => '',
    'preference_1_video_files'    => $vertical_video_task_url_1,
    'preference_3_group_id'       => $group_preference_3,
    'preference_3_task_files'     => '',
    'preference_1_video_files'    => $vertical_video_task_url_1
  ];

for($j=0;$j<3;$j++){
  if(!isset($_FILES['task_'.($j+1)])){
    continue;
  }
  $totalFiles = count($_FILES["task_".($j+1)]["name"]);
  for($k=0;$k<$totalFiles;$k++){
    if($_FILES["task_".($j+1)]["name"][$k]==''){
      continue;
    }
    $city_name = getCity($user['city_id'],$sql);
    $target_dir = '../tasks/'.$city_name.'/'.$verticals[$_POST['group_id_'.($j+1)]].'/';
    if (!is_dir($target_dir.$user['name'])) {
      mkdir($target_dir.$user['name'], 0777, true);
    }
    $target_dir .= $user['name'].'/';
    $target_file = $target_dir .str_replace(' ','_',$user['name']).'_'.str_replace(' ','_',$verticals[$_POST['group_id_'.($j+1)]]).'_'.str_replace(' ','_',basename($_FILES["task_".($j+1)]["name"][$k]));

    // dump($target_file);

    $uploadOk = 1;

    if($_SERVER['HTTP_HOST'] == 'makeadiff.in'){
      $parent = 'http://makeadiff.in/apps/fellowship-signup';
    }
    else{
      $parent = 'http://localhost/makeadiff/apps/fellowship-signup';
    }

    if (move_uploaded_file($_FILES["task_".($j+1)]["tmp_name"][$k], $target_file)) {
    $data['preference_' . ($j+1) . '_task_files'] .= $parent.str_replace(' ','%20',str_replace('../','/',$target_file)).', ';

    } else {
        echo "Sorry, there was an error uploading your file. <br/>".PHP_EOL;
    }
  }
}

// dump($data);
$check_entry = $sql->getOne('SELECT id FROM FAM_UserTask WHERE user_id='.$user_id);
if($check_entry == ''){
  $inserted = $sql->insert("FAM_UserTask", $data);
}
else{
  $inserted = $sql->update("FAM_UserTask", $data,'id='.$check_entry);
}


// $query_task_show = 'SELECT *
//                     FROM FAM_UserTask
//                     INNER JOIN `Group` WHERE
//                     WHERE user_id='.$user_id)

?>



<!DOCTYPE html>
<html lang="en" >
  <head>
      <meta charset="UTF-8">
      <title>Fellowship Task Upload 2018</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- <meta http-equiv="refresh" content="10;URL='../../succession2018'" /> -->

      <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

      <link rel="stylesheet" href="../css/style.css">

      <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
      <link rel="icon" href="/favicon.ico" type="image/x-icon">
      <meta charset="UTF-8">
      <title>Fellowship Task Upload - Make A Difference</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
      <link rel="shortcut icon" href="/var/www/html/SignUpForm/favicon.png" type="image/png">
      <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">

      <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700,400,400italic' rel='stylesheet' type='text/css'>
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Titillium+Web:400,600,700,900|Ubuntu:400,500,700" rel="stylesheet">
  </head>

  <body>
    <div class="container">
        <h1 class="span12 fs-main-title text-center">Fellowship Task Upload</h1>
    </div>
    <!-- MultiStep Form -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form id="msform" action="preview.php" method="POST" novalidate>
              <fieldset>
                  <h2 class="fs-title">Files Uploaded</h2><hr>
                  <h3 class="fs-subtitle">There you go Champ!<br />
                    You are all set for the adventure!!
                  </h3>
                  <h3 class="fs-subtitle">All the best :)
                  </h3><hr>
                  <!-- <a href="./"><input type="button" id="update" class="previous action-button-previous" value="Update Responses" href="./"></a> -->
                </fieldset>
            </form>
        </div>
      </div>
  </body>
</html>
