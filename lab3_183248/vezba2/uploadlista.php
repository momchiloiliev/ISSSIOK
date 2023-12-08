<?php

$uploadPath = 'upload/';

$files = scandir($uploadPath);

echo '<h2>File List:</h2>';
echo '<ul>';
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
    echo '<li>' . basename($file) . '</li>';
    }
}
echo '</ul>';

?>