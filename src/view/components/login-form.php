<?php 



if(isset($_POST['login'])){


$email= trim($_POST['email']);
$password=trim($_POST['password']);



$LoginSql= $conn->query("SELECT * FROM users where email='{$email}' and password='{$password}'");

if(!$LoginSql){

echo "Email or password may incorrect";

}else{
    $row=mysqli_fetch_assoc($LoginSql);
$_SESSION['user_id']= $row['user_id'];
header("location: app.php?page=home");
exit;
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
<input type='submit' name='login' value='Login' required>
</div>

</form>


</div>
