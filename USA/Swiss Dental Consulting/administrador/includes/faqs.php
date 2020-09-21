<?php
include_once('../../includes/globalVars.php');
include_once('utils.php');
$cmdEval = $_REQUEST['cmdEval'];
switch ($cmdEval) {

  case 'getCountries':
    funGetCountries();
    break;

  case 'getFaqTranslationForm':
    funGetFaqTranslationItem();
    break;
  
  case 'addFAQTag':
    if($_REQUEST['bot'] == ""){funAddFAQTag();}else{die();}
    break;
  
  case 'getFaqTags':
    funGetFaqTags();
    break;

  case 'deleteFaqTag':
    funDeleteFaqTag();
    break;

  case 'editFaqTranslationForm':
    funEditFaqTranslationItem();
    break;

  case 'getFaqTagText':
    funGetFaqTagText();
    break;

  case 'editFaqTag':
    funEditFaqTag();
    break;

  case 'initFaqTagsAndCountries':
    funInitTagsAndCountries();
    break;

  case 'getFaqTagCountryId':
    funGetFaqTagCountryId();
    break;

  case 'getFaqFormByCountry':
    funGetFaqFormByCountry();
    break;
  
  case 'addFaq':
    if($_REQUEST['bot'] == ""){funAddFaq();}else{die();}
    break;

  case 'getFaqs':
    funGetFaqs();
    break;

  case 'deleteFaq':
    funDeleteFaq();
    break;

  case 'getFaqData':
    funGetFaqData();
    break;

  case 'getImagePath':
    funGetImagePath();
    break;

  case 'editFaq':
    funEditFaq();
    break;

  /*
  case 'getCountryLang':
    funGetCountryLang();
    break;
  case 'addFaq':
    if($_REQUEST['bot'] == ""){funAddFaq();}else{die();}
    break;
  case 'getFaqs':
    funGetFaqs();
    break;
  case 'deleteFaq':
    funDeleteFaq();
    break;
  case 'getFaq':
    funGetFaq();
    break;
  case 'editFaq':
    funEditFaq();
    break;
  case 'initFaq':
    funInitFaq();
  */

  default:
    # code...
    break;
}

function funEditFaq(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $inserted = false;

  //var_dump($_REQUEST);
  //exit(0);

  $idImage = $_REQUEST['og_img'];
  $idFaq = $_REQUEST['idFaq'];
  $idCountry = $_REQUEST['idCountry'];

  $sqlUpdFaq = "UPDATE tb_faqs SET dateO=$viDateC, userO=$usr_id, idTbGallery=$idImage";
  $sqlUpdFaq.= " WHERE id=$idFaq";

  if($result = $connection->query($sqlUpdFaq)){

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
      tb_country.id=".$idCountry;

    if ($result = $connection->query($sqlCmd)){
      while($row = mysqli_fetch_assoc($result)){
        $idLang=$row['id'];
        $answer= $_REQUEST['answer_'.$row['abbCountry'].'_'.$row['langMin']];
        $question = $_REQUEST['question_'.$row['abbCountry'].'_'.$row['langMin']];
          
        $sqlUpdFaqAnswer = "UPDATE tb_faqs_translation SET question='$question', answer='$answer'
        WHERE tb_faqs_translation.idTbFaq=$idFaq
        AND tb_faqs_translation.idTbCountry=$idCountry
        AND tb_faqs_translation.idTbLanguage=$idLang";

        //var_dump($sqlUpdFaqAnswer);
        //exit(0);

        $result1 = $connection->query($sqlUpdFaqAnswer);
        if(!$result1){
          $action = "[UPD FAQ] - Failed update  faq TRANSLATIONS";
          funCreateLog($action, $connection);
          $db->rollbackAndClose();
          die("false||Ocorreu um problema ao actualizar faq #0002");
        }
      }
      echo "true||Operação realizada com sucesso.";
      $action = "[ADD FAQ] - Success updating faq";
      funCreateLog($action, $connection);
      $db->commitAndClose();
    }

  } else {
    $action = "[ADD TITLE] - Failed adding media";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Ocorreu um erro ao adicionar a faq.");
  }
}

function funGetFaqData(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $allInfo = "";
  $listNavBar = "";
  $listFormBar = "";
  $idGallery = "";
  $imgSrc = "";
  $idFaq = $_REQUEST['id'];
  $idTag = $_REQUEST['idT'];
  $idCountry = $_REQUEST['idC'];

  $sql2 = "SELECT
    tb_language.id,
    tb_language.lang,
    tb_language.langMin,
    tb_country.abbCountry
  FROM tb_country_language
  JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
  JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
  WHERE tb_country_language.status =1
  AND tb_country.id=".$idCountry;

  $result2 = $connection->query($sql2);

  //var_dump($idFaq);

  if ($result2) {
    while($row = mysqli_fetch_assoc($result2)){ 

      if($listNavBar == ""){
        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
      }else{
        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
      }
      
      $sql3 = "SELECT
        tb_faqs.id,
        tb_faqs_translation.question,
        tb_faqs_translation.answer
      FROM tb_faqs_translation
      JOIN tb_faqs ON tb_faqs.id = tb_faqs_translation.idTbFaq
      WHERE tb_faqs.id = $idFaq
      AND tb_faqs_translation.idTbLanguage = ".$row['id']."
      AND tb_faqs_translation.idTbCountry = $idCountry";

      $result3 = $connection->query($sql3);

      //var_dump($sql3);

      if ($result3) {
        
        while($row2 = mysqli_fetch_assoc($result3)){ 
          
          if($listFormBar != ""){$flag=false;}else{$flag=true;}
          $viArrayValues['country'] = $row['abbCountry'];
          $viArrayValues['langMin'] = $row['langMin'];
          $viArrayValues['answer'] = $row2['answer'];
          $viArrayValues['question'] = $row2['question'];
          $viArrayValues['flag'] = $flag;
          $listFormBar .= funCreateFaqItem($viArrayValues);

        } 
      }
    }
    $allInfo .= '<ul id="navBar" class="nav nav-tabs">';
    $allInfo .= $listNavBar;
    $allInfo .= '</ul>';
    $allInfo .= '<div id="tabContent" class="tab-content">';
    $allInfo .= $listFormBar;
    $allInfo .= '</div>';
  }

  echo "true||$allInfo";
  
}

function funGetImagePath() {
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $idTag = $_REQUEST['id'];

  $idGallery = "";
  $sql1 = "SELECT idTbGallery FROM tb_faqs WHERE tb_faqs.id=$idTag";
  $result = $connection->query($sql1);
  if ($result) {
    while($row = mysqli_fetch_assoc($result)){ 
      $idGallery = $row['idTbGallery'];
    } 
  }
  
  $path = "";
  $sql = "SELECT tb_gallery.path FROM tb_gallery WHERE tb_gallery.id=$idGallery";
  $result = $connection->query($sql);
  if ($result) {
    while($row = mysqli_fetch_assoc($result)){ 
      $path = $row['path'];
    } 
  }
  
  echo "true||$path||$idGallery";
}

function funAddFaq(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  //$inserted = false;

  $idTag = $_REQUEST['tag'];
  $idGallery = $_REQUEST['og_img'];
  $idCountry = $_REQUEST['idCountry'];

  $sql = "INSERT INTO tb_faqs (dateO, userO, status, idTbGallery, idTbCountry, idTbFaqsTag) ";
  $sql .= "VALUES ($viDateC, $usr_id, 1, $idGallery, $idCountry, $idTag)";
  
  //var_dump($sql);

  if($result = $connection->query($sql)){
    $idFaq = $connection->insert_id;

    $sql2 = "SELECT
      tb_language.id,
      tb_language.lang,
      tb_language.langMin,
      tb_country.abbCountry
    FROM tb_country_language
    JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
    JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
    WHERE tb_country_language.status =1
    AND tb_country.id=".$idCountry;

    $result2 = $connection->query($sql2);

    //var_dump($idFaq);

    if ($result2) {
      while($row = mysqli_fetch_assoc($result2)){ 

        $question = $_REQUEST['question_'.$row['abbCountry'].'_'.$row['langMin']];
        $answer = $_REQUEST['answer_'.$row['abbCountry'].'_'.$row['langMin']];

        $sql3 = "INSERT INTO tb_faqs_translation (dateO, userO, question, answer, idTbLanguage, idTbCountry, idTbFaq) ";
        $sql3 .= "VALUES ($viDateC, $usr_id, '$question', '$answer', ".$row['id'].", $idCountry, $idFaq)";

        $result3 = $connection->query($sql3);
        if (!$result3) {
          $action = "[ADD FAQ] - Failed";
          funCreateLog($action, $connection);
          $db->rollbackAndClose();
          die("false||Ocorreu um erro ao adicionar a faq.");
        }

      }

      echo "true||Operação realizada com sucesso.";
      $action = "[ADD FAQ] - Success adding faq";
      funCreateLog($action, $connection);
      $db->commitAndClose();
    
    } else {
      $action = "[ADD FAQ] - Failed";
      funCreateLog($action, $connection);
      $db->rollbackAndClose();
      die("false||Ocorreu um erro ao adicionar a faq.");
    }



  }else{
    $action = "[ADD FAQ] - Failed";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Ocorreu um erro ao adicionar a faq.");
  }
}

function funGetFaqFormByCountry() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $allInfo = "";
  $listNavBar = "";
  $listFormBar = "";

  $idCountry = $_REQUEST['idC'];

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
      $viArrayValues['langMin'] = $row['langMin'];
      $viArrayValues['answer'] = "";
      $viArrayValues['question'] = "";
      $viArrayValues['flag'] = $flag;
      $listFormBar .= funCreateFaqItem($viArrayValues);
    }
    $allInfo .= '<ul id="navBar" class="nav nav-tabs">';
    $allInfo .= $listNavBar;
    $allInfo .= '</ul>';
    $allInfo .= '<div id="tabContent" class="tab-content">';
    $allInfo .= $listFormBar;
    $allInfo .= '</div>';
  }

  echo "true||$allInfo";

}

function funCreateFaqItem($vfArrayValues) {
  if($vfArrayValues['flag'] == "true"){$active="active";}else{$active="";}
  $vfLangMin = $vfArrayValues['langMin'];
  $vfCountry = $vfArrayValues['country'];
  $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Question</label>';
  $value .= '			<textarea id="question_'.$vfCountry.'_'.$vfLangMin.'" name="question_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['question'].'</textarea>';
  $value .= '		</div>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Answer</label>';
  $value .= '			<textarea id="answer_'.$vfCountry.'_'.$vfLangMin.'" name="answer_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['answer'].'</textarea>';
  $value .= '		</div>';
  $value .= '</div>';
  return $value;
}

function funGetFaqTagCountryId() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $tagId = $_REQUEST['id'];

  $sql = "SELECT 
    tb_faqs_tag.idTbCountry
  FROM tb_faqs_tag
  WHERE tb_faqs_tag.id=$tagId";

  $countryId = null;
  $result = $connection->query($sql);
  if($result) {
    while($row = mysqli_fetch_assoc($result)){ 
      $countryId = $row['idTbCountry'];
    }
  }

  if($countryId !== null) {
    echo "true||$countryId";
  } else {
    echo "false||There was a problem retriving the country id";
  }


}

function funInitTagsAndCountries() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $sql = "SELECT 
    tb_faqs_tag.tag,
    tb_faqs_tag.id
  FROM tb_faqs_tag
  WHERE tb_faqs_tag.status <> 0";

  $tags = "<option value=''>Select an option</option>";
  $result = $connection->query($sql);
  if($result) {
    while($row = mysqli_fetch_assoc($result)){ 
      $tags .= "<option value='".$row['id']."'>".$row['tag']."</option>";
    }
  }
  
  $sql = "SELECT
    tb_country.country,
    tb_country.id
  FROM tb_country
  WHERE tb_country.status <> 0";

  $countries = "<option value=''>Select an option</option>";
  $result = $connection->query($sql);
  if($result) {
    while($row = mysqli_fetch_assoc($result)){ 
      $countries .= "<option value='".$row['id']."'>".$row['country']."</option>";
    }
  }

  echo "true||$tags||$countries";

}

function funEditFaqTag() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $idCountry = $_REQUEST['idCountry'];
  $idTag = $_REQUEST['idTag'];
  $tag = $_REQUEST['tag'];

  $sql = "UPDATE tb_faqs_tag SET tb_faqs_tag.tag='$tag' WHERE tb_faqs_tag.id=$idTag";
  $result = $connection->query($sql);
  if ($result) {
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


    $result2 = $connection->query($sqlCmd);
    if ($result2) {
      while($row = mysqli_fetch_assoc($result2)){ 
        $title = $_REQUEST['title_'.$row['abbCountry'].'_'.$row['langMin']];

        $sql3 = "UPDATE tb_faqs_tag_translation SET tb_faqs_tag_translation.title='$title' 
        WHERE idTbFaqTag=$idTag
        AND idTbLanguage=".$row['id']."
        AND idTbCountry=$idCountry";

        $result3 = $connection->query($sql3);
        if (!$result3) {
          $action = "[UPDATE_FAQ_TAG] - Error updating #" .$idTag;
          funCreateLog($action, $connection);
          $db->rollbackAndClose();
          echo "false||Oopss... Aconteceu um erro ao tentar eliminar.";
          exit(0);
        }

      }
    }
  }

  $db->commitAndClose();
  echo "true||Operação realizada com sucesso.";

}

function funGetFaqTagText() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $idTag = $_REQUEST['id'];
  $sql = "SELECT tb_faqs_tag.tag FROM tb_faqs_tag WHERE tb_faqs_tag.id=$idTag";

  $result = $connection->query($sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
  }
  echo "true||".$row['tag'];
}

function funEditFaqTranslationItem() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $listFormBar = "";
  $listNavBar = "";
  $allInfo = "";

  $idTag = $_REQUEST['id'];
  $idCountry = $_REQUEST['idC'];

  //var_dump($_REQUEST);
  //exit(0);

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

  //var_dump($sqlCmd);


  if ($result) {
    while($row = mysqli_fetch_assoc($result)){
      if($listNavBar == ""){
        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
      }else{
        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['langMin'].'</a></li>';
      }

      if($listFormBar != ""){$flag=false;}else{$flag=true;}
      $viArrayValues['country'] = $row['abbCountry'];
      $viArrayValues['langMin'] = $row['langMin'];

      $sql2 = "SELECT tb_faqs_tag_translation.title
      FROM tb_faqs_tag_translation 
      WHERE tb_faqs_tag_translation.idTbFaqTag=$idTag
      AND tb_faqs_tag_translation.idTbCountry=$idCountry
      AND tb_faqs_tag_translation.idTbLanguage=".$row['id'];

      $result2 = $connection->query($sql2);
      if ($result2) { 
        $row2 = mysqli_fetch_assoc($result2);
        $viArrayValues['title'] = $row2['title'];
      } else {
        $viArrayValues['title'] = "";
      }

      $viArrayValues['flag'] = $flag;
      $listFormBar .= funCreateTagTitleFaqItem($viArrayValues);
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
  echo "true||".$allInfo;
}

function funDeleteFaqTag() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $idTag = $_REQUEST['id'];

  $sqlCmd = "UPDATE tb_faqs_tag_translation SET status = 0 WHERE tb_faqs_tag_translation.idTbFaqTag=$idTag";
  $result = $connection->query($sqlCmd);
  if ($result) {
    $sqlCmd2 = "UPDATE tb_faqs_tag SET status = 0 WHERE tb_faqs_tag.id=$idTag";
    $result2 = $connection->query($sqlCmd2);
    if ($result2) {
      $action = "[DELETE_FAQ_TAG] - Sucess deleting #" .$idTag;
      funCreateLog($action, $connection);
      $db->commitAndClose();
      echo "true||Operação realizada com sucesso.";
    } else {
      $action = "[DELETE_FAQ_TAG] - Error deleting #" .$idTag;
      funCreateLog($action, $connection);
      $db->rollbackAndClose();
      echo "false||Oopss... Aconteceu um erro ao tentar eliminar.";
    }
  } else {
    $action = "[DELETE_FAQ_TAG] - Error deleting #" .$idTag;
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    echo "false||Oopss... Aconteceu um erro ao tentar eliminar.";
  }
}

function funGetFaqTags() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();

  $sql = "SELECT
    tb_faqs_tag.id,
    tb_faqs_tag.tag,
    tb_faqs_tag.idTbCountry as idCountry,
    tb_country.abbCountry
  FROM tb_faqs_tag
  JOIN tb_country ON tb_faqs_tag.idTbCountry = tb_country.id
  WHERE tb_faqs_tag.status <> 0
  ";

  $tags = [];
  $result = $connection->query($sql);
  if ($result) {
    while($row = mysqli_fetch_assoc($result)){ 
      $urlToEdit = "location.href='faqs-tag-editar.php?id=".$row['id']."&idC=".$row['idCountry']."'";
      $urlToDelete = "funDeleteItem(".$row['id'].")";
      $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
      $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
      
      $data = array($row['id'], $row['tag'], $row['abbCountry'], $values);
      array_push($tags, $data);
    }
  }

  echo json_encode($tags);

}

function funCreateTagTitleFaqItem($vfArrayValues){
  if($vfArrayValues['flag'] == "true"){$active="active";}else{$active="";}
  $vfLangMin = $vfArrayValues['langMin'];
  $vfCountry = $vfArrayValues['country'];
  $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Título</label>';
  $value .= '			<textarea id="title" name="title_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['title'].'</textarea>';
  $value .= '		</div>';
  $value .= '</div>';
  return $value;
}

function funGetFaqTranslationItem() {
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $listFormBar = "";
  $listNavBar = "";
  $allInfo = "";

  $idCountry = $_REQUEST['idC'];


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
      $viArrayValues['langMin'] = $row['langMin'];
      $viArrayValues['title'] = "";
      $viArrayValues['flag'] = $flag;
      $listFormBar .= funCreateTagTitleFaqItem($viArrayValues);
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
  echo "true||".$allInfo;
}

function funGetCountries() {
  echo "true||".funGetCountryAll("",true);
}

function funInitFaq() {
  echo "true||".funGetCountryAll("",true)."||".funGetTagFaq("",true);
}

function funAddFAQTag(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
    $viDateC = "'" . date("Y-m-d H:i:s") . "'";
    //var_dump($_REQUEST);
    $tag = $_REQUEST['tag'];
    $idCountry = $_REQUEST['country'];
    //echo "true||$tag||$country";
    //exit(0);
    if($tag != "" && $idCountry != ""){
    	$sqlCmd = "INSERT INTO tb_faqs_tag (dateO, userO, tag, status, idTbCountry) VALUES";
    	$sqlCmd .= "($viDateC,$usr_id,'$tag',1,$idCountry)";
    	$result = $connection->query($sqlCmd);
    	if ($result) {
        $idTag = $connection->insert_id;
          

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

            $idLang = $row['id'];
            $langMin = $row['langMin'];
            $abbCountry = $row['abbCountry'];

            $title = $_REQUEST['title_'.$abbCountry.'_'.$langMin];

            $sql = "INSERT INTO tb_faqs_tag_translation (title, status, idTbLanguage, idTbFaqTag, idTbCountry)";
            $sql .= " VALUES ('$title', 1, $idLang, $idTag, $idCountry)";

            //var_dump($sql);
            $result2 = $connection->query($sql);
    	      if (!$result2) { 
              $action = "[ADD_TAG] - sql failed";
              funCreateLog($action, $connection);
              $db->rollbackAndClose();
              die("false||Oppsss... ocorreu um erro ao inserir.");
            }

          }
        
        }
        $action = "[ADD_TAG] - Sucess added #" .$idTag;
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo "true||Operação realizada com sucesso.";
    	}else{
    		$action = "[ADD_TAG] - sql failed";
    		funCreateLog($action, $connection);
    		$db->rollbackAndClose();
    		die("false||Oppsss... ocorreu um erro ao inserir.");
    	}
    }else{
    $action = "[ADD_TAG] - Failed values came empty";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Oppsss...alguns valores estão vazios.");
    }
}

function funCreateTitleFaqItem($vfArrayValues){
  if($vfArrayValues['flag'] == "true"){$active="active";}else{$active="";}
  $vfLangMin = $vfArrayValues['langMin'];
  $vfCountry = $vfArrayValues['country'];
  $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLangMin.'"> <br>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Question</label>';
  $value .= '			<textarea id="question" name="question_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['question'].'</textarea>';
  $value .= '		</div>';
  $value .= '		<div class="form-group">';
  $value .= '			<label>Answer</label>';
  $value .= '			<textarea id="answer" name="answer_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" required>'.$vfArrayValues['answer'].'</textarea>';
  $value .= '		</div>';
  $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfCountry.'_'.$vfLangMin.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
  $value .= '</div>';
  return $value;
}

function funGetCountryLang(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $listFormBar = "";
  $listNavBar = "";
  $allInfo = "";

  $idCountry = $_REQUEST['idC'];


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
      $viArrayValues['langMin'] = $row['langMin'];
      $viArrayValues['question'] = "";
      $viArrayValues['answer'] = "";
      $viArrayValues['idTrans'] = "";
      $viArrayValues['flag'] = $flag;
      $listFormBar .= funCreateTitleFaqItem($viArrayValues);
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

/*function funAddFaq(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $viDateC = "'" . date("Y-m-d H:i:s") . "'";
  $inserted = false;

  $idCountry=$_REQUEST['country'];
  $idTitle = funTreatString($_REQUEST['title']);
  $idImage = $_REQUEST['og_img'];
  $idTag = $_REQUEST['tag'];

  $select = "SELECT * from tb_faqs WHERE idTbTranslationCode=$idTitle AND status=1";
  if($resultCount = $connection->query($select)){
    $row = mysqli_fetch_assoc($resultCount);
    $num_rows = $resultCount->num_rows;
    if($num_rows > 0){
      $idFaq = $row['id'];
      if($idImage != ""){
        $sqlUpFaq = "UPDATE tb_faqs SET dateO = $viDateC, userO=$usr_id, idTbGallery=$idImage WHERE id=$idFaq";
        if(!$resultUpFaq = $connection->query($sqlUpFaq)){
          $action = "[ADD TITLE] - Failing Update Gallery";
          funCreateLog($action, $connection);
          $db->rollbackAndClose();
          die("false||Ocorreu um erro ao atualizar a galeria.");
        }
      }
    }else{
      $sqlAddFaq = "INSERT INTO tb_faqs (dateO, userO, status, idTbTranslationCode, idTbGallery, idTbCountry, idTbFaqsTag)";
      $sqlAddFaq.= " VALUES ($viDateC, $usr_id, 1, $idTitle, $idImage, $idCountry, $idTag)";

      if($result = $connection->query($sqlAddFaq)){
        $idFaq = $connection->insert_id;
      }else{
        $action = "[ADD TITLE] - Failed adding media";
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die("false||Ocorreu um erro ao adicionar a faq.");
      }
    }
  }

  $sqlCmd1 = "INSERT INTO tb_faqs_details (dateO, userO, idTbFaq) VALUES ($viDateC, $usr_id, $idFaq)";
  if($result1 = $connection->query($sqlCmd1)){

    $idTbFaqDetails = $connection->insert_id;
  }else{
    $action = "[ADD TITLE] - Failed Faq Details";
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    die("false||Ocorreu um erro ao adicionar a faq.");
  }


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
             tb_country.id=".$idCountry;

    if ($result = $connection->query($sqlCmd)){
      while($row = mysqli_fetch_assoc($result)){
          $idLang=$row['id'];
          $answer= funTreatString($_REQUEST['answer_'.$row['abbCountry'].'_'.$row['langMin']]);
          $question = funTreatString($_REQUEST['question_'.$row['abbCountry'].'_'.$row['langMin']]);

          $sqlAddFaqAnswer = "INSERT INTO tb_faqs_details_trans (dateO, userO, question, answer, idTbLanguage, idTbCountry, idTbFaqDetails)";
          $sqlAddFaqAnswer.= " VALUES ($viDateC, $usr_id, '$question', '$answer', $idLang, $idCountry, $idTbFaqDetails)";

          $result1 = $connection->query($sqlAddFaqAnswer);
          if(!$result1){
            $inserted = false;
            $action = "[ADD FAQ] - Failed add  faq TRANSLATIONS";
						funCreateLog($action, $connection);
						$db->rollbackAndClose();
						die("false||Ocorreu um problema ao inserir faq #0002");
          } else {
            $inserted = true;
          }
      }
      if($inserted){
        echo "true||Operação realizada com sucesso.";
        $action = "[ADD FAQ] - Success adding faq";
        funCreateLog($action, $connection);
        $db->commitAndClose();
      }
    }else{
      $action = "[ADD TITLE] - Failed getting language";
      funCreateLog($action, $connection);
      $db->rollbackAndClose();
      die("false||Ocorreu um erro ao adicionar a faq.");
    }


}*/

function funGetFaqs(){
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $sqlCmd = "SELECT
              tb_faqs.id,
              tb_faqs.idTbGallery as idGallery,
              tb_faqs_tag.id as idTag,
              tb_faqs_tag.tag,
              tb_faqs.idTbCountry as idCountry,
              tb_country.country,
              tb_faqs_translation.question
             FROM
              tb_faqs
             JOIN tb_country ON tb_faqs.idTbCountry = tb_country.id
             JOIN tb_faqs_tag ON tb_faqs_tag.id = tb_faqs.idTbFaqsTag
             JOIN tb_faqs_translation ON tb_faqs_translation.idTbFaq = tb_faqs.id 
             WHERE tb_faqs.status=1
             AND tb_faqs_translation.idTbLanguage = 1";

  $values = "";
  //var_dump($sqlCmd);
  //exit(0);
  if ($result = $connection->query($sqlCmd)) {
    $arrayMain = [];
    while($rsData = mysqli_fetch_assoc($result)){
        $urlToEdit = "location.href='faqs-editar.php?id=".$rsData['id']."&idC=".$rsData['idCountry']."&idT=".$rsData['idTag']."'";
        $urlToDelete = "funDeleteItem(".$rsData['id'].")";
        $values =	'<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
        $values .=	'<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
        array_push($arrayMain,[$rsData['id'], $rsData['tag'],$rsData['country'],$rsData['question'],$values]);
    }
  }

  echo json_encode($arrayMain);
  $db->closeConnection();
}

function funDeleteFaq(){
  include_once('session.php');
  include_once('utils.php');
  include_once(PATH_DATABASE_INC);
  $db = Database::getInstance();
  $connection = $db->getConnection();
  $id = $_REQUEST['id'];

  $sqlCmd = "UPDATE tb_faqs SET status = 0 WHERE id='$id'";
  $result = $connection->query($sqlCmd);
  if ($result) {
    $action = "[DELETE_FAQ] - Sucess deleting #" .$id;
    funCreateLog($action, $connection);
    $db->commitAndClose();
    echo "true||Operação realizada com sucesso.";
  }else{
    $action = "[DELETE_FAQ] - Error deleting #" .$id;
    funCreateLog($action, $connection);
    $db->rollbackAndClose();
    echo "false||Oopss... Aconteceu um erro ao tentar eliminar.";
  }
}


