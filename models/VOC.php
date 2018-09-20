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
          `type` VARCHAR(100) NOT NULL,
          `tags` VARCHAR(100)  NULL,
          `answer` VARCHAR (100)   NOT NULL,
          `priority` VARCHAR (100)   NULL,
          `actionable` VARCHAR (100) NOT NULL,
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

    function get_city_list(){
      $q = 'SELECT * FROM City
            WHERE id<=26
            ORDER BY name';

      return $this->sql->getByID($q);
    }

    function get_child_list($city_id,$center_id = null){
      $q = 'SELECT S.id as id, CONCAT(S.name," | ",L.grade,L.name) as name FROM Student S
            INNER JOIN Center C ON C.id = S.center_id
            INNER JOIN StudentLevel SL ON SL.student_id = S.id
            INNER JOIN Level L ON L.id = SL.level_id
            WHERE C.city_id ='.$city_id.'
            AND S.status=1
            AND C.status=1';
      return $this->sql->getByID($q);
    }

    function get_child_list_shelter($center_id){
      $q = 'SELECT S.id as id, CONCAT(S.name," | ",L.grade,L.name) as name FROM Student S
            INNER JOIN Center C ON C.id = S.center_id
            INNER JOIN StudentLevel SL ON SL.student_id = S.id
            INNER JOIN Level L ON L.id = SL.level_id
            WHERE C.id ='.$center_id.'
            AND S.status=1
            AND C.status=1';
      return $this->sql->getByID($q);
    }

    function get_all_comments($user_id){
      $q = 'SELECT VOC.*, S.name as student_name, CT.name as center_name, C.name as city_name
            FROM VoiceOfChild_Comment VOC
            INNER JOIN Student S ON S.id = VOC.student_id
            INNER JOIN Center CT ON CT.id = S.center_id
            INNER JOIN City C ON C.id = CT.city_id
            WHERE added_by_user_id = '.$user_id.'
            GROUP BY student_id';

      return $this->sql->getAll($q);
    }



    //Insert/Update/Delete Functions

    function insert_comment($data){
      $id = $this->sql->insert('VoiceOfChild_Comment',$data);
      return $id;
    }




  }
