<?php
if(isset($_POST['usrid']))
{
	$fuid=$_POST['usrid'];
	$cookie_name = "userid";
	$cookie_value = $fuid;
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
}
else
{
	$fuid=$_COOKIE['userid'];
}
echo "<form action=\"login.php\"><input style=\"border-radius:20px;\" type=\"submit\" value=\"Go Back Home.\"></form>";
$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn,"moviesdb");
if(isset($_POST['usrid']))
{
$usrid=$_POST['usrid'];
$usrnm=$_POST['usrnm'];
$genre=$_POST['genre'];
$q = "UPDATE userinfo SET uid=$usrid, name='$usrnm', genre='$genre' where uid=$usrid or name='$usrnm' or genre='$genre'";
mysqli_query($conn,$q);
}	
echo "<link rel=\"stylesheet\" href=\"tab.css\"><table><th><td>User Name</td><td>Genre</td><td>Action</td></th>";
$q="select * from userinfo where uid=$fuid";
$uname = mysqli_query($conn,$q);
$nrec=mysqli_num_rows($uname);
$pname=mysqli_fetch_assoc($uname);
$u=$pname['uid'];
$n=$pname['name'];
$g=$pname['genre'];
echo "<form method=\"post\" action=\"updusr.php\"><tr><td><input type=\"text\" name=\"usrid\" value=\"$u\"></td>
<td><input type=\"text\" name=\"usrnm\" value=\"$n\"></td><td><input type=\"text\" name=\"genre\" value=\"$g\"></td><td>
	 <input style=\"border-radius:20px;\" type=\"submit\" value=\"Edit\"></form></td></tr>";
?>
		