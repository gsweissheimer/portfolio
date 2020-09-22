<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'addImagesTag':
    if ($_REQUEST['bot'] == '') {
        funAddImagesTag();
    } else {
        die();
    }
    break;

  case 'getCountryLang':
    funGetCountryLang();
    break;

  case 'addImage':
    if ($_REQUEST['bot'] == '') {
        funAddImage();
    } else {
        die();
    }
    break;

  case 'getImages':
    funGetImages();
    break;

  case 'deleteImage':
    funDeleteImages();
    break;

  case 'getImageEdit':
    funGetImageEdit();
    break;

  case 'editImage':
    if ($_REQUEST['bot'] == '') {
        funEditImage();
    } else {
        die();
    }
    break;

  /*
  case 'getAdvancedBannerNew':
    funGetAdvancedBannerNew();
    break;
  case 'getBannerNew':
    funGetBannerNew();
    break;
  case 'addBannerTag':
    if($_REQUEST['bot'] == ""){funAddBannerTag();}else{die();}
    break;
  case 'addBanner':
    if($_REQUEST['bot'] == ""){funAddBanner();}else{die();}
    break;
  case 'getBanners':
    funGetBanners();
    break;
  case 'deleteBanner':
    funDeleteBanner();
    break;
  case 'getBanner':
    funGetBanner();
    break;
  case 'editBanner':
    if($_REQUEST['bot'] == ""){ funEditBanner();}else{ die();}
    break;
  case 'getBannerEdit':
    funGetBannerEdit();
    break;
  */
  default:
    // code...
    break;
}

function funEditImage()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $inserted = false;

    $idBanner = $_REQUEST['idBanner'];
    $idBannerTag = $_REQUEST['bannerTag'];
    $idCountry = $_REQUEST['idCountry'];
    $position = $_REQUEST['position'];

    $sqlUpdBanner = "UPDATE tb_images SET dateO=$viDateC, userO=$usr_id, position='$position'";
    $sqlUpdBanner .= ", idTbImagesTag = '$idBannerTag' WHERE id=$idBanner";
    if ($result = $connection->query($sqlUpdBanner)) {
        $sqlGetLang = 'SELECT
                       tb_language.id,
                       tb_language.lang,
                       tb_language.langMin,
                       tb_country.abbCountry
                   FROM tb_country_language
                   JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                   JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                   WHERE tb_country_language.status = 1
                   AND
                       tb_country.id='.$idCountry;
        if ($resultLang = $connection->query($sqlGetLang)) {
            while ($rowLang = mysqli_fetch_assoc($resultLang)) {
                $idLanguage = $rowLang['id'];
                $idGallery = $_REQUEST['og_image_'.$rowLang['langMin']];
                $idTrans = $_REQUEST['idTrans_'.$rowLang['lang'].'_'.$rowLang['langMin']];

                if ($idTrans) {
                    $sqlUpdBannerTrans = "UPDATE tb_images_translation SET dateC= $viDateC";
                    $sqlUpdBannerTrans .= ", idTbGallery=$idGallery ";
                    $sqlUpdBannerTrans .= "WHERE id= $idTrans";
                } else {
                    $sqlUpdBannerTrans = 'INSERT INTO tb_images_translation (dateC, status, idTbGallery, idTbLanguage, idTbImages, idTbCountry)';
                    $sqlUpdBannerTrans .= " VALUES ($viDateC, 1, $idGallery, $idLanguage, $idBanner, $idCountry)";
                }

                $result2 = $connection->query($sqlUpdBannerTrans);

                if (!$result2) {
                    $action = '[UPD ADVANCED BANNER TRANS] - sql failed';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Oppsss... ocorreu um erro ao actualizar o banner.');
                } else {
                    $inserted = true;
                }
            }
            if ($inserted) {
                $action = '[UPD ADVANCED BANNER TRANS] - Sucess added';
                funCreateLog($action, $connection);
                $db->commitAndClose();
                echo 'true||Operação realizada com sucesso.';
            }
        }
    } else {
        $action = '[UPD ADVANCED BANNER] - sql failed';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Ocorreu um problema actualizar o banner 1.');
    }
}

function funGetCountry($vfIdCountry = '', $isToReturn = false)
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmdCountry = 'SELECT id, country, abbCountry FROM tb_country WHERE status = 1';
    $optionCountry = "<option value=''>Select an option</option>";
    if ($result = $connection->query($sqlCmdCountry)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $idCountry = $row['id'];
            $country = $row['country'];
            if ($vfIdCountry == $idCountry) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $optionCountry .= "<option value='$idCountry' $select>$country</option>";
        }
    }
    if ($isToReturn) {
        return $optionCountry;
    } else {
        echo 'true||'.$optionCountry;
    }
}

function funGetImagesTag($vfTagId = '')
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = 'SELECT
              id, tag
              FROM
              tb_images_tag
              WHERE status=1
              GROUP BY
              tb_images_tag.id';
    $values = '';
    $option = "<option value=''>Select an option</option>";
    if ($result = $connection->query($sqlCmd)) {
        while ($rsData = mysqli_fetch_assoc($result)) {
            $idTag = $rsData['id'];
            if ($vfTagId == $idTag) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $option .= '<option value="'.$idTag.'" '.$select.'>'.$rsData['tag'].'</option>';
        }
    }

    return $option;
}

function funGetImageEdit()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $idCountry = $_REQUEST['idC'];
    $idBanner = $_REQUEST['id'];
    $countryOptions = funGetCountry($idCountry, true);
    $listFormBar = '';
    $navBar = '';
    $idGallery = null;
    $idBannerTag = null;
    $position = null;
    $flagCta = null;
    $duration = null;
    $sqlCmdCountryLang = "SELECT
                             tb_language.id,
                             tb_language.langMin,
                             tb_language.lang
                      FROM tb_country_language
                      JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                      JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                      WHERE tb_country_language.status =1
                      AND
                       tb_country.id=$idCountry
                      ORDER BY tb_country_language.defaultLang DESC";
    if ($result1 = $connection->query($sqlCmdCountryLang)) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            if ($navBar == '') {
                $navBar .= '<li role="presentation" class="nabTab active"><a href="#'.$row1['langMin'].'" aria-controls="1" role="tab" data-toggle="tab">'.$row1['langMin'].'</a></li>';
            } else {
                $navBar .= '<li role="presentation" class="nabTab"><a href="#'.$row1['langMin'].'" aria-controls="1" role="tab" data-toggle="tab">'.$row1['langMin'].'</a></li>';
            }
            $sqlGetBannerTrans = "SELECT
                                  tb_images_translation.id,
                                  tb_images_translation.idTbGallery,
                                  tb_gallery.path,
                                  tb_images.position,
                                  tb_images.idTbImagesTag
                            FROM
                              tb_images_translation
                            JOIN tb_images ON tb_images.id = tb_images_translation.idTbImages
                            JOIN tb_gallery ON tb_gallery.id = tb_images_translation.idTbGallery
                            WHERE tb_images_translation.idTbImages=$idBanner
                            AND tb_images_translation.idTbLanguage=".$row1['id'];
            //echo $sqlGetBannerTrans;

            if ($result3 = $connection->query($sqlGetBannerTrans)) {
                $numRow = mysqli_num_rows($result3);
                if ($numRow > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        if ($listFormBar != '') {
                            $flag = false;
                        } else {
                            $idGallery = $row3['idTbGallery'];
                            $idBannerTag = $row3['idTbImagesTag'];
                            $position = $row3['position'];
                            $flag = true;
                        }

                        $viArrayValues['country'] = $row1['lang'];
                        $viArrayValues['lang'] = $row1['lang'];
                        $viArrayValues['langMin'] = $row1['langMin'];

                        $viArrayValues['idTbGallery'] = $idGallery;
                        $viArrayValues['path'] = $row3['path'];

                        $viArrayValues['idTrans'] = $row3['id'];
                        $viArrayValues['flag'] = $flag;
                        $listFormBar .= funCreateImageNew($viArrayValues);
                    }
                } else {
                    $viArrayValues['country'] = $row1['lang'];
                    $viArrayValues['lang'] = $row1['lang'];
                    $viArrayValues['langMin'] = $row1['langMin'];

                    $viArrayValues['idTbGallery'] = '';
                    $viArrayValues['path'] = '';
                    $viArrayValues['idTrans'] = '';

                    $viArrayValues['flag'] = $flag;
                    $listFormBar .= funCreateImageNew($viArrayValues);
                }
            }
        }
    }
    $optionBannerTag = funGetImagesTag($idBannerTag);
    echo "true|#|$countryOptions|#|$navBar|#|$listFormBar|#|$optionBannerTag|#|$position";
}

function funCreateImageNew($vfArrayValues)
{
    if ($vfArrayValues['flag'] == 'true') {
        $active = 'active';
    } else {
        $active = '';
    }

    $vfLang = $vfArrayValues['lang'];
    $vfLangMin = $vfArrayValues['langMin'];
    $vfCountry = $vfArrayValues['country'];
    $shareImgId = $vfArrayValues['idTbGallery'];
    $shareImgPath = $vfArrayValues['path'];

    $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
    $value .= '	  <div class="form-group">';
    $value .= '		  <label>Imagem</label>';
    $value .= '     <div class="col-sm-12">';
    $value .= '       <div class="col-sm-6">';
    $value .= '         <span onclick="funOpenGallery(false,og_img_'.$vfLangMin.','.GALLERY_IMAGE.')" class="btn btn-success">Choose Image</span>';
    $value .= '		      <input type="hidden" id="og_img_'.$vfLangMin.'" name="og_image_'.$vfLangMin.'" class="form-control"  value="'.$shareImgId.'">';
    $value .= '       </div>';
    $value .= '       <div class="col-sm-6">';
    $value .= '		      <img id="bg_og_img_'.$vfLangMin.'" src="../'.$shareImgPath.'"  class="img-responsive">';
    $value .= '       </div>';
    $value .= '	    </div>';
    $value .= '	  </div>';
    $value .= '   <input  type="hidden" id="idTrans" name="idTrans_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
    $value .= '</div>';

    return $value;
}

function funDeleteImages()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $bannerId = $_REQUEST['id'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdDeleteImage = "UPDATE tb_images SET dateO= $viDateC, userO = $usr_id, status = 0 WHERE id='$bannerId'";
    $result = $connection->query($sqlCmdDeleteImage);
    if ($result) {
        $action = '[DELETE ADVANCED BANNER] - Sucess deleting #'.$bannerId;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||Operação realizada com sucesso.';
    } else {
        $action = '[DELETE ADVANCED BANNER] - Error deleting #'.$bannerId;
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        echo 'false||Operação Falhou.';
    }
}

function funGetImages()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = 'SELECT
                  tb_images_tag.tag,
                  tb_images.id,
                  tb_images.position,
                  tb_country.country,
                  tb_country.id as countryID
             FROM
                  tb_images_tag
             JOIN tb_images ON tb_images_tag.id = tb_images.idTbImagesTag
             JOIN tb_images_translation ON tb_images.id = tb_images_translation.idTbImages
             JOIN tb_country ON tb_images_translation.idTbCountry = tb_country.id
             WHERE tb_images.status = 1
             GROUP BY tb_images.id';

    $values = '';
    $arrayMain = [];
    //var_dump($sqlCmd);
    if ($result = $connection->query($sqlCmd)) {
        while ($rsData = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='images-editar.php?id=".$rsData['id'].'&idC='.$rsData['countryID']."'";
            $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            array_push($arrayMain, [$rsData['id'], $rsData['tag'], $rsData['position'], $rsData['country'], $values]);
        }
    }
    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funAddImagesTag()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $tag = $_REQUEST['tag'];

    $sqlCmd = "INSERT INTO tb_images_tag (dateO, userO, tag) VALUES ($viDateC, $usr_id, '$tag')";

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
            $viArrayValues['lang'] = $row['lang'];
            $viArrayValues['langMin'] = $row['langMin'];
            $viArrayValues['idTbGallery'] = '';
            $viArrayValues['path'] = '';
            $viArrayValues['idTrans'] = '';
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateImageNew($viArrayValues);
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

function funAddImage()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $inserted = false;
    $idBannerTag = $_REQUEST['bannerTag'];
    $idCountry = $_REQUEST['countryBanner'];
    $position = $_REQUEST['position'];

    $sqlInsertBanner = 'INSERT INTO tb_images (dateO, userO, position, status, idTbImagesTag)';
    $sqlInsertBanner .= " VALUES ($viDateC, $usr_id, $position, 1, $idBannerTag)";
    if ($result = $connection->query($sqlInsertBanner)) {
        $idBanner = $connection->insert_id;

        $sqlGetCountryLang = 'SELECT
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

        if ($result1 = $connection->query($sqlGetCountryLang)) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $idLanguage = $row['id'];

                $idGallery = $_REQUEST['og_image_'.$row['langMin']];

                $sqlInsBannerTrans = 'INSERT INTO tb_images_translation (dateC, status, idTbGallery, idTbLanguage, idTbImages, idTbCountry)';
                $sqlInsBannerTrans .= " VALUES ($viDateC,  1, ";
                $sqlInsBannerTrans .= " $idGallery, $idLanguage, $idBanner, $idCountry)";

                $result2 = $connection->query($sqlInsBannerTrans);

                if (!$result2) {
                    $action = '[ADD BANNER TRANS] - sql failed';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Oppsss... ocorreu um erro ao inserir o banner.');
                } else {
                    $inserted = true;
                }
            }
            if ($inserted) {
                $action = '[ADD BANNER TRANS] - Sucess added';
                funCreateLog($action, $connection);
                $db->commitAndClose();
                echo 'true||Operação realizada com sucesso.';
            }
        }
    } else {
        $action = '[ADD BANNER] - Failed inserting banner';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Ocorreu um erro ao inserir o banner');
    }
}
