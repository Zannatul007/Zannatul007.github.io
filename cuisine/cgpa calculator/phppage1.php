
<?php  
//$grade=$_POST['grade'];


//session_start();

/*$credit=array();
$i=0;
if(isset($_POST['credit0']))
{
$credit[$i]=$_POST['credit'.$i];
$i++;
}
$j=$i;
$i=0;
for($i=0;$i<$j;$i++)
{
    echo '<p>' . $credit[$i] . '<br>';

}

$i=0;

if(isset($_POST['subjectname'.$i]) && isset($_POST['credit'.$i])){        

$_SESSION['info'][] = array($_POST['subjectname'.$i] => $_POST['credit');
$i++;

}

$j=0;
if(isset($_SESSION['info'])) {
for($i = 0; $i < count($_SESSION['info']); $i++) {
  foreach($_SESSION['info'][$i] as $subjectname => $credit){
    echo '<p>' . $subjectname . '<br>';
    echo $credit . '</p>';
 }
}
//$j++; 
}

*/
$i=0;
if (isset($_POST['credit'])) {
    foreach($_POST['credit'] as $w){
        echo "<li>$w</li>\n";  
}

}
?>


