<?php 
class Imdb
{
  // Get movie information by Movie Title.
  // This method searches the given title on Google, Bing or Ask to get the best possible match.
  public function getMovieInfo($title, $getExtraInfo = true)
  {
    $imdbId = $this->getIMDbIdFromSearch(trim($title));
    if($imdbId === NULL){
      $arr = array();
      $arr['error'] = "No Title found in Search Results!";
      return $arr;
    }
    return $this->getMovieInfoById($imdbId, $getExtraInfo);
  }
  // Get movie information by IMDb Id.
  public function getMovieInfoById($imdbId, $getExtraInfo = true)
  {
    $arr = array();
    $imdbUrl = "https://www.imdb.com/title/" . trim($imdbId) . "/";
    return $this->scrapeMovieInfo($imdbUrl, $getExtraInfo);
  }
  // Scrape movie information from IMDb page and return results in an array.
  private function scrapeMovieInfo($imdbUrl, $getExtraInfo = true)
  {
    $arr = array();
    $html = $this->geturl("${imdbUrl}reference");
	$arr['poster'] = $this->match('/<link rel=.image_src. href="(.*?)"/msi', $html, 1);
    if (!empty($arr['poster'])) { 
      $arr['poster'] = preg_replace('/_V1.*?.jpg/ms', "_V1._SY200.jpg", $arr['poster']);
  }
  $mposter=$arr['poster'];
  return $mposter;
  }
  private function getIMDbIdFromSearch($title, $engine = "google"){
    switch ($engine) {
      case "google":  $nextEngine = "bing";  break;
      case "bing":    $nextEngine = "ask";   break;
      case "ask":     $nextEngine = "yahoo";   break;
	  case "yahoo":     $nextEngine = "aol";   break;
	  case "aol":     $nextEngine = "yippy";   break;
	  case "yippy":     $nextEngine = "duckduckgo";   break;
	  case "aol":     $nextEngine = "yippy";   break;
	  case "yippy":     $nextEngine = "lycos";   break;
      case FALSE:     return NULL;
      default:        return NULL;
    }
    $url = "http://www.${engine}.com/search?q=imdb+" . rawurlencode($title);
    $ids = $this->match_all('/<a.*?href="https?:\/\/www.imdb.com\/title\/(tt\d+).*?".*?>.*?<\/a>/ms', $this->geturl($url), 1);
    if (!isset($ids[0]) || empty($ids[0])) //if search failed
      return $this->getIMDbIdFromSearch($title, $nextEngine); //move to next search engine
    else
      return $ids[0]; //return first IMDb result
  }
  private function geturl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $ip=rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/".rand(3,5).".".rand(0,3)." (Windows NT ".rand(3,5).".".rand(0,2)."; rv:2.0.1) Gecko/20100101 Firefox/".rand(3,5).".0.1");
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
  }
  private function match_all_key_value($regex, $str, $keyIndex = 1, $valueIndex = 2){
    $arr = array();
    preg_match_all($regex, $str, $matches, PREG_SET_ORDER);
    foreach($matches as $m){
      $arr[$m[$keyIndex]] = $m[$valueIndex];
    }
    return $arr;
  }
  private function match_all($regex, $str, $i = 0){
    if(preg_match_all($regex, $str, $matches) === false)
      return false;
    else
      return $matches[$i];
  }
  private function match($regex, $str, $i = 0){
    if(preg_match($regex, $str, $match) == 1)
      return $match[$i];
    else
      return false;
  }
}
//$smovie=$_POST['smovie'];
$smovie="psycho";
$slmovie=strtolower($smovie);
$i = new Imdb();
$poster = $i->getMovieInfo($smovie);
echo "<img style=\"position:absolute; top:35px;\" src='$poster'>";
mysqli_close($conn);	
?>