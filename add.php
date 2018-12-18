<?php 
$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"moviesdb");
$t=$_POST['tmovie'];
$r=$_POST['rmovie'];
$d=$_POST['dmovie'];
$a=$_POST['amovie'];
$s=$_POST['amovie'];
$g=$_POST['gmovie'];
$du=$_POST['dumovie'];
$last_row = mysqli_fetch_assoc(mysqli_query($conn,	"select * from moviesinfo order by mid desc limit 1"));
$mid=$last_row["mid"]+1;
echo "<form action=\"landing.html\"><input style=\"width:150px; height:25px; border-radius:30px; font-family:'coolvetica'; font-size:15px;\"type='submit' value=\"Back to Lookup View\"><br>";
$q="insert into moviesinfo values('$mid','$t','$d','$du','$a','$g',0,'$r',0,\"\")";
mysqli_query($conn,$q) or die(mysqli_error($conn));
echo "<h3>Added ".$t." (".$r.") Successfully!</h3>";
mysqli_close($conn);	
?>