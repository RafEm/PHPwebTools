<?php
#SIMPLE PHP HIT COUNTER. IT IS GENERATING 4 DIFERENT LOG FILES
#

#set your root domain:
$domainRoot = "";

$dirRoot = $_SERVER["DOCUMENT_ROOT"];

#set your logfile time offset if you want 
$timeOffset = "-1 hours";

$serverTz = date("e");
date_default_timezone_set($serverTz);

#if you want to ignore hits from your own address, or hostname set it here: 
$ignoreIP = "";
$ignoreHostname = "";

$pv1=getenv("HTTP_HOST");
$pv2=getenv("REQUEST_URI");

if(! preg_match("/^$pv1$/","$domainRoot")){
$subdomain = explode(".",$pv1);
$dirRoot = str_replace("/$subdomain[0]","",$dirRoot);
}

#if you don't use 'www' in your domain name, set redirect:
if((preg_match("/www./",$pv1) and (!preg_match("/www./",$domainRoot)){
$redirect=ereg_replace("www.","",$pv1);
header("Location: http://$redirect");
exit();
}
#comment above if statement to use 'www' in your domain name

$pageVisited="$pv1$pv2";
$pageVisited=ereg_replace(".$rootDomain","",$pageVisited);
$pageVisited=ereg_replace("/","",$pageVisited);
$guest_ip=getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($guest_ip);

if(($guest_ip != $ignoreIP) and ($hostname != $ignoreHostname)) {

$when=date("[j.m][H:i:s] ", strtotime($timeOffset));
$who="$guest_ip";
$ref=getenv("HTTP_REFERER");
$soft=getenv("HTTP_USER_AGENT");

if(preg_match("/Mobile/i",$soft)){
$mobile=true;
$plat="mobile";
}else{
$plat="desktop";
}

$fhit="<nobr><span style=\"font-size:13px;font-family:verdana \">$when -- $who -- <strong>$pageVisited</strong>  -- $soft -- <strong>$ref</strong></span></nobr><br />";

$hits_file = fopen("$dirRoot/hits.html", "a");
file_put_contents("$dirRoot/fhits.html",$fhit,FILE_APPEND);


if(preg_match("/W3C_Validator/i","$soft")){
fclose($hits_file); $isbot="true";
}

if(preg_match("/googlebot/i","$soft")){
$plat="GOOGLEBOT";
$isbot="true";

if(preg_match("/mobile/i",$soft)){
$plat="GOOGLEBOT MOBILE";

}
}
if(preg_match("/bingbot/i","$soft")){
$plat="BINGBOT";
$isbot="true";
}


if($isbot){
$hit="<nobr><span style=\"font-size:14px;font-family:verdana \">$when -- $who -- <strong>$pageVisited</strong> -- <strong>$plat</strong></span></nobr><br />";
file_put_contents("$dirRoot/bhits.html",$hit,FILE_APPEND);
}


$hit="<nobr><span style=\"font-size:14px;font-family:verdana \">$when -- $who -- <strong>$pageVisited</strong> -- <strong>$plat</strong> -- <strong>$ref</strong></span></nobr><br />";


#some common crawlers user-agents:

if(preg_match("/Google Search Console/i","$soft")){
fclose($hits_file); $isbot="true";
}

if(preg_match("/Mediapartners-Google/i","$soft")){
fclose($hits_file); $isbot="true";
}

if(preg_match("/spider/i","$soft")){
fclose($hits_file); $isbot="true";
}
if(preg_match("/Google Web Preview/i","$soft")){
fclose($hits_file); $isbot="true";
}
if(preg_match("/crawler/i","$soft")){
fclose($hits_file); $isbot="true";
}
if(preg_match("/Wappalyzer/i","$soft")){
fclose($hits_file); $isbot="true";
}
if(preg_match("/publiclibraryarchive.org/i","$soft")){
fclose($hits_file); $isbot="true";
}
if(preg_match("/slurp/i","$soft")){
fclose($hits_file); $isbot="true";
}
if(preg_match("/Java/i","$soft")){
fclose($hits_file); $isbot="true";
}
if(preg_match("/bot/i","$soft")){
fclose($hits_file); $isbot="true";
}

if(preg_match("/Google Favicon/i","$soft")){
fclose($hits_file); $isbot="true";
}
if($soft == ""){
fclose($hits_file); $isbot="true";
}

if($soft == "GigablastOpenSource/1.0"){
fclose($hits_file); $isbot="true";
}

if($soft == "Wget/1.13.4 (linux-gnu)"){
fclose($hits_file); $isbot="true";
}
if($soft == "Riddler"){
fclose($hits_file); $isbot="true";
}
if($soft == "UASTRING"){
fclose($hits_file); $isbot="true";
}
if(preg_match("/BUbiNG/i","$soft")){
fclose($hits_file); $isbot="true";
}
if($guest_ip == "176.31.234.48"){
fclose($hits_file); $isbot="true";
}

if(preg_match("/NetcraftSurveyAgent/i","$soft")){
fclose($hits_file); $isbot="true";
}

if(preg_match("/SiteExplorer/i","$soft")){
fclose($hits_file); $isbot="true";
}

if(preg_match("/crawl@worldwebheritage.org/i","$soft")){
fclose($hits_file); $isbot="true";
}

if(preg_match("/Apache HttpClient/i","$soft")){
fclose($hits_file); $isbot="true";
}else{
if(!preg_match("/net-promo.pl/","$pageVisited")){
if(!isset($isbot)){
fwrite($hits_file, $hit);
fclose($hits_file);
}
}

if(preg_match("/.google./","$ref")){
file_put_contents("$dirRoot/ghits.html","$hit",FILE_APPEND);
}
}
}

?>