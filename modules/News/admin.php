<?php
/**
 * admin.php
 *
 * Backend of News module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! adminInit('News'))
    return;


function main() {
    global $nuked, $language, $p;

    $nb_news = 30;

    $sql = nkDB_execute("SELECT id FROM " . NEWS_TABLE);
    $count = nkDB_numRows($sql);

    $start = $p * $nb_news - $nb_news;

    echo "<script type=\"text/javascript\">\n"
        . "<!--\n"
        . "\n"
        . "function del_news(titre, id)\n"
        . "{\n"
        . "if (confirm('" . _DELETENEWS . " '+titre+' ! " . _CONFIRM . "'))\n"
        . "{document.location.href = 'index.php?file=News&page=admin&op=do_del&news_id='+id;}\n"
        . "}\n"
        . "\n"
        . "// -->\n"
        . "</script>\n";

    echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
        . "<div class=\"content-box-header\"><h3>" . _ADMINNEWS . "</h3>\n"
        . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/News.php\" rel=\"modal\">\n"
        . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
        . "</div></div>\n"
        . "<div class=\"tab-content\" id=\"tab2\">\n";

        nkAdminMenu(1);

    if (! array_key_exists('orderby', $_REQUEST)){
        $order_by = 'date DESC';
    } else if ($_REQUEST['orderby'] == "date") {
        $order_by = "date DESC";
    } else if ($_REQUEST['orderby'] == "title") {
        $order_by = "titre";
    } else if ($_REQUEST['orderby'] == "cat") {
        $order_by = "cat";
    } else if ($_REQUEST['orderby'] == "author") {
        $order_by = "auteur";
    } else {
        $order_by = "date DESC";
    }

    echo "<table width=\"100%\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">\n"
        . "<tr><td align=\"right\">" . _ORDERBY . " : ";

    if ((array_key_exists('orderby', $_REQUEST) && $_REQUEST['orderby'] == "date") || ! array_key_exists('orderby', $_REQUEST)) {
        echo "<b>" . _DATE . "</b> | ";
    } else {
        echo "<a href=\"index.php?file=News&amp;page=admin&amp;orderby=date\">" . _DATE . "</a> | ";
    }

    if (array_key_exists('orderby', $_REQUEST) && $_REQUEST['orderby'] == "title") {
        echo "<b>" . _TITLE . "</b> | ";
    } else {
        echo "<a href=\"index.php?file=News&amp;page=admin&amp;orderby=title\">" . _TITLE . "</a> | ";
    }

    if (array_key_exists('orderby', $_REQUEST) && $_REQUEST['orderby'] == "author") {
        echo "<b>" . __('AUTHOR') . "</b> | ";
    } else {
        echo "<a href=\"index.php?file=News&amp;page=admin&amp;orderby=author\">" . __('AUTHOR') . "</a> | ";
    }

    if (array_key_exists('orderby', $_REQUEST) && $_REQUEST['orderby'] == "cat") {
        echo "<b>" . _CAT . "</b>";
    } else {
        echo "<a href=\"index.php?file=News&amp;page=admin&amp;orderby=cat\">" . _CAT . "</a>";
    }

    echo "&nbsp;</td></tr></table>\n";


    if ($count > $nb_news) {
        echo "<div>";
        $url = "index.php?file=News&amp;page=admin&amp;orderby=" . $_REQUEST['orderby'];
        number($count, $nb_news, $url);
        echo "</div>\n";
    }

    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\n"
        . "<tr>\n"
        . "<td style=\"width: 25%;\" align=\"center\"><b>" . _TITLE . "</b></td>\n"
        . "<td style=\"width: 15%;\" align=\"center\"><b>" . _CAT . "</b></td>\n"
        . "<td style=\"width: 20%;\" align=\"center\"><b>" . _DATE . "</b></td>\n"
        . "<td style=\"width: 20%;\" align=\"center\"><b>" . __('AUTHOR') . "</b></td>\n"
        . "<td style=\"width: 10%;\" align=\"center\"><b>" . _EDIT . "</b></td>\n"
        . "<td style=\"width: 10%;\" align=\"center\"><b>" . _DEL . "</b></td></tr>\n";

    $sql2 = nkDB_execute("SELECT id, titre, auteur, auteur_id, cat, date FROM " . NEWS_TABLE . " ORDER BY " . $order_by . " LIMIT " . $start . ", " . $nb_news);
    while (list($news_id, $titre, $autor, $autor_id, $cat, $date) = nkDB_fetchArray($sql2)) {
        $date = nkDate($date);

        $sql3 = nkDB_execute("SELECT titre FROM " . NEWS_CAT_TABLE . " WHERE nid = '" . $cat. "'");
        list($categorie) = nkDB_fetchArray($sql3);
        $categorie = printSecuTags($categorie);

        if ($autor_id != "") {
            $sql4 = nkDB_execute("SELECT pseudo FROM " . USER_TABLE . " WHERE id = '" . $autor_id . "'");
            $test = nkDB_numRows($sql4);
        }

        if ($autor_id != "" && $test > 0) {
            list($_REQUEST['auteur']) = nkDB_fetchArray($sql4);
        } else {
            $_REQUEST['auteur'] = $autor;
        }

        if (strlen($titre) > 25) {
            $title = "<span style=\"cursor: hand\" title=\"" . printSecuTags($titre) . "\">" . printSecuTags(substr($titre, 0, 25)) . "...</span>";
        } else {
            $title = printSecuTags($titre);
        }

        echo "<tr>\n"
            . "<td style=\"width: 25%;\">" . $title . "</td>\n"
            . "<td style=\"width: 15%;\" align=\"center\">" . $categorie . "</td>\n"
            . "<td style=\"width: 20%;\" align=\"center\">" . $date . "</td>\n"
            . "<td style=\"width: 20%;\" align=\"center\">" . $_REQUEST['auteur'] . "</td>\n"
            . "<td style=\"width: 10%;\" align=\"center\"><a href=\"index.php?file=News&amp;page=admin&amp;op=edit&amp;news_id=" . $news_id . "\"><img style=\"border: 0;\" src=\"images/edit.gif\" alt=\"\" title=\"" . _EDITTHISNEWS . "\" /></a></td>\n"
            . "<td style=\"width: 10%;\" align=\"center\"><a href=\"javascript:del_news('" . addslashes($titre) . "', '" . $news_id . "');\"><img style=\"border: 0;\" src=\"images/del.gif\" alt=\"\" title=\"" . _DELTHISNEWS . "\" /></a></td></tr>\n";
    }

    if ($count == 0) {
        echo "<tr><td align=\"center\" colspan=\"6\">" . _NONEWSINDB . "</td></tr>\n";
    }

    echo" </table>\n";

    if ($count > $nb_news) {
        echo "<div>";
        $url = "index.php?file=News&amp;page=admin&amp;orderby=" . $_REQUEST['orderby'];
        number($count, $nb_news, $url);
        echo "</div>\n";
    }

    echo "<br /><div style=\"text-align: center;\"><a class=\"buttonLink\" href=\"index.php?file=Admin\">" . __('BACK') . "</a></div><br /></div></div>\n";
}

function add() {
    global $nuked, $language;

    echo '<script type="text/javascript">
    function checkAddNews(){
        if(document.getElementById(\'newsTitle\').value.length == 0){
            alert(\''. _TITLENEWSFORGOT .'\');
            return false;
        }
        if($.trim(getEditorContent(\'newsText\')) == ""){
            alert(\''. _TEXTNEWSFORGOT .'\');
            return false;
        }

        newsHour = document.getElementById(\'newsHour\').value;

        if (newsHour != "" && ! checkTimeValue(newsHour)){
            alert(\''. _BADTIME .'\');
            return false;
        }

        return true;
    }
    </script>';

    echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
        . "<div class=\"content-box-header\"><h3>" . _ADDNEWS . "</h3>\n"
        . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/News.php\" rel=\"modal\">\n"
        . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
        . "</div></div>\n"
        . "<div class=\"tab-content\" id=\"tab2\">\n";

        nkAdminMenu(2);

    echo "<form method=\"post\" action=\"index.php?file=News&amp;page=admin&amp;op=do_add\" onsubmit=\"return checkAddNews()\" enctype=\"multipart/form-data\">\n"
        . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">\n"
        . "<tr><td align=\"center\"><b>" . _TITLE . " :</b>&nbsp;<input type=\"text\" id=\"newsTitle\" name=\"titre\" maxlength=\"100\" size=\"45\" /></td></tr>\n"
        . "<tr><td align=\"center\"><b>" . _PUBLISH . "&nbsp;" . _THE ." :</b>&nbsp;<select id=\"news_jour\" name=\"jour\">\n";

    $day = 1;
    while ($day < 32) {
        if ($day == date("d")) {
            echo "<option value=\"" . $day . "\" selected=\"selected\">" . $day . "</option>\n";
        } else {
            echo "<option value=\"" . $day . "\">" . $day . "</option>\n";
        }
        $day++;
    }

    echo "</select>&nbsp;<select id=\"news_mois\" name=\"mois\">\n";

    $month = 1;
    while ($month < 13) {
        if ($month == date("m")) {
            echo "<option value=\"" . $month . "\" selected=\"selected\">" . $month . "</option>\n";
        } else {
            echo "<option value=\"" . $month . "\">" . $month . "</option>\n";
        }
        $month++;
    }

    echo "</select>&nbsp;<select id=\"news_annee\" name=\"annee\">\n";

    $prevprevprevyear = date("Y") -3;
    $prevprevyear = date("Y") -2;
    $prevyear = date("Y") -1;
    $year = date("Y") ;
    $nextyear = date("Y") + 1;
    $nextnextyear = date("Y") + 2;
    $check = "selected=\"selected\"";

    echo "<option value=\"" . $prevprevprevyear . "\">" . $prevprevprevyear . "</option>\n"
        . "<option value=\"" . $prevprevyear . "\">" . $prevprevyear . "</option>\n"
        . "<option value=\"" . $prevyear . "\">" . $prevyear . "</option>\n"
        . "<option value=\"" . $year . "\" " . $check . ">" . $year . "</option>\n";

    $heure = date("H:i");

    echo "<option value=\"" . $nextyear . "\">" . $nextyear . "</option>\n"
        . "<option value=\"" . $nextnextyear . "\">" . $nextnextyear . "</option>\n"
        . "</select>&nbsp;<b>" . _AT . " :</b>&nbsp;<input type=\"text\" id=\"newsHour\" name=\"heure\" size=\"5\" maxlength=\"5\" value=\"" . $heure . "\" /></td></tr>\n"
        . "<tr><td><b>" . _IMAGE . " :</b> <input type=\"text\" name=\"urlImage\" size=\"42\" /></td></tr>\n"
        . "<tr><td><b>" . _UPLOADIMAGE . " :</b> <input type=\"file\" name=\"upImage\" /></td></tr>\n"
        . "<tr><td align=\"center\"><b>" . _CAT . " :</b> <select id=\"news_cat\" name=\"cat\">\n";

    select_news_cat();

    echo "</select></td></tr><tr><td>&nbsp;</td></tr>\n"
        . "<tr><td align=\"center\"><big><b>" . _TEXT . " :</b></big></td></tr>\n";


    echo "<tr><td align=\"center\"><textarea id=\"newsText\" class=\"editor\" name=\"texte\" cols=\"70\" rows=\"15\"></textarea></td></tr>\n"
        . "<tr><td>&nbsp;</td></tr><tr><td align=\"center\"><big><b>" . _MORE . " :</b></big></td></tr>\n";



    echo "<tr><td align=\"center\"><textarea class=\"editor\" name=\"suite\" cols=\"70\" rows=\"15\"></textarea></td></tr>\n"
        . "</table><br /><div style=\"text-align: center;\"><input class=\"button\" type=\"submit\" value=\"" . _ADDNEWS . "\" /><a class=\"buttonLink\" href=\"index.php?file=News&amp;page=admin&amp;op=main\">" . __('BACK') . "</a></div>\n"
        . "</form><br /></div></div>\n";
}

function do_add($titre, $texte, $suite, $cat, $jour, $mois, $annee, $heure) {
    global $nuked, $user;

    require_once 'Includes/nkUpload.php';

    if ($titre == '' || ctype_space($titre)) {
        printNotification(stripslashes(_NOTITLE), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $texte = nkHtmlEntityDecode($texte);

    if ($texte == '' || ctype_space(strip_tags($texte))) {
        printNotification(stripslashes(_NOTEXT), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $texte = secu_html($texte, true);

    if ($texte === false) {
        printNotification(_HTMLNOCORRECT, 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $suite = secu_html(nkHtmlEntityDecode($suite));

    $hour = $minute = 0;

    if ($heure != '') {
        $timeArray = explode(':', $heure, 2);
        $hour      = (isset($timeArray[0])) ? (int) $timeArray[0] : null;
        $minute    = (isset($timeArray[1])) ? (int) $timeArray[1] : null;

        if ($hour === null || $minute === null || $hour > 24 || $hour < 0 || $minute > 60 || $minute < 0) {
            printNotification(_BADTIME, 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }
    }

    if (($date = mktime($hour, $minute, 0, $mois, $jour, $annee)) === false) {
        printNotification(_BADDATE, 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $auteur = $user[2];
    $auteur_id = $user[0];

    //Upload du fichier
    $coverageUrl = '';

    $coverageCfg = array(
        'allowedExtension'  => array('jpg', 'jpeg', 'png', 'gif'),
        'uploadDir'         => 'upload/News'
    );

    if ($_FILES['upImage']['name'] != '') {
        list($coverageUrl, $uploadError, $coverageExt) = nkUpload_check('upImage', $coverageCfg);

        if ($uploadError !== false) {
            printNotification($uploadError, 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }
    }
    else if ($_POST['urlImage'] != '') {
        $ext = strtolower(substr(strrchr($_POST['urlImage'], '.'), 1));

        if (! in_array($ext, $coverageCfg['allowedExtension'])) {
            printNotification(__('BAD_IMAGE_FORMAT'), 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }

        $coverageUrl = stripslashes($_POST['urlImage']);
    }

    $cat         = (int) $cat;
    $coverageUrl = nkDB_realEscapeString($coverageUrl);
    $titre       = nkDB_realEscapeString(stripslashes($titre));
    $texte       = nkDB_realEscapeString(stripslashes($texte));
    $suite       = nkDB_realEscapeString(stripslashes($suite));

    nkDB_execute(
        "INSERT INTO ". NEWS_TABLE ."
        (`cat`, `titre`, `coverage`, `auteur`, `auteur_id`, `texte`, `suite`, `date`)
        VALUES
        ('". $cat ."', '". $titre ."', '". $coverageUrl ."', '". $auteur ."', '". $auteur_id ."', '". $texte ."', '". $suite ."', '". $date ."')"
    );

    $id = nkDB_insertId();

    saveUserAction(_ACTIONADDNEWS .': '. $titre .'.');

    printNotification(_NEWSADD, 'success');

    require_once 'Includes/nkSitemap.php';

    if (! nkSitemap_write()) {
        printNotification(__('WRITE_SITEMAP_FAILED'), 'error');
        redirect('index.php?file=News&page=admin', 5);
        return;
    }

    setPreview('index.php?file=News&op=suite&news_id='. $id, 'index.php?file=News&page=admin');
}

function edit($news_id) {
    global $nuked, $language;

    $news_id = (int) $news_id;

    $sql = nkDB_execute("SELECT titre, coverage, texte, suite, date, cat FROM " . NEWS_TABLE . " WHERE id = '" . $news_id . "'");
    list($titre, $coverage, $texte, $suite, $date, $cat) = nkDB_fetchArray($sql);

    $sql2 = nkDB_execute("SELECT nid, titre FROM " . NEWS_CAT_TABLE . " WHERE nid = '" . $cat . "'");
    list($cid, $categorie) = nkDB_fetchArray($sql2);

    echo '<script type="text/javascript">
    function checkEditNews(){
        if(document.getElementById(\'newsTitle\').value.length == 0){
            alert(\''. _TITLENEWSFORGOT .'\');
            return false;
        }
        if($.trim(getEditorContent(\'newsText\')) == ""){
            alert(\''. _TEXTNEWSFORGOT .'\');
            return false;
        }

        newsHour = document.getElementById(\'newsHour\').value;

        if (newsHour != "" && ! checkTimeValue(newsHour)){
            alert(\''. _BADTIME .'\');
            return false;
        }

        return true;
    }
    </script>';

    echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
        . "<div class=\"content-box-header\"><h3>" . _EDITTHISNEWS . "</h3>\n"
        . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/News.php\" rel=\"modal\">\n"
        . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
        . "</div></div>\n";
        printNotification(_NOTIFIMAGECOVERAGE);
    echo "<div class=\"tab-content\" id=\"tab2\"><form method=\"post\" action=\"index.php?file=News&amp;page=admin&amp;op=do_edit&amp;news_id=" . $news_id . "\" onsubmit=\"return checkEditNews()\" enctype=\"multipart/form-data\">\n"
        . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">\n"
        . "<tr><td align=\"center\"><b>" . _TITLE . " :</b>&nbsp;<input type=\"text\" id=\"newsTitle\" name=\"titre\" maxlength=\"100\" size=\"45\" value=\"" . printSecuTags($titre) . "\" /></td></tr>\n"
        . "<tr><td align=\"center\"><b>" . _PUBLISH . "&nbsp;" . _THE ." :</b>&nbsp;<select id=\"news_jour\" name=\"jour\">\n";

    $day = 1;
    while ($day < 32) {
        if ($day == date("d", $date)) {
            echo "<option value=\"" . $day . "\" selected=\"selected\">" . $day . "</option>\n";
        } else {
            echo "<option value=\"" . $day . "\">" . $day . "</option>\n";
        }
        $day++;
    }

    echo "</select>&nbsp;<select id=\"news_mois\" name=\"mois\">\n";

    $month = 1;
    while ($month < 13) {
        if ($month == date("m", $date)) {
            echo "<option value=\"" . $month . "\" selected=\"selected\">" . $month . "</option>\n";
        } else {
            echo "<option value=\"" . $month . "\">" . $month . "</option>\n";
        }
        $month++;
    }

    echo "</select>&nbsp;<select id=\"news_annee\" name=\"annee\">\n";

    $prevprevprevyear = date("Y", $date) -3;
    $prevprevyear = date("Y", $date) -2;
    $prevyear = date("Y", $date) -1;
    $year = date("Y", $date) ;
    $nextyear = date("Y", $date) + 1;
    $nextnextyear = date("Y", $date) + 2;
    $check = "selected=\"selected\"";

    echo "<option value=\"" . $prevprevprevyear . "\">" . $prevprevprevyear . "</option>\n"
        . "<option value=\"" . $prevprevyear . "\">" . $prevprevyear . "</option>\n"
        . "<option value=\"" . $prevyear . "\">" . $prevyear . "</option>\n"
        . "<option value=\"" . $year . "\" " . $check . ">" . $year . "</option>\n";

    $heure = date("H:i", $date);

    echo "<option value=\"" . $nextyear . "\">" . $nextyear . "</option>\n"
        . "<option value=\"" . $nextnextyear . "\">" . $nextnextyear . "</option>\n"
        . "</select>&nbsp;<b>" . _AT . " :</b>&nbsp;<input type=\"text\" id=\"newsHour\" name=\"heure\" size=\"5\" maxlength=\"5\" value=\"" . $heure . "\" /></td></tr>\n"
        . "<tr><td><b>" . _IMAGE . " :</b> <input type=\"text\" name=\"urlImage\" value=\"" . $coverage . "\" size=\"42\" />\n";

        if ($coverage != ""){
            echo "<img src=\"" . $coverage . "\" title=\"" . printSecuTags($titre) . "\" style=\"margin-left:20px; width:300px; height:auto; vertical-align:middle;\" />\n";
        }

        echo "</td></tr>\n"
        . "<tr><td><b>" . _UPLOADIMAGE . " :</b> <input type=\"file\" name=\"upImage\" /></td></tr>\n"
        . "<tr><td align=\"center\"><b>" . _CAT . " :</b> <select id=\"news_cat\" name=\"cat\"><option value=\"" . $cid . "\">" . $categorie . "</option>\n";

    select_news_cat();

    $texte = editPhpCkeditor($texte);

    echo "</select></td></tr><tr><td>&nbsp;</td></tr>\n"
        . "<tr><td align=\"center\"><big><b>" . _TEXT . " :</b></big></td></tr>\n"
        . "<tr><td align=\"center\"><textarea class=\"editor\" id=\"newsText\" name=\"texte\" cols=\"70\" rows=\"15\">".$texte."</textarea></td></tr>\n"
        . "<tr><td>&nbsp;</td></tr><tr><td align=\"center\"><big><b>" . _MORE . " :</b></big></td></tr><tr><td align=\"center\">\n";


    echo "</td></tr><tr><td align=\"center\"><textarea class=\"editor\" name=\"suite\" cols=\"70\" rows=\"15\">".$suite."</textarea></td></tr>\n"
        . "</table><br /><div style=\"text-align: center;\"><input class=\"button\" type=\"submit\" value=\"" . _MODIFTHISNEWS . "\" /><a class=\"buttonLink\" href=\"index.php?file=News&amp;page=admin&amp;op=main\">" . __('BACK') . "</a></div>\n"
        . "</form><br /></div></div>\n";
}

function do_edit($news_id, $titre, $texte, $suite, $cat, $jour, $mois, $annee, $heure) {
    global $nuked, $user;

    $news_id = (int) $news_id;

    require_once 'Includes/nkUpload.php';

    if ($titre == '' || ctype_space($titre)) {
        printNotification(stripslashes(_NOTITLE), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $texte = nkHtmlEntityDecode($texte);

    if ($texte == '' || ctype_space(strip_tags($texte))) {
        printNotification(stripslashes(_NOTEXT), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $texte = secu_html($texte, true);

    if ($texte === false) {
        printNotification(_HTMLNOCORRECT, 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $suite = secu_html(nkHtmlEntityDecode($suite));

    $hour = $minute = 0;

    if ($heure != '') {
        $timeArray = explode(':', $heure, 2);
        $hour      = (isset($timeArray[0])) ? (int) $timeArray[0] : null;
        $minute    = (isset($timeArray[1])) ? (int) $timeArray[1] : null;

        if ($hour === null || $minute === null || $hour > 24 || $hour < 0 || $minute > 60 || $minute < 0) {
            printNotification(_BADTIME, 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }
    }

    if (($date = mktime($hour, $minute, 0, $mois, $jour, $annee)) === false) {
        printNotification(_BADDATE, 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    //Upload du fichier
    $coverageUrl = '';

    $coverageCfg = array(
        'allowedExtension'  => array('jpg', 'jpeg', 'png', 'gif'),
        'uploadDir'         => 'upload/News'
    );

    if ($_FILES['upImage']['name'] != '') {
        list($coverageUrl, $uploadError, $coverageExt) = nkUpload_check('upImage', $coverageCfg);

        if ($uploadError !== false) {
            printNotification($uploadError, 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }
    }
    else if ($_POST['urlImage'] != '') {
        $ext = strtolower(substr(strrchr($_POST['urlImage'], '.'), 1));

        if (! in_array($ext, $coverageCfg['allowedExtension'])) {
            printNotification(__('BAD_IMAGE_FORMAT'), 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }

        $coverageUrl = stripslashes($_POST['urlImage']);
    }

    $cat         = (int) $cat;
    $coverageUrl = nkDB_realEscapeString($coverageUrl);
    $titre       = nkDB_realEscapeString(stripslashes($titre));
    $texte       = nkDB_realEscapeString(stripslashes($texte));
    $suite       = nkDB_realEscapeString(stripslashes($suite));

    nkDB_execute(
        "UPDATE ". NEWS_TABLE ."
        SET cat = '" . $cat . "',
        titre = '" . $titre . "',
        coverage = '" . $coverageUrl . "',
        texte = '" . $texte . "',
        suite = '" . $suite . "',
        date = '" . $date . "'
        WHERE id = '" . $news_id . "'"
    );

    saveUserAction(_ACTIONMODIFNEWS .': '. $titre .'.');

    printNotification(_NEWSMODIF, 'success');
    setPreview('index.php?file=News&op=suite&news_id='. $news_id, 'index.php?file=News&page=admin');
}

function do_del($news_id) {
    global $nuked, $user;

    $news_id = (int) $news_id;

    $sqls = nkDB_execute("SELECT titre FROM " . NEWS_TABLE . " WHERE id = '" . $news_id . "'");
    list($titre) = nkDB_fetchArray($sqls);
    $titre = nkDB_realEscapeString(stripslashes($titre));
    $del = nkDB_execute("DELETE FROM " . NEWS_TABLE . " WHERE id = '" . $news_id . "'");
    $del_com = nkDB_execute("DELETE FROM " . COMMENT_TABLE . "  WHERE im_id = '" . $news_id . "' AND module = 'news'");

    saveUserAction(_ACTIONDELNEWS .': '. $titre .'.');

    printNotification(_NEWSDEL, 'success');
    redirect("index.php?file=News&page=admin", 2);
}

function main_cat() {
    global $nuked, $language;

    echo "<script type=\"text/javascript\">\n"
        . "<!--\n"
        . "\n"
        . "function del_cat(titre, id)\n"
        . "{\n"
        . "if (confirm('" . _DELETENEWS . " '+titre+' ! " . _CONFIRM . "'))\n"
        . "{document.location.href = 'index.php?file=News&page=admin&op=del_cat&cid='+id;}\n"
        . "}\n"
        . "\n"
        . "// -->\n"
        . "</script>\n";

    echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
        . "<div class=\"content-box-header\"><h3>" . _CATMANAGEMENT . "</h3>\n"
        . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/News.php\" rel=\"modal\">\n"
        . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
        . "</div></div>\n"
        . "<div class=\"tab-content\" id=\"tab2\">\n";

        nkAdminMenu(3);

    echo "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" width=\"70%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\n"
        . "<tr>\n"
        . "<td style=\"width: 60%;\" align=\"center\"><b>" . _CAT . "</b></td>\n"
        . "<td style=\"width: 20%;\" align=\"center\"><b>" . _EDIT . "</b></td>\n"
        . "<td style=\"width: 20%;\" align=\"center\"><b>" . _DEL . "</b></td></tr>\n";

    $sql = nkDB_execute("SELECT nid, titre FROM " . NEWS_CAT_TABLE . " ORDER BY titre");
    while (list($cid, $titre) = nkDB_fetchArray($sql)) {
        $titre = printSecuTags($titre);

    echo "<tr>\n"
        . "<td style=\"width: 60%;\" align=\"center\">" . $titre . "</td>\n"
        . "<td style=\"width: 20%;\" align=\"center\"><a href=\"index.php?file=News&amp;page=admin&amp;op=edit_cat&amp;cid=" . $cid . "\"><img style=\"border: 0;\" src=\"images/edit.gif\" alt=\"\" title=\"" . _EDITTHISCAT . "\" /></a></td>\n"
        . "<td style=\"width: 20%;\" align=\"center\"><a href=\"javascript:del_cat('" . addslashes($titre) . "','" . $cid . "');\"><img style=\"border: 0;\" src=\"images/del.gif\" alt=\"\" title=\"" . _DELTHISCAT . "\" /></a></td></tr>\n";
    }

    echo "</table><br /><div style=\"text-align: center;\"><a class=\"buttonLink\" href=\"index.php?file=News&amp;page=admin&amp;op=add_cat\">" . _ADDCAT . "</a><a class=\"buttonLink\" href=\"index.php?file=News&amp;page=admin\">" . __('BACK') . "</a></div>\n"
        . "<br /></div></div>\n";
}

function add_cat() {
    global $language;

    echo '<script type="text/javascript">
    function checkAddNewsCat(){
        if(document.getElementById(\'newsCatTitle\').value.length == 0){
            alert(\''. _NTITLECATFORGOT .'\');
            return false;
        }
        if(document.getElementById(\'newsCatText\').value.length == 0){
            alert(\''. _NOTEXT .'\');
            return false;
        }
    return true;
    }
    </script>';

    echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
        . "<div class=\"content-box-header\"><h3>" . _ADDCAT . "</h3>\n"
        . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/News.php\" rel=\"modal\">\n"
        . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
        . "</div></div>\n"
        . "<div class=\"tab-content\" id=\"tab2\"><form onsubmit=\"return checkAddNewsCat()\" method=\"post\" action=\"index.php?file=News&amp;page=admin&amp;op=send_cat\" enctype=\"multipart/form-data\">\n"
        . "<table  style=\"margin-left: auto;margin-right: auto;text-align: left;\">\n"
        . "<tr><td><b>" . _TITLE . " : </b><input id=\"newsCatTitle\" type=\"text\" name=\"titre\" size=\"30\" /></td></tr>\n"
        . "<tr><td>&nbsp;</td></tr><tr><td><b>" . _NURLIMG . " : </b><input type=\"text\" name=\"image\" size=\"39\" /></td></tr>\n"
        . "<tr><td><b>" . _NUPIMG . " : </b><input type=\"file\" name=\"fichiernom\" /></td></tr>\n"
        . "<tr><td>&nbsp;</td></tr><tr><td><b>" . _DESCR . " : </b><br /><textarea id=\"newsCatText\" class=\"editor\" name=\"description\" cols=\"65\" rows=\"10\"></textarea></td></tr>\n"
        . "</table><div style=\"text-align: center;\"><br /><input class=\"button\" type=\"submit\" value=\"" . _CREATECAT . "\" /><a class=\"buttonLink\" href=\"index.php?file=News&amp;page=admin&amp;op=main_cat\">" . __('BACK') . "</a></div>\n"
        . "</form><br /></div></div>\n";
}

function send_cat($titre, $description) {
    global $nuked, $user;

    require_once 'Includes/nkUpload.php';

    if ($titre == '' || ctype_space($titre)) {
        printNotification(stripslashes(_NOTITLE), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $description = nkHtmlEntityDecode($description);

    if ($description == '' || ctype_space(strip_tags($description))) {
        printNotification(stripslashes(_NOTEXT), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $description = secu_html($description, true);

    if ($description === false) {
        printNotification(_HTMLNOCORRECT, 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    //Upload du fichier
    $imageUrl = '';

    $imageCfg = array(
        'allowedExtension'  => array('jpg', 'jpeg', 'png', 'gif'),
        'uploadDir'         => 'upload/News'
    );

    if ($_FILES['fichiernom']['name'] != '') {
        list($imageUrl, $uploadError, $imageExt) = nkUpload_check('fichiernom', $imageCfg);

        if ($uploadError !== false) {
            printNotification($uploadError, 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }
    }
    else if ($_POST['image'] != '') {
        $ext = strtolower(substr(strrchr($_POST['image'], '.'), 1));

        if (! in_array($ext, $imageCfg['allowedExtension'])) {
            printNotification(__('BAD_IMAGE_FORMAT'), 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }

        $imageUrl = stripslashes($_POST['image']);
    }

    $titre       = nkDB_realEscapeString(stripslashes($titre));
    $description = nkDB_realEscapeString(stripslashes($description));
    $imageUrl    = nkDB_realEscapeString($imageUrl);

    nkDB_execute(
        "INSERT INTO ". NEWS_CAT_TABLE ."
        (`titre`, `description`, `image`)
        VALUES
        ('". $titre . "', '". $description . "', '". $imageUrl ."')"
    );

    saveUserAction(_ACTIONADDCATNEWS .': '. $titre .'.');

    printNotification(_CATADD, 'success');
    redirect("index.php?file=News&page=admin&op=main_cat", 2);
}

function edit_cat($cid) {
    global $nuked, $language;

    $cid = (int) $cid;

    $sql = nkDB_execute("SELECT titre, description, image FROM " . NEWS_CAT_TABLE . " WHERE nid = '" . $cid . "'");
    list($titre, $description, $image) = nkDB_fetchArray($sql);

    $titre = printSecuTags($titre);
    $description = editPhpCkeditor($description);

    echo '<script type="text/javascript">
    function checkEditNewsCat(){
        if(document.getElementById(\'newsCatTitle\').value.length == 0){
            alert(\''. _NTITLECATFORGOT .'\');
            return false;
        }
        if(document.getElementById(\'newsCatText\').value.length == 0){
            alert(\''. _NOTEXT .'\');
            return false;
        }

        return true;
    }
    </script>';

    echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
        . "<div class=\"content-box-header\"><h3>" . _EDITTHISCAT . "</h3>\n"
        . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/News.php\" rel=\"modal\">\n"
        . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
        . "</div></div>\n"
        . "<div class=\"tab-content\" id=\"tab2\"><form onsubmit=\"return checkEditNewsCat()\" method=\"post\" action=\"index.php?file=News&amp;page=admin&amp;op=modif_cat\" enctype=\"multipart/form-data\">\n"
        . "<table  style=\"margin-left: auto;margin-right: auto;text-align: left;\">\n"
        . "<tr><td><b>" . _TITLE . " : </b><input id=\"newsCatTitle\" type=\"text\" name=\"titre\" size=\"30\" value=\"" . $titre . "\" /></td></tr>\n"
        . "<tr><td>&nbsp;</td></tr><tr><td><b>" . _NURLIMG . " : </b><input type=\"text\" name=\"image\" size=\"39\" value=\"" . $image . "\" />\n";

    if ($image != ""){
    echo "<img src=\"" . $image . "\" title=\"" . $titre . "\" style=\"margin-left:20px; width:50px; height:50px; vertical-align:middle;\" />\n";
    }

    echo "</td></tr>\n"
        . "<tr><td><b>" . _NUPIMG . " : </b><input type=\"file\" name=\"fichiernom\" /></td></tr>\n"
        . "<tr><td>&nbsp;</td></tr><tr><td><b>" . _DESCR . " : </b><br /><textarea id=\"newsCatText\" class=\"editor\" name=\"description\" cols=\"65\" rows=\"10\">" . $description . "</textarea></td></tr>\n"
        . "</table><div style=\"text-align: center;\"><input type=\"hidden\" name=\"cid\" value=\"" . $cid . "\" /><br /><input class=\"button\" type=\"submit\" value=\"" . _MODIFTHISCAT . "\" /><a class=\"buttonLink\" href=\"index.php?file=News&amp;page=admin&amp;op=main_cat\">" . __('BACK') . "</a></div>\n"
        . "</form><br /></div>\n";

}

function modif_cat($cid, $titre, $description) {
    global $nuked, $user;

    $cid = (int) $cid;

    require_once 'Includes/nkUpload.php';

    if ($titre == '' || ctype_space($titre)) {
        printNotification(stripslashes(_NOTITLE), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $description = nkHtmlEntityDecode($description);

    if ($description == '' || ctype_space(strip_tags($description))) {
        printNotification(stripslashes(_NOTEXT), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $description = secu_html($description, true);

    if ($description === false) {
        printNotification(_HTMLNOCORRECT, 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    //Upload du fichier
    $imageUrl = '';

    $imageCfg = array(
        'allowedExtension'  => array('jpg', 'jpeg', 'png', 'gif'),
        'uploadDir'         => 'upload/News'
    );

    if ($_FILES['fichiernom']['name'] != '') {
        list($imageUrl, $uploadError, $imageExt) = nkUpload_check('fichiernom', $imageCfg);

        if ($uploadError !== false) {
            printNotification($uploadError, 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }
    }
    else if ($_POST['image'] != '') {
        $ext = strtolower(substr(strrchr($_POST['image'], '.'), 1));

        if (! in_array($ext, $imageCfg['allowedExtension'])) {
            printNotification(__('BAD_IMAGE_FORMAT'), 'error', array('backLinkUrl' => 'javascript:history.back()'));
            return;
        }

        $imageUrl = stripslashes($_POST['image']);
    }

    $titre       = nkDB_realEscapeString(stripslashes($titre));
    $description = nkDB_realEscapeString(stripslashes($description));
    $imageUrl    = nkDB_realEscapeString($imageUrl);

    nkDB_execute(
        "UPDATE ". NEWS_CAT_TABLE ."
        SET titre = '" . $titre . "',
        description = '" . $description . "',
        image = '" . $imageUrl . "'
        WHERE nid = '" . $cid . "'"
    );

    saveUserAction(_ACTIONEDITCATNEWS .': '. $titre .'.');

    printNotification(_CATMODIF, 'success');
    redirect("index.php?file=News&page=admin&op=main_cat", 2);
}

function select_news_cat() {
    global $nuked;

    $sql = nkDB_execute("SELECT nid, titre FROM " . NEWS_CAT_TABLE);
    while (list($cid, $titre) = nkDB_fetchArray($sql)) {
        $titre = printSecuTags($titre);
        echo "<option value=\"" . $cid . "\">" . $titre . "</option>\n";
    }
}

function del_cat($cid) {
    global $nuked, $user;

    $cid = (int) $cid;

    $sqlq = nkDB_execute("SELECT titre FROM " . NEWS_CAT_TABLE . " WHERE nid = '" . $cid . "'");
    list($titre) = nkDB_fetchArray($sqlq);
    $titre = nkDB_realEscapeString(stripslashes($titre));
    $sql = nkDB_execute("DELETE FROM " . NEWS_CAT_TABLE . " WHERE nid = '" . $cid . "'");

    saveUserAction(_ACTIONDELCATNEWS .': '. $titre .'.');

    printNotification(_CATDEL, 'success');
    redirect("index.php?file=News&page=admin&op=main_cat", 2);
}

function main_pref() {
    global $nuked, $language;

    echo '<script type="text/javascript">
    function checkNewsSetting(){
        if(! document.getElementById(\'nbNews\').value.match(/^\d+$/)){
            alert(\''. _NB_NEWS_NO_INTEGER .'\');
            return false;
        }
        if(! document.getElementById(\'nbArchives\').value.match(/^\d+$/)){
            alert(\''. _NB_ARCHIVES_NO_INTEGER .'\');
            return false;
        }

        return true;
    }
    </script>';

    echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
        . "<div class=\"content-box-header\"><h3>" . _PREFS . "</h3>\n"
        . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/News.php\" rel=\"modal\">\n"
        . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
        . "</div></div>\n"
        . "<div class=\"tab-content\" id=\"tab2\">\n";

        nkAdminMenu(4);

    echo "<form onsubmit=\"return checkNewsSetting()\" method=\"post\" action=\"index.php?file=News&amp;page=admin&amp;op=change_pref\">\n"
        . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">\n"
        . "<tr><td>" . _NUMBERNEWS . " :</td><td> <input id=\"nbNews\" type=\"text\" name=\"max_news\" size=\"2\" value=\"" . $nuked['max_news'] . "\" /></td></tr>\n"
        . "<tr><td>" . _NUMBERARCHIVE . " :</td><td> <input id=\"nbArchives\" type=\"text\" name=\"max_archives\" size=\"2\" value=\"" . $nuked['max_archives'] . "\" /></td></tr>\n"
        . "</table><div style=\"text-align: center;\"><br /><input class=\"button\" type=\"submit\" value=\"" . __('SEND') . "\" /><a class=\"buttonLink\" href=\"index.php?file=News&amp;page=admin\">" . __('BACK') . "</a></div>\n"
        . "</form><br /></div></div>\n";
}

function change_pref($max_news, $max_archives) {
    global $nuked, $user;

    if ($max_news == '' || ! ctype_digit($max_news)) {
        printNotification(stripslashes(_NB_NEWS_NO_INTEGER), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    if ($max_archives == '' || ! ctype_digit($max_archives)) {
        printNotification(stripslashes(_NB_ARCHIVES_NO_INTEGER), 'error', array('backLinkUrl' => 'javascript:history.back()'));
        return;
    }

    $max_news     = (int) $max_news;
    $max_archives = (int) $max_archives;

    nkDB_execute("UPDATE " . CONFIG_TABLE . " SET value = '" . $max_news . "' WHERE name = 'max_news'");
    nkDB_execute("UPDATE " . CONFIG_TABLE . " SET value = '" . $max_archives . "' WHERE name = 'max_archives'");

    saveUserAction(_ACTIONPREFNEWS .'.');

    printNotification(_PREFUPDATED, 'success');
    redirect("index.php?file=News&page=admin", 2);
}

function nkAdminMenu($tab = 1) {
    global $language, $user, $nuked;

    $class = ' class="nkClassActive" ';
?>
    <div class= "nkAdminMenu">
        <ul class="shortcut-buttons-set" id="1">
            <li <?php echo ($tab == 1 ? $class : ''); ?>>
                <a class="shortcut-button" href="index.php?file=News&amp;page=admin">
                    <img src="modules/Admin/images/icons/speedometer.png" alt="icon" />
                    <span><?php echo _NAVNEWS; ?></span>
                </a>
            </li>
            <li <?php echo ($tab == 2 ? $class : ''); ?>>
                <a class="shortcut-button" href="index.php?file=News&amp;page=admin&amp;op=add">
                    <img src="modules/Admin/images/icons/add_page.png" alt="icon" />
                    <span><?php echo _ADDNEWS; ?></span>
                </a>
            </li>
            <li <?php echo ($tab == 3 ? $class : ''); ?>>
                <a class="shortcut-button" href="index.php?file=News&amp;page=admin&amp;op=main_cat">
                    <img src="modules/Admin/images/icons/folder_full.png" alt="icon" />
                    <span><?php echo _CATMANAGEMENT; ?></span>
                </a>
            </li>
            <li <?php echo ($tab == 4 ? $class : ''); ?>>
                <a class="shortcut-button" href="index.php?file=News&amp;page=admin&amp;op=main_pref">
                    <img src="modules/Admin/images/icons/process.png" alt="icon" />
                    <span><?php echo _PREFS; ?></span>
                </a>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
<?php
}


switch ($GLOBALS['op']) {
    case "edit":
        edit($_REQUEST['news_id']);
        break;

    case "add":
        add();
        break;

    case "do_del":
        do_del($_REQUEST['news_id']);
        break;

    case "do_add":
        do_add($_REQUEST['titre'], $_REQUEST['texte'], $_REQUEST['suite'], $_REQUEST['cat'], $_REQUEST['jour'], $_REQUEST['mois'], $_REQUEST['annee'], $_REQUEST['heure']);
        break;

    case "do_edit":
        do_edit($_REQUEST['news_id'], $_REQUEST['titre'], $_REQUEST['texte'], $_REQUEST['suite'], $_REQUEST['cat'], $_REQUEST['jour'], $_REQUEST['mois'], $_REQUEST['annee'], $_REQUEST['heure']);
        break;

    case "main":
        main();
        break;

    case "send_cat":
        send_cat($_REQUEST['titre'], $_REQUEST['description']);
        break;

    case "add_cat":
        add_cat();
        break;

    case "main_cat":
        main_cat();
        break;

    case "edit_cat":
        edit_cat($_REQUEST['cid']);
        break;

    case "modif_cat":
        modif_cat($_REQUEST['cid'], $_REQUEST['titre'], $_REQUEST['description']);
        break;

    case "del_cat":
        del_cat($_REQUEST['cid']);
        break;

    case "main_pref":
        main_pref();
        break;

    case "change_pref":
        change_pref($_REQUEST['max_news'], $_REQUEST['max_archives']);
        break;

    default:
        main();
        break;
}

?>
