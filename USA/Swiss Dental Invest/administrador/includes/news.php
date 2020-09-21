<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getCountryLang':
    funGetCountryLang();
    break;
  case 'addNews':
    funAddNews();
    break;
  case 'getNews':
    funGetNews();
    break;
  case 'deleteNews':
    funDeleteNews();
    break;
  case 'getNew':
    funGetNew();
    break;
  case 'editNews':
    funEditNews();
    break;
  default:
    // code...
    break;
}

function funCreateNewsItems($vfArrayValues)
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
    $value .= '			<input id="title" name="title_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['title'].'" required> ';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>SubTítulo</label>';
    $value .= '			<input id="subTitle" name="subTitle_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['subTitle'].'" required> ';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Keywords</label>';
    $value .= '			<input id="keywords" name="keywords_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['keywords'].'" required> ';
    $value .= '		</div>';
    $value .= '		<div class="form-group">';
    $value .= '			<label>Descrição</label>';
    $value .= '			<textarea id="desc_'.$vfCountry.'_'.$vfLangMin.'" name="desc_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['desc'].'</textarea>';
    $value .= '		</div>';
    $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
    $value .= '</div>';

    return $value;
}

function funGetCountryLang()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listFormBar = '';
    $listNavBar = '';
    $allInfo = '';

    $idCountry = $_REQUEST['countryId'];

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
            $viArrayValues['subTitle'] = '';
            $viArrayValues['desc'] = '';
            $viArrayValues['keywords'] = '';
            $viArrayValues['idTrans'] = '';
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateNewsItems($viArrayValues);
        }
        $allInfo .= '<ul id="navBar" class="nav nav-tabs">';
        $allInfo .= $listNavBar;
        $allInfo .= '</ul>';
        $allInfo .= '<div id="tabContent" class="tab-content">';
        $allInfo .= $listFormBar;
        $allInfo .= '</div>';
    }
    echo 'true||'.$allInfo;
}

function funAddNews()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    //var_dump("OK");
    //exit(0);
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $viDate = "'".date('Y-m-d')."'";
    $inserted = false;
    date_default_timezone_set('America/Los_Angeles');
    $idCountry = $_REQUEST['countryBanner'];
    $type = $_REQUEST['typeBanner'];
    $category = $_REQUEST['category'];
    $editor = $_REQUEST['editor'];
    if (isset($_REQUEST['datepicker'])) {
        $datepicker = $_REQUEST['datepicker'];
    } else {
        $datepicker = '';
    }
    //$datepicker=date("Y-m-d", strtotime($datepicker));
    $image = $_REQUEST['og_img'];
    $codeRef = $_REQUEST['codOper'];
    funUpdateRefOperation($codeRef, '-1', '', $connection);
    if (isset($_REQUEST['highlight'])) {
        $highlight = $_REQUEST['highlight'];
    } else {
        $highlight = '';
    }
    if ($highlight == '') {
        $sqlInsertMedia = 'INSERT INTO tb_news (dateO, userO, highlight, publishDate, type, category, editor, status, idTbGallery, idTbCountry)';
        $sqlInsertMedia .= " VALUES ($viDateC, $usr_id, 0, '$datepicker', '$type', '$category', '$editor',1, '$image', $idCountry)";
    //echo $sqlInsertMedia;
    } else {
        $sqlInsertMedia = 'INSERT INTO tb_news (dateO, userO, highlight, publishDate, type, category, editor, status, idTbGallery, idTbCountry)';
        $sqlInsertMedia .= " VALUES ($viDateC, $usr_id, $highlight, '$datepicker', '$type', '$category', '$editor',1, '$image', $idCountry)";
        //echo $sqlInsertMedia;
    }
    // echo($sqlInsertMedia);
    // exit;
    if ($result = $connection->query($sqlInsertMedia)) {
        $idNews = $connection->insert_id;

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
               tb_country.id='.$idCountry;
        if ($result = $connection->query($sqlCmd)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idLang = $row['id'];
                $title = $_REQUEST['title_'.$row['abbCountry'].'_'.$row['langMin']];
                $subTitle = $_REQUEST['subTitle_'.$row['abbCountry'].'_'.$row['langMin']];
                $keywords = $_REQUEST['keywords_'.$row['abbCountry'].'_'.$row['langMin']];
                $desc = $_REQUEST['desc_'.$row['abbCountry'].'_'.$row['langMin']];
                $sqlAddMediaTrans = 'INSERT INTO tb_news_translation (dateO, userO, title, subTitle, details, idTbLanguage, idTbNews, keywords)';
                $sqlAddMediaTrans .= " VALUES ($viDateC, $usr_id, '$title', '$subTitle', '$desc', $idLang, $idNews, '$keywords')";
                $result1 = $connection->query($sqlAddMediaTrans);
                if (!$result1) {
                    $inserted = false;
                    $action = '[ADD MEDIA] - Failed add  PARTNER TRANSLATIONS';
                    funCreateLog($action, $connection);
                    $msg = 'Failed to add news translation';
                    funUpdateRefOperation($codeRef, '0', $msg, $connection);
                    $db->rollbackAndClose();
                    funCloseTab();
                    die('false||Ocorreu um problema ao inserir news #0002');
                    funCloseTab();
                } else {
                    $inserted = true;
                }
            }
            if ($inserted) {
                echo 'true||Operação realizada com sucesso.';
                $msg = 'Operação realizada com sucesso';
                funUpdateRefOperation($codeRef, '1', $msg, $connection);
                $action = '[ADD MEDIA] - Success adding news';
                funCreateLog($action, $connection);
                $db->commitAndClose();
                funCloseTab();
            }
        }
    } else {
        $action = '[ADD MEDIA] - Failed adding media';
        funCreateLog($action, $connection);
        $msg = 'Operação realizada com sucesso';
        funUpdateRefOperation($codeRef, '0', $msg, $connection);
        $db->rollbackAndClose();
        funCloseTab();
        die('false||Ocorreu um erro ao adicionar o news.');
    }
}

function funGetNews()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlGetNews = 'SELECT
                  tb_news_translation.title,
                  tb_news.id,
                  tb_country.country
                FROM
                  tb_news
                INNER JOIN tb_news_translation ON tb_news_translation.idTbNews = tb_news.id
                INNER JOIN tb_country ON tb_country.id = tb_news.idTbCountry
                WHERE
                  tb_news.status = 1
                GROUP BY tb_news.id'
                ;
    $values = '';
    if ($result = $connection->query($sqlGetNews)) {
        $arrayMain = [];
        while ($rsData = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='noticias-editar.php?id=".$rsData['id']."'";
            $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            array_push($arrayMain, [$rsData['id'], $rsData['title'], $rsData['country'], $values]);
        }
    }
    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funDeleteNews()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $id = $_REQUEST['id'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdDeleteClinic = "UPDATE tb_news SET dateO=$viDateC, userO=$usr_id, status = 0 WHERE id='$id'";
    $result = $connection->query($sqlCmdDeleteClinic);
    if ($result) {
        $action = '[DELETE MEDIA] - Sucess deleting #'.$id;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE MEDIA] - Error deleting #'.$id;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funGetNew()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $id = $_REQUEST['id'];
    $listFormBar = '';
    $listNavBar = '';

    $sqlCmd = "SELECT
            tb_language.langMin,
            tb_language.id,
            tb_country.id AS 'idCountry',
            tb_country.abbCountry,
            tb_news_translation.id as idTrans,
            tb_news_translation.title,
            tb_news_translation.subTitle,
            tb_news_translation.details AS 'desc',
            tb_news_translation.keywords,
            tb_news.idTbGallery,
            -- tb_gallery.path,
            tb_news.highlight,
            tb_news.publishDate,
            tb_news.type,
            tb_news.category,
            tb_news.editor
            FROM
            tb_news
            JOIN tb_news_translation ON tb_news_translation.idTbNews = tb_news.id
            -- JOIN tb_gallery ON tb_gallery.id = tb_news.idTbGallery
            JOIN tb_country ON tb_country.id = tb_news.idTbCountry AND tb_news.idTbCountry = tb_country.id
            JOIN tb_language ON tb_language.id = tb_news_translation.idTbLanguage
            WHERE tb_news.id = $id";

    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $idTbGallery = $row['idTbGallery'];
            $idTrans = $row['idTrans'];
            $title = $row['title'];
            $subTitle = $row['subTitle'];
            $highlight = $row['highlight'];
            $publishDate = $row['publishDate'];
            $type = $row['type'];
            $category = $row['category'];
            $desc = $row['desc'];
            $editor = $row['editor'];
            
            /** ver o path de cada uma como vai no advanced */
           // $galleryPath = '../'.$row['path'];
            
            $abbCountry = $row['abbCountry'];
            $langMin = $row['langMin'];
            $idCountry = $row['idCountry'];
            $keywords = $row['keywords'];

            if ($listNavBar == '') {
                $listNavBar = '<li class="active"><a href="#'.$langMin.'" data-toggle="tab" aria-expanded="true">'.$langMin.'</a></li>';
            } else {
                $listNavBar .= '<li class=""><a href="#'.$langMin.'" data-toggle="tab" aria-expanded="true">'.$langMin.'</a></li>';
            }

            if ($listFormBar != '') {
                $flag = false;
            } else {
                $flag = true;
            }
            $viArrayValues['country'] = $row['abbCountry'];
            $viArrayValues['langMin'] = $langMin;
            $viArrayValues['title'] = $title;
            $viArrayValues['subTitle'] = $subTitle;
            $viArrayValues['desc'] = $desc;
            $viArrayValues['idTrans'] = $idTrans;
            $viArrayValues['flag'] = $flag;
            $viArrayValues['keywords'] = $keywords;
            $listFormBar .= funCreateNewsItems($viArrayValues);

            
            $gallery = array();
            $arrayGallery = explode('||', $row['idTbGallery']);
            foreach ($arrayGallery as $key => $id) {
                $sqlCmd = 'SELECT * FROM tb_gallery WHERE id='.$id;
                if ($result4 = $connection->query($sqlCmd)) {
                    while ($rowGal = mysqli_fetch_assoc($result4)) {
                        array_push($gallery, array(
                            'id' => $id,
                            'path' => $rowGal['path'],
                        ));
                    }
                }
            }
            
        }
        $allInfo = '<ul id="navBar" class="nav nav-tabs">';
        $allInfo .= $listNavBar;
        $allInfo .= '</ul>';
        $allInfo .= '<div id="tabContent" class="tab-content">';
        $allInfo .= $listFormBar;
        $allInfo .= '</div>';
    }
    echo 'true||'.$allInfo.'||'.$idCountry.'||1||'.$highlight.'||'.$publishDate.'||'.$type.'||'.$category.'||'.$editor.'||'.json_encode($gallery);
}

function funEditNews()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $viDate = "'".date('Y-m-d')."'";
    $inserted = false;
    date_default_timezone_set('America/Los_Angeles');
    $idCountry = $_REQUEST['countryBanner'];
    $type = $_REQUEST['typeBanner'];
    $category = $_REQUEST['category'];
    $editor = $_REQUEST['editor'];
    if (isset($_REQUEST['datepicker'])) {
        $datepicker = $_REQUEST['datepicker'];
    } else {
        $datepicker = '';
    }
    //$datepicker=date("Y-m-d", strtotime($datepicker));
    $image = $_REQUEST['og_img'];
    if (isset($_REQUEST['highlight'])) {
        $highlight = $_REQUEST['highlight'];
    } else {
        $highlight = '';
    }
    $idNews = $_REQUEST['idNews'];

    $codeRef = $_REQUEST['codOper'];
    funUpdateRefOperation($codeRef, '-1', '', $connection);

    $sqlCmdUpdNews = "UPDATE tb_news SET dateO=$viDateC, userO=$usr_id, highlight='$highlight', publishDate = '$datepicker', type = '$type', category = '$category', editor='$editor', idTbGallery='$image', idTbCountry = $idCountry WHERE id=$idNews";
    //echo "update news<br>".$sqlCmdUpdNews;
    if ($result = $connection->query($sqlCmdUpdNews)) {
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
               tb_country.id='.$idCountry;

        if ($result = $connection->query($sqlCmd)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idLang = $row['id'];
                $title = $_REQUEST['title_'.$row['abbCountry'].'_'.$row['langMin']];
                $subTitle = $_REQUEST['subTitle_'.$row['abbCountry'].'_'.$row['langMin']];
                $keywords = $_REQUEST['keywords_'.$row['abbCountry'].'_'.$row['langMin']];
                $desc = $_REQUEST['desc_'.$row['abbCountry'].'_'.$row['langMin']];
                $idTrans = $_REQUEST['idTrans_'.$row['abbCountry'].'_'.$row['langMin']];
                if ($idTrans) {
                    $sqlUpdNewsTrans = "UPDATE tb_news_translation SET dateO = $viDateC, userO = $usr_id, title = '$title', subTitle = '$subTitle', ";
                    $sqlUpdNewsTrans .= "tb_news_translation.details = '$desc', tb_news_translation.keywords = '$keywords' WHERE id = $idTrans";
                //echo $sqlUpdNewsTrans;
                } else {
                    $sqlUpdNewsTrans = 'INSERT INTO tb_news_translation (dateO, userO, title, subTitle, details, idTbLanguage, idTbNews, keywords)';
                    $sqlUpdNewsTrans .= " VALUES ($viDateC, $usr_id, '$title', '$subTitle', '$desc', $idLang, $idNews, $keywords)";
                    //echo $sqlUpdNewsTrans;
                }
                $result1 = $connection->query($sqlUpdNewsTrans);
                if (!$result1) {
                    $inserted = false;
                    $action = '[UPD MEDIA] - Failed add  PARTNER TRANSLATIONS';
                    $msg = 'Failed add new translation';
                    funUpdateRefOperation($codeRef, '0', $msg, $connection);
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    funCloseTab();
                    die('false||Ocorreu um problema ao actualizar News #0002');
                } else {
                    $inserted = true;
                }
            }
            if ($inserted) {
                //var_dump('OK');
                //die('FOOBAR');
                echo 'true||Operação realizada com sucesso.';
                funUpdateRefOperation($codeRef, '1', 'Operação realizada com sucesso!', $connection);
                $action = '[UPD NEWS] - Success adding partner';
                funCreateLog($action, $connection);
                $db->commitAndClose();
                funCloseTab();
                exit;
            }
        }
    } else {
        $action = '[UPD NEWS] - Failed adding News';
        funUpdateRefOperation($codeRef, '0', 'Failed adding News', $connection);
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        funCloseTab();
        exit;
        die('false||Ocorreu um erro ao actualizar o news.');
    }
}

function funCloseTab()
{
    echo '<script>window.close();</script>';
}
