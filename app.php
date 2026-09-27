
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Work+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">

<link rel='stylesheet'  href='src/assets/css/main.css'>
<link rel='stylesheet'  href='src/assets/css/login.css'>
<link rel='stylesheet'  href='src/assets/css/home.css'>




<?php



require "src/db/DBconnection.php";

if(isset($_GET['page'])){



$page = $_GET['page'];

$title="MS | $page";




if($page==null){

include_once "src/view/index.php";

}elseif($page=="home" ){

include_once "src/view/home.php";

}else{
include_once "src/view/index.php";

}

}else{

include_once "src/view/index.php";

}

?>