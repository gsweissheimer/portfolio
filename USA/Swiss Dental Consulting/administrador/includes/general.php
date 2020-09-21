<?php
include_once('../../includes/globalVars.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'addGeneralInfo':
      if($_REQUEST['bot'] == ""){funAddGeneralInfo();}else{die();}
      break;
  default:
    # code...
    break;
}


function funAddGeneralInfo(){
  include_once('utils.php');

  // FAVICON
  if(isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] != UPLOAD_ERR_NO_FILE){

    $favIconName = "favicon.ico";
    $tmp_name = $_FILES['fileToUpload']['tmp_name'];
    $fileTypeOriginal = $_FILES['fileToUpload']['type'];
    $viTargetFolder = "../../".PATH_FAVICON."/".$favIconName;
    $saveFavicon = funSaveImages($fileTypeOriginal, $tmp_name, $viTargetFolder, "", "");

    if(!$saveFavicon){
        die("false|| Ocorreu um problema ao carregar o Favicon");
      }
    }

    // ROBOTS
    if(isset($_FILES['robots']) && !empty($_FILES['robots']['name']) && $_FILES['robots']['error'] != UPLOAD_ERR_NO_FILE){

      $robotsName = $_FILES['robots']['name'];
      $tmp_name = $_FILES['robots']['tmp_name'];
      $fileTypeOriginal = $_FILES['robots']['type'];
      $viTargetFolder = "../../".$robotsName;
      $saveFavicon = funMoveFiles($tmp_name, $viTargetFolder);

      if(!$saveRobots){
          die("false|| Ocorreu um problema ao carregar o Robots");
        }
    }

    // SITEMAP
    if(isset($_FILES['sitemap']) && !empty($_FILES['sitemap']['name']) && $_FILES['sitemap']['error'] != UPLOAD_ERR_NO_FILE){

      $sitemapName = $_FILES['sitemap']['name'];
      $tmp_name = $_FILES['sitemap']['tmp_name'];
      $fileTypeOriginal = $_FILES['sitemap']['type'];
      $viTargetFolder = "../../".$robotsName;
      $saveSitemap = funMoveFiles($tmp_name, $sitemapName);

      if(!$saveSitemap){
          die("false|| Ocorreu um problema ao carregar o Robots");
        }
    }


    if($saveFavicon || $saveRobots || $saveSitemap){
      die("true|| OS ficheiros foram actualizados com sucesso.");
    }
}
?>
