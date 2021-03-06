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
          `question` MEDIUMTEXT   NOT NULL,
          `type` VARCHAR(100) NOT NULL,
          `tags` VARCHAR(100)  NULL,
          `answer` TEXT   NOT NULL,
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
            WHERE type="actual"
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

    function get_all_comments($user_id,$is_director=false,$data=array()){

      if(!$is_director){
        $where = 'WHERE added_by_user_id = '.$user_id;
      }
      else{
        $where = 'WHERE C.type = "actual"';
      }

      if(isset($data['city_id']) && $data['city_id']!='') { $where .= ' AND C.id ='.$data['city_id']; }
      if(isset($data['shelter_id']) && $data['shelter_id']!='') { $where .= ' AND CT.id ='.$data['shelter_id']; }
      if(isset($data['actionable']) && $data['actionable']!='') { $where .= ' AND VOC.actionable ="'.$data['actionable'].'"';}
      if(isset($data['question_type']) && $data['question_type']!='') { $where .= ' AND VOC.type ="'.$data['question_type'].'"'; }


      $q = 'SELECT VOC.*, S.name as student_name, CT.name as center_name, C.name as city_name, COUNT(VOC.id) as count
            FROM VoiceOfChild_Comment VOC
            INNER JOIN Student S ON S.id = VOC.student_id
            INNER JOIN Center CT ON CT.id = S.center_id
            INNER JOIN City C ON C.id = CT.city_id '.$where.'
            GROUP BY student_id
            ORDER BY VOC.added_on DESC
            ';

      return $this->sql->getAll($q);
    }

    function get_all_comments_child($user_id,$child_id,$data=array()){


      $where = '';


      if(isset($data['city_id']) && $data['city_id']!='') { $where .= ' AND C.id ='.$data['city_id']; }
      if(isset($data['shelter_id']) && $data['shelter_id']!='') { $where .= ' AND CT.id ='.$data['shelter_id']; }
      if(isset($data['actionable']) && $data['actionable']!='') { $where .= ' AND VOC.actionable ="'.$data['actionable'].'"';}
      if(isset($data['question_type']) && $data['question_type']!='') { $where .= ' AND VOC.type ="'.$data['question_type'].'"'; }

      $q = 'SELECT VOC.*, S.name as student_name, CT.name as center_name, C.name as city_name
            FROM VoiceOfChild_Comment VOC
            INNER JOIN Student S ON S.id = VOC.student_id
            INNER JOIN Center CT ON CT.id = S.center_id
            INNER JOIN City C ON C.id = CT.city_id
            WHERE VOC.student_id = '.$child_id.$where.'
            ORDER BY VOC.added_on DESC';

      return $this->sql->getAll($q);
    }

    function get_child_info($child_id){
      $q = 'SELECT S.*, CT.name as center,C.name as city
            FROM Student S
            INNER JOIN Center CT ON CT.id = S.center_id
            INNER JOIN City C ON C.id = CT.city_id
            INNER JOIN StudentLevel SL ON SL.student_id = S.id
            INNER JOIN Level L ON L.id = SL.level_id
            WHERE S.id = '.$child_id;

      $child_info = $this->sql->getAll($q);
      return $child_info[0];
    }


    //Insert/Update/Delete Functions

    function insert_comment($data){
      $id = $this->sql->insert('VoiceOfChild_Comment',$data);
      return $id;
    }




  }
