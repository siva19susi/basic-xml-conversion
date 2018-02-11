<?php
$name = $_GET["name"];
$xmlaction = $_GET["xmlaction"];
$fileInfo = $_GET["fileInfo"];
$target_file = "upload/".$fileInfo;

if(file_exists($target_file))
{
	$xml = simplexml_load_file($target_file);

	$f = tmpfile();
	$f = csvCreate($xml, $f);
	rewind($f);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($fileInfo, ".xml").'.csv"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');

	fpassthru($f);
	fclose($f);
}

function csvCreate($xml, $f)
{
	foreach ($xml->children() as $item) 
	{
		$hasChild = (count($item->children()) > 0)?true:false;
		if( ! $hasChild)
		{
			$put_arr = array($item->getName(),$item); 
			fputcsv($f, $put_arr , ',', '"');
		}
		else
		{
			csvCreate($item, $f);
		}
	}
	return $f;
}
?>