<!DOCTYPE HTML>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>




<?php 
//connecting with database
require_once "config.php";
if(isset($_POST["register"]))
{
   
    $username=$_POST["username"];
    $password=$_POST["password"];
    $password_hash=password_hash($password,PASSWORD_BCRYPT);
    $query=$mysqli->prepare("SELECT *FROM login_details WHERE username=?");
    
    $query->bind_param("s",$username);
    $query->execute();
    if($query->get_result()->num_rows > 0)
    {
        echo '<p class="container" style="text-align:center"><b style="color:red">The username is already registered!!!</b></p>';
    }
    else
    {
        $query->close();
        $query=$mysqli->prepare("INSERT INTO login_details(username,password) VALUES (?,?)");
        $query->bind_param("ss",$username,$password_hash);
        $result=$query->execute();
        if ($result) {
            echo '<p class="container" style="text-align:center"><b style="color:green">Your registration was successful!</b></p>';
            //going to login page
            header("location: index.php");
        } else {
            echo '<p class="container" style="text-align:center" ><b style="color:red">OPPS!!!<b/>Something went wrong!</p>';
        }

    }
    
}
?>





<!--Regi form-->

<form class="container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
     <h2>Registration Form</h2>
    <div class="input-group">
      <span class="input-group-addon" style="length:50px"><i class="glyphicon glyphicon-user"></i></span>
      <input id="username"type="text" style="width:50%" class="form-control" name="username" placeholder="Username"  pattern="[a-zA-Z0-9]+"required>
    </div>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" style="width:50%" class="form-control" name="password" placeholder="Password" required>
    </div>
    <br>
    
    <button type="submit" class="btn btn-info" style="float:left;background-color:#ab47bc" name="register">Register</button>
    <br>
    <br>
    <p>Want to <a href="index.php" style="color:#ab47bc"><b>Log in now</b></a></p>
</form> 















</body>
<html>






