<?php
$usrid=$_POST['uid'];
$usrname=$_POST['uname'];
$genr=$_POST['genre'];
$genre="";
foreach ($genr as $g)
$genre=$genre.",".$g;

$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"moviesdb");
$num_rows = mysqli_num_rows(mysqli_query($conn,"select * from userinfo where uid='$usrid'"));

if(preg_match("/\d/",$usrid)){
if ($num_rows) {
   echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\">";
echo "<center><font color=\"white\" face=\"coolvetica\"><h3>User ID Exists!</h3><br><a href=\"login_fresh.html\">Click here to try again.";
}
else
{
$q="insert into userinfo (uid,name,genre) values('$usrid','$usrname','$genre');";
mysqli_query($conn,$q) or die(mysqli_error($conn));
echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\">";
echo "<center><font color=\"white\" face=\"coolvetica\"><h3>Registered Successfully!</h3><br><a href=\"index.html\">Click here to Login.";
}
}
else
{
echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\">";
echo "<center><font color=\"white\" face=\"coolvetica\"><h3>User ID can only be numbers!</h3><br><a href=\"login_fresh.html\">Click here to Try Again.";
}
mysqli_close($conn);

?>