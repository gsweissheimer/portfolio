<?php
    include_once '../../includes/globalVars.php';
    $cmdEval = $_REQUEST['cmdEval'];
    switch ($cmdEval) {
        case 'editTranslation':
            if ($_REQUEST['bot'] == '') {
                funEditTranslation();
            } else {
                die();
            }
            break;
        case 'editAbout':
            if ($_REQUEST['bot'] == '') {
                funEditAbout();
            } else {
                die();
            }
            break;
        case 'editTerms':
            if ($_REQUEST['bot'] == '') {
                funEditTerms();
            } else {
                die();
            }
            break;
        case 'editVideo':
            if ($_REQUEST['bot'] == '') {
                funEditVideo();
            } else {
                die();
            }
            break;
        case 'editAdvantage':
            if ($_REQUEST['bot'] == '') {
                funEditAdvantage();
            } else {
                die();
            }
            break;
        case 'EditClinic':
            if ($_REQUEST['bot'] == '') {
                funEditClinic();
            } else {
                die();
            }
            break;
        case 'editTitleFaq':
            if ($_REQUEST['bot'] == '') {
                funEditTitleFaq();
            } else {
                die();
            }
            break;
        case 'editEvent':
            if ($_REQUEST['bot'] == '') {
                funEditEvent();
            } else {
                die();
            }
            break;
        case 'editNameModel':
            if ($_REQUEST['bot'] == '') {
                funEditNameModel();
            } else {
                die();
            }
            break;
        case 'editSpec':
            if ($_REQUEST['bot'] == '') {
                funEditSpec();
            } else {
                die();
            }
            break;
        case 'editPopup':
            if ($_REQUEST['bot'] == '') {
                funEditPopUp();
            } else {
                die();
            }
            break;
        default:
            // code...
            break;
    }

    function funEditPopUp()
    {
        //file_put_contents('./log_'.date("j.n.Y").'.txt', "Im in line 57", FILE_APPEND);
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $viDateC = date('Y-m-d H:i:s');
        $flagUpload = false;

        $popupID = $_REQUEST['IDPOPUP'];
        $popupname = $_REQUEST['popupname'];
        $formid = $_REQUEST['formid'];
        $formname = $_REQUEST['formname'];

        $popupstartdate = $_REQUEST['popupstartdate'];
        $popupenddate = $_REQUEST['popupenddate'];
        $Backup_Form = $_REQUEST['favcolor'];
        //file_put_contents('./log_'.date("j.n.Y").'.txt', $popupID."\r\n".$popupname."\r\n".$formid."\r\n".$formname."\r\n".$popupstartdate."\r\n".$popupenddate."\r\n".$Backup_Form."\r\n", FILE_APPEND);
        if (isset($_REQUEST['istransparet'])) {
            $Backup_Form = 'none';
        }
        $Backup_Image = '';
        $Backup_Model = '';

        $ImageToUpdate = '';
        $ImageToDelete = 0;
        if (isset($_FILES['backup_image']) && !empty($_FILES['backup_image']['name']) && $_FILES['backup_image']['error'] != UPLOAD_ERR_NO_FILE) {
            //$Backup_Image=$_FILES["backup_image"]["name"];
            $target_dir = PATH_POPUP_IMG;
            $imageFileTypeMain = pathinfo(basename($_FILES['backup_image']['name']), PATHINFO_EXTENSION);
            $newTitle = 'c'.date('Y_m_d_H_i_s');
            $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
            $fileTypeOriginal = $_FILES['backup_image']['type'];
            $Backup_Image = $newTitle.'.'.$imageFileTypeMain;
            $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['backup_image']['tmp_name'], $target_file, '', '');
            $flagBackup_Image = true;
            $ImageToUpdate .= ",back_up='$Backup_Image'";
            $ImageToDelete = 1;
        } else {
            $flagBackup_Image = false;
        }

        if (isset($_FILES['Backup_Model']) && !empty($_FILES['Backup_Model']['name']) && $_FILES['Backup_Model']['error'] != UPLOAD_ERR_NO_FILE) {
            //$Backup_Model=$_FILES["Backup_Model"]["name"];
            $target_dir = PATH_POPUP_IMG;
            $imageFileTypeMain = pathinfo(basename($_FILES['Backup_Model']['name']), PATHINFO_EXTENSION);
            $newTitle = 'b'.date('Y_m_d_H_i_s');
            $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
            $fileTypeOriginal = $_FILES['Backup_Model']['type'];
            $Backup_Model = $newTitle.'.'.$imageFileTypeMain;
            $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['Backup_Model']['tmp_name'], $target_file, '', '');
            $flagBackup_Model = true;
            $ImageToUpdate .= ",back_modal='$Backup_Model'";
            $ImageToDelete = 2;
        } else {
            $flagBackup_Model = false;
        }

        try {
            $db = Database::getInstance();
            $connection = $db->getConnection();

            $sqlCmd0 = "SELECT back_up,back_modal FROM tb_popup_customise WHERE id=$popupID";
            $result0 = $connection->query($sqlCmd0);
            $row0 = mysqli_fetch_assoc($result0);
            $Old_back_up_file = PATH_POPUP_IMG.$row0['back_up'];
            $Old_back_modal_file = PATH_POPUP_IMG.$row0['back_modal'];

            $sqlCmd = "UPDATE tb_popup_customise
								SET popup_name='$popupname',
									dateC='$viDateC',
									id_form='$formid',
									back_form='$Backup_Form',
									name_form='$formname'".$ImageToUpdate."
			 						,_start_date='$popupstartdate',
									finish_date='$popupenddate',
									_status=1
								WHERE
									id=$popupID";
            $result = $connection->query($sqlCmd);
            if ($result) {
                if ($ImageToDelete == 2) {
                    try {
                        funDeleteImage($Old_back_up_file);
                        funDeleteImage($Old_back_modal_file);
                    } catch (Throwable $t) {
                        echo 'Error in deleting old files...';
                    }
                } elseif ($ImageToDelete == 1) {
                    try {
                        funDeleteImage($Old_back_up_file);
                    } catch (Throwable $t) {
                        echo 'Error in deleting old file...';
                    }
                }
                ////////////////////////////////////////////////////////////////////
                $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                if ($result = $connection->query($sqlCmd)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $langMin = $row['langMin'];
                        $viIdLang = $row['id'];
                        if ($_REQUEST['title_top_'.$langMin]) {
                            $popuptitle_top = $_REQUEST['title_top_'.$langMin];
                        } else {
                            $popuptitle_top = '';
                        }
                        if ($_REQUEST['title_modal_'.$langMin]) {
                            $popuptitle_modal = $_REQUEST['title_modal_'.$langMin];
                        } else {
                            $popuptitle_modal = '';
                        }
                        if ($_REQUEST['subtitle_modal_'.$langMin]) {
                            $subtitle_modal = $_REQUEST['subtitle_modal_'.$langMin];
                        } else {
                            $subtitle_modal = '';
                        }

                        $popuptitle_top = funTreatString($popuptitle_top);
                        $popuptitle_modal = funTreatString($popuptitle_modal);
                        $subtitle_modal = funTreatString($subtitle_modal);

                        $sqlCmd1 = "UPDATE tb_popup_translation SET  title_top = '$popuptitle_top',title_modal='$popuptitle_modal',subtitle_modal = '$subtitle_modal'";
                        $sqlCmd1 .= " WHERE idTbpopup=$popupID and idTblanguage=$viIdLang";
                        //file_put_contents('./log_'.date('j.n.Y').'.txt', $sqlCmd1."\r\n", FILE_APPEND);
                        $result1 = $connection->query($sqlCmd1);
                        if (!$result1) {
                            $action = '[ADD_SLIDE] - Failed add  TRANSLATIONs - '.$sqlCmd1;
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Ocorreu um problema ao inserir tradução');
                        }
                    }
                }
                ////////////////////////////////////////////////////////////////////
                $db->commitAndClose();
                echo 'true||Operação realizada com sucesso.';
            } else {
                $db->rollbackAndClose();
                die('false||Oppsss... ocorreu um erro ao inserir!!!.');
            }
        } catch (Throwable $t) {
            echo 'Error: '.$t;
        }
    }

    function funEditTranslation()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $viDateC = "'".date('Y-m-d H:i:s')."'";
        $idCode = $_REQUEST['idCodeTrans'];
        $trans = $_REQUEST['codeTrans'];

        $sqlCmdInsertPre = "UPDATE tb_translations_codes SET dateU=$viDateC, userU=$usr_id, code='$trans' WHERE id= $idCode ";
        if ($resultPre = $connection->query($sqlCmdInsertPre)) {
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $langMin = $row['langMin'];
                    if ($_REQUEST['translation_'.$langMin]) {
                        $viValue = $_REQUEST['translation_'.$langMin];
                    } else {
                        $viValue = '';
                    }
                    if ($_REQUEST['idTrans_'.$langMin]) {
                        $idCodeTrans = $_REQUEST['idTrans_'.$langMin];
                    } else {
                        $idCodeTrans = '';
                    }
                    $viValue = funTreatString($viValue);
                    if ($idCodeTrans != '') {
                        $sqlCmd2 = "UPDATE tb_translations SET dateU=$viDateC, userU=$usr_id, value='$viValue' WHERE id= $idCodeTrans ";
                    } else {
                        //Ensure not repeated languages in same object
                        $update = "UPDATE tb_translations SET dateU=$viDateC, userU=$usr_id, deleted=1 ";
                        $update .= "WHERE idTbCodeTranslations=$idCode AND idTbLanguage = ".$row['id'];
                        $connection->query($update);
                        $sqlCmd2 = 'INSERT INTO tb_translations(dateC, userC, dateU, userU, value, deleted, idTbCodeTranslations, idTbLanguage) VALUES ';
                        $sqlCmd2 .= '('.$viDateC.','.$usr_id.', '.$viDateC.','.$usr_id.",'".$viValue."',0,";
                        $sqlCmd2 .= $idCode.','.$row['id'].')';
                    }
                    if (!$connection->query($sqlCmd2)) {
                        funDeleteImage($target_file);
                        $action = '[EDIT_TRANSLATION] - Failed add  [SQL] - '.$sqlCmd2;
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Oppsss... Não foi possivel adicionar traduções');
                    }
                }
                $action = '[EDIT_TRANSLATION] - Operation add success';
                funCreateLog($action, $connection);
                echo 'true||Operação realizada com sucesso.';
                $db->commitAndClose();
            }
        }
    }

        function funEditAbout()
        {
            include_once 'session.php';
            include_once 'utils.php';
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $viDateC = "'".date('Y-m-d H:i:s')."'";

            if (isset($_REQUEST['idAbout'])) {
                $viIdAbout = $_REQUEST['idAbout'];
            } else {
                $viIdAbout = 'NOK';
            }
            if ($viIdAbout != 'NOK') {
                if ($viIdAbout == '') {
                    $sqlCmdAbout = 'INSERT INTO tb_about(dateC, userC, dateU, userU, statusAbout, deleted, idTbTypePage) VALUES ';
                    $sqlCmdAbout .= "($viDateC,'$usr_id',$viDateC,$usr_id,0,0,NULL)";
                    if ($resultAbout = $connection->query($sqlCmdAbout)) {
                        $viIdAbout = $connection->insert_id;
                    } else {
                        $action = '[EDIT_ABOUT] - Problem insert about';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Oppss... Ocorreu um problema #3'.$sqlCmdAbout);
                    }
                }
                $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                if ($result = $connection->query($sqlCmd)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $viIdLang = $row['id'];
                        if (isset($_REQUEST['idTrans_'.$row['langMin']])) {
                            $viIDTrans = $_REQUEST['idTrans_'.$row['langMin']];
                        } else {
                            $viIDTrans = '';
                        }

                        if (isset($_REQUEST['desc_'.$row['langMin']])) {
                            $viDescription = $_REQUEST['desc_'.$row['langMin']];
                        } else {
                            $viDescription = '';
                        }
                        if (isset($_REQUEST['title_'.$row['langMin']])) {
                            $viTitle = $_REQUEST['title_'.$row['langMin']];
                        } else {
                            $viTitle = '';
                        }
                        //SEO INFO
                        if (isset($_REQUEST['titleSeo_'.$row['langMin']])) {
                            $viTitleSeo = $_REQUEST['titleSeo_'.$row['langMin']];
                        } else {
                            $viTitleSeo = $viTitle;
                        }
                        if (isset($_REQUEST['keywords_'.$row['langMin']])) {
                            $viKeywords = $_REQUEST['keywords_'.$row['langMin']];
                        } else {
                            $viKeywords = '';
                        }
                        if (isset($_REQUEST['descSeo_'.$row['langMin']])) {
                            $viDescSeo = $_REQUEST['descSeo_'.$row['langMin']];
                        } else {
                            $viDescSeo = '';
                        }
                        if (isset($_REQUEST['idSeo_'.$row['langMin']])) {
                            $viIdSeo = $_REQUEST['idSeo_'.$row['langMin']];
                        } else {
                            $viIdSeo = '';
                        }
                        $viDescription = funTreatString($viDescription);
                        $viTitle = funTreatString($viTitle);
                        $viDescSeo = funTreatString($viDescSeo);
                        if ($viIdSeo != '') {
                            if (!funEditSeo($viKeywords, $viTitleSeo, $viDescSeo, $connection, $usr_id, $viIdSeo)) {
                                $action = '[EDIT_ABOUT] - Problem editing seo';
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Opps...Falhou a actualizar o seo...');
                            }
                        } else {
                            $viIdSeo = funInsertIntoSeo($viKeywords, $viTitleSeo, $viDescSeo, $connection, $usr_id, $viIdLang);
                        }
                        if ($viIDTrans != '') {
                            $sqlCmdAbtTrans = "UPDATE tb_about_translation SET dateU=$viDateC,userU=$usr_id";
                            $sqlCmdAbtTrans .= ",title='$viTitle',description='$viDescription',idTbSeo= $viIdSeo WHERE ";
                            $sqlCmdAbtTrans .= "id= $viIDTrans";
                        } else {
                            $sqlCmdAbtTrans = 'INSERT INTO tb_about_translation(dateC, userC, dateU, userU, title,';
                            $sqlCmdAbtTrans .= " description, idTbLanguage, idTbAbout, idTbSeo) VALUES ( $viDateC,";
                            $sqlCmdAbtTrans .= "'$usr_id',$viDateC,'$usr_id','$viTitle','$viDescription',$viIdLang,";
                            $sqlCmdAbtTrans .= "$viIdAbout,$viIdSeo)";
                        }

                        if (!$resultAbout = $connection->query($sqlCmdAbtTrans)) {
                            $action = '[EDIT_ABOUT] - Problem insert about translations';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Oppss... Ocorreu um problema ao inserir as traduções #3');
                        }
                    }

                    $action = '[EDIT_ABOUT] - Operation edit with success';
                    funCreateLog($action, $connection);
                    $db->commitAndClose();
                    echo 'true||Operação realizada com sucesso.';
                }
            } else {
                $action = '[EDIT_ABOUT] - Operation failed. dont find about id';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Ops..Falhou a realizar a operação');
            }
        }

        function funEditTerms()
        {
            include_once 'session.php';
            include_once 'utils.php';
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $viDateO = "'".date('Y-m-d H:i:s')."'";
            $flagUpload = false;
            // $viIdGallery = "NULL";
            // $imageUploadMain = "";

            if ($_REQUEST['id']) {
                $idTerms = $_REQUEST['id'];
            } else {
                $idTerms = '';
            }
            if ($_REQUEST['pageType']) {
                $viPageId = $_REQUEST['pageType'];
            } else {
                $viPageId = '';
            }
            if (isset($_COOKIE['usr_id'])) {
                $usr_id = $_COOKIE['usr_id'];
            } else {
                $usr_id = '';
            }

            if ($idTerms != '' && $viPageId != '') {
                $sqlUpSlide = 'UPDATE tb_terms SET ';
                $sqlUpSlide .= "idTbTermsLocation = $viPageId WHERE id=$idTerms";
                // echo $sqlUpSlide;
                if ($resultSlide = $connection->query($sqlUpSlide)) {
                    $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                    if ($result = $connection->query($sqlCmd)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $langMin = $row['langMin'];
                            $viIdLang = $row['id'];
                            if ($_REQUEST['title_terms_'.$langMin]) {
                                $viTitleTerms = $_REQUEST['title_terms_'.$langMin];
                            } else {
                                $viTitleTerms = '';
                            }
                            if ($_REQUEST['text_terms_'.$langMin]) {
                                $viTextTerms = $_REQUEST['text_terms_'.$langMin];
                            } else {
                                $viTextTerms = '';
                            }
                            if ($_REQUEST['idTrans_'.$langMin]) {
                                $viIdTrans = $_REQUEST['idTrans_'.$langMin];
                            } else {
                                $viIdTrans = '';
                            }
                            if ($viTitleTerms != '' && $viTextTerms != '') {
                                $viTitleTerms = funTreatString($viTitleTerms);
                                $viTextTerms = funTreatString($viTextTerms);

                                if ($viIdTrans != '') {
                                    $sqlCmd1 = "UPDATE tb_terms_translation SET userO = $usr_id, title = '$viTitleTerms',";
                                    $sqlCmd1 .= "text='$viTextTerms'";
                                    $sqlCmd1 .= "WHERE id=$viIdTrans";
                                } else {
                                    //Ensure not repeated languages in same object
                                    $update = 'UPDATE tb_terms_translation SET deleted=1 ';
                                    $update .= "WHERE idTbTerms=$idTerms AND idTbLanguage = $viIdLang";
                                    $connection->query($update);
                                    $sqlCmd1 = 'INSERT INTO tb_banner_translation(dateO, userO, title, text,';
                                    $sqlCmd1 .= ' deleted, idTbLanguage, idTbTerms) VALUES ';
                                    $sqlCmd1 .= "($viDateO,$usr_id,'$viTitleBanner','$viDescriptionBanner','$viTextBanner','$viCallTitle','$viCallAction',";
                                    $sqlCmd1 .= "0,$viIdLang,$idTerms)";
                                }

                                $result1 = $connection->query($sqlCmd1);
                                if (!$result1) {
                                    if ($flagUpload) {
                                        funDeleteImage($target_file);
                                    }
                                    $action = '[ADD_SLIDE] - Failed add  TRANSLATIONs - '.$sqlCmd1;
                                    funCreateLog($action, $connection);
                                    $db->rollbackAndClose();
                                    die('false||Ocorreu um problema ao inserir tradução');
                                }
                            } else {
                                if ($flagUpload) {
                                    funDeleteImage($target_file);
                                }
                                $action = '[ADD_SLIDE] - Failed values empty';
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Alguns valores encontram-se vazios');
                            }
                        }
                        echo 'true||Operação realizada com sucesso.';
                        $action = '[ADD_SLIDE] - Success adding slide';
                        funCreateLog($action, $connection);
                        $db->commitAndClose();
                    } else {
                        if ($flagUpload) {
                            funDeleteImage($target_file);
                        }
                        $action = '[ADD_SLIDE] - Failed no languages selected';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||NENHUMA LINGUA SELECIONADA');
                    }
                } else {
                    $action = '[EDIT_FAQ] - Problem update tb_faqs';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Oppss... Ocorreu um problema ao atualizar os Termos');
                }
            } else {
                $action = '[EDIT_FAQ] - Some values are empty';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Oppss... Alguns valores estão vazios');
            }
        }

function funEditVideo()
{
    include_once 'utils.php';
    include_once 'session.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $nome = $_REQUEST['nome'];
    $data = $_REQUEST['data'];
    $url = $_REQUEST['url'];
    $id = $_REQUEST['id'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";

    $sqlCmdUpdVideo = "UPDATE tb_videos SET url='$url', name='$nome', dateF = '$data' WHERE id='$id'";

    if ($result = $connection->query($sqlCmdUpdVideo)) {
        $action = '[UPDATE_VIDEO] - VIDEO UPDATED';
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||O video foi actualizado com sucesso.';
    } else {
        $action = '[UPDATE_VIDEO] - UPDATE VIDEO FAILED';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Opps... Problema a actualizar o video.');
    }
}

function funEditAdvantage()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $advantage = 'file';
    $upload = false;
    $flagUpload = false;
    $viIdGallery = 'NULL';
    $uploadStatus = '';
    // $idAdvantage = $_REQUEST['idAdvantage'];

    if ($_REQUEST['idAdvantage']) {
        $idAdvantage = $_REQUEST['idAdvantage'];
    } else {
        $idAdvantage = '';
    }
    if ($_REQUEST['pageType']) {
        $viPageId = $_REQUEST['pageType'];
    } else {
        $viPageId = '';
    }
    if ($_REQUEST['position']) {
        $position = $_REQUEST['position'];
    } else {
        $position = '';
    }
    if ($idAdvantage != '' && $viPageId != '') {
        $sqlUpAdvantage = 'UPDATE tb_advantage_main SET ';
        $sqlUpAdvantage .= "dateO = $viDateC, userO = $usr_id, position = $position, idTbAdvantageLocation = $viPageId WHERE id=$idAdvantage";
        if ($resultSlide = $connection->query($sqlUpAdvantage)) {
            if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] != UPLOAD_ERR_NO_FILE) {
                $target_dir = PATH_ADVANTAGE_IMG;
                $imageFileTypeMain = pathinfo(basename($_FILES['fileToUpload']['name']), PATHINFO_EXTENSION);
                $viNameMain = str_replace(' ', '_', funCleanString($advantage)).'_'.date('Y_m_d_H_i_s').'.'.$imageFileTypeMain;
                $target_file = $target_dir.$viNameMain;
                $fileToUpload = $_FILES['fileToUpload']['tmp_name'];
                $uploadStatus = move_uploaded_file($fileToUpload, '../../'.$target_file);
                $flagUpload = true;
            }

            if ($uploadStatus || !$flagUpload) {
                if ($flagUpload) {
                    $viIdGallery = funInsertIntoGallery($advantage, $imageFileTypeMain, $connection, $usr_id);
                }

                if ($viIdGallery != 'NULL') {
                    $sqlCmd1 = "UPDATE tb_advantage_main SET idTbGallery = $viIdGallery WHERE id=$idAdvantage ";
                    // echo $sqlCmd1;
                    $result1 = $connection->query($sqlCmd1);
                    if (!$result1) {
                        if ($flagUpload) {
                            funDeleteImage($target_file);
                        }
                        $action = '[EDIT_SLIDE] - Failed UPDATE SLIDE '.$sqlCmd1;
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Opsss..Ocorreu um problema ao atualizar imagem.');
                    }
                }
                $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                if ($result = $connection->query($sqlCmd)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($_REQUEST['vcTitulo_'.$row['langMin']]) {
                            $vcTitulo = $_REQUEST['vcTitulo_'.$row['langMin']];
                        } else {
                            $vcTitulo = '';
                        }
                        if ($_REQUEST['txTexto_'.$row['langMin']]) {
                            $txTexto = $_REQUEST['txTexto_'.$row['langMin']];
                        } else {
                            $txTexto = '';
                        }
                        if ($_REQUEST['idTrans_'.$row['langMin']]) {
                            $viIdTrans = $_REQUEST['idTrans_'.$row['langMin']];
                        } else {
                            $viIdTrans = '';
                        }
                        $vcTitulo = mysqli_real_escape_string($connection, htmlspecialchars($vcTitulo));
                        $txTexto = mysqli_real_escape_string($connection, htmlspecialchars($txTexto));
                        if ($vcTitulo != '' && $txTexto != '') {
                            $sqlUpFaqTrans = "UPDATE tb_advantage SET dateO = $viDateC, userO = $usr_id,";
                            $sqlUpFaqTrans .= " title = '$vcTitulo', description = '$txTexto'";
                            $sqlUpFaqTrans .= " WHERE id = $viIdTrans";

                            $resultFaqTrans = $connection->query($sqlUpFaqTrans);
                            if (!$resultFaqTrans) {
                                $action = '[EDIT_ADVANTAGE] - Problem edit faqs translations';
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Oppss... Erro ao editar as traduções das faqs');
                            }
                        } else {
                            $action = '[EDIT_ADVANTAGE] - Some values are empty';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Oppss... Alguns valores estão vazios #2');
                        }
                    }
                    $connection->commit();
                    $action = '[EDIT_ADVANTAGE] - Operation edit with success';
                    funCreateLog($action, $connection);
                    $db->closeConnection();
                    echo 'true||Operação realizada com sucesso.';
                }
            } else {
                if ($flagUpload) {
                    funDeleteImage($target_file);
                }
                $action = '[EDIT_ADVANTAGE] - Failed inserting into galery';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||ocorreu um problema ao inserir na galeria');
            }
        } else {
            $action = '[EDIT_ADVANTAGE] - Problem update tb_advantage';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||Oppss... Ocorreu um problema ao atualizar os slides');
        }
    } else {
        $action = '[EDIT_ADVANTAGE] - Some values are empty';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Oppss... Alguns valores estão vazios');
    }
}

function funEditBanner()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $flagUpload = false;
    $viIdGallery = 'NULL';
    $imageUploadMain = '';

    if ($_REQUEST['id']) {
        $idSlide = $_REQUEST['id'];
    } else {
        $idSlide = '';
    }
    if ($_REQUEST['pageType']) {
        $viPageId = $_REQUEST['pageType'];
    } else {
        $viPageId = '';
    }
    if ($_REQUEST['position']) {
        $position = $_REQUEST['position'];
    } else {
        $position = '';
    }
    if (isset($_REQUEST['checkBox'])) {
        $viCheckBox = 1;
    } else {
        $viCheckBox = 0;
    }
    if (isset($_REQUEST['idModelo'])) {
        $viIdModel = $_REQUEST['idModelo'];
    } else {
        $viIdModel = '';
    }
    if ($idSlide != '' && $viPageId != '') {
        $sqlUpSlide = 'UPDATE tb_banner SET ';
        $sqlUpSlide .= "dateO= $viDateC, userO = $usr_id, position = $position, flagCta = $viCheckBox , idTbBannerLocal = $viPageId WHERE id=$idSlide";

        if ($resultSlide = $connection->query($sqlUpSlide)) {
            if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] != UPLOAD_ERR_NO_FILE) {
                $target_dir = PATH_BANNER_IMG;
                $imageFileTypeMain = pathinfo(basename($_FILES['fileToUpload']['name']), PATHINFO_EXTENSION);
                $newTitle = date('Y_m_d_H_i_s');
                $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
                $fileTypeOriginal = $_FILES['fileToUpload']['type'];
                $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['fileToUpload']['tmp_name'], $target_file, '', '');
                $flagUpload = true;
            } else {
                $flagUpload = false;
            }
            if ($imageUploadMain || !$flagUpload) {
                if ($flagUpload) {
                    $viIdGallery = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
                }
                if ($viIdGallery != 'NULL') {
                    $sqlCmd = "UPDATE tb_banner SET idTbGallery = $viIdGallery WHERE id=$idSlide ";
                    $result = $connection->query($sqlCmd);
                    if (!$result) {
                        if ($flagUpload) {
                            funDeleteImage($target_file);
                        }
                        $action = '[EDIT_SLIDE] - Failed UPDATE SLIDE '.$sqlCmd;
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Opsss..Ocorreu um problema ao atualizar imagem.');
                    }
                }

                if (isset($_FILES['fileToUpload_2']) && !empty($_FILES['fileToUpload_2']['name']) && $_FILES['fileToUpload_2']['error'] != UPLOAD_ERR_NO_FILE) {
                    $target_dir = PATH_BANNER_IMG;
                    $imageFileTypeMain = pathinfo(basename($_FILES['fileToUpload_2']['name']), PATHINFO_EXTENSION);
                    $newTitle = date('Y_m_d_H_i_s');
                    $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
                    $fileTypeOriginal = $_FILES['fileToUpload_2']['type'];
                    $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['fileToUpload_2']['tmp_name'], $target_file, '', '');
                    $flagUpload = true;
                } else {
                    $flagUpload = false;
                }
                if ($imageUploadMain || !$flagUpload) {
                    if ($flagUpload) {
                        $viIdGallery = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
                    }
                    if ($viIdGallery != 'NULL') {
                        $sqlCmd = "UPDATE tb_banner SET idTbGallery = $viIdGallery WHERE id=$idSlide ";
                        $result = $connection->query($sqlCmd);
                        if (!$result) {
                            if ($flagUpload) {
                                funDeleteImage($target_file);
                            }
                            $action = '[EDIT_SLIDE] - Failed UPDATE SLIDE '.$sqlCmd;
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Opsss..Ocorreu um problema ao atualizar imagem.');
                        }
                    }

                    $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                    if ($result = $connection->query($sqlCmd)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $langMin = $row['langMin'];
                            $viIdLang = $row['id'];
                            if ($_REQUEST['title_banner_'.$langMin]) {
                                $viTitleBanner = $_REQUEST['title_banner_'.$langMin];
                            } else {
                                $viTitleBanner = '';
                            }
                            if ($_REQUEST['call_action_'.$langMin]) {
                                $viCallAction = $_REQUEST['call_action_'.$langMin];
                            } else {
                                $viCallAction = '';
                            }
                            if ($_REQUEST['call_title_'.$langMin]) {
                                $viCallTitle = $_REQUEST['call_title_'.$langMin];
                            } else {
                                $viCallTitle = '';
                            }
                            if ($_REQUEST['text_banner_'.$langMin]) {
                                $viTextBanner = $_REQUEST['text_banner_'.$langMin];
                            } else {
                                $viTextBanner = '';
                            }
                            if ($_REQUEST['sub_text_banner_'.$langMin]) {
                                $viSubTextBanner = $_REQUEST['sub_text_banner_'.$langMin];
                            } else {
                                $viSubTextBanner = '';
                            }
                            if ($_REQUEST['description_banner_'.$langMin]) {
                                $viDescriptionBanner = $_REQUEST['description_banner_'.$langMin];
                            } else {
                                $viDescriptionBanner = '';
                            }
                            if ($_REQUEST['idTrans_'.$langMin]) {
                                $viIdTrans = $_REQUEST['idTrans_'.$langMin];
                            } else {
                                $viIdTrans = '';
                            }
                            if ($viTitleBanner != '' && $viCallAction != '' && $viCallTitle != '' && $viTextBanner != '' && $viDescriptionBanner != '') {
                                $viTitleBanner = funTreatString($viTitleBanner);
                                $viTextBanner = funTreatString($viTextBanner);
                                $viSubTextBanner = funTreatString($viSubTextBanner);
                                $viDescriptionBanner = funTreatString($viDescriptionBanner);
                                $viCallAction = funTreatString($viCallAction);
                                $viCallTitle = funTreatString($viCallTitle);

                                if ($viIdTrans != '') {
                                    $sqlCmd1 = "UPDATE tb_banner_translation SET  title = '$viTitleBanner',subtitle = '$viDescriptionBanner',";
                                    $sqlCmd1 .= "text='$viTextBanner',subText='$viSubTextBanner',callTitle='$viCallTitle',callAction='$viCallAction' ";
                                    $sqlCmd1 .= "WHERE id=$viIdTrans";
                                } else {
                                    //Ensure not repeated languages in same object
                                    $update = 'UPDATE tb_banner_translation SET deleted=1 ';
                                    $update .= "WHERE idTbBanner=$idSlide AND idTbLanguage = $viIdLang";
                                    $connection->query($update);
                                    $sqlCmd1 = 'INSERT INTO tb_banner_translation(dateC, title, subtitle, text, subText,callTitle, callAction,';
                                    $sqlCmd1 .= ' deleted, idTbLanguage, idTbSlide) VALUES ';
                                    $sqlCmd1 .= "($viDateC,'$viTitleBanner','$viDescriptionBanner','$viTextBanner','$viSubTextBanner','$viCallTitle','$viCallAction',";
                                    $sqlCmd1 .= "0,$viIdLang,$idSlide)";
                                }

                                $result1 = $connection->query($sqlCmd1);
                                if (!$result1) {
                                    if ($flagUpload) {
                                        funDeleteImage($target_file);
                                    }
                                    $action = '[ADD_SLIDE] - Failed add  TRANSLATIONs - '.$sqlCmd1;
                                    funCreateLog($action, $connection);
                                    $db->rollbackAndClose();
                                    die('false||Ocorreu um problema ao inserir tradução');
                                }
                            } else {
                                if ($flagUpload) {
                                    funDeleteImage($target_file);
                                }
                                $action = '[ADD_SLIDE] - Failed values empty';
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Alguns valores encontram-se vazios');
                            }
                        }

                        if ($viIdModel != '') {
                            $sqlUpdBannerModel = "UPDATE tb_models_page SET idTbModel=$viIdModel WHERE idTbBanner = $idSlide";

                            if ($resultBanner = $connection->query($sqlUpdBannerModel)) {
                                echo 'true||Operação realizada com sucesso.';
                                $action = '[UPDATE_BANNER] - Success updating banner to model';
                                funCreateLog($action, $connection);
                                $db->commitAndClose();
                            } else {
                                $action = '[UPDATE_BANNER] - Failed inserting model';
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Ocorreu um erro ao actualizar o modelo associado.');
                            }
                        } else {
                            echo 'true||Operação realizada com sucesso.';
                            $action = '[ADD_SLIDE] - Success adding slide';
                            funCreateLog($action, $connection);
                            $db->commitAndClose();
                        }
                    } else {
                        if ($flagUpload) {
                            funDeleteImage($target_file);
                        }
                        $action = '[ADD_SLIDE] - Failed no languages selected';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||NENHUMA LINGUA SELECIONADA');
                    }
                } else {
                    if ($flagUpload) {
                        funDeleteImage($target_file);
                    }
                    $action = '[ADD_SLIDE] - Failed inserting into galery';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||ocorreu um problema ao inserir na galeria');
                }
            } else {
                if ($flagUpload) {
                    funDeleteImage($target_file);
                }
                $action = '[ADD_SLIDE] - Failed inserting into galery';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||ocorreu um problema ao inserir na galeria');
            }
        } else {
            $action = '[EDIT_FAQ] - Problem update tb_faqs';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||Oppss... Ocorreu um problema ao atualizar os slides');
        }
    } else {
        $action = '[EDIT_FAQ] - Some values are empty';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Oppss... Alguns valores estão vazios');
    }
}

function funEditClinic()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;

    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateU = "'".date('Y-m-d H:i:s')."'";
    $flagUpload = false;
    $viIdGallery = 'NULL';
    $imageUploadMain = '';
    $clinic = $_REQUEST['clinic'];
    $address = $_REQUEST['address'];
    $zipcode = $_REQUEST['zipcode'];
    $city = $_REQUEST['city'];
    $idClinic = $_REQUEST['idclinic'];

    $sqlCmdUpdClinic = "UPDATE tb_clinicas SET dateU = $viDateU, clinic = '$clinic', address = '$address', zipCode = '$zipcode', city = '$city' WHERE id='$idClinic'";

    if ($result = $connection->query($sqlCmdUpdClinic)) {
        $translate = '';
        $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
        if ($result = $connection->query($sqlCmd)) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Edit Clinic descrition translation in database
                if ($_REQUEST['description_'.$row['langMin']]) {
                    $viDescription = $_REQUEST['description_'.$row['langMin']];
                } else {
                    $viDescription = '';
                }
                if ($_REQUEST['title_cta_'.$row['langMin']]) {
                    $viTitleCta = $_REQUEST['title_cta_'.$row['langMin']];
                } else {
                    $viTitleCta = '';
                }
                if ($_REQUEST['cta_'.$row['langMin']]) {
                    $viCta = $_REQUEST['cta_'.$row['langMin']];
                } else {
                    $viCta = '';
                }
                $viDescription = mysqli_real_escape_string($connection, htmlspecialchars($viDescription));
                $sqlCmdUpdClinicTrans = "UPDATE tb_description_translation SET dateU = $viDateU, userU = $usr_id, description = '$viDescription',";
                $sqlCmdUpdClinicTrans .= " titleAction='$viTitleCta',cta='$viCta' WHERE idTbClinic = $idClinic AND idTbLanguage = ".$row['id'].'';
                if ($connection->query($sqlCmdUpdClinicTrans)) {
                    $translate = 1;
                }
            }

            $total = count($_FILES['images']['name']);

            if (empty($_FILES['images']['name'][0]) && $translate != null) {
                $connection->commit();
                $action = '[EDIT_CLINIC] - Operation edit with success';
                funCreateLog($action, $connection);
                $db->closeConnection();
                echo 'true||Operação realizada com sucesso.';
            } elseif (!empty($_FILES['images']['name'][0])) {
                $name = $_FILES['images']['name']; //Atribui uma array com os nomes dos arquivos Ã  variÃ¡vel
                $total = count($_FILES['images']['name']);
                $tmp_name = $_FILES['images']['tmp_name']; //Atribui uma array com os nomes temporÃ¡rios dos arquivos Ã  variÃ¡vel
                            $type = $_FILES['images']['type']; //Atribui uma array com os nomes temporÃ¡rios dos arquivos Ã  variÃ¡vel
                            for ($c = 0; $c < $total; ++$c) {
                                $ext = strtolower(substr($name[$c], -4));
                                $nameFile = date('YmdHis', time()).'_'.$idClinic;
                                $target_dir = PATH_CLINIC_IMG;
                                //$imageFileTypeMain = pathinfo(basename($name[$c]) , PATHINFO_EXTENSION);
                                $imageFileTypeMain = pathinfo(basename($_FILES['images']['name'][$c]), PATHINFO_EXTENSION);
                                $newTitle = str_replace('/', '-', funCleanString($nameFile));
                                $viNameMain = str_replace(' ', '-', funCleanString($newTitle));
                                $target_file = $target_dir.$viNameMain.'.'.$imageFileTypeMain;
                                $fileTypeOriginal = $type[$c];

                                $imageUploadMain = funSaveImages($fileTypeOriginal, $tmp_name[$c], $target_file, '', '');
                                $viIdGallery = funInsertIntoGallery($viNameMain, $imageFileTypeMain, $connection, $usr_id);
                                if ($viIdGallery != 'NULL') {
                                    $arrayIdGallery[] = $viIdGallery;
                                    sleep(1);
                                } else {
                                    $action = '[ADD_CLINIC_IMG] - Problem insert image ';
                                    funCreateLog($action, $connection);
                                    $db->rollbackAndClose();
                                    die('false||Oppss... Ocorreu um problema ao gravar a imagem.');
                                }
                            }

                $valuesGalleryClinic = '';
                for ($i = 0; $i < count($arrayIdGallery); ++$i) {
                    if ($valuesGalleryClinic == '') {
                        $valuesGalleryClinic .= "($viDateU,'$usr_id',$viDateU,'$usr_id',$idClinic,$arrayIdGallery[$i])";
                    } else {
                        $valuesGalleryClinic .= ",($viDateU,'$usr_id',$viDateU,'$usr_id',$idClinic,$arrayIdGallery[$i])";
                    }
                }

                $sqlCmdInsertClinicImagesinGallery = 'INSERT INTO tb_clinic_gallery (dateC, userC, dateU, userU';
                $sqlCmdInsertClinicImagesinGallery .= ', idTbClinic, idTbGallery) VALUES ';
                $sqlCmdInsertClinicImagesinGallery .= $valuesGalleryClinic;
                if ($connection->query($sqlCmdInsertClinicImagesinGallery)) {
                    $action = '[EDIT_CLINIC] - CLINIC ADDED';
                    funCreateLog($action, $connection);
                    $db->commitAndClose();
                    echo 'true||A clinica foi actualizada com sucesso.';
                } else {
                    $imgSuccess = 'false';
                    funDeleteImage($target_file);
                    $action = '[EDIT_CLINIC] - Failed edit  [SQL] - '.$sqlCmdInsertClinicImagesinGallery;
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Opps... Problema a inserir as imagens na galeria.');
                }
            } else {
                $action = '[EDIT_CLINIC] - Failed update';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Opps... Problema a actualizar as traduções da clinica.');
            }
        }
    } else {
        $action = '[EDIT_CLINIC] - Failed update';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Opps... Problema a actualizar a clinica.');
    }
}

function funEditTitleFaq()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateO = "'".date('Y-m-d H:i:s')."'";
    $flagUpload = false;
    $viIdGallery = 'NULL';
    $imageUploadMain = '';

    if ($_REQUEST['idTitleFaq']) {
        $viIdTitleFaq = $_REQUEST['idTitleFaq'];
    } else {
        $viIdTitleFaq = '';
    }
    if ($viIdTitleFaq != '') {
        $sqlUpTitleFaq = "UPDATE tb_title_faqs SET dateO=$viDateO,userO=$usr_id,deleted=0 WHERE id=$viIdTitleFaq";
        if ($resultFaq = $connection->query($sqlUpTitleFaq)) {
            if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] != UPLOAD_ERR_NO_FILE) {
                $target_dir = PATH_FAQS_IMG;
                $imageFileTypeMain = pathinfo(basename($_FILES['fileToUpload']['name']), PATHINFO_EXTENSION);
                $newTitle = date('Y_m_d_H_i_s');
                $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
                $fileTypeOriginal = $_FILES['fileToUpload']['type'];
                $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['fileToUpload']['tmp_name'], $target_file, '', '');
                $flagUpload = true;
            } else {
                $flagUpload = false;
            }
            if ($imageUploadMain || !$flagUpload) {
                if ($flagUpload) {
                    $viIdGallery = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
                }
                if ($viIdGallery != 'NULL') {
                    $sqlCmd = "UPDATE tb_title_faqs SET idTbGallery = $viIdGallery WHERE id=$viIdTitleFaq ";
                    $result = $connection->query($sqlCmd);
                    if (!$result) {
                        if ($flagUpload) {
                            funDeleteImage($target_file);
                        }
                        $action = '[EDIT_SLIDE] - Failed UPDATE SLIDE '.$sqlCmd;
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Opsss..Ocorreu um problema ao atualizar imagem.');
                    }
                }

                $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                if ($result = $connection->query($sqlCmd)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($_REQUEST['title_'.$row['langMin']]) {
                            $viTitle = $_REQUEST['title_'.$row['langMin']];
                        } else {
                            $viTitle = '';
                        }
                        // if($_REQUEST['desc_'.$row['langMin']]){$viDesc = $_REQUEST['desc_'.$row['langMin']];}else{$viDesc = "";}
                        if ($_REQUEST['idTrans_'.$row['langMin']]) {
                            $viIdTrans = $_REQUEST['idTrans_'.$row['langMin']];
                        } else {
                            $viIdTrans = '';
                        }
                        $viTitle = mysqli_real_escape_string($connection, htmlspecialchars($viTitle));
                        // $viDesc = mysqli_real_escape_string($connection,htmlspecialchars($viDesc));
                        if ($viTitle != '' && $viIdTrans != '') {
                            $sqlUpFaqTrans = "UPDATE tb_title_faqs_translation SET dateO=$viDateO,userO=$usr_id,title='$viTitle',idTbTitleFaqs= $viIdTitleFaq WHERE id=$viIdTrans";
                            // echo $sqlUpFaqTrans;
                            $resultFaqTrans = $connection->query($sqlUpFaqTrans);
                            if (!$resultFaqTrans) {
                                $action = '[EDIT_FAQ] - Problem edit faqs translations';
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Oppss... Erro ao editar as traduções das faqs');
                            }
                        } else {
                            $action = '[EDIT_FAQ] - Some values are empty';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Oppss... Alguns valores estão vazios #2');
                        }
                    }
                    $connection->commit();
                    $action = '[EDIT_FAQ] - Operation edit with success';
                    funCreateLog($action, $connection);
                    $db->closeConnection();
                    echo 'true||Operação realizada com sucesso.';
                }
            } else {
                if ($flagUpload) {
                    funDeleteImage($target_file);
                }
                $action = '[ADD_SLIDE] - Failed inserting into galery';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||ocorreu um problema ao inserir na galeria');
            }
        } else {
            $action = '[EDIT_FAQ] - Problem update tb_faqs';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||Oppss... Ocorreu um problema ao atualizar as faqs');
        }
    } else {
        $action = '[EDIT_FAQ] - Some values are empty';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Oppss... Alguns valores estão vazios');
    }
}

function funEditEvent()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    include_once '../../includes/globalVars.php';

    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $eventDate = $_REQUEST['eventDate'];
    $transCode = $_REQUEST['transcode'];
    $idEvent = $_REQUEST['idEvent'];
    $translate = 0;
    $viIdGallery = 'NULL';
    $imageUploadMain = '';

    if ($_REQUEST['idEvent']) {
        $viIdEvent = $_REQUEST['idEvent'];
    } else {
        $viIdEvent = '';
    }

    // Update Event IN Database
    $sqlCmdUpdEvent = 'UPDATE tb_events SET dateO='.$viDateC.', userO='.$usr_id.", eventDate='".$eventDate."',";
    $sqlCmdUpdEvent .= 'status=0, idTbTransCode='.$transCode." WHERE id=$viIdEvent";
    // echo $sqlCmdUpdEvent;
    if ($resultEvent = $connection->query($sqlCmdUpdEvent)) {
        // echo "entrei";

        if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] != UPLOAD_ERR_NO_FILE) {
            $target_dir = PATH_EVENT_IMG;
            $imageFileTypeMain = pathinfo(basename($_FILES['fileToUpload']['name']), PATHINFO_EXTENSION);
            $newTitle = date('Y_m_d_H_i_s');
            $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
            $fileTypeOriginal = $_FILES['fileToUpload']['type'];
            $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['fileToUpload']['tmp_name'], $target_file, '', '');
            $flagUpload = true;
        } else {
            $flagUpload = false;
        }
        if ($imageUploadMain || !$flagUpload) {
            if ($flagUpload) {
                $viIdGallery = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
            }
            if ($viIdGallery != 'NULL') {
                $sqlCmd1 = "UPDATE tb_events SET idTbGallery = $viIdGallery WHERE id=$viIdEvent ";
                $result = $connection->query($sqlCmd1);
                if (!$result) {
                    if ($flagUpload) {
                        funDeleteImage($target_file);
                    }
                    $action = '[EDIT_SLIDE] - Failed UPDATE SLIDE '.$sqlCmd;
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Opsss..Ocorreu um problema ao atualizar imagem.');
                }
            }

            $translate = '';
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($_REQUEST['title'.$row['langMin']]) {
                        $viTitle = $_REQUEST['title'.$row['langMin']];
                    } else {
                        $viTitle = '';
                    }
                    if ($_REQUEST['text'.$row['langMin']]) {
                        $viText = $_REQUEST['text'.$row['langMin']];
                    } else {
                        $viText = '';
                    }

                    if ($_REQUEST['call_action_'.$row['langMin']]) {
                        $viCallAction = $_REQUEST['call_action_'.$row['langMin']];
                    } else {
                        $viCallAction = '';
                    }
                    if ($_REQUEST['call_title_'.$row['langMin']]) {
                        $viCallTitle = $_REQUEST['call_title_'.$row['langMin']];
                    } else {
                        $viCallTitle = '';
                    }
                    $viCallTitle = mysqli_real_escape_string($connection, htmlspecialchars($viCallTitle));
                    $viCallAction = mysqli_real_escape_string($connection, htmlspecialchars($viCallAction));

                    $viText = mysqli_real_escape_string($connection, htmlspecialchars($viText));
                    $sqlCmdUpdEventTrans = 'UPDATE tb_events_translation SET dateO='.$viDateC.', userO='.$usr_id.", title='".$viTitle."',";
                    $sqlCmdUpdEventTrans .= "text='".$viText."',callTitle = '$viCallTitle',callAction = '$viCallAction' WHERE idTbLanguage=".$row['id']." AND idTbEvents =$viIdEvent";
                    // echo $sqlCmdUpdEventTrans;

                    if ($connection->query($sqlCmdUpdEventTrans)) {
                        $translate = 1;
                    } else {
                        $translate = 0;
                    }
                }

                if ($translate == 1) {
                    $action = '[UPD_EVENT] - EVENT UPDATED';
                    funCreateLog($action, $connection);
                    $db->commitAndClose();
                    echo 'true||O Evento foi actualizado com sucesso.';
                } else {
                    $action = '[UPD_EVENT] - Failed update';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Opps... Problema a actualizar as traduções do evento.');
                }
            } else {
                if ($flagUpload) {
                    funDeleteImage($target_file);
                }
                $action = '[ADD_SLIDE] - Failed inserting into galery';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||ocorreu um problema ao inserir na galeria');
            }
        } else {
            $action = '[UPD_EVENT] - Failed update';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||Opps... Problema a actualizar o evento.');
        }
    }
}

    function funEditNameModel()
    {
        include_once 'functions.php';
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $viDateO = "'".date('Y-m-d H:i:s')."'";
        $name = $_REQUEST['name'];
        $default = $_REQUEST['default'];
        $imageUploadMain = 'NULL';
        $imageUploadMain5 = 'NULL';
        $viIdPdf = 'NULL';
        $viIdGallery = 'NULL';
        $viIdTbStyleImg = 'NULL';
        $imgUploadFloor = 'NULL';
        $sqlCmdAddTechDrawOpt = '';
        $total = $_REQUEST['total'];
        $total1 = $_REQUEST['total1'];
        $idModel = $_REQUEST['id'];
        $imageFileTypeMainPlanta = 'NULL';
        //insert model main
        if ($name != '' && $default != '') {
            $sqlUpModels = 'UPDATE tb_models SET ';
            $sqlUpModels .= "dateO= $viDateO, userO = $usr_id, name = '$name', tb_models.default = $default WHERE id=$idModel";

            if ($resultModels = $connection->query($sqlUpModels)) {
                //insert model descriptions by language
                $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                // echo "entrei";
                if ($result = $connection->query($sqlCmd)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $langMin = $row['langMin'];
                        $viIdLang = $row['id'];
                        if ($_REQUEST['tokenModel_'.$langMin]) {
                            $token = $_REQUEST['tokenModel_'.$langMin];
                        } else {
                            $token = '';
                        }
                        if (isset($_FILES['fileToUpload_'.$langMin]) && !empty($_FILES['fileToUpload_'.$langMin]['name']) && $_FILES['fileToUpload_'.$langMin]['error'] != UPLOAD_ERR_NO_FILE) {
                            $target_dir = PATH_PDF_IMG;
                            $imageFileTypeMain = pathinfo(basename($_FILES['fileToUpload_'.$langMin]['name']), PATHINFO_EXTENSION);
                            $newTitle = 'SHM_'.$name.'_'.date('Y_m_d_H_i_s');
                            $valueExt = $newTitle.'.'.$imageFileTypeMain;
                            $target_file = '../../'.$target_dir.$valueExt;
                            $imageUploadMain = move_uploaded_file($_FILES['fileToUpload_'.$langMin]['tmp_name'], $target_file);
                            $flagUpload = true;
                        } else {
                            $flagUpload = false;
                            $action = '[ADD_MODEL] - Missing PDF';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Falta selecionar o PDF');
                        }
                        if ($imageUploadMain || !$flagUpload) {
                            // echo "entrei";
                            if ($flagUpload) {
                                $viIdPdf = funInsertIntoPdf($valueExt, $token, $viDateO, $viIdLang, $connection, $usr_id);
                            }
                            $sqlCmd1 = "UPDATE tb_models_translation SET idTbPdf = '$viIdPdf'  WHERE idTbModels='$idModel' AND idTbLanguage = '$viIdLang' ";
                            // echo $sqlCmd1;
                            $result1 = $connection->query($sqlCmd1);
                            if (!$result1) {
                                if ($flagUpload) {
                                    funDeleteImage($target_file);
                                }
                                $action = '[ADD_MODEL] - Failed add Translations - '.$sqlCmd1;
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Ocorreu um problema ao inserir tradução');
                            }

                            if ($_REQUEST['descModel_'.$langMin]) {
                                $viDescription = $_REQUEST['descModel_'.$langMin];
                            } else {
                                $viDescription = '';
                            }
                            if ($_REQUEST['keyModelSeo_'.$langMin]) {
                                $viKeywords = $_REQUEST['keyModelSeo_'.$langMin];
                            } else {
                                $viKeywords = '';
                            }
                            if ($_REQUEST['descModelSeo_'.$langMin]) {
                                $viDescriptionSeo = $_REQUEST['descModelSeo_'.$langMin];
                            } else {
                                $viDescriptionSeo = '';
                            }
                            if ($_REQUEST['idTrans_'.$langMin]) {
                                $viIdTrans = $_REQUEST['idTrans_'.$langMin];
                            } else {
                                $viIdTrans = '';
                            }
                            if ($viDescription != '' && $viKeywords != '' && $viDescriptionSeo != '') {
                                // echo "entrei";
                                $viDescription = funTreatString($viDescription);
                                $viKeywords = funTreatString($viKeywords);
                                $viDescriptionSeo = funTreatString($viDescriptionSeo);

                                if ($viIdTrans != '') {
                                    $sqlCmd1 = "UPDATE tb_models_translation SET  description = '$viDescription',keywordsSeo = '$viKeywords',";
                                    $sqlCmd1 .= "descriptionSeo='$viDescriptionSeo'";
                                    $sqlCmd1 .= "WHERE id=$viIdTrans";
                                // echo $sqlCmd1;
                                } else {
                                    //Ensure not repeated languages in same object
                                    $update = 'UPDATE tb_models_translation';
                                    $update .= "WHERE idTbModels=$idModel AND idTbLanguage = $viIdLang";
                                    $connection->query($update);
                                    $sqlCmd1 = 'INSERT INTO tb_models_translation(dateO,userO,description, keywordsSeo, descriptionSeo, ';
                                    $sqlCmd1 .= ' idTbLanguage, idTbModels,idTbPdf) VALUES ';
                                    $sqlCmd1 .= "($viDateO,'$usr_id','$viDescription','$viKeywords','$viDescriptionSeo',";
                                    $sqlCmd1 .= "$viIdLang,$idModel,$viIdPdf)";
                                }

                                $result1 = $connection->query($sqlCmd1);
                                if (!$result1) {
                                    if ($flagUpload) {
                                        funDeleteImage($target_file);
                                    }
                                    $action = '[ADD_SLIDE] - Failed add  TRANSLATIONs - '.$sqlCmd1;
                                    funCreateLog($action, $connection);
                                    $db->rollbackAndClose();
                                    die('false||Ocorreu um problema ao inserir tradução');
                                }
                            } else {
                                if ($flagUpload) {
                                    funDeleteImage($target_file);
                                }
                                $action = '[ADD_MODEL] - Failed values empty';
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Alguns valores encontram-se vazios');
                            }
                        } else {
                            $action = '[ADD_MODEL] - Failed add  image';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Opps... Problema a inserir imagem.');
                        }
                    }
                }
                if ($resultModelsLang = $connection->query($sqlCmd1)) {
                    //insert specs

                    $flagUpd = 0;
                    for ($i = 1; $i <= $total; ++$i) {
                        $spec = $_REQUEST['pageType1_'.$i];
                        $value = $_REQUEST['valueModel_'.$i];

                        $sqlCmd3 = "UPDATE tb_models_specs SET dateO = $viDateO, userO =$usr_id, status = 0,value = '$value' ";
                        $sqlCmd3 .= " WHERE idTbModels = $idModel AND idTbSpec = $spec";

                        if ($result3 = $connection->query($sqlCmd3)) {
                            $flagUpd = 1;
                        }
                        // echo $i."||".$sqlCmd3."||".$total;
                    }
                    // if ($flagUpd == 1) {
                    //insert images model
                    if (isset($_FILES['fileToUploadVolu']) && !empty($_FILES['fileToUploadVolu']['name']) && $_FILES['fileToUploadVolu']['error'] != UPLOAD_ERR_NO_FILE) {
                        $target_dir = PATH_MODELS_GALLERY_IMG;
                        $imageFileTypeMain = pathinfo(basename($_FILES['fileToUploadVolu']['name']), PATHINFO_EXTENSION);
                        $newTitle = date('Y_m_d_H_i_s');
                        $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
                        $fileTypeOriginal = $_FILES['fileToUploadVolu']['type'];
                        $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['fileToUploadVolu']['tmp_name'], $target_file, '', '');
                        $flagUpload = true;
                    } else {
                        $flagUpload = false;
                    }

                    if ($imageUploadMain !== 'NULL') {
                        // echo "Entrei!!!!";
                        if ($flagUpload) {
                            $viIdGallery = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
                        }
                        // echo $viIdGallery;
                        if ($viIdGallery != 'NULL') {
                            $sqlCmdG1 = "UPDATE tb_models_gallery SET idTbGallery = $viIdGallery WHERE idTbModels=$idModel AND styleImg = 'Volumetria'";
                            // echo $sqlCmdG1;
                            $result = $connection->query($sqlCmdG1);
                            if (!$result) {
                                if ($flagUpload) {
                                    funDeleteImage($target_file);
                                }
                                $action = '[EDIT_SLIDE] - Failed UPDATE SLIDE '.$sqlCmdG1;
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Opsss..Ocorreu um problema ao atualizar imagem.');
                            } else {
                                saveReal($connection, $flagUpd, $usr_id, $db, $idModel, $_FILES);
                            }
                        }
                    } else {
                        saveReal($connection, $flagUpd, $usr_id, $db, $idModel, $_FILES);
                    }

                    // if($_FILES['fileToUploadPlanta_'.$m]!=""){
                    // 	echo "entrei";

                    //insert technical draw
                    $drawValues = '';
                    for ($m = 1; $m <= $total1; ++$m) {
                        // echo "entrei<br>";
                        // die();
                        $floor = $_REQUEST['andar_'.$m];
                        $TechDraw = $_REQUEST['techId_'.$m];
                        // echo "~~~~~~~~~~~~~~~~~".$TechDraw;
                        $division = $_REQUEST['selectDivisions1_'.$m];
                        if ($_FILES['fileToUploadPlanta_'.$m] != '') {
                            echo 'entrei';

                            if (isset($_FILES['fileToUploadPlanta_'.$m]) && !empty($_FILES['fileToUploadPlanta_'.$m]['name']) && $_FILES['fileToUploadPlanta_'.$m]['error'] != UPLOAD_ERR_NO_FILE) {
                                $target_dir = PATH_PLANTA_IMG;
                                $imageFileTypeMainPlanta = pathinfo(basename($_FILES['fileToUploadPlanta_'.$m]['name']), PATHINFO_EXTENSION);
                                $newTitle = date('Y_m_d_H_i_s');
                                $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMainPlanta;
                                $fileTypeOriginal = $_FILES['fileToUploadPlanta_'.$m]['type'];
                                $imgUploadFloor = funSaveImages($fileTypeOriginal, $_FILES['fileToUploadPlanta_'.$m]['tmp_name'], $target_file, '', '');
                                $flagUploadFloor = true;
                            } else {
                                $flagUploadFloor = false;
                            }

                            if ($imgUploadFloor || !$flagUploadFloor) {
                                if ($flagUploadFloor) {
                                    $viIdGalleryFloor = funInsertIntoGallery($newTitle, $imageFileTypeMainPlanta, $connection, $usr_id);
                                    $sqlCmdAddTechDraw = 'UPDATE tb_tech_draw SET status = 1';
                                    $sqlCmdAddTechDraw .= " WHERE idTbModels=$idModel ";

                                    // echo "<br>".$sqlCmdAddTechDraw."<br>";

                                    if ($resultTechDraw = $connection->query($sqlCmdAddTechDraw)) {
                                        sleep(1);

                                        // $viIdTechDraw= $connection->insert_id;
                                        // echo "\\".$viIdTechDraw;
                                        // die();

                                        $valuesDrawDiv = 0;

                                        for ($d = 0; $d < count($division); ++$d) {
                                            // $sqlCmdInsertDivisions = "SELECT * FROM tb_techDraw_divisions WHERE idTbTechDraw = '$TechDraw' ";

                                            // echo "ole|".$TechDraw."|ola";
                                            $viIdDivision = explode('|', $division[$d]);
                                            $viIdDivision = $viIdDivision[0];

                                            $sqlCmdInsertDivisions = 'UPDATE tb_techDraw_divisions SET status = 1';
                                            $sqlCmdInsertDivisions .= " WHERE idTbTechDraw = '$TechDraw'";
                                            // echo "<br>".$sqlCmdInsertDivisions."<br>";
                                            // sleep(1);
                                            if ($result3 = $connection->query($sqlCmdInsertDivisions)) {
                                                $valuesDrawDiv = 1;
                                                // echo $valuesDrawDiv;
                                            }
                                            // echo "<br>"."||".$viIdDivision."||".$sqlCmdInsertDivisions."<br>";
                                        }
                                        // $sqlCmdInsertDivisions = "INSERT INTO tb_techDraw_divisions (dateO, userO, idTbTechDraw, idTbDivision) VALUES " .$valuesDrawDiv;
                                        // echo $sqlCmdInsertDivisions;

                                        if (!$connection->query($sqlCmdInsertDivisions)) {
                                            $action = '[ADD_MODEL] - Failed add divisions tech draw [SQL] - '.$sqlCmdInsertDivisions;
                                            funCreateLog($action, $connection);
                                            $db->rollbackAndClose();
                                            die('false||Opps... Problema a inserir divisiões desenho tecnico.');
                                        }
                                    }
                                }
                            } else {
                                $action = '[ADD_MODEL] - Failed add  [SQL] - ';
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Opps... Problema a inserir modelo.');
                            }
                        }

                        $drawValues = '';
                        for ($m = 1; $m <= $total1; ++$m) {
                            $floor = $_REQUEST['andar_'.$m];
                            $division = $_REQUEST['selectDivisions1_'.$m];

                            if (isset($_FILES['fileToUploadPlanta_'.$m]) && !empty($_FILES['fileToUploadPlanta_'.$m]['name']) && $_FILES['fileToUploadPlanta_'.$m]['error'] != UPLOAD_ERR_NO_FILE) {
                                $target_dir = PATH_PLANTA_IMG;
                                $imageFileTypeMainPlanta = pathinfo(basename($_FILES['fileToUploadPlanta_'.$m]['name']), PATHINFO_EXTENSION);
                                $newTitle = date('Y_m_d_H_i_s');
                                $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
                                $fileTypeOriginal = $_FILES['fileToUploadPlanta_'.$m]['type'];
                                $imgUploadFloor = funSaveImages($fileTypeOriginal, $_FILES['fileToUploadPlanta_'.$m]['tmp_name'], $target_file, '', '');
                                $flagUploadFloor = true;
                            } else {
                                $flagUploadFloor = false;
                            }

                            if ($imgUploadFloor || !$flagUploadFloor) {
                                if ($flagUploadFloor) {
                                    $viIdGalleryFloor = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
                                    $sqlCmdAddTechDraw = 'INSERT INTO tb_tech_draw(dateO,userO,status,idTbGallery,idTbTransCode,idTbModels) VALUES ';
                                    $sqlCmdAddTechDraw .= "($viDateO,'$usr_id',0,$viIdGalleryFloor,$floor,$idModel)";
                                    // echo $sqlCmdAddTechDraw;
                                    if ($resultTechDraw = $connection->query($sqlCmdAddTechDraw)) {
                                        sleep(1);
                                        // $viIdTechDraw= $connection->insert_id;
                                        $valuesDrawDiv = '';
                                        for ($d = 0; $d < count($division); ++$d) {
                                            $viIdDivision = explode('|', $division[$d]);
                                            $viIdDivision = $viIdDivision[0];
                                            if ($d == 0) {
                                                $valuesDrawDiv .= "($viDateO,$usr_id,$TechDraw, $viIdDivision)";
                                            } else {
                                                $valuesDrawDiv .= ",($viDateO,$usr_id,$TechDraw, $viIdDivision)";
                                            }
                                            // $sqlCmdInsertDivisions = "INSERT INTO tb_techDraw_divisions (dateO, userO, idTbTechDraw, idTbDivision) VALUES " .$valuesDrawDiv;
                                // echo $sqlCmdInsertDivisions;
                                        }
                                        $sqlCmdInsertDivisions = 'INSERT INTO tb_techDraw_divisions (dateO, userO, idTbTechDraw, idTbDivision) VALUES '.$valuesDrawDiv;
                                        // echo $sqlCmdInsertDivisions;

                                        if (!$connection->query($sqlCmdInsertDivisions)) {
                                            $action = '[ADD_MODEL] - Failed add divisions tech draw [SQL] - '.$sqlCmdInsertDivisions;
                                            funCreateLog($action, $connection);
                                            $db->rollbackAndClose();
                                            die('false||Opps... Problema a inserir divisiões desenho tecnico.');
                                        }
                                    }
                                }
                            }
                        }
                    }
                    // die();
                    //save data
                    echo 'true||Operação realizada com sucesso.';
                    $action = '[ADD_SPEC] - Success';
                    funCreateLog($action, $connection);
                    $db->commitAndClose();
                } else {
                    $action = '[ADD_MODEL] - Failed add  [SQL] - ';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Opps... Problema a inserir modelo.');
                }
            }
        }
    }

function funEditSpec()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateO = "'".date('Y-m-d H:i:s')."'";

    $spec_code = $_REQUEST['specCode'];
    $idCat = $_REQUEST['categories'];
    $idSpecTransCode = $_REQUEST['idSpecTrans'];
    $idSpec = $_REQUEST['idSpec'];
    if (isset($_REQUEST['specDef'])) {
        $defSpec = 1;
    } else {
        $defSpec = 0;
    }

    $sqlUpdTransCode = 'UPDATE tb_translations_codes SET dateU='.$viDateO.", userU='".$usr_id."', code='".$spec_code."'";
    $sqlUpdTransCode .= " WHERE id='".$idSpecTransCode."'";

    if ($result = $connection->query($sqlUpdTransCode)) {
        $sqlUpdSpecCat = 'UPDATE tb_specs SET dateO='.$viDateO.", userO='".$usr_id."', tb_specs.default='".$defSpec."', idTbCategoriesSpecs='".$idCat."'";
        $sqlUpdSpecCat .= " WHERE id='".$idSpec."'";

        if ($result1 = $connection->query($sqlUpdSpecCat)) {
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';

            if ($result2 = $connection->query($sqlCmd)) {
                while ($row1 = mysqli_fetch_assoc($result2)) {
                    $langMin = $row1['langMin'];
                    $langId = $row1['id'];
                    if ($_REQUEST['name_'.$langMin]) {
                        $viName = $_REQUEST['name_'.$langMin];
                    } else {
                        $viName = '';
                    }

                    if ($viName != '') {
                        $viName = funTreatString($viName);

                        $sqlUpdTranslation = 'UPDATE tb_translations SET dateU='.$viDateO.", userU='".$usr_id."', value='".$viName."'";
                        $sqlUpdTranslation .= "WHERE idTbCodeTranslations='".$idSpecTransCode."' AND idTbLanguage='".$langId."'";

                        $result1 = $connection->query($sqlUpdTranslation);

                        if (!$result1) {
                            $action = '[UPDATE_SPEC_TRANS] - Failed';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||ocorreu um problema ao actualizar as traduções da especificação.');
                        }
                    }
                }
                echo 'true||Operação realizada com sucesso.';
                $action = '[UPDATE_SPEC] - Success';
                funCreateLog($action, $connection);
                $db->commitAndClose();
            } else {
                $action = '[UPDATE_SPEC] - Failed';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||ocorreu um problema ao actualizar a especificação.');
            }
        } else {
            $action = '[UPDATE_SPEC] - Failed';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||ocorreu um problema ao actualizar a especificação.');
        }
    } else {
        $action = '[UPDATE_SPEC] - Failed';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||ocorreu um problema ao actualizar a especificação.');
    }
}
