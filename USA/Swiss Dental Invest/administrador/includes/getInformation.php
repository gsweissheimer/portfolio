<?php
        include_once '../../includes/globalVars.php';
        include_once 'utils.php';
        $cmdEval = $_REQUEST['cmdEval'];
        switch ($cmdEval) {
            case 'getTranslations':
                funCreateListTranslations();
                break;
            case 'getTranslationsNew':
                funCreateListTranslationsNew();
                break;
            case 'getTranslationsEdit':
                funCreateListTranslationsEdit();
                break;
            case 'getAbout':
                funCreateAbout();
                break;
            case 'getFaqsNew':
                funCreateFaqsNew();
                break;
            case 'getClinics':
                funGetClinics();
                break;
            case 'getClinicNew':
                funGetClinicNew();
                break;
            case 'getSlidesEdit':
                funGetSlidesEdit();
                break;
            case 'getClinicView':
                funGetClinicInfo();
                break;
            case 'getVideos':
                funGetVideos();
                break;
            case 'getVideoInfo':
                funGetVideoInfo();
                break;
            case 'getAdvantage':
                funCreateAdvantage();
                break;
            case 'getAdvantageNew':
                funCreateAdvantageNew();
                break;
            case 'getAdvantageEdit':
                funCreateAdvantageEdit();
                break;
            case 'getSlideSimpleNew':
                funGetSlidesSimpleNew();
                break;
            case 'getSlideSimpleEdit':
                funGetSlidesSimpleEdit();
                break;
            case 'getBannerEdit':
                funGetBannerEdit();
                break;
            case 'getClinicEdit':
                funGetClinicEdit();
                break;
            case 'getTitleFaqs':
                funCreateTitleFaqs();
                break;
            case 'getTitleFaqEdit':
                funCreateTitleFaqEdit();
                break;
            case 'getNewsNew':
                funGetNewsNew();
                break;
            case 'getNewsEdit':
                funGetNewsEdit();
                break;
            case 'ModalTrans':
                funGetModalTrans();
                break;
            case 'eventInfo':
                funGetEventInfo();
                break;
            case 'getModel':
                funGetModel();
                break;
            case 'getModelNew':
                funGetModelNew();
                break;
            case 'getModelEdit':
                funGetModelEdit();
                break;
            case 'getNameModel':
                  funGetNameModel();
                  break;
            case 'getTermsNew':
                funGetTermsNew();
                break;
            case 'getTermsEdit':
                funGetTermsEdit();
                break;
            case 'specNew':
                funGetNewSpecAtr();
                break;
            case 'getSpecs':
                funGetSpecs();
                break;
            case 'getSpec':
                funGetSpec();
                break;

            case 'getPopupNew':
                funGetPopupNew();
                break;

            case 'getPopup':
                funGetPopup();
                break;

            case 'getPopupEdit':
                funGetPopupEdit();
                break;

            default:
                // code...
                break;
        }

        function funGetPopupEdit()
        {
            include_once PATH_DATABASE_INC;

            $db = Database::getInstance();

            $connection = $db->getConnection();

            $listNavBar = '';

            $listFormBar = '';

            $valueTrans = '';

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

                    $sqlCmd2 = "SELECT
											idTblanguage,

											title_top ,

											title_modal ,

											subtitle_modal


											FROM

											tb_popup_translation

											JOIN tb_popup_customise

											ON tb_popup_translation.idTbpopup = tb_popup_customise.id

											WHERE

												tb_popup_customise.id = '".$id."'

											AND

												tb_popup_translation.idTblanguage = ".$row['id'].';';

                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);

                        $viArrayValues = [];

                        if ($numRows == 1) {
                            $row1 = mysqli_fetch_assoc($result2);

                            //if($valuePage == ""){$valuePage = $row1['id_0'];}

                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }

                            $viArrayValues['lang'] = $row['langMin'];

                            $viArrayValues['title_top'] = $row1['title_top'];

                            $viArrayValues['title_modal'] = $row1['title_modal'];

                            $viArrayValues['subtitle_modal'] = $row1['subtitle_modal'];

                            $viArrayValues['idTblanguage'] = $row1['idTblanguage'];

                            $viArrayValues['flag'] = $flag;
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }

                            $viArrayValues['lang'] = $row['langMin'];

                            $viArrayValues['title_top'] = '';

                            $viArrayValues['title_modal'] = '';

                            $viArrayValues['subtitle_modal'] = '';

                            $viArrayValues['idTblanguage'] = '';

                            $viArrayValues['flag'] = $flag;
                        }

                        $listFormBar .= funCreatePopupItems($viArrayValues);
                    }
                }
            }

            echo 'true||'.$listNavBar.'||'.$listFormBar;
        }

        function funGetPopup()
        {
            include_once PATH_DATABASE_INC;

            $db = Database::getInstance();

            $connection = $db->getConnection();

            $sqlCmd = 'SELECT

										id,back_up,_start_date,finish_date,_status,popup_name
									FROM

										tb_popup_customise WHERE _status <> 0';

            if ($result = $connection->query($sqlCmd)) {
                $arrayMain = [];

                while ($rsData = mysqli_fetch_assoc($result)) {
                    $imagePath = PATH_POPUP_IMG.$rsData['back_up'];

                    $image = "<img src='../".$imagePath."' style='width:100px;height:75px'/>";
                    $status = '';

                    if (intval($rsData['_status']) == 1) {
                        $status = "<input type='checkbox' name='status' value='status_' checked>";
                    } else {
                        $status = "<input type='checkbox' name='status' value='status'>";
                    }

                    $urlToEdit = "location.href='popup-editor.php?id=".$rsData['id']."'";
                    $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
                    $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
                    $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
                    array_push($arrayMain, [$rsData['id'], $image, $rsData['popup_name'], $rsData['_start_date'], $rsData['finish_date'], $status, $values]);
                }
            }

            echo json_encode($arrayMain);

            $db->closeConnection();
        }

        function funGetPopupNew()
        {
            include_once PATH_DATABASE_INC;

            $db = Database::getInstance();

            $connection = $db->getConnection();

            $listNavBar = '';

            $listFormBar = '';

            $valueTrans = '';

            $valuePage = '';

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

                    $viArrayValues['idTblanguage'] = $row['langMin'];
                    $viArrayValues['lang'] = $row['langMin'];

                    $viArrayValues['title_top'] = '';

                    $viArrayValues['title_modal'] = '';

                    $viArrayValues['subtitle_modal'] = '';

                    $viArrayValues['flag'] = $flag;

                    $listFormBar .= funCreatePopupItems($viArrayValues);
                }
            }

            echo 'true||'.$listNavBar.'||'.$listFormBar;
        }

        function funCreatePopupItems($vfArrayValues)
        {
            if ($vfArrayValues['flag'] == 'true') {
                $active = 'active';
            } else {
                $active = '';
            }

            $vfLang = $vfArrayValues['lang'];

            $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';

            $value .= '		<div class="form-group col-sm-12">';

            $value .= '			<label>Titulo Popup no Site</label>';

            $value .= '			<textarea id="title_top" name="title_top_'.$vfLang.'" class="form-control ckeditor" required> '.$vfArrayValues['title_top'].'</textarea>';

            $value .= '		</div>';

            $value .= '		<div class="form-group col-sm-12">';

            $value .= '			<label>Titulo Popup no Form</label>';

            $value .= '			<textarea id="title_modal" name="title_modal_'.$vfLang.'" class="form-control ckeditor" required> '.$vfArrayValues['title_modal'].'</textarea>';

            $value .= '		</div>';

            $value .= '		<div class="form-group col-sm-12">';

            $value .= '			<label>Sub Titulo Popup no Form</label>';

            $value .= '			<textarea id="subtitle_modal" name="subtitle_modal_'.$vfLang.'" class="form-control" required> '.$vfArrayValues['subtitle_modal'].'</textarea>';

            $value .= '		</div>';

            $value .= '<input  type="hidden" id="idTblanguage" name="idTblanguage_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTblanguage'].'">';

            $value .= '</div>';

            return $value;
        }

        function funCreateListTranslations()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $sqlCmd = 'SELECT
										tb_translations.value,
										tb_translations_codes.code,
										tb_translations_codes.id
									FROM
										tb_translations
									INNER JOIN tb_translations_codes
									ON tb_translations.idTbCodeTranslations = tb_translations_codes.id
										INNER JOIN(
																					SELECT
																						id
																					FROM
																						tb_language
																					WHERE
																						deleted = 0
																					LIMIT 1
																				) lang ON tb_translations.idTbLanguage = lang.id
									WHERE
									tb_translations_codes.deleted=0';
            $values = '';
            if ($result = $connection->query($sqlCmd)) {
                $arrayMain = [];
                while ($rsData = mysqli_fetch_assoc($result)) {
                    $urlToEdit = "location.href='traducao-editar.php?id=".$rsData['id']."'";
                    $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
                    $urlToSeeMore = "location.href='traducao-mais.php?id=".$rsData['id']."'";
                    $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
                    $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
                    $values .= '<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
                    array_push($arrayMain, [$rsData['id'], $rsData['code'], $rsData['value'], $values]);
                }
            }

            echo json_encode($arrayMain);
            $db->closeConnection();
        }

        function funCreateListTranslationsNew()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valueTrans = '';

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
                    $viArrayValues['lang'] = $row['langMin'];
                    $viArrayValues['translation'] = '';
                    $viArrayValues['idTrans'] = '';
                    $viArrayValues['flag'] = $flag;
                    $listFormBar .= funCreateTranslationsItems($viArrayValues);
                }
            }

            echo 'true||'.$listNavBar.'||'.$listFormBar;
        }

        function funCreateTranslationsItems($vfArrayValues)
        {
            if ($vfArrayValues['flag'] == 'true') {
                $active = 'active';
                $viRequired = 'required';
            } else {
                $active = '';
                $viRequired = '';
            }
            $vfLang = $vfArrayValues['lang'];
            $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
            $value .= '		<div class="form-group col-sm-6">';
            $value .= '			<label>Tradução</label>';
            $value .= '			<textarea id="translation" name="translation_'.$vfLang.'" class="form-control" '.$viRequired.'> '.$vfArrayValues['translation'].'</textarea>';
            $value .= '		</div>';
            $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
            $value .= '</div>';

            return $value;
        }

        function funCreateListTranslationsEdit()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valueTrans = '';
            $viDate = '';
            $viNameCode = '';
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
											tb_translations.id AS idtrans,
											tb_translations.value,
											tb_translations_codes.id,
											tb_translations_codes.code
											FROM
											tb_translations
											INNER JOIN tb_translations_codes ON tb_translations.idTbCodeTranslations = tb_translations_codes.id

											WHERE
												tb_translations.deleted = 0
											AND
												tb_translations_codes.id = '.$id.'
											AND
												tb_translations.idTbLanguage = '.$row['id'].';';
                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        $viArrayValues = [];
                        if ($numRows == 1) {
                            $row1 = mysqli_fetch_assoc($result2);
                            if ($viNameCode == '') {
                                $viNameCode = $row1['code'];
                            }
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['translation'] = $row1['value'];
                            $viArrayValues['idTrans'] = $row1['idtrans'];
                            $viArrayValues['flag'] = $flag;
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['translation'] = '';
                            $viArrayValues['idTrans'] = '';
                            $viArrayValues['flag'] = $flag;
                        }
                        $listFormBar .= funCreateTranslationsItems($viArrayValues);
                    } else {
                        die('false||Oppsss... Não foi possivel encontrar este item.');
                    }
                }
            }

            echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$viNameCode;
        }

        function funGetSlidesEdit()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valueTrans = '';
            $id = $_REQUEST['id'];

            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($listNavBar == '') {
                        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    } else {
                        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    }

                    $sqlCmd2 = "SELECT
												tb_slides_translations.id,
												tb_slides_translations.titleMain ,
												tb_slides_translations.subtitle ,
												tb_slides_translations.title ,
												tb_slides_translations.descriptionMain
											FROM
												tb_slides_translations
											JOIN tb_slides ON tb_slides_translations.idTbSlide = tb_slides.id
											JOIN tb_gallery ON tb_slides.idTbGallery = tb_gallery.id
											WHERE
												tb_slides.id = '".$id."'
											AND
												tb_slides_translations.idTbLanguage = ".$row['id'].';';
                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        $viArrayValues = [];
                        if ($numRows == 1) {
                            $row1 = mysqli_fetch_assoc($result2);
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['descriptionMain'] = $row1['descriptionMain'];
                            $viArrayValues['titleMain'] = $row1['titleMain'];
                            $viArrayValues['titleSlide'] = $row1['title'];
                            $viArrayValues['descriptionSlide'] = $row1['subtitle'];
                            $viArrayValues['idTrans'] = $row1['id'];
                            $viArrayValues['flag'] = $flag;
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['descriptionMain'] = '';
                            $viArrayValues['titleMain'] = '';
                            $viArrayValues['titleSlide'] = '';
                            $viArrayValues['descriptionSlide'] = '';
                            $viArrayValues['idTrans'] = '';
                            $viArrayValues['flag'] = $flag;
                        }
                        $listFormBar .= funCreateSlidesItems($viArrayValues);
                    }
                }
            }
            echo 'true||'.$listNavBar.'||'.$listFormBar;
        }

        function funCreateSlidesItems($vfArrayValues)
        {
            if ($vfArrayValues['flag'] == 'true') {
                $active = 'active';
            } else {
                $active = '';
            }
            $vfLang = $vfArrayValues['lang'];
            $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Titulo Slide</label>';
            $value .= '			<textarea id="title_slide" name="title_slide_'.$vfLang.'" class="form-control ckeditor" required> '.$vfArrayValues['titleSlide'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Descrição Slide</label>';
            $value .= '			<textarea id="description_slide" name="description_slide_'.$vfLang.'" class="form-control" required> '.$vfArrayValues['descriptionSlide'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Titulo principal</label>';
            $value .= '			<textarea id="title_slide" name="title_main_'.$vfLang.'" class="form-control" required> '.$vfArrayValues['titleMain'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Descrição Principal</label>';
            $value .= '			<textarea id="description_slide" name="description_main_'.$vfLang.'" class="form-control" required> '.$vfArrayValues['descriptionMain'].'</textarea>';
            $value .= '		</div>';
            $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
            $value .= '</div>';

            return $value;
        }

        function funCreateAbout()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valuePage = '';
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($listNavBar == '') {
                        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    } else {
                        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    }
                    $sqlCmd2 = 'SELECT
												tb_about_translation.id,
												tb_about_translation.title,
												tb_about_translation.description,
												tb_seo.seo_title,
												tb_seo.seo_description,
												tb_seo.seo_keywords,
												tb_seo.id AS idSeo,
												tb_about.id AS idAbout
											FROM
												tb_about_translation
											JOIN tb_seo
											ON tb_about_translation.idTbSeo = tb_seo.id
											JOIN tb_about
											ON tb_about.id = tb_about_translation.idTbAbout
											WHERE
												tb_about.deleted = 0
											AND
												tb_about_translation.idTbLanguage = '.$row['id'];
                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        if ($numRows == 1) {
                            while ($row1 = mysqli_fetch_assoc($result2)) {
                                $viArrayValues = [];
                                if ($valuePage == '') {
                                    $valuePage = '<input type="hidden" name="idAbout" value="'.$row1['idAbout'].'">';
                                }
                                if ($listFormBar != '') {
                                    $flag = false;
                                } else {
                                    $flag = true;
                                }

                                $viArrayValues['lang'] = $row['langMin'];
                                $viArrayValues['idLang'] = $row['id'];
                                $viArrayValues['title'] = $row1['title'];
                                $viArrayValues['description'] = $row1['description'];
                                $viArrayValues['seo_title'] = $row1['seo_title'];
                                $viArrayValues['seo_keywords'] = $row1['seo_keywords'];
                                $viArrayValues['seo_description'] = $row1['seo_description'];
                                $viArrayValues['idSeo'] = $row1['idSeo'];
                                $viArrayValues['flag'] = $flag;
                                $viArrayValues['idTrans'] = $row1['id'];

                                $listFormBar .= funCreateItemsAbout($viArrayValues);
                            }
                        } else {
                            if ($valuePage == '') {
                                $valuePage = '<input type="hidden" name="idAbout" value="">';
                            }
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['idLang'] = $row['id'];
                            $viArrayValues['title'] = '';
                            $viArrayValues['description'] = '';
                            $viArrayValues['seo_title'] = '';
                            $viArrayValues['seo_keywords'] = '';
                            $viArrayValues['seo_description'] = '';
                            $viArrayValues['idSeo'] = '';
                            $viArrayValues['flag'] = $flag;
                            $viArrayValues['idTrans'] = '';
                            $listFormBar .= funCreateItemsAbout($viArrayValues);
                        }
                    } else {
                        echo 'false||error1';
                    }
                }
                echo 'true||'.$listNavBar.'||'.$listFormBar.$valuePage;
            }
        }

// function funGetTerms(){
// 	include_once(PATH_DATABASE_INC);
// 	$db = Database::getInstance();
// 	$connection = $db->getConnection();
// 	$listNavBar = "";
// 	$listFormBar = "";
// 	$valuePage="";
// 	$sqlCmd = "SELECT * FROM tb_language WHERE deleted = 0";
// 	if($result = $connection->query($sqlCmd)){
// 		while($row = mysqli_fetch_assoc($result)){
// 			$idLang = $row['id'];
// 			$lang = $row['langMin'];
// 			if($listNavBar == ""){
// 				$listNavBar = '<li class="active"><a href="#'.$lang.'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
// 			}else{
// 				$listNavBar .= '<li class=""><a href="#'.$lang.'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
// 			}
// 			$sqlCmd2 = "SELECT
// 										tb_terms_translation.id,
// 										tb_terms_translation.description,
// 										tb_terms_translation.idTbTerms
// 									FROM
// 										tb_terms_translation
// 									JOIN tb_terms
// 									ON tb_terms.id = tb_terms_translation.idTbTerms
// 									WHERE
// 										tb_terms.deleted = 0
// 									AND
// 										tb_terms_translation.idTbLanguage = ".$idLang;
// 			if($result2 = $connection->query($sqlCmd2)){
// 				$numRows = mysqli_num_rows($result2);
// 				if($numRows == 1){
// 					while ($row1 = mysqli_fetch_assoc($result2)) {
// 						if($valuePage == ""){$valuePage = '<input type="hidden" name="idTerm" value="'.$row1['idTbTerms'].'">';}
// 						if($listFormBar != ""){$flag=false;}else{$flag=true;}
// 						$viTerms = $row1['description'];
// 						$listFormBar .= funCreateItemsTerms($flag, $idLang,$lang, $viTerms,$flag,$row1['id']);
// 					}
// 				}else{
// 					if($valuePage == ""){$valuePage = '<input type="hidden" name="idTerm" value="">';}
// 					if($listFormBar != ""){$flag=false;}else{$flag=true;}
// 					$listFormBar .= funCreateItemsTerms($flag, $idLang,$lang, "",$flag,"");
// 				}
// 			}else{
// 				die("false||error1 ". $sqlCmd2);
// 			}
// 		}
// 		echo "true||".$listNavBar."||".$listFormBar.$valuePage;
// 	}
// }
// 		function funCreateItemsTerms($vfLang, $vfIdLang, $vfTerms, $flag, $vfIdTrans){
// 			if($flag){$active="active";}else{$active="";}
// 			$value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'"> <br>';
// 			$value .= '	<div class="form-group">';
// 			$value .= '		<label>Descrição</label>';
// 			$value .= '		<textarea id="desc_'.$vfLang.'" name="desc_'.$vfLang.'" class="form-control ckeditor" required>'.$vfTerms.'</textarea>';
// 			$value .= '	</div>';
// 			$value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
// 			$value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
// 			$value .= '	</div>';
// 			$value .= '</div>';
// 			return $value;
// 		}

        function funCreateItemsAbout($vfArrayValues)
        {
            $vfLang = $vfArrayValues['lang'];
            $vfIdLang = $vfArrayValues['idLang'];
            $vfTitle = $vfArrayValues['title'];
            $vfDescription = $vfArrayValues['description'];
            $viSeoTitle = $vfArrayValues['seo_title'];
            $vfKeywords = $vfArrayValues['seo_keywords'];
            $vfDescriptionSeo = $vfArrayValues['seo_description'];
            $vfIdSeo = $vfArrayValues['idSeo'];
            $flag = $vfArrayValues['flag'];
            $vfIdTrans = $vfArrayValues['idTrans'];
            if ($flag) {
                $active = 'active';
            } else {
                $active = '';
            }
            $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'"> <br>';
            $value .= '	<div class="form-group">';
            $value .= '		<label>Titulo</label><input class="form-control" name="title_'.$vfLang.'" value="'.$vfTitle.'" required>';
            $value .= '	</div>';
            $value .= '	<div class="form-group">';
            $value .= '		<label>Descrição</label>';
            $value .= '		<textarea id="desc_'.$vfLang.'" name="desc_'.$vfLang.'" class="form-control" required>'.$vfDescription.'</textarea>';
            $value .= '	</div>';
            $value .= funCreateSeo($vfLang, $vfKeywords, $vfDescriptionSeo, $vfIdSeo, $viSeoTitle);
            $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
            $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
            $value .= '	</div>';
            $value .= '</div>';

            return $value;
        }

        function funGetClinics()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $sqlCmdGetClinics = 'SELECT id,clinic
													 FROM tb_clinicas
													 WHERE deleted = 0';
            $values = '';
            if ($result = $connection->query($sqlCmdGetClinics)) {
                $arrayMain = [];
                while ($rsData = mysqli_fetch_assoc($result)) {
                    $urlToEdit = "location.href='clinicas-editar.php?id=".$rsData['id']."'";
                    $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
                    $urlToSeeMore = "location.href='clinicas-mais.php?id=".$rsData['id']."'";
                    $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
                    $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
                    $values .= '<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
                    array_push($arrayMain, [$rsData['id'], $rsData['clinic'], $values]);
                }
            }

            echo json_encode($arrayMain);
            $db->closeConnection();
        }

        function funGetClinicNew()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valueTrans = '';

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
                    $viArrayValues['lang'] = $row['langMin'];
                    $viArrayValues['description'] = '';
                    $viArrayValues['idTrans'] = '';
                    $viArrayValues['flag'] = $flag;
                    $viArrayValues['title_cta'] = '';
                    $viArrayValues['cta'] = '';
                    $listFormBar .= funCreatClinicItems($viArrayValues, 'NULL');
                }
            }

            echo 'true||'.$listNavBar.'||'.$listFormBar;
        }

        function funGetClinicInfo()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valuePage = '';
            $images = '';
            $readonly = 'readonly';
            $id = $_REQUEST['id'];
            $sqlCmdLine = 'SELECT * FROM tb_line WHERE deleted = 0 AND id='.$id;
            if ($resultLine = $connection->query($sqlCmdLine)) {
                $rowLine = mysqli_fetch_assoc($resultLine);
                $valueLine = $rowLine['nameLine'];
            }
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($listNavBar == '') {
                        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    } else {
                        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    }
                    $sqlCmd2 = 'SELECT
												tb_description_translation.description,
												tb_description_translation.idTbLanguage,
												tb_description_translation.titleAction,
												tb_description_translation.cta,
												tb_clinicas.clinic,
												tb_clinicas.address,
												tb_clinicas.zipCode,
												tb_clinicas.city
											FROM
												tb_description_translation
											JOIN tb_clinicas ON tb_clinicas.id = tb_description_translation.idTbClinic
										WHERE
											tb_clinicas.deleted = 0
										AND
											tb_description_translation.idTbClinic = '.$id.'
										AND
											tb_description_translation.idTbLanguage = '.$row['id'];
                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        if ($numRows == 1) {
                            while ($row1 = mysqli_fetch_assoc($result2)) {
                                if ($listFormBar != '') {
                                    $flag = false;
                                } else {
                                    $flag = true;
                                }
                                $viArrayValues['lang'] = $row['langMin'];
                                $viArrayValues['description'] = $row1['description'];
                                $viArrayValues['idTrans'] = $row1['idTbLanguage'];
                                $viArrayValues['flag'] = $flag;
                                $viArrayValues['title_cta'] = $row1['titleAction'];
                                $viArrayValues['cta'] = $row1['cta'];
                                $listFormBar .= funCreatClinicItems($viArrayValues, $readonly);
                                $valuePage = $row1['clinic'].'||'.$row1['address'].'||'.$row1['zipCode'].'||'.$row1['city'];
                            }
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['description'] = '';
                            $viArrayValues['idTrans'] = $row1['idTbLanguage'];
                            $viArrayValues['flag'] = $flag;
                            $viArrayValues['title_cta'] = '';
                            $viArrayValues['cta'] = '';
                            $listFormBar .= funCreatClinicItems($viArrayValues, $readonly);
                            $valuePage = '';
                        }
                    } else {
                        echo 'false||error1';
                    }
                }
                $sqlCmdGetImages = "SELECT
									tb_gallery.path,
									tb_gallery.extension
									FROM
									tb_clinic_gallery
									JOIN tb_clinicas ON tb_clinic_gallery.idTbClinic = tb_clinicas.id
									JOIN tb_gallery ON tb_clinic_gallery.idTbGallery = tb_gallery.id
									WHERE tb_clinic_gallery.idTbClinic = $id
									AND tb_clinicas.deleted=0
									AND tb_gallery.deleted =0";

                if ($result3 = $connection->query($sqlCmdGetImages)) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        $images .= '<div class="col-md-4" style="height:100px;margin-bottom:100px;">';
                        $images .= '<img src="../'.PATH_CLINIC_IMG.$row3['path'].'.'.$row3['extension'].'"  style="height:auto; max-width:100%; display:block; margin-bottom:10px;">';
                        $images .= '</div>';
                    }
                }
                echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$valuePage.'||'.$images;
            }
        }

        function funGetClinicEdit()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valuePage = '';
            $images = '';
            $readonly = null;
            $id = $_REQUEST['id'];
            $sqlCmdLine = 'SELECT * FROM tb_line WHERE deleted = 0 AND id='.$id;
            if ($resultLine = $connection->query($sqlCmdLine)) {
                $rowLine = mysqli_fetch_assoc($resultLine);
                $valueLine = $rowLine['nameLine'];
            }
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($listNavBar == '') {
                        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    } else {
                        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    }
                    $sqlCmd2 = 'SELECT
												tb_description_translation.description,
												tb_description_translation.idTbLanguage,
												tb_description_translation.titleAction,
												tb_description_translation.cta,
												tb_clinicas.clinic,
												tb_clinicas.address,
												tb_clinicas.zipCode,
												tb_clinicas.city
											FROM
												tb_description_translation
											JOIN tb_clinicas ON tb_clinicas.id = tb_description_translation.idTbClinic
										WHERE
											tb_clinicas.deleted = 0
										AND
											tb_description_translation.idTbClinic = '.$id.'
										AND
											tb_description_translation.idTbLanguage = '.$row['id'];
                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        if ($numRows == 1) {
                            while ($row1 = mysqli_fetch_assoc($result2)) {
                                if ($listFormBar != '') {
                                    $flag = false;
                                } else {
                                    $flag = true;
                                }
                                $viArrayValues['lang'] = $row['langMin'];
                                $viArrayValues['description'] = $row1['description'];
                                $viArrayValues['idTrans'] = $row1['idTbLanguage'];
                                $viArrayValues['flag'] = $flag;
                                $viArrayValues['title_cta'] = $row1['titleAction'];
                                $viArrayValues['cta'] = $row1['cta'];
                                $listFormBar .= funCreatClinicItems($viArrayValues, $readonly);
                                $valuePage = $row1['clinic'].'||'.$row1['address'].'||'.$row1['zipCode'].'||'.$row1['city'];
                            }
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['description'] = '';
                            $viArrayValues['idTrans'] = $row1['idTbLanguage'];
                            $viArrayValues['flag'] = $flag;
                            $viArrayValues['title_cta'] = '';
                            $viArrayValues['cta'] = '';
                            $listFormBar .= funCreatClinicItems($viArrayValues, $readonly);
                            $valuePage = '';
                        }
                    } else {
                        echo 'false||error1';
                    }
                }
                $sqlCmdGetImages = "SELECT
									tb_gallery.path,
									tb_gallery.extension,
									tb_gallery.id
									FROM
									tb_clinic_gallery
									JOIN tb_clinicas ON tb_clinic_gallery.idTbClinic = tb_clinicas.id
									JOIN tb_gallery ON tb_clinic_gallery.idTbGallery = tb_gallery.id
									WHERE tb_clinic_gallery.idTbClinic = $id
									AND tb_clinicas.deleted=0
									AND tb_gallery.deleted =0";

                if ($result3 = $connection->query($sqlCmdGetImages)) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        $images .= '<div class="col-md-4" style="height:100px;margin-bottom:100px;">';
                        $images .= '<img src="../'.PATH_CLINIC_IMG.$row3['path'].'.'.$row3['extension'].'"  style="height:auto; max-width:100%; display:block; margin-bottom:10px;">';
                        $images .= '<button class="btn btn-block btn-danger btn-sm" onclick="funDeleteImage('.$row3['id'].')">Eliminar</button>';
                        $images .= '</div>';
                    }
                }
                echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$valuePage.'||'.$images;
            }
        }

        function funCreatClinicItems($vfArrayValues, $readonly)
        {
            if ($vfArrayValues['flag'] == 'true') {
                $active = 'active';
            } else {
                $active = '';
            }
            $vfLang = $vfArrayValues['lang'];
            $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Descrição Clinica</label>';
            $value .= '			<textarea id="description" name="description_'.$vfLang.'" class="form-control"'.$readonly.' > '.$vfArrayValues['description'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Acções</label>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Titulo</label>';
            $value .= '			<input id="title_cta_'.$vfLang.'" name="title_cta_'.$vfLang.'" class="form-control"'.$readonly.' value="'.$vfArrayValues['title_cta'].'">';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Acção</label>';
            $value .= '			<input id="cta_'.$vfLang.'" name="cta_'.$vfLang.'" class="form-control"'.$readonly.' value='.$vfArrayValues['cta'].'>';
            $value .= '		</div>';
            $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
            $value .= '</div>';

            return $value;
        }

        function funGetVideos()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $sqlCmdGetTestimonials = 'SELECT id,name,url
													 FROM tb_videos
													 WHERE status = 0';
            $values = '';
            if ($result = $connection->query($sqlCmdGetTestimonials)) {
                $arrayMain = [];
                while ($rsData = mysqli_fetch_assoc($result)) {
                    $urlToEdit = "location.href='video-editar.php?id=".$rsData['id']."'";
                    $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
                    //$urlToSeeMore = "location.href='testemunhos-mais.php?id=".$rsData['id']."'";
                    $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
                    $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
                    //$values .=	'<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
                    array_push($arrayMain, [$rsData['id'], $rsData['name'], $rsData['url'], $values]);
                }
            }

            echo json_encode($arrayMain);
            $db->closeConnection();
        }

        function funGetVideoInfo()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $id = $_REQUEST['id'];
            $valuePage = '';
            $sqlCmdGetTest = "SELECT name, dateF, url FROM tb_videos WHERE status = 0 AND id=$id";

            if ($result = $connection->query($sqlCmdGetTest)) {
                while ($rsData = mysqli_fetch_assoc($result)) {
                    $valuePage .= $rsData['name'].'||'.$rsData['dateF'].'||'.$rsData['url'];
                }
            }

            echo 'true||'.$valuePage;
        }

            function funCreateAdvantage()
            {
                include_once PATH_DATABASE_INC;
                $db = Database::getInstance();
                $connection = $db->getConnection();
                $sqlCmd = 'SELECT
								tb_language.lang,
								tb_advantage.title,
								tb_advantage_main.id,
								tb_advantage.description
								FROM
								tb_advantage
								JOIN tb_language
								ON tb_advantage.idTbLanguage = tb_language.id
								JOIN tb_advantage_main
								ON tb_advantage.idTbAdvantageMain = tb_advantage_main.id
								JOIN(
									SELECT
										id
									FROM
										tb_language
									WHERE
										deleted = 0
									LIMIT 1
								) lang ON tb_advantage.idTbLanguage = lang.id
								WHERE
									tb_advantage_main.status = 0';

                $values = '';
                if ($result = $connection->query($sqlCmd)) {
                    $arrayMain = [];
                    while ($rsData = mysqli_fetch_assoc($result)) {
                        $urlToEdit = "location.href='features-editar.php?id=".$rsData['id']."'";
                        $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
                        //$urlToSeeMore = "location.href='advantage-mais.php?id=".$rsData['id']."'";
                        $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
                        $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
                        //$values .=	'<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
                        array_push($arrayMain, [$rsData['id'], $rsData['title'], $values]);
                    }
                }

                echo json_encode($arrayMain);
                $db->closeConnection();
            }

        function funCreateAdvantageNew()
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
                    $listFormBar .= funCreateItemsAdvantage($row['langMin'], $row['id'], '', '', $flag, $id);
                }
                echo 'true||'.$listNavBar.'||'.$listFormBar;
            }
        }

        function funCreateAdvantageEdit()
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
										tb_advantage.id,
										tb_advantage.title,
										tb_advantage.description,
										tb_advantage_location.id AS id_0,
										tb_advantage_location.page,
										tb_advantage_main.position
										FROM
										tb_advantage
										JOIN tb_advantage_main
										ON tb_advantage.idTbAdvantageMain = tb_advantage_main.id
										JOIN tb_advantage_location
										ON tb_advantage_main.idTbAdvantageLocation = tb_advantage_location.id
										WHERE
										tb_advantage_main.status = 0
										AND
													tb_advantage.published = 1
										AND
													tb_advantage_main.id = '.$id.'
										AND
													tb_advantage.idTbLanguage = '.$row['id'];

                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        if ($numRows == 1) {
                            while ($row1 = mysqli_fetch_assoc($result2)) {
                                if ($valuePage == '') {
                                    $valuePage = $row1['id_0'];
                                }
                                if ($listFormBar != '') {
                                    $flag = false;
                                } else {
                                    $flag = true;
                                }
                                $position = $row1['position'];
                                $listFormBar .= funCreateItemsAdvantage($row['langMin'], $row['id'], $row1['title'], $row1['description'], $flag, $row1['id']);
                            }
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $listFormBar .= funCreateItemsAdvantage($row['langMin'], $row['id'], '', '', $flag, '');
                        }
                    } else {
                        echo 'false||error1';
                    }
                }
                echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$valuePage.'||'.$position;
            }
        }

        function funCreateItemsAdvantage($vfLang, $vfIdLang, $vcTitulo, $txTexto, $flag, $vfIdTrans)
        {
            if ($flag) {
                $active = 'active';
            } else {
                $active = '';
            }
            $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'">    <br>';
            $value .= '	<div class="form-group">';
            $value .= '		<label>Título</label><input class="form-control" name="vcTitulo_'.$vfLang.'" value="'.$vcTitulo.'" >';
            $value .= '	</div>';
            $value .= '	<div class="form-group">';
            $value .= '		<label>Descrição</label>';
            $value .= '		<textarea id="txTexto_'.$vfLang.'" name="txTexto_'.$vfLang.'" class="form-control" >'.$txTexto.'</textarea>';
            $value .= '	</div>';
            $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
            $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
            $value .= '	</div>';
            $value .= '</div>';

            return $value;
        }

        function funGetSlidesSimpleNew()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valueTrans = '';
            $valuePage = '';

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
                    $viArrayValues['lang'] = $row['langMin'];
                    $viArrayValues['textSlide'] = '';
                    $viArrayValues['callTitle'] = '';
                    $viArrayValues['callAction'] = '';
                    $viArrayValues['titleSlide'] = '';
                    $viArrayValues['descriptionSlide'] = '';
                    $viArrayValues['idTrans'] = '';
                    $viArrayValues['flag'] = $flag;
                    $listFormBar .= funCreateSlidesSimpleItems($viArrayValues);
                }
            }

            echo 'true||'.$listNavBar.'||'.$listFormBar;
        }

        function funGetSlidesSimpleEdit()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valueTrans = '';
            $valuePage = '';
            $id = $_REQUEST['id'];
            $images = array();
            $idModel = '';

            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($listNavBar == '') {
                        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    } else {
                        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    }

                    $sqlCmd2 = "SELECT
											tb_simple_slide_translation.id,
											tb_simple_slide_translation.subtitle,
											tb_simple_slide_translation.title,
											tb_simple_slide_translation.text,
											tb_simple_slide_translation.callTitle,
											tb_simple_slide_translation.callAction,
											tb_slide_location.id AS id_0,
											tb_slide_location.page,
											tb_models_page.idTbModel
											FROM
											tb_simple_slide_translation
											JOIN tb_simple_slide
											ON tb_simple_slide_translation.idTbSlide = tb_simple_slide.id
											JOIN tb_slide_location
											ON tb_simple_slide.idTbSlideLocation = tb_slide_location.id
											LEFT JOIN tb_models_page ON tb_models_page.idTbSlide = tb_simple_slide.id
											WHERE
												tb_simple_slide.id = '".$id."'
											AND
												tb_simple_slide_translation.idTbLanguage = ".$row['id'].';';

                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        $viArrayValues = [];
                        if ($numRows == 1) {
                            $row1 = mysqli_fetch_assoc($result2);
                            if ($valuePage == '') {
                                $valuePage = $row1['id_0'];
                            }
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['textSlide'] = $row1['text'];
                            $viArrayValues['callTitle'] = $row1['callTitle'];
                            $viArrayValues['callAction'] = $row1['callAction'];
                            $viArrayValues['titleSlide'] = $row1['title'];
                            $viArrayValues['descriptionSlide'] = $row1['subtitle'];
                            $viArrayValues['idTrans'] = $row1['id'];
                            $viArrayValues['flag'] = $flag;
                            $idModel = $row1['idTbModel'];
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['textSlide'] = '';
                            $viArrayValues['callTitle'] = '';
                            $viArrayValues['callAction'] = '';
                            $viArrayValues['titleSlide'] = '';
                            $viArrayValues['descriptionSlide'] = '';
                            $viArrayValues['idTrans'] = '';
                            $viArrayValues['flag'] = $flag;
                        }
                        $listFormBar .= funCreateSlidesSimpleItems($viArrayValues);
                    }
                }
            }

            $sqlGetImg = "SELECT
										tb_gallery.path,
										tb_gallery.extension
										FROM
										tb_slide_gallery
										LEFT JOIN tb_gallery ON tb_gallery.id = tb_slide_gallery.idTbGallery
										WHERE tb_slide_gallery.idTbSlide =$id
										AND tb_slide_gallery.status=0";

            if ($result3 = $connection->query($sqlGetImg)) {
                while ($row2 = mysqli_fetch_assoc($result3)) {
                    $imagesPath = $row2['path'].'.'.$row2['extension'];
                    array_push($images, $imagesPath);
                }
            }

            echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$valuePage.'||'.json_encode($images).'||'.$idModel;
        }

        function funCreateSlidesSimpleItems($vfArrayValues)
        {
            if ($vfArrayValues['flag'] == 'true') {
                $active = 'active';
            } else {
                $active = '';
            }
            $vfLang = $vfArrayValues['lang'];
            $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Titulo Slide</label>';
            $value .= '			<textarea id="title_slide" name="title_slide_'.$vfLang.'" class="form-control ckeditor" required> '.$vfArrayValues['titleSlide'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Sub Titulo Slide</label>';
            $value .= '			<textarea id="description_slide" name="description_slide_'.$vfLang.'" class="form-control" required> '.$vfArrayValues['descriptionSlide'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Texto Slide</label>';
            $value .= '			<textarea id="text_slide" name="text_slide_'.$vfLang.'" class="form-control" required> '.$vfArrayValues['textSlide'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '<hr style="background: black; height: 1px;" >';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Call to Action</label>';
            $value .= '			<label>Title</label>';
            $value .= '			<input id="call_title" name="call_title_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['callTitle'].'" required> ';
            $value .= '			<label>Action</label>';
            $value .= '			<input id="call_action" name="call_action_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['callAction'].'" required> ';
            $value .= '		</div>';
            $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
            $value .= '</div>';

            return $value;
        }

    function funCreateFaqsNew()
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
                $listFormBar .= funCreateItemsFaq($row['langMin'], $row['id'], '', '', $flag, $id);
            }
            echo 'true||'.$listNavBar.'||'.$listFormBar;
        }
    }

function funCreateItemsFaq($vfLang, $vfIdLang, $vfQuestion, $vfAnswer, $flag, $vfIdTrans)
{
    if ($flag) {
        $active = 'active';
    } else {
        $active = '';
    }
    $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'">    <br>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Pergunta</label><input class="form-control" name="question_'.$vfLang.'" value="'.$vfQuestion.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Resposta</label>';
    $value .= '		<textarea id="desc_'.$vfLang.'" name="desc_'.$vfLang.'" class="form-control" required>'.$vfAnswer.'</textarea>';
    $value .= '	</div>';
    $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
    $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
    $value .= '	</div>';
    $value .= '</div>';

    return $value;
}

        function funCreateTitleFaqs()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $sqlCmd = 'SELECT
									tb_title_faqs.id ,
									tb_title_faqs_translation.title
								FROM
									tb_title_faqs_translation
								JOIN tb_title_faqs ON tb_title_faqs_translation.idTbTitleFaqs = tb_title_faqs.id
								JOIN(
									SELECT
										id
									FROM
										tb_language
									WHERE
										deleted = 0
									LIMIT 1
								) lang ON tb_title_faqs_translation.idTbLanguage = lang.id
								WHERE
									tb_title_faqs.deleted = 0';

            $values = '';
            if ($result = $connection->query($sqlCmd)) {
                $arrayMain = [];
                while ($rsData = mysqli_fetch_assoc($result)) {
                    $urlToEdit = "location.href='titlefaqs-editar.php?id=".$rsData['id']."'";
                    $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
                    $urlToSeeMore = "location.href='faqs-mais.php?id=".$rsData['id']."'";
                    $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
                    $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
                    $values .= '<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
                    array_push($arrayMain, [$rsData['id'], $rsData['title'], $values]);
                }
            }

            echo json_encode($arrayMain);
            $db->closeConnection();
        }

        function funCreateTitleFaqEdit()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valuePage = '';
            $id = $_REQUEST['id'];
            $sqlCmdLine = 'SELECT * FROM tb_title_faqs WHERE deleted = 0 AND id='.$id;

            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($listNavBar == '') {
                        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    } else {
                        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    }
                    $sqlCmd2 = 'SELECT
											tb_title_faqs_translation.title,
											tb_title_faqs_translation.id AS idTitleFaqsTrans,
											tb_title_faqs.id
											FROM
											tb_title_faqs_translation
											JOIN tb_title_faqs
											ON tb_title_faqs_translation.idTbTitleFaqs = tb_title_faqs.id
											WHERE
												tb_title_faqs.deleted = 0
											AND
												tb_title_faqs.id = '.$id.'
											AND
												tb_title_faqs_translation.idTbLanguage = '.$row['id'];

                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        if ($numRows == 1) {
                            while ($row1 = mysqli_fetch_assoc($result2)) {
                                if ($listFormBar != '') {
                                    $flag = false;
                                } else {
                                    $flag = true;
                                }
                                $listFormBar .= funCreateItemsTitleFaq($row['langMin'], $row['id'], $row1['title'], $flag, $row1['idTitleFaqsTrans']);
                            }
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $listFormBar .= funCreateItemsTitleFaq($row['langMin'], $row['id'], '', $flag, '');
                        }
                    } else {
                        echo 'false||error1';
                    }
                }
                echo 'true||'.$listNavBar.'||'.$listFormBar;
            }
        }

        function funCreateItemsTitleFaq($vfLang, $vfIdLang, $vfTitle, $flag, $vfIdTrans)
        {
            if ($flag) {
                $active = 'active';
            } else {
                $active = '';
            }
            $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'">    <br>';
            $value .= '	<div class="form-group">';
            $value .= '		<label>Adicione um Titulo para as duas FAQS</label><input class="form-control" name="title_'.$vfLang.'" value="'.$vfTitle.'" required>';
            $value .= '	</div>';
            $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
            $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
            $value .= '	</div>';
            $value .= '</div>';

            return $value;
        }

        function funCreatNewsItems($vfArrayValues, $readonly)
        {
            if ($vfArrayValues['flag'] == 'true') {
                $active = 'active';
            } else {
                $active = '';
            }
            $vfLang = $vfArrayValues['lang'];

            $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Titulo</label>';
            $value .= '			<input id="title'.$vfLang.'" name="title'.$vfLang.'" class="form-control"'.$readonly.' value="'.$vfArrayValues['title'].'" required>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Texto</label>';
            $value .= '			<textarea id="text'.$vfLang.'" name="text'.$vfLang.'" class="form-control"'.$readonly.' required> '.$vfArrayValues['text'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '<hr style="background: black; height: 1px;" >';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Call to Action</label>';
            $value .= '			<label>Title</label>';
            $value .= '			<input id="call_title" name="call_title_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['callTitle'].'" required> ';
            $value .= '			<label>Action</label>';
            $value .= '			<input id="call_action" name="call_action_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['callAction'].'" required> ';
            $value .= '		</div>';
            $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
            $value .= '</div>';

            return $value;
        }

        function funGetNewsNew()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valueTrans = '';

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
                    $viArrayValues['lang'] = $row['langMin'];
                    $viArrayValues['text'] = '';
                    $viArrayValues['idTrans'] = '';
                    $viArrayValues['flag'] = $flag;
                    $viArrayValues['callTitle'] = '';
                    $viArrayValues['callAction'] = '';
                    $viArrayValues['title'] = '';
                    $viArrayValues['font'] = '';
                    $viArrayValues['url'] = '';
                    $listFormBar .= funCreatNewsItems($viArrayValues, 'NULL');
                }
            }

            echo 'true||'.$listNavBar.'||'.$listFormBar;
        }

        function funGetNewsEdit()
        {
            include_once PATH_DATABASE_INC;
            $db = Database::getInstance();
            $connection = $db->getConnection();
            $listNavBar = '';
            $listFormBar = '';
            $valuePage = '';
            $images = '';
            $readonly = null;
            $id = $_REQUEST['id'];
            $sqlCmdLine = 'SELECT * FROM tb_line WHERE deleted = 0 AND id='.$id;
            if ($resultLine = $connection->query($sqlCmdLine)) {
                $rowLine = mysqli_fetch_assoc($resultLine);
                $valueLine = $rowLine['nameLine'];
            }
            $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
            if ($result = $connection->query($sqlCmd)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($listNavBar == '') {
                        $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    } else {
                        $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                    }
                    $sqlCmd2 = 'SELECT
											tb_news.font,
											tb_news_translation.title,
											tb_news_translation.text,
											tb_news_translation.callTitle,
											tb_news_translation.callAction,
											tb_gallery.path,
											tb_gallery.extension,
											tb_news.url
											FROM
											tb_news
											JOIN tb_news_gallery
											ON tb_news.id = tb_news_gallery.idTbNews
											JOIN tb_news_translation
											ON tb_news_translation.idTbNews = tb_news.id
											JOIN tb_gallery
											ON tb_news_gallery.idTbGallery = tb_gallery.id
											WHERE
											tb_news.status = 0
										AND
											tb_news_translation.idTbNews = '.$id.'
											AND tb_news_gallery.status = 0
										AND
											tb_news_translation.idTbLanguage = '.$row['id'];

                    if ($result2 = $connection->query($sqlCmd2)) {
                        $numRows = mysqli_num_rows($result2);
                        if ($numRows == 1) {
                            while ($row1 = mysqli_fetch_assoc($result2)) {
                                if ($listFormBar != '') {
                                    $flag = false;
                                } else {
                                    $flag = true;
                                }
                                $viArrayValues['lang'] = $row['langMin'];
                                $viArrayValues['text'] = $row1['text'];
                                $viArrayValues['idTrans'] = '';
                                $viArrayValues['flag'] = $flag;
                                $viArrayValues['title'] = $row1['title'];
                                $viArrayValues['callTitle'] = $row1['callTitle'];
                                $viArrayValues['callAction'] = $row1['callAction'];
                                $listFormBar .= funCreatNewsItems($viArrayValues, $readonly);
                                $valuePage = $row1['font'].'||'.$row1['url'];
                            }
                        } else {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['text'] = '';
                            $viArrayValues['idTrans'] = $row['id'];
                            $viArrayValues['flag'] = $flag;
                            $viArrayValues['title'] = '';
                            $viArrayValues['callTitle'] = '';
                            $viArrayValues['callAction'] = '';
                            $listFormBar .= funCreatNewsItems($viArrayValues, $readonly);
                            $valuePage = '';
                        }
                    } else {
                        echo 'false||error1';
                    }
                }
                $sqlCmdGetImages = "SELECT
														tb_gallery.path,
														tb_gallery.extension,
														tb_news_gallery.status,
														tb_news_gallery.id
														FROM
														tb_news_gallery
														JOIN tb_gallery ON tb_news_gallery.idTbGallery = tb_gallery.id
														JOIN tb_news ON tb_news.id = tb_news_gallery.idTbNews
														WHERE tb_news_gallery.idTbNews = $id
														AND tb_news_gallery.status = 0";

                if ($result3 = $connection->query($sqlCmdGetImages)) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        $images .= '<div class="col-md-4" style="height:100px;margin-bottom:100px;">';
                        $images .= '<img src="../'.PATH_NEWS_IMG.$row3['path'].'.'.$row3['extension'].'"  style="height:auto; max-width:100%; display:block; margin-bottom:10px;">';
                        $images .= '<button class="btn btn-block btn-danger btn-sm" onclick="funDeleteImage('.$row3['id'].')">Eliminar</button>';
                        $images .= '</div>';
                    }
                }
                echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$valuePage.'||'.$images;
            }
        }

        function funCreateEventItems($vfArrayValues, $readonly)
        {
            if ($vfArrayValues['flag'] == 'true') {
                $active = 'active';
            } else {
                $active = '';
            }
            $vfLang = $vfArrayValues['lang'];

            $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Titulo</label>';
            $value .= '			<input id="title'.$vfLang.'" name="title'.$vfLang.'" class="form-control"'.$readonly.' value="'.$vfArrayValues['title'].'">';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Texto</label>';
            $value .= '			<textarea id="text'.$vfLang.'" name="text'.$vfLang.'" class="form-control"'.$readonly.' > '.$vfArrayValues['text'].'</textarea>';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '<hr style="background: black; height: 1px;" >';
            $value .= '		</div>';
            $value .= '		<div class="form-group col-sm-12">';
            $value .= '			<label>Call to Action</label>';
            $value .= '			<label>Title</label>';
            $value .= '			<input id="call_title" name="call_title_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['callTitle'].'" required> ';
            $value .= '			<label>Action</label>';
            $value .= '			<input id="call_action" name="call_action_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['callAction'].'" required> ';
            $value .= '		</div>';
            $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
            $value .= '</div>';

            return $value;
        }

function funGetModalTrans()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $value = '<form name="addTranslation" enctype="multipart/form-data" style="margin-bottom:20px;">';
    $value .= '	<div class="col-xs-12">';
    $value .= '		<div class="form-group col-sm-4">';
    $value .= '					<label>Código Tradução</label>';
    $value .= '					<input type="text" id="codeTrans" name="codeTrans" class="form-control" required>';
    $value .= '		</div>';
    $value .= '	</div>';
    $value .= '	<ul id="navBarModal" class="nav nav-tabs"></ul>';
    $value .= '	<div id="tabContentModal" class="tab-content"></div>';
    $value .= '	<input type="hidden" name="cmdEval" value="addtranslaction">';
    $value .= '	<input type="hidden" name="bot" value="">';
    $value .= '	<div class="modal-footer">';
    $value .= '		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>';
    $value .= '		<button type="button" class="btn btn-primary">Guardar</button>';
    $value .= '	</div>';
    $value .= '</form>';

    $listNavBar = '';
    $listFormBar = '';

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
            $viArrayValues['lang'] = $row['langMin'];
            $viArrayValues['translation'] = '';
            $viArrayValues['idTrans'] = '';
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateTranslationsItems($viArrayValues);
        }
    }
    echo 'true||'.$value.'||'.$listNavBar.'||'.$listFormBar;
}

function funGetEventInfo()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listNavBar = '';
    $listFormBar = '';
    $valuePage = '';
    $images = '';
    $readonly = '	';
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
									tb_events.eventDate,
									tb_events.idTbTransCode,
									tb_translations.value,
									tb_events_translation.title,
									tb_events_translation.text,
									tb_events_translation.idTbLanguage,
									tb_events_translation.callTitle,
									tb_events_translation.callAction
									FROM
									tb_events_translation
									JOIN tb_language ON tb_events_translation.idTbLanguage = tb_language.id
									JOIN tb_events ON tb_events_translation.idTbEvents = tb_events.id
									JOIN tb_translations_codes ON tb_events.idTbTransCode = tb_translations_codes.id
									JOIN tb_translations ON tb_translations.idTbCodeTranslations = tb_translations_codes.id
																			 AND tb_translations.idTbLanguage = tb_language.id
								WHERE
									tb_events.status = 0
								AND
									tb_events_translation.idTbEvents = '.$id.'
								AND
									tb_events_translation.idTbLanguage = '.$row['id'];
            if ($result2 = $connection->query($sqlCmd2)) {
                $numRows = mysqli_num_rows($result2);
                if ($numRows == 1) {
                    while ($row1 = mysqli_fetch_assoc($result2)) {
                        if ($listFormBar != '') {
                            $flag = false;
                        } else {
                            $flag = true;
                        }
                        $viArrayValues['lang'] = $row['langMin'];
                        $viArrayValues['text'] = $row1['text'];
                        $viArrayValues['idTrans'] = $row1['idTbLanguage'];
                        $viArrayValues['flag'] = $flag;
                        $viArrayValues['title'] = $row1['title'];
                        $viArrayValues['callTitle'] = $row1['callTitle'];
                        $viArrayValues['callAction'] = $row1['callAction'];
                        $listFormBar .= funCreateEventItems($viArrayValues, $readonly);
                        $valuePage = $row1['eventDate'].'||'.$row1['idTbTransCode'];
                    }
                } else {
                    if ($listFormBar != '') {
                        $flag = false;
                    } else {
                        $flag = true;
                    }
                    $viArrayValues['lang'] = $row['langMin'];
                    $viArrayValues['text'] = '';
                    $viArrayValues['idTrans'] = '';
                    $viArrayValues['flag'] = $flag;
                    $viArrayValues['title'] = '';
                    $viArrayValues['callTitle'] = '';
                    $viArrayValues['callAction'] = '';
                    $listFormBar .= funCreateEventItems($viArrayValues, $readonly);
                    $valuePage = '';
                }
            } else {
                echo 'false||error1';
            }
        }
        echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$valuePage;
    }
}

function funGetModel()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sqlCmd = 'SELECT
							tb_models.id,
							tb_models.name
							FROM
							tb_models
							WHERE
								tb_models.deleted = 0
							';
    $values = '';
    if ($result = $connection->query($sqlCmd)) {
        $arrayMain = [];
        while ($rsData = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='modelos-editar.php?id=".$rsData['id']."'";
            $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
            $urlToSeeMore = "location.href='modelos-mais.php?id=".$rsData['id']."'";
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            $values .= '<button class="fa fa-eye" style="padding:5px; margin-left:10px" onclick="'.$urlToSeeMore.'"></button>';
            array_push($arrayMain, [$rsData['id'], $rsData['name'], $values]);
        }
    }

    echo json_encode($arrayMain);
    $db->closeConnection();
}

function funGetModelNew()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listNavBar = '';
    $listFormBar = '';
    $id = '';
    $valueLine = '';
    $categories = array();
    $specs = array();
    $listDivisions = '';

    if ($listDivisions == '') {
        $viArrayValues['idDivisions'] = [];
        $listDivisions = funGetDivisions($viArrayValues);
        if ($listDivisions == 'null') {
            die('error Divisions');
        }
    }

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
            $listFormBar .= funCreateItemsModel($row['langMin'], $row['id'], '', '', '', '', $flag, $id, '');
        }
    }

    $sqlGetCat = 'SELECT tb_translations.value,
											tb_categories_specs.id
								FROM tb_categories_specs
								JOIN tb_translations ON tb_translations.idTbCodeTranslations = tb_categories_specs.idTbTransCodes
								WHERE tb_translations.idTbLanguage = 3';

    if ($result1 = $connection->query($sqlGetCat)) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            array_push($categories, array($row1['id'], $row1['value']));
        }
    }

    echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.json_encode($categories).'||'.$listDivisions;
}

function funGetDivisions($vfArray)
{
    /* DIVISÃO */
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $codehtml = '';

    if (isset($vfArray['idDivisions'])) {
        $vfIdDivision = $vfArray['idDivisions'];
    }

    $sqlCmd = "SELECT
						tb_divisions.id,
						tb_translations.value
						FROM
						tb_divisions
						JOIN tb_translations_codes
						ON tb_divisions.idTbTranscode = tb_translations_codes.id
						JOIN tb_translations
						ON tb_translations.idTbCodeTranslations = tb_translations_codes.id
						JOIN tb_language
						ON tb_translations.idTbLanguage = tb_language.id
						WHERE
						tb_language.langMin= 'PT'";

    $codehtml .= '<option value="">Selecione</option>';
    if ($result = $connection->query($sqlCmd)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ((isset($vfIdDivision)) && (in_array($row['id'], $vfIdDivision))) {
                $codehtml .= '<option value="'.$row['id'].'|'.$row['value'].'" selected>'.$row['value'].'</option>';
            } else {
                $codehtml .= '<option value="'.$row['id'].'|'.$row['value'].'" >'.$row['value'].'</option>';
            }
        }
    } else {
        $codehtml = 'null';
    }

    return $codehtml;
}

function funGetModelEdit()
{
    include_once PATH_DATABASE_INC;
    include_once '../../includes/globalVars.php';
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listNavBar = '';
    $listFormBar = '';
    $valuePage = '';
    $listDivisions = '';
    $listDivisionslist = '';
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
									tb_models_translation.description,
									tb_models_translation.keywordsSeo,
									tb_models_translation.descriptionSeo,
									tb_models_translation.id AS idModelsTrans,
									tb_models.id,
									tb_pdf.path,
									tb_pdf.token
									FROM
									tb_models_translation
									JOIN tb_models
									ON tb_models_translation.idTbModels = tb_models.id
									JOIN tb_pdf
									ON tb_models_translation.idTbPdf = tb_pdf.id
									-- JOIN tb_tech_draw
									-- ON tb_tech_draw.idTbModels = tb_models.id
									WHERE
										tb_models.deleted = 0
									-- AND
									-- 	tb_tech_draw.status = 0
									AND
										tb_models.id = '.$id.'
									AND
										tb_models_translation.idTbLanguage = '.$row['id'];

            if ($result2 = $connection->query($sqlCmd2)) {
                $numRows = mysqli_num_rows($result2);
                if ($numRows == 1) {
                    while ($row1 = mysqli_fetch_assoc($result2)) {
                        // if($valuePage == ""){$valuePage = $row1['idPage'];}
                        if ($listFormBar != '') {
                            $flag = false;
                        } else {
                            $flag = true;
                        }
                        $listFormBar .= funCreateItemsModel($row['langMin'], $row['id'], $row1['description'], $row1['keywordsSeo'], $row1['descriptionSeo'], $row1['path'], $flag, $row1['idModelsTrans'], $row1['token']);
                    }
                } else {
                    if ($listFormBar != '') {
                        $flag = false;
                    } else {
                        $flag = true;
                    }
                    $listFormBar .= funCreateItemsModel($row['langMin'], $row['id'], '', '', '', '', $flag, '', '');
                }
            } else {
                echo 'false||error1';
            }
        }
        $modelValues = '';
        $sqlGetModel = "SELECT name, tb_models.default
		 							FROM tb_models
									WHERE id = $id";
        if ($result2 = $connection->query($sqlGetModel)) {
            while ($row1 = mysqli_fetch_assoc($result2)) {
                $modelValues = $row1['name'];
                $modelValues .= '||'.$row1['default'];
            }
        }
        $modelsSpecs = array();
        $sqlGetModelSpecs = "SELECT tb_models_specs.value,
																tb_models_specs.idTbSpec,
																tb_specs.idTbCategoriesSpecs
												 FROM tb_models_specs
												 JOIN tb_models ON tb_models.id = tb_models_specs.idTbModels
												 JOIN tb_specs ON tb_specs.id = tb_models_specs.idTbSpec
												 WHERE tb_models.id = $id";
        if ($result9 = $connection->query($sqlGetModelSpecs)) {
            while ($row1 = mysqli_fetch_assoc($result9)) {
                array_push($modelsSpecs, array($row1['idTbCategoriesSpecs'], $row1['idTbSpec'], $row1['value']));
            }
        }

        $sqlGetModelImages = "SELECT 	tb_gallery.path,
																	tb_gallery.extension,
																	tb_models_gallery.id
													FROM tb_models_gallery
													JOIN tb_gallery ON tb_gallery.id = tb_models_gallery.idTbGallery
													WHERE tb_models_gallery.idTbModels = $id";
        $modelImg = '';
        if ($result2 = $connection->query($sqlGetModelImages)) {
            while ($row1 = mysqli_fetch_assoc($result2)) {
                $modelImg .= '<div class="col-sm-4">';
                $modelImg .= '<img src="../'.PATH_MODELS_GALLERY_IMG.$row1['path'].'.'.$row1['extension'].'"  style="height:auto; max-width:100%; display:block; margin-bottom:10px;">';
                // $modelImg .= '<button class="btn btn-block btn-danger btn-sm" onclick="funDeleteImage('.$row1['id'].')">Eliminar</button>';
                $modelImg .= '</div>';
            }
        }

        // division
        if ($listDivisions == '') {
            $arrayDiv = [];
            // $modelsDiv = array();
            $sqlCmdDiv = "SELECT
											tb_translations.value,
											tb_divisions.id
											FROM
												tb_techDraw_divisions
											JOIN tb_divisions ON tb_techDraw_divisions.idTbDivision = tb_divisions.id
											JOIN tb_tech_draw ON tb_techDraw_divisions.idTbTechDraw = tb_tech_draw.id
											JOIN tb_translations ON tb_divisions.idTbTranscode = tb_translations.idTbCodeTranslations
											WHERE
												tb_tech_draw.idTbModels = '$id'
											AND
											tb_techDraw_divisions.status=0
											GROUP BY
											tb_techDraw_divisions.id";

            if ($resultDiv = $connection->query($sqlCmdDiv)) {
                while ($rowDiv = mysqli_fetch_assoc($resultDiv)) {
                    $arrayDiv[] = $rowDiv['id'];
                    // array_push($modelsSpecs,array($row1['id'],$row1['value']));
                }
            }

            $viArrayValues['idDivisions'] = $arrayDiv;
            $listDivisions = funGetDivisions($viArrayValues);
            if ($listDivisions == 'null') {
                die('error Divisions');
            }
        }
        // division final

        //5 passo
        $sqlGetPlantaImages = "SELECT
													tb_gallery.path,
													tb_gallery.extension,
													tb_tech_draw.idTbGallery
													FROM
													tb_tech_draw
													JOIN tb_gallery
													ON tb_tech_draw.idTbGallery = tb_gallery.id
 													WHERE tb_tech_draw.idTbModels = $id
													AND
													tb_tech_draw.status=0";
        $plantaImg = '';
        if ($result3 = $connection->query($sqlGetPlantaImages)) {
            while ($row3 = mysqli_fetch_assoc($result3)) {
                $plantaImg .= '<div class="col-sm-4">';
                $plantaImg .= '<img src="../'.PATH_PLANTA_IMG.$row3['path'].'.'.$row3['extension'].'"  style="height:auto; max-width:100%; display:block; margin-bottom:10px;">';
                // $modelImg .= '<button class="btn btn-block btn-danger btn-sm" onclick="funDeleteImage('.$row1['id'].')">Eliminar</button>';
                $plantaImg .= '</div>';
            }
        }

        $modelsSpecsTech = array();
        $sqlGetModelSpecsTech = "SELECT
															tb_tech_draw.idTbTransCode,
															tb_tech_draw.id
															FROM
															tb_tech_draw
															JOIN tb_models
															ON tb_tech_draw.idTbModels = tb_models.id
															WHERE tb_models.id = $id
															AND
															tb_tech_draw.status=0
															GROUP BY
															tb_tech_draw.id
		";
        if ($result3 = $connection->query($sqlGetModelSpecsTech)) {
            while ($row1 = mysqli_fetch_assoc($result3)) {
                array_push($modelsSpecsTech, array($row1['idTbTransCode'], $row1['id']));
            }
        }

        //5 passo fim

        $categories = array();

        $sqlGetCat = 'SELECT tb_translations.value,
												tb_categories_specs.id
									FROM tb_categories_specs
									JOIN tb_translations ON tb_translations.idTbCodeTranslations = tb_categories_specs.idTbTransCodes
									WHERE tb_translations.idTbLanguage = 3';
        if ($result1 = $connection->query($sqlGetCat)) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                array_push($categories, array($row1['id'], $row1['value']));
            }
        }

        $specs = array();
        $sqlGetSpecs = 'SELECT
										tb_specs.id,
										tb_translations.value
										FROM tb_specs
										JOIN tb_translations ON tb_translations.idTbCodeTranslations = tb_specs.idTbTransCodes
										WHERE tb_translations.idTbLanguage = 3';

        if ($result1 = $connection->query($sqlGetSpecs)) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                array_push($specs, array($row1['id'], $row1['value']));
            }
        }

        echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$modelValues.'||'.json_encode($modelsSpecs).'||'.$modelImg.'||'.$listDivisions.'||'.$plantaImg.'||'.json_encode($modelsSpecsTech).'||'.json_encode($categories).'||'.json_encode($specs);
    }
}

function funCreateItemsModel($vfLang, $vfIdLang, $vfDescription, $vfKeywords, $vfDescriptionSeo, $vfFileUpload, $flag, $vfIdTrans, $vfTokenPDF)
{
    if ($flag) {
        $active = 'active';
    } else {
        $active = '';
    }
    $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'">    <br>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Descrição do modelo</label>';
    $value .= '		<textarea id="descModel_'.$vfLang.'" name="descModel_'.$vfLang.'" class="form-control" required>'.$vfDescription.'</textarea>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Keywords Seo</label>';
    $value .= '		<input id="keyModelSeo_'.$vfLang.'" name="keyModelSeo_'.$vfLang.'" class="form-control"  value="'.$vfKeywords.'" required>';
    $value .= '	</div>';
    $value .= '	<div class="form-group">';
    $value .= '		<label>Descrição Seo</label>';
    $value .= '		<textarea id="descModelSeo_'.$vfLang.'" name="descModelSeo_'.$vfLang.'" class="form-control" value="" required>'.$vfDescriptionSeo.' </textarea>';
    $value .= '	</div>';
    $value .= '<div class="form-group col-sm-4">';
    $value .= '	<label>Upload File</label>';
    $value .= '	 <input id="fileToUpload_'.$vfLang.'" type="file" name="fileToUpload_'.$vfLang.'" id="fileToUpload" value="'.$vfFileUpload.'">';
    $value .= '	 <label>PDF Actual: '.$vfFileUpload.'</label>';
    $value .= '</div>';
    $value .= '<div class="col-lg-6 col-md-6"> ';
    $value .= '<div class="form-group">';
    $value .= '<label for="name">PDF Token:</label>';
    $value .= '<input type="name" class="form-control" id="tokenModel_'.$vfLang.'" name="tokenModel_'.$vfLang.'" value="'.$vfTokenPDF.'" required="">';
    $value .= '</div>';
    $value .= '</div>';
    $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
    $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
    $value .= '	</div>';
    $value .= '</div>';

    return $value;
}

function funGetTermsNew()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listNavBar = '';
    $listFormBar = '';
    $valueTrans = '';
    $valuePage = '';

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
            $viArrayValues['lang'] = $row['langMin'];
            $viArrayValues['titleTerms'] = '';
            $viArrayValues['textTerms'] = '';
            $viArrayValues['idTrans'] = '';
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateTermsItems($viArrayValues);
        }
    }

    echo 'true||'.$listNavBar.'||'.$listFormBar;
}

function funGetTermsEdit()
{
    // var_dump($_REQUEST);
    // die();
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listNavBar = '';
    $listFormBar = '';
    $valueTrans = '';
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

            $sqlCmd2 = "SELECT
									tb_terms_translation.id,
									tb_terms_translation.title,
									tb_terms_translation.text,
									tb_terms_location.id AS id_0,
									tb_terms_location.page
									FROM
									tb_terms_translation
									JOIN tb_terms
									ON tb_terms_translation.idTbTerms = tb_terms.id
									JOIN tb_terms_location
									ON tb_terms.idTbTermsLocation = tb_terms_location.id
									WHERE
										tb_terms.id = '".$id."'
									AND
										tb_terms_translation.idTbLanguage = ".$row['id'].';';

            if ($result2 = $connection->query($sqlCmd2)) {
                $numRows = mysqli_num_rows($result2);
                $viArrayValues = [];
                if ($numRows == 1) {
                    $row1 = mysqli_fetch_assoc($result2);
                    if ($valuePage == '') {
                        $valuePage = $row1['id_0'];
                    }
                    if ($listFormBar != '') {
                        $flag = false;
                    } else {
                        $flag = true;
                    }
                    $viArrayValues['lang'] = $row['langMin'];
                    $viArrayValues['textTerms'] = $row1['text'];
                    $viArrayValues['titleTerms'] = $row1['title'];
                    $viArrayValues['idTrans'] = $row1['id'];
                    $viArrayValues['flag'] = $flag;
                } else {
                    if ($listFormBar != '') {
                        $flag = false;
                    } else {
                        $flag = true;
                    }
                    $viArrayValues['lang'] = $row['langMin'];
                    $viArrayValues['textTerms'] = '';
                    $viArrayValues['titleTerms'] = '';
                    $viArrayValues['idTrans'] = '';
                    $viArrayValues['flag'] = $flag;
                }
                $listFormBar .= funCreateTermsItems($viArrayValues);
            }
        }
    }
    echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.$valuePage;
}

function funCreateTermsItems($vfArrayValues)
{
    if ($vfArrayValues['flag'] == 'true') {
        $active = 'active';
    } else {
        $active = '';
    }
    $vfLang = $vfArrayValues['lang'];
    $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
    $value .= '		<div class="form-group col-sm-12">';
    $value .= '			<label>Titulo Termos</label>';
    $value .= '			<input id="title_terms" name="title_terms_'.$vfLang.'" class="form-control ckeditor" value= "'.$vfArrayValues['titleTerms'].'" required> ';
    $value .= '		</div>';
    $value .= '		<div class="form-group col-sm-12">';
    $value .= '			<label>Texto termos</label>';
    $value .= '			<textarea id="text_terms" name="text_terms_'.$vfLang.'" class="form-control" required> '.$vfArrayValues['textTerms'].'</textarea>';
    $value .= '		</div>';
    $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
    $value .= '</div>';

    return $value;
}

function funGetNewSpecAtr()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $listNavBar = '';
    $listFormBar = '';
    $categories = array();

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
            $viArrayValues['lang'] = $row['langMin'];
            $viArrayValues['translate'] = '';
            $viArrayValues['idTrans'] = $row['id'];
            $viArrayValues['flag'] = $flag;
            $listFormBar .= funCreateSpecItems($viArrayValues);
        }
    }
    $sqlGetCat = 'SELECT tb_translations.value,
											tb_categories_specs.id
								FROM tb_categories_specs
								JOIN tb_translations ON tb_translations.idTbCodeTranslations = tb_categories_specs.idTbTransCodes
								WHERE tb_translations.idTbLanguage = 3';
    if ($result1 = $connection->query($sqlGetCat)) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            array_push($categories, array($row1['id'], $row1['value']));
        }
    }
    echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.json_encode($categories);
}

function funCreateSpecItems($vfArrayValues)
{
    if ($vfArrayValues['flag'] == 'true') {
        $active = 'active';
    } else {
        $active = '';
    }
    $vfLang = $vfArrayValues['lang'];
    $value = '<div class="tab-pane fade '.$active.' in col-sm-12" id="'.$vfLang.'"> <br>';
    $value .= '		<div class="form-group col-sm-12">';
    $value .= '			<label>Nome</label>';
    $value .= '			<input id="name_'.$vfLang.'" name="name_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['translate'].'">';
    $value .= '		</div>';
    $value .= '<input  type="hidden" id="idTrans" name="idTrans_'.$vfLang.'" class="form-control" value="'.$vfArrayValues['idTrans'].'">';
    $value .= '</div>';

    return $value;
}

function funGetSpecs()
{
    include_once PATH_DATABASE_INC;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sqlCmd = 'SELECT
						tb_translations.value,
						tb_specs.id
						FROM
						tb_specs
						JOIN tb_translations_codes
						ON tb_specs.idTbTransCodes = tb_translations_codes.id
						JOIN tb_translations
						ON tb_translations_codes.id = tb_translations.idTbCodeTranslations
						WHERE tb_specs.status = 0
						GROUP BY tb_specs.id';
    $values = '';
    if ($result = $connection->query($sqlCmd)) {
        $arrayMain = [];
        while ($rsData = mysqli_fetch_assoc($result)) {
            $urlToEdit = "location.href='especificacoes-editar.php?id=".$rsData['id']."'";
            $urlToDelete = 'funDeleteItem('.$rsData['id'].')';
            $values = '<button class="fa fa-edit" style="padding:5px; margin-left:10px" onclick="'.$urlToEdit.'"></button>';
            $values .= '<button class="fa fa-trash" style="padding:5px; margin-left:10px" onclick="'.$urlToDelete.'"></button>';
            array_push($arrayMain, [$rsData['id'], $rsData['value'], $values]);
        }
    }

    echo json_encode($arrayMain);
    $db->closeConnection();
}

    function funGetSpec()
    {
        include_once PATH_DATABASE_INC;
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $id = $_REQUEST['id'];
        $categories = array();
        $specData = array();

        $sqlGetCat = 'SELECT tb_translations.value,
												tb_categories_specs.idTbTransCodes
									FROM tb_categories_specs
									JOIN tb_translations ON tb_translations.idTbCodeTranslations = tb_categories_specs.idTbTransCodes
									WHERE tb_translations.idTbLanguage = 3';
        if ($result1 = $connection->query($sqlGetCat)) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                array_push($categories, array($row1['idTbTransCodes'], $row1['value']));
            }
        }

        $sqlGetSpec = "SELECT
										tb_specs.id,
										tb_specs.idTbCategoriesSpecs,
										tb_translations_codes.code,
										tb_specs.idTbTransCodes,
										tb_specs.default
										FROM
										tb_specs
										JOIN tb_translations_codes ON tb_translations_codes.id = tb_specs.idTbTransCodes
										WHERE
										tb_specs.id=$id
										GROUP BY
										tb_specs.id";

        if ($result = $connection->query($sqlGetSpec)) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($specData, array($row['id'], $row['idTbCategoriesSpecs'], $row['code'], $row['idTbTransCodes'], $row['default']));
            }
        }

        $listNavBar = '';
        $listFormBar = '';

        $sqlCmd = 'SELECT * FROM tb_language WHERE deleted = 0';
        if ($result = $connection->query($sqlCmd)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idLanguage = $row['id'];
                if ($listNavBar == '') {
                    $listNavBar = '<li class="active"><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                } else {
                    $listNavBar .= '<li class=""><a href="#'.$row['langMin'].'" data-toggle="tab" aria-expanded="true">'.$row['lang'].'</a></li>';
                }
                $sqlCmd2 = "SELECT
										tb_translations.value,
										tb_translations.id
										FROM
										tb_specs
										JOIN tb_translations
										ON tb_specs.idTbTransCodes = tb_translations.idTbCodeTranslations
										JOIN tb_language ON tb_language.id = tb_translations.idTbLanguage
										WHERE
										tb_specs.id=$id
										AND
										tb_language.id = $idLanguage";

                if ($result2 = $connection->query($sqlCmd2)) {
                    $numRows = mysqli_num_rows($result2);
                    if ($numRows == 1) {
                        while ($row1 = mysqli_fetch_assoc($result2)) {
                            if ($listFormBar != '') {
                                $flag = false;
                            } else {
                                $flag = true;
                            }
                            $viArrayValues['lang'] = $row['langMin'];
                            $viArrayValues['translate'] = $row1['value'];
                            $viArrayValues['idTrans'] = $row1['id'];
                            $viArrayValues['flag'] = $flag;
                        }
                    } else {
                        if ($listFormBar != '') {
                            $flag = false;
                        } else {
                            $flag = true;
                        }
                        $viArrayValues['lang'] = $row['langMin'];
                        $viArrayValues['translate'] = '';
                        $viArrayValues['idTrans'] = '';
                        $viArrayValues['flag'] = $flag;
                    }
                    $listFormBar .= funCreateSpecItems($viArrayValues);
                }
            }
        }
        echo 'true||'.$listNavBar.'||'.$listFormBar.'||'.json_encode($categories).'||'.json_encode($specData);
    }
