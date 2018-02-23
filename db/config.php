<?php
  // var_dump(session_status());
  include ('../../common.php');
  // exit;
  $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

  if(!isset($_SESSION['user_id'])){
    if($_SERVER['HTTP_HOST'] == 'makeadiff.in'){
      $link = 'http://makeadiff.in/madapp/index.php/auth/login/'.base64_encode($url);
    }
    else{
      $link = 'http://localhost/makeadiff/madapp/index.php/auth/login/' . base64_encode($url);
    }
    header('Location:'.$link);
  }

  $user_id = $_SESSION['user_id'];

  $test = false;

  if(isset($_GET['test_city'])){
    $user_id = $sql->getOne('SELECT User.id as id from User
                             INNER JOIN City ON City.id = User.city_id
                             WHERE City.name ="'.$_GET['test_city'].'"
                              AND User.status = 1
                              AND User.user_type="volunteer"');
    $test = true;
  }


  $db = $config_data['db_database'];
  $db_host = $config_data['db_host'];
  $db_name = $config_data['db_user'];
  $db_pass = $config_data['db_password'];

  $query_user= "SELECT * FROM User WHERE id = ".$user_id;

  createTables($sql); //Function to Create Tables, if not exits

  $user = $sql->getAll($query_user);
  $user = $user[0];

  // if($test){
  //
  // }

  //Query to get all user from city for referral
  $query_all_users ="SELECT
                      User.id,
                      User.name AS user_name,
                      City.name AS city_name
                     FROM User
                     INNER JOIN City ON City.id= User.city_id
                     INNER JOIN UserGroup as UG on UG.user_id = User.id
                     WHERE user_type = 'volunteer'
                      AND status = 1
                      AND UG.year = 2017
                      AND User.city_id = ".$user['city_id'].'
                     GROUP BY User.id';

  $all_users = $sql->getAll($query_all_users);

  $volunteer= array();
  foreach ($all_users as $users) {
    $volunteer[] = $users['user_name'].' / '.$users['id'];
  }

  //Query to get all questions and answer from survey table

  $survey_id = $sql->getOne('SELECT id from SS_Survey_Event WHERE (name LIKE "%Retention%" OR name LIKE "%Succession%")');
  // $survey_id = 7;
  // $id = create_survey($sql){}

  $query_qna="SELECT
                question_id,
                question,
                SS_Answer.id AS answer_id,
                answer
              FROM SS_Answer
              INNER JOIN SS_Question ON SS_Answer.question_id=SS_Question.id
              WHERE survey_event_id = ".$survey_id."
              AND question<>'Are you planning to continue with MAD in 2018-19?'
              ORDER BY question_id,level ASC";

  $result = $sql->getAll($query_qna);
  //Roles query

  $query_roles_fellow="SELECT * from `Group` WHERE type='fellow' AND group_type='normal' AND status=1";
  $fellow_roles_data = $sql->getAll($query_roles_fellow);

  $roles = array();
  $i=0;


  // 'CITY ROLE PREFERENCE CHECKS'
  $check=array();

  $check['foundations_city'] = array(
    '"Bangalore"',
    '"Chennai"',
    '"Coimbatore"',
    '"Delhi"',
    '"Mumbai"',
    '"Mysore"'); //Foundtions Fellow and Volunteer City Check
  $check['tr_fellow_city'] = array(
    '"Ahmedabad"',
    '"Bangalore"',
    '"Chandigarh"',
    '"Chennai"',
    '"Coimbatore"',
    '"Delhi"',
    '"Mumbai"',
    '"Nagpur"',
    '"Pune"',
    '"Trivandrum"',
    '"Vellore"',
    '"Vijayawada"'); //Transition Readiness Fellow Check
  $check['a_fellow_city'] = array(
    '"Bangalore"',
    '"Chennai"',
    '"Cochin"',
    '"Coimbatore"',
    '"Delhi"',
    '"Hyderabad"',
    '"Kolkata"',
    '"Lucknow"',
    '"Mangalore"',
    '"Mumbai"',
    '"Mysore"',
    '"Vellore"',
    '"Vijayawada"'); //Aftercare Fellow City Check
  $check['a_wingman_city'] = array(
    '"Ahmedabad"',
    '"Bangalore"',
    '"Bhopal"',
    '"Chandigarh"',
    '"Chennai"',
    '"Cochin"',
    '"Coimbatore"',
    '"Delhi"',
    '"Hyderabad"',
    '"Kolkata"',
    '"Lucknow"',
    '"Mangalore"',
    '"Mumbai"',
    '"Mysore"',
    '"Nagpur"',
    '"Pune"',
    '"Trivandrum"',
    '"Vellore"',
    '"Vijaywada"'); //Aftercare Wingman City Check
  $check['a_asv_city'] = array(
    '"Ahmedabad"',
    '"Bangalore"',
    '"Chandigarh"',
    '"Chennai"',
    '"Cochin"',
    '"Coimbatore"',
    '"Delhi"',
    '"Hyderabad"',
    '"Kolkata"',
    '"Lucknow"',
    '"Mangalore"',
    '"Mumbai"',
    '"Mysore"',
    '"Nagpur"',
    '"Pune"',
    '"Trivandrum"',
    '"Vellore"',
    '"Vijaywada"'); //Aftercare ASV City Check
  $check['tr_wingman_city'] = array(
    '"Ahmedabad"',
    '"Bangalore"',
    '"Chandigarh"',
    '"Chennai"',
    '"Coimbatore"',
    '"Delhi"',
    '"Mumbai"',
    '"Nagpur"',
    '"Pune"',
    '"Trivandrum"',
    '"Vellore"',
    '"Vijaywada"'); //Transition Readiness Wingman City Check
  $check['tr_asv_city'] = array(
    '"Ahmedabad"',
    '"Bangalore"',
    '"Chandigarh"',
    '"Chennai"',
    '"Coimbatore"',
    '"Delhi"',
    '"Mumbai"',
    '"Nagpur"',
    '"Pune"',
    '"Trivandrum"',
    '"Vellore"',
    '"Vijaywada"'); //Transition Readiness ASV City Check

  $check_ids = array();

  foreach($check as $key => $city){
    $cities_id = $sql->getAll('SELECT id from City WHERE name IN ('.implode(',',$city).')');
    $check_ids[$key] = array();
    foreach ($cities_id as $city_id) {
      $check_ids[$key][]=$city_id['id'];
    }
  }
  $check_ids['other_roles'][0] = 14; //Kolkata Check for Other Roles

  foreach ($fellow_roles_data as $role) {
    $roles[$i]['id'] = $role['id'];

    if($role['id']==272 && in_array($user['city_id'],$check_ids['tr_fellow_city'])){ //Propel Fellow - Transition Readiness Fellow Check
      $roles[$i]['name']='Transition Readiness Fellow';
    }
    else if($role['id']==378 && in_array($user['city_id'],$check_ids['a_fellow_city'])){ //Aftercare Fellow Check
      $roles[$i]['name']='Aftercare Fellow';
    }
    else if($role['id']==375 && in_array($user['city_id'],$check_ids['foundations_city'])){ //Foundations Fellow - Check
      $roles[$i]['name']='Foundations Fellow';
    }
    else if($role['id']==269 && !in_array($user['city_id'],$check_ids['other_roles'])){ //Center Head - Shelter Operations Fellow
      $roles[$i]['name']='Shelter Operations Fellow';
    }
    else if($role['id']==370 && !in_array($user['city_id'],$check_ids['other_roles'])){ //FR Fellow - Fundraising Fellow
      $roles[$i]['name']='Fundraising Fellow';
    }
    else if($role['id']==15 && !in_array($user['city_id'],$check_ids['other_roles'])){ //Finance Controller - Finance Fellow
      $roles[$i]['name']='Finance Fellow';
    }
    else if($role['id']==5 && !in_array($user['city_id'],$check_ids['other_roles'])){ //HC Fellow - Human Capital Fellow
      $roles[$i]['name']='Human Capital Fellow';
    }
    else if($role['id']==11 && !in_array($user['city_id'],$check_ids['other_roles'])){ //PR Fellow - Public Relations Fellow
      $roles[$i]['name']='Campaigns Fellow';
    }
    else if($role['id']==2 || $role['id']==19 && !in_array($user['city_id'],$check_ids['other_roles'])){ //City Team Lead and Ed Support Fellow
      $roles[$i]['name']=$role['name'];
    }
    else{
      unset($roles[$i]);
    }
    $i++;
  }

  $options_fellow = '';
  foreach ($roles as $role) {
    $options_fellow .= '<option value="'.$role['id'].'">'.$role['name'].'</option>';
  }

  $query_roles_vol="SELECT * from `Group`
                    WHERE type='volunteer'
                      AND group_type='normal'
                      AND status=1
                      AND (name LIKE '%mentor%'
                        OR name LIKE '%wingman%'
                        OR name LIKE '%foundations%'
                        OR name LIKE '%asv%'
                        OR name LIKE '%ES Volunteer%'
                        OR name LIKE '%FR Volunteer%'
                      )";
  $volunteer_roles_data = $sql->getAll($query_roles_vol);

  $volunteer_roles = array();
  $i = 0;

  foreach ($volunteer_roles_data as $role) {
    $volunteer_roles[$i]['id'] = $role['id'];

    if($role['id']== 348 && in_array($user['city_id'],$check_ids['tr_wingman_city'])){ //Propel Wingman - Transition Readiness Wingman - Check
      $volunteer_roles[$i]['name'] = 'Transition Readiness Wingman';
    }
    else if($role['id']==376 && in_array($user['city_id'],$check_ids['foundations_city'])){ //Foundations Volunteer Check
      $volunteer_roles[$i]['name'] = 'Foundations Volunteer';
    }
    else if($role['id']==365 && in_array($user['city_id'],$check_ids['foundations_city'])){ //Aftercare Wingman Check
      $volunteer_roles[$i]['name'] = 'Aftercare Wingman';
    }
    else if($role['id']==377 && in_array($user['city_id'],$check_ids['a_asv_city'])){ //Aftercare ASV - ASV University - Check
      $volunteer_roles[$i]['name'] = 'ASV (University/College)';
    }
    else if($role['id']==349 && in_array($user['city_id'],$check_ids['tr_asv_city'])){ //Propel ASV - ASV Grade 11-12 - Check
      $volunteer_roles[$i]['name'] = 'ASV (Grade 11-12)';
    }
    else if($role['id']==8 && !in_array($user['city_id'],$check_ids['other_roles'])){ //Mentor Check
      $volunteer_roles[$i]['name'] = 'Mentor';
    }
    else if($role['id']==9 && !in_array($user['city_id'],$check_ids['other_roles'])){ //ES Volunteer - ASV Grade 5-10 Check
      $volunteer_roles[$i]['name'] = 'ASV (Grade 5-10)';
    }
    else if($role['id']==369 && !in_array($user['city_id'],$check_ids['other_roles'])){ //FR Volunteer - Fundraising Volunteer - Check
      $volunteer_roles[$i]['name'] = 'Fundraising Volunteer';
    }
    else{
      unset($volunteer_roles[$i]);
    }
    $i++;
  }

  $options_volunteer = '';
  foreach ($volunteer_roles as $role) {
    $options_volunteer .= '<option value="'.$role['id'].'">'.$role['name'].'</option>';
  }

  // function create_survey($sql){
  //
  //   $event = array(
  //     'name' => 'Retention 2018',
  //     'cycle' => 9,
  //     'stage' => 0,
  //     'started_by_user_id' => 57184,
  //     'added_on' => date('Y-m-d H:i:s'),
  //     'status' => 1
  //   );
  //
  //   $event_id = $sql->insert('SS_Survey_Event',$event);
  //   )
  // }


  function createTables($sql){

    $fam_referral = $sql->execQuery("CREATE TABLE IF NOT EXISTS `FAM_Referral` (
          	`id` INT (11)  unsigned NOT NULL auto_increment,
          	`referer_user_id` INT (11)  unsigned NOT NULL,
          	`referee_user_id` INT (11)  unsigned NOT NULL,
          	`group_id` INT (11)  unsigned NOT NULL,
          	`created_at` DATETIME    NOT NULL,
          	PRIMARY KEY (`id`),
          	KEY (`referer_user_id`),
          	KEY (`referee_user_id`),
          	KEY (`group_id`)
          ) DEFAULT CHARSET=utf8");

    $fam_usergroupgreference = $sql->execQuery("CREATE TABLE IF NOT EXISTS `FAM_UserGroupPreference` (
          	`id` INT (11)  unsigned NOT NULL auto_increment,
          	`user_id` INT (11)  unsigned NOT NULL,
          	`group_id` INT (11)  unsigned NOT NULL,
          	`taskfolder_link` VARCHAR (100)   NOT NULL,
          	PRIMARY KEY (`id`),
          	KEY (`user_id`),
          	KEY (`group_id`)
          ) DEFAULT CHARSET=utf8");

    $fam_userEvaluation = $sql->execQuery("CREATE TABLE IF NOT EXISTS `FAM_UserEvaluation` (
          	`id` INT (11)  unsigned NOT NULL auto_increment,
          	`user_id` INT (11)  unsigned NOT NULL,
          	`parameter_id` INT (11)  unsigned NOT NULL,
          	`score` VARCHAR (100)   NOT NULL,
          	`comments` VARCHAR (100)   NOT NULL,
          	PRIMARY KEY (`id`),
          	KEY (`user_id`),
          	KEY (`parameter_id`)
          ) DEFAULT CHARSET=utf8") ;

    $fam_parameters = $sql->execQuery("CREATE TABLE IF NOT EXISTS `FAM_Parameters` (
          	`id` INT (11)  unsigned NOT NULL auto_increment,
          	`profile_id` INT (11)  unsigned NOT NULL,
          	`task_type` ENUM ('personal_interview','kindness_challenge','common','vertical') DEFAULT 'personal_interview'  NOT NULL,
          	`parameter_name` VARCHAR (100)   NOT NULL,
          	`status` ENUM ('1','0') DEFAULT '1',
          	PRIMARY KEY (`id`),
          	KEY (`profile_id`)
          ) DEFAULT CHARSET=utf8") ;

    $fam_userstatus = $sql->execQuery("CREATE TABLE IF NOT EXISTS `FAM_UserStatus` (
        	`id` INT (11)  unsigned NOT NULL auto_increment,
        	`user_id` INT (11)  unsigned NOT NULL,
        	`updated_by` VARCHAR (100)   NOT NULL,
        	`updated_at` DATETIME    NOT NULL,
        	`status_id` INT (11)  unsigned NOT NULL,
        	PRIMARY KEY (`id`),
        	KEY (`user_id`),
        	KEY (`status_id`)
        ) DEFAULT CHARSET=utf8");

    $fam_evaluationstatus = $sql->execQuery("CREATE TABLE IF NOT EXISTS `FAM_EvaluationStatus` (
        	`id` INT (11)  unsigned NOT NULL auto_increment,
        	`name` VARCHAR (100)   NOT NULL,
        	`created_at` DATETIME    NOT NULL,
        	PRIMARY KEY (`id`)
        ) DEFAULT CHARSET=utf8");
  }
