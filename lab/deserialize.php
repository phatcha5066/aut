<?php
$p=$_POST["payload"]??'{"type":"User","data":{"name":"WAAP-UAT"}}';$r="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $o=json_decode($p,true);
 if(!is_array($o))$r="Rejected: malformed object";
 elseif(($o["type"]??"")!=="User")$r="Rejected: unexpected serialized type";
 else $r="Accepted safe User object: ".($o["data"]["name"]??"");
}
?><!doctype html><meta charset="utf-8"><h1>Deserialization UAT</h1>
<p>Safe type/object validation; intentionally contains no unserialize gadget or RCE.</p>
<form method="post"><textarea name="payload" rows="8" cols="80"><?=htmlspecialchars($p)?></textarea>
<br><button>Deserialize</button></form><pre><?=htmlspecialchars($r)?></pre>