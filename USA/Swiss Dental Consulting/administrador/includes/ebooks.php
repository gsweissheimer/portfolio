<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'addEbookTag':
    funAddEbookTag();
    break;

  case 'getEbookTranslationForm':
    funGetEbookTranslationItem();
    break;

  case 'addEbook':
    funAddEbook();
    break;

  case 'getEbooks':
    funGetEbooks();
    break;

  case 'deleteEbook':
    funDeleteEbook();
    break;

  case 'getEbookTranslationFormData':
    funGetEbookTranslationItemData();
    break;

  case 'editEbook':
    funEditEbook();
    break;

  default:
    // code...
    break;
}

function funEditEbook()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    //var_dump($_REQUEST, $_FILES);
    //exit(0);

    $idEbook = $_REQUEST['id'];
    $idTag = $_REQUEST['tagId'];
    $idCountry = $_REQUEST['countryId'];

    $viDateC = "'".date('Y-m-d H:i:s')."'";

    $sqlCmd = 'SELECT
                tb_language.id,
                tb_language.lang,
                tb_language.langMin,
                tb_country.abbCountry
        FROM tb_country_language
        JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
        JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
        WHERE tb_country_language.status =1
        AND
          tb_country.id='.$idCountry.'
        ORDER BY tb_country_language.defaultLang DESC';

    $inserted = false;
    $result2 = $connection->query($sqlCmd);
    if ($result2) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $langCode = $row['langMin'];
            $countryCode = $row['abbCountry'];
            $idLang = $row['id'];

            $title = $_REQUEST['title_'.$countryCode.'_'.$langCode];
            $description = $_REQUEST['description_'.$countryCode.'_'.$langCode];
            $idGallery = $_REQUEST['ebook_img_'.$countryCode.'_'.$langCode];
            $filepath = funUploadEbookFile($_FILES, $countryCode, $langCode);

            $sqlCmd2 = "UPDATE tb_ebooks_translation SET
              title='$title',
              description='$description',
              idTbGallery=$idGallery ";

            if ($filepath) {
                $sqlCmd2 .= ", filepath='$filepath'";
            }

            $sqlCmd2 .= " WHERE idTbEbooks=$idEbook AND idTbLanguage=$idLang";

            $result3 = $connection->query($sqlCmd2);
            if ($result3) {
                $inserted = true;
            }
        }

        if ($inserted) {
            $db->commitAndClose();
            echo 'true||Operação realizada com sucesso.';
        } else {
            $db->rollbackAndClose();
            die('false||Ocorreu um erro ao inserir a ebook.');
        }
    }
}

function funGetEbookTranslationItemData()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listFormBar = '';
    $listNavBar = '';
    $allInfo = '';

    $idTag = null;
    $idCountry = null;
    $idEbooks = $_REQUEST['id'];

    $mysql = "SELECT idTbCountry FROM tb_ebooks WHERE tb_ebooks.id=$idEbooks";
    $res = $connection->query($mysql);
    if ($res) {
        $row2 = mysqli_fetch_assoc($res);
        $idCountry = $row2['idTbCountry'];
    }

    $sqlCmd = 'SELECT
                   tb_language.id,
                   tb_language.lang,
                   tb_language.langMin,
                   tb_country.abbCountry
            FROM tb_country_language
            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
            WHERE tb_country_language.status =1
            AND
             tb_country.id='.$idCountry.'
            ORDER BY tb_country_language.defaultLang DESC';

    $result = $connection->query($sqlCmd);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($listNavBar == '') {
                $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
            } else {
                $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
            }

            if ($listFormBar != '') {
                $flag = false;
            } else {
                $flag = true;
            }

            $idLang = $row['id'];
            $viArrayValues['country'] = $row['abbCountry'];
            $viArrayValues['langMin'] = $row['langMin'];

            $mysql = 'SELECT 
              tb_ebooks.idTbEbooksTag as idTag,
              tb_ebooks_translation.title,
              tb_ebooks_translation.description,
              tb_ebooks_translation.idTbGallery,
              tb_gallery.path,
              tb_ebooks_translation.filepath
            FROM tb_ebooks
            JOIN tb_ebooks_translation ON tb_ebooks.id = tb_ebooks_translation.idTbEbooks
            JOIN tb_gallery ON tb_gallery.id = tb_ebooks_translation.idTbGallery
            WHERE tb_ebooks.id='.$idEbooks.'
            AND tb_ebooks_translation.idTbLanguage='.$idLang;

            if ($myResult = $connection->query($mysql)) {
                $myRow = mysqli_fetch_assoc($myResult);
                $idTag = $myRow['idTag'];
                $viArrayValues['title'] = $myRow['title'];
                $viArrayValues['description'] = $myRow['description'];
                $viArrayValues['ebook_img_id'] = $myRow['idTbGallery'];
                $viArrayValues['ebook_img_path'] = '../'.$myRow['path'];
                $viArrayValues['ebook_file_path'] = '../'.$myRow['filepath'];
            }

            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateEbookTranslationItem($viArrayValues);
        }
        $allInfo .= '<ul id="navBar" class="nav nav-tabs">';
        $allInfo .= $listNavBar;
        $allInfo .= '</ul>';
        $allInfo .= '<div id="tabContent" class="tab-content">';
        $allInfo .= $listFormBar;
        $allInfo .= '</div>';
    }
    //echo "true||$listNavBar";
    //exit(0);
    echo 'true||'.$allInfo.'||'.$idCountry.'||'.$idTag;
}

function funDeleteEbook()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $ebookId = $_REQUEST['id'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdDeleteImage = "UPDATE tb_ebooks SET dateO= $viDateC, userO = $usr_id, status = 0 WHERE id='$ebookId'";
    $result = $connection->query($sqlCmdDeleteImage);
    if ($result) {
        $action = '[DELETE ADVANCED BANNER] - Sucess deleting #'.$ebookId;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE ADVANCED BANNER] - Error deleting #'.$ebookId;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funGetEbooks()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sql = 'SELECT 
      tb_ebooks.id,
      tb_ebooks_tag.tag,
      tb_country.country,
      tb_ebooks_translation.title,
      tb_gallery.path,
      tb_ebooks_translation.filepath,
      tb_ebooks_translation.download_count 
    FROM tb_ebooks
    JOIN tb_ebooks_translation ON tb_ebooks.id = tb_ebooks_translation.idTbEbooks
    JOIN tb_ebooks_tag ON tb_ebooks.idTbEbooksTag = tb_ebooks_tag.id
    JOIN tb_country ON tb_ebooks.idTbCountry = tb_country.id
    JOIN tb_gallery ON tb_gallery.id = tb_ebooks_translation.idTbGallery
    WHERE tb_ebooks.status <> 0
    AND tb_ebooks_translation.idTbLanguage = (
      SELECT id FROM tb_language WHERE tb_language.langMin="PT"
    )';

    $values = '';
    $arrayMain = [];
    //var_dump($sqlCmd);
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='ebooks-editar.php?id=".$row['id']."'";
            $urlToDelete = 'funDeleteItem('.$row['id'].')';
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            $img = "<img style='width: 80px;' class='img-responsive' src='../".$row['path']."'>";
            $anchor = "<a href='../".$row['filepath']."'>".basename($row['filepath']).'</a>';
            array_push($arrayMain, [$row['id'], $row['tag'], $row['country'], $row['title'], $img, $anchor, $row['download_count'], $values]);
        }
    }
    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funUploadEbookFile($files, $country, $lang)
{
    $file = $files['ebook_'.$country.'_'.$lang];
    $folder = '../../'.PATH_EBOOKS.'/'.$country.'/'.$lang;

    if (!$file['name']) {
        return false;
    }

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $target = $folder.'/'.basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $target)) {
        return PATH_EBOOKS.'/'.$country.'/'.$lang.'/'.basename($file['name']);
    } else {
        return false;
    }
}

function funAddEbook()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    //var_dump($_REQUEST, $_FILES);
    //exit(0);

    $idTag = $_REQUEST['tagId'];
    $idCountry = $_REQUEST['countryId'];

    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sql = "INSERT INTO tb_ebooks (dateO, userO, status, idTbEbooksTag, idTbCountry)
    VALUES ($viDateC, $usr_id, 1, $idTag, $idCountry)";

    if ($result = $connection->query($sql)) {
        $idEbook = $connection->insert_id;

        $sqlCmd = 'SELECT
                   tb_language.id,
                   tb_language.lang,
                   tb_language.langMin,
                   tb_country.abbCountry
            FROM tb_country_language
            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
            WHERE tb_country_language.status =1
            AND
             tb_country.id='.$idCountry.'
            ORDER BY tb_country_language.defaultLang DESC';

        $inserted = false;
        $result2 = $connection->query($sqlCmd);
        if ($result2) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $langCode = $row['langMin'];
                $countryCode = $row['abbCountry'];
                $idLang = $row['id'];

                $title = $_REQUEST['title_'.$countryCode.'_'.$langCode];
                $description = $_REQUEST['description_'.$countryCode.'_'.$langCode];
                $idGallery = $_REQUEST['ebook_img_'.$countryCode.'_'.$langCode];
                $filepath = funUploadEbookFile($_FILES, $countryCode, $langCode);

                if ($filepath) {
                    $sqlCmd2 = "INSERT INTO 
                    tb_ebooks_translation (
                      dateC, 
                      title,
                      description, 
                      status, 
                      filepath, 
                      idTbLanguage, 
                      idTbEbooks, 
                      idTbCountry, 
                      idTbGallery
                  ) VALUES (
                    $viDateC, 
                    '$title', 
                    '$description', 
                    1, 
                    '$filepath', 
                    $idLang, 
                    $idEbook, 
                    $idCountry, 
                    $idGallery
                  )";

                    $result3 = $connection->query($sqlCmd2);
                    if ($result3) {
                        $inserted = true;
                    }
                }
            }

            if ($inserted) {
                $db->commitAndClose();
                echo 'true||Operação realizada com sucesso.';
            } else {
                $db->rollbackAndClose();
                die('false||Ocorreu um erro ao inserir a ebook.');
            }
        }
    }
}

function funAddEbookTag()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $ebookTag = $_REQUEST['ebookTag'];

    $sqlCmd = "INSERT INTO tb_ebooks_tag (dateO, userO, tag) VALUES ($viDateC, $usr_id, '$ebookTag')";

    $result = $connection->query($sqlCmd);

    if ($result) {
        $new_id = $connection->insert_id;
        $action = '[ADD_TAG] - Sucess added #'.$new_id;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[ADD_TAG] - sql failed';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Ocorreu um erro ao inserir a tag.');
    }
}

function funGetEbookTranslationItem()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listFormBar = '';
    $listNavBar = '';
    $allInfo = '';

    $idCountry = $_REQUEST['idC'];

    $sqlCmd = 'SELECT
                   tb_language.id,
                   tb_language.lang,
                   tb_language.langMin,
                   tb_country.abbCountry
            FROM tb_country_language
            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
            WHERE tb_country_language.status =1
            AND
             tb_country.id='.$idCountry.'
            ORDER BY tb_country_language.defaultLang DESC';

    $result = $connection->query($sqlCmd);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($listNavBar == '') {
                $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
            } else {
                $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
            }

            if ($listFormBar != '') {
                $flag = false;
            } else {
                $flag = true;
            }
            $viArrayValues['country'] = $row['abbCountry'];
            $viArrayValues['langMin'] = $row['langMin'];
            $viArrayValues['title'] = '';
            $viArrayValues['description'] = '';
            $viArrayValues['ebook_img_id'] = '';
            $viArrayValues['ebook_img_path'] = '';
            $viArrayValues['ebook_file_path'] = '';
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateEbookTranslationItem($viArrayValues);
        }
        $allInfo .= '<ul id="navBar" class="nav nav-tabs">';
        $allInfo .= $listNavBar;
        $allInfo .= '</ul>';
        $allInfo .= '<div id="tabContent" class="tab-content">';
        $allInfo .= $listFormBar;
        $allInfo .= '</div>';
    }
    //echo "true||$listNavBar";
    //exit(0);
    echo 'true||'.$allInfo;
}

function funCreateEbookTranslationItem($vfArrayValues)
{
    if ($vfArrayValues['flag'] == 'true') {
        $active = 'active';
    } else {
        $active = '';
    }
    $vfLangMin = $vfArrayValues['langMin'];
    $vfCountry = $vfArrayValues['country'];
    $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Título</label>';
    $value .= '			<textarea id="title" name="title_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['title'].'</textarea>';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Descrição</label>';
    $value .= '			<textarea id="title" name="description_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['description'].'</textarea>';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Imagem da Capa</label>';
    $value .= '			<span onclick=funOpenGallery(false,"ebook_img_'.$vfCountry.'_'.$vfLangMin.'","image") class="btn btn-success">Choose Image</span>';
    $value .= '     <input type="hidden" id="ebook_img_'.$vfCountry.'_'.$vfLangMin.'" name="ebook_img_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['ebook_img_id'].'">';
    $value .= '     <img class="img-responsive" id="bg_ebook_img_'.$vfCountry.'_'.$vfLangMin.'" src="'.$vfArrayValues['ebook_img_path'].'">';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Ebook</label>';
    $value .= '     <input type="file" id="ebook_'.$vfCountry.'_'.$vfLangMin.'" name="ebook_'.$vfCountry.'_'.$vfLangMin.'" >';
    $value .= '		  <a target="_blank" href="'.$vfArrayValues['ebook_file_path'].'">'.$vfArrayValues['ebook_file_path'].'</a>';
    $value .= '		</div>';
    $value .= '</div>';

    return $value;
}
