<?php
if(isset($_POST['uid']))
{
	$fuid=$_POST['uid'];
	$cookie_name = "userid";
	$cookie_value = $fuid;
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
}
else
{
	$fuid=$_COOKIE['userid'];
}
echo "<style>a:link{color: black;}</style>";
$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"moviesdb");
if($fuid==123)
{
echo "<form action=\"admin.php\"><input style=\" position:absolute; top:15px; left:1150px; border-radius:20px;\" type=\"submit\" value=\"  Admin Settings  \"></form>";		
}
else
{
echo "<form action=\"updusr.php\"><input style=\" position:absolute; top:15px; left:1150px; border-radius:20px;\" type=\"submit\" value=\"  User Settings  \"></form>";		
	
}
$q="select name from userinfo where uid=$fuid;";
$uname=mysqli_query($conn,$q);
if (mysqli_num_rows($uname)>0) {
		$pname = mysqli_fetch_assoc($uname);
    if($pname) {
		
        echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#ffffff);\">";
		echo "<center><font color=\"white\" face=\"Century Gothic\"><h2>Hello ".$pname["name"]."!</center>";
		echo "<form action=\"index.html\"><input style=\" position:absolute; top:15px; left:1280px; border-radius:20px;\" type=\"submit\" value=\"X\"></form>";
		$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"moviesdb");
echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\">";
$q="select genre from userinfo where uid=$fuid";
$shmovie=mysqli_query($conn,$q);
if (mysqli_num_rows($shmovie) > 0)
{
	$pname = mysqli_fetch_assoc($shmovie);
    if($pname) {
	$ugenre=$pname['genre'];
	$ugArr = explode(',', $ugenre);
echo "<h1>By Year:</h1>";
	{
	foreach($ugArr as $item)
	{
	$i=4;
	$q="select * from moviesinfo where lower(genre) LIKE '$item%' ORDER by ryear desc;";
	$shmovie=mysqli_query($conn,$q);
	$nrec=mysqli_num_rows($shmovie);
	if (mysqli_num_rows($shmovie) > 0) {
	while($i>0)
	{
	$pname = mysqli_fetch_assoc($shmovie);
    if($pname) {
		$surl=$pname["url"];
		echo "<font color=\"white\" face=\"Century Gothic\"><h5>"."<a href=$surl>".$pname["title"]."(".$pname["ryear"].")</a></h5>";
	}
	$i-=1;
}
}
}

echo "</font><h1 style=\" position:absolute; left:500px; top:40px;\">By Popularity:</h1><font style=\" position:absolute; left:500px; top:100px;\" color=\"white\" face=\"Century Gothic\">";
	{
	foreach($ugArr as $item)
	{
	$i=4;
	$q="select * from moviesinfo where lower(genre) LIKE '$item%' ORDER by votes desc;";
	$shmovie=mysqli_query($conn,$q);
	$nrec=mysqli_num_rows($shmovie);
	if (mysqli_num_rows($shmovie) > 0) {
	while($i>0)
	{
	$pname = mysqli_fetch_assoc($shmovie);
    if($pname) {
		$surl=$pname["url"];
		echo "<h5>"."<a href=$surl>".$pname["title"]."(".$pname["ryear"].")</a></h5>";
	}
	$i-=1;
}
}
}

echo "</font><h1 style=\" position:absolute; left:1000px; top:40px;\">By Rating:</h1><font style=\" position:absolute; left:1000px; top:100px;\" color=\"white\" face=\"Century Gothic\">";
{
	foreach($ugArr as $item)
	{
	$i=4;
	$q="select * from moviesinfo where lower(genre) LIKE '$item%' ORDER by score desc;";
	$shmovie=mysqli_query($conn,$q);
	$nrec=mysqli_num_rows($shmovie);
	if (mysqli_num_rows($shmovie) > 0) {
	while($i>0)
{
	$pname = mysqli_fetch_assoc($shmovie);
    if($pname) {
		$surl=$pname["url"];
		echo "<h5>"."<a href=$surl>".$pname["title"]."(".$pname["ryear"].")</a></h5>";
	}
	$i-=1;
}}}}}}}}}
echo "</font>";
echo "<center><form action=\"landing.html\"><input style=\"width:250px; height:50px; border-radius:30px; font-family:'coolvetica'; font-size:20px;\"type='submit' value=\"Switch to Lookup View\">";
}
else
{
	echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\"> <font color=\"white\" face=\"Century Gothic\"><h2>We don't recognize you!";
}

mysqli_close($conn);
?>