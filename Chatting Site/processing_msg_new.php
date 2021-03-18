<?php

session_start();
//Checking logged in or not
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Linking stylesheets-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></link>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>
<link rel="stylesheet" href="css.css">
<!--Linking script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
   
   
   
   
<title>Chat</title>
    
</head>
<body >
<!--starting sidenav for chatmate-->
<div class="sidenav">
<!--logging out-->
<button type="button" id=logout >
<span> <a style="color:white" href="logout.php" class="glyphicon glyphicon-log-out"><b> Log out</b></a></span>
<br>
</button>
        


<?php
$chatmates=array();
$i=0;
//creating connection
require_once "config.php";
$sql = "SELECT  username FROM login_details";
   if($stmt = $mysqli->prepare($sql))
   {
    if($stmt->execute())
    {

        $result = $stmt->get_result();
        if($result->num_rows >0)
        {  
          while($row = $result->fetch_array(MYSQLI_NUM))
            {
              $chatmates[$i++]=$row[0];

                    
            }
        }
    }
   }
  


  ?>
<!--form for getting chatate name-->
<form action="processing_msg_new.php" method="post">
 
 
<table >
  <tr>
  <th><br><p style="margin-left:.125rem;background-color:white;text-align:left;font-size:1.875rem"><?php echo $_SESSION["username"]?><br>Choose a Chatmate </p></th>
  </tr>

  <?php
  for($x=0;$x<$i;$x++)
  {
      if($_SESSION["username"]!=$chatmates[$x])
      {
    ?>
  <tr>
  <td>
 
 
  <button name="chatmate" type="submit" value="<?php echo $chatmates[$x]?>"><?php echo $chatmates[$x]?></button>
  
  
  
  </td>
  </tr>
   <?php
      }
  }
  ?>
  </table>
  </form>
  <!--Ending Chatmate Form-->

<br>


<?php
//putting chatmate name in session
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if(isset($_POST["chatmate"]))
{
    
    
    $_SESSION["chatmate"]=$_POST["chatmate"];
    
    
    
   
    

}
}
?>

</div>
<!--ending sidenav chatmate div-->


<div class="inner_div">

<?php
//creating connection
require_once "config.php";

//checking msg has sent yet  
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 if(isset($_POST["send"]))
 {
    
    $chatmate=$_SESSION["chatmate"];
    
    $username=$_SESSION["username"];
    $msz=$_POST["msz"];
    //Setting bangladeshi time-zone
    date_default_timezone_set('Asia/Dhaka'); 
    $dt=date("Y-m-d");
    
    $ts=date("H:i:s");
    
    
    
    
    
    $query=$mysqli->prepare("INSERT INTO chat_details(sender_name,receiver_name,time,date,message) VALUES (?,?,?,?,?)");
    $query->bind_param("sssss",$username,$chatmate,$ts,$dt,$msz);
    $query->execute();
    
    
    $_SESSION["chatmate"]=$chatmate;
    $query->close();
 

 }
}

     $sendername= $receivername=$time=$message="";
     $username= ($_SESSION["username"]);
     $chatmate=($_SESSION["chatmate"]);
     $chat=array();
     $i=-1;
     $j=0;
     //setting a variable with value 10 for getting last 10 msg
     $l=10;
    ?>

    <div id="prevmsg"></div>

    <?php
    
     $sql = "SELECT  sender_name,receiver_name,time,date,message FROM chat_details WHERE( sender_name = ? AND receiver_name= ?)  OR (sender_name = ? AND receiver_name= ? ) ORDER BY msg_id DESC LIMIT ?";
     if($stmt = $mysqli->prepare($sql))
     {
        $stmt->bind_param("ssssi",  $username, $chatmate, $chatmate, $username,$l);
        if($stmt->execute())
        {
            $result = $stmt->get_result();
            if($result->num_rows >0)
            { 
               
                while($row = $result->fetch_array(MYSQLI_NUM))
                {
                    $j=0;
                    $i++;
                    //sent or recieve info in column 0
                    if($row[0]==$username)
                    {
                       
                        $chat[$i][$j++]="sent message";
                        

                        ?>
                    
                    <?php
                    }
                    else
                    {
                    
                    $chat[$i][$j++]="received message";
                   
                    ?>
                   
               <?php
            
        
                    }
                     //chatmate in column 1

                    $chat[$i][$j++]=$row[0];
                     //msg in column 2
                    $chat[$i][$j++]=$row[4];
                     //time in column 3
                    $chat[$i][$j++]=$row[2];
                     //date in column 4
                    $chat[$i][$j++]=$row[3];

                }
            }   
        }
     }
     //having row size
     $rsize = count($chat);
     for($i=$rsize-1;$i>=0;$i--)
     {   //all time show first msg time
         if($i==$rsize-1)
         {   
             echo'<p style="font-size:1.2rem;text-align:center;color:red"><b>';
             echo $chat[$i][4];
             echo '</b></p>';
             echo "<br>";
         }
         //show the time beforethe very first msg of that day
         else if($chat[$i][4]!=$chat[$i+1][4])
         {
            echo'<br>';
            echo'<br>';
            echo'<br>';
            echo'<br>';

            echo'<p style="font-size:2.4rem;text-align:center;color:red"><b>';
            echo $chat[$i][4];
            echo '</b></p>';
            
            echo'<br>';
            echo'<br>';
         }
       
        if($chat[$i][0]==="sent message")
        {
                ?>
                <!--sent triangle-->
                <div id="triangle1" class="triangle1"></div>
                <div id="message1" class="message1"> 
                <!--starting msg div-->
                <span style="font-size:2.25rem;color:red;float:right">
                <?php 
               
                echo $chat[$i][2]; 
                ?>
               </span>
               <br>
               <br>
               <br>
               <br>
               <!--time-->
               <span style="color:black;float:right;font-size:1.5rem">
               <?php
               echo $chat[$i][3]; 
               ?>
               </span>
              </div>
              <!--ending msg div-->
              <br>
              <br>
              <br>
           <?php
        }
        
        else
        {
            
            ?>  <!--Chatmate-Name-->
                <span style="font-size:.75rem;float:left"></span>
                <?php echo $chat[$i][1];?>
                <!--rev triangle-->
                <div id="triangle" class="triangle"></div>
                <!--starting msg div-->
                <div id="message" class="message"> 
                <span style="font-size:2.25rem;color:white;float:left">
                 
              <?php 
              echo $chat[$i][2]; 
              ?>
              </span>
            
              <br><br><br><br>
               <!--time-->
              <span style="color:black;float:left;font-size:1.5rem ">
              <?php
              
              echo $chat[$i][3]; 
              ?>
              </span>
              </div>
              <!--ending msg div-->
              <br>
              <?php
            
        }
        
         
     
     echo "<br>";
    }?>
    <?php
    //for fixing msg submit for in bottom
    for($k=0;$k<=20-$rsize;$k++)
    {
       
      
       echo "<br>"; echo "<br>";
      
    }
    ?>
    <a href="#prevmsg"><small>See Older Messages</small></a>
    </div>
<!--ending chat box inner div--> 
    
    
 <!--starting msg form-->   
 <div class="formmsg">
      <form method="post" action="processing_msg_new.php">
      <div class="footer1">
      <span>
      <textarea type="text" class="input1" name="msz" id ="txtmsg" placeholder="Type your message"></textarea>
      <button   type="submit" name="send" style="font-size:2.5rem; text-align:center" ><i class="fa fa-send-o"style="color:#622569"></i></button>
      </span>

      </div>
      </form>
     
      
      
</div> 
<!--ending msg form-->


</body>
</html>