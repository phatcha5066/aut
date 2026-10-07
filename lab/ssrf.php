<?php
$r="";$u=$_GET["url"]??"";
if($u){
 $p=parse_url($u); $h=$p["host"]??""; $path=$p["path"]??"";
 $self=explode(":",$_SERVER["HTTP_HOST"]??"")[0];
 if(!in_array($p["scheme"]??"",["http","https"],true)) $r="Rejected: HTTP(S) only";
 elseif(strcasecmp($h,$self)!==0 || !str_ends_with($path,"/callback.php"))
   $r="Rejected by lab allowlist: use this host + /callback.php";
 else {
   $c=stream_context_create(["http"=>["timeout"=>3,"follow_location"=>0]]);
   $v=@file_get_contents($u,false,$c); $r=$v===false?"Callback failed":$v;
 }
}
?><!doctype html><meta charset="utf-8"><h1>SSRF UAT</h1>
<p>Server-side fetch is restricted to callback.php on this Lab host.</p>
<form><input name="url" size="90" value="<?=htmlspecialchars($u)?>">
<button>Fetch</button></form><pre><?=htmlspecialchars($r)?></pre>