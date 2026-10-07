<?php
$r=""; $x=$_POST["xml"]??"";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $d=new DOMDocument();
 // UAT: entity substitution for detection, but network access disabled.
 $ok=@$d->loadXML($x, LIBXML_NOENT|LIBXML_NONET);
 $r=$ok?$d->textContent:"XML rejected";
}
?><!doctype html><meta charset="utf-8"><h1>XXE UAT</h1>
<p>Benign XML/DOCTYPE/ENTITY test. Do not use file:// or real server data.</p>
<form method="post"><textarea name="xml" rows="10" cols="80"><?=
htmlspecialchars($x?:'<?xml version="1.0"?><user><name>WAAP-UAT</name></user>')
?></textarea><br><button>Send XML</button></form><pre><?=htmlspecialchars($r)?></pre>