<!DOCTYPE HTML>  
<html>
<head>
<title>Enter Subject Details</title>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
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
<?php


$subjects=$_POST['subjects'];
?>
<form action="phppage.php" method="post" enctype="multipart/form-data">
<table>
  <tr>
    <th>Subject Name</th>
    <th>Grade</th>
    <th>Credit Hour</th>
  </tr>
<?php
for($i=0;$i<$subjects;$i++)
{
  ?>

<tr>
<td>

<input type="text"class="form-control" id="subjectname" placeholder="Enter the subject name" name="subjectname"/>
</td>
<td>

  <label for="grade">Choose a Grade:</label>
  <select id="grade" name="grade[]">
    <option  value=4.00>A+</option>
    <option  value=3.75>A</option>
    <option  value=3.50>A-</option>
    <option  value=3.25>B+</option>
    <option value=3.00>B</option>
    <option  value=2.75>B-</option>
    <option  value=2.50>C+</option>
    <option  value=2.25>C</option>
   
    <option  value=2.00>D</option>
    <option  value=0>F</option>
  </select>
 </td>
  <td>
  <label for="credit">Choose a credit:</label>
  <select id="credit" name="credit[]">
    <option value=0.75>0.75</option>
    <option value=1.00>1.00</option>
    <option value=1.50>1.50</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
    
  
  </select>
  
</td>
</tr>
<?php
}
?>

</table>
<button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>


</body>
</html>