<?php

require_once ('dbConnection.php');

class DAOStuff {

    private $datab;
    private $connector;
    public static $Dao_user_info;

    public function __construct() {
        $this->datab = dbConnection::instance();
        $this->connector = $this->datab->getConnection();
    }

    public function instance() {
        if (!isset(self::$Dao_user_info)) {
            self::$Dao_user_info = new DAOStuff();
            return self::$Dao_user_info;
        } else {
            return self::$Dao_user_info;
        }
    }

    public function remove_userById($IdUser) {
        //removes user from data base by username
        $sql_delete = "DELETE FROM `tbl_users` WHERE `IdUser` ='$IdUser'";
        $success = mysql_query($sql_delete) or die(mysql_error());

        if ($success) {
            echo("The user with Id: $IdUser, has been successfully deleted");
        } else {
            echo("Error, User id $IdUser could not be deleted!.");
        }
    }

    public function deleteTable($tableName) {
        $query = "DROP TABLE IF EXISTS `$tableName`";
        $success1 = mysql_query($query) or die(mysql_error());

        if ($success1) {
            echo("Table $tableName successfully deleted");
        } else {
            echo("Failed to delete $tableName table!.");
        }
    }

    public function createTable() {

        $query2 = "CREATE TABLE `tabletesto` (
             `id` int(11) NOT NULL auto_increment,
             `usertesto` varchar (50) default NULL,
             PRIMARY KEY (`id`)
             ) ENGINE = MyISAM DEFAULT CHARSET=latin1";

        $success2 = mysql_query($query2) or die(mysql_error());

        if ($success2) {
            echo("Table created");
        } else {
            echo("Failed to create table");
        }
    }

    public function obtainUserInfo($userName, $userId) {
        $query_userInfo = "SELECT * FROM `tbl_users`
                            WHERE userLogin ='$userName' and idUser='$userId'";
        $success = mysql_query($query_userInfo) or die(mysql_error());

        while ($row = mysql_fetch_array($success)) {
            $userNumUp = $row[3];
            $userName = $row[1];
            $userEmail = $row[4];
            echo("User's Number of Uploads: " . json_encode($userNumUp));
            echo("Login name: " . json_encode($userName) . " ");
            echo("Email: " . json_encode($userEmail) . " ");
        }
    }

    public function userIdToUserName($userId) {
        $sql_getId = "SELECT userLogin FROM `tbl_users` WHERE idUser ='$userId'";
        $success = mysql_query($sql_getId) or die(mysql_error());
        $fetching = mysql_fetch_assoc($success);

        if ($success) {
            return $fetching['userLogin'];
        } else {
            echo("operation failed");
        }
    }

    public function removeUser($idUser) {
        $sql_delete = "DELETE FROM `Tbl_users` WHERE `idUser` ='$idUser'";
        $success = mysql_query($sql_delete) or die(mysql_error());
        if ($success) {
            echo("Successfull operation, user with $idUser deleted");
        } else {
            echo("Failed to succeed!");
        }
    }

    public function getUserIdByUsername($username) {

        $sql_getId = "SELECT idUser FROM `tbl_users` WHERE userLogin ='$username'";
        $success = mysql_query($sql_getId) or die(mysql_error());
        $fetching = mysql_fetch_assoc($success);

        if ($success) {
            return ($fetching['idUsuario']);
        } else {
            echo("operación con errores");
        }
    }

    public function verifyUser($username, $password) {
        $verify = "SELECT idUser
                        FROM `Tbl_users`
                            WHERE userLogin = '$username' AND userPassword = '$password'";
        $success = mysql_query($verify);
        $array = array();
        while ($row = mysql_fetch_array($success)) {
            array_push($array, $row['idUsuario']);
        }
        if ($array == null) {
            //return("Sorry, you are not on the list!");
            return 0;
        } else {
            //return("welcome");
            $state = "UPDATE tbl_usuario SET estado = 1 WHERE usuario = '$username'";
            mysql_query($state);
            return 1;
        }
    }

    public function insertUser($username, $userPass, $userEmail) {

        $in = "INSERT INTO `tbl_users`(userLogin,userPassword,userNumUploads,userEmail)
                VALUES('$username','$userPass',0,'$userEmail')";
        $success = mysql_query($in) or die(mysql_error());
        if ($success) {
            echo("Operation Successfull!");
        } else {
            echo("Operation failed!");
        }
    }

    public function insertImage($imageName, $imageType, $imageFormat, $imageDesc, $imagePath, $imageCategory, $file) {
        $addImage = "INSERT INTO `tbl_imagedata` (imageName,imageType,
            imageFormat, imageDescription,imagePath,imageCategory,savedImage)
                    VALUES('$imageName','$imageType','$imageFormat',
                            '$imageDesc','$imagePath','$imageCategory','$file')";
        $success = mysql_query($addImage) or die(mysql_error());

        if ($success) {
            echo("Operation Successfull!");
        } else {
            echo("Operation failed!");
        }
    }

    public function downImage($imageId, $imageType) {

        $findImage = "SELECT savedImage 
                        FROM `Tbl_imagedata`
                           WHERE IdImage = '$imageId'
                               AND imageType = '$imageType'";

        $success = mysql_query($findImage) or die(mysql_error());

        if (mysql_num_rows($success) == 0) {
            echo "Database is empty <br>";
        } else {
            while (list($id, $name) = mysql_fetch_array($success)) {
                
            }
        }
    }

    public function validateUser($username, $password) {
        $username = str_replace("'", "''", $username);
        $password = md5($password);

        $verify = "SELECT userPassword FROM `Tbl_users`
                        WHERE userLogin = '$username'";
        $success = mysql_query($verify) or die(mysql_error());
        if (!$success || (mysql_num_rows($success) < 1)) {
            return 1; //failed to verify
        }

        $dbArray = mysql_fetch_array($success);

        if ($password == $dbArray['userPassword']) {
            return 0; //yep user exists.
        } else {
            return 1; //password failure;
        }
    }
    
    public function getImgToDisplay() {
        $img_querry = "SELECT imagePath FROM `Tbl_imagedata`";
        $success = mysql_query($img_querry) or die(mysql_error());
        $arImg = Array();
        while ($row = mysql_fetch_array($success)) {
            array_push($arImg, $row['imagePath']);
        }
        echo(json_encode($arImg));
    }

}

?>