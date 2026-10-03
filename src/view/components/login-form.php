<?php 
session_start();

if(isset($_POST['login'])){


$email= trim($_POST['email']);
$pass= trim($_POST['password']);


if(!empty($email) && !empty($pass)){

$sql= $conn->query("SELECT * FROM ministation_db where email='{$email}' ");

if($sql->num_rows==1){
  

  $row= $sql->fetch_assoc;
    if(md5($pass)===$row['password']){

    $_SESSION['user_id']= $row['user_id'];


    header('location: ?page=home');
    exit;
    }


}else{


echo "This ".$email." is not registered";


}
}


}







?>



<div></div>