<?php 
$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"moviesdb");
$smovie=$_POST['smovie'];
$sgenre=$_POST['gmovie'];
$sactor=$_POST['amovie'];
$sdirec=$_POST['adirec'];
echo "<style>a:link{color: black;}</style>";

echo "<form action=\"landing.html\"><input style=\"width:150px; height:25px; border-radius:30px; font-family:'coolvetica'; font-size:15px;\"type='submit' value=\"Back to Lookup View\"><br>";
if($smovie)
{
$slmovie=strtolower($smovie);
$q="select * from moviesinfo where lower(title) LIKE '%$slmovie%' ORDER by score desc;";
$shmovie=mysqli_query($conn,$q);
$nrec=mysqli_num_rows($shmovie);
if (mysqli_num_rows($shmovie) > 0) {
while($nrec)
{
		$pname = mysqli_fetch_assoc($shmovie);
    if($pname) {
		$surl=$pname["url"];
        echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\">";
		
		echo "<font color=\"white\" face=\"Century Gothic\"><h1>"."<a href=$surl>".$pname["title"]."(".$pname["ryear"].")</a>";
		echo "</h1><h2>".$pname["director"]."</h2><h3>".$pname["duration"]." Minutes</h3><h3>".$pname["actor"]."</h3><h3>".$pname["genre"]."</h3>";	
		echo "<br>-------------------------------------------------------------------------------";
	}
	$nrec-=1;
}
}
else
{
	echo"<body style=\"background-image:url('background.png')\"> <center><font color=\"white\" face=\"coolvetica\"><h2>We don't recognize this movie!<br><a href='landing.html'>Try Again</a>";
}
}


elseif($sgenre)
{
$slgenre=strtolower($sgenre);
$q="select * from moviesinfo where lower(genre) LIKE '$slgenre%' ORDER by score desc;";
$shmovie=mysqli_query($conn,$q);
$nrec=mysqli_num_rows($shmovie);
if (mysqli_num_rows($shmovie) > 0) {
while($nrec)
{
		$pname = mysqli_fetch_assoc($shmovie);
    if($pname) {
		$surl=$pname["url"];
        echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\">";
		echo "<font color=\"white\" face=\"Century Gothic\"><h1>"."<a href=$surl>".$pname["title"]."(".$pname["ryear"].")</a>";
		echo "</h1><h2>".$pname["director"]."</h2><h3>".$pname["duration"]." Minutes</h3><h3>".$pname["actor"]."</h3><h3>".$pname["genre"]."</h3>";
		echo "<br>-------------------------------------------------------------------------------";
	}
}
$nrec-=1;
}
else
{
	echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\"> <center><font color=\"white\" face=\"coolvetica\"><h2>We don't recognize this movie!<br><a href='landing.html'>Try Again</a>";
}
}


elseif($sactor)
{
$slactor=strtolower($sactor);
$q="select * from moviesinfo where lower(actor) LIKE '$slactor%' ORDER by score desc;";
$shmovie=mysqli_query($conn,$q);
$nrec=mysqli_num_rows($shmovie);
if (mysqli_num_rows($shmovie) > 0) {
while($nrec)
{
		$pname = mysqli_fetch_assoc($shmovie);
    if($pname) {
		$surl=$pname["url"];
        echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\">";
		echo "<font color=\"white\" face=\"Century Gothic\"><h1>"."<a href=$surl>".$pname["title"]."(".$pname["ryear"].")</a>";
		echo "</h1><h2>".$pname["director"]."</h2><h3>".$pname["duration"]." Minutes</h3><h3>".$pname["actor"]."</h3><h3>".$pname["genre"]."</h3>";	
		echo "<br>-------------------------------------------------------------------------------";
	}
}
$nrec-=1;
}

else
{
	echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\"> <center><font color=\"white\" face=\"coolvetica\"><h2>We don't recognize this movie!<br><a href='landing.html'>Try Again</a>";
}
}


elseif($sdirec)
{
$sldirec=strtolower($sdirec);
$q="select * from moviesinfo where lower(director) LIKE '$sldirec%' ORDER by score desc;";
$shmovie=mysqli_query($conn,$q);
$nrec=mysqli_num_rows($shmovie);
if (mysqli_num_rows($shmovie) > 0) {
while($nrec)
{
	$pname = mysqli_fetch_assoc($shmovie);
    if($pname) {
		$surl=$pname["url"];
        echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\">";
		echo "<font color=\"white\" face=\"Century Gothic\"><h1>"."<a href=$surl>".$pname["title"]."(".$pname["ryear"].")</a>";
		echo "</h1><h2>".$pname["director"]."</h2><h3>".$pname["duration"]." Minutes</h3><h3>".$pname["actor"]."</h3><h3>".$pname["genre"]."</h3>";	
		echo "<br>-------------------------------------------------------------------------------";
	}
}
$nrec-=1;
}
else
{
	echo "<body style=\"background-image: linear-gradient(120deg,#00537E,#3AA17E);\"> <center><font color=\"white\" face=\"coolvetica\"><h2>We don't recognize this movie!<br><a href='landing.html'>Try Again</a>";
}
}
mysqli_close($conn);	
?>