<?php


  class FRaise{

    private $sql;

    function __construct() {
      global $sql;
      $this->sql = $sql;

      $sql->execQuery("
        CREATE TABLE IF NOT EXISTS `Donut_Network` (
          `id` INT (11)  unsigned NOT NULL auto_increment,
          `name` VARCHAR (100)   NOT NULL,
          `email` VARCHAR (100)  NULL,
          `phone` VARCHAR (100)   NOT NULL,
          `relationship` ENUM ('parent','sibling','acquaintance','friend','relative','other') DEFAULT 'parent' NULL,
          `donor_status` ENUM ('lead','pledged','disagreed','donated') DEFAULT 'lead'  NOT NULL,
          `pledged_amount` VARCHAR (100)    NULL,
          `pledge_type` ENUM ('nach','cash/cheque','online','other') DEFAULT NULL  NULL,
          `collection_by` ENUM ('self','handover_to_mad') DEFAULT NULL   NULL,
          `address` MEDIUMTEXT   NULL,
          `added_by_user_id` INT (11)  unsigned NOT NULL,
          `follow_up_on` DATETIME   NULL,
          `collect_on` DATETIME    NULL,
          `added_on` DATETIME    NOT NULL,
          PRIMARY KEY (`id`),
          KEY (`added_by_user_id`)
        ) DEFAULT CHARSET=utf8 ;
      ");

      $sql->execQuery("
        CREATE TABLE IF NOT EXISTS `Donut_NetworkData` (
          `id` INT (11)  unsigned NOT NULL auto_increment,
          `donut_network_id` INT (11)  unsigned NOT NULL,
          `name` VARCHAR (100)   NOT NULL,
          `value` VARCHAR (100)   NOT NULL,
          `data` MEDIUMTEXT    NULL,
          `added_on` DATETIME    NOT NULL,
          PRIMARY KEY (`id`),
          KEY (`donut_network_id`)
        ) DEFAULT CHARSET=utf8 ;
      ");

  	}


    //Get Functions

    function getenumValues($table,$column){
      $query_types = "SELECT COLUMN_TYPE FROM information_schema.`COLUMNS` WHERE TABLE_NAME = '".$table."' AND COLUMN_NAME = '".$column."'";
      $query_types = "DESC ".$table." ".$column;
      $values = $this->sql->execQuery($query_types);
    }

    function get_network($id){
      $query = 'SELECT N.*,ND.name as data_name, ND.value as data_value, ND.data as data_data
                FROM Donut_Network N
                LEFT JOIN Donut_NetworkData ND ON ND.donut_network_id = N.id
                WHERE N.id='.$id.'
                ORDER BY FIELD(N.donor_status,"lead","pledged","donated","disagreed") ASC';
      $result = $this->sql->getAll($query);
      return $result[0];
    }

    function get_network_info($user_id){
      $query = 'SELECT N.*,ND.name as data_name, ND.value as data_value, ND.data as data_data
                FROM Donut_Network N
                LEFT JOIN Donut_NetworkData ND ON ND.donut_network_id = N.id
                WHERE N.added_by_user_id='.$user_id.'
                ORDER BY FIELD(N.donor_status,"lead","pledged","donated","disagreed") ASC,
                      N.collect_on ASC
                ';
      $result = $this->sql->getAll($query);
      return $result;
    }

    function get_total_pledge($user_id){
      $query = 'SELECT SUM(pledged_amount)
                FROM Donut_Network N
                WHERE N.added_by_user_id='.$user_id.'
                ';

      $result = $this->sql->getOne($query);
      return $result;
    }

    //Insert/Update Functions

    function insert_network_info($data){
      $id = $this->sql->insert('Donut_Network',$data);
      return $id;
    }

    function update_pledge_info($id,$data){
      $id = $this->sql->update('Donut_Network',$data,'id='.$id);
      return $id;
    }


    function insert_networkdata($data,$id){

    }

  }
