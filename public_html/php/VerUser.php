<?php

include '../DAO/DAOStuff.php';
//include($_SERVER["DOCUMENT_ROOT"] . "/public_html/DAO/DAOStuff.php");
$theTest = new DAOStuff();
$theTest->instance();

if (isset($_POST['username'], $_POST['password'])) {
    $userName = $_POST['username'];
    $userPass = $_POST['password'];
}

$result = $theTest->validateUser($userName, $userPass);
if ($result == 0) {
    header('Location: ../vistas/UploadImages.html');
} else {
    header('Location: ../vistas/UserLogin.html');
}
?>