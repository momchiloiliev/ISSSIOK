<?php
if (isset($_POST['submit'])) {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $pol = $_POST['pol'] == '1' ? 'Masko' : 'Zensko';

    echo "Ime: " . $ime . "<br/>";
    echo "Prezime: " . $prezime . "<br/>";
    echo "Email: " . $email . "<br/>";
    echo "Pol: " . $pol . "<br/>";
}

