<?php

include '../DAO/DAOStuff.php';
$theTest = new DAOStuff();
$theTest->instance();

return ($theTest->getImgToDisplay());

?>