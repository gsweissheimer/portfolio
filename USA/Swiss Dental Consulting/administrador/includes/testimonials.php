<?php
include_once('../../includes/globalVars.php');
include_once('utils.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getTestimonialsCountry':
    if(isset($_REQUEST['idC'])){$idCountry = $_REQUEST['idC'];}else{$idCountry = "";}
    funGetCountry($idCountry);
    break;
  case 'getTestimonialsNew':
    funGetTestimonialsNew();
    break;
  case 'addTestimonial':
    funAddTestimonial();
    break;
  case 'getTestimonials':
    funGetTestemonials();
    break;
  case 'getTestimonialsEdit':
    funGetTetimonialEdit();
    break;
  case 'deleteTestimonial':
    funDeleteTestimonial();
    break;
  case 'editTestimonial':
    funEditTestimonial();
    break;
  default:
    # code...
    break;
}

function funCreateTestimonialsItems($vfArrayValues){
  if($vfArrayValues['flag'] == "true"){$active="active";}else{$active="";}
  $vfLang = $vfArrayValues['lang'];
  $vfIdVideo = $vfArrayValues['videoID'];
  $vfSrcVideo = $vfArrayValues['videoSrc'];

  $flag = $vfArrayValues['flag'];
  $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
  $value .= '   <div class="col-sm-12">';
  $value .= '     <div class="col-sm-6">';
  $value .= '       <span onclick="funOpenGallery(false,og_img_'.$vfLang.','.GALLERY_YOUTUBE.')" class="btn btn-success">Choose Video</span>';
  $value .= '		    <input type="hidden" id="og_img_'.$vfLang.'" name="og_image_'.$vfLang.'" class="form-control"  value="'.$vfIdVideo.'">';
  $value .= '     </div>';
  $value .= '     <div class="col-sm-6">';
  $value .= '		   <img id="bg_og_img_'.$vfLang.'" name="bg_og_image_'.$vfLang.'" src="'.funGetImageYoutube($vfSrcVideo).'"  class="img-responsive">';
  $value .= '     </div>';
  $value .= '	  </div>';
  $value .= '</div>';

  return $value;
}
function funGetCountry($vfIdCountry = "",$isToReturn=false){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $sqlCmdCountry = "SELECT id, country, abbCountry FROM tb_country WHERE status = 1";
  $optionCountry = "<option value=''>Select an option</option>";
  if ($result = $connection->query($sqlCmdCountry)) {
    while($row = mysqli_fetch_assoc($result)){
      $idCountry = $row['id'];
      $country = $row['country'];
      if($vfIdCountry == $idCountry){$select = "selected";}else{$select="";}
      $optionCountry .= "<option value='$idCountry' $select>$country</option>";
    }
  }
  if($isToReturn){
    return $optionCountry;
  }else{
    $mediaType = funGetMediaType();
    echo "true||".$optionCountry."||".$mediaType;
  }
}

function getMedias(){
  $arrayMediaType = array(
      "0" => "Testimonials",
      "1" => "Events",
      "2" => "Campaigns",
  );
  return $arrayMediaType;
}
function funGetMediaType($vfType="000000009"){
  $arrayMediaType = getMedias();
  $option = "<option value=''>Select an option</option>";
  foreach ($arrayMediaType as $key => $value) {
    if($key == $vfType){$select="selected";}else{$select="";}
    $option .= "<option value='$key' $select>$value</option>";
  }
  return $option;
}

function funGetTestimonialsNew(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $idCountry = $_REQUEST['countryBanner'];
  $listFormBar = "";
  $listNavBar = "";
  $listNavBarLang = "";
  $sqlCmdCountryLang = "SELECT
                               tb_language.id,
                               tb_language.langMin,
                               tb_language.lang
                        FROM tb_country_language
                        JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                        JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                        WHERE tb_country_language.status =1
                        AND
                         tb_country.id=".$idCountry;
  if ($result1 = $connection->query($sqlCmdCountryLang)) {
    while($row1 = mysqli_fetch_assoc($result1)){
      if($listNavBar == ""){
				$listNavBar = '<li class="active"><a href="#'.$row1['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row1['lang'].'</a></li>';
			}else{
				$listNavBar .= '<li class=""><a href="#'.$row1['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row1['lang'].'</a></li>';
			}
      if($listFormBar != ""){$flag=false;}else{$flag=true;}
       $viArrayValues['lang'] = $row1['langMin'];
       $viArrayValues['videoID'] = "";
       $viArrayValues['videoSrc'] = "";
       $viArrayValues['flag'] = $flag;
       $listFormBar .= funCreateTestimonialsItems($viArrayValues);
    }
  }
  echo "true||".$listNavBar."||".$listFormBar;
}

function funAddTestimonial(){
  include_once('session.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $idCountry = $_REQUEST['countryBanner'];
  if(isset($_REQUEST['name'])){$name = $_REQUEST['name'];}else{$name="";}
  if(isset($_REQUEST['datepicker'])){$datepicker = $_REQUEST['datepicker'];}else{$datepicker="";}
  $flagType = $_REQUEST['mediaType'];
  if($name != "" && $datepicker != ""){
    $datepicker = date('Y-m-d', strtotime($datepicker));
    $sqlCmd = "INSERT INTO tb_testimonials (dateO,userO,name,date,status,flagType,idTbCountry) values($viDateC,$usr_id,'$name','$datepicker',1,$flagType,$idCountry)";
    if ($result = $connection->query($sqlCmd)) {
      $idTestimonials = $connection->insert_id;
      $sqlCmdCountryLang = "SELECT
                                   tb_language.id,
                                   tb_language.langMin,
                                   tb_language.lang
                            FROM tb_country_language
                            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                            WHERE tb_country_language.status =1
                            AND
                             tb_country.id=".$idCountry;
      if ($result1 = $connection->query($sqlCmdCountryLang)) {
        while($row1 = mysqli_fetch_assoc($result1)){
          $langID = $row1['id'];
          $lang = $row1['langMin'];
          if(isset($_REQUEST['og_image_'.$lang])){$img = $_REQUEST['og_image_'.$lang];}else{$img="";}
          $sqlCmd1 = "INSERT INTO tb_testimonials_media (dateO,userO,idTbGallery,idtbLang,idTbTestimonials) values ";
          $sqlCmd1 .= "($viDateC,$usr_id,$img,$langID,$idTestimonials)";
          if (!$result2 = $connection->query($sqlCmd1)) {
            $action = "[ADD-TESTIMONIALS] - Failed add media";
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die("false||Problem inserting video");
          }
        }
        $action = "[ADD-TESTIMONIALS] - Operation add success";
				funCreateLog($action, $connection);
				echo "true||Operation was been successfuly done.";
				$db->commitAndClose();
      }
    }else{
      $action = "[ADD-TESTIMONIALS] - Failed add";
      funCreateLog($action, $connection);
      $db->rollbackAndClose();
      die("false||Problem inserting testemonials");
    }
  }else{
    echo "false||Some values are empty";
  }
}

function funGetTestemonials(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $arrayMain = [];
  $sqlCmd = "SELECT
              tb_testimonials.id ,
            	tb_testimonials.name ,
            	tb_testimonials.date ,
              tb_testimonials.flagType ,
              tb_country.id AS idCountry ,
            	tb_country.country ,
            	tb_gallery.path,
              tb_gallery.extension as ext
            FROM
            	tb_testimonials_media
            JOIN tb_testimonials ON tb_testimonials_media.idTbTestimonials = tb_testimonials.id
            JOIN tb_country ON tb_testimonials.idTbCountry = tb_country.id
            JOIN tb_gallery ON tb_testimonials_media.idTbGallery = tb_gallery.id
            WHERE tb_testimonials.status = 1
            GROUP BY
            	tb_testimonials_media.idTbTestimonials";
  if ($result1 = $connection->query($sqlCmd)) {
    while($row1 = mysqli_fetch_assoc($result1)){
      $urlToEdit = "location.href='media-editar.php?id=".$row1['id']."&idC=".$row1['idCountry']."'";
      $urlToDelete = "funDeleteItem(".$row1['id'].")";
      $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
      $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
      if($row1['ext'] == "you"){
        $img = funGetImageYoutube($row1['path']);
      }else{
        $img = '../'.$row1['path'];
      }
      $arrayMedia = getMedias();
      $typeMedia = $arrayMedia[$row1['flagType']];
      array_push($arrayMain,[$row1['id'],$row1['name'],$row1['date'],$row1['country'],$img,$typeMedia,$values]);
    }
  }
  echo json_encode($arrayMain);
  $db->closeConnection();
}

function funGetTetimonialEdit(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  if(isset($_REQUEST['id'])){$idTest = $_REQUEST['id'];}else{$idTest = "";}
  if(isset($_REQUEST['idC'])){$idCountry = $_REQUEST['idC'];}else{$idCountry = "";}
  if($idTest != "" && $idCountry != ""){
    $listFormBar = "";
    $listNavBar = "";
    $listNavBarLang = "";
    $sqlCmdCountryLang = "SELECT
                                 tb_language.id,
                                 tb_language.langMin,
                                 tb_language.lang
                          FROM tb_country_language
                          JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                          JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                          WHERE tb_country_language.status =1
                          AND
                           tb_country.id=".$idCountry;
    if ($result1 = $connection->query($sqlCmdCountryLang)) {
      while($row1 = mysqli_fetch_assoc($result1)){
        if($listNavBar == ""){
          $listNavBar = '<li class="active"><a href="#'.$row1['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row1['lang'].'</a></li>';
        }else{
          $listNavBar .= '<li class=""><a href="#'.$row1['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row1['lang'].'</a></li>';
        }
        if($listFormBar != ""){$flag=false;}else{$flag=true;}

        $sqlCmdGetGeneralInfo = "SELECT
                                tb_testimonials.id,
                                tb_testimonials.name,
                                tb_testimonials.date,
                                tb_testimonials.flagType
                                FROM tb_testimonials
                                WHERE tb_testimonials.id = $idTest";

        if($result2 = $connection->query($sqlCmdGetGeneralInfo)){
          while($row2 = mysqli_fetch_assoc($result2)){
            $name = $row2['name'];
            $date = date('m/d/Y', strtotime($row2['date']));
            $flagType = $row2['flagType'];
        }
      }


        $sqlCmd = "SELECT
                    	tb_gallery.path ,
                    	tb_gallery.id AS idGallery
                    FROM
                    	tb_testimonials_media
                    JOIN tb_testimonials ON tb_testimonials_media.idTbTestimonials = tb_testimonials.id
                    JOIN tb_country ON tb_testimonials.idTbCountry = tb_country.id
                    JOIN tb_gallery ON tb_testimonials_media.idTbGallery = tb_gallery.id
                    WHERE
                    	tb_testimonials. STATUS = 1
                    AND tb_testimonials.id = $idTest
                    AND tb_testimonials_media.idTbLang =".$row1['id'];
        if ($result = $connection->query($sqlCmd)) {
          $numRow = mysqli_num_rows($result);
          if($numRow>0){
            while($row = mysqli_fetch_assoc($result)){
              $viArrayValues['lang'] = $row1['langMin'];
              $viArrayValues['videoID'] = $row['idGallery'];
              $viArrayValues['videoSrc'] = $row['path'];
              $viArrayValues['flag'] = $flag;
              $listFormBar .= funCreateTestimonialsItems($viArrayValues);
            }
          } else {
            $viArrayValues['lang'] = $row1['langMin'];
            $viArrayValues['videoID'] = "";
            $viArrayValues['videoSrc'] = "";
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateTestimonialsItems($viArrayValues);
          }
        }
      }

      $optionsCountry = funGetCountry($idCountry,true);
      $optionsMediaType = funGetMediaType($flagType);
      echo "true||$name||$date||$listNavBar||$listFormBar||$optionsCountry||$optionsMediaType";
    }
  }else{
    die("false||Invalid Testimonial");
  }
}

function funDeleteTestimonial(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  if(isset($_REQUEST['id'])){$idTest = $_REQUEST['id'];}else{$idTest = "";}
  $sqlCmd = "UPDATE tb_testimonials SET status=0 WHERE id=".$idTest;
  if ($result = $connection->query($sqlCmd)) {
    $action = "[DELETE-TESTEMONIALS] - Operation add success";
    funCreateLog($action, $connection);
    echo "true||Testimonial has deleted with success";
    $db->commitAndClose();
  }else{
    $action = "[DELETE-TESTEMONIALS] - Failed deleted";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Fail to delete testimonials");
  }
}

function funEditTestimonial(){
  include_once('session.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $idCountry = $_REQUEST['idC'];
  $idTestimonials = $_REQUEST['idTestimonials'];
  $flagType = $_REQUEST['mediaType'];
  if(isset($_REQUEST['name'])){$name = $_REQUEST['name'];}else{$name="";}
  if(isset($_REQUEST['datepicker'])){$datepicker = $_REQUEST['datepicker'];}else{$datepicker="";}
  $flagType = $_REQUEST['mediaType'];
  if($name != "" && $datepicker != ""){
    $datepicker = date('Y-m-d', strtotime($datepicker));
    $sqlCmd = "DELETE FROM tb_testimonials_media WHERE idTbTestimonials=$idTestimonials";
    if ($result = $connection->query($sqlCmd)) {
      $sqlCmd2 = "UPDATE tb_testimonials SET name='$name', date='$datepicker',flagType='$flagType' WHERE id=$idTestimonials";
      if ($result2 = $connection->query($sqlCmd2)) {
        $sqlCmdCountryLang = "SELECT
                                     tb_language.id,
                                     tb_language.langMin,
                                     tb_language.lang
                              FROM tb_country_language
                              JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                              JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                              WHERE tb_country_language.status =1
                              AND
                               tb_country.id=".$idCountry;
        if ($result1 = $connection->query($sqlCmdCountryLang)) {
          while($row1 = mysqli_fetch_assoc($result1)){
            $langID = $row1['id'];
            $lang = $row1['langMin'];
            if(isset($_REQUEST['og_image_'.$lang])){$img = $_REQUEST['og_image_'.$lang];}else{$img="";}
            $sqlCmd1 = "INSERT INTO tb_testimonials_media (dateO,userO,idTbGallery,idtbLang,idTbTestimonials) values ";
            $sqlCmd1 .= "($viDateC,$usr_id,$img,$langID,$idTestimonials)";
            if (!$result2 = $connection->query($sqlCmd1)) {
              $action = "[EDIT-TESTIMONIALS] - Failed add media";
              funCreateLog($action, $connection);
              $db->rollbackAndClose();
              die("false||Problem updating video");
            }
          }
          $action = "[EDIT-TESTIMONIALS] - Operation add success";
          funCreateLog($action, $connection);
          echo "true||Operation was been successfuly done.";
          $db->commitAndClose();
        }
      }else{
        $action = "[EDIT-TESTIMONIALS] - Update name";
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die("false||Problem updating testemonials");
      }
    }else{
      $action = "[EDIT-TESTIMONIALS] - Failed add";
      funCreateLog($action, $connection);
      $db->rollbackAndClose();
      die("false||Problem updating testemonials");
    }
  }else{
    echo "false||Some values are empty";
  }
}

?>
