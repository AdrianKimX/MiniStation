<?php 



if(isset($_POST['register'])){


$email= trim($_POST['email']);
$password=trim($_POST['password']);



$RegisterSql= "SELECT * FROM users where email='{$email}'";

if($sqlquery=$conn->query($RegisterSql)){
  
if(mysqli_num_rows($sqlquery)>0){

echo "Email already registered";

}else{

$RegisterSql2=$conn->query("INSERT INTO users(email, password)
values('{$email}', '{$password}')");

if($RegisterSql2){
header("location: app.php?page=home");
exit;
}

}

}else{
    echo 'error with the query';
}
}

?>

<div class='login-form'>

<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method='POST' >

<div class='input-field email-fld'>
<input type='email' name='email' required>
</div>

<div class='input-field password-fld'>
<input type='password' name='password' required>
</div>

<div class='input-field submit-btn'>
<input type='submit' name='register' value='Register' required>
</div>

</form>


</div>
