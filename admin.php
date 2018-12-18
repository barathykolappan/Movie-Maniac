<?php
echo "<form action=\"login.php\"><input style=\"border-radius:20px;\" type=\"submit\" value=\"Go Back Home.\"></form>";
$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn,"moviesdb");
if(isset($_POST['usrid']))
{
$usrid=$_POST['usrid'];
$q = "DELETE FROM userinfo WHERE uid=$usrid";
mysqli_query($conn,$q);
}
echo "<link rel=\"stylesheet\" href=\"tab.css\"><table><th><td>User Name</td><td>Genre</td><td>Action</td></th>";
$q="select * from userinfo";
$uname = mysqli_query($conn,$q);
$nrec=mysqli_num_rows($uname);
while($nrec)
{
$pname=mysqli_fetch_assoc($uname);
if($pname){
$u=$pname['uid'];
echo "<tr><td>".$pname['uid']."</td><td>".$pname['name']."</td><td>".$pname['genre']."</td><td><form method=\"post\" action=\"admin.php\">
	<input type=\"hidden\" name=\"usrid\" value=\"$u\"> <input style=\"border-radius:20px;\" type=\"submit\" value=\"X\"></form></td></tr>";
}
$nrec-=1;
}
?>
		