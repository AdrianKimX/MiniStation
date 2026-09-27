

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>


</head>
<body>
   <div class='login-main'>
   <?php
   if(isset($_SESSION['user_id'])){
header('location: ?page=home');


}  
 echo  $_SESSION['user_id'];
   include_once "components/login-form.php"; ?>

      <div class='account-question'>

<a href='?page=register'>No account?</a> 
</div>
   </div>
</body>
</html>