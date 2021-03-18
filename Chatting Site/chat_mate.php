<?php

session_start();
?>



<!DOCTYPE HTML>
<html>
<head>
<style>
body {
 
  margin-right: 10%;
  margin-left: 10%;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
  text-align:center;
  height:100%
  
}

td, th {
  
  text-align: left;
  padding: .75rem;
  text-align:center;
}


button {
  padding: .75rem .10rem;
    font-size: 100%;
    text-align: center;
    cursor: pointer;
    outline: none;
    color: #fff;
    background-color: #ab47bc;
    border: none;
    border-radius: 1rem;
    box-shadow: 0 0.75rem #e1bee7;
    width: 100%;
}

button:hover {background-color: #ba68c8}

button:active {
  background-color: #7b1fa2;
  box-shadow: 0 0.75rem #e1bee7;
  transform: translateY(4px);
}




</style>
</head>

<body>



<!--Reciever name-->



  <?php
  $items=array();
  $i=0;
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
              $items[$i++]=$row[0];

                    
            }
        }
    }
   }
  

  ?>
   <form action="chat_mate.php" method="post">
 
 
  <table  >
  <tr>
  <th><?php echo $_SESSION["username"]?> Choose a Chatmate Name</th>
  </tr>

  <?php
  for($x=0;$x<$i;$x++)
  {
      if($_SESSION["username"]!=$items[$x])
      {
    ?>
  <tr>
  <td>
 
 
  <button name="chatmate" type="submit" value="<?php echo $items[$x]?>"><?php echo $items[$x]?></button>
  
  
  <?php// echo $d ?>
  </td>
  </tr>
   <?php
    }
    }
  ?>
  </table>
  </form>

<br>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if(isset($_POST["chatmate"]))
{
    
    
    $_SESSION["chatmate"]=$_POST["chatmate"];
    
    
    
   
    header("location: processing_msg_new.php");

}
}
?>




</body>

</html>





