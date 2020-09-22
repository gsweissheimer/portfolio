<?php
    include_once '../../includes/globalVars.php';
    $cmdEval = $_REQUEST['cmdEval'];
    switch ($cmdEval) {
        case 'addtranslaction':
                if ($_REQUEST['bot'] == '') {
                    funAddTranslations();
                } else {
                    die();
                }
                break;
        case 'addFaq':
            if ($_REQUEST['bot'] == '') {
                funAddFAQ();
            } else {
                die();
            }
            break;
        case 'addClinic':
            if ($_REQUEST['bot'] == '') {
                funaddClinic();
            } else {
                die();
            }
            break;
        case 'addVideo':
            if ($_REQUEST['bot'] == '') {
                funaddVideo();
            } else {
                die();
            }
            break;
        case 'addAdvantage':
            if ($_REQUEST['bot'] == '') {
                funAddAdvantage();
            } else {
                die();
            }
            break;
        case 'addNews':
                if ($_REQUEST['bot'] == '') {
                    funaddNews();
                } else {
                    die();
                }
                break;
        case 'addTerms':
            if ($_REQUEST['bot'] == '') {
                funAddTerms();
            } else {
                die();
            }
            break;
        case 'addTermsTag':
        if ($_REQUEST['bot'] == '') {
            funAddTermsTag();
        } else {
            die();
        }
        break;
        case 'addEvent':
            if ($_REQUEST['bot'] == '') {
                funAddEvent();
            } else {
                die();
            }
            break;
        case 'addNameModel':
            if ($_REQUEST['bot'] == '') {
                funAddNameModel();
            } else {
                die();
            }
            break;
        case 'addSpec':
            if ($_REQUEST['bot'] == '') {
                funAddSpec();
            } else {
                die();
            }
            break;
        case 'addpopup':
            if ($_REQUEST['bot'] == '') {
                funAddPopUp();
            } else {
                die();
            }
            break;
        default:
            // code...
            break;
    }

    function funAddPopUp()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;

        $popupname = $_REQUEST['popupname'];
        $formid = $_REQUEST['formid'];
        $formname = $_REQUEST['formname'];
        $popupstartdate = $_REQUEST['popupstartdate'];
        $popupenddate = $_REQUEST['popupenddate'];

        $dateC = date('Y-m-d H:i:s');
        $Backup_Image = '';
        $Backup_Model = '';
        $Backup_Form = $_REQUEST['favcolor'];
        if (isset($_REQUEST['istransparet'])) {
            $Backup_Form = 'none';
        }

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
        } else {
            $flagBackup_Model = false;
        }

        if ($flagBackup_Model && $flagBackup_Image) {
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $sqlCmd = 'INSERT INTO tb_popup_customise(popup_name,dateC,id_form,name_form,back_up,back_modal,back_form, _start_date, finish_date,_status) VALUES ';
            $sqlCmd .= "('".$popupname."','".$dateC."','".$formid."','".$formname."','".$Backup_Image."','".$Backup_Model."','".$Backup_Form."','".$popupstartdate."','".$popupenddate."',1)";

            if ($result = $connection->query($sqlCmd)) {
                $IDtb_popup_customise = $connection->insert_id;
                $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                if ($result = $connection->query($sqlCmd)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $langMin = $row['langMin'];
                        $IdLang = $row['id'];

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
                            $popupsubtitle_modal = $_REQUEST['subtitle_modal_'.$langMin];
                        } else {
                            $popupsubtitle_modal = '';
                        }

                        if ($popuptitle_top != '' && $popuptitle_modal != '' && $popupsubtitle_modal != '') {
                            //file_put_contents('./log_'.date("j.n.Y").'.txt',$popupsubtitle_modal, FILE_APPEND);
                            //$popuptitle_top = funTreatString($popuptitle_top);
                            //$popuptitle_modal = funTreatString($popuptitle_modal);
                            //$popupsubtitle_modal = funTreatString($popupsubtitle_modal);

                            $sqlCmd1 = 'INSERT INTO tb_popup_translation(dateC, title_top, title_modal, subtitle_modal, idTblanguage, idTbpopup';
                            $sqlCmd1 .= ' ) VALUES ';
                            $sqlCmd1 .= "('".$dateC."','$popuptitle_top','$popuptitle_modal','$popupsubtitle_modal','$IdLang','$IDtb_popup_customise')";
                            //file_put_contents('./log_'.date('j.n.Y').'.txt', $sqlCmd1, FILE_APPEND);
                            $result1 = $connection->query($sqlCmd1);
                            if (!$result1) {
                                $action = '[ADD_POPUP] - Failed add  TRANSLATIONs - '.$sqlCmd1;
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Ocorreu um problema ao inserir tradução no Popup');
                            }
                        }
                    }
                }
                $db->commitAndClose();
                echo 'true||Operação realizada com sucesso.';
            } else {
                $db->rollbackAndClose();
                die('false||Oppsss... ocorreu um erro ao inserir!!!.');
            }
        } else {
            echo 'false||Oppsss... ocorreu um erro ao inserir.';
        }
    }

    function funAddTranslations()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $viDateC = "'".date('Y-m-d H:i:s')."'";
        $trans = $_REQUEST['codeTrans'];

        $sqlCmdInsertPre = 'INSERT INTO tb_translations_codes(dateC, userC, dateU, userU, code, deleted) VALUES ';
        $sqlCmdInsertPre .= "($viDateC,$usr_id,$viDateC,$usr_id,'$trans',0)";
        if ($resultPre = $connection->query($sqlCmdInsertPre)) {
            $viIdPre = $connection->insert_id;
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $langMin = $row['langMin'];
                    if ($_REQUEST['translation_'.$langMin]) {
                        $viTitlePre = $_REQUEST['translation_'.$langMin];
                    } else {
                        $viTitlePre = '';
                    }
                    $viTitlePre = funTreatString($viTitlePre);
                    $sqlCmd2 = 'INSERT INTO tb_translations(dateC, userC, dateU, userU, value, deleted, idTbCodeTranslations, idTbLanguage) VALUES ';
                    $sqlCmd2 .= '('.$viDateC.','.$usr_id.', '.$viDateC.','.$usr_id.",'".$viTitlePre."',0,";
                    $sqlCmd2 .= $viIdPre.','.$row['id'].')';
                    if (!$connection->query($sqlCmd2)) {
                        funDeleteImage($target_file);
                        $action = '[ADD_TRANSLATION] - Failed add  [SQL] - '.$sqlCmd2;
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Oppsss... Não foi possivel adicionar traduções');
                    }
                }
                $action = '[ADD_TRANSLATION] - Operation add success';
                funCreateLog($action, $connection);
                echo 'true||Operação realizada com sucesso.';
                $db->commitAndClose();
            }
        } else {
            echo 'false||Código já existente.';
        }
    }

    function funaddClinic()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        include_once '../../includes/globalVars.php';

        $db = Database::getInstance();
        $connection = $db->getConnection();
        $viDateC = "'".date('Y-m-d H:i:s')."'";
        $flagUpload = false;
        $viIdGallery = 'NULL';
        $imageUploadMain = '';
        $clinic = $_REQUEST['clinic'];
        $address = $_REQUEST['address'];
        $zipcode = $_REQUEST['zipcode'];
        $city = $_REQUEST['city'];

        // ADD CLINIC IN Database
        $sqlCmdAddClinic = 'INSERT INTO tb_clinicas (dateC, dateU, clinic, address, zipCode, city, deleted) VALUES';
        $sqlCmdAddClinic .= '('.$viDateC.','.$viDateC.",'".$clinic."','".$address."','".$zipcode."','".$city."', 0)";

        if ($result = $connection->query($sqlCmdAddClinic)) {
            $translate = '';
            $viClinicId = $connection->insert_id;
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Add Clinic descrition translation in database
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
                    $sqlCmdAddClinicTrans = 'INSERT INTO tb_description_translation (dateC, userC, dateU, userU, description,titleAction,cta ,idTbLanguage, idTbClinic) VALUES';
                    $sqlCmdAddClinicTrans .= '('.$viDateC.','.$usr_id.', '.$viDateC.','.$usr_id.",'".$viDescription."','".$viTitleCta."','".$viCta."',".$row['id'].','.$viClinicId.')';
                    if ($connection->query($sqlCmdAddClinicTrans)) {
                        $translate = 1;
                    }
                }

                if ($translate != null) {
                    $name = $_FILES['images']['name']; //Atribui uma array com os nomes dos arquivos Ã  variÃ¡vel
                    $total = count($_FILES['images']['name']);
                    $tmp_name = $_FILES['images']['tmp_name']; //Atribui uma array com os nomes temporÃ¡rios dos arquivos Ã  variÃ¡vel
                    $type = $_FILES['images']['type']; //Atribui uma array com os nomes temporÃ¡rios dos arquivos Ã  variÃ¡vel
                    for ($c = 0; $c < $total; ++$c) {
                        $ext = strtolower(substr($name[$c], -4));
                        $nameFile = date('YmdHis', time()).'_'.$viClinicId;
                        $target_dir = PATH_CLINIC_IMG;
                        //$imageFileTypeMain = pathinfo(basename($name[$c]) , PATHINFO_EXTENSION);
                        $imageFileTypeMain = pathinfo(basename($_FILES['images']['name'][$c]), PATHINFO_EXTENSION);
                        $newTitle = str_replace('/', '-', funCleanString($nameFile));
                        $viNameMain = str_replace(' ', '-', funCleanString($newTitle));
                        $target_file = $target_dir.$viNameMain.'.'.$imageFileTypeMain;
                        $fileTypeOriginal = $type[$c];

                        $imageUploadMain = funSaveImages($fileTypeOriginal, $tmp_name[$c], $target_file, '', '');
                        $viIdGallery = funInsertIntoGallery($viNameMain, $imageFileTypeMain, $connection, $usr_id);
                        // echo "entrei";
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
                            $valuesGalleryClinic .= "($viDateC,'$usr_id',$viDateC,'$usr_id',$viClinicId,$arrayIdGallery[$i])";
                        } else {
                            $valuesGalleryClinic .= ",($viDateC,'$usr_id',$viDateC,'$usr_id',$viClinicId,$arrayIdGallery[$i])";
                        }
                    }

                    $sqlCmdInsertClinicImagesinGallery = 'INSERT INTO tb_clinic_gallery (dateC, userC, dateU, userU';
                    $sqlCmdInsertClinicImagesinGallery .= ', idTbClinic, idTbGallery) VALUES ';
                    $sqlCmdInsertClinicImagesinGallery .= $valuesGalleryClinic;
                    if ($connection->query($sqlCmdInsertClinicImagesinGallery)) {
                        $action = '[ADD_CLINIC] - CLINIC ADDED';
                        funCreateLog($action, $connection);
                        $db->commitAndClose();
                        echo 'true||A clinica foi adicionada com sucesso.';
                    } else {
                        $imgSuccess = 'false';
                        funDeleteImage($target_file);
                        $action = '[ADD_CLINIC] - Failed edit  [SQL] - '.$sqlCmdInsertClinicImagesinGallery;
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Opps... Problema a inserir as imagens na galeria.');
                    }
                } else {
                    $imgSuccess = 'false';
                    funDeleteImage($target_file);
                    $action = '[ADD_CLINIC] - Failed add';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Opps... Problema a inserir a clinica.');
                }
            }
        }
    }

function funaddVideo()
{
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    include_once 'session.php';

    $db = Database::getInstance();
    $connection = $db->getConnection();
    $nome = $_REQUEST['nome'];
    $data = $_REQUEST['data'];
    $url = $_REQUEST['url'];
    $viDateC = "'".date('Y-m-d H:i:s')."'";

    $sqlCmdAddTest = 'INSERT INTO tb_videos (dateO, userO, url, name, dateF, status) VALUES';
    $sqlCmdAddTest .= '('.$viDateC.','.$usr_id.",'".$url."','".$nome."','".$data."', 0)";

    if ($result = $connection->query($sqlCmdAddTest)) {
        $action = '[ADD_VIDEO] - VIDEO ADDED';
        funCreateLog($action, $connection);
        $db->commitAndClose();
        echo 'true||O video foi adicionado com sucesso.';
    } else {
        $action = '[ADD_VIDEO] - ADD VIDEO FAILED';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||Opps... Problema a inserir o video.');
    }
}

function funAddAdvantage()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $advantage = date('Y_m_d_H_i_s');
    $viDateC = "'".date('Y-m-d H:i:s')."'";
    $flagUpload = false;
    $viIdGallery = 'NULL';
    $uploadStatus = '';

    if (isset($_REQUEST['pageType'])) {
        $viPage = $_REQUEST['pageType'];
    } else {
        $viPage = '';
    }
    if (isset($_REQUEST['position'])) {
        $position = $_REQUEST['position'];
    } else {
        $position = '';
    }

    if ($viPage != '') {
        if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['error'] != UPLOAD_ERR_NO_FILE) {
            $target_dir = PATH_ADVANTAGE_IMG;
            $imageFileTypeMain = pathinfo(basename($_FILES['fileToUpload']['name']), PATHINFO_EXTENSION);
            $viNameMain = $advantage.'.'.$imageFileTypeMain;
            $target_file = $target_dir.$viNameMain;
            $fileToUpload = $_FILES['fileToUpload']['tmp_name'];
            $uploadStatus = move_uploaded_file($fileToUpload, '../../'.$target_file);
            // $imageUploadMain = funSaveImages($fileTypeOriginal, $_FILES['fileToUpload']["tmp_name"], $target_file,"", "");
            $flagUpload = true;
        } else {
            $flagUpload = false;
        }
        if ($uploadStatus || !$flagUpload) {
            if ($flagUpload) {
                $viIdGallery = funInsertIntoGallery($advantage, $imageFileTypeMain, $connection, $usr_id);
            }
            if ($viIdGallery != 'NULL' || !$flagUpload) {
                $sqlCmd1 = 'INSERT INTO tb_advantage_main(dateO, userO, position, status, idTbGallery,idTbAdvantageLocation) VALUES ';
                $sqlCmd1 .= "($viDateC, $usr_id, $position, 0, '$viIdGallery', '$viPage')";
                if ($result1 = $connection->query($sqlCmd1)) {
                    $viIdAdvMain = $connection->insert_id;

                    // $inIdlanguage = $_REQUEST['inIdLanguage'];
                    $sqlCmd2 = 'SELECT * FROM tb_language WHERE deleted = 0';
                    if ($result2 = $connection->query($sqlCmd2)) {
                        while ($row = mysqli_fetch_assoc($result2)) {
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
                            $vcTitulo = mysqli_real_escape_string($connection, htmlspecialchars($vcTitulo));
                            $txTexto = mysqli_real_escape_string($connection, htmlspecialchars($txTexto));
                            // $vcTitulo = mysql_escape_string($_REQUEST['vcTitulo']);
                            // $txTexto = mysql_escape_string($_REQUEST['txTexto']);

                            if ($uploadStatus) {
                                $sqlCmd = 'INSERT INTO tb_advantage(dateO, userO, title, description, status, published, idTbLanguage,idTbAdvantageMain) VALUES';
                                $sqlCmd .= "($viDateC, $usr_id, '$vcTitulo','$txTexto',0,1,".$row['id'].",$viIdAdvMain)";
                                $result = $connection->query($sqlCmd);
                                if (!$result) {
                                    $connection->rollback();
                                    $action = '[ADD_ADVANTAGE] - Failed add  [SQL] - '.$sqlCmd;
                                    funCreateLog($action, $connection);
                                    die('false||Oppsss...Ocorreu um problema a inserir Advantage.'.$sqlCmd);
                                }
                            } else {
                                $action = '[ADD_ADVANTAGE] - Failed to add file ';
                                funCreateLog($action, $connection);
                                die('false||Oppsss...Ocorreu um problema a inserir Advantage img.'.$sqlCmd);
                            }
                        }
                    }
                    $connection->commit();
                    $action = '[ADD_ADVANTAGE] - Sucess added #';
                    funCreateLog($action, $connection);
                    echo 'true||Operação realizada com sucesso.';
                } else {
                    $action = '[ADD_FAQ] - Operation failed';
                    funCreateLog($action, $connection);
                    die('false||Oppsss...Ocorreu um problema a inserir Advantages1.'.$sqlCmd1);
                }
            } else {
                $action = '[ADD_SLIDE] - Failed saving image';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||ocorreu um problema ao gravar a imagem.');
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
    }
}

function funAddSlideSimple()
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

    if (isset($_REQUEST['pageType'])) {
        $viPage = $_REQUEST['pageType'];
    } else {
        $viPage = '';
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

    if ($viPage != '') {
        $sqlCmd3 = 'INSERT INTO tb_simple_slide(dateO, userO, status,flagCta,  idTbGallery,idTbSlideLocation) VALUES ';
        $sqlCmd3 .= "($viDateO,$usr_id,0,$viCheckBox,NULL,'$viPage')";

        if ($result3 = $connection->query($sqlCmd3)) {
            $viIdSlide = $connection->insert_id;

            $name = $_FILES['fileToUpload']['name']; //Atribui uma array com os nomes dos arquivos Ã  variÃ¡vel
            $total = count($_FILES['fileToUpload']['name']);
            $tmp_name = $_FILES['fileToUpload']['tmp_name']; //Atribui uma array com os nomes temporÃ¡rios dos arquivos Ã  variÃ¡vel
    $type = $_FILES['fileToUpload']['type']; //Atribui uma array com os nomes temporÃ¡rios dos arquivos Ã  variÃ¡vel
    for ($c = 0; $c < $total; ++$c) {
        $ext = strtolower(substr($name[$c], -4));
        $nameFile = date('YmdHis', time()).'_'.$viIdSlide;
        $target_dir = PATH_SLIDES_IMG;
        //$imageFileTypeMain = pathinfo(basename($name[$c]) , PATHINFO_EXTENSION);
        $imageFileTypeMain = pathinfo(basename($_FILES['fileToUpload']['name'][$c]), PATHINFO_EXTENSION);

        $newTitle = str_replace('/', '-', funCleanString($nameFile));
        $viNameMain = str_replace(' ', '-', funCleanString($newTitle));
        $target_file = $target_dir.$viNameMain.'.'.$imageFileTypeMain;
        $fileTypeOriginal = $type[$c];

        $imageUploadMain = funSaveImages($fileTypeOriginal, $tmp_name[$c], $target_file, '', '');
        $viIdGallery = funInsertIntoGallery($viNameMain, $imageFileTypeMain, $connection, $usr_id);
        // echo "entrei";
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

            $valuesGallerySlide = '';
            for ($i = 0; $i < count($arrayIdGallery); ++$i) {
                if ($valuesGallerySlide == '') {
                    $valuesGallerySlide .= "($viDateO, $usr_id, 0, $viIdSlide, $arrayIdGallery[$i])";
                } else {
                    $valuesGallerySlide .= ",($viDateO, $usr_id, 0, $viIdSlide, $arrayIdGallery[$i])";
                }
            }

            $sqlCmdInsertSlideImagesinGallery = 'INSERT INTO tb_slide_gallery (dateO, userO, status, idTbSlide, idTbGallery) VALUES';
            $sqlCmdInsertSlideImagesinGallery .= $valuesGallerySlide;

            if ($connection->query($sqlCmdInsertSlideImagesinGallery)) {
                //	// $viIdSlide = $connection->insert_id;
                $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                if ($result = $connection->query($sqlCmd)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $langMin = $row['langMin'];
                        $viIdLang = $row['id'];
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
                        if ($_REQUEST['text_slide_'.$langMin]) {
                            $viTextSlide = $_REQUEST['text_slide_'.$langMin];
                        } else {
                            $viTextSlide = '';
                        }
                        if ($_REQUEST['title_slide_'.$langMin]) {
                            $viTitleSlide = $_REQUEST['title_slide_'.$langMin];
                        } else {
                            $viTitleSlide = '';
                        }
                        if ($_REQUEST['description_slide_'.$langMin]) {
                            $viDescriptionSlide = $_REQUEST['description_slide_'.$langMin];
                        } else {
                            $viDescriptionSlide = '';
                        }
                        if ($viTitleSlide != '' && $viDescriptionSlide != '') {
                            $viTitleSlide = funTreatString($viTitleSlide);
                            $viDescriptionSlide = funTreatString($viDescriptionSlide);
                            $viCallTitle = funTreatString($viCallTitle);
                            $viCallAction = funTreatString($viCallAction);
                            $viTitleSlide = funTreatString($viTitleSlide);
                            $sqlCmd1 = 'INSERT INTO tb_simple_slide_translation(dateC, title, subtitle, text, callTitle, callAction,';
                            $sqlCmd1 .= ' deleted, idTbLanguage, idTbSlide) VALUES ';
                            $sqlCmd1 .= "($viDateO,'$viTitleSlide','$viDescriptionSlide','$viTextSlide','$viCallTitle','$viCallAction',";
                            $sqlCmd1 .= "0,$viIdLang,$viIdSlide)";
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
                        $sqlAddModelSlide = 'INSERT INTO tb_models_page (dateO, userO, idTbModel, idTbSlide, idTbBanner) VALUES';
                        $sqlAddModelSlide .= "($viDateO, $usr_id, $viIdModel, $viIdSlide, NULL)";

                        if ($resultBanner = $connection->query($sqlAddModelSlide)) {
                            echo 'true||Operação realizada com sucesso.';
                            $action = '[ADD_SLIDE] - Success adding slide';
                            funCreateLog($action, $connection);
                            $db->commitAndClose();
                        } else {
                            if ($flagUpload) {
                                funDeleteImage($target_file);
                            }
                            $action = '[ADD_SLIDE] - Failed to add banner to model';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Ocorreu um erro ao tentar adicionar o banner ao modelo.');
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
            }
        }
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

    if (isset($_REQUEST['pageType'])) {
        $viPageType = $_REQUEST['pageType'];
    } else {
        $viPageType = '';
    }

    if ($viPageType != '') {
        $sqlCmd = 'INSERT INTO tb_seo (dateC, deleted, idTbTypePage) VALUES ';
        $sqlCmd .= "($viDateC,0,'$viPageType')";

        if ($result = $connection->query($sqlCmd)) {
            $viIdSEO = $connection->insert_id;

            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($_REQUEST['key_'.$row['langMin']]) {
                        $viKeyword = $_REQUEST['key_'.$row['langMin']];
                    } else {
                        $viKeyword = '';
                    }
                    if ($_REQUEST['desc_'.$row['langMin']]) {
                        $viDesc = $_REQUEST['desc_'.$row['langMin']];
                    } else {
                        $viDesc = '';
                    }
                    $viKeyword = mysqli_real_escape_string($connection, htmlspecialchars($viKeyword));
                    $viDesc = mysqli_real_escape_string($connection, htmlspecialchars($viDesc));
                    $sqlCmd2 = 'INSERT INTO tb_seo_translations(dateC, description, keywords, idTbSEO, idTbLanguage) VALUES';
                    $sqlCmd2 .= '('.$viDateC.",'".$viDesc."','".$viKeyword."',".$viIdSEO.','.$row['id'].')';
                    if (!$connection->query($sqlCmd2)) {
                        $connection->rollback();
                        $action = '[ADD_SEO] - Failed add  [SQL] - '.$sqlCmd2;
                        funCreateLog($action, $connection);
                        die('false');
                    }
                }
            }
            $connection->commit();
            //funCreateSessionsError("FAQ","Operação realizada com sucesso!","success");
            $action = '[ADD_SEO] - Operation add success';
            funCreateLog($action, $connection);
            echo 'true||Operação realizada com sucesso.';
        } else {
            $action = '[ADD_SEO] - Operation failed';
            funCreateLog($action, $connection);
            die("false||Oppsss...Ocorreu um problema a inserir seo's.".$sqlCmd);
        }
    } else {
        $action = '[ADD_FAQ] - FAIL : Type Page not selected';
        funCreateLog($action, $connection);
        echo 'false||Oppsss... não foi escolhido o tipo de página.';
    }
}

function funAddBanner()
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
    $postion = $_REQUEST['position'];

    if (isset($_REQUEST['pageType'])) {
        $viPage = $_REQUEST['pageType'];
    } else {
        $viPage = '';
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

    if ($viPage != '') {
        $sqlCmd3 = 'INSERT INTO tb_banner(dateO, userO, position, status,flagCta, idTbGallery,idTbBannerLocal) VALUES ';
        $sqlCmd3 .= "($viDateC, $usr_id, $postion,0,$viCheckBox,NULL,'$viPage')";

        if ($result3 = $connection->query($sqlCmd3)) {
            $viIdSlide = $connection->insert_id;

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
                if ($viIdGallery != 'NULL' || !$flagUpload) {
                    $sqlCmd = "UPDATE tb_banner SET idTbGallery=$viIdGallery WHERE id = $viIdSlide";

                    if ($connection->query($sqlCmd)) {
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
                            if ($viIdGallery != 'NULL' || !$flagUpload) {
                                $sqlCmd = "UPDATE tb_banner SET idTbGallery=$viIdGallery WHERE id = $viIdSlide";

                                if ($connection->query($sqlCmd)) {
                                    // $viIdSlide = $connection->insert_id;
                                    $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                                    if ($result = $connection->query($sqlCmd)) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $langMin = $row['langMin'];
                                            $viIdLang = $row['id'];
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
                                            if ($_REQUEST['title_banner_'.$langMin]) {
                                                $viTitleBanner = $_REQUEST['title_banner_'.$langMin];
                                            } else {
                                                $viTitleBanner = '';
                                            }
                                            if ($_REQUEST['description_banner_'.$langMin]) {
                                                $viDescriptionBanner = $_REQUEST['description_banner_'.$langMin];
                                            } else {
                                                $viDescriptionBanner = '';
                                            }
                                            if ($viCallAction != '' && $viCallTitle != '' && $viTextBanner != '' && $viTitleBanner != '' && $viDescriptionBanner != '') {
                                                $viTitleBanner = funTreatString($viTitleBanner);
                                                $viDescriptionBanner = funTreatString($viDescriptionBanner);
                                                $viTextBanner = funTreatString($viTextBanner);
                                                $viSubTextBanner = funTreatString($viSubTextBanner);
                                                $viCallAction = funTreatString($viCallAction);
                                                $viTitleBanner = funTreatString($viTitleBanner);
                                                $sqlCmd1 = 'INSERT INTO tb_banner_translation(dateC, title, subtitle, text, subText, callTitle, callAction,';
                                                $sqlCmd1 .= ' deleted, idTbLanguage, idTbBanner) VALUES ';
                                                $sqlCmd1 .= "($viDateC,'$viTitleBanner','$viDescriptionBanner','$viTextBanner','$viSubTextBanner','$viCallTitle','$viCallAction',";
                                                $sqlCmd1 .= "0,$viIdLang,$viIdSlide)";
                                                // echo $sqlCmd1;
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
                                            $sqlAddBannerModel = 'INSERT INTO tb_models_page (dateO, userO, idTbModel, idTbSlide, IdTbBanner) VALUES';
                                            $sqlAddBannerModel .= "($viDateC, $usr_id, $viIdModel, NULL, $viIdSlide)";

                                            if ($resultBanner = $connection->query($sqlAddBannerModel)) {
                                                echo 'true||Operação realizada com sucesso.';
                                                $action = '[ADD_BANNER] - Success adding banner to model';
                                                funCreateLog($action, $connection);
                                                $db->commitAndClose();
                                            } else {
                                                $action = '[ADD_BANNER] - Failed insertin model';
                                                funCreateLog($action, $connection);
                                                $db->rollbackAndClose();
                                                die('false||Ocorreu um erro ao gravar o modelo associado.');
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
                                    $action = '[ADD_SLIDE] - Failed inserting slide';
                                    funCreateLog($action, $connection);
                                    $db->rollbackAndClose();
                                    die('false||Ocorreu um erro ao inserir slide');
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
                        }
                    } else {
                        if ($flagUpload) {
                            funDeleteImage($target_file);
                        }
                        $action = '[ADD_SLIDE] - Failed inserting slide';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Ocorreu um erro ao inserir slide');
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
                $action = '[ADD_SLIDE] - Failed saving image';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||ocorreu um problema ao gravar a imagem.');
            }
        }
    }
}

function funAddFAQ()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateO = "'".date('Y-m-d H:i:s')."'";

    // if(isset($_REQUEST['pageType'])){$viPageType = $_REQUEST['pageType'];}else{$viPageType = "";}

    if (isset($_REQUEST['pageType'])) {
        $viTitle = $_REQUEST['pageType'];
    } else {
        $viTitle = '';
    }

    if ($viTitle != '') {
        $sqlCmd = 'INSERT INTO tb_faqs(dateO, userO, deleted, idTbFaqsTitle) VALUES ';
        $sqlCmd .= "($viDateO,'$usr_id',0,'$viTitle')";
        // echo $sqlCmd;

        // $sqlCmd = "INSERT INTO tb_faqs(dateC, userC, dateU, userU, deleted, idTbTypePage) VALUES ";
        // $sqlCmd .= "($viDateC,'$usr_id',$viDateC,'$usr_id',0,'$viPageType')";

        if ($result = $connection->query($sqlCmd)) {
            $viIdFaq = $connection->insert_id;

            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($_REQUEST['question_'.$row['langMin']]) {
                        $viQuestion = $_REQUEST['question_'.$row['langMin']];
                    } else {
                        $viQuestion = '';
                    }
                    if ($_REQUEST['desc_'.$row['langMin']]) {
                        $viDesc = $_REQUEST['desc_'.$row['langMin']];
                    } else {
                        $viDesc = '';
                    }
                    $viQuestion = mysqli_real_escape_string($connection, htmlspecialchars($viQuestion));
                    $viDesc = mysqli_real_escape_string($connection, htmlspecialchars($viDesc));
                    $sqlCmd2 = 'INSERT INTO tb_faqs_translations(dateO, userO, questionFaq, answerFaq, idTbLanguage, idTbFaq) VALUES';
                    $sqlCmd2 .= '('.$viDateO.','.$usr_id.",'".$viQuestion."','".$viDesc."',".$row['id'].','.$viIdFaq.')';
                    if (!$connection->query($sqlCmd2)) {
                        $connection->rollback();
                        $action = '[ADD_FAQ] - Failed add  [SQL] - '.$sqlCmd2;
                        funCreateLog($action, $connection);
                        die('false');
                    }
                }
            }
            $connection->commit();
            //funCreateSessionsError("FAQ","Operação realizada com sucesso!","success");
            $action = '[ADD_FAQ] - Operation add success';
            funCreateLog($action, $connection);
            echo 'true||Operação realizada com sucesso.';
        } else {
            $action = '[ADD_FAQ] - Operation failed';
            funCreateLog($action, $connection);
            die('false||Oppsss...Ocorreu um problema a inserir faqs.'.$sqlCmd);
        }
    } else {
        $action = '[ADD_FAQ] - FAIL : Type Page not selected';
        funCreateLog($action, $connection);
        echo 'false||Oppsss... não foi escolhido o tipo de página.';
    }
}

    function funAddTerms()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $viDateO = "'".date('Y-m-d H:i:s')."'";
        if (isset($_COOKIE['usr_id'])) {
            $usr_id = $_COOKIE['usr_id'];
        } else {
            $usr_id = '';
        }
        if (isset($_REQUEST['pageType'])) {
            $viPage = $_REQUEST['pageType'];
        } else {
            $viPage = '';
        }

        if ($viPage != '') {
            $sqlCmd3 = 'INSERT INTO tb_terms( dateO , userO, deleted, idTbTermsLocation) VALUES ';
            $sqlCmd3 .= "($viDateO,$usr_id,0,'$viPage')";

            if ($result3 = $connection->query($sqlCmd3)) {
                $viIdTerms = $connection->insert_id;
                $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                if ($result = $connection->query($sqlCmd)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $langMin = $row['langMin'];
                        $viIdLang = $row['id'];
                        if ($_REQUEST['text_terms_'.$langMin]) {
                            $viTextTerms = $_REQUEST['text_terms_'.$langMin];
                        } else {
                            $viTextTerms = '';
                        }
                        if ($_REQUEST['title_terms_'.$langMin]) {
                            $viTitleTerms = $_REQUEST['title_terms_'.$langMin];
                        } else {
                            $viTitleTerms = '';
                        }
                        if ($viTextTerms != '' && $viTitleTerms != '') {
                            $viCallAction = funTreatString($viTextTerms);
                            $viTitleBanner = funTreatString($viTitleTerms);
                            $sqlCmd1 = 'INSERT INTO tb_terms_translation(dateO, userO, title, text,';
                            $sqlCmd1 .= '  idTbLanguage, idTbTerms) VALUES ';
                            $sqlCmd1 .= "($viDateO,'$usr_id','$viTitleTerms','$viTextTerms',";
                            $sqlCmd1 .= "$viIdLang,$viIdTerms)";
                            // echo $sqlCmd1;
                            $result1 = $connection->query($sqlCmd1);
                            if (!$result1) {
                                if ($flagUpload) {
                                    funDeleteImage($target_file);
                                }
                                $action = '[ADD_TERMS] - Failed add  TRANSLATIONs - '.$sqlCmd1;
                                funCreateLog($action, $connection);
                                $db->rollbackAndClose();
                                die('false||Ocorreu um problema ao inserir tradução');
                            }
                        } else {
                            if ($flagUpload) {
                                funDeleteImage($target_file);
                            }
                            $action = '[ADD_TERMS] - Failed values empty';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Alguns valores encontram-se vazios');
                        }
                    }
                    echo 'true||Operação realizada com sucesso.';
                    $action = '[ADD_TERMS] - Success adding slide';
                    funCreateLog($action, $connection);
                    $db->commitAndClose();
                } else {
                    if ($flagUpload) {
                        funDeleteImage($target_file);
                    }
                    $action = '[ADD_TERMS] - Failed no languages selected';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||NENHUMA LINGUA SELECIONADA');
                }
            }
        } else {
            $action = '[ADD_TERMS] - Failed saving Page';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||ocorreu um problema ao gravar a pagina.');
        }
    }

    function funAddTermsTag()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $viDateO = "'".date('Y-m-d H:i:s')."'";
        $viPage = $_REQUEST['page'];
        if (isset($_COOKIE['usr_id'])) {
            $usr_id = $_COOKIE['usr_id'];
        } else {
            $usr_id = '';
        }

        $sqlCmd1 = "SELECT count(*) AS count FROM tb_terms_location WHERE page='$viPage' AND deleted= 0";

        if ($result1 = $connection->query($sqlCmd1)) {
            $row = mysqli_fetch_array($result1);
            $row_cnt = $row['count'];
            // while($row = mysqli_fetch_assoc($result1)){
            if ($viPage != '' && $row_cnt == 0) {
                $sqlCmd = 'INSERT INTO tb_terms_location( dateO, userO, page, deleted) VALUES';
                $sqlCmd .= "($viDateO,$usr_id,'$viPage',0)";
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
                    die('false||Oppsss... ocorreu um erro ao inserir.');
                }
            } else {
                $action = '[ADD_TAG] - Failed values came empty';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||Oppsss...alguns valores estão vazios ou id ja existente.');
            }
        }
    }

    function funaddNews()
    {
        include_once 'session.php';
        include_once 'utils.php';
        include_once PATH_DATABASE_INC;
        include_once '../../includes/globalVars.php';

        $db = Database::getInstance();
        $connection = $db->getConnection();
        $viDateC = "'".date('Y-m-d H:i:s')."'";
        $flagUpload = false;
        $viIdGallery = 'NULL';
        $imageUploadMain = '';
        $font = $_REQUEST['font'];
        $newsdate = "'".date('Y-m-d')."'";
        $fontCTA = $_REQUEST['fontCta'];

        // ADD CLINIC IN Database
        $sqlCmdAddClinic = 'INSERT INTO tb_news (dateO, userO, font, date, url, status) VALUES';
        $sqlCmdAddClinic .= '('.$viDateC.','.$usr_id.",'".$font."',".$newsdate.",'".$fontCTA."', 0)";

        if ($result = $connection->query($sqlCmdAddClinic)) {
            $translate = '';
            $viNewsId = $connection->insert_id;
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Add Clinic descrition translation in database
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

                    $viText = mysqli_real_escape_string($connection, htmlspecialchars($viText));
                    $viCallAction = mysqli_real_escape_string($connection, htmlspecialchars($viCallAction));
                    $viCallTitle = mysqli_real_escape_string($connection, htmlspecialchars($viCallTitle));
                    $sqlCmdAddClinicTrans = 'INSERT INTO tb_news_translation (dateO, userO, title,text,callTitle,callAction ,status ,idTbNews, idTbLanguage) VALUES';
                    $sqlCmdAddClinicTrans .= '('.$viDateC.','.$usr_id.", '".$viTitle."','".$viText."','$viCallTitle','$viCallAction',0,".$viNewsId.','.$row['id'].')';

                    if ($connection->query($sqlCmdAddClinicTrans)) {
                        $translate = 1;
                    }
                }
                if ($translate != null) {
                    $name = $_FILES['image']['name']; //Atribui uma array com os nomes dos arquivos Ã  variÃ¡vel
                    $total = count($_FILES['image']['name']);
                    $tmp_name = $_FILES['image']['tmp_name']; //Atribui uma array com os nomes temporÃ¡rios dos arquivos Ã  variÃ¡vel
    $type = $_FILES['image']['type']; //Atribui uma array com os nomes temporÃ¡rios dos arquivos Ã  variÃ¡vel

        $ext = strtolower(substr($name, -4));
                    $nameFile = date('YmdHis', time()).'_'.$viNewsId;
                    $target_dir = PATH_NEWS_IMG;
                    //$imageFileTypeMain = pathinfo(basename($name[$c]) , PATHINFO_EXTENSION);
                    $imageFileTypeMain = pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);

                    $newTitle = str_replace('/', '-', funCleanString($nameFile));
                    $viNameMain = str_replace(' ', '-', funCleanString($newTitle));
                    $target_file = $target_dir.$viNameMain.'.'.$imageFileTypeMain;
                    $fileTypeOriginal = $type;

                    $imageUploadMain = funSaveImages($fileTypeOriginal, $tmp_name, $target_file, '', '');
                    $viIdGallery = funInsertIntoGallery($viNameMain, $imageFileTypeMain, $connection, $usr_id);
                    // echo "entrei";
                    if ($viIdGallery != 'NULL') {
                        $arrayIdGallery[] = $viIdGallery;
                        sleep(1);
                    } else {
                        $action = '[ADD_CLINIC_IMG] - Problem insert image ';
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Oppss... Ocorreu um problema ao gravar a imagem.');
                    }

                    $valuesGalleryClinic = '';
                    for ($i = 0; $i < count($arrayIdGallery); ++$i) {
                        if ($valuesGalleryClinic == '') {
                            $valuesGalleryClinic .= "($viDateC,'$usr_id',$viNewsId,$arrayIdGallery[$i])";
                        } else {
                            $valuesGalleryClinic .= ",($viDateC,'$usr_id',$viNewsId,$arrayIdGallery[$i])";
                        }
                    }

                    $sqlCmdInsertClinicImagesinGallery = 'INSERT INTO tb_news_gallery (dateO, userO,';
                    $sqlCmdInsertClinicImagesinGallery .= 'idTbNews, idTbGallery) VALUES ';
                    $sqlCmdInsertClinicImagesinGallery .= $valuesGalleryClinic;
                    if ($connection->query($sqlCmdInsertClinicImagesinGallery)) {
                        $action = '[ADD_NEWS] - NEWS ADDED';
                        funCreateLog($action, $connection);
                        $db->commitAndClose();
                        echo 'true||A notícia foi adicionada com sucesso.';
                    } else {
                        $imgSuccess = 'false';
                        funDeleteImage($target_file);
                        $action = '[ADD_NEWS] - Failed edit  [SQL] - '.$sqlCmdInsertClinicImagesinGallery;
                        funCreateLog($action, $connection);
                        $db->rollbackAndClose();
                        die('false||Opps... Problema a inserir as imagens na galeria.');
                    }
                } else {
                    $imgSuccess = 'false';
                    funDeleteImage($target_file);
                    $action = '[ADD_NEWS] - Failed add';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Opps... Problema a inserir a notícia.');
                }
            }
        }
    }

function funAddEvent()
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
    $imageUploadMain = '';
    $viIdGallery = 'NULL';
    $translate = 0;

    // ADD Event IN Database
    $sqlCmdAddEvent = 'INSERT INTO tb_events (dateO, userO, eventDate, status, idTbTransCode, idTbGallery) VALUES';
    $sqlCmdAddEvent .= '('.$viDateC.','.$usr_id.",'".$eventDate."',0 ,'".$transCode."',$viIdGallery)";

    if ($result1 = $connection->query($sqlCmdAddEvent)) {
        $viIdEvent = $connection->insert_id;

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
            if ($viIdGallery != 'NULL' || !$flagUpload) {
                $sqlCmd1 = "UPDATE tb_events SET idTbGallery=$viIdGallery WHERE id = $viIdEvent";

                if ($result = $connection->query($sqlCmd1)) {
                    $translate = '';
                    // $viEventId = $connection->insert_id;
                    $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
                    if ($result = $connection->query($sqlCmd)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Add Clinic descrition translation in database
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

                            $viCallAction = mysqli_real_escape_string($connection, htmlspecialchars($viCallAction));
                            $viCallTitle = mysqli_real_escape_string($connection, htmlspecialchars($viCallTitle));

                            $viText = mysqli_real_escape_string($connection, htmlspecialchars($viText));
                            $sqlCmdAddEventTrans = 'INSERT INTO tb_events_translation (dateO, userO, title, text,callTitle,callAction, idTbLanguage, idTbEvents) VALUES';
                            $sqlCmdAddEventTrans .= '('.$viDateC.','.$usr_id.",'".$viTitle."','".$viText."','$viCallTitle','$viCallAction',".$row['id'].",$viIdEvent)";
                            echo $sqlCmdAddEventTrans;

                            if ($connection->query($sqlCmdAddEventTrans)) {
                                $translate = 1;
                            }
                        }

                        if ($translate == 1) {
                            $action = '[ADD_EVENT] - EVENT ADDED';
                            funCreateLog($action, $connection);
                            $db->commitAndClose();
                            echo 'true||O Evento foi adicionado com sucesso.';
                        } else {
                            $action = '[ADD_EVENT] - Failed added';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||Opps... Problema a inserir as traduções do evento.');
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
                    $action = '[ADD_SLIDE] - Failed saving image';
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||ocorreu um problema ao gravar a imagem.');
                }
            }
        } else {
            $action = '[ADD_EVENT] - Failed add';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||Opps... Problema a inserir o evento.');
        }
    }
}

    function funAddNameModel()
    {
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
        $sqlCmdAddTechDrawOpt = '';
        $total = $_REQUEST['total'];
        $total1 = $_REQUEST['total1'];
        $postion = $_REQUEST['position'];
        $imageFileTypeMainPlanta = 'NULL';
        //insert model main
        $sqlCmdAddNameModel = 'INSERT INTO tb_models(dateO,userO,name,tb_models.default,position,deleted) VALUES';
        $sqlCmdAddNameModel .= "($viDateO,$usr_id,'$name','$default',$postion,0)";
        if ($resultModel = $connection->query($sqlCmdAddNameModel)) {
            $viIdModel = $connection->insert_id;
            //insert model descriptions by language
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
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
                        $newTitle = date('Y_m_d_H_i_s');
                        $valueExt = $newTitle.'.'.$imageFileTypeMain;
                        $target_file = '../../'.$target_dir.$valueExt;
                        $imageUploadMain = move_uploaded_file($_FILES['fileToUpload_'.$langMin]['tmp_name'], $target_file);
                        $flagUpload = true;
                    } else {
                        $flagUpload = false;
                    }
                    if ($imageUploadMain || !$flagUpload) {
                        if ($flagUpload) {
                            $viIdPdf = funInsertIntoPdf($valueExt, $token, $viDateO, $viIdLang, $connection, $usr_id);
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

                        if ($viDescription != '' && $viKeywords != '' && $viDescriptionSeo != '') {
                            $viDescription = funTreatString($viDescription);
                            $viKeywords = funTreatString($viKeywords);
                            $viDescriptionSeo = funTreatString($viDescriptionSeo);
                            $sqlCmd1 = 'INSERT INTO tb_models_translation(dateO,userO,description, keywordsSeo, descriptionSeo, ';
                            $sqlCmd1 .= ' idTbLanguage, idTbModels,idTbPdf) VALUES ';
                            $sqlCmd1 .= "($viDateO,'$usr_id','$viDescription','$viKeywords','$viDescriptionSeo',";
                            $sqlCmd1 .= "$viIdLang,$viIdModel,$viIdPdf)";
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

            //insert specs
            $specsValues = '';
            for ($i = 1; $i <= $total; ++$i) {
                // $category = $_REQUEST['pageType_'.$i];
                $spec = $_REQUEST['pageType1_'.$i];
                $value = $_REQUEST['valueModel_'.$i];

                if ($i != $total) {
                    $specsValues .= "($viDateO,'$usr_id',0,'$value',$viIdModel,$spec),";
                } else {
                    $specsValues .= "($viDateO,'$usr_id',0,'$value',$viIdModel,$spec)";
                }
            }
            if ($specsValues != '') {
                $sqlSpecs = 'INSERT INTO tb_models_specs(dateO, userO, status,value, idTbModels, idTbSpec) VALUES '.$specsValues;
                // echo $sqlSpecs;
                if (!$connection->query($sqlSpecs)) {
                    $action = '[ADD_MODEL] - Failed add model specs [SQL] - '.$sqlSpecs;
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Opps... Problema a inserir specs modelo.');
                }
            }

            //insert images model
            $arrayImagesToUpload = array();
            if (isset($_FILES['fileToUploadVolu']) && !empty($_FILES['fileToUploadVolu']['name']) && $_FILES['fileToUploadVolu']['error'] != UPLOAD_ERR_NO_FILE) {
                $target_dir = PATH_MODELS_GALLERY_IMG;
                $imageFileTypeMain = pathinfo(basename($_FILES['fileToUploadVolu']['name']), PATHINFO_EXTENSION);
                $newTitle = date('Y_m_d_H_i_s');
                $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
                $fileTypeOriginal = $_FILES['fileToUploadVolu']['type'];
                $imageUploadMainVol = funSaveImages($fileTypeOriginal, $_FILES['fileToUploadVolu']['tmp_name'], $target_file, '', '');
                $flagUploadVolum = true;
            } else {
                $flagUploadVolum = false;
            }

            if ($imageUploadMainVol || !$flagUploadVolum) {
                if ($flagUploadVolum) {
                    $viIdGalleryVol = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
                    array_push($arrayImagesToUpload, "($viDateO,$usr_id,'Volumetrica',0,$viIdModel,$viIdGalleryVol)");
                }
            }
            sleep(1);
            if (isset($_FILES['fileToUploadReal']) && !empty($_FILES['fileToUploadReal']['name']) && $_FILES['fileToUploadReal']['error'] != UPLOAD_ERR_NO_FILE) {
                $target_dir = PATH_MODELS_GALLERY_IMG;
                $imageFileTypeMain = pathinfo(basename($_FILES['fileToUploadReal']['name']), PATHINFO_EXTENSION);
                $newTitle = date('Y_m_d_H_i_s');
                $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
                $fileTypeOriginal = $_FILES['fileToUploadReal']['type'];
                $imageUploadMainReal = funSaveImages($fileTypeOriginal, $_FILES['fileToUploadReal']['tmp_name'], $target_file, '', '');
                $flagUploadReal = true;
            } else {
                $flagUploadReal = false;
            }

            if ($imageUploadMainReal || !$flagUploadReal) {
                if ($flagUploadReal) {
                    $viIdGalleryReal = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
                    array_push($arrayImagesToUpload, "($viDateO,$usr_id,'Real',0,$viIdModel,$viIdGalleryReal)");
                }
            }
            sleep(1);
            if (isset($_FILES['fileToUploadHead']) && !empty($_FILES['fileToUploadHead']['name']) && $_FILES['fileToUploadHead']['error'] != UPLOAD_ERR_NO_FILE) {
                $target_dir = PATH_MODELS_GALLERY_IMG;
                $imageFileTypeMain = pathinfo(basename($_FILES['fileToUploadHead']['name']), PATHINFO_EXTENSION);
                $newTitle = date('Y_m_d_H_i_s');
                $target_file = $target_dir.$newTitle.'.'.$imageFileTypeMain;
                $fileTypeOriginal = $_FILES['fileToUploadHead']['type'];
                $imageUploadMainHead = funSaveImages($fileTypeOriginal, $_FILES['fileToUploadHead']['tmp_name'], $target_file, '', '');
                $flagUploadHead = true;
            } else {
                $flagUploadHead = false;
            }

            if ($imageUploadMainHead || !$flagUploadHead) {
                if ($flagUploadHead) {
                    $viIdGalleryHead = funInsertIntoGallery($newTitle, $imageFileTypeMain, $connection, $usr_id);
                    array_push($arrayImagesToUpload, "($viDateO,$usr_id,'Header',0,$viIdModel,$viIdGalleryHead)");
                }
            }
            $countImages = count($arrayImagesToUpload);
            if ($countImages > 0) {
                $sqlModelsGallery = 'INSERT INTO tb_models_gallery(dateO, userO, styleImg, status, idTbModels, idTbGallery) VALUES ';
                for ($c = 0; $c < $countImages; ++$c) {
                    if ($c == 0) {
                        $sqlModelsGallery .= $arrayImagesToUpload[$c];
                    } else {
                        $sqlModelsGallery .= ','.$arrayImagesToUpload[$c];
                    }
                }
                if (!$connection->query($sqlModelsGallery)) {
                    $action = '[ADD_MODEL] - Failed add images models [SQL] - '.$sqlModelsGallery;
                    funCreateLog($action, $connection);
                    $db->rollbackAndClose();
                    die('false||Opps... Problema a inserir imagens modelos.');
                }
            }

            //insert technical draw
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
                        $sqlCmdAddTechDraw .= "($viDateO,'$usr_id',0,$viIdGalleryFloor,$floor,$viIdModel)";
                        // echo $sqlCmdAddTechDraw;
                        if ($resultTechDraw = $connection->query($sqlCmdAddTechDraw)) {
                            sleep(1);
                            $viIdTechDraw = $connection->insert_id;
                            $valuesDrawDiv = '';
                            for ($d = 0; $d < count($division); ++$d) {
                                $viIdDivision = explode('|', $division[$d]);
                                $viIdDivision = $viIdDivision[0];
                                if ($d == 0) {
                                    $valuesDrawDiv .= "($viDateO,$usr_id,$viIdTechDraw, $viIdDivision)";
                                } else {
                                    $valuesDrawDiv .= ",($viDateO,$usr_id,$viIdTechDraw, $viIdDivision)";
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
            // die();
            //save data
            echo 'true||Operação realizada com sucesso.';
            $action = '[ADD_SPEC] - Success';
            funCreateLog($action, $connection);
            $db->commitAndClose();
        } else {
            $action = '[ADD_MODEL] - Failed add  [SQL] - '.$sqlCmdAddNameModel;
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||Opps... Problema a inserir modelo.'.$sqlCmdAddNameModel);
        }
    }

function funAddSpec()
{
    include_once 'session.php';
    include_once 'utils.php';
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $viDateO = "'".date('Y-m-d H:i:s')."'";

    $spec_code = $_REQUEST['specCode'];
    $idCat = $_REQUEST['categories'];

    if (isset($_REQUEST['specDef'])) {
        $defSpec = 1;
    } else {
        $defSpec = 0;
    }

    $sqlAddTransCode = 'INSERT INTO tb_translations_codes (dateC, userC, dateU, userU, code, deleted) VALUES';
    $sqlAddTransCode .= '('.$viDateO.", '".$usr_id."',".$viDateO.",'".$usr_id."','".$spec_code."',0)";

    if ($result = $connection->query($sqlAddTransCode)) {
        $viSpecTransCode = $connection->insert_id;

        $sqlAddSpec = 'INSERT INTO tb_specs (dateO, userO, tb_specs.default, status, idTbCategoriesSpecs, idTbTransCodes) VALUES';
        $sqlAddSpec .= '('.$viDateO.",'".$usr_id."','".$defSpec."',0,'".$idCat."','".$viSpecTransCode."')";

        if ($result1 = $connection->query($sqlAddSpec)) {
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result2 = $connection->query($sqlCmd)) {
                while ($row1 = mysqli_fetch_assoc($result2)) {
                    $langMin = $row1['langMin'];

                    if ($_REQUEST['name_'.$langMin]) {
                        $viName = $_REQUEST['name_'.$langMin];
                    } else {
                        $viName = '';
                    }

                    if ($viName != '') {
                        $viName = funTreatString($viName);
                        $sqlAddTranslation = 'INSERT INTO tb_translations (dateC, userC, dateU, userU, value,';
                        $sqlAddTranslation .= 'deleted, idTbCodeTranslations, idTbLanguage) VALUES';
                        $sqlAddTranslation .= '('.$viDateO.",'".$usr_id."',".$viDateO.",'".$usr_id."','".$viName."'";
                        $sqlAddTranslation .= ",0,'".$viSpecTransCode."','".$row1['id']."')";

                        $result1 = $connection->query($sqlAddTranslation);

                        if (!$result1) {
                            $action = '[ADD_SPEC_TRANS] - Failed';
                            funCreateLog($action, $connection);
                            $db->rollbackAndClose();
                            die('false||ocorreu um problema ao adicionar as traduções da especificação.');
                        }
                    }
                }
                echo 'true||Operação realizada com sucesso.';
                $action = '[ADD_SPEC] - Success';
                funCreateLog($action, $connection);
                $db->commitAndClose();
            } else {
                $action = '[ADD_SPEC] - Failed';
                funCreateLog($action, $connection);
                $db->rollbackAndClose();
                die('false||ocorreu um problema ao adicionar a especificação.');
            }
        } else {
            $action = '[ADD_SPEC] - Failed';
            funCreateLog($action, $connection);
            $db->rollbackAndClose();
            die('false||ocorreu um problema ao adicionar a especificação.');
        }
    } else {
        $action = '[ADD_SPEC] - Failed';
        funCreateLog($action, $connection);
        $db->rollbackAndClose();
        die('false||ocorreu um problema ao adicionar a especificação.');
    }
}
