<?php

//include '../DAO/DAOStuff.php';
include($_SERVER["DOCUMENT_ROOT"] . "/DAO/DAOStuff.php");

$theTest = new DAOStuff();
$theTest->instance();

return ($theTest->getImgToDisplay());

?>