<!DOCTYPE HTML>  
<html>
<head>
<title>Number of Subjects</title>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.25rem solid #dddddd;
  text-align: left;
  padding: 1rem;
}
</style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body> 

<div class="container">
<h2>Result:</h2>
<table>
  <tr>
    <th>Total Credits</th>
    <th>Total Grade Points</th>
    <th>CGPA</th>
  </tr>
<?php  
$totalcredit=0.0;
$totalgradepoints=0.0;
$subjectname=$_POST['subjectname'];
$i=0;
$credit=array();
if (isset($_POST['credit'])) {
    foreach($_POST['credit'] as $w){

          $totalcredit+=(float)$w;
          $credit[$i++]=(float)$w;

}
}
$i=0;
if (isset($_POST['grade'])) {
    foreach($_POST['grade'] as $w){
        $totalgradepoints+=(((float)$w)*$credit[$i++]);
}
}
$cgpa=$totalgradepoints/$totalcredit;
?>
<tr>
<td>
<?php
echo number_format((float)$totalcredit, 2, '.', ''); 
?>
</td>
<td>
<?php
echo number_format((float) $totalgradepoints, 2, '.', ''); 
?>
</td>
<td>
<?php
echo number_format((float)$cgpa, 2, '.', ''); 
?>
</td>
</tr>

</table>






</div>

</body>
</html>
