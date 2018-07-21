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
      $query = 'SELECT
                  N.*,
                  Age.value as age_bracket,
                  NACH.value as nach_potential,
                  OTD.value as otd_potential,
                  GivingLikelihood.value as giving_likelihood,
                  GivingLikelihood.data as giving_likelihood_reason,
                  NACHLikelihood.value as nach_likelihood,
                  NACHLikelihood.data as nach_likelihood_reason,
                  OnlineLikelihood.value as online_likelihood,
                  OnlineLikelihood.data as online_likelihood_reason
                FROM Donut_Network N
                LEFT JOIN (
                  SELECT DN.donut_network_id as d_id, DN.value FROM Donut_NetworkData DN WHERE DN.name = "age_bracket"
                )Age ON Age.d_id = N.id
                LEFT JOIN (
                  SELECT DN.donut_network_id as d_id, DN.value FROM Donut_NetworkData DN WHERE DN.name = "nach_potential"
                )NACH ON NACH.d_id = N.id
                LEFT JOIN (
                  SELECT DN.donut_network_id as d_id, DN.value FROM Donut_NetworkData DN WHERE DN.name = "otd_potential"
                )OTD ON OTD.d_id = N.id
                LEFT JOIN (
                  SELECT DN.donut_network_id as d_id, DN.value, DN.data FROM Donut_NetworkData DN WHERE DN.name = "giving_likelihood"
                )GivingLikelihood ON GivingLikelihood.d_id = N.id
                LEFT JOIN (
                  SELECT DN.donut_network_id as d_id, DN.value, DN.data FROM Donut_NetworkData DN WHERE DN.name = "nach_likelihood"
                )NACHLikelihood ON NACHLikelihood.d_id = N.id
                LEFT JOIN (
                  SELECT DN.donut_network_id as d_id, DN.value, DN.data FROM Donut_NetworkData DN WHERE DN.name = "online_likelihood"
                )OnlineLikelihood ON OnlineLikelihood.d_id = N.id
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
                GROUP BY N.id
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

    function check_additional_details($donor_id){
      $q = 'SELECT COUNT(id) FROM Donut_NetworkData WHERE donut_network_id ='.$donor_id;
      if($this->sql->getOne($q)>0){
        return true;
      }
      else{
        return false;
      }
    }

    //Insert/Update Functions

    function insert_network_info($data){
      $id = $this->sql->insert('Donut_Network',$data);
      return $id;
    }

    function update_network_info($data,$id){
      $this->sql->update('Donut_Network',$data,'id='.$id);
      return $id;
    }

    function update_pledge_info($id,$data){
      $this->sql->update('Donut_Network',$data,'id='.$id);
      return $id;
    }

    function deleteAll($network_id){
      $this->sql->remove('Donut_Network','id='.$network_id);
    }

    function update_additional_details($data){
      foreach ($data as $insert_data) {
        $q = 'SELECT id FROM Donut_NetworkData
              WHERE donut_network_id ='.$insert_data['donut_network_id'].'
              AND name="'.$insert_data['name'].'"';

        $id = $this->sql->getOne($q);
        dump($id);
        if($id==''){
          $this->sql->insert('Donut_NetworkData',$insert_data);
        }
        else{
          $this->sql->update('Donut_NetworkData',$insert_data,'id='.$id);
        }
      }
    }


  }
