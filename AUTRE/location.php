<?php
$externalContent = file_get_contents('http://checkip.dyndns.com/');
preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
$externalIp = $m[1];

//echo $externalIp;
$api = '612512e886d0873f70aaa0830e58bf9a';
$url='http://api.ipstack.com/';
$ipAddr = $externalIp;
echo $ipAddr."<br>";
echo $url.$ipAddr.'?access_key='.$api .'<br>';

echo 'http://api.ipstack.com/193.51.159.250?access_key=612512e886d0873f70aaa0830e58bf9a' .'<br>';

$geoIP  = json_decode(file_get_contents($url.$ipAddr.'?access_key='.$api), true);

echo 'lat: ' . $geoIP['latitude'] . '<br />';
echo 'long: ' . $geoIP['longitude'];

?>
