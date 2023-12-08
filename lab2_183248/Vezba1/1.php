<?php
//Vezba 1.1

$array = array(2, 5, 6, 10, 41, 24, 32, 9, 16, 19);
$associative_array = array("Momchilo" => "Momcihlo", "Iliev" => "Iliev", "Gevgelija" => "Gevgelija");
$matrix = array(array(1, 2, 3), array(1, 2, 3), array(1, 2, 3));

$array_above_20 = array();


//Vezba 1.2
foreach ($array as $value) {
    echo $value . " ";
    if ($value > 20) {
        array_push($array_above_20, $value);
    }
}

echo "<br>";
echo "<br>";

foreach ($associative_array as $key => $value) {
    echo $key . " => " . $value . ", ";
}


echo "<br>";
echo "<br>";

foreach ($matrix as $row) {
    foreach ($row as $element) {
        echo $element . " ";
    }
}

echo "<br>";
echo "<br>";


//Vezba 1.3
foreach ($array_above_20 as $value) {
    echo $value . " ";
}

echo "<br>";
echo "<br>";

//Vezba 1.4
$sentence = "PHP is great!";
$words = explode(" ", $sentence);
$length_of_words = array();

foreach ($words as $key => $value) {
    $length_of_words[$value] = strlen($value);
}

foreach ($length_of_words as $key => $value) {
    echo $key . " => " . $value . " <br>";
}
