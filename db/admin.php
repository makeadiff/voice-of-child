<?php

  include ('../../common.php');

  if(empty($_POST)){
    $survey = $sql->getAll('SELECT * from SS_Survey_Event WHERE (name LIKE "%Retention%" OR name LIKE "%Succession%") AND YEAR(added_on)=2018');
    if(empty($survey)){
      ?><html>
        <body>
          <form action="admin.php" method="POST">
            <input type="text" name="survey_event_name" placeholder="Survey Event Name" required/>
            <hr>
            <p>Survey Questions</p>
            <?php
              for($i=0;$i<20;$i++){
                echo '<input type="text" name="survey_question[]" placeholder="Survey Question '.$i.' "/><br>';
                for($j=0;$j<5;$j++){
                  echo '&emsp; <input type="text" name="survey_answer['.$i.'][]" placeholder="Survey Answer '.$j.' "/><br>';
                }
                echo '<hr/>';
              }
            ?>
            <input type="submit" name="submit" value="Create Survey "/>
          </form>
        </body>
      </html><?php
    }else{

    }

  }else{
    $survey = $sql->getAll('SELECT * from SS_Survey_Event WHERE (name LIKE "%Retention%" OR name LIKE "%Succession%")');
    dump($survey);
    // exit;
    if(empty($survey)){
      $name = $_POST['survey_event_name'];
      $id = $sql->insert('SS_Survey_Event',array(
        'name' => $name,
        'cycle' => 9,
        'stage' => 0,
        'started_by_user_id' => 57184,
        'added_on' => date('Y-m-d H:i:s'),
        'status' => 1
      ));
      $question = $_POST['survey_question'];
      foreach ($question as $key => $q) {
        if($q!=''){
          $q_id = $sql->insert('SS_Question',array(
            'question' => $q,
            'status' => 1,
            'survey_event_id' => $id
          ));
          $answer = $_POST['survey_answer'][$key];
          foreach ($answer as $key => $a) {
            if($a!=''){
              $a_id = $sql->insert('SS_Answer',array(
                'answer' => $a,
                'question_id' => $q_id,
                'level' => $key,
                'status' => 1
              ));
            }
          }
        }
      }
    }
  }
