<?php
    function funCreateLog($vfAction, $connection)
    {
        if ($connection != '') {
            include_once '../../includes/globalVars.php';
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
        }
        $userID = $_COOKIE['usr_id'];
        $viDateC = "'".date('Y-m-d H:i:s')."'";
        $sqlCmd = "INSERT INTO tb_logs (dateC,dateU,action,deleted,idtbUsers) VALUES ($viDateC,$viDateC,'$vfAction',0,'$userID')";
        $result = $connection->query($sqlCmd);
        $connection->commit();
    }

    function funCompressImage($source_url, $destination_url, $quality)
    {
        ini_set('memory_limit', '300M');
        $info = getimagesize($source_url);
        $resp = false;
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source_url);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source_url);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source_url);
            imagealphablending($image, true); // setting alpha blending on
            imagesavealpha($image, true);
        }
        if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/gif') {
            $resp = imagejpeg($image, $destination_url, $quality);
        } elseif ($info['mime']) {
            //$resp = move_uploaded_file($source_url, $destination_url);
            $quality = $quality / 10;
            $resp = imagepng($image, $destination_url, $quality);
        }
        imagedestroy($image);

        return $resp;
    }
    /**
     *Esta função serve para transformar as imagens cortadas que estão em
     *base64 para jpgeg.
     **/
    function base64_to_jpeg($base64_string, $output_file)
    {
        $ifp = fopen($output_file, 'wb');

        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }

    /**
     *Esta função serve para detectar se o texto esta em utf-8 ou se precisa de
     *descodificar para não aparecerem caracteres estranhos.
     **/
    function funCheckUTF8($vfValue)
    {
        if (preg_match('!!u', $vfValue)) {
            // this is utf-8
            $valToReturn = $vfValue;
        } else {
            $valToReturn = utf8_decode($vfValue);
        }

        return $valToReturn;
    }

    /**
     * Esta função serve para trocar os acentos e cedilhas para criar um url
     * amigo.
     **/
    function funCleanString($vfTextToConvert)
    {
        $utf8 = array(
          '/[áàâãªä]/u' => 'a',
          '/[ÁÀÂÃÄ]/u' => 'A',
          '/[ÍÌÎÏ]/u' => 'I',
          '/[íìîï]/u' => 'i',
          '/[éèêë]/u' => 'e',
          '/[ÉÈÊË]/u' => 'E',
          '/[óòôõºö]/u' => 'o',
          '/[ÓÒÔÕÖ]/u' => 'O',
          '/[úùûü]/u' => 'u',
          '/[ÚÙÛÜ]/u' => 'U',
          '/ç/' => 'c',
          '/Ç/' => 'C',
          '/ñ/' => 'n',
          '/Ñ/' => 'N',
          '/–/' => '-', // UTF-8 hyphen to "normal" hyphen
          '/[’‘‹›‚]/u' => ' ', // Literally a single quote
          '/[“”«»„]/u' => ' ', // Double quote
          '/ /' => ' ', // nonbreaking space (equiv. to 0x160)
          '/[!?-]/u' => '',
      );

        return preg_replace(array_keys($utf8), array_values($utf8), $vfTextToConvert);
    }
  function seo_friendly_url($string)
  {
      $string = str_replace(array('[\', \']'), '', $string);
      $string = preg_replace('/\[.*\]/U', '', $string);
      $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
      $string = htmlentities($string, ENT_COMPAT, 'utf-8');
      $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
      $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);

      return strtolower(trim($string, '-'));
  }

  function funTreatNameFile($vfTextToConvert)
  {
      $viText = seo_friendly_url($vfTextToConvert);

      return str_replace(' ', '-', $viText);
  }

  /**
   * Esta função serve para guardar as imagens com thumbnails.
   **/
  function funSaveImages($vfTypeFile, $vfFile, $vfTargeFolder, $vfTxtBase64, $targetBase64, $flag = false)
  {
      $viReturn = false;
      if (($vfTypeFile == 'image/gif') || ($vfTypeFile == 'image/jpeg') || ($vfTypeFile == 'image/png') || ($vfTypeFile == 'image/pjpeg')) {
//          $compressWasSucess = funCompressImage($vfFile, $vfTargeFolder, 80);
          $compressWasSucess = copy($vfFile, $vfTargeFolder); // 20190917 a pedido do Pedro Silva :: copiar fiheiro sem compressao
//          $compressWasSucess = "1";
          // echo $vfTargeFolder;
          if ($compressWasSucess) {
              $viReturn = true;
          } else {
              $viReturn = false;
          }
      } elseif (($vfTypeFile == 'image/svg+xml') || ($vfTypeFile == 'image/vnd.microsoft.icon')) {
          if (move_uploaded_file($vfFile, $vfTargeFolder)) {
              $viReturn = true;
          }
      } else {
          //FICHEIRO NAO E SUPORTADO
          $viReturn = false;
      }

      return $viReturn;
  }

  /**
   * Esta função serve para criar as sessões de erros.
   **/
  function funCreateSessionsError($vfTitle, $vfDescription, $vfTypeError)
  {
      include_once 'session.php';
      $_SESSION['title'] = $vfTitle;
      $_SESSION['description'] = $vfDescription;
      $_SESSION['typeError'] = $vfTypeError;
  }

    /**
     * Esta função e geral a todos os locais que necessitem de guardar imagens.
     **/
    function funInsertIntoPdf($vfPath, $vfToken, $viDateO, $idTbLanguage, $vfConnection, $vfUsrID)
    {
        $sqlCmdInsertPdf = 'INSERT INTO tb_pdf(dateO, userO, status, tb_pdf.path, token,dateCri,idTbLanguage) VALUES ';
        $sqlCmdInsertPdf .= "($viDateO, $vfUsrID,'0','$vfPath','$vfToken',$viDateO,$idTbLanguage)";
        // echo "pdf sql = ".$sqlCmdInsertPdf ."<br>";
        if ($result = $vfConnection->query($sqlCmdInsertPdf)) {
            $viIdPdf = $vfConnection->insert_id;
        } else {
            $viIdPdf = 'NULL';
        }

        return $viIdPdf;
    }

  function funInsertIntoGallery($vfPath, $vfExtension, $vfConnection, $vfUsrID)
  {
      $viDateC = "'".date('Y-m-d H:i:s')."'";
      $sqlCmdInsertGallery = 'INSERT INTO tb_gallery(dateC, userC, dateU, userU, tb_gallery.path, extension, deleted) VALUES ';
      $sqlCmdInsertGallery .= "($viDateC, $vfUsrID, $viDateC, $vfUsrID,'$vfPath','$vfExtension',0)";
      // echo $sqlCmdInsertGallery;
      if ($result = $vfConnection->query($sqlCmdInsertGallery)) {
          $viIdGallery = $vfConnection->insert_id;
      } else {
          $viIdGallery = 'NULL';
      }

      return $viIdGallery;
  }

  /**
   * Esta função é para apagar todas as imagens que tenham sido inseridas.
   **/
  function funDeleteImage($vfPath)
  {
      unlink('../../'.$vfPath);
  }

  /**
   * Esta função é comum a todos os ficheiros que necessitem de adicionar dados
   * na tabela seo
   * Retorna o ID seo.
   **/
  function funInsertIntoSeo($vfKeyWord, $vfTitle, $vfDescription, $vfConnection, $vfUsrID, $vfIdLang)
  {
      $viDateC = "'".date('Y-m-d H:i:s')."'";
      $sqlCmdSeo = 'INSERT INTO tb_seo(dateC, userC, dateU, userU, seo_title, seo_description, seo_keywords, deleted, idTbLanguage) VALUES ';
      $sqlCmdSeo .= "($viDateC, $vfUsrID, $viDateC, $vfUsrID, '$vfTitle','$vfDescription','$vfKeyWord',0,$vfIdLang)";
      if ($vfConnection->query($sqlCmdSeo)) {
          $viIdSeo = $vfConnection->insert_id;
      } else {
          $viIdSeo = 'NULL';
      }

      return $viIdSeo;
  }

  /**
   * Esta função serve para criar as tabs de seo.
   **/
  function funCreateSeo($vfLang, $vfKeywords, $vfDescriptionSeo, $vfIdSeo, $vfTitle = '')
  {
      $seo = '';
      $seo .= '	<div class="form-group">';
      $seo .= '		<p><h2>SEO</h2></p>';
      $seo .= '	</div>';
      $seo .= '	<div class="form-group">';
      $seo .= '		<label>Titulo</label><input class="form-control" name="titleSeo_'.$vfLang.'" value="'.$vfTitle.'">';
      $seo .= '	</div>';
      $seo .= '	<div class="form-group">';
      $seo .= '		<label>Keywords</label><br><input class="form-control" name="keywords_'.$vfLang.'" value="'.$vfKeywords.'" data-role="tagsinput">';
      $seo .= '	</div>';
      $seo .= '	<div class="form-group">';
      $seo .= '		<label>Descrição Página</label>';
      $seo .= '		<textarea id="descSeo_'.$vfLang.'" name="descSeo_'.$vfLang.'" class="form-control">'.$vfDescriptionSeo.'</textarea>';
      $seo .= '	</div>';
      $seo .= '	<input type="hidden" name="idSeo_'.$vfLang.'" value="'.$vfIdSeo.'">';

      return $seo;
  }

/**
 *Esta função é comum a todos os ficheiros que necessitem de editar dados
 *na tabela seo
 * Retorna @boolean da operação.
 **/
function funEditSeo($vfKeyWord, $vfTitle, $vfDescription, $vfConnection, $vfUsrID, $vfIdSeo)
{
    $viDateU = "'".date('Y-m-d H:i:s')."'";
    $sqlCmdSeo = 'UPDATE tb_seo SET dateU='.$viDateU.', userU='.$vfUsrID.", seo_title='".$vfTitle."',";
    $sqlCmdSeo .= " seo_description='".$vfDescription."', seo_keywords='".$vfKeyWord."' WHERE id =".$vfIdSeo;

    return $vfConnection->query($sqlCmdSeo);
}

function funTreatString($vfString)
{
    $pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/"; // use this pattern to remove any empty tag
    $vfString = preg_replace($pattern, '', $vfString);
    //$vfString = htmlspecialchars_decode($vfString);
    return addslashes($vfString);
}

// This function converts square meters to square feets
function funConverteMToFt($meters)
{
    $ft_per_meter = 10.7639;
    $decimalPlaces = 2;
    $feet = round($meters * $ft_per_meter, $decimalPlaces);

    echo $feet;
}

function funMoveFiles($vfFile, $vfTargeFolder)
{
    $viReturn = false;
    if (move_uploaded_file($vfFile, $vfTargeFolder)) {
        $viReturn = true;
    }

    return $viReturn;
}

function funGetImageYoutube($vfPath)
{
    $img = 'https://img.youtube.com/vi/'.$vfPath.'/maxresdefault.jpg';

    return $img;
}

function funGetCountryAll($vfIdCountry = '', $isToReturn = false)
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

function funGetTagPackage($vfIdTag = '', $isToReturn = false)
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = 'SELECT * FROM tb_packages_tag';
    $option = "<option value=''>Select an option</option>";
    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $tag = $row['tag'];
            if ($vfIdTag == $id) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $option .= "<option value='$id' $select>$tag</option>";
        }
    }
    if ($isToReturn) {
        return $option;
    } else {
        echo 'true||'.$option;
    }
}

function funGetTagMenu($vfIdTag = '', $isToReturn = false)
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = 'SELECT * FROM tb_menus_tag';
    $option = "<option value=''>Select an option</option>";
    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $tag = $row['tag'];
            if ($vfIdTag == $id) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $option .= "<option value='$id' $select>$tag</option>";
        }
    }
    if ($isToReturn) {
        return $option;
    } else {
        echo 'true||'.$option;
    }
}

function funGetTagFeature($vfIdTag = '', $isToReturn = false)
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = 'SELECT * FROM tb_advantage_tag';
    $option = "<option value=''>Select an option</option>";
    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $tag = $row['tag'];
            if ($vfIdTag == $id) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $option .= "<option value='$id' $select>$tag</option>";
        }
    }
    if ($isToReturn) {
        return $option;
    } else {
        echo 'true||'.$option;
    }
}

function funCanDoUpload($fileTarget)
{
    while (file_exists('../../'.$fileTarget)) {
        $fileTargetArray = explode('.', $fileTarget);
        $fileTarget = $fileTargetArray[0].'_'.rand().'.'.$fileTargetArray[1];
    }

    return $fileTarget;
}

function funUpdateRefOperation($cod, $vfStatus, $vfMsg, $vfConnection)
{
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    if ($vfStatus == '-1') {
        $cmd = 'INSERT INTO tb_actionslog(dateC, code, message, status) VALUES ';
        $cmd .= "($viDateC,'$cod','$vfMsg',$vfStatus)";
    } else {
        $cmd = "UPDATE tb_actionslog SET status='$vfStatus', message='$vfMsg' WHERE code='$cod'";
    }
    echo $cmd.'<br>';

    return $vfConnection->query($cmd);
}
