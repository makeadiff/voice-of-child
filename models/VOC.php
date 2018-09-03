<?php


  class VOC{

    private $sql;

    function __construct() {
      global $sql;
      $this->sql = $sql;

      $sql->execQuery("
        CREATE TABLE IF NOT EXISTS `VoiceOfChild_Comment` (
          `id` INT (11)  unsigned NOT NULL auto_increment,
          `added_by_user_id` INT (11)  unsigned NOT NULL,
          `student_id` INT (11)  unsigned NOT NULL,
          `question` VARCHAR (100)   NOT NULL,
          `type` ENUM ('personal','disclosure','feedback','shelter_info','') DEFAULT 'personal'  NOT NULL,
          `answer` VARCHAR (100)   NOT NULL,
          `priority` VARCHAR (100)   NULL,
          `escalation_status` ENUM ('open','closed','none') DEFAULT 'none'  NOT NULL,
          `added_on` DATETIME    NOT NULL,
          PRIMARY KEY (`id`),
          KEY (`added_by_user_id`),
          KEY (`student_id`)
        ) DEFAULT CHARSET=utf8 ;
      ");

  	}

    //Get Functions

    function get_shelter_list($city_id){
      $q = 'SELECT * FROM Center
            WHERE city_id ='.$city_id.'
            AND status=1';

      return $this->sql->getByID($q);
    }

    function get_child_list($city_id){
      $q = 'SELECT S.* FROM Student S
            INNER JOIN Center C ON C.id = S.center_id
            WHERE C.city_id ='.$city_id.'
            AND S.status=1
            AND C.status=1';

      return $this->sql->getByID($q);
    }



    //Insert/Update/Delete Functions


  }
