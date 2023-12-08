<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Datoteka:</label> <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="Upload"/> 
</form>


<?php

$upload_path = 'upload/';
$maxSize = 300  * 1024; //300KB
$allowed_ext = ['txt'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filename = basename($file['name']);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);


    if($file['size']<= $maxSize && in_array($ext, $allowed_ext)){
        $destination = $upload_path . $filename;
        move_uploaded_file($file['tmp_name'], $destination);
    }
    else{
        echo 'Max TXT file size is 300KB!';
    }
}