<?php
    include '../../includes/globalVars.php';
    $cmdEval = $_REQUEST['cmdEval'];
    switch ($cmdEval) {
        case 'deleteUser':
            funDeleteUser();
            break;
        case 'deleteTranslation':
                funDeleteTranslation();
                break;
        case 'deleteClinic':
                funDeleteClinic();
                break;
        case 'deleteVideo':
                funDeleteVideo();
                break;
        case 'deleteAdvantage':
                funDeleteAdvantage();
                break;
        case 'deleteImage':
            funDeleteImageGallery();
            break;
        case 'deleteTitleFaq':
            funDeleteTitleFaq();
            break;
        case 'deleteModelos':
            funDeleteModelos();
            break;
        case 'deleteModelImage':
            funDeleteModelImage();
            break;
        case 'deleteSpec':
            funDeleteSpec();
            break;
        case 'deletePopup':
            funDeletePopup();
            break;

        default:
            // code...
            break;
    }

    function funDeletePopup()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $popupId = $_REQUEST['id'];
        $viDateC = "'".date('Y-m-d H:i:s')."'";
        $sqlCmdDeleteImage = "UPDATE tb_popup_customise SET _status = 0 WHERE id='$popupId'";
        $result = $connection->query($sqlCmdDeleteImage);
        if ($result) {
            $action = '[DELETE_CLINIC] - Sucess deleting #'.$popupId;
            funCreateLog($action, $connection);
            $db->commitAndClose();
            echo 'true||Operação realizada com sucesso.';
        } else {
            $action = '[DELETE_CLINIC] - Error deleting #'.$popupId;
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            echo 'false||Operação Falhou.';
        }
    }

    function funDeleteUser()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $id = $_REQUEST['id'];
        $viDateC = "'".date('Y-m-d H:i:s')."'";
        $sqlCmd = "UPDATE tb_users SET dateU=$viDateC, deleted = 1 WHERE id='$id'";
        $result = $connection->query($sqlCmd);
        if ($result) {
            $action = '[DELETE_USER] - Sucess deleting #'.$id;
            funCreateLog($action, $connection);
            $db->commitAndClose();
            echo 'true||Operação realizada com sucesso.';
        } else {
            $action = '[DELETE_USER] - Error Editing #'.$id;
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            echo 'false||Operação Falhou.';
        }
    }

        function funDeleteTranslation()
        {
            include_once 'session.php';
            include_once 'utils.php';
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $id = $_REQUEST['id'];
            $viDateC = "'".date('Y-m-d H:i:s')."'";
            $sqlCmd = "UPDATE tb_translations_codes SET dateU=$viDateC, deleted = 1 WHERE id='$id'";
            $result = $connection->query($sqlCmd);
            if ($result) {
                $action = '[DELETE_TRANSLATION] - Sucess deleting #'.$id;
                funCreateLog($action, $connection);
                $db->commitAndClose();
                echo 'true||Operação realizada com sucesso.';
            } else {
                $action = '[DELETE_TRANSLATION] - Error Editing #'.$id;
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                echo 'false||Operação Falhou.';
            }
        }

function funDeleteClinic()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $id = $_REQUEST['id'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdDeleteClinic = "UPDATE tb_clinicas SET dateU=$viDateC, deleted = 1 WHERE id='$id'";
    $result = $connection->query($sqlCmdDeleteClinic);
    if ($result) {
        $action = '[DELETE_CLINIC] - Sucess deleting #'.$id;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE_CLINIC] - Error deleting #'.$id;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funDeleteVideo()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $id = $_REQUEST['id'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdDeleteVideo = "UPDATE tb_videos SET status = 1 WHERE id='$id'";
    $result = $connection->query($sqlCmdDeleteVideo);
    if ($result) {
        $action = '[DELETE_VIDEO] - Sucess deleting #'.$id;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE_VIDEO] - Error deleting #'.$id;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funDeleteAdvantage()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $id = $_REQUEST['id'];

    $sqlCmd = "UPDATE tb_advantage_main SET status = 1 WHERE id='$id'";
    $result = $connection->query($sqlCmd);
    if ($result) {
        $action = '[DELETE_ADVANTAGE] - Sucess deleting #'.$id;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE_ADVANTAGE] - Error deleting #'.$id;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Oopss... Aconteceu um erro ao tentar eliminar.';
    }
}

function funDeleteImageGallery()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $imageId = $_REQUEST['id'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdDeleteImage = "UPDATE tb_gallery SET dateU=$viDateC, deleted = 1 WHERE id='$imageId'";
    $result = $connection->query($sqlCmdDeleteImage);
    if ($result) {
        $action = '[DELETE_CLINIC] - Sucess deleting #'.$imageId;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE_CLINIC] - Error deleting #'.$imageId;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
    funCloseConn($connection);
}

function funDeleteTitleFaq()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $id = $_REQUEST['id'];
    $sqlCmdDeleteImage = "UPDATE tb_title_faqs SET deleted = 1 WHERE id=$id";
    $result = $connection->query($sqlCmdDeleteImage);
    if ($result) {
        $action = '[DELETE_TITLE_FAQ] - Sucess deleting #'.$id;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE_TITLE_FAQ] - Error deleting #'.$id;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funDeleteModelos()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $id = $_REQUEST['id'];
    $viDateO = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdDeleteImage = "UPDATE tb_models SET dateO = $viDateO, userO = $usr_id, deleted = 1 WHERE id='$id'";
    $result = $connection->query($sqlCmdDeleteImage);
    if ($result) {
        $action = '[DELETE_CLINIC] - Sucess deleting #'.$id;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE_CLINIC] - Error deleting #'.$id;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funDeleteSpec()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $id = $_REQUEST['id'];
    $viDateO = "'".date('Y-m-d H:i:s')."'";

    $sqlCmdDeleteSpec = "UPDATE tb_specs SET dateO=$viDateO, userO=$usr_id, status = 1 WHERE id=$id";

    if ($result = $connection->query($sqlCmdDeleteSpec)) {
        $action = '[DELETE_SPEC] - Sucess deleting #'.$id;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE_SPEC] - Error deleting #'.$id;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}
