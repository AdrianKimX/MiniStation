<?php


require "src/db/DBconnection.php";

if(isset($_GET['page'])){



$page = $_GET['page'];

$title="MS | $page";




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