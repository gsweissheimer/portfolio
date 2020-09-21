<?php
include_once('../../includes/globalVars.php');
include_once('utils.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {
  case 'getCountryLang':
    funGetCountryLang();
    break;
  case 'addSlideTag':
      if($_REQUEST['bot'] == ""){funAddSlideTag();}else{die();}
      break;
  case 'addSlide':
		if($_REQUEST['bot'] == ""){funAddSlide();}else{die();}
		break;
  case 'getSlides':
    funGetSlides();
    break;
  case 'deleteSlide':
    funDeleteSlide();
    break;
  case 'getSlide':
    funGetSlide();
    break;
  case 'editSlide':
    if($_REQUEST['bot'] == ""){funEditSlide();}else{ die();}
    break;
  default:
    # code...
    break;
}

function funCreateSlideItems($vfArrayValues){
  if($vfArrayValues['flag'] == "true"){$active="active";}else{$active="";}
  $vfLangMin = $vfArrayValues['langMin'];
  $vfCountry = $vfArrayValues['country'];
  $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Título</label>';
  $value .= '			<input id="title" name="title_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['title'].'" required> ';
  $value .= '		</div>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Subtítulo</label>';
  $value .= '			<textarea id="desc" name="subTitle_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['subtitle'].'</textarea>';
  $value .= '		</div>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Texto</label>';
  $value .= '			<textarea id="desc" name="text_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['text'].'</textarea>';
  $value .= '		</div>';
  $value .= '<hr style="background: black; height: 1px;" >';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Call to Action</label>';
  $value .= '			<label>Title</label>';
  $value .= '			<input id="call_title" name="call_title_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['ctaTitle'].'" required> ';
  $value .= '			<label>Action</label>';
  $value .= '			<input id="call_action" name="call_action_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['ctaAction'].'" required> ';
  $value .= '		</div>';
  $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
  $value .= '</div>';
  return $value;
}

function funAddSlideTag(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";

  $slideTag = $_REQUEST['slideTag'];

  $sqlCmd1 = "SELECT count(*) AS count FROM tb_slide_code WHERE code='$slideTag'";

  if($result1 = $connection->query($sqlCmd1)){
    $row = mysqli_fetch_array($result1);
  	$row_cnt = $row['count'];

    if($row_cnt==0){
      $sqlCmd = "INSERT INTO tb_slide_code (dateO, userO, code) VALUES";
			$sqlCmd .= "($viDateC, $usr_id, '$slideTag')";

      $result = $connection->query($sqlCmd);
			if ($result) {
					$new_id = $connection->insert_id;
					$action = "[ADD_TAG] - Sucess added #" .$new_id;
					funCreateLog($action, $connection);
					$db->commitAndClose();
					echo "true||Operação realizada com sucesso.";
			}else{
				$action = "[ADD_TAG] - sql failed";
				funCreateLog($action, $connection);
				$db->rollbackAndClose();
				die("false||Oppsss... ocorreu um erro ao inserir a tag.");
			}
    }else{
  		$action = "[ADD_TAG] - Failed values came empty";
  		funCreateLog($action, $connection);
  		$db->rollbackAndClose();
  		die("false||Oppsss...a tag já existe.");
		}
  }
}

function funGetCountryLang(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $listFormBar = "";
  $listNavBar = "";
  $allInfo = "";

  $idCountry = $_REQUEST['countryId'];

  $sqlCmd = "SELECT
                   tb_language.id,
                   tb_language.lang,
                   tb_language.langMin,
                   tb_country.abbCountry
            FROM tb_country_language
            JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
            JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
            WHERE tb_country_language.status =1
            AND
             tb_country.id=".$idCountry."
            ORDER BY tb_country_language.defaultLang DESC";

  $result = $connection->query($sqlCmd);

  if ($result) {
    while($row = mysqli_fetch_assoc($result)){
      if($listNavBar == ""){
        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
      }else{
        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
      }

      if($listFormBar != ""){$flag=false;}else{$flag=true;}
         $viArrayValues['country'] = $row['abbCountry'];
         $viArrayValues['lang'] = $row['lang'];
         $viArrayValues['langMin'] = $row['langMin'];
         $viArrayValues['text'] = "";
         $viArrayValues['subtitle'] = "";
         $viArrayValues['ctaTitle'] = "";
         $viArrayValues['ctaAction'] = "";
         $viArrayValues['title'] = "";
         $viArrayValues['idTrans'] = "";
         $viArrayValues['flag'] = $flag;
         $listFormBar .= funCreateSlideItems($viArrayValues);
       }

       $allInfo .= '<ul id="navBar" class="nav nav-tabs">';
       $allInfo .= $listNavBar;
       $allInfo .= '</ul>';
       $allInfo .= '<div id="tabContent" class="tab-content">';
       $allInfo .= $listFormBar;
       $allInfo .= '</div>';
     }
     echo "true||".$allInfo;
   }

   function funAddSlide(){
     include_once('session.php');
     include_once('utils.php');
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();
     $viDateC = "'" . date("Y-m-d H:i:s") . "'";
     $inserted = false;
     $idSlideTag = $_REQUEST['slideTag'];
     $idCountry = $_REQUEST['countryBanner'];
     if(isset($_REQUEST['checkBox'])){$viCheckBox = 1; }else{$viCheckBox = 0;}
     $images = $_REQUEST['og_img'];

     $sqlCmdAddSlide = "INSERT INTO tb_slide (dateO, userO, status, flagCta, idTbSlideCode)";
     $sqlCmdAddSlide.= " VALUES ($viDateC, $usr_id, 1, '$viCheckBox', $idSlideTag)";

     if($result = $connection->query($sqlCmdAddSlide)){
       $idSlide = $connection->insert_id;

       $idImages = explode("||", $images);

       $sqlAddSlideImg = "INSERT INTO tb_slide_gallery (dateO, userO, status, tb_slide_gallery.default, idTbSlide, idTbGallery) VALUES";

       for($i=0; $i<count($idImages); $i++){
         $idimage=$idImages[$i];
         $length = count($idImages);
         if($i == (count($idImages)) - 1){
           $sqlAddSlideImg.= " ($viDateC, $usr_id, 1, 0, $idSlide, $idimage)";
         }else{
           $sqlAddSlideImg.= " ($viDateC, $usr_id, 1, 0, $idSlide, $idimage), ";
         }
       }

       if($result1 = $connection->query($sqlAddSlideImg)){

         $sqlGetCountryLang = "SELECT
                                    tb_language.id,
                                    tb_language.lang,
                                    tb_language.langMin,
                                    tb_country.abbCountry
                               FROM tb_country_language
                               JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                               JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                               WHERE tb_country_language.status =1
                               AND
                                tb_country.id=".$idCountry."
                               ORDER BY tb_country_language.defaultLang DESC";


        if($result2 = $connection->query($sqlGetCountryLang)){
          while ($row2 = mysqli_fetch_assoc($result2)) {
            $idLanguage = $row2['id'];
            $title = funTreatString($_REQUEST['title_'.$row2['abbCountry'].'_'.$row2['langMin']]);
            $subTitle = funTreatString($_REQUEST['subTitle_'.$row2['abbCountry'].'_'.$row2['langMin']]);
            $text = funTreatString($_REQUEST['text_'.$row2['abbCountry'].'_'.$row2['langMin']]);
            $ctaTitle = funTreatString($_REQUEST['call_title_'.$row2['abbCountry'].'_'.$row2['langMin']]);
            $ctaAction = funTreatString($_REQUEST['call_action_'.$row2['abbCountry'].'_'.$row2['langMin']]);

            $sqlInsSlideTrans = "INSERT INTO tb_slide_translation (dateC, title, subtitle, text, callTitle, callAction, status,";
            $sqlInsSlideTrans.= " idTbLanguage, idTbSlide, idTbCountry) VALUES ($viDateC, '$title', '$subTitle', '$text',";
            $sqlInsSlideTrans.= " '$ctaTitle', '$ctaAction', 1, $idLanguage, $idSlide, $idCountry)";


            $result3= $connection->query($sqlInsSlideTrans);

              if(!$result3){
                $action = "[ADD BANNER TRANS] - sql failed";
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die("false||Oppsss... ocorreu um erro ao as traduções do slide.");
              } else {
                $inserted = true;
              }
            }
          if($inserted){
            $action = "[ADD BANNER TRANS] - Sucess added";
            funCreateLog($action, $connection);
            $db->commitAndClose();
            echo "true||Operação realizada com sucesso.";
          }
        }else{
          echo "entrei" .$sqlGetCountryLang;
        }
       } else {
         $action = "[ADD Slider] - Failed inserting slider";
      		funCreateLog($action, $connection);
      		$db->rollbackAndClose();
      		die("false||Ocorreu um erro ao inserir a imagem do slider");
       }

     } else {
      $action = "[ADD Slider] - Failed inserting slider";
   		funCreateLog($action, $connection);
   		$db->rollbackAndClose();
   		die("false||Ocorreu um erro ao inserir o slider");
     }
   }

   function funGetSlides(){
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();


     $sqlCmd="SELECT
                  tb_slide_code.code,
                  tb_country.country,
                  tb_country.id as idCountry,
                  tb_slide.id,
                  tb_slide_translation.title
              FROM
                  tb_slide
              JOIN tb_slide_code ON tb_slide_code.id = tb_slide.idTbSlideCode
              JOIN tb_slide_translation ON tb_slide_translation.idTbSlide = tb_slide.id
              JOIN tb_country ON tb_country.id = tb_slide_translation.idTbCountry
              WHERE tb_slide.status=1
              GROUP BY tb_slide.id";

     $values = "";
     if ($result = $connection->query($sqlCmd)) {
       $arrayMain = [];
       while($rsData = mysqli_fetch_assoc($result)){
           $urlToEdit = "location.href='slides-editar.php?id=".$rsData['id']."&idC=".$rsData['idCountry']."'";
           $urlToDelete = "funDeleteItem(".$rsData['id'].")";
           $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
           $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
           array_push($arrayMain,[$rsData['id'],$rsData['code'],$rsData['title'],$rsData['country'],$values]);
       }
     }
     echo json_encode($arrayMain);
     $db->closeConnection();
   }

   function funDeleteSlide(){
     include_once('session.php');
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();

     $idSlide = $_REQUEST['id'];
     $viDateC = "'" . date("Y-m-d H:i:s") . "'";

     $sqlDeleteSlide = "UPDATE tb_slide SET dateO=$viDateC, userO=$usr_id, status = 0 WHERE id =$idSlide";

     $result = $connection->query($sqlDeleteSlide);

     if($result){
       $action = "[DELETE SLIDE] - Sucess deleting #".$idSlide;
    		funCreateLog($action, $connection);
    		$db->commitAndClose();
    		echo "true||Operação realizada com sucesso.";
     } else {
       $action = "[DELETE SLIDE] - Error deleting #".$idSlide;
    		funCreateLog($action, $connection);
    		$db->rollbackAndClose();
    		echo "false||Operação Falhou.";
     }
   }

   function funGetSlide(){
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();

     $idSlide=$_REQUEST['id'];
     $idTbCountry = $_REQUEST['idC'];
     $listNavBar = "";
     $listFormBar = "";

     $sqlCmdSlideInfo = "SELECT
                              tb_slide.flagCta,
                              tb_slide.idTbSlideCode
                         FROM
                              tb_slide
                         WHERE
                              tb_slide.id=$idSlide";

    if($result = $connection->query($sqlCmdSlideInfo)){
      while($row = mysqli_fetch_assoc($result)){
        $flagCta = $row['flagCta'];
        $idSlideCode = $row['idTbSlideCode'];
      }
    }

    $sqlGetSlideGallery = "SELECT
                                tb_slide_gallery.idTbGallery
                           FROM tb_slide_gallery
                           WHERE tb_slide_gallery.idTbSlide=$idSlide
                           AND tb_slide_gallery.status = 1";

    $images = [];

    if($result1 = $connection->query($sqlGetSlideGallery)){
      while($row1=mysqli_fetch_assoc($result1)){
        array_push($images, $row1['idTbGallery']);
      }
    }
    $idImages = implode("||", $images);

    $sqlCmd4 = "SELECT
                     tb_language.id,
                     tb_language.lang,
                     tb_language.langMin,
                     tb_country.abbCountry
              FROM tb_country_language
              JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
              JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
              WHERE tb_country_language.status =1
              AND
               tb_country.id=".$idTbCountry."
              ORDER BY tb_country_language.defaultLang DESC";

      $result4 = $connection->query($sqlCmd4);

      if ($result4) {
          while($row4 = mysqli_fetch_assoc($result4)){

            $idTbLanguage = $row4['id'];

            if($listNavBar == ""){
              $listNavBar = '<li class="active"><a href="#'.$row4['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row4['langMin'].'</a></li>';
            }else{
              $listNavBar .= '<li class=""><a href="#'.$row4['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row4['langMin'].'</a></li>';
            }

            $sqlGetTrans = "SELECT
                                  tb_language.langMin,
                                  tb_country.id as idCountry,
                                  tb_country.abbCountry,
                                  tb_slide_translation.title,
                                  tb_slide_translation.subtitle,
                                  tb_slide_translation.text,
                                  tb_slide_translation.callTitle,
                                  tb_slide_translation.callAction,
                                  tb_slide_translation.id
                            FROM tb_slide_translation
                            JOIN tb_language ON tb_language.id = tb_slide_translation.idTbLanguage
                            JOIN tb_country ON tb_country.id = tb_slide_translation.idTbCountry
                            WHERE tb_slide_translation.idTbSlide = $idSlide
                            AND tb_slide_translation.status = 1
                            AND tb_country.id = $idTbCountry
                            AND tb_language.id=$idTbLanguage";

                  if($result5 = $connection->query($sqlGetTrans)){
                    $numRow = mysqli_num_rows($result5);
                    if($numRow>0){
                      while ($row2 = mysqli_fetch_assoc($result5)) {
                        $idCountry=$row2['idCountry'];
                        if($listFormBar != ""){$flag=false;}else{$flag=true;}
                           $viArrayValues['country'] = $row2['abbCountry'];
                           $viArrayValues['langMin'] = $row2['langMin'];
                           $viArrayValues['text'] = $row2['text'];
                           $viArrayValues['subtitle'] = $row2['subtitle'];
                           $viArrayValues['ctaTitle'] = $row2['callTitle'];
                           $viArrayValues['ctaAction'] = $row2['callAction'];
                           $viArrayValues['title'] = $row2['title'];
                           $viArrayValues['idTrans'] = $row2['id'];
                           $viArrayValues['flag'] = $flag;
                           $listFormBar .= funCreateSlideItems($viArrayValues);
                         }
                       } else {
                         if($listFormBar != ""){$flag=false;}else{$flag=true;}
                         $viArrayValues['country'] = $row4['abbCountry'];
                         $viArrayValues['langMin'] = $row4['langMin'];
                         $viArrayValues['text'] = "";
                         $viArrayValues['subtitle'] = "";
                         $viArrayValues['ctaTitle'] = "";
                         $viArrayValues['ctaAction'] = "";
                         $viArrayValues['title'] = "";
                         $viArrayValues['idTrans'] = "";
                         $viArrayValues['flag'] = $flag;
                         $listFormBar .= funCreateSlideItems($viArrayValues);
                       }

                       $allInfo = '<ul id="navBar" class="nav nav-tabs">';
                       $allInfo .= $listNavBar;
                       $allInfo .= '</ul>';
                       $allInfo .= '<div id="tabContent" class="tab-content">';
                       $allInfo .= $listFormBar;
                       $allInfo .= '</div>';
                     }
               }
            }
            echo "true|sds|".$allInfo."|sds|".$flagCta."|sds|".$idSlideCode."|sds|".$idImages."|sds|".$idCountry;
          }

   function funEditSlide(){
     include_once('session.php');
     include_once('utils.php');
     include_once(PATH_DATABASE_INC);
     $db = Database::getInstance();
     $connection = $db->getConnection();
     $viDateC = "'" . date("Y-m-d H:i:s") . "'";
     $inserted = false;

     $idSlideTag = $_REQUEST['slideTag'];
     $idCountry = $_REQUEST['countryBanner'];
     if(isset($_REQUEST['checkBox'])){$viCheckBox = 1; }else{$viCheckBox = 0;}
     $images = $_REQUEST['og_img'];
     $idSlide = $_REQUEST['idSlide'];

     $sqlUpdSlide = "UPDATE tb_slide SET flagCta = $viCheckBox, idTbSlideCode = $idSlideTag WHERE id=$idSlide";

     if($result = $connection->query($sqlUpdSlide)){

       $sqlDeleteSlideGallery = "UPDATE tb_slide_gallery SET status = 0 WHERE idTbSlide=$idSlide";

       $res=$connection->query($sqlDeleteSlideGallery);

       $idImages = explode("||", $images);

       $sqlAddSlideImg = "INSERT INTO tb_slide_gallery (dateO, userO, status, tb_slide_gallery.default, idTbSlide, idTbGallery) VALUES";

       for($i=0; $i<count($idImages); $i++){
         $idimage=$idImages[$i];
         $length = count($idImages);
         if($i == (count($idImages)) - 1){
           $sqlAddSlideImg.= " ($viDateC, $usr_id, 1, 0, $idSlide, $idimage)";
         }else{
           $sqlAddSlideImg.= " ($viDateC, $usr_id, 1, 0, $idSlide, $idimage), ";
         }
       }

       if($result1 = $connection->query($sqlAddSlideImg)){
         $sqlGetCountryLang = "SELECT
                                    tb_language.id,
                                    tb_language.lang,
                                    tb_language.langMin,
                                    tb_country.abbCountry
                               FROM tb_country_language
                               JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
                               JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
                               WHERE tb_country_language.status =1
                               AND
                                tb_country.id=".$idCountry."
                               ORDER BY tb_country_language.defaultLang DESC";


        if($result2 = $connection->query($sqlGetCountryLang)){
          while ($row2 = mysqli_fetch_assoc($result2)) {
            $idLanguage = $row2['id'];
            $title = funTreatString($_REQUEST['title_'.$row2['abbCountry'].'_'.$row2['langMin']]);
            $subTitle = funTreatString($_REQUEST['subTitle_'.$row2['abbCountry'].'_'.$row2['langMin']]);
            $text = funTreatString($_REQUEST['text_'.$row2['abbCountry'].'_'.$row2['langMin']]);
            $ctaTitle = funTreatString($_REQUEST['call_title_'.$row2['abbCountry'].'_'.$row2['langMin']]);
            $ctaAction = $_REQUEST['call_action_'.$row2['abbCountry'].'_'.$row2['langMin']];
            $idTrans = $_REQUEST['idTrans_'.$row2['abbCountry'].'_'.$row2['langMin']];

            if($idTrans != ""){
              $sqlUpdSlideTrans = "UPDATE tb_slide_translation SET title='$title', subtitle='$subTitle', text='$text', ";
              $sqlUpdSlideTrans.= " callTitle='$ctaTitle', callAction='$ctaAction' WHERE id=$idTrans";
            } else {
              $sqlUpdSlideTrans = "INSERT INTO tb_slide_translation (dateC, title, subtitle, text, callTitle, callAction, status, idTbLanguage, idTbSlide, idTbCountry)";
              $sqlUpdSlideTrans .= "VALUES ($viDateC, '$title', '$subTitle', '$text', '$ctaTitle', '$ctaAction', 1, '$idLanguage', '$idSlide', '$idCountry')";
            }

            $result3= $connection->query($sqlUpdSlideTrans);

              if(!$result3){
                $action = "[UPD SLIDE TRANS] - sql failed";
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die("false||Oppsss... ocorreu um erro ao as traduções do slide.");
              } else {
                $inserted = true;
              }
            }
          if($inserted){
            $action = "[UPD SLIDE TRANS] - Sucess added";
            funCreateLog($action, $connection);
            $db->commitAndClose();
            echo "true||Operação realizada com sucesso.";
          }
        }

       } else {
         $action = "[UPD SLIDE] - Error updating slide images";
      	 funCreateLog($action, $connection);
      	 $db->rollbackAndClose();
      	 echo "false||Problem updating slides images.";
       }


     } else {
       $action = "[UPD SLIDE] - Error updating slide";
    	 funCreateLog($action, $connection);
    	 $db->rollbackAndClose();
    	 echo "false||Operação Falhou.";
     }

   }
?>
