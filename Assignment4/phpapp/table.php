<?php
echo '<table border="1">';
$file = fopen("cookies.txt", "r") or die("Unable to open file!");
while (!feof($file)){
    $data = fgets($file);
    echo "<tr><td>" . str_replace('|','</td><td>',$data) . '</td></tr>';
}
echo '</table>';
fclose($file);
?>