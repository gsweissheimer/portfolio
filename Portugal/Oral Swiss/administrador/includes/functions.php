<?php

function saveReal($connection, $flagUpd, $usr_id, $db, $idModel){
$imageUploadMain = "";
sleep(1);
  if(isset($_FILES['fileToUploadReal']) && !empty($_FILES['fileToUploadReal']['name']) && $_FILES['fileToUploadReal']['error'] != UPLOAD_ERR_NO_FILE){
  $target_dir = PATH_MODELS_GALLERY_IMG;
  $imageFileTypeMain = pathinfo(basename($_FILES['fileToUploadReal']["name"]),PATHINFO_EXTENSION);
  $newTitle = date("Y_m_d_H_i_s");
  $target_file = $target_dir . $newTitle . "." .$imageFileTypeMain;
  $fileTypeOriginal = $_FILES['fileToUploadReal']["type"];
  $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['fileToUploadReal']["tmp_name"], $target_file,"", "");
  $flagUpload = true;
  }else{
  $flagUpload = false;
  }


  if($imageUploadMain!=="NULL" && $flagUpload){
  $viIdGallery = funInsertIntoGallery($newTitle,$imageFileTypeMain,$connection,$usr_id);
    if(isset($viIdGallery)){
        $sqlCmdG2 = "UPDATE tb_models_gallery SET idTbGallery = $viIdGallery WHERE idTbModels=$idModel AND styleImg = 'Real'";
        $result = $connection->query($sqlCmdG2);
        if(!$result){
          if($flagUpload) funDeleteImage($target_file);
          $action = "[EDIT_SLIDE] - Failed UPDATE SLIDE " .$sqlCmdG2;
          funCreateLog($action, $connection);
          $db->rollbackAndClose();
          die("false||Opsss..Ocorreu um problema ao atualizar imagem.");
        } else {
          saveHead($connection, $flagUpd, $usr_id, $db, $idModel);
        }
      } else { echo "erro";}

} else {
  saveHead($connection, $flagUpd, $usr_id, $db, $idModel);
}
}

function saveHead($connection, $flagUpd, $usr_id, $db, $idModel){
$imageUploadMain = "";
sleep(1);
      if(isset($_FILES['fileToUploadHead']) && !empty($_FILES['fileToUploadHead']['name']) && $_FILES['fileToUploadHead']['error'] != UPLOAD_ERR_NO_FILE){
        // echo "######^#####";
      $target_dir = PATH_MODELS_GALLERY_IMG;
      $imageFileTypeMain = pathinfo(basename($_FILES['fileToUploadHead']["name"]),PATHINFO_EXTENSION);
      $newTitle = date("Y_m_d_H_i_s");
      $target_file = $target_dir . $newTitle . "." .$imageFileTypeMain;
      $fileTypeOriginal = $_FILES['fileToUploadHead']["type"];
      $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['fileToUploadHead']["tmp_name"], $target_file,"", "");
      }else{
      $flagUpload = false;
      }
        // if ($imageUploadMain!=="NULL"){echo "ola";}else {echo "ole";}
      if($imageUploadMain){
        $viIdGallery = funInsertIntoGallery($newTitle,$imageFileTypeMain,$connection,$usr_id);
      if(isset($viIdGallery)){
            $sqlCmdG3 = "UPDATE tb_models_gallery SET idTbGallery = $viIdGallery WHERE idTbModels=$idModel AND styleImg = 'Header'";
            $result = $connection->query($sqlCmdG3);
            if(!$result){
              if($flagUpload) funDeleteImage($target_file);
              $action = "[EDIT_SLIDE] - Failed UPDATE SLIDE " .$sqlCmdG3;
              funCreateLog($action, $connection);
              $db->rollbackAndClose();
              die("false||Opsss..Ocorreu um problema ao atualizar imagem.");
            } else {
              return $flagUpd = 1;
            }
          }
          }else{
          return $flagUpd = 0;
          }


}
