<?php

include '../DAO/DAOStuff.php';
$theTest = new DAOStuff();
$theTest->instance();
if(isset($_POST['input'],$_POST['password'],$_POST['email'])){
    $userName = $_POST['input'];
    $userPass = $_POST['password'];
    $userEmail = $_POST['email'];
}

$theTest->insertUser($userName,$userPass,$userEmail);

?>