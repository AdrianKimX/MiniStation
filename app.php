
<link rel='stylesheet'  href='src/assets/css/main.css'>
<link rel='stylesheet'  href='src/assets/css/login.css'>
<link rel='stylesheet'  href='src/assets/css/home.css'>


<?php



require "src/db/DBconnection.php";

if(isset($_GET['page'])){



$page = $_GET['page'];

$title="MS | $page";


session_start();



if($page==null){

include_once "src/view/index.php";

}elseif($page=="home" ){

include_once "src/view/home.php";

}elseif($page=="login" ){

include_once "src/view/login.php";

}elseif($page=="register" ){

include_once "src/view/register.php";

}else{
include_once "src/view/index.php";

}

}else{

include_once "src/view/index.php";

}

?>