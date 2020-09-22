<?php
include_once('session.php');
include_once('../../includes/globalVars.php');
include_once('utils.php');
include_once(PATH_DATABASE_INC);
$db = Database::getInstance();
$connection = $db->getConnection();
$cod = $_REQUEST['code'];
$cmd = "SELECT * from tb_actionslog WHERE code='$cod'";
if($result = $connection->query($cmd)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['status'];
        $msg = $row['message'];
        echo "true||".$status."||".$msg;
        die();
    }
}else{
    echo "false";
}