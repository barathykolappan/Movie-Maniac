<?php 
$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"moviesdb");
$ct=$_POST['ct'];
$t=$_POST['tmovie'];
$r=$_POST['rmovie'];
$d=$_POST['dmovie'];
$a=$_POST['amovie'];
$s=$_POST['amovie'];
$g=$_POST['gmovie'];
$du=$_POST['dumovie'];
$url="";
if(isset($_POST['umovie']))
$url=$_POST['umovie'];
echo "<form action=\"landing.html\"><input style=\"width:150px; height:25px; border-radius:30px; font-family:'coolvetica'; font-size:15px;\"type='submit' value=\"Back to Lookup View\"><br>";
$q="update moviesinfo set title='$t',director='$d',duration='$du',actor='$a',genre='$g',votes=0,ryear='$r',score=0,url='$url' where lower(title)=lower('$ct');	";
mysqli_query($conn,$q) or die(mysqli_error($conn));
echo "<h3>Updated ".$t." (".$r.") Successfully!</h3>";
mysqli_close($conn);	
?>