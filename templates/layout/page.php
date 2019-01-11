<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Voice of Child</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="shortcut icon" href="<?php echo $config['site_home'] ?>favicon.png" type="image/png">
        <link rel="stylesheet" href="<?php echo $config['site_home'] ?>css/style.css">
        <link rel="stylesheet" href="<?php echo $config['site_home'] ?>css/jquery.tagsinput.css">
        <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">

        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700,400,400italic' rel='stylesheet' type='text/css'>
  			<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  			<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Titillium+Web:400,600,700,900|Ubuntu:400,500,700" rel="stylesheet">

        <style>

            .choice {
                float: right;
                display: inline;
                margin-left: 3em;
            }
            .choice input {
                vertical-align: left;
            }

            .row{
              float: none !important
            }

        </style>
    </head>

    <body>

      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="./index.php"> <img src="<?php echo $config['site_home'] ?>/img/icon.png" width="20px"/> &nbsp; Voice of Child</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo $config['site_home'] ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actions <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo $config['site_home'] ?>add-comment.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Comment</a></li>
                  <li><a href="<?php echo $config['site_home'] ?>index.php"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Comments</a></li>
                  <!-- <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">One more separated link</a></li> -->
                </ul>
              </li>
              <li><a href="<?php echo $config['site_url'] ?>madapp/index.php/auth/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <?php include($GLOBALS['template']->template); ?>

    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src='https://code.jquery.com/ui/1.10.4/jquery-ui.js'></script>
    <script src="<?php echo $config['site_home'] ?>js/index.js"></script>
    <script src="<?php echo $config['site_home'] ?>js/jquery.tagsinput.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script>
      $('#tags').tagsInput();

      $('#tags').tagsInput({
        autocomplete_url:'http://myserver.com/api/autocomplete'
      });    
    </script>


</html>

<script>
  window.intercomSettings = {
  app_id: "xnngu157"
  };
</script>

<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/xnngu157';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
</script>
