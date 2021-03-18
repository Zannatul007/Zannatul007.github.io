<!DOCTYPE html>
<html lang="en">
<head>




  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php

session_start();
 
//checking if already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: processing_msg_new.php");
    exit;
}
 
//connecting with database
require_once "config.php";
 

$username = $password = "";
$username_err = $password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
   
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    } 
    else
    {
        $username = trim($_POST["username"]);
    }
    
    
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password.";
    } else
    {
        $password = trim($_POST["password"]);
      
    }
    if(empty($username_err) && empty($password_err))
    {
        $sql = "SELECT  username,password FROM login_details WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql))
        {
            $param_username = $username;
            
            $stmt->bind_param("s", $param_username);
            
           
           
            
           
            if($stmt->execute())
            {
               
                $stmt->store_result();
                
               
                if($stmt->num_rows == 1)
                {                    
                    
                    $stmt->bind_result( $username, $g_password);
                    if($stmt->fetch())
                    {   //decrypting msg
                        if(password_verify($password, $g_password))
                        {
                           
                            session_start();
                           
                            $_SESSION["loggedin"] = true;
                           
                            $_SESSION["username"] = $username;
                            $_SESSION["chatmate"] = "";                            
                            
                            //going to chat page
                            header("location: processing_msg_new.php");
                        } 
                        else
                        {
                          
                           echo '<p class="container" style="text-align:center"><b style="color:red">The password you entered was not valid.</b></p>';
                        }
                    }
                } 
                else
                {
                  
                    echo '<p class="container" style="text-align:center" ><b style="color:red">No account found with that username.</b></p>';
                }
            } 
            else
            {
                echo '<p class="container" style="text-align:center" ><b style="color:red">OPPS!!!<b/>Something went wrong!</p>';
        }

           
            $stmt->close();
        }
    }
    else
    {
        echo '<p class="container" style="text-align:center" ><b style="color:red">Fill All the Fields!!!</p>';
    }
    $mysqli->close();
}

    ?>
<!DOCTYPE html>
<html>
<body>









<!--login form-->

<form class="container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Login Form</h2>
    <div class="input-group">
      <span class="input-group-addon" ><i class="glyphicon glyphicon-user"></i></span>
      <input id="username"type="text" class="form-control"  style="width:50%" name="username" placeholder="Username">
    </div>
    <div class="input-group">
      <span class="input-group-addon" ><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" style="width:50%" class="form-control" name="password" placeholder="Password">
    </div>
    <br>
    
    <input type="submit" class="btn btn-info" style="float:left;background-color:#ab47bc" value="Sign in"> 
    <br>
    <br>
    <span>New to here <a href="register.php" style="color:#ab47bc"><b>Join now</b></span>
</form> 



</body>
</html>
    
   
  
 
