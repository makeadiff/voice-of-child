<?php
include ('../db/config.php'); //Find the configuratio files in db/config.php

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

$external_entry = false;

if(isset($_GET['user_id'])){
  $external_entry = true;
}
else{
  $external_entry = false;
}

$selectQuery = ""

?><!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Fellowship Task Upload Form 2018 - Make A Difference</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="shortcut icon" href="../../../favicon.ico" type="image/png">
<link rel="stylesheet" href="../css/style.css">
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

<div class="container">
    <h1 class="span12 fs-main-title text-center">Fellowship Task Upload</h1>
</div>
<!-- MultiStep Form -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form id="msform" method="POST" action="./upload.php" enctype="multipart/form-data" onsubmit="return validate_upload()">
            <fieldset>
                <input type='text' name="user_id" class="hidden" value= "<?php echo $user['id'] ?>"/>
                <h2 class="fs-title">Hi <?php echo $user['name']; ?>! </h2>
                <hr>
                <p class="form-label">Done with your tasks? That’s awesome!  Before you upload your tasks, read the guidelines below!</p>
                <p class="form-label"><strong>What do you upload?</strong></p>
                <ul>
                  <li>
                    <p class="form-label">
                      You can upload your common and vertical tasks here at once or at different times. Remember that the Common and 1st preference vertical tasks have to be uploaded by 16th, second by the 19th and third by the 22nd of April.
                    </p>
                  </li>
                  <li>
                    <p class="form-label">
                      Example: Initially you can submit your common and first preference task on the 14th and then come back on the 17th for the other preferences.
                    </p>
                  </li>
                  <li>
                    <p class="form-label">
                      Accepted formats: Word documents, PDFs, videos and Excel sheets.
                    </p>
                  </li>

                  <li>
                    <p class="form-label">
                      You can upload multiple files for each section: While selecting the files from your PC, select all the files you want to upload for that particular task.
                    </p>
                  </li>
                </ul>

                <p class="form-label"><strong>How can you upload?</strong></p>
                <ul>
                  <li>
                    <p class="form-label">
                      For videos, upload them to your google drive or youtube and paste the link on the form! Don’t forget to check the sharing settings to: ‘anyone with link can view’. Or your evaluators can’t access them.
                    </p>
                  </li>
                  <li>
                    <p class="form-label">
                      All other formats, you can use the upload button to put up the actual document in the respective sections
                    </p>
                  </li>
                  <li>
                    <p class="form-label">
                      Confirm before submitting: Is it the right file? Does the file have the right content? You won’t be able to change your entry once uploaded.
                    </p>
                  </li>
                  <li>
                    <p class="form-label">
                      Incase of any queries, reach out to us at <strong>fellowship@makeadiff.in</strong>
                    </p>
                  </li>
                </ul>

                <hr>
                <?php if($inserted) { ?>
                  <span class="alert alert-success">Your tasks have been submitted. Best of luck!</span>
                <?php } else { ?>
                  <p class="form-label"><strong>Common Task</strong></p>
                <?php if(i($tasks, 'common_task_url')){?>
                  <div style="width:100%; height:50px; margin-top: 5px; display: block;">
                    <p class="form-label"><strong>You have successfully uploaded your tasks</strong>. Click on the link below to see what you uploaded.</p>
                    <p class="form-label">
                      <?php
                        $url = str_replace(' ','',str_replace(', ','',$tasks['common_task_url']));
                        $common_task = explode('http',$url);
                        foreach ($common_task as $c_link) {
                          if($c_link!=''){
                      ?>
                            <a target="_blank" class="badge badge-primary" href="<?php echo 'http'.$c_link ?>">Common Task Video Link</a>
                      <?php
                          }
                        }
                      ?>
                    </p>
                  </div>
                <?php }else{ ?>
                  <p class="form-info">Please ensure you correctly paste the link to your Video that you uploaded on Google Drive</p>
                  <input type="text" id="common_task_url" name="common_task_url" placeholder="Link To Video" />
                <?php }?>
                <label class="error" id="ct_url" for="common_task_url"></label>
                <!-- <input type="submit" value="Save" name="action" class="submit action-button" /> -->
                <hr>
                <?php
                $count = 0;
                foreach ($profiles_applied_for as $prof) {
                  if($prof['group_id']==0){
                    continue;
                  }
                  $count++;
                  $task_file = $fam->getTask($user_id, 'vertical', $prof['group_id']);
                  $task_video = $fam->getTask($user_id, 'vertical_video_task', $prof['group_id']);
                ?>
                  <p class="form-label">Fellowship Preference <?php echo $prof['preference'] ?>:
                      <strong><?php echo $verticals[$prof['group_id']]; ?></strong> </p>
                  <?php

                    if($task_file) {
                      echo '<p class="form-label"><strong>You have successfully uploaded your tasks</strong>. Click on the links below to see what you uploaded.</p>
                            <p class="form-label">';
                      $task = explode('http',str_replace(', ','',$task_file));
                      $i=0;
                      foreach ($task as $file) {
                        if($file!=''){
                          $i++;


                  ?>
                           <a target="_blank" class="badge badge-info" href="<?php echo 'http'.$file ?>"><?php echo $verticals[$prof['group_id']].' Task '.($i); ?></a>
                  <?php
                        }
                      }
                      echo '</p>';
                  ?>
                    <p class="form-label" id="task_label_<?php echo $count ?>">
                      <input type="button" class="action-button-file" id="loadFileXml" value="Add More Files" onclick="document.getElementById('file_<?php echo $count ?>').click();" />
                      <span class="file_name_label" id="file_name_label_<?php echo $count ?>"></span>
                    </p>
                  <?php
                    }
                    else{
                  ?>
                  <p class="form-label" id="task_label_<?php echo $count ?>">
                    <input type="button" class="action-button-file" id="loadFileXml" value="Select File" onclick="document.getElementById('file_<?php echo $count ?>').click();" <?php if($task_file) echo 'disabled'?> />
                    <span class="file_name_label" id="file_name_label_<?php echo $count ?>"></span>
                  </p>
                  <?php
                    }
                  ?>
                  <?php if($task_video){?>
                    <p class="form-label">
                      <a target="_blank" class="badge badge-primary"href="<?php echo $task_video ?>"><?php echo $verticals[$prof['group_id']]; ?> Video Link</a>
                    </p>
                  <?php }else{ ?>
                    <p class="form-info">Incase your task has a video attachment to it, please copy and paste the link here.</p>
                    <input type="text" name="vertical_task_url_<?php echo $count ?>" id="vertical_task_url_<?php echo $count ?>" placeholder="Link To Video" />
                  <?php }?>

                  <input type="file" id="file_<?php echo $count ?>" name="task_<?php echo $count ?>[]" class="file hidden" multiple accept="application/msword,application/msexcel,application/pdf,application/rtf,image/jpeg,image/tiff,image/x-png,text/plain,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"/>

                  <input type="hidden" name="group_id_<?php echo $count ?>" value="<?php echo $prof['group_id']; ?>" />
                  <!-- <input type="submit" value="Save" name="action" class="submit action-button" /> -->
                  <hr>
                <?php } ?>


                <?php } ?>
                <input type="submit" value="Save" name="action" class="submit action-button" />
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
<script  src="../js/index.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


</body>

</html>

<script>
window.intercomSettings = {
app_id: "xnngu157"
};
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/xnngu157';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
</script>
