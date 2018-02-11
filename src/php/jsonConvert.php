<pre>
<?php

$name = $_POST["name"];
$xmlaction = $_POST["xmlaction"];
$fileInfo = basename($_FILES["file"]["name"]);

$xml = simplexml_load_file($_FILES["file"]["tmp_name"]);
$json = json_encode($xml, JSON_PRETTY_PRINT);

echo($json);

?>
</pre>