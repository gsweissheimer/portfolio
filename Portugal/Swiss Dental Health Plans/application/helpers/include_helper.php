<?php
// define ('URLAMIGAVEL', 'https://www.ceroa.pt/');
// define ('URLAMIGAVEL', 'http://localhost/repositories/CEROA/');
// define ('URLAMIGAVEL', 'http://localhost/CEROA/');
define ('URLAMIGAVEL', 'http://localhost/sdc/');
define ('URLFRONT', 'http://localhost:8080/');

function curPageName()
{
    return substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
}

function funGetLinkToShare()
{
    return $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

function funGetHost()
{
    return $_SERVER['HTTP_HOST'];
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function funGetCountry()
{
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];
    $country = 'Unknown';
    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://www.geoplugin.net/json.gp?ip='.$ip);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ip_data_in = curl_exec($ch); // string
    curl_close($ch);
 
    $ip_data = json_decode($ip_data_in, true);
    $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/
    if ($ip_data && $ip_data['geoplugin_countryCode'] != null) {
        $country = $ip_data['geoplugin_countryCode'];
    }

    // ########### EU MUDEI AQUI

    $country = 'ENG';

    //return 'IP: '.$ip.' # Country: '.$country;
    return $country;
}

/*function funGetCountry(){
  $json = file_get_contents("http://www.freegeoip.net/json/");
  $obj = json_decode($json);
  $country = $obj->country_code;
  return $country;
}*/

function getcookie($name)
{
    $cookies = [];
    $headers = headers_list();
    // see http://tools.ietf.org/html/rfc6265#section-4.1.1
    foreach ($headers as $header) {
        if (strpos($header, 'Set-Cookie: ') === 0) {
            $value = str_replace('&', urlencode('&'), substr($header, 12));
            parse_str(current(explode(';', $value, 1)), $pair);
            $cookies = array_merge_recursive($cookies, $pair);
        }
    }
    if (!isset($cookies[$name])) {
        return '';
    } else {
        return $cookies[$name];
    }
}

function funSetCookie($vfNameCookie, $vfCookieValue, $force = false)
{
    if (!isset($_COOKIE[$vfNameCookie]) || $force) {
        setcookie($vfNameCookie, $vfCookieValue, 0, '/');
        $_COOKIE[$vfNameCookie] = $vfCookieValue;
    }
}
function funSetCookie_ehsan($vfNameCookie, $vfCookieValue)
{
    setcookie($vfNameCookie, $vfCookieValue, 0, '/');
    $_COOKIE[$vfNameCookie] = $vfCookieValue;
}

include_once 'globalVars.php';
include_once PATH_DATABASE_BASE;
$db = Database::getInstance();
$connection = $db->getConnection();
$countryMin = ''; //funGetCountry();
if ($countryMin == '' || $countryMin == 'Unknown') {
    $countryMin = 'PT';
}
$countryCode = 'EN';


//funSetCookie('country', $countryMin, true);
if (isset($_COOKIE['country'])) {
    $countryCode = $_COOKIE['country'];
} else {
    $countryCode = funGetCountry();
}
if (!isset($_COOKIE['lang'])) {
    switch ($countryCode) {
        case 'PT':
        case 'BR':
            funSetCookie_ehsan('lang', 'PT');
            break;
        case 'FR':
        case 'BE':
            funSetCookie_ehsan('lang', 'FR');
            break;
        default:
        funSetCookie_ehsan('lang', 'EN');
        break;
    }
    // funSetCookie_ehsan('lang', $countryCode);
}else{
    if ($_COOKIE['lang']=="PT"){
        funSetCookie_ehsan('lang', 'PT');
        $lang = "PT";
    }  elseif ($_COOKIE['lang']=="BR"){
        funSetCookie_ehsan('lang', 'PT');
        $lang = "PT";
    } elseif ($_COOKIE['lang']=="EN"){
        funSetCookie_ehsan('lang', 'EN');
        $lang = "EN";
    } elseif ($_COOKIE['lang']=="GB"){
        funSetCookie_ehsan('lang', 'EN');
        $lang = "EN";
    } elseif ($_COOKIE['lang']=="BE"){
        funSetCookie_ehsan('lang', 'FR');
        $lang = "FR";
    } elseif ($_COOKIE['lang']=="FR"){
        funSetCookie_ehsan('lang', 'FR');
        $lang = "FR";
    }else{
        funSetCookie_ehsan('lang', 'EN');
        $lang = "EN";
    }
}
if (isset($_GET['l'])) {
    funSetCookie_ehsan('lang', $_GET['l']);
}
$listLangHide = '';
$listSocialMedia = '';
$countryID = null;
$sql = "SELECT
          tb_country.id,
          tb_country_language.defaultLang,
          tb_timezone.timezone,
          tb_language.langMin
        FROM
          tb_country
        JOIN tb_country_language
          ON tb_country.id = tb_country_language.idTbCountry
        JOIN tb_country_codes
          ON tb_country_codes.id = tb_country.idTbCountryCode
        JOIN tb_timezone
          ON tb_country.idTbTimezone = tb_timezone.id
        JOIN tb_language
          ON tb_language.id = tb_country_language.idTbLanguage
        WHERE
          tb_country_codes.country_code = '$countryCode'
        AND
          tb_country_language.status = 1
        AND tb_language.deleted=0";
//var_dump($sql, $countryCode);
//exit(0);
if ($result = $connection->query($sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $countryID = $row['id'];
        $E_FLAG = false;
        if (isset($_COOKIE['lang']) && $row['langMin'] == $_COOKIE['lang']) {
            $first = 'first-lang';
            $E_FLAG = true;
        } else {
            $first = '';
        }
        if (($row['defaultLang'] == 1 && !isset($_COOKIE['lang'])) || $E_FLAG) {
            $lang = $row['langMin'];
            if (!isset($_COOKIE['lang'])) {
                $_COOKIE['lang'] = $lang;
            }
            $listLangVisi = '<option class="'.$first.'" value="'.$lang.'">'.$lang.'</option>';
        } else {
            $lang = $row['langMin'];
            $listLangHide .= '<option value="'.$lang.'">'.$lang.'</option>';
        }
    }
}



funSetCookie('countryID', $countryID);
if (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = explode(';', getcookie('lang'))[0];
}

function funLoadMedia($vfElm, $flag, $vfLimit = 'all')
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    if ($vfLimit != 'all') {
        $limit = 'LIMIT '.$vfLimit;
    } else {
        $limit = '';
    }
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    if (isset($_COOKIE['country'])) {
        // ########### EU MUDEI AQUI
        $country = 'ENG';
        // ########### EU MUDEI AQUI
        //$country = $_COOKIE['country'];
    } else {
        $country = 'ENG';
    }
    $i = 0;
    $all_elements = '';
    $sql = "SELECT
          tb_testimonials.name,
          tb_testimonials.date,
          tb_gallery.path
          FROM
          tb_testimonials_media
          JOIN tb_testimonials
          ON tb_testimonials_media.idTbTestimonials = tb_testimonials.id
          JOIN tb_language
          ON tb_language.id = tb_testimonials_media.idTbLang
          JOIN tb_gallery
          ON tb_gallery.id = tb_testimonials_media.idTbGallery
          JOIN tb_country ON tb_country.id = tb_testimonials.idTbCountry
          JOIN tb_country_codes
          ON tb_country.idTbCountryCode = tb_country_codes.id
          WHERE
          tb_testimonials.status =1
          and
          tb_testimonials.flagType = '$flag'
          and
          tb_language.langMin = '$lang'
          AND
            tb_country_codes.country_code = '$country'
          ORDER BY tb_testimonials.date DESC
          $limit
          ";
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image = URLAMIGAVEL.'assets/gallery/'.$row['path'];
            $element_temp = $vfElm;
            $pos = $i + 1;
            $you = $row['path'];
            $element_temp = str_ireplace('{{youpath}}', "'".$you."'", $element_temp);
            $element_temp = str_ireplace('{{you}}', $you, $element_temp);
            $element_temp = str_ireplace('{{date}}', $row['date'], $element_temp);
            $element_temp = str_ireplace('{{name}}', $row['name'], $element_temp);
            $all_elements .= $element_temp;
            ++$i;
        }
        echo $all_elements;
    }
}

function funLoadMediaPress($vfElm, $vfLimit = 'all')
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    if ($vfLimit != 'all') {
        $limit = 'LIMIT '.$vfLimit;
    } else {
        $limit = '';
    }
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }
    $i = 0;
    $all_elements = '';
    $sql = "SELECT
          tb_gallery.path,
          tb_gallery.alt,
          tb_media_translation.title,
          tb_media_translation.desc,
          tb_media.date
          FROM
          tb_media_translation
          JOIN tb_media
          ON tb_media_translation.idTbMedia = tb_media.id
          JOIN tb_language
          ON tb_language.id = tb_media_translation.idTbLanguage
          JOIN tb_gallery
          ON tb_gallery.id = tb_media.idTbGallery
          JOIN tb_country
          ON tb_country.id = tb_media_translation.idTbCountry
          JOIN tb_country_codes
          ON tb_country.idTbCountryCode = tb_country_codes.id
          WHERE
          tb_media.status = 1
          AND
          tb_language.langMin = '$lang'
          AND
            tb_country_codes.country_code = '$country'
          $limit";

    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image = $row['path'];

            $element_temp = $vfElm;
            $pos = $i + 1;
            $pos = str_pad($pos, 2, '0', STR_PAD_LEFT);
            $you = $row['path'];
            $element_temp = str_ireplace('{{pos}}', $pos, $element_temp);
            $element_temp = str_ireplace('{{img}}', $image, $element_temp);
            $element_temp = str_ireplace('{{imgPath}}', "'".$image."'", $element_temp);
            $element_temp = str_ireplace('{{date}}', $row['date'], $element_temp);
            $element_temp = str_ireplace('{{title}}', $row['title'], $element_temp);
            $element_temp = str_ireplace('{{description}}', $row['desc'], $element_temp);
            $all_elements .= $element_temp;
            ++$i;
        }
        echo $all_elements;
    }
}

function funCreateBanner($bannerCode, $bannerHtml)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $tag = $bannerCode;
    $element = $bannerHtml;
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }

    $sqlCmdGetInfo = "SELECT
                      tb_banner_translation.title ,
                      tb_banner_translation.subtitle ,
                      tb_banner_translation.text ,
                      tb_banner_translation.subText ,
                      tb_banner_translation.callTitle ,
                      tb_banner_translation.callAction ,
                      tb_banner.flagCta,
                      tb_gallery.path,
                      tb_gallery.alt,
                      tb_gallery.extension,
                      tb_banner.id
                    FROM
                      tb_banner_translation
                    JOIN tb_banner ON tb_banner_translation.idTbBanner = tb_banner.id
                    JOIN tb_banner_tag ON tb_banner.idTbBannerTag = tb_banner_tag.id
                    LEFT JOIN tb_gallery ON tb_banner.idTbGallery = tb_gallery.id
                    JOIN tb_country ON tb_banner_translation.idTbCountry = tb_country.id
                    JOIN tb_country_codes ON tb_country_codes.id = tb_country.idTbCountryCode
                    JOIN tb_language ON tb_language.id = tb_banner_translation.idTbLanguage
                    JOIN tb_country_language ON tb_country_language.idTbLanguage = tb_language.id
                    WHERE
                      tb_banner_tag.tag = '$tag'
                    AND tb_country_codes.country_code = '$country'
                    AND tb_language.langMin = '$lang'
                    AND tb_banner.status=1
                    AND tb_banner_translation.status=1
                    AND tb_country_language.status=1
                    AND tb_country_language.idTbCountry=tb_country.id
                    AND tb_language.deleted=0";

    $all_elements = '';
    $i = 0;
    if ($result = $connection->query($sqlCmdGetInfo)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['flagCta'] == 1) {
                $ctaTarget = '_blank';
            } else {
                $ctaTarget = '';
            }
            if ($row['extension'] == 'you') {
                $image = 'https://img.youtube.com/vi/'.$row['path'].'/maxresdefault.jpg';
                $imgPath = "'".$row['path']."'";
            } else {
                $image = URLAMIGAVEL.$row['path'];
                $imgPath = '';
            }
            $EvenOdd = '';
            if ($i % 2 == 0) {
                $EvenOdd = 'evenBlock';
            } else {
                $EvenOdd = 'oddBlock';
            }
            $element_temp = $element;
            $pos = $i + 1;
            $element_temp = str_ireplace('{{pos}}', $pos, $element_temp);
            $element_temp = str_ireplace('{{classanime}}', 'anim-delay-'.$i, $element_temp);
            $element_temp = str_ireplace('{{title}}', $row['title'], $element_temp);
            $element_temp = str_ireplace('{{imgPath}}', $imgPath, $element_temp);
            $element_temp = str_ireplace('{{id}}', $i.'_'.$row['id'], $element_temp);
            $element_temp = str_ireplace('{{subtitle}}', $row['subtitle'], $element_temp);
            $element_temp = str_ireplace('{{text}}', $row['text'], $element_temp);
            $element_temp = str_ireplace('{{subText}}', $row['subText'], $element_temp);
            $element_temp = str_ireplace('{{calltoAction}}', $row['callAction'], $element_temp);
            $element_temp = str_ireplace('{{callTitle}}', $row['callTitle'], $element_temp);
            $element_temp = str_ireplace('{{alt}}', $row['alt'], $element_temp);
            $element_temp = str_ireplace('{{img}}', $image, $element_temp);
            $element_temp = str_ireplace('{{ctaTarget}}', $ctaTarget, $element_temp);
            $element_temp = str_ireplace('{{EvenOdd}}', $EvenOdd, $element_temp);

            $all_elements .= $element_temp;
            ++$i;
        }

        return $all_elements;
    }
}

function funCreateBanner2($bannerCode, $bannerHtml, $bannerRight)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $tag = $bannerCode;
    $element = $bannerHtml;
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }

    $sqlCmdGetInfo = "SELECT
                      tb_banner_translation.title ,
                      tb_banner_translation.subtitle ,
                      tb_banner_translation.text ,
                      tb_banner_translation.subText ,
                      tb_banner_translation.callTitle ,
                      tb_banner_translation.callAction ,
                      tb_gallery.path,
                      tb_gallery.alt,
                      tb_banner.id
                    FROM
                      tb_banner_translation
                    JOIN tb_banner ON tb_banner_translation.idTbBanner = tb_banner.id
                    JOIN tb_banner_tag ON tb_banner.idTbBannerTag = tb_banner_tag.id
                    LEFT JOIN tb_gallery ON tb_banner.idTbGallery = tb_gallery.id
                    JOIN tb_country ON tb_banner_translation.idTbCountry = tb_country.id
                    JOIN tb_country_codes ON tb_country_codes.id = tb_country.idTbCountryCode
                    JOIN tb_language ON tb_language.id = tb_banner_translation.idTbLanguage
                    JOIN tb_country_language ON tb_country_language.idTbLanguage = tb_language.id
                    WHERE
                      tb_banner_tag.tag = '$tag'
                    AND tb_country_codes.country_code = '$country'
                    AND tb_language.langMin = '$lang'
                    AND tb_banner.status=1
                    AND tb_banner_translation.status = 1
                    AND tb_country_language.status=1
                    AND tb_country_language.idTbCountry=tb_country.id
                    AND tb_language.deleted=0";

    $all_elements = '';
    $i = 0;
    if ($result = $connection->query($sqlCmdGetInfo)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image = URLAMIGAVEL.'assets/gallery/'.$row['path'];
            $pos = $i + 1;
            if ($i % 2 == 0) {
                $element_temp = $element;
            } else {
                $element_temp = $bannerRight;
            }

            $element_temp = str_ireplace('{{pos}}', $pos, $element_temp);
            $element_temp = str_ireplace('{{classanime}}', 'anim-delay-'.$i, $element_temp);
            $element_temp = str_ireplace('{{title}}', $row['title'], $element_temp);
            $element_temp = str_ireplace('{{id}}', $i.'_'.$row['id'], $element_temp);
            $element_temp = str_ireplace('{{subtitle}}', $row['subtitle'], $element_temp);
            $element_temp = str_ireplace('{{text}}', $row['text'], $element_temp);
            $element_temp = str_ireplace('{{subText}}', $row['subText'], $element_temp);
            $element_temp = str_ireplace('{{calltoAction}}', $row['callAction'], $element_temp);
            $element_temp = str_ireplace('{{callTitle}}', $row['callTitle'], $element_temp);
            $element_temp = str_ireplace('{{alt}}', $row['alt'], $element_temp);
            $element_temp = str_ireplace('{{img}}', $row['path'], $element_temp);
            $all_elements .= $element_temp;
            ++$i;
        }
        echo $all_elements;
    }
}

function funGetFeatures($featureCode, $featureHtml,$position=null)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $data = '';
    $tag = $featureCode;
    $element = $featureHtml;
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    $lang = 'EN';
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }
    $country = 'ENG';

    $sqlCmdGetInfo = "SELECT
                    tb_advantage_translation.title,
                    tb_advantage_translation.subtitle,
                    tb_advantage_translation.description,
                    tb_advantage_translation.cta,
                    tb_advantage_translation.action,
                    tb_advantage_translation.id,
                    tb_gallery.path,
                    tb_gallery.alt,
                    tb_advantage.isFeature,
                    tb_advantage.position
                    FROM
                    tb_advantage_tag
                    JOIN tb_advantage
                    ON tb_advantage_tag.id = tb_advantage.idTbAdvantageTag
                    JOIN tb_advantage_translation
                    ON tb_advantage.id = tb_advantage_translation.idTbAdvantage
                    JOIN tb_country
                    ON tb_advantage_translation.idTbCountry = tb_country.id
                    JOIN tb_country_codes
                    ON tb_country.idTbCountryCode = tb_country_codes.id
                    JOIN tb_gallery
                    ON tb_gallery.id = tb_advantage.idTbGallery
                    JOIN tb_language
                    ON tb_language.id = tb_advantage_translation.idTbLanguage
                    WHERE
                    tb_advantage.isFeature = 1
                    and tb_advantage_tag.tag = '$tag'
                    and tb_language.langMin = '$lang'
                    and tb_country.abbCountry='$country'
                    and tb_advantage.status=1
                    and tb_advantage_translation.status = 1";
    
    if ($position!=null){
        $sqlCmdGetInfo.=" and  tb_advantage.position='$position'";
    }
    $all_elements = "<!-- FEATURE $tag -->".PHP_EOL;
    $i = 0;

    if ($result = $connection->query($sqlCmdGetInfo)) {
        $numRows = mysqli_num_rows($result);
        while ($row = mysqli_fetch_assoc($result)) {
            $temp = URLAMIGAVEL .  $row['path'];
            $j = $i + 1;
            $element_temp = $element;
            $element_temp = str_ireplace('{{i}}', $j, $element_temp);
            $element_temp = str_ireplace('{{pos}}', $row['position'], $element_temp);
            $element_temp = str_ireplace('{{total}}', $numRows, $element_temp);
            $element_temp = str_ireplace('{{title}}', $row['title'], $element_temp);
            $element_temp = str_ireplace('{{id}}', $i.'_'.$row['id'], $element_temp);
            $element_temp = str_ireplace('{{subtitle}}', $row['subtitle'], $element_temp);
            $element_temp = str_ireplace('{{text}}', $row['description'], $element_temp);
            $element_temp = str_ireplace('{{calltoAction}}', $row['cta'], $element_temp);
            $element_temp = str_ireplace('{{action}}', $row['action'], $element_temp);
            $element_temp = str_ireplace('{{img}}', $temp, $element_temp);
            $element_temp = str_ireplace('{{alt}}', $row['alt'], $element_temp);
            $all_elements .= $element_temp;
            ++$i;
        }

        return $all_elements;
    }
}

function funGetFeaturesNoImg($featureCode, $featureHtml,$position=null)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $data = '';
    $tag = $featureCode;
    $element = $featureHtml;
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    $lang = 'EN';
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }
    $country = 'ENG';

    $sqlCmdGetInfo = "SELECT
                    tb_advantage_translation.title,
                    tb_advantage_translation.subtitle,
                    tb_advantage_translation.description,
                    tb_advantage_translation.cta,
                    tb_advantage_translation.action,
                    tb_advantage_translation.id,
                    tb_advantage.isFeature,
                    tb_advantage.position
                    FROM
                    tb_advantage_tag
                    JOIN tb_advantage
                    ON tb_advantage_tag.id = tb_advantage.idTbAdvantageTag
                    JOIN tb_advantage_translation
                    ON tb_advantage.id = tb_advantage_translation.idTbAdvantage
                    JOIN tb_country
                    ON tb_advantage_translation.idTbCountry = tb_country.id
                    JOIN tb_country_codes
                    ON tb_country.idTbCountryCode = tb_country_codes.id
                    JOIN tb_language
                    ON tb_language.id = tb_advantage_translation.idTbLanguage
                    WHERE
                    tb_advantage.isFeature = 1
                    and tb_advantage_tag.tag = '$tag'
                    and tb_language.langMin = '$lang'
                    and tb_country.abbCountry='$country'
                    and tb_advantage.status=1
                    and tb_advantage_translation.status = 1";
    
    if ($position!=null){
        $sqlCmdGetInfo.=" and  tb_advantage.position='$position'";
    }
    $all_elements = "<!-- FEATURE $tag -->".PHP_EOL;
    $i = 0;

    if ($result = $connection->query($sqlCmdGetInfo)) {
        $numRows = mysqli_num_rows($result);
        while ($row = mysqli_fetch_assoc($result)) {
            //$temp = URLAMIGAVEL .  $row['path'];
            $j = $i + 1;
            $element_temp = $element;
            $element_temp = str_ireplace('{{i}}', $j, $element_temp);
            $element_temp = str_ireplace('{{pos}}', $row['position'], $element_temp);
            $element_temp = str_ireplace('{{total}}', $numRows, $element_temp);
            $element_temp = str_ireplace('{{title}}', $row['title'], $element_temp);
            $element_temp = str_ireplace('{{id}}', $i.'_'.$row['id'], $element_temp);
            $element_temp = str_ireplace('{{subtitle}}', $row['subtitle'], $element_temp);
            $element_temp = str_ireplace('{{text}}', $row['description'], $element_temp);
            $element_temp = str_ireplace('{{calltoAction}}', $row['cta'], $element_temp);
            $element_temp = str_ireplace('{{action}}', $row['action'], $element_temp);
            //$element_temp = str_ireplace('{{img}}', $temp, $element_temp);
            //$element_temp = str_ireplace('{{alt}}', $row['alt'], $element_temp);
            $all_elements .= $element_temp;
            ++$i;
        }

        return $all_elements;
    }
}

function getFeaturesAsArray($featureCode)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $data = '';
    $tag = $featureCode;
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }

    $sqlCmdGetInfo = "SELECT
                    tb_advantage_translation.title,
                    tb_advantage_translation.subtitle,
                    tb_advantage_translation.description,
                    tb_advantage_translation.cta,
                    tb_advantage_translation.id,
                    tb_gallery.path,
                    tb_gallery.alt,
                    tb_advantage.isFeature,
                    tb_advantage.position
                    FROM
                    tb_advantage_tag
                    JOIN tb_advantage
                    ON tb_advantage_tag.id = tb_advantage.idTbAdvantageTag
                    JOIN tb_advantage_translation
                    ON tb_advantage.id = tb_advantage_translation.idTbAdvantage
                    JOIN tb_country
                    ON tb_advantage_translation.idTbCountry = tb_country.id
                    JOIN tb_country_codes
                    ON tb_country.idTbCountryCode = tb_country_codes.id
                    JOIN tb_gallery
                    ON tb_gallery.id = tb_advantage.idTbGallery
                    JOIN tb_language
                    ON tb_language.id = tb_advantage_translation.idTbLanguage
                    WHERE
                    tb_advantage.isFeature = 1
                    and tb_advantage_tag.tag = '$tag'
                    and tb_language.langMin = '$lang'
                    and tb_country_codes.country_code='$country'
                    and tb_advantage.status=1
                    and tb_advantage_translation.status = 1";
    $all_elements = array();
    $i = 0;
    if ($result = $connection->query($sqlCmdGetInfo)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $j = $i + 1;
            array_push($all_elements, array(
                'i' => $j,
                'pos' => $row['position'],
                'title' => $row['title'],
                'id' => $i.'_'.$row['id'],
                'subtitle' => $row['subtitle'],
                'text' => $row['description'],
                'callToAction' => $row['cta'],
                'img' => URLAMIGAVEL . $row['path'],
                'alt' => $row['alt'],
            ));
            ++$i;
        }

        return $all_elements;
    }
}

function funGetPackages($packageCode, $packageHtml)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $data = '';
    $tag = $packageCode;
    $element = $packageHtml;
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }

    $sqlCmdGetInfo = "SELECT
                    tb_packages_translation.Title,
                    tb_packages_translation.price,
                    tb_packages_translation.items,
                    tb_packages_translation.buttontext,
                    tb_packages_translation.action,
                    tb_packages_translation.id,
                    tb_packages.recomended,
                    tb_gallery.path,
                    tb_gallery.alt,
                    tb_packages.isPackage,
                    tb_packages.position
                    FROM
                    tb_packages_tag
                    JOIN tb_packages
                    ON tb_packages_tag.id = tb_packages.idTbPackagesTag
                    JOIN tb_packages_translation
                    ON tb_packages.id = tb_packages_translation.idTbPackage
                    JOIN tb_country
                    ON tb_packages_translation.idTbCountry = tb_country.id
                    JOIN tb_country_codes
                    ON tb_country.idTbCountryCode = tb_country_codes.id
                    JOIN tb_gallery
                    ON tb_gallery.id = tb_packages.idTbGallery
                    JOIN tb_language
                    ON tb_language.id = tb_packages_translation.idTbLanguage
                    WHERE
                    tb_packages.isPackage = 1
                    and tb_packages_tag.tag = '$tag'
                    and tb_language.langMin = '$lang'
                    and tb_country_codes.country_code='$country'
                    and tb_packages.status=1
                    and tb_packages_translation.status = 1";

    $all_elements = '';
    $INDICATORS = '';
    $i = 0;
    if ($result = $connection->query($sqlCmdGetInfo)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tempvar = $row['price'];
            $pieces = explode('|', $tempvar);
            if (isset($pieces[0])) {
                $CurrencySymbol = $pieces[0];
            } else {
                $CurrencySymbol = '';
            }
            if (isset($pieces[1])) {
                $pricevalue = $pieces[1];
            } else {
                $pricevalue = '';
            }
            if (isset($pieces[2])) {
                $period = $pieces[2];
            } else {
                $period = '';
            }
            if ($i == 0) {
                $active = 'active';
            } else {
                $active = '';
            }
            if ($row['recomended'] != 0) {
                $recomended = 'recommended';
            } else {
                $recomended = '';
            }
            $items = $row['items'];
            $items = str_ireplace('<p><br></p>', '', $items);
            $items = str_ireplace('<p></p>', '', $items);
            $items = str_ireplace('<p>&nbsp;</p>', '', $items);
            $items = str_ireplace('</p><p>', '</li><li>', $items);
            $items = str_ireplace('<p>', '<li>', $items);
            $items = str_ireplace('</p>', '</li>', $items);
            $j = $i + 1;
            $element_temp = $element;
            $element_temp = str_ireplace('{{i}}', $j, $element_temp);
            $element_temp = str_ireplace('{{reco}}', $recomended, $element_temp);
            $element_temp = str_ireplace('{{pos}}', $row['position'], $element_temp);
            $element_temp = str_ireplace('{{title}}', $row['Title'], $element_temp);
            $element_temp = str_ireplace('{{id}}', $i.'_'.$row['id'], $element_temp);
            $element_temp = str_ireplace('{{sym}}', $CurrencySymbol, $element_temp);
            $element_temp = str_ireplace('{{pricevalue}}', $pricevalue, $element_temp);
            $element_temp = str_ireplace('{{period}}', $period, $element_temp);
            $element_temp = str_ireplace('{{price}}', $row['price'], $element_temp);
            $element_temp = str_ireplace('{{items}}', $items, $element_temp);
            $element_temp = str_ireplace('{{bttext}}', $row['buttontext'], $element_temp);
            $element_temp = str_ireplace('{{Action}}', $row['action'], $element_temp);
            $element_temp = str_ireplace('{{img}}', URLAMIGAVEL . $row['path'], $element_temp);
            $element_temp = str_ireplace('{{alt}}', $row['alt'], $element_temp);
            $element_temp = str_ireplace('{{active}}', $active, $element_temp);
            $all_elements .= $element_temp;
            $INDICATORS .= '<li data-target="#packCarousel" data-slide-to="'.$i.'" class="{{active}}"></li>';
            ++$i;
        }

        return $all_elements.'||'.$INDICATORS;
    }
}

function funGetSlide($slideCode, $secTitle
, $slideIndicators, $itemMainSlide, $classToAdd = 'active', $classIfNotFirstToAdd = '', $arr = null)
{

    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $data = '';
    $auxindex = 0;

    $tag = $slideCode;
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    $lang = 'EN';
    if (isset($_COOKIE['countryID'])) {
        $country = $_COOKIE['countryID'];
    } else {
        $country = '1';
    }
    $country = '3';

    $sqlCmdGetInfo = "SELECT
                      tb_slide_translation.id,
                      tb_slide_translation.title,
                      tb_slide_translation.subtitle,
                      tb_slide_translation.text,
                      tb_slide_translation.callTitle,
                      tb_slide_translation.callAction,
                      tb_slide.flagCta,
                      tb_gallery.alt,
                      tb_gallery.path
                    FROM
                      tb_slide_code
                    JOIN tb_slide
                    ON tb_slide_code.id = tb_slide.idTbSlideCode
                    JOIN tb_slide_translation
                    ON tb_slide_translation.idTbSlide = tb_slide.id
                    JOIN tb_slide_gallery
                    ON tb_slide_gallery.idTbSlide = tb_slide.id
                    JOIN tb_gallery
                    ON tb_slide_gallery.idTbGallery = tb_gallery.id
                    JOIN tb_language
                    ON tb_language.id = tb_slide_translation.idTbLanguage
                    WHERE
                      tb_slide_code.code= '$slideCode'
                    AND
                      tb_slide_translation.status = 1
                    AND
                      tb_slide.status = 1
                    AND
                      tb_language.langMin = '$lang'
                    AND
                      tb_slide_translation.idTbCountry = '$country'
                    AND tb_slide_gallery.status=1";

    $all_elements = '';
    $i = 0;
			
    // echo $sqlCmdGetInfo;
    if ($result = $connection->query($sqlCmdGetInfo)) {
	
        $tmpSecTitle = '';
        $tmpSlidIndicators = '';
        $tmpItemMainSlide = '';
        while ($row = mysqli_fetch_assoc($result)) {
            // echo .row
            $eleSecTitle = $secTitle;
            $eleSlideIndicators = $slideIndicators;
            $eleItemMainSlide = $itemMainSlide;
            if ($row['flagCta'] == 1) {
                $ctaTarget = '_blank';
            } else {
                $ctaTarget = '_self';
            }
            if ($i == 0) {
                // $j = $i - 1;
                $active = $classToAdd;
            } else {
                $active = $classIfNotFirstToAdd;
            }
            $rpos = $i + 1;
			
            $eleSecTitle = str_ireplace('{{subtitle}}', $row['subtitle'], $eleSecTitle);
            $eleSecTitle = str_ireplace('{{title}}', $row['title'], $eleSecTitle);
            $eleSecTitle = str_ireplace('{{pos}}', $rpos, $eleSecTitle);
            $eleSecTitle = str_ireplace('{{posSlide}}', $i, $eleSecTitle);
            $eleSecTitle = str_ireplace('{{text}}', $row['text'], $eleSecTitle);
            $eleSecTitle = str_ireplace('{{active}}', $active, $eleSecTitle);
            $eleSecTitle = str_ireplace('{{description}}', $row['text'], $eleSecTitle);
            $tmpSecTitle .= $eleSecTitle;
			
            //$eleSlideIndicators = str_ireplace('{{pos}}', $i, $eleSlideIndicators);
            $eleSlideIndicators = str_ireplace('{{posSlide}}', $rpos - 1, $eleSlideIndicators);
            $eleSlideIndicators = str_ireplace('{{active}}', $active, $eleSlideIndicators);
            $eleSlideIndicators = str_ireplace('{{title}}', $row['title'], $eleSlideIndicators);
            $tmpSlidIndicators .= $eleSlideIndicators;

            $eleItemMainSlide = str_ireplace('{{active}}', $active, $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{img}}', URLAMIGAVEL . $row['path'], $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{alt}}', $row['alt'], $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{title}}', $row['title'], $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{posSlide}}', $i, $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{description}}', $row['text'], $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{subtitle}}', $row['subtitle'], $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{ctaTitle}}', $row['callTitle'], $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{callAction}}', $row['callAction'], $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{ctaTarget}}', $ctaTarget, $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{text}}', $row['text'], $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('{{i}}', $arr ? $arr[$auxindex] : "", $eleItemMainSlide);
            $eleItemMainSlide = str_ireplace('&nbsp;','', $eleItemMainSlide);
            $tmpItemMainSlide .= $eleItemMainSlide;

            $auxindex++;

        }

        echo $secTitle = $tmpSecTitle;
        echo $slideIndicators = $tmpSlidIndicators;
        echo $itemMainSlide = $tmpItemMainSlide;
    }
}

function funSortMenuArray($menu)
{
    usort($menu, function ($a, $b) {
        if ($a['position'] == $b['position']) {
            return 0;
        }

        return ($a['position'] < $b['position']) ? -1 : 1;
    });

    return $menu;
}

function funGetMenuArrayByTagId($tagId, $country, $lang)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $sql = "SELECT
    tb_menus_tag.tag as tag
  FROM
    tb_menus_tag
  WHERE
    tb_menus_tag.id='$tagId'
  ";
    if ($result = $connection->query($sql)) {
        $row = mysqli_fetch_assoc($result);

        return funGetMenuArrayByTag($row['tag'], $country, $lang);
    }

    return null;
}

function funGetMenuArrayByTag($tag, $country = 'PT', $lang = 'PT')
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    
    $sql = "SELECT 
    tb_menus.id,
    tb_menus.position,
    tb_menus_translation.id as translationId,
    tb_menus_translation.url,
    tb_menus_translation.text,
    tb_menus.idTbSubmenusTag as submenuId,
    tb_menus_tag.tag,
    tb_menus.status,
    tb_country.abbCountry,
    tb_language.langMin
  FROM
    tb_menus
  JOIN
    tb_menus_tag ON tb_menus_tag.id = tb_menus.idTbMenusTag
  JOIN
    tb_menus_translation ON tb_menus.id = tb_menus_translation.idTbMenu
  JOIN
    tb_country ON tb_country.id = tb_menus_translation.idTbCountry
  JOIN
    tb_language ON tb_language.id = tb_menus_translation.idTbLanguage
  WHERE
    tb_menus_tag.tag='$tag'
  AND
    tb_menus.status<>0
  AND
    tb_country.abbCountry='$country'
  AND
    tb_language.langMin='$lang'
  ";

    if ($result = $connection->query($sql)) {

        $menu = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'url' => $row['url'],
                'text' => $row['text'],
                'position' => $row['position'],
                'children' => null,
            );
            //echo "<pre>";
            //var_dump($row);
            //echo "</pre>";
            if ($row['submenuId'] != null) {
                $item['children'] = funGetMenuArrayByTagId($row['submenuId'], $country, $lang);
            }
            array_push($menu, $item);
        }
    }
    //var_dump($menu);
    //var_dump($sql);
    //exit(0);
    return funSortMenuArray($menu);
}

function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}

function funGetMenu($tag, $html, $children_html = null, $children_html_pre = '', $children_html_pos = '', $children = null, $extra= null, $extra2= null)
{
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }

    //## eu mudei
    $country = 'ENG';

    $menu = $children != null ? $children : funGetMenuArrayByTag($tag, $country, $lang);
    
    $children_html = $children_html == null ? $html : $children_html;

    $out = "<!-- MENU $tag -->".PHP_EOL;
    foreach ($menu as $i => $item) {
        $elem = $children != null ? $children_html : $html;
        $active = $i == 0 ? 'active' : '';
        $elem = str_ireplace('{{active}}', $active, $elem);

        $elem = str_ireplace('{{url}}', URLFRONT.$item['url'], $elem);
        $elem = str_ireplace('{{text}}', $item['text'], $elem);

        if (isset($item['children']) && count($item['children'])) {
            $child = $children_html_pre.funGetMenu($tag, $html, $children_html, $children_html_pre, $children_html_pos, $item['children']).$children_html_pos;
            $elem = str_ireplace('{{extra}}', $extra, $elem);
            $elem = str_ireplace('{{extra2}}', $extra2, $elem);
            if (preg_match('{{children}}', $elem)) {
                $elem = str_ireplace('{{children}}', $child, $elem);
            } else {
                $elem .= $child;
            }
        } else {
            $elem = str_ireplace('{{extra2}}', '', $elem);
            $elem = str_ireplace('{{extra}}', '', $elem);
            if (preg_match('{{children}}', $elem)) {
                $elem = str_ireplace('{{children}}', '', $elem);
            }
        }
        $out .= $elem;
    };

    return $out;
}

function getSubmenuToken($length)
{
    $token = '';
    $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
    //$codeAlphabet.= "0123456789";
  $max = strlen($codeAlphabet); // edited

 for ($i = 0; $i < $length; ++$i) {
     $token .= $codeAlphabet[rand(0, $max - 1)];
 }

    return $token;
}

/*function funGetGeneralMenuAsHtml($tag, $country = 'PT', $lang = 'PT')
{
    $menu = funGetMenuArrayByTag($tag);
    $html = '<ul>';
    foreach ($menu as $key => $item) {
        if ($item['children'] !== null) {
            $html .= "<li onclick='openExtraMenu(this);' id='".getSubmenuToken(8)."'><a>".$item['text'];
            $html .= "<ul class='extraMenu'>";
            $html .= "<div class='arrow-up'></div>";
            foreach ($item['children'] as $key => $child) {
                $html .= "<li><a href='".$child['url']."'>".$child['text'].'</a></li>';
            }
            $html .= '</ul>';
            $html .= '</li>';
        } else {
            $html .= "<li><a href='".$item['url']."'>".$item['text'].'</a></li>';
        }
    }
    $html .= '</ul>';

    //var_dump($html);
    //exit(0);

    return $html;
}*/

/*function funGetGeneralMobileMenuAsHtml($tag, $country = 'PT', $lang = 'PT')
{
    $menu = funGetMenuArrayByTag($tag);
    $html = '<ul>';
    foreach ($menu as $key => $item) {
        if ($item['children'] !== null) {
            $html .= "<li class='titleMenu'>".$item['text'].'</li>';
            foreach ($item['children'] as $key => $child) {
                $html .= "<li class='subMenu'><a href='".$child['url']."'>".$child['text'].'</a></li>';
            }
        } else {
            $html .= "<li><a href='".$item['url']."'>".$item['text'].'</a></li>';
        }
    }
    $html .= '</ul>';

    return $html;
}*/

function funGetAdvancedBannerImagesAsArray($galleryIds)
{
    //var_dump($galleryIds);

    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $ids = explode('||', $galleryIds);
    $images = array();

    foreach ($ids as $key => $id) {
        $sqlCmd = 'SELECT * FROM tb_gallery WHERE id='.$id;
        //var_dump($sqlCmd);
        if ($result4 = $connection->query($sqlCmd)) {
            while ($rowGal = mysqli_fetch_assoc($result4)) {
                array_push($images, array(
                    'id' => $id,
                    'path' => URLAMIGAVEL . $rowGal['path'],
                ));
            }
        }
    }

    //$db->commitAndClose();
    return $images;
}

function funGetAdvancedBannersAsArray($tag, $country = 1, $lang = 'PT')
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sql = "SELECT
    tb_advanced_banner_translation.id,
    tb_advanced_banner_translation.title,
    tb_advanced_banner_translation.subtitle,
    tb_advanced_banner_translation.text,
    tb_advanced_banner_translation.subText,
    tb_advanced_banner_translation.callTitle,
    tb_advanced_banner_translation.callAction,
    tb_advanced_banner.idTbGallery,
    tb_advanced_banner.position,
    tb_advanced_banner.idTbBannerTag,
    tb_advanced_banner.flagCta,
    tb_advanced_banner.duration,
    tb_advanced_banner_tag.tag,
    tb_advanced_banner_translation.idTbLanguage,
    tb_advanced_banner_translation.idTbCountry,
    tb_country.abbCountry,
    tb_language.langMin,
    tb_advanced_banner.status
  FROM
    tb_advanced_banner_translation
  JOIN tb_advanced_banner ON tb_advanced_banner.id = tb_advanced_banner_translation.idTbBanner
  JOIN tb_advanced_banner_tag ON tb_advanced_banner_tag.id = tb_advanced_banner.idTbBannerTag
  JOIN tb_country ON tb_country.id = tb_advanced_banner_translation.idTbCountry
  JOIN tb_language ON tb_language.id = tb_advanced_banner_translation.idTbLanguage
  WHERE
    tb_advanced_banner_tag.tag='$tag'
  AND
    tb_country.id=$country
  AND
    tb_language.langMin='$lang'
  AND
    tb_advanced_banner.status<>0
  ORDER BY tb_advanced_banner.position";

    $advancedBanners = array();
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = array(
                'title' => $row['title'],
                'subtitle' => $row['subtitle'],
                'text' => $row['text'],
                'subtext' => $row['subText'],
                'callTitle' => $row['callTitle'],
                'callAction' => $row['callAction'],
                'images' => funGetAdvancedBannerImagesAsArray($row['idTbGallery']),
            );
            array_push($advancedBanners, $data);
        }
    }

    return $advancedBanners;
}

function funGetAdvancedBannersInfobyTag($tag, $country = 1, $lang = 'PT')
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sql = "SELECT
    tb_advanced_banner_translation.id,
    tb_advanced_banner_translation.title,
    tb_advanced_banner_translation.subtitle,
    tb_advanced_banner_translation.text,
    tb_advanced_banner_translation.subText,
    tb_advanced_banner_translation.callTitle,
    tb_advanced_banner_translation.callAction,
    tb_advanced_banner.idTbGallery,
    tb_advanced_banner.position,
    tb_advanced_banner.idTbBannerTag,
    tb_advanced_banner.flagCta,
    tb_advanced_banner.duration,
    tb_advanced_banner_tag.tag,
    tb_advanced_banner_translation.idTbLanguage,
    tb_advanced_banner_translation.idTbCountry,
    tb_country.abbCountry,
    tb_language.langMin,
    tb_advanced_banner.status
  FROM
    tb_advanced_banner_translation
  JOIN tb_advanced_banner ON tb_advanced_banner.id = tb_advanced_banner_translation.idTbBanner
  JOIN tb_advanced_banner_tag ON tb_advanced_banner_tag.id = tb_advanced_banner.idTbBannerTag
  JOIN tb_country ON tb_country.id = tb_advanced_banner_translation.idTbCountry
  JOIN tb_language ON tb_language.id = tb_advanced_banner_translation.idTbLanguage
  WHERE
    tb_advanced_banner_tag.tag='$tag'
  AND
    tb_country.id=$country
  AND
    tb_language.langMin='$lang'
  AND
    tb_advanced_banner.status<>0
  ORDER BY tb_advanced_banner.position";

    $advancedBanners = array();
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data  = array(
                'title' => $row['title'],
                'subtitle' => $row['subtitle'],
                'text' => $row['text'],
                'subtext' => $row['subText'],
                'callTitle' => $row['callTitle'],
                'callAction' => $row['callAction'],
                'images' => funGetAdvancedBannerImagesAsArray($row['idTbGallery']),
            );
            array_push($advancedBanners, $data);
        }
    }

    return $advancedBanners;
}

function funGetAdvancedBannersFilteredAsArray($tag, $country = 1, $lang = 'PT', $search)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sql = "SELECT
    tb_advanced_banner_translation.id,
    tb_advanced_banner_translation.title,
    tb_advanced_banner_translation.subtitle,
    tb_advanced_banner_translation.text,
    tb_advanced_banner_translation.subText,
    tb_advanced_banner_translation.callTitle,
    tb_advanced_banner_translation.callAction,
    tb_advanced_banner.idTbGallery,
    tb_advanced_banner.position,
    tb_advanced_banner.idTbBannerTag,
    tb_advanced_banner.flagCta,
    tb_advanced_banner.duration,
    tb_advanced_banner_tag.tag,
    tb_advanced_banner_translation.idTbLanguage,
    tb_advanced_banner_translation.idTbCountry,
    tb_country.abbCountry,
    tb_language.langMin,
    tb_advanced_banner.status
  FROM
    tb_advanced_banner_translation
  JOIN tb_advanced_banner ON tb_advanced_banner.id = tb_advanced_banner_translation.idTbBanner
  JOIN tb_advanced_banner_tag ON tb_advanced_banner_tag.id = tb_advanced_banner.idTbBannerTag
  JOIN tb_country ON tb_country.id = tb_advanced_banner_translation.idTbCountry
  JOIN tb_language ON tb_language.id = tb_advanced_banner_translation.idTbLanguage
  WHERE
    tb_advanced_banner_tag.tag='$tag'
  AND
    LOWER(REPLACE(tb_advanced_banner_translation.callTitle,' ','-')) = '$search'
  AND
    tb_country.id=$country
  AND
    tb_language.langMin='$lang'
  AND
    tb_advanced_banner.status<>0
  ORDER BY tb_advanced_banner.position";
    $advancedBanners = array();
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = array(
                'title' => $row['title'],
                'subtitle' => $row['subtitle'],
                'text' => $row['text'],
                'subtext' => $row['subText'],
                'callTitle' => $row['callTitle'],
                'callAction' => $row['callAction'],
                'images' => funGetAdvancedBannerImagesAsArray($row['idTbGallery']),
            );
            array_push($advancedBanners, $data);
        }
    }
    return $advancedBanners;
}

function funGetAdvancedBanners($tag, $html, $strip_tags = true, $search = "")
{
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    $lang = 'EN';
    if (isset($_COOKIE['countryID'])) {
        $country = $_COOKIE['countryID'];
    } else {
        $country = '1';
    }
    $country = '3';
    $banners = ($search == "") ? funGetAdvancedBannersAsArray($tag, $country, $lang) : funGetAdvancedBannersFilteredAsArray($tag, $country, $lang, $search);

    $output = "<!-- ADVANCED BANNER $tag -->".PHP_EOL;
    $total = count($banners);
    foreach ($banners as $i => $banner) {
        if ($strip_tags) {
            $allowed = '<b><i><a><br>';
            array_map(function ($key) use (&$banner, &$allowed) {
                $banner[$key] = strip_tags($banner[$key], $allowed);
            }, array('title', 'subtitle', 'text', 'subtext'));
        }

        $active = $i == 0 ? 'active' : '';
        $item = $html;
        $item = str_ireplace('{{i}}', $i, $item);
        $item = str_ireplace('{{pos}}', $i + 1, $item);
        $item = str_ireplace('{{total}}', $total, $item);
        $item = str_ireplace('{{active}}', $active, $item);
        $item = str_ireplace('{{title}}', $banner['title'], $item);
        $item = str_ireplace('{{subtitle}}', $banner['subtitle'], $item);
        $item = str_ireplace('{{text}}', $banner['text'], $item);
        $item = str_ireplace('{{subtext}}', $banner['subtext'], $item);
        $item = str_ireplace('{{callTitle}}', $banner['callTitle'], $item);
        $item = str_ireplace('{{callAction}}', $banner['callAction'], $item);
        foreach ($banner['images'] as $j => $img) {
            $key = $j == 0 ? '' : '_'.($j + 1);
            $item = str_ireplace('{{img'.$key.'}}', $img['path'], $item);
        }
        $output .= $item;
    }

    return $output;
}

function funGetFaqAsArray($tag = null)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }

    $sql = 'SELECT
    tb_faqs_tag.tag,
    tb_faqs_tag_translation.title,
    tb_gallery.path,
    tb_faqs_translation.question,
    tb_faqs_translation.answer
  FROM tb_faqs_tag
  JOIN tb_faqs ON tb_faqs.idTbFaqsTag = tb_faqs_tag.id
  JOIN tb_gallery ON tb_gallery.id = tb_faqs.idTbGallery 
  JOIN tb_faqs_tag_translation ON tb_faqs_tag_translation.idTbFaqTag = tb_faqs_tag.id
  JOIN tb_faqs_translation ON tb_faqs_translation.idTbFaq = tb_faqs.id
  JOIN tb_country ON tb_faqs_translation.idTbCountry = tb_country.id
  JOIN tb_language ON tb_language.id = tb_faqs_tag_translation.idTbLanguage AND tb_language.id = tb_faqs_translation.idTbLanguage
  JOIN tb_country_language ON tb_country_language.idTbLanguage = tb_language.id AND tb_country_language.idTbCountry = tb_country.id
  INNER JOIN tb_country_codes ON tb_country.idTbCountryCode = tb_country_codes.id
  WHERE
    tb_language.langMin = "'.$lang.'" AND
    tb_country_codes.country_code = "'.$country.'" AND
    tb_country_language.status = 1 AND
    tb_country_language.idTbCountry = tb_country.id AND
    tb_language.deleted = 0 AND
    tb_faqs_tag.status <> 0 ';

    if ($tag != null) {
        if (is_array($tag)) {
            $sql .= ' AND (';
            foreach ($tag as $key => $t) {
                if ($key == 0) {
                    $sql .= "tb_faqs_tag.tag='$t'";
                } else {
                    $sql .= " OR tb_faqs_tag.tag='$t'";
                }
            }
            $sql .= ' )';
        } else {
            $sql .= " AND tb_faqs_tag.tag='$tag'";
        }
    }

    $faqs = array();
    $record = $connection->query($sql);

    if ($record) {
        $curTag = null;
        while ($row = mysqli_fetch_assoc($record)) {
            if ($curTag == null || $row['tag'] != $curTag) {
                $curTag = $row['tag'];
            }

            if (!isset($faqs[$curTag])) {
                $faqs[$curTag] = array(
                    'title' => $row['title'],
                    'images' => array(),
                    'children' => array(),
                );
            }

            array_push($faqs[$curTag]['images'], URLAMIGAVEL . $row['path']);

            array_push($faqs[$curTag]['children'], array(
                'question' => $row['question'],
                'answer' => $row['answer'],
            ));
        }
    }

    return $faqs;
}

function funGetFaqAsHtml($tag) {
    $html = "";
    $faqs = funGetFaqAsArray($tag);
    foreach ($faqs as $key => $value) {
        $html .= '<div class="sabia-que flex50" style="background-image: linear-gradient(to right, rgba(19,77,171,0.05) 0%,rgba(19,77,171,0.05) 100%), url(' . $value["images"][0] . ')">';
        $html .= "  <h3>" . $value["title"] . "</h3>";
        $html .= '  <div class="accordion">';
        foreach ($value["children"] as $i => $faq) {
            $active = ($i == 0) ? 'activeAc' : '';
            $html .= '<article class="">';
            $html .= '<h4 class="title">';
            $html .= '<span>' . $faq['question'] . '</span>';
            $html .= '<span class="arrow"></span>';
            $html .= '</h4>';
            $html .= '<div class="itemAc extra ' . $active . '">';
            $html .=  $faq['answer'];
            $html .= '</div>';
            $html .= '</article>';
            
        }
        $html .= '  </div>';
        $html .= '  <div class="callToPage"><a href="faqs.php" class="callToPage">Saber mais <img src="assets/img/faq/ic-arrow-forward.svg" alt=""></a></div>';
        $html .= '</div>';
    }
    return $html;
}

function getFaqSidebarAsHtml($faqs,$tag) {

    $html = '
      <div class="boxuno">
                <div class="categorias">
                    <div class="cate_box">';
          foreach ($faqs as $tag => $faq) {
            $html .= '
                    <a href="#'.$tag.'">
                        <div class="cate"><i class="far fa-bookmark"></i>'.$faq['title'].'</div>
                    </a>
            ';
          }
  
    $html .= '        </div>
                </div>
            </div>
    ';
  
    return $html;
  }
  
  
  function getFaqContentAsHtml($faqs,$tag) {

    $html = '    <div class="boxdos">
';
      foreach ($faqs as $tag => $faq) {
        $html .= '
            <div class="perguntas" id="'.$tag.'">
            <div class="titulo"><i class="far fa-bookmark"></i>'.$faqs[$tag]['title'].'</div>
            <div class="perg_box">            
';
            foreach ($faq['children'] as $key => $f) {
              $html .= '
            <div class="box_box">
                <h3 class="question">'.$f['question'].'</h3>
                <div class="answer">'.$f['answer'].'</div>
            </div>    
              ';
            }
        $html .= '      </div>
    </div>
            
        ';
      }
    $html .= '    
    </div>';

    return $html;
  }
  
    function getFaqOnlyQRAsHtml($faqs,$tag) {

    $html = '
';
      foreach ($faqs as $tag => $faq) {
        $html .= '
';
            foreach ($faq['children'] as $key => $f) {
              $html .= '
            <div class="box_box">
                <h3 class="question">'.$f['question'].'</h3>
                <div class="answer">'.$f['answer'].'</div>
            </div>    
              ';
            }
        $html .= ' 
        ';
      }
    $html .= '    
    </div>';
    return $html;
  }
  
  function getFaqAsHtml($tag, $lang='PT') {
    
    $faqs = funGetFaqAsArray($tag, $lang);
    $html = array(
      "sidebar" => getFaqSidebarAsHtml($faqs,$tag),
      "content" => getFaqContentAsHtml($faqs,$tag),
      "onlyquetionsresponse" => getFaqOnlyQRAsHtml($faqs,$tag)
    );
    return $html;
  }
  
  
    function getGlossarioSidebarAsHtml($faqs,$tag) {
        $html = '
    <div class="Pesquisa">
        <div class="pesquisa-1">
            <div class="title">Pesquisar por letra</div>
            <div id="myBtnContainer">
                <button class="btn selected" onclick="filterSelection(\'all\')">Todos</button>';
              foreach ($faqs as $tag => $faq) {
                $faq["title"] = strip_tags($faq["title"]);
                
                $html .= '
                        <button class="btn" onclick="filterSelection(\''.preg_replace('/[\r\n]+/', "",$faq["title"]).'\')">'.$faq["title"].'</button>
                ';
              }

        $html .= '               </div>
        </div>
        <div class="pesquisa-2">
            <label>Pesquisar</label> <div class="search"><img src="assets/img/ic-search.svg"><input id="myInput"></div>
        </div>
    </div>
        ';

        return $html;
    }


    function getGlossarioContentAsHtml($faqs,$tag) {

        $html = '     <div class="grid">
    ';
          foreach ($faqs as $tag => $faq) {
            $html .= '
        <div class="column '.strip_tags($faq["title"]).'">
            <div class="word_title">'.$faq["title"].'</div>          
    ';
                foreach ($faq['children'] as $key => $f) {
                  $html .= '
                <div class="box_box">
                    <div class="word">'.$f['question'].'</div>
                    <div class="meaning">'.$f['answer'].'</div>
                </div>    
                  ';
                }
            $html .= '</div>

            ';
          }
        $html .= '    
            </div>';

        return $html;
    }

    function getGlossarioOnlyQRAsHtml($faqs,$tag) {

        $html = '
    ';
          foreach ($faqs as $tag => $faq) {
            $html .= '
    ';
                foreach ($faq['children'] as $key => $f) {
                  $html .= '
                <div class="box_box">
                    <h3 class="question">'.$f['question'].'</h3>
                    <div class="answer">'.$f['answer'].'</div>
                </div>    
                  ';
                }
            $html .= ' 
            ';
          }
        $html .= '    
        </div>';
        return $html;
    }
  
    function getGlossarioAsHtml($tag, $lang='PT') {
    
    $faqs = funGetFaqAsArray($tag, $lang);
    $html = array(
      "sidebar" => getGlossarioSidebarAsHtml($faqs,$tag),
      "content" => getGlossarioContentAsHtml($faqs,$tag),
      "onlyquetionsresponse" => getGlossarioOnlyQRAsHtml($faqs,$tag)
    );
    return $html;
  }
  


function getNewsAsArray($cat = null, $limit = null, $highlight = null, $excluded = null)
{
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }

    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sql = "SELECT
        tb_news.id,
        tb_news.category,
        tb_news.type,
        tb_news.editor,
        tb_news.highlight,
        tb_news.publishDate,
        tb_gallery.path,
        tb_news_translation.title,
        tb_news_translation.subTitle,
        tb_news_translation.details,
        tb_news_translation.keywords
    FROM tb_news
    JOIN tb_news_translation ON tb_news.id = tb_news_translation.idTbNews
    JOIN tb_gallery ON tb_gallery.id = tb_news.idTbGallery
    JOIN tb_language ON tb_news_translation.idTbLanguage = tb_language.id
    WHERE 
        tb_language.langMin='$lang'
    AND
        tb_news.status <> 0";

    if (isset($cat)) {
        if (is_array($cat)) {
            $sql .= ' AND ( ';
            foreach ($cat as $key => $c) {
                if ($key == 0) {
                    $sql .= " tb_news.category='$c' ";
                } else {
                    $sql .= " OR tb_news.category='$c' ";
                }
            }
            $sql .= ' ) ';
        } else {
            $sql .= " AND tb_news.category='$cat'";
        }
    }

    if (isset($highlight)) {
        $sql .= " AND tb_news.highlight=1";
    }

    if (isset($excluded)) {
        $sql .= " AND tb_news.id <> $excluded";
    }
    $sql .= ' ORDER BY tb_news.publishDate DESC, tb_news.id DESC';

    if (isset($limit)) {
        $sql .= " LIMIT $limit";
    }

    $news = array();
    $record = $connection->query($sql);

    if ($record) {
        while ($row = mysqli_fetch_assoc($record)) {
            array_push($news, array(
                'id' => $row['id'],
                'category' => $row['category'],
                'type' => $row['type'],
                'editor' => $row['editor'],
                'highlight' => $row['highlight'],
                'publishDate' => $row['publishDate'],
                'image' => URLAMIGAVEL . $row['path'],
                'title' => $row['title'],
                'subTitle' => $row['subTitle'],
                'details' => $row['details'],
                'keywords' => $row['keywords'],
            ));
        }
    }

    return $news;
}
function getNewsAsJson($limit = null, $excluded = null, $highlight = null, $cat = null){
    return json_encode(getNewsAsArray());
}
function getNews($html, $limit = null, $excluded = null, $highlight = null, $cat = null) {
    $news = getNewsAsArray($cat, $limit, $highlight, $excluded);
    $newHtml = "";
    foreach ($news as $key => $new) {
        $tempHtml = $html;
        $href = $new["category"]."/".$new["title"]."/".$new["id"];
        $href = strtolower($href);
        $find = array("à","á","ã","â","ä");
        $href = str_ireplace($find,"a",$href);
        $find = array("é","è","ê","ë");
        $href = str_ireplace($find,"e",$href);
        $find = array("ì","í","î","ï");
        $href = str_ireplace($find,"i",$href);
        $find = array("ò","ó","õ","ô","ö");
        $href = str_ireplace($find,"o",$href);
        $find = array("ù","ú","û","ü");
        $href = str_ireplace($find,"u",$href);
        $href = str_ireplace("ç","c",$href);
        $href = str_ireplace("ñ","n",$href);
        $href = str_ireplace(" ","-",$href);
        $href = str_ireplace("?","",$href);
        $href = str_ireplace("!","",$href);
        $href = str_ireplace("&","",$href);
        $href = str_ireplace("(","",$href);
        $href = str_ireplace(")","",$href);
        $href = URLAMIGAVEL . "blog/" . $href;
        $href = iconv("UTF-8", "ISO-8859-1", $href);
        
        $tempHtml = str_ireplace('{{title}}', $new["title"], $tempHtml);
        $tempHtml = str_ireplace('{{publishDate}}', date("d/m/Y", strtotime($new["publishDate"])), $tempHtml);
        $tempHtml = str_ireplace('{{image}}', $new["image"], $tempHtml);
        $tempHtml = str_ireplace('{{details}}', $new["details"], $tempHtml);
        $tempHtml = str_ireplace('{{editor}}', $new["editor"], $tempHtml);
        $tempHtml = str_ireplace('{{category}}', $new["category"], $tempHtml);
        $tempHtml = str_ireplace('{{type}}', $new["type"], $tempHtml);
        $tempHtml = str_ireplace('{{highlight}}', $new["highlight"], $tempHtml);
        $tempHtml = str_ireplace('{{subTitle}}', $new["subTitle"], $tempHtml);
        $tempHtml = str_ireplace('{{id}}', $new["id"], $tempHtml);
        $tempHtml = str_ireplace('{{href}}', $href, $tempHtml);
        $newHtml .= $tempHtml;
    }
    echo $newHtml;
}



function getOneNewByIdAsArray($id) {
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }

    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sql = "SELECT
        tb_news.id,
        tb_news.category,
        tb_news.type,
        tb_news.editor,
        tb_news.highlight,
        tb_news.publishDate,
        tb_news.idTbGallery,
        -- tb_gallery.path,
        tb_news_translation.title,
        tb_news_translation.subTitle,
        tb_news_translation.details,
        tb_news_translation.keywords
    FROM tb_news
    JOIN tb_news_translation ON tb_news.id = tb_news_translation.idTbNews
    -- JOIN tb_gallery ON tb_gallery.id = tb_news.idTbGallery
    JOIN tb_language ON tb_news_translation.idTbLanguage = tb_language.id
    WHERE 
        tb_news.id = $id
        AND tb_language.langMin='$lang'";
  

    $news = array();
    $record = $connection->query($sql);

    if ($record) {
        while ($row = mysqli_fetch_assoc($record)) {
            array_push($news, array(
                'id' => $row['id'],
                'category' => $row['category'],
                'type' => $row['type'],
                'editor' => $row['editor'],
                'highlight' => $row['highlight'],
                'publishDate' => $row['publishDate'],
                'images' => funGetAdvancedBannerImagesAsArray($row['idTbGallery']),
                'title' => $row['title'],
                'subTitle' => $row['subTitle'],
                'details' => $row['details'],
                'keywords' => $row['keywords'],
            ));
        }
    }

    return $news;
}

function getOneNew($id, $html) {
    $news = getOneNewByIdAsArray($id);
    // echo "<pre>";
    // print_r($news);
    // echo "</pre>";
    foreach ($news as $key => $new) {
        $gallery = "<div class='gallery-slider'>";
        foreach ($new["images"] as $key => $value) {
            $gallery.= "<div class=galleryDiv><img class=gallery src='".$value["path"]."'></div>";
        }
        $gallery.= "</div>";

        $html = str_ireplace('{{title}}', $new["title"], $html);
        $html = str_ireplace('{{publishDate}}', date("d/m/Y", strtotime($new["publishDate"])), $html);
        $html = str_ireplace('{{image}}', ((isset($new["images"][0]["path"])) ? $new["images"][0]["path"] : "") , $html);
        $html = str_ireplace('{{details}}', $new["details"], $html);
        $html = str_ireplace('{{editor}}', $new["editor"], $html);
        $html = str_ireplace('{{category}}', $new["category"], $html);
        $html = str_ireplace('{{type}}', $new["type"], $html);
        $html = str_ireplace('{{highlight}}', $new["highlight"], $html);
        $html = str_ireplace('{{subTitle}}', $new["subTitle"], $html);
        $html = str_ireplace('{{id}}', $new["id"], $html);
        $html = str_ireplace('{{keywords}}', $new["keywords"], $html);
        if (isset($new["images"][0])) { $html = str_ireplace('[0]', "<img class='image-new' src='".$new["images"][0]["path"]."'>", $html);}
        if (isset($new["images"][1])) { $html = str_ireplace('[1]', "<img class='image-new' src='".$new["images"][1]["path"]."'>", $html);}
        if (isset($new["images"][2])) { $html = str_ireplace('[2]', "<img class='image-new' src='".$new["images"][2]["path"]."'>", $html);}
        if (isset($new["images"][3])) { $html = str_ireplace('[3]', "<img class='image-new' src='".$new["images"][3]["path"]."'>", $html);}
        if (isset($new["images"][4])) { $html = str_ireplace('[4]', "<img class='image-new' src='".$new["images"][4]["path"]."'>", $html);}
        if (isset($new["images"][5])) { $html = str_ireplace('[5]', "<img class='image-new' src='".$new["images"][5]["path"]."'>", $html);}
        if (isset($new["images"][6])) { $html = str_ireplace('[6]', "<img class='image-new' src='".$new["images"][6]["path"]."'>", $html);}
        if (isset($new["images"][7])) { $html = str_ireplace('[7]', "<img class='image-new' src='".$new["images"][7]["path"]."'>", $html);}
        if (isset($new["images"][8])) { $html = str_ireplace('[8]', "<img class='image-new' src='".$new["images"][8]["path"]."'>", $html);}
        if (isset($new["images"][9])) { $html = str_ireplace('[9]', "<img class='image-new' src='".$new["images"][9]["path"]."'>", $html);}
        if (isset($new["images"][10])) { $html = str_ireplace('[10]', "<img class='image-new' src='".$new["images"][10]["path"]."'>", $html);}
        $html = str_ireplace('[gallery]', $gallery, $html);
    };
    if ($news[0]["title"]=="off"){
      echo "<script>window.location = 'http://www.swissdentalservices.com/sds2019/noticias.php'</script>";
    }else{
      echo $html;
     
    }
}
function getOneNewSeo($id, $vfCode) {
    echo "<!-- SEO $vfCode -->".PHP_EOL;
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $host = funGetHost();

    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    $news = getOneNewByIdAsArray($id, $vfCode);
    $value = "";
    foreach ($news as $key => $row) {
        $value .= '<title>'.$row['title'].'</title>'.PHP_EOL;
        $value .= '<meta id="keywordsSeo" name="keywords" content="'.$row['keywords'].'">'.PHP_EOL;
        $value .= '<meta id="descriptionSeo" name="description" content="'.$row['subTitle'].'">'.PHP_EOL;
        $value .= '<meta property="og:title" content="'.$row['title'].'" />'.PHP_EOL;
        $value .= '<meta property="og:description" content="'.$row['subTitle'].'" />'.PHP_EOL;
        $value .= '<meta property="og:image" content="'.$host.'/'.$row['image'].'" />'.PHP_EOL;
        $value .= '<meta name="twitter:title" content="'.$row['title'].'">'.PHP_EOL;
        $value .= '<meta name="twitter:description" content="'.$row['subTitle'].'">'.PHP_EOL;
        $value .= '<meta name="twitter:image" content="'.$host.'/'.$row['image'].'">'.PHP_EOL;
    }

    
    $sql = "SELECT
        tb_seo_translations.*,
        tb_gallery.path
    FROM
        tb_seo
    join tb_seo_translations ON tb_seo_translations.idTbSeo = tb_seo.id
    join tb_language ON tb_language.id = tb_seo_translations.idTbLanguage
    JOIN tb_gallery ON tb_gallery.id = tb_seo_translations.shareImage
    WHERE
        tb_seo.status = 1
    AND tb_seo_translations.status = 1
    AND tb_language.langMin = '$lang'
    AND tb_seo.code='$vfCode'";

    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $value .= '<meta property="og:url" content="'.$row['shareUrl'].'" />'.PHP_EOL;
            $value .= '<meta property="og:locale" content="'.$row['shareLocale'].'" />'.PHP_EOL;
            $value .= '<meta property="og:type" content="'.$row['shareType'].'" />'.PHP_EOL;
            $value .= '<meta property="og:site_name" content="'.$row['shareSitename'].'" />'.PHP_EOL;
            $value .= '<meta name="twitter:card" content="'.$row['shareCard'].'">'.PHP_EOL;
            $value .= '<meta name="twitter:site" content="'.$row['shareSite'].'">'.PHP_EOL;
            $value .= '<meta name="twitter:creator" content="'.$row['shareCreator'].'">'.PHP_EOL;
        }
    }

    return $value;
}


function getNewsAndEvents($type,$date="") {
  if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }

    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sql = "SELECT
        tb_news.id,
        tb_news.category,
        tb_news.type,
        tb_news.editor,
        tb_news.highlight,
        tb_news.publishDate,
       -- tb_gallery.path,
        tb_news.idTbGallery,
        tb_news_translation.title,
        tb_news_translation.subTitle,
        tb_news_translation.details,
        tb_news_translation.keywords
    FROM tb_news
    JOIN tb_news_translation ON tb_news.id = tb_news_translation.idTbNews
    -- JOIN tb_gallery ON tb_gallery.id = tb_news.idTbGallery
    JOIN tb_language ON tb_news_translation.idTbLanguage = tb_language.id
    WHERE 
        tb_news.category = '$type'
        AND tb_language.langMin='$lang'
        AND tb_news.highlight='1'
        AND tb_news_translation.title!='off'";
    if ($date!=""){
        if ($date=="passados"){
            $sql .= " AND tb_news.publishDate <'".date("Y-m-d",time())."'"; //date "<".date("Y-m-d",time()) ou ">=".date("Y-m-d",time()) 
        }elseif ($date=="futuros"){
            $sql .= " AND tb_news.publishDate >='".date("Y-m-d",time())."'";//date "<".date("Y-m-d",time()) ou ">=".date("Y-m-d",time()) 
        }
    }
    
    $news = array();
    if ($result = $connection->query($sql)) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $news[$i]=$row;
            $news[$i]["gallery"] = funGetAdvancedBannerImagesAsArray($row["idTbGallery"]);
            $news[$i]["details"] = str_ireplace('<p>[0]</p>', "", $news[$i]["details"]);
            $news[$i]["details"] = str_ireplace('<p>[1]</p>', "", $news[$i]["details"]);
            $i++;
        }
    }
    
    return $news;
}


function getEbooksAsArray($tag = null, $lang = 'PT')
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    $sql = 'SELECT
        tb_ebooks_tag.tag,
        tb_ebooks_translation.title,
        tb_ebooks_translation.description,
        tb_ebooks_translation.id as translationId,
        tb_gallery.path as image
    FROM tb_ebooks
    JOIN tb_ebooks_translation ON tb_ebooks.id = tb_ebooks_translation.idTbEbooks
    JOIN tb_ebooks_tag ON tb_ebooks.idTbEbooksTag = tb_ebooks_tag.id
    JOIN tb_gallery ON tb_gallery.id = tb_ebooks_translation.idTbGallery
    WHERE
        tb_ebooks.status <> 0 
    AND 
        tb_ebooks_translation.idTbLanguage = (
            SELECT id FROM tb_language WHERE tb_language.langMin="'.$lang.'"
        )
    ';
    if (isset($tag)) {
        if (is_array($tag)) {
            $sql .= ' AND ( ';
            foreach ($tag as $key => $t) {
                if ($key == 0) {
                    $sql .= " tb_ebooks_tag.tag='$t' ";
                } else {
                    $sql .= " OR tb_ebooks_tag.tag='$t' ";
                }
            }
            $sql .= ' ) ';
        } else {
            $sql .= " AND tb_ebooks_tag.tag='$tag'";
        }
    }

    $ebooks = array();

    $record = $connection->query($sql);

    if ($record) {
        while ($row = mysqli_fetch_assoc($record)) {
            array_push($ebooks, array(
                'tag' => $row['tag'],
                'title' => $row['title'],
                'description' => $row['description'],
                'file' => PATH_DOWNLOAD_LINK.'?idTranslation='.$row['translationId'],
                'image' => URLAMIGAVEL . $row['image'],
            ));
        }
    }

    return $ebooks;
}

if (isset($_COOKIE['lang'])) {
    if ($_COOKIE['lang']=="pt_PT"){
        unset($_COOKIE['lang']);
        setcookie("lang","",time()-3600);
        setcookie("lang","PT",time()+3600);
        $lang = 'PT';  
    } elseif ($_COOKIE['lang']=="en_GB"){
        setcookie("lang","",time()-3600);
        setcookie("lang","EN",time()+3600);
        $lang = 'EN'; 
    } elseif ($_COOKIE['lang']=="es_ES"){
        setcookie("lang","",time()-3600);
        setcookie("lang","ES",time()+3600);
        $lang = 'ES'; 
    } elseif ($_COOKIE['lang']=="fr_FR"){
        setcookie("lang","",time()-3600);
        setcookie("lang","FR",time()+3600);
        $lang = 'FR'; 
    }else{
        $lang = $_COOKIE['lang'];
    }
} else {

}

if (isset($_COOKIE['country'])) {
    $country = $_COOKIE['country'];
} else {
    $country = 'PT';
}

//$banners = funGetAdvancedBannersAsArray('home-header-banner');
//$faqs = funGetFaqAsArray(array('home_faq'));
// $news = getNewsAsArray(null, $lang, 2);
//$ebooks = getEbooksAsArray(array('testes'));
//$features = getFeaturesAsArray('teste');
//echo '<pre>';
//var_dump($faqs);
//echo '</pre>';
//exit(0);

$sqlCmdTranslations = "SELECT
                        tb_translations_codes.code,
                        tb_translations.value
                      FROM
                        tb_translations
                      JOIN tb_translations_codes
                      ON tb_translations.idTbCodeTranslations = tb_translations_codes.id
                      JOIN tb_language
                      ON tb_translations.idTbLanguage = tb_language.id
                      WHERE
                        tb_translations_codes.deleted = 0
                      AND
                        tb_language.langMin ='".$lang."'
                      AND tb_language.deleted = 0";
if ($resultTrans = $connection->query($sqlCmdTranslations)) {
    while ($rowTrans = mysqli_fetch_assoc($resultTrans)) {
        if (!defined($rowTrans['code'])) {
            define($rowTrans['code'], strip_tags($rowTrans['value'], '<b><i>'));
        }
    }
}

$sqlSocialedia = "SELECT
                      tb_socialmedia_type.falogo,
                      tb_socialmedia.url
                  FROM
                      tb_socialmedia
                  JOIN tb_socialmedia_type ON tb_socialmedia.idTbSocialType = tb_socialmedia_type.id
                  JOIN tb_country ON tb_country.id = tb_socialmedia.idTbCountry
                  JOIN tb_country_codes ON tb_country_codes.id = tb_country.idTbCountryCode
                  WHERE tb_socialmedia.status=1
                  AND tb_country_codes.country_code='$countryCode'";

if ($result1 = $connection->query($sqlSocialedia)) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $url = $row1['url'];
        $faLogo = $row1['falogo'];
        $listSocialMedia .= '<a href="'.$url.'" target="_blank"><i class="fa-lg '.$faLogo.'" aria-hidden="true"></i></a>';
    }
}

/*

$topics = '';
$topicsAnswers = '';
$i = 1;
$sqlGetFaqTopics = "SELECT
                          tb_translations.value,
                          tb_gallery.path,
                          tb_gallery.extension,
                          tb_faqs.id
                   FROM
                          tb_faqs
                   JOIN tb_translations ON tb_faqs.idTbTranslationCode = tb_translations.idTbCodeTranslations
                   JOIN tb_gallery ON tb_faqs.idTbGallery = tb_gallery.id
                   JOIN tb_country ON tb_faqs.idTbCountry = tb_country.id
                   JOIN tb_country_codes ON tb_country.idTbCountryCode = tb_country_codes.id
                   JOIN tb_language ON tb_translations.idTbLanguage = tb_language.id
                   WHERE tb_country_codes.country_code = '$countryCode'
                   AND tb_language.langMin = '$lang'
                   AND tb_faqs.status = 1
                   AND tb_translations.deleted = 0";
if ($result2 = $connection->query($sqlGetFaqTopics)) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $idFaq = $row2['id'];
        $title = $row2['value'];
        $path = $row2['path'];
        $topics .= '<li style="background-image: url('.$path.');" id="li-'.$i.'" class="fixed-bar-title " sdi-con="faqs'.$i.'"><a href="#faqs'.$i.'">'.$title.'</a></li>';

        $sqlGetFaqDetails = "SELECT
                        tb_faqs_details_trans.question,
                        tb_faqs_details_trans.answer
                        FROM
                        tb_faqs_details_trans
                        JOIN tb_faqs_details ON tb_faqs_details_trans.idTbFaqDetails = tb_faqs_details.id
                        JOIN tb_country ON tb_faqs_details_trans.idTbCountry = tb_country.id
                        JOIN tb_country_codes ON tb_country.idTbCountryCode = tb_country_codes.id
                        JOIN tb_language ON tb_language.id = tb_faqs_details_trans.idTbLanguage

                        WHERE tb_faqs_details.idTbFaq = $idFaq
                        AND tb_country_codes.country_code = '$countryCode'
                        AND tb_language.langMin = '$lang'
                        AND tb_faqs_details.status=1";

        $topicsAnswers .= '<li id="faqs'.$i.'" class="faq-'.$i.'">';
        $topicsAnswers .= ' <div class="separator-faq">';
        $topicsAnswers .= '   <h2><div style="background-image: url('.$path.');"  id="icon-'.$i.'" class="faq-title">'.$title.'</div></h2>';
        $topicsAnswers .= ' </div>';
        $topicsAnswers .= ' <div class="accordion">';
        if ($result3 = $connection->query($sqlGetFaqDetails)) {
            while ($row3 = mysqli_fetch_assoc($result3)) {
                $question = $row3['question'];
                $answer = $row3['answer'];

                $topicsAnswers .= '<div class="accordion-toggle" onclick="openClose(this)">'.$question.'</div>';
                $topicsAnswers .= ' <div class="accordion-content">';
                $topicsAnswers .= '   <div class="faq-info">';
                $topicsAnswers .= '     <p>'.$answer.'</p>';
                $topicsAnswers .= '   </div>';
                $topicsAnswers .= '</div>';
            }
        }
        $topicsAnswers .= ' </div>';
        $topicsAnswers .= '</li>';
        ++$i;
    }
}
*/
$sqlGetTerms = "SELECT
                  tb_terms_conditions.information
                FROM
                  tb_terms_conditions
                JOIN tb_language
                  ON tb_language.id = tb_terms_conditions.idTbLanguage
                WHERE
                  tb_terms_conditions.status=1
                AND
                  tb_terms_conditions.idTbCountry=1
                AND
                  tb_language.langMin='$lang'
                AND typeTerms = 0";

if ($result3 = $connection->query($sqlGetTerms)) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $terms = $row3['information'];
    }
}
/*
$privacy = '';
$sqlGetPrivacy = "SELECT
                  tb_terms_conditions.information
                FROM
                  tb_terms_conditions
                JOIN tb_language
                  ON tb_language.id = tb_terms_conditions.idTbLanguage
                WHERE
                  tb_terms_conditions.status=1
                AND
                  tb_terms_conditions.idTbCountry=$countryID
                AND
                  tb_language.langMin='$lang'
                AND typeTerms = 1
                AND tb_terms_conditions.status=1";

if ($result3 = $connection->query($sqlGetPrivacy)) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $privacy = $row3['information'];
    }
}*/

function funCreateContacts($bannerCode, $bannerHtml)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $tag = $bannerCode;
    $element = $bannerHtml;
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }

    $sqlCmdGetInfo = "SELECT
                          tb_contact_trans.clinicName,
                          tb_contact_trans.address,
                          tb_contact_trans.clinicPhone,
                          tb_contact_trans.email,
                          tb_contact_trans.officePhone,
                          tb_gallery.path,
                          tb_gallery.alt,
                          tb_contact.id
                    FROM
                          tb_contact_trans
                    JOIN tb_contact ON tb_contact_trans.idTbContact = tb_contact.id
                          LEFT JOIN tb_gallery ON tb_contact.idTbGallery = tb_gallery.id
                    JOIN tb_country ON tb_contact.idTbCountry = tb_country.id
                    JOIN tb_language ON tb_language.id = tb_contact_trans.idTbLanguage
                    JOIN tb_country_language ON tb_country_language.idTbLanguage = tb_language.id AND tb_country_language.idTbCountry = tb_country.id
                    INNER JOIN tb_country_codes ON tb_country.idTbCountryCode = tb_country_codes.id
                    WHERE
                          tb_language.langMin = '$lang' AND
                          tb_country_codes.country_code = '$country' AND
                          tb_contact.status = 1 AND
                          tb_country_language.status = 1 AND
                          tb_country_language.idTbCountry = tb_country.id AND
                          tb_language.deleted = 0";

    $all_elements = '';
    $i = 0;
    if ($result = $connection->query($sqlCmdGetInfo)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image = URLAMIGAVEL . 'assets/gallery/'.$row['path'];

            $element_temp = $element;
            $rpos = $i + 1;
            $element_temp = str_ireplace('{{pos}}', $rpos, $element_temp);
            $element_temp = str_ireplace('{{classanime}}', 'anim-delay-'.$i, $element_temp);
            $element_temp = str_ireplace('{{clinicName}}', $row['clinicName'], $element_temp);
            $element_temp = str_ireplace('{{id}}', $i.'_'.$row['id'], $element_temp);
            $element_temp = str_ireplace('{{address}}', $row['address'], $element_temp);
            $element_temp = str_ireplace('{{clinicPhone}}', $row['clinicPhone'], $element_temp);
            $element_temp = str_ireplace('{{email}}', $row['email'], $element_temp);
            $element_temp = str_ireplace('{{officePhone}}', $row['officePhone'], $element_temp);
            $element_temp = str_ireplace('{{alt}}', $row['alt'], $element_temp);
            $element_temp = str_ireplace('{{img}}', $row['path'], $element_temp);
            $all_elements .= $element_temp;
            ++$i;
        }
        echo $all_elements;
    }
}

function funGenerateSEO($vfCode)
{
    echo "<!-- SEO $vfCode -->".PHP_EOL;
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    $value = '';
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }
    $sql = "SELECT
          	tb_seo_translations.*,
          	tb_gallery.path
          FROM
          	tb_seo
          join tb_seo_translations ON tb_seo_translations.idTbSeo = tb_seo.id
          join tb_language ON tb_language.id = tb_seo_translations.idTbLanguage
          JOIN tb_gallery ON tb_gallery.id = tb_seo_translations.shareImage
          WHERE
          	tb_seo.status = 1
          AND tb_seo_translations.status = 1
          AND tb_language.langMin = '$lang'
          AND tb_seo.code='$vfCode'";

    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $host = funGetHost();

            $value = '';
            $value .= '<title>'.$row['title'].'</title>'.PHP_EOL;
            $value .= '<meta id="keywordsSeo" name="keywords" content="'.$row['keywords'].'">'.PHP_EOL;

            $value .= '<meta id="descriptionSeo" name="description" content="'.$row['description'].'">'.PHP_EOL;
            $value .= '<meta property="og:locale" content="'.$row['shareLocale'].'" />'.PHP_EOL;
            $value .= '<meta property="og:type" content="'.$row['shareType'].'" />'.PHP_EOL;
            $value .= '<meta property="og:site_name" content="'.$row['shareSitename'].'" />'.PHP_EOL;
            $value .= '<meta property="og:url" content="'.$row['shareUrl'].'" />'.PHP_EOL;
            $value .= '<meta property="og:title" content="'.$row['shareTitle'].'" />'.PHP_EOL;
            $value .= '<meta property="og:description" content="'.$row['description'].'" />'.PHP_EOL;
            $value .= '<meta property="og:image" content="https://'.$host.'/'.$row['path'].'" />'.PHP_EOL;
            $value .= '<meta name="twitter:card" content="'.$row['shareCard'].'">'.PHP_EOL;
            $value .= '<meta name="twitter:site" content="'.$row['shareSite'].'">'.PHP_EOL;
            $value .= '<meta name="twitter:creator" content="'.$row['shareCreator'].'">'.PHP_EOL;
            $value .= '<meta name="twitter:title" content="'.$row['shareTitle'].'">'.PHP_EOL;
            $value .= '<meta name="twitter:description" content="'.$row['description'].'">'.PHP_EOL;
            $value .= '<meta name="twitter:image" content="https://'.$host.'/'.$row['path'].'">'.PHP_EOL;
        }
    }
    //echo($value);
    return $value;
}

function tirarAcentosPalavra ($nome_remover_Acento)
{
	
    $letras_especiais = array('á','ã','â'); 
    foreach($letras_especiais as $l){
    $nome_remover_Acento = str_replace($l, 'a', strtolower($nome_remover_Acento)); 
    }

    $letras_especiais = array('ú'); 
    foreach($letras_especiais as $l){
    $nome_remover_Acento = str_replace($l, 'u', strtolower($nome_remover_Acento));
    }

    $letras_especiais = array('é','ê'); 
    foreach($letras_especiais as $l){
    $nome_remover_Acento = str_replace($l, 'e', strtolower($nome_remover_Acento)); 
    }

    $letras_especiais = array('í'); 
    foreach($letras_especiais as $l){
    $nome_remover_Acento = str_replace($l, 'i', strtolower($nome_remover_Acento));
    }

    $letras_especiais = array('ó','ô','õ'); 
    foreach($letras_especiais as $l){
    $nome_remover_Acento = str_replace($l, 'o', strtolower($nome_remover_Acento));
    }

    $letras_especiais = array('ú'); 
    foreach($letras_especiais as $l){
    $nome_inserir_Acento = str_replace($l, 'u', strtolower($nome_remover_Acento)); 
    }
    return $nome_remover_Acento;
}

function funSearchPagesByWords($search,$idioma){
    
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();
    
    $sql = "select code as page, title as titulo, description as descricao, idTbLanguage as idioma, 'seo' as tipo from sds2019.tb_seo_translations st
inner join sds2019.tb_seo s on st.idTbSeo= s.id
where idTbLanguage='".$idioma."' and (";
    $words=explode (' ',tirarAcentosPalavra ($search));
    
//    print_r($words);
    for ($i=0;$i<count($words);$i++){
        $word=trim($words[$i]);
        if ($word!=''){
            if ($i==0){
                $sql .= " keywords like '%".$word."%'";
            }else{
                $sql .= " or keywords like '%".$word."%'";
            }
        }
    }
    $sql .=")";
//    echo $sql;

    $pages =array();
    if ($result = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pages[]=$row;
        }
    }
    
        $sql2 = "select idTbNews as page, title as titulo, details as descricao, idTbLanguage as idioma, 'noticias' as tipo from sds2019.tb_news_translation 
where idTbLanguage='".$idioma."' and (";
    $words=explode (' ',tirarAcentosPalavra ($search));
    
//    print_r($words);
    for ($i=0;$i<count($words);$i++){
        $word=trim($words[$i]);
        if ($word!=''){
            if ($i==0){
                $sql2 .= " details like '%".$word."%'";
            }else{
                $sql2 .= " or details like '%".$word."%'";
            }
        }
    }
    $sql2 .=")";
//    echo $sql;

    if ($result = $connection->query($sql2)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pages[]=$row;
        }
    }
    
    return $pages;
}

function funGetLanguageSelectOptions()
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }

    $sql = "SELECT
        tb_language.id,
        tb_language.langMin,
        tb_language.lang
    FROM tb_country_language
    JOIN tb_language ON tb_language.id = tb_country_language.idTbLanguage
    JOIN tb_country ON tb_country.id = tb_country_language.idTbCountry
    WHERE tb_country_language.status =1
    AND tb_language.deleted = 0
    AND tb_country.abbCountry ='$country'
    ORDER BY tb_language.id";

    $options = "<option value='".$lang."'>".$lang.'</option>';

    if ($res = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($res)) {
            $options .= "<option value='".$row['langMin']."'>".$row['langMin'].'</option>';
        }
    }

    return $options;
}

function printHeaderBanner($tag)
{
    $checkButton = funGetAdvancedBannersAsArray($tag);
    if (trim($checkButton[0]['callTitle']) == '') {
        $html = '
        <h1 class="redtitle">{{title}}</h1>
        <h3 class="subtitle">{{subtitle}}</h3>';
    } else {
        $html = '
        <h1 class="redtitle">{{title}}</h1>
        <h3 class="subtitle">{{subtitle}}</h3>';
    }

    return funGetAdvancedBanners($tag, $html);
}

function getTranslatableImages($tag, $html)
{
    include_once PATH_DATABASE_BASE;
    $db = Database::getInstance();
    $connection = $db->getConnection();

    if (isset($_COOKIE['country'])) {
        $country = $_COOKIE['country'];
    } else {
        $country = 'PT';
    }
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'PT';
    }

    $sql = "SELECT
        tb_images.position,
        tb_gallery.path,
        tb_gallery.alt
    FROM tb_images
    JOIN tb_images_tag ON tb_images.idTbImagesTag = tb_images_tag.id
    JOIN tb_images_translation ON tb_images_translation.idTbImages = tb_images.id
    JOIN tb_gallery ON tb_images_translation.idTbGallery = tb_gallery.id
    JOIN tb_country ON tb_images_translation.idTbCountry = tb_country.id
    JOIN tb_language ON tb_images_translation.idTbLanguage = tb_language.id
    WHERE (
        tb_country.abbCountry = '$country'
        AND
        tb_language.langMin = '$lang'
        AND
        tb_images_tag.tag = '$tag'
    )
    ORDER BY tb_images.position ASC";
    // echo $sql;
    $images = array();
    if ($res = $connection->query($sql)) {
        while ($row = mysqli_fetch_assoc($res)) {
            array_push($images, $row);
        }
    }

    $out = "<!-- TRANSLATABLE IMAGE $tag -->";
    foreach ($images as $i => $img) {
        $item = $html;
        $key = $i == 0 ? '' : '_'.($i + 1);
        $item = str_ireplace('{{img'.$key.'}}', URLAMIGAVEL . $img['path'], $item);
        $item = str_ireplace('{{alt'.$key.'}}', $img['alt'], $item);
        $out = $item;
    }

    return $out;
}

function printContacts($tag)
{
    $html = '
        <link rel="stylesheet" href="assets/css/home/contacts.css">
        <section id="contacts" style="background-image: linear-gradient(to right, rgba(19,77,171,0.6) 0%,rgba(19,77,171,0.6) 100%), url({{img}})">
            <h3 class="moviment">{{title}}</h3>
            <div class="content moviment">{{text}}</div>
            <a class="button" href="{{callAction}}">{{callTitle}}</a>
            <div class="image"><img src="{{img_2}}"></div>
        
        </section>
    ';

    return funGetAdvancedBanners($tag, $html);
}
