<?
mysql_connect("localhost", "root", "1234");
mysql_query("set names utf8");
$q=mysql_query("SELECT MAX(序號) FROM  `chiayi`.`chinshinbio` WHERE `年` = '105' AND `月` = '6' AND `區別` = '22'");
while($n=mysql_fetch_array($q))
{
	echo $n[0];
}

?>