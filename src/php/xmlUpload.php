<?php

$target_dir = "upload/";
$filename = $_POST["name"]."_".basename($_FILES["file"]["name"]);
$target_file = $target_dir.$filename;

if(file_exists($target_file)) 
{
    chmod($target_file, 0755);
    unlink($target_file);
}

if(!file_exists($target_file))
{
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
    {
        echo $filename." has been uploaded.";
    } 
    else 
    {
        echo "Error while uploading the file.";
    }
}

?>