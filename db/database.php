<?php
$userid=$_SESSION['user_id'];

$db = "makeadiff_madapp";
$db_host = "127.0.0.1";
$db_name = "root";
$db_pass = "root@1234";

$dbhandle = mysqli_connect($db_host, $db_name, $db_pass,$db)
  or die("Couldn't connect to SQL Server on $db_host");

//Query to get user data
$query_user="SELECT * from User where id=".$userid;
$sql2 =  mysqli_query($dbhandle,$query_user);
$user = mysqli_fetch_array($sql2);
//Query to get all user from city for referral
$query_all_users ="SELECT User.id,User.name AS user_name,City.name AS city_name
                FROM User
                INNER JOIN City ON City.id= User.city_id
                WHERE user_type = 'volunteer' and User.city_id=".$user['city_id'];
$sql1 =  mysqli_query($dbhandle,$query_all_users);
$volunteer= array();
while ($row = mysqli_fetch_array($sql1))
      {$volunteer[] = $row['user_name']." / ".$row['id'];}
//Query to get all questions and answer from survey table
$query_qna="SELECT question_id, question, SS_Answer.id AS answer_id, answer
            FROM SS_Answer
            INNER JOIN SS_Question ON SS_Answer.question_id=SS_Question.id
            WHERE survey_event_id=7 ";
$ans=mysqli_query($dbhandle,$query_qna);
$result=array();
while($row=mysqli_fetch_array($ans))
     {$result[]=$row;}
//roles query
$query_roles="SELECT * from UserGroup";
 ?>
