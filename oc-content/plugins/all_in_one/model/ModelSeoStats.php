<?php
class PR {
 public function get_google_pagerank($url) {
 $query="http://toolbarqueries.google.com/tbr?client=navclient-auto&ch=".$this->CheckHash($this->HashURL($url)). "&features=Rank&q=info:".$url."&num=100&filter=0";
 $data=file_get_contents($query);
 $pos = strpos($data, "Rank_");
 if($pos === false){} else{
 $pagerank = substr($data, $pos + 9);
 return $pagerank;
 }
 }
 public function StrToNum($Str, $Check, $Magic)
 {
 $Int32Unit = 4294967296; // 2^32
 $length = strlen($Str);
 for ($i = 0; $i < $length; $i++) {
 $Check *= $Magic;
 if ($Check >= $Int32Unit) {
 $Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
 $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
 }
 $Check += ord($Str{$i});
 }
 return $Check;
 }
 public function HashURL($String)
 {
 $Check1 = $this->StrToNum($String, 0x1505, 0x21);
 $Check2 = $this->StrToNum($String, 0, 0x1003F);
 $Check1 >>= 2;
 $Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F);
 $Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF);
 $Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF);
 $T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F );
 $T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 );
 return ($T1 | $T2);
 }
 public function CheckHash($Hashnum)
 {
 $CheckByte = 0;
 $Flag = 0;
 $HashStr = sprintf('%u', $Hashnum) ;
 $length = strlen($HashStr);
 for ($i = $length - 1; $i >= 0; $i --) {
 $Re = $HashStr{$i};
 if (1 === ($Flag % 2)) {
 $Re += $Re;
 $Re = (int)($Re / 10) + ($Re % 10);
 }
 $CheckByte += $Re;
 $Flag ++;
 }
 $CheckByte %= 10;
 if (0 !== $CheckByte) {
 $CheckByte = 10 - $CheckByte;
 if (1 === ($Flag % 2) ) {
 if (1 === ($CheckByte % 2)) {
 $CheckByte += 9;
 }
 $CheckByte >>= 1;
 }
 }
 return '7'.$CheckByte.$HashStr;
 }
}

function GoogleBL($domain){
$url="http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=link:".$domain."&filter=0";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_NOBODY, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$json = curl_exec($ch);
curl_close($ch);
$data=json_decode($json,true);
if($data['responseStatus']==200)
return $data['responseData']['cursor']['resultCount'];
else
return false;
}

function GoogleIP($domain){
$url="http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=site:".$domain."&filter=0";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_NOBODY, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$json = curl_exec($ch);
curl_close($ch);
$data=json_decode($json,true);
if($data['responseStatus']==200)
return $data['responseData']['cursor']['resultCount'];
else
return false;
}

class shareCount {
private $url,$timeout;
function __construct($url,$timeout=10) {
$this->url=rawurlencode($url);
$this->timeout=$timeout;
}
function get_tweets() { 
$json_string = $this->file_get_contents_curl('http://urls.api.twitter.com/1/urls/count.json?url=' . $this->url);
$json = json_decode($json_string, true);
return isset($json['count'])?intval($json['count']):0;
}
function get_linkedin() { 
$json_string = $this->file_get_contents_curl("http://www.linkedin.com/countserv/count/share?url=$this->url&format=json");
$json = json_decode($json_string, true);
return isset($json['count'])?intval($json['count']):0;
}
function get_fb() {
$json_string = $this->file_get_contents_curl('http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls='.$this->url);
$json = json_decode($json_string, true);
return isset($json[0]['total_count'])?intval($json[0]['total_count']):0;
}
function get_plusones()  {
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($this->url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$curl_results = curl_exec ($curl);
curl_close ($curl);
$json = json_decode($curl_results, true);
return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
}
function get_stumble() {
$json_string = $this->file_get_contents_curl('http://www.stumbleupon.com/services/1.01/badge.getinfo?url='.$this->url);
$json = json_decode($json_string, true);
return isset($json['result']['views'])?intval($json['result']['views']):0;
}
function get_delicious() {
$json_string = $this->file_get_contents_curl('http://feeds.delicious.com/v2/json/urlinfo/data?url='.$this->url);
$json = json_decode($json_string, true);
return isset($json[0]['total_posts'])?intval($json[0]['total_posts']):0;
}
function get_pinterest() {
$return_data = $this->file_get_contents_curl('http://api.pinterest.com/v1/urls/count.json?url='.$this->url);
$json_string = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $return_data);
$json = json_decode($json_string, true);
return isset($json['count'])?intval($json['count']):0;
}
private function file_get_contents_curl($url){
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
$cont = curl_exec($ch);
if(curl_error($ch))
{
die(curl_error($ch));
}
return $cont;
}
}
?>