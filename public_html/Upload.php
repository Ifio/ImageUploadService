<?php

include 'DAO/DAOStuff.php';

$testCon = new DAOStuff();
$fileName = $_FILES["file"]["name"];
$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file"]["type"];
$fileSize = $_FILES["file"]["size"];
$fileErrorMsg = $_FILES["file"]["error"]; // 0 = false | 1 = true
$kaboom = explode(".", $fileName);
/*
if (isset($_POST['catText'], $_POST['txtArea_1'])) {
    $category = $_POST['catText'];
    $desc = $_POST['txtArea_1'];
} */

$category = $_POST['catText'];
$desc = $_POST['desc'];

$fileExt = end($kaboom);
$fsMult = 10;
$fileLimitSize = 1048576 * $fsMult;

// START PHP Image Upload Error Handling --------------------------------------------------
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} else if ($fileSize > $fileLimitSize) {
    echo "ERROR: Your file was larger than $fsMult Megabytes in size.";
    //unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName)) {

    echo "ERROR: Your image was not .gif, .jpg, or .png.";
    // unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if ($fileErrorMsg == 1) {
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}

// END PHP Image Upload Error Handling ----------------------------------------------------
// Place it into your "uploads" folder mow using the move_uploaded_file() function
$moveResult = move_uploaded_file($fileTmpLoc, "uploads/$fileName");
$path = "uploads/$fileName";
//$testCon->insertImage($fileName, $fileType, $fileExt, "lol", $path,$category, "file");
$testCon->insertImage($fileName, $fileType, $fileExt, $desc, $path,$category, "file");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again." + $moveResult;
    //unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
}
//unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder

echo "The file named <strong>$fileName</strong> uploaded successfuly.<br /><br />";
echo "It is <strong>$fileSize</strong> bytes in size.<br /><br />";
echo "It is an <strong>$fileType</strong> type of file.<br /><br />";
echo "The file extension is <strong>$fileExt</strong><br /><br />";
echo "The Error Message output for this upload is: $fileErrorMsg";
?>