<?php
include_once('../../includes/globalVars.php');
$cmdEval=$_REQUEST["cmdEval"];
  switch ($cmdEval) {
    case 'addFile':
      funAddFile();
      break;
    case 'getInfoGallery':
      funGetInfoGallery();
      break;
    case 'deleteImage':
      funDeleteImageGallery();
      break;
    case 'updateImage':
      funUpdateImage();
      break;
    default:
      # code...
      break;
  }

  function funAddFile(){
    include_once('session.php');
    include_once('utils.php');
    include_once(PATH_DATABASE_INC);
		$db = Database::getInstance();
		$connection = $db->getConnection();
		$viDateC = "'" . date("Y-m-d H:i:s") . "'";
    $isFromYou = false;
    $image_width = "0000";
    $image_height = "0000";
    if(isset($_FILES['uploadFile']) && file_exists($_FILES['uploadFile']['tmp_name']) && is_uploaded_file($_FILES['uploadFile']['tmp_name'])){
      $fileTarget = "assets/gallery/";
      $viTargetNameArray =  explode(".",$_FILES['uploadFile']['name']);
      $viTargetName = funTreatNameFile($viTargetNameArray[0]);
      $mime = explode("/", $_FILES['uploadFile']['type'])[0];
      $size = $_FILES['uploadFile']['size'];
      $FileNameE=$_FILES['uploadFile']['name'];
      $temp1=explode(".", $FileNameE);
      $ext = end($temp1);
      
      if(strstr($mime, "video")){
        $typeFile = "image";
        $fileTarget .= "videos/".$viTargetName.".".$ext;;
        $fileTarget = funCanDoUpload($fileTarget);
        $hasUploaded = funMoveFiles($_FILES['uploadFile']["tmp_name"], "../../".$fileTarget);
      }else if(strstr($mime, "image")){
        $typeFile = "image";
        $image_info = getimagesize($_FILES["uploadFile"]["tmp_name"]);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        $vfTypeFile = $_FILES['uploadFile']['type'];
        if (($vfTypeFile == "image/svg+xml") || ($vfTypeFile == "image/vnd.microsoft.icon")){
          $fileTarget .= "images/".$viTargetName.".".$ext;
        }else{
          $fileTarget .= "images/".$viTargetName.".".$ext;
        }
        
        $fileTarget = funCanDoUpload($fileTarget);
        
        $hasUploaded = funSaveImages($_FILES['uploadFile']['type'], $_FILES['uploadFile']["tmp_name"], "../../".$fileTarget,"", "");
        
      }else{
        $typeFile = "other";
        $fileTarget .= "images/".$viTargetName.".".$ext;
        $hasUploaded = funSaveImages($_FILES['uploadFile']['type'], $_FILES['uploadFile']["tmp_name"], "../../".$fileTarget,"", "");
      }
      if($hasUploaded){
        $sqlCmd = "INSERT INTO tb_gallery (dateO,userO,width,height,name,description,alt,size,tb_gallery.path,extension,typeFile,status) VALUES ";
        $sqlCmd .= "($viDateC,$usr_id,'$image_width','$image_height','$viTargetName','','$viTargetName','$size','$fileTarget','$ext','$typeFile',1)";
      }else{
        die("false||Failed to upload image.");
      }
    }else{
      if(isset($_REQUEST['youSrc'])){
        $isFromYou = true;
        $fileTarget = $_REQUEST['youSrc'];
        $viTargetName = "youtube " .$fileTarget;
        $ext = "you";
        $size = "0";
        $typeFile = "youtube";
        $sqlCmd = "INSERT INTO tb_gallery (dateO,userO,width,height,name,description,alt,size,tb_gallery.path,extension,typeFile,status) VALUES ";
        $sqlCmd .= "($viDateC,$usr_id,'$image_width','$image_height','$viTargetName','','$viTargetName','$size','$fileTarget','$ext','$typeFile',1)";
        $fileTarget = "https://img.youtube.com/vi/$fileTarget/maxresdefault.jpg";
      }else{
        die("false||Source Empty");
      }
    }
    if ($result = $connection->query($sqlCmd)) {
      $id = $connection->insert_id;
      $action = "[ADD-IMAGE-GALLERY] - Operation add success";
      funCreateLog($action, $connection);
      if(!$isFromYou){$fileTarget = '../'.$fileTarget;}
      if($typeFile == "youtube"){
        $ico = "fa-youtube";
      }else if($typeFile == "image" || $typeFile == "other"){
        $ico = "fa-picture-o";
      }else{
        $ico = "fa-video-camera";
      }
      $childs = '<div class="gallery-child all '.$typeFile.'">';
      $childs .= '  <img src="'.$fileTarget.'" alt="'.$viTargetName.'" data-id="'.$id.'" ';
      $childs .= 'data-width="'.$image_width.'" data-height="'.$image_height.'" data-name="'.$viTargetName.'" ';
      $childs .= 'data-alt="'.$viTargetName.'" data-desc="" class="img-responsive"/>';
      $childs .= '<div class="abso-icon"><i class="fa fa-lg '.$ico.'" aria-hidden="true"></i></div>';
      $childs .= '</div>';
      echo "true||Operação realizada com sucesso.||".$childs;
      $db->commitAndClose();
    }else{
      $action = "[ADD-IMAGE-GALLERY] - Operation Failed";
      funCreateLog($action, $connection);
      echo "false||Falhou ao gravar item.";
      $db->commitAndClose();
    }
  }


  function funGetInfoGallery(){
    include_once('session.php');
    include_once('utils.php');
    include_once(PATH_DATABASE_INC);
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = "SELECT * FROM tb_gallery WHERE status=1 ORDER BY id DESC";
    if ($result = $connection->query($sqlCmd)) {
      $childs = "";
      $arrayType = [];
      while($rsData = mysqli_fetch_assoc($result)){
        $type = $rsData['typeFile'];
        if(!in_array($type,$arrayType)){array_push($arrayType,$type);}
        if($type == "youtube"){
          $targetFile = "https://img.youtube.com/vi/".$rsData['path']."/maxresdefault.jpg";
          $ico = "fa-youtube";
        }else if($type == "image" || $type == "other"){
          $ico = "fa-picture-o";
          $targetFile = "../".$rsData['path'];
        }else{
          $ico = "fa-video-camera";
          $targetFile = "../".$rsData['path'];
        }
        $childs .= '<div class="gallery-child all '.$type.'">';
        $childs .= '  <img src="'.$targetFile.'" alt="'.$rsData['alt'].'" data-id="'.$rsData['id'].'" ';
        $childs .= 'data-width="'.$rsData['width'].'" data-height="'.$rsData['height'].'" data-name="'.$rsData['name'].'" ';
        $childs .= 'data-alt="'.$rsData['alt'].'" data-desc="'.$rsData['description'].'" class="img-responsive"/>';
        $childs .= '<div class="abso-icon"><i class="fa fa-lg '.$ico.'" aria-hidden="true"></i></div>';
        $childs .= '</div>';
      }
      $type = "";
      $btns = "";
      for ($i=0; $i < count($arrayType); $i++) {
        $btns .= '<button type="button" name="button" data-filter="'.$arrayType[$i].'" class="btn btn-warning btn-filter margin-right-10">'.$arrayType[$i].'</button>';
        // if($type != ""){$sep="|#|";}else{$sep="";}
        // $type .= $sep . $arrayType[$i];
      }
      echo "true||".$childs."||".$btns;
    }else{
      echo "false||Data not available";
    }
  }

  function funDeleteImageGallery(){
    include_once('session.php');
    include_once('utils.php');
    include_once(PATH_DATABASE_INC);
    $db = Database::getInstance();
    $connection = $db->getConnection();
    if(isset($_REQUEST['i'])){$id = $_REQUEST['i'];}else{$id = "";}
    if($id != ""){
      $sqlCmd = "UPDATE tb_gallery SET status=0 WHERE id=$id";
      if ($result = $connection->query($sqlCmd)) {
        $db->commitAndClose();
        die("true||Operation done with success");
      }else{
        $db->rollbackAndClose();
        die("false||Operation failed");
      }
    }else{
      die("false||Problem deleting image");
    }
  }

  function funUpdateImage(){
    include_once('session.php');
    include_once('utils.php');
    include_once(PATH_DATABASE_INC);
    $db = Database::getInstance();
    $connection = $db->getConnection();

    if(isset($_REQUEST['i'])){$id = $_REQUEST['i'];}else{$id = "";}
    if(isset($_REQUEST['img-desc'])){$imgDesc = $_REQUEST['img-desc'];}else{$imgDesc = "";}
    if(isset($_REQUEST['img-alt'])){$imgAlt = $_REQUEST['img-alt'];}else{$imgAlt = "";}
    if(isset($_REQUEST['img-name'])){$imgName = $_REQUEST['img-name'];}else{$imgName = "";}

    if($id != ""){
      $sqlCmd = "SELECT * FROM tb_gallery WHERE id=$id";
      if ($result = $connection->query($sqlCmd)) {
        while($rsData = mysqli_fetch_assoc($result)){
          $name = $rsData['name'];
          $ext = $rsData['extension'];
          $path = $rsData['path'];
          $typeFile = $rsData['typeFile'];
          if($typeFile != "youtube"){
            if($imgName != ""){
              $imgName = str_replace(" ", "-", $imgName);
              $oldName = $name .".". $ext;
              $pathCenas = "assets/gallery/images/";
              $newPath =  $pathCenas.$imgName .".".$ext;

              $successRename = rename ("../../".$path ,"../../" .$newPath );
              if($successRename){
                $sql = "UPDATE tb_gallery SET name = '$imgName', path='$newPath',alt='$imgAlt',description='$imgDesc' WHERE id=$id";
              }else{
                die("false||Problem rename file");
              }
            }
          }else{
            $sql = "UPDATE tb_gallery SET name = '$imgName', alt='$imgAlt',description='$imgDesc' WHERE id=$id";
          }

        }
      }

      if ($resultUp = $connection->query($sql)) {
        $db->commitAndClose();
        die("true||Operation done with success");
      }else{
        $db->rollbackAndClose();
        die("false||Operation failed");
      }
    }else{
      die("false||Problem with file");
    }
  }

?>
