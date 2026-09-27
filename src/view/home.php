<?php

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
</head>
<body>
    <div>
        <?php
    include_once "src/api/WeatherAPI.php";



$LoginSql= $conn->query("SELECT * FROM users where email='k@gmail.com'");

    $row=mysqli_fetch_assoc($LoginSql);
$_SESSION['user_id']= $row['user_id'];
echo $_SESSION['user_id'];

 ?>
    </div>
</body>
</html>