<?php
include ('../db/config.php'); //Find the configuratio files in db/config.php

include '../../fam/models/FAM.php';


$query_task_show = 'SELECT *
                    FROM FAM_UserTask
                    WHERE user_id='.$user_id;

$tasks = $sql->getList($query_task_show);
// dump($tasks);

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


$selectQuery = ""

?>

<!DOCTYPE html>
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
                </ul>

                <hr>
                <?php if($inserted) { ?>
                <span class="alert alert-success">Your tasks have been submitted. Best of luck!</span>

                <?php } else { ?>
                <p class="form-label"><strong>Common Task</strong></p>
                <p class="form-info">Please ensure you correctly paste the link to your Video that you uploaded on Google Drive</p>
                <input type="text" id="common_task_url" name="common_task_url" placeholder="Link To Video" required="required"
                  <?php if($tasks!='' && $tasks[2]!="") echo 'value="'.$tasks[2].'";'?>
                />
                <!-- <input type="submit" value="Save" name="action" class="submit action-button" /> -->
                <hr>
                <?php
                $count = 0;
                foreach ($profiles_applied_for as $prof) {
                  $count++;
                ?>
                  <p class="form-label">Fellowship Preference <?php echo $prof['preference'] ?>: <strong><?php echo $verticals[$prof['group_id']]; ?></strong> </p>
                  <p class="form-label" id="task_label_<?php echo $count ?>">
                    <input type="button" class="action-button-file" id="loadFileXml" value="Select File" onclick="document.getElementById('file_<?php echo $count ?>').click();" <?php if($tasks!='' && $tasks[($count+1)*2+($count-1)]!="") echo 'disabled'?> />
                    <span class="file_name_label" id="file_name_label_<?php echo $count ?>"></span>
                  </p>
                  <?php
                    if($tasks!='' && $tasks[($count+1)*2+($count-1)]!=""){
                      $task_files = explode(', ',$tasks[($count+1)*2+($count-1)]);
                      foreach($task_files as $key => $t){
                        if($t!='')
                        echo '<p class="form-label link"><a target="_blank" href="'.$t.'">Task File '.($key+1).'</a></p>';
                      }
                    }
                  ?>
                  <p class="form-info">Incase your task has a video attachment to it, please copy and paste the link here.</p>
                  <input type="file" id="file_<?php echo $count ?>" name="task_<?php echo $count ?>[]" class="file hidden" multiple accept="application/msword,application/msexcel,application/pdf,application/rtf,image/jpeg,image/tiff,image/x-png,text/plain"/>
                  <input type="text" name="vertical_task_url_<?php echo $count ?>" id="vertical_task_url_<?php echo $count ?>" placeholder="Link To Video" />
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
