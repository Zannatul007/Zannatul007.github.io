<?php
   session_start();
   ?>


<!DOCTYPE html>
<html>

<head>
    <style>
        .front {}
        
        body {
            margin: 7rem 7rem;
            background-color: white;
            border: solid 1.5px #6f97ab;
            border-radius: 4px;
        }
        
        .title {
            color: #fff;
            background-color: #577482;
            font-weight: bold;
            border-bottom: 1px solid #aaa;
            padding: 10px;
            text-align: center;
            border-radius: .3rem;
            font-size: 2rem;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            margin: 10px 10px 10px 10px;
        }
        
        .i {
            display: block;
    width: 80%;
    height:2rem;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color:black;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid black;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
   
        }
        
        .Front {
            margin: 0px 10px 10px 10px;
            font-size: 15px;
            background-color: #eeeeeee0;
            border-radius: 4px;
            padding: 2px;
        }
        #answer {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
   width:100%;


}
#answer td, #answer th {
  border: 1px solid #ddd;
  padding: 8px;
}
#answer tr{
    font-size:1.5rem;
}

#answer tr:nth-child(even){background-color: #f2f2f2;}
        </style>
    </style>
</head>

<body>







    <h2 class="title">Statistics Calculator</h2>
    <form method="post" action="index.php">
        <div class="Front">
            <br>
<?php if (isset($_POST['Submit'])) {
$_SESSION['number'] = $_POST['number'];
 }
 else
 {
     $_SESSION['number']=null;
 }
 ?>
            <h2 style="display: inline;font-family: Trebuchet MS, Arial, Helvetica, sans-serif;">Enter the Data Set </h3><small>(Enter your input numbers seperated by comma)</small>
                <input class="i" type="text" name="number" value="<?php echo $_SESSION['number'];?>">
                <br>
                <input type="submit" style="float:left;display:inline;padding =3rem; font-size:1.5rem; background-color: #6f97ab4a; border-4adius:2px; " name="Submit" value="Calculate">
              
                <!--session-->
                
       <br>
       <br>
       
     </div>

    </form>
<h2 class="title">Calculation</h2>
<!--empty-->
<?php
if(empty($_POST["number"]))
   {
        ?>

    
     <p style="text-align:Center;Font-size:1.5rem;Font-weight:bold;background-color:#f2f2f2;margin:.5rem;font-family: Trebuchet MS, Arial, Helvetica, sans-serif;">Answer</p>
<table id="answer">
    
  <tr>
    <td>Sum of the Dataset</td>
    <td><?php echo  "sum="?></td>
  </tr>
  <tr>
    <td>Mean Value</td>
    <td><?php echo  "mean="?></td>
    
  </tr>
  <tr>
    <td>Maximum Value</td>
    <td><?php echo"max="?></td>
    
  </tr>
  <tr>
    <td>Minimum Value</td>
    <td><?php echo "min="?></td>
    
  </tr>
  <tr>
    <td>Ascending Order</td>
    <td><?php echo "-------"?>
    </td>
    </tr>
    <tr>
    <td>Descending Order</td>
    <td><?php echo "-------"?>
    </td>
    
  </table>
   <?php }
   else 
   { 
    
    $a=array();
    $arr=array();
    $str='';
    $s='';
    $number=$_POST["number"];
    $c=0;
    //1 2 15 
   for($i=0;$i<strlen($number);$i++)
   { 
      if(($number[$i]!=","))
       {
         $s.=$number[$i];
        
       }
       else
       { 
         array_push($arr,$s);
         
         $s=" ";
       }
   }
   array_push($arr,$s);
   $length=count($arr);
   
  /* for($i=0;$i<$length;$i++)
   {
       $arr[$i]=floatval($arr[$i]);
   }*/

    $sum=0;
    $min=$arr[0];
    $max=0;
    $mean;
     
    for($i=0;$i<$length;$i++)
    {
        $sum=$sum+$arr[$i];
       if($min>$arr[$i])
       {
           $min=$arr[$i];
       }
       if($max<$arr[$i])
       {
           $max=$arr[$i];
       }
    }$mean=$sum/$length;
    ?>
<p style="text-align:Center;Font-size:1.5rem;Font-weight:bold;background-color:#f2f2f2;margin:.5rem;font-family: Trebuchet MS, Arial, Helvetica, sans-serif;">Answer</p>
<table id="answer">
    
  <tr>
    <td>Sum of the Dataset</td>
    <td><?php 
    echo "sum=";
    
    echo number_format($sum,2);?></td>
  </tr>
  <tr>
    <td>Mean Value</td>
    <td><?php 
    echo "mean=";
    echo number_format($mean,2);?></td>
    
  </tr>
  <tr>
    <td>Maximum Value</td>
    <td><?php 
    echo "max=";
    echo $max;?></td>
    
  </tr>
  <tr>
    <td>Minimum Value</td>
    <td><?php 
    echo "min=";
    echo $min;?></td>
    
  </tr>
  <tr>
    <td>Ascending Order</td>
    <td><?php
     sort($arr); 
    for($i=0;$i<$length;$i++)
    {  
         echo $arr[$i];
         if($i==$length-1)
         {
             echo " ";
         }
         else
         {
             echo ",";
         }
    }?>
    </td>
    <tr>
    <td>Descending Order</td>
    <td><?php
     rsort($arr);
     for($i=0;$i<$length;$i++)
    {  
         echo $arr[$i];
         if($i==$length-1)
         {
             echo " ";
         }
         else
         {
             echo ",";
         }
    }?>
    </td>
    
  </tr>
  </table>
<?php } ?>






</body>

</html>