<?php

include_once '../../includes/globalVars.php';
include_once 'utils.php';
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getSEONew':
    funCreateSEONew();
    break;
  case 'addSEO':
    if ($_REQUEST['bot'] == '') {
        funAddSEO();
    } else {
        die();
    }
    break;
  case 'getSEO':
    funGetSEO();
    break;
  case 'getSEOEdit':
    funCreateSEOEdit();
    break;
  case 'deleteSEO':
            funDeleteSEO();
            break;
  case 'editSEO':
        if ($_REQUEST['bot'] == '') {
            funEditSEOs();
        } else {
            die();
        }
        break;
  default:
    // code...
    break;
}

function funCreateSEOItems($vfLang, $vfIdLang, $vfTitle, $vfDescription, $vfKeywords, $vfOGTitle, $vfOGDesc, $vfOGLocale, $vfOGType, $vfOGUrl, $vfOGSiteName, $vfTwCard, $flag, $vfIdTrans, $shareImgPath, $shareImgId, $shareSite, $shareCreator)
{
    if ($flag) {
        $active = 'active';
    } else {
        $active = '';
    }
    $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'">    <br>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Título Página</label>';
    $value .= '		<input id="title_'.$vfLang.'" name="title_'.$vfLang.'" class="form-control"  value="'.$vfTitle.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Keywords</label>';
    $value .= '		<input id="key_'.$vfLang.'" name="key_'.$vfLang.'" class="form-control"  value="'.$vfKeywords.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Descrição</label>';
    $value .= '		<textarea id="desc_'.$vfLang.'" name="desc_'.$vfLang.'" class="form-control" value="" required>'.$vfDescription.' </textarea>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>OG: Title</label>';
    $value .= '		<input id="og_title_'.$vfLang.'" name="og_title_'.$vfLang.'" class="form-control"  value="'.$vfOGTitle.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>OG: Description</label>';
    $value .= '		<textarea id="og_description_'.$vfLang.'" name="og_description_'.$vfLang.'" class="form-control" value="" required>'.$vfOGDesc.' </textarea>';
    $value .= '	</div>';
    $value .= '	<div class="col-md-6 form-group" style="padding-left:0">';
    $value .= '		<label>OG: Locale</label>';
    $value .= '		<input id="og_locale_'.$vfLang.'" name="og_locale_'.$vfLang.'" class="form-control"  value="'.$vfOGLocale.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="col-md-6 form-group" style="padding-right:0">';
    $value .= '		<label>OG: Type</label>';
    $value .= '		<input id="og_type_'.$vfLang.'" name="og_type_'.$vfLang.'" class="form-control"  value="'.$vfOGType.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="col-md-6 form-group" style="padding-left:0">';
    $value .= '		<label>OG: URL</label>';
    $value .= '		<input id="og_url_'.$vfLang.'" name="og_url_'.$vfLang.'" class="form-control"  value="'.$vfOGUrl.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="col-md-6 form-group" style="padding-right:0">';
    $value .= '		<label>OG: Site Name</label>';
    $value .= '		<input id="og_siteName_'.$vfLang.'" name="og_siteName_'.$vfLang.'" class="form-control"  value="'.$vfOGSiteName.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>OG: IMAGE</label>';
    $value .= '   <div class="col-sm-12">';
    $value .= '     <div class="col-sm-6">';
    $value .= '       <span onclick="funOpenGallery(false,og_img_'.$vfLang.','.GALLERY_IMAGE.')" class="btn btn-success">Choose Image</span>';
    $value .= '		    <input type="hidden" id="og_img_'.$vfLang.'" name="og_image_'.$vfLang.'" class="form-control"  value="'.$shareImgId.'">';
    $value .= '     </div>';
    $value .= '     <div class="col-sm-6">';
    $value .= '		   <img id="bg_og_img_'.$vfLang.'" name="bg_og_image_'.$vfLang.'" src="../'.$shareImgPath.'"  class="img-responsive">';
    $value .= '     </div>';
    $value .= '	  </div>';
    $value .= '	  <input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
    $value .= '	  <input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Twitter Card</label>';
    $value .= '		<input id="tw_card_'.$vfLang.'" name="tw_card_'.$vfLang.'" class="form-control"  value="'.$vfTwCard.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Twitter Site</label>';
    $value .= '		<input id="tw_card_'.$vfLang.'" name="tw_site_'.$vfLang.'" class="form-control"  value="'.$shareSite.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Twitter Creator</label>';
    $value .= '		<input id="tw_card_'.$vfLang.'" name="tw_creator_'.$vfLang.'" class="form-control"  value="'.$shareCreator.'" required>';
    $value .= '	</div>';
    $value .= '</div>';

    return $value;
}

function funCreateSEONew()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listNavBar = '';
    $listFormBar = '';
    $id = '';
    $valueLine = '';

    $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($listNavBar == '') {
                $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
            } else {
                $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
            }
            if ($listFormBar != '') {
                $flag = false;
            } else {
                $flag = true;
            }
            $listFormBar .= funCreateSEOItems($row['langMin'], $row['id'], '', '', '', '', '', '', '', '', '', '', $flag, $id, '', '', '', '');
        }
        echo 'true||'.$listNavBar.'||'.$listFormBar;
    }
}

function funAddSEO()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";

    $idSeoCode = $_REQUEST['seoCode'];

    $sqlCmd = 'SELECT id, langMin FROM tb_language WHERE deleted = 0';
    $inserted = true;
    $sql = "UPDATE tb_seo_translations SET status = 0 WHERE idTbSeo=$idSeoCode";
    if (!$result2 = $connection->query($sql)) {
        $inserted = false;
        $connection->rollback();
        $action = '[ADD_SEO] - Failed add  [SQL] - '.$sql;
        funCreateLog($action, $connection);
        die('false|| Ocorreu um erro ao editar o SEO.');
    }
    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $langMin = $row['langMin'];
            $idLang = $row['id'];
            if ($_REQUEST['key_'.$langMin]) {
                $viKeyword = $_REQUEST['key_'.$langMin];
            } else {
                $viKeyword = '';
            }
            if ($_REQUEST['desc_'.$langMin]) {
                $viDesc = $_REQUEST['desc_'.$langMin];
            } else {
                $viDesc = '';
            }
            if ($_REQUEST['title_'.$langMin]) {
                $viTitle = $_REQUEST['title_'.$langMin];
            } else {
                $viTitle = '';
            }
            if ($_REQUEST['og_title_'.$langMin]) {
                $viOGTitle = $_REQUEST['og_title_'.$langMin];
            } else {
                $viOGTitle = '';
            }
            if ($_REQUEST['og_description_'.$langMin]) {
                $viOGDesc = $_REQUEST['og_description_'.$langMin];
            } else {
                $viOGDesc = '';
            }
            if ($_REQUEST['og_locale_'.$langMin]) {
                $viOGLocale = $_REQUEST['og_locale_'.$langMin];
            } else {
                $viOGLocale = '';
            }
            if ($_REQUEST['og_type_'.$langMin]) {
                $viOGType = $_REQUEST['og_type_'.$langMin];
            } else {
                $viOGType = '';
            }
            if ($_REQUEST['og_url_'.$langMin]) {
                $viOGUrl = $_REQUEST['og_url_'.$langMin];
            } else {
                $viOGUrl = '';
            }
            if ($_REQUEST['og_siteName_'.$langMin]) {
                $viOGSiteName = $_REQUEST['og_siteName_'.$langMin];
            } else {
                $viOGSiteName = '';
            }
            if ($_REQUEST['tw_card_'.$langMin]) {
                $viTwCard = $_REQUEST['tw_card_'.$langMin];
            } else {
                $viTwCard = '';
            }
            if ($_REQUEST['og_image_'.$langMin]) {
                $viOgImg = $_REQUEST['og_image_'.$langMin];
            } else {
                $viOgImg = '';
            }
            if ($_REQUEST['tw_creator_'.$langMin]) {
                $viTwCreator = $_REQUEST['tw_creator_'.$langMin];
            } else {
                $viTwCreator = '';
            }
            if ($_REQUEST['tw_site_'.$langMin]) {
                $viTwSite = $_REQUEST['tw_site_'.$langMin];
            } else {
                $viTwSite = '';
            }

            $sqlCmdAddSEO = 'INSERT INTO tb_seo_translations (dateC, title, description, keywords, shareTitle, shareDesc, shareLocale,';
            $sqlCmdAddSEO .= " shareType, shareUrl, shareSitename, shareImage, shareCard, shareSite, shareCreator, idTbSeo, idTbLanguage) VALUES ($viDateC, '$viTitle', '$viKeyword', '$viDesc',";
            $sqlCmdAddSEO .= " '$viOGTitle', '$viOGDesc', '$viOGLocale', '$viOGType', '$viOGUrl', '$viOGSiteName','$viOgImg', '$viTwCard', '$viTwSite', '$viTwCreator', $idSeoCode, $idLang)";

            if (!$connection->query($sqlCmdAddSEO)) {
                $inserted = false;
                $connection->rollback();
                $action = '[ADD_SEO] - Failed add  [SQL] - '.$sqlCmdAddSEO;
                funCreateLog($action, $connection);
                die('false|| Ocorreu um erro ao inserir o SEO.');
            }
        }
        if ($inserted) {
            echo 'true||Operação realizada com sucesso.';
            $action = '[ADD SEO] - Success SEO';
            funCreateLog($action, $connection);
            $db->commitAndClose();
        } else {
            $action = '[ADD SEO] - Failed to add SEO';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||Ocorreu um erro ao tentar adicionar SEO.');
        }
    } else {
        die('false||Ocorreu um erro a gravar o SEO.');
    }
}

function funGetSEO()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmdGetSEO = 'SELECT
									tb_seo.id,
                  tb_seo.code
									FROM
									tb_seo
                  JOIN tb_seo_translations ON tb_seo.id = tb_seo_translations.idTbSeo
                  WHERE tb_seo_translations.status = 1
                  GROUP BY tb_seo.id';

    $values = '';
    if ($result = $connection->query($sqlCmdGetSEO)) {
        $arrayMain = [];
        while ($rsData = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='seo-editar.php?id=".$rsData['id']."'";
            $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
            // $urlToSeeMore = "location.href='seo-mais.php?id=".$rsData['id']."'";
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            // $values .=	'<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
            array_push($arrayMain, [$rsData['id'], $rsData['code'], $values]);
        }
    }

    echo json_encode($arrayMain);
    $db->closeConnection();
}

  function funCreateSEOEdit()
  {
      include_once PATH_DATABASE_INC;
      $db = Database::getInstance();
      $connection = $db->getConnection();
      $listNavBar = '';
      $listFormBar = '';
      $valuePage = '';
      $id = $_REQUEST['id'];

      $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
      if ($result = $connection->query($sqlCmd)) {
          while ($row = mysqli_fetch_assoc($result)) {
              if ($listNavBar == '') {
                  $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
              } else {
                  $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
              }
              $sqlCmd2 = 'SELECT
                        tb_seo_translations.title,
                        tb_seo_translations.description,
                        tb_seo_translations.keywords,
                        tb_seo_translations.shareTitle,
                        tb_seo_translations.shareDesc,
                        tb_seo_translations.shareLocale,
                        tb_seo_translations.shareType,
                        tb_seo_translations.shareUrl,
                        tb_seo_translations.shareSitename,
                        tb_seo_translations.shareImage,
                        tb_seo_translations.shareCard,
                        tb_seo_translations.shareSite,
                        tb_seo_translations.shareCreator,
                        tb_seo_translations.id,
                        tb_seo_translations.idTbSeo,
                        tb_gallery.path
                    FROM
                        tb_seo
                    JOIN tb_seo_translations ON tb_seo.id = tb_seo_translations.idTbSeo
                    JOIN tb_language ON tb_seo_translations.idTbLanguage = tb_language.id
                    JOIN tb_gallery ON tb_gallery.id = tb_seo_translations.shareImage
      							WHERE
    										tb_seo.status = 1
                    AND
                      tb_seo_translations.status = 1
      							AND
    										tb_seo.id = '.$id.'
      							AND
    										tb_seo_translations.idTbLanguage = '.$row['id'];
              if ($result2 = $connection->query($sqlCmd2)) {
                  $numRows = mysqli_num_rows($result2);
                  if ($numRows >= 1) {
                      while ($row1 = mysqli_fetch_assoc($result2)) {
                          if ($valuePage == '') {
                              $valuePage = $row1['idTbSeo'];
                          }
                          if ($listFormBar != '') {
                              $flag = false;
                          } else {
                              $flag = true;
                          }
                          $listFormBar .= funCreateSEOItems($row['langMin'], $row['id'], $row1['title'], $row1['description'], $row1['keywords'], $row1['shareTitle'], $row1['shareDesc'], $row1['shareLocale'], $row1['shareType'], $row1['shareUrl'], $row1['shareSitename'], $row1['shareCard'], $flag, $row1['id'], $row1['path'], $row1['shareImage'], $row1['shareSite'], $row1['shareCreator']);
                      }
                  } else {
                      if ($listFormBar != '') {
                          $flag = false;
                      } else {
                          $flag = true;
                      }
                      $listFormBar .= funCreateSEOItems($row['langMin'], $row['id'], '', '', '', '', '', '', '', '', '', '', $flag, '', '', '', '', '');
                  }
              } else {
                  echo 'false||error1';
              }
          }
          echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$id;
      }
  }

  function funDeleteSEO()
  {
      include_once 'session.php';
      include_once 'utils.php';
      include_once PATH_DATABASE_INC;
      $db = Database::getInstance();
      $connection = $db->getConnection();
      $id = $_REQUEST['id'];

      $sqlCmd = "UPDATE tb_seo_translations SET status = 0 WHERE idTbSeo='$id'";
      $result = $connection->query($sqlCmd);
      if ($result) {
          $action = '[DELETE SEO] - Sucess deleting #'.$id;
          funCreateLog($action, $connection);
          $db->commitAndClose();
          echo 'true||Operação realizada com sucesso.';
      } else {
          $action = '[DELETE SEO] - Error deleting #'.$id;
          funCreateLog($action, $connection);
          $db->rollbackAndClose();
          echo 'false||Oopss... Aconteceu um erro ao tentar eliminar.';
      }
  }

  function funEditSEOs()
  {
      include_once 'session.php';
      include_once 'utils.php';
      include_once PATH_DATABASE_INC;
      $db = Database::getInstance();
      $connection = $db->getConnection();
      $viDateC = "'".date('Y-m-d H:i:s')."'";

      $idSEO = $_REQUEST['idSeo'];
      $inserted = true;

      $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
      if ($result = $connection->query($sqlCmd)) {
          while ($row = mysqli_fetch_assoc($result)) {
              $langMin = $row['langMin'];
              $idLang = $row['id'];
              if ($_REQUEST['key_'.$langMin]) {
                  $viKeyword = $_REQUEST['key_'.$langMin];
              } else {
                  $viKeyword = '';
              }
              if ($_REQUEST['desc_'.$langMin]) {
                  $viDesc = $_REQUEST['desc_'.$langMin];
              } else {
                  $viDesc = '';
              }
              if ($_REQUEST['title_'.$langMin]) {
                  $viTitle = $_REQUEST['title_'.$langMin];
              } else {
                  $viTitle = '';
              }
              if ($_REQUEST['og_title_'.$langMin]) {
                  $viOGTitle = $_REQUEST['og_title_'.$langMin];
              } else {
                  $viOGTitle = '';
              }
              if ($_REQUEST['og_description_'.$langMin]) {
                  $viOGDesc = $_REQUEST['og_description_'.$langMin];
              } else {
                  $viOGDesc = '';
              }
              if ($_REQUEST['og_locale_'.$langMin]) {
                  $viOGLocale = $_REQUEST['og_locale_'.$langMin];
              } else {
                  $viOGLocale = '';
              }
              if ($_REQUEST['og_type_'.$langMin]) {
                  $viOGType = $_REQUEST['og_type_'.$langMin];
              } else {
                  $viOGType = '';
              }
              if ($_REQUEST['og_url_'.$langMin]) {
                  $viOGUrl = $_REQUEST['og_url_'.$langMin];
              } else {
                  $viOGUrl = '';
              }
              if ($_REQUEST['og_siteName_'.$langMin]) {
                  $viOGSiteName = $_REQUEST['og_siteName_'.$langMin];
              } else {
                  $viOGSiteName = '';
              }
              if ($_REQUEST['tw_card_'.$langMin]) {
                  $viTwCard = $_REQUEST['tw_card_'.$langMin];
              } else {
                  $viTwCard = '';
              }
              if ($_REQUEST['og_image_'.$langMin]) {
                  $viOgImg = $_REQUEST['og_image_'.$langMin];
              } else {
                  $viOgImg = '';
              }
              if ($_REQUEST['idTrans_'.$langMin]) {
                  $idTrans = $_REQUEST['idTrans_'.$langMin];
              } else {
                  $idTrans = '';
              }
              if ($_REQUEST['tw_creator_'.$langMin]) {
                  $viTwCreator = $_REQUEST['tw_creator_'.$langMin];
              } else {
                  $viTwCreator = '';
              }
              if ($_REQUEST['tw_site_'.$langMin]) {
                  $viTwSite = $_REQUEST['tw_site_'.$langMin];
              } else {
                  $viTwSite = '';
              }

              if ($idTrans != '') {
                  $sqlCmdUpdSEO = "UPDATE tb_seo_translations SET title='$viTitle', description='$viDesc', keywords='$viKeyword',";
                  $sqlCmdUpdSEO .= " shareTitle='$viOGTitle', shareDesc='$viOGDesc', shareLocale='$viOGLocale', shareType='$viOGType',";
                  $sqlCmdUpdSEO .= " shareUrl='$viOGUrl', shareSitename='$viOGSiteName', shareImage='$viOgImg', shareCard='$viTwCard',";
                  $sqlCmdUpdSEO .= " shareSite='$viTwSite', shareCreator='$viTwCreator' WHERE id=$idTrans";
              } else {
                  $sqlCmdUpdSEO = 'INSERT INTO tb_seo_translations (dateC, title, description, keywords, shareTitle, shareDesc, shareLocale,';
                  $sqlCmdUpdSEO .= " shareType, shareUrl, shareSitename, shareImage, shareCard,shareSite,shareCreator, idTbSeo, idTbLanguage) VALUES ($viDateC, '$viTitle', '$viKeyword', '$viDesc',";
                  $sqlCmdUpdSEO .= " '$viOGTitle', '$viOGDesc', '$viOGLocale', '$viOGType', '$viOGUrl', '$viOGSiteName','$viOgImg', '$viTwCard','$viTwSite','$viTwCreator', $idSEO, $idLang)";
              }

              if (!$connection->query($sqlCmdUpdSEO)) {
                  $inserted = false;
                  $connection->rollback();
                  $action = '[ADD_SEO] - Failed add  [SQL] - '.$sqlCmdUpdSEO;
                  funCreateLog($action, $connection);
                  die('false|| Ocorreu um erro ao actualizar o SEO. '.$sqlCmdUpdSEO);
              }
          }
          if ($inserted) {
              echo 'true||Operação realizada com sucesso.';
              $action = '[UPD SEO] - Success SEO';
              funCreateLog($action, $connection);
              $db->commitAndClose();
          } else {
              $action = '[UPD SEO] - Failed to update SEO';
              funCreateLog($action, $connection);
              $db->rollbackAndClose();
              die('false||Ocorreu um erro ao tentar actualizar SEO.');
          }
      }
  }
