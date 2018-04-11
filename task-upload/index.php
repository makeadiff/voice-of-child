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

$profiles_applied_for = $fam->getApplications(101983); // :DEBUG: should be $user_id
$inserted = 0;

if(i($QUERY, 'action') == 'Submit') {
  $data = [
    'user_id'           => $user_id,
    'common_task_url'   => i($QUERY, 'common_task_url'),
    'added_on'          => 'NOW()'
  ];
  for($i = 1; $i <= 3; $i++) {
    $group_id = i($QUERY, 'group_id_' . $i);
    if(!$group_id) continue;

    list($file, $error) = upload('task_' . $i, 'uploads', 'doc,docx,txt,rtf');
    if(!$error) {
      $data['preference_' . $i . '_group_id'] = $group_id;
      $data['preference_' . $i . '_task_file'] = $file;
    }
  }
  $inserted = $sql->insert("FAM_UserTask", $data);
}
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
<link rel="shortcut icon" href="../favicon.png" type="image/png">
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
        <form id="msform" method="POST" enctype="multipart/form-data">
            <fieldset style="text-align: left;">
                <h2 class="fs-title">Hi <?php echo $user['name']; ?>!</h2><hr>

                <?php if($inserted) { ?>
                <span class="alert alert-success">Your tasks have been submitted. Best of luck!</span>

                <?php } else { ?>
                Common Task<br />
                <input type="text" name="common_task_url" placeholder="Link To Video" required="required" />

                <?php 
                $count = 0;
                foreach ($profiles_applied_for as $prof) {
                  $count++; ?>
                  Preference <?php echo $prof['preference'] ?>: <?php echo $verticals[$prof['group_id']]; ?><br />
                  <input type="file" name="task_<?php echo $count ?>"  required="required" /><br />
                  <input type="hidden" name="group_id_<?php echo $count ?>" value="<?php echo $prof['group_id']; ?>" />
                <?php } ?>

                <input type="submit" value="Submit" name="action" class="btn btn-primary" />
                <?php } ?>
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
