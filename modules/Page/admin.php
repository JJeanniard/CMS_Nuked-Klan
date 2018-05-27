<?php
/**
 * admin.php
 *
 * Backend of Page module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! adminInit('Page'))
    return;


function main()
{
global $nuked, $language, $bgcolor1, $bgcolor2, $bgcolor3;

    echo"<script type=\"text/javascript\">\n"
."<!--\n"
."\n"
. "function del_page(titre, id)\n"
. "{\n"
. "if (confirm('" . _DELETEPAGE . " '+titre+' ! " . _CONFIRM . "'))\n"
. "{document.location.href = 'index.php?file=Page&page=admin&op=del&page_id='+id;}\n"
. "}\n"
    . "\n"
. "// -->\n"
. "</script>\n";

    echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
    . "<div class=\"content-box-header\"><h3>Gestion des Pages</h3>\n"
    . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Page.html\" rel=\"modal\">\n"
. "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
. "</div></div>\n"
. "<div class=\"tab-content\" id=\"tab2\">\n";

nkAdminMenu(1);

echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\n"
. "<tr>\n"
. "<td style=\"width: 30%;\" align=\"center\"><b>" . _PAGENAME . "</b></td>\n"
. "<td style=\"width: 30%;\" align=\"center\"><b>" . _PAGEFILE . "</b></td>\n"
. "<td style=\"width: 10%;text-align: center;\"><b>" . _PAGETYPE . "</b></td>\n"
. "<td style=\"width: 15%;text-align: center;\"><b>" . _EDIT . "</b></td>\n"
. "<td style=\"width: 15%;text-align: center;\"><b>" . _DEL . "</b></td></tr>\n";

$i = 0;
$sql = nkDB_execute("SELECT id, titre, url, type FROM " . PAGE_TABLE . " ORDER BY titre");
$nb_page = nkDB_numRows($sql);

while (list($page_id, $titre, $url, $type) = nkDB_fetchArray($sql))
{
    if ($url != "") $pagename = $url;
    else $pagename = _NOFILE;

        if ($i == 0)
        {
            $bg = $bgcolor2;
            $i++;
        }
        else
        {
            $bg = $bgcolor1;
            $i = 0;
        }

    echo "<tr>\n"
    . "<td style=\"width: 30%;\">&nbsp;<a href=\"index.php?file=Page&amp;name=" . $titre . "\" onclick=\"window.open(this.href); return false;\">" . $titre . "</a></td>\n"
    . "<td style=\"width: 30%;\"align=\"center\">" . $pagename . "</td>\n"
    . "<td style=\"width: 10%;text-align: center;\">" . $type . "</td>\n"
    . "<td style=\"width: 15%;text-align: center;\"><a href=\"index.php?file=Page&amp;page=admin&amp;op=edit&amp;page_id=" . $page_id . "\"><img style=\"border: 0;\" src=\"images/edit.gif\" alt=\"\" title=\"" . _EDITTHISPAGE . "\" /></a></td>\n"
    . "<td style=\"width: 15%;text-align: center;\"><a href=\"javascript:del_page('" . addslashes($titre) . "','" . $page_id . "');\"><img style=\"border: 0;\" src=\"images/del.gif\" alt=\"\" title=\"" . _DELTHISPAGE . "\" /></a></td></tr>\n";
}

if ($nb_page == 0) echo"<tr><td colspan=\"5\" align=\"center\">" . _NOPAGE . "</td></tr>\n";

echo "</table><br /><div style=\"text-align: center;\"><a class=\"buttonLink\" href=\"index.php?file=Admin\">" . __('BACK') . "</a></div><br /></div></div>";
}

function add()
{
    global $language;

        echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
    . "<div class=\"content-box-header\"><h3>Ajouter une Page</h3>\n"
    . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Page.html\" rel=\"modal\">\n"
    . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
    . "</div></div>\n"
    . "<div class=\"tab-content\" id=\"tab2\">\n";

    nkAdminMenu(2);

    echo "<form method=\"post\" action=\"index.php?file=Page&amp;page=admin&amp;op=do_add\" enctype=\"multipart/form-data\">\n"
    . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">\n"
    . "<tr><td><b>" . _PAGENAME . " : </b> <input type=\"text\" name=\"titre\" maxlength=\"50\" size=\"30\" /><span style=\"margin-left:30px;\"><b>" . _SHOWTITLE . " :</b>\n";

    checkboxButton('show_title', 'show_title', 0, false);

    echo "</span></td></tr>\n"
    . "<tr><td style=\"vertical-align:middle\"><b>" . _PAGETYPE . " :</b>\n"
    . "<select name=\"type\" onchange=\"checkType(this.options[this.selectedIndex].value, 'add');\"><option value=\"html\">HTML</option><option value=\"php\">PHP</option></select></td></tr>"
    . "<tr><td>&nbsp;</td></tr>\n"
    . "<tr><td style=\"vertical-align:middle\">\n";

    printNotification(_NOTIFIPAGELEVEL, 'warning');

    echo "<b>" . _PAGELEVEL ." :</b> <select name=\"niveau\">\n"
    . "<option>0</option>\n"
    . "<option>1</option>\n"
    . "<option>2</option>\n"
    . "<option>3</option>\n"
    . "<option>4</option>\n"
    . "<option>5</option>\n"
    . "<option>6</option>\n"
    . "<option>7</option>\n"
    . "<option>8</option>\n"
    . "<option>9</option></select>\n"
    . "<span style=\"margin-left:30px;\"><b>" . _MEMBERSAUTORIZ ." :</b> <select style=\"vertical-align:middle\" multiple=\"multiple\" name=\"members[]\">\n";

    $sql_list = nkDB_execute("SELECT id, pseudo FROM " . USER_TABLE . " ORDER BY pseudo");

    while(list($mid, $pseudo) = nkDB_fetchArray($sql_list))
    {
        echo '<option value="' . $mid . '">' . $pseudo . '</option>\n';
    }
    echo "</select></span></td></tr>\n"
    . "<tr><td>&nbsp;</td></tr>\n"
    . "<tr><td><big><b>" . _CONTENT . " :</b></big></td></tr>\n"
    . "<tr><td align=\"center\"><textarea class=\"editor\" id=\"contents\" name=\"content\" cols=\"85\" rows=\"20\"></textarea></td></tr>\n"
    . "<tr><td>&nbsp;</td></tr>\n"
    . "<tr><td><b>"._PAGEFILE." :</b> <select name=\"url\"><option value=\"\">". _NOFILE ."</option>\n";

    $options = '';
    $rep = scandir('modules/Page/html');
    $rep = array_diff($rep, array('.', '..'));
    sort($rep);

    foreach ($rep as $filename) {
        $extension = strtolower(substr(strrchr($filename, '.'), 1));

        if ($extension == 'html')
            $options .= '<option value="'. $filename .'">&nbsp;&nbsp;&nbsp;'. $filename .'</option>' ."\n";
    }

    if ($options !='')
        echo '<optgroup label="* HTML">'. $options .'</optgroup>';

    $options = '';
    $rep = scandir('modules/Page/php');
    $rep = array_diff($rep, array('.', '..', 'index.html'));
    sort($rep);

    foreach ($rep as $filename) {
        $extension = strtolower(substr(strrchr($filename, '.'), 1));

        if ($extension == 'html')
            $options .= '<option value="'. $filename .'">&nbsp;&nbsp;&nbsp;'. $filename .'</option>' ."\n";
    }

    if ($options !='')
        echo '<optgroup label="* PHP">'. $options .'</optgroup>';

    echo "</select></td></tr>\n"
    . "<tr><td><b>" . _UPLOADPAGE . " : </b><input type=\"file\" size=\"40\" name=\"pagefile\" /></td></tr>\n"
    . "<tr><td>&nbsp;</td></tr>\n"
    . "<tr><td><b>" . _ADDMENU . " :</b> <select name=\"menu\"><option value=\"\">". _NOFILE ."</option>\n";

    $sql_menu = nkDB_execute("SELECT  bid, titre FROM " . BLOCK_TABLE . " WHERE type = 'menu'");
    while (list($bid, $menu) = nkDB_fetchArray($sql_menu))
    {
        echo "<option value=\"" . $bid . "\">" . $menu . "</option>\n";
    }

    echo "</select></td></tr>";
    echo "<tr><td>&nbsp;</td></tr>\n"
    . "</table>\n"
    . "<div style=\"text-align: center;\"><br /><input class=\"button\" type=\"submit\" value=\"" . _ADDTHISPAGE . "\" /><a class=\"buttonLink\" href=\"index.php?file=Page&amp;page=admin\">".__('BACK')."</a></div></form><br /></div></div>\n";
}

function do_add($titre, $type, $niveau, $content, $menu)
{
    global $nuked;

    require_once 'Includes/nkUpload.php';

    $userslist = '';

    if (isset($_REQUEST['members']) AND is_array($_REQUEST['members']) && $_REQUEST['members'])
        $userslist = implode('|', $_REQUEST['members']);

    // $temp_page = trim(@fread(@fopen($_FILES['pagefile']['tmp_name'], 'r'), $_FILES['pagefile']['size']));

    //Upload du fichier
    $pageUrl = '';

    if ($_FILES['pagefile']['name'] != '' && in_array($type, array('html', 'php'))) {
        $pageCfg = array(
            'uploadDir'             => 'modules/Page/'. $type,
            'strtolowerFilename'    => true,
            'allowedExtension'      => array($type),
            'renameExtension'       => array(
                'htm' => 'html'
            )
        );

        list($pageUrl, $uploadError, $pageExt) = nkUpload_check('pagefile', $pageCfg);

        if ($uploadError !== false) {
            printNotification($uploadError, 'error');
            redirect('index.php?file=Page&page=admin&op=add', 5);
            return;
        }
    }
    else if ($_POST['url'] != '') {
        $ext = strtolower(substr(strrchr($_POST['url'], '.'), 1));

        if ($ext != $type) {
            //printNotification(__('BAD_FILE_FORMAT'), 'error');
            redirect('index.php?file=Page&page=admin&op=add', 5);
            return;
        }

        $pageUrl = $_POST['url'];
    }

    $content = html_entity_decode($content);
    $content = nkDB_realEscapeString(stripslashes($content));
    $a1 = "�����������������������������������������������������";
    $b1 = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
    $title = str_replace(" ", "_", $titre);
    $title = str_replace("'", "_", $title);
    $title = str_replace("\"", "_", $title);
    $title = strtr($title, $a1, $b1);

    if (isset($_REQUEST['show_title']) && $_REQUEST['show_title'] == 'on')
        $show_title = 1;
    else
        $show_title = 0;

    $sql = nkDB_execute("INSERT INTO " . PAGE_TABLE . " ( `id` , `niveau` , `titre` , `content` , `url` , `type` , `show_title` , `members` ) VALUES ( '', '" . $niveau . "' , '" . $title . "' , '" . $content . "' , '" . $pageUrl . "' , '" . $type . "' , '" . $show_title . "' , '" . $userslist . "' )");

    if ($menu != "")
    {
        $sql_menu = nkDB_execute("SELECT content FROM " . BLOCK_TABLE . " WHERE bid = '" . $menu . "'");
        list($content) = nkDB_fetchArray($sql_menu);
        $content = stripslashes($content);
        $url_page = "index.php?file=Page&name=" . $title;

        $link = explode('NEWLINE', $content);
        $new_line = $url_page . "|" . $title . "||||";
        $count = count($link);
        $link[$count] = $new_line;

        $content = implode('NEWLINE', $link);
        $content = addslashes($content);
        $sql = nkDB_execute("UPDATE " . BLOCK_TABLE . " SET content = '" . $content . "' WHERE bid = '" . $menu . "'");

        $url_redirect = "index.php?file=Admin&page=menu&op=edit_line&bid=" . $menu . "&lid=" . $count;
    }
    else
    {
        $url_redirect = "index.php?file=Page&page=admin";
    }

    printNotification(_PAGEADD, 'success');
    redirect($url_redirect, 2);
}

function edit($page_id)
{
    global $nuked, $language;

    $sql = nkDB_execute("SELECT niveau, titre, content, url, type, show_title, members FROM " . PAGE_TABLE . " WHERE id = '" . $page_id . "'");
    list($niveau, $titre, $content, $url, $type, $show_title, $members) = nkDB_fetchArray($sql);
    $content = stripslashes($content);

    if ($type == "html") $selected1 = "selected=\"selected\"";
    else $selected1 = "";

    if ($type == "php") $selected2 = "selected=\"selected\"";
    else $selected2 = "";

    if ($show_title == 1)
        $checked_show = true;
    else
        $checked_show = false;

        echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
    . "<div class=\"content-box-header\"><h3>Editer une Page</h3>\n"
    . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Page.html\" rel=\"modal\">\n"
    . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
    . "</div></div>\n"
    . "<div class=\"tab-content\" id=\"tab2\"><div style=\"text-align: center;\">\n"
    . "<form method=\"post\" action=\"index.php?file=Page&amp;page=admin&amp;op=do_edit\" enctype=\"multipart/form-data\">\n"
    . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">\n"
    . "<tr><td><b>" . _PAGENAME . " : </b> <input type=\"text\" name=\"titre\" maxlength=\"50\" size=\"30\" value=\"" . $titre . "\" /><span style=\"margin-left:30px;\"><b>" . _SHOWTITLE . " :</b>\n";

    checkboxButton('show_title', 'show_title', $checked_show, false);

    echo "</span></td></tr>\n"
    . "<tr><td style=\"vertical-align:middle\"><b>" . _PAGETYPE . " :</b>\n"
    . "<select name=\"type\" onchange=\"checkType(this.options[this.selectedIndex].value, 'edit', " . $page_id . ");\"><option value=\"html\" " . $selected1 . ">HTML</option><option value=\"php\" " . $selected2 . ">PHP</option></select>&nbsp;</td></tr>"
    . "<tr><td>&nbsp;</td></tr>\n"
    . "<tr><td style=\"vertical-align:middle\">\n";

    printNotification(_NOTIFIPAGELEVEL, 'warning');

    echo "<b>" . _PAGELEVEL ." :</b> <select name=\"niveau\"><option>" . $niveau . "</option>\n"
    . "<option>0</option>\n"
    . "<option>1</option>\n"
    . "<option>2</option>\n"
    . "<option>3</option>\n"
    . "<option>4</option>\n"
    . "<option>5</option>\n"
    . "<option>6</option>\n"
    . "<option>7</option>\n"
    . "<option>8</option>\n"
    . "<option>9</option></select>\n"
    . "<span style=\"margin-left:30px;\"><b>" . _MEMBERSAUTORIZ ." :</b> <select style=\"vertical-align:middle\" multiple=\"multiple\" name=\"members[]\">\n";

    $user_array = explode('|', $members);

    $sql_list = nkDB_execute("SELECT id, pseudo FROM " . USER_TABLE . " ORDER BY pseudo");
    while(list($mid, $pseudo) = nkDB_fetchArray($sql_list))
    {
        $sel = (in_array($mid, $user_array)) ? 'selected="selected"' : '';
        echo '<option value="' . $mid . '" ' . $sel . '>' . $pseudo . '</option>\n';
    }
    echo "</select></span></td></tr>\n"
    . "<tr><td>&nbsp;</td></tr>\n"
    . "<tr><td><big><b>" . _CONTENT . " :</b></big></td></tr>\n"
    . "<tr><td align=\"center\"><textarea class=\"editor\" id=\"contents\" name=\"content\" cols=\"85\" rows=\"20\">" . $content . "</textarea></td></tr>\n"
    . "<tr><td>&nbsp;</td></tr>\n"
    . "<tr><td><b>"._PAGEFILE." :</b> <select name=\"url\"><option value=\"\">". _NOFILE ."</option><option value=\"\">* HTML</option>\n";

    $options = '';
    $rep = scandir('modules/Page/html');
    $rep = array_diff($rep, array('.', '..'));
    sort($rep);

    foreach ($rep as $filename) {
        $extension = strtolower(substr(strrchr($filename, '.'), 1));

        if ($extension == 'html') {
            if ($filename == $url)
                $selected = ' selected="selected"';
            else
                $selected = '';

            $options .= '<option value="'. $filename .'"'. $selected .'>&nbsp;&nbsp;&nbsp;'. $filename .'</option>' ."\n";
        }
    }

    if ($options !='')
        echo '<optgroup label="* HTML">'. $options .'</optgroup>';

    $options = '';
    $rep = scandir('modules/Page/php');
    $rep = array_diff($rep, array('.', '..', 'index.html'));
    sort($rep);

    foreach ($rep as $filename) {
        $extension = strtolower(substr(strrchr($filename, '.'), 1));

        if ($extension == 'html') {
            if ($filename == $url)
                $selected = ' selected="selected"';
            else
                $selected = '';

            $options .= '<option value="'. $filename .'"'. $selected .'>&nbsp;&nbsp;&nbsp;'. $filename .'</option>' ."\n";
        }
    }

    if ($options !='')
        echo '<optgroup label="* PHP">'. $options .'</optgroup>';

    echo "</select></td></tr>\n"
    . "<tr><td><b>" . _UPLOADPAGE . " : </b><input type=\"file\" size=\"40\" name=\"pagefile\" /></td></tr>\n"
    . "<tr><td>&nbsp;</td></tr>\n"
    . "<tr><td><b>" . _ADDMENU . " :</b> <select name=\"menu\"><option value=\"\">". _NOFILE ."</option>\n";

    $sql_menu = nkDB_execute("SELECT  bid, titre FROM " . BLOCK_TABLE . " WHERE type = 'menu'");
    while (list($bid, $menu) = nkDB_fetchArray($sql_menu))
    {
        echo "<option value=\"" . $bid . "\">" . $menu . "</option>\n";
    }

    echo "</select></td></tr>\n"
    . "<tr><td>&nbsp;<input type=\"hidden\" name=\"page_id\" value=\"" . $page_id . "\" /></td></tr>\n"
    . "</table>\n"
    . "<div style=\"text-align: center;\"><br /><input class=\"button\" type=\"submit\" value=\"" . _MODIFTHISPAGE . "\" /><a class=\"buttonLink\" href=\"index.php?file=Page&amp;page=admin\">".__('BACK')."</a></div></form><br /></div></div>\n";
}

function do_edit($page_id, $titre, $type, $niveau, $content, $menu)
{
    global $nuked;

    require_once 'Includes/nkUpload.php';

    $userslist = '';

    if (isset($_REQUEST['members']) AND is_array($_REQUEST['members']) && $_REQUEST['members'])
        $userslist = implode('|', $_REQUEST['members']);

    // $temp_page = trim(@fread(@fopen($_FILES['pagefile']['tmp_name'], 'r'), $_FILES['pagefile']['size']));

    //Upload du fichier
    $pageUrl = '';

    if ($_FILES['pagefile']['name'] != '' && in_array($type, array('html', 'php'))) {
        $pageCfg = array(
            'uploadDir'             => 'modules/Page/'. $type,
            'strtolowerFilename'    => true,
            'allowedExtension'      => array($type),
            'renameExtension'       => array(
                'htm' => 'html'
            )
        );

        list($pageUrl, $uploadError, $pageExt) = nkUpload_check('pagefile', $pageCfg);

        if ($uploadError !== false) {
            printNotification($uploadError, 'error');
            redirect('index.php?file=Page&amp;page=admin&op=edit&page_id='. $page_id, 5);
            return;
        }
    }
    else if ($_POST['url'] != '') {
        $ext = strtolower(substr(strrchr($_POST['url'], '.'), 1));

        if ($ext != $type) {
            //printNotification(__('BAD_FILE_FORMAT'), 'error');
            redirect('index.php?file=Page&amp;page=admin&op=edit&page_id='. $page_id, 5);
            return;
        }

        $pageUrl = $_POST['url'];
    }

    $content = html_entity_decode($content);
    $content = nkDB_realEscapeString(stripslashes($content));
    $a1 = "�����������������������������������������������������";
    $b1 = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
    $title = str_replace(" ", "_", $titre);
    $title = str_replace("'", "_", $title);
    $title = str_replace("\"", "_", $title);
    $title = strtr($title, $a1, $b1);

    if (isset($_REQUEST['show_title']) && $_REQUEST['show_title'] == 'on')
        $show_title = 1;
    else
        $show_title = 0;

    $upd = nkDB_execute("UPDATE " . PAGE_TABLE . " SET titre = '" . $title . "', content = '" . $content . "', url = '" . $pageUrl . "', niveau = '" . $niveau . "', type = '" . $type . "', show_title = '" . $show_title . "', members = '" . $userslist . "' WHERE id = '" . $page_id . "'");

    if ($menu != "")
    {
        $sql_menu = nkDB_execute("SELECT content FROM " . BLOCK_TABLE . " WHERE bid = '" . $menu . "'");
        list($content) = nkDB_fetchArray($sql_menu);
        $content = stripslashes($content);
        $url_page = "index.php?file=Page&name=" . $title;

        $link = explode('NEWLINE', $content);
        $new_line = $url_page . "|" . $title . "||||";
        $count = count($link);
        $link[$count] = $new_line;

        $content = implode('NEWLINE', $link);
        $content = addslashes($content);
        $sql = nkDB_execute("UPDATE " . BLOCK_TABLE . " SET content = '" . $content . "' WHERE bid = '" . $menu . "'");

        $url_redirect = "index.php?file=Admin&page=menu&op=edit_line&bid=" . $menu . "&lid=" . $count;
    }
    else
    {
        $url_redirect = "index.php?file=Page&page=admin";
    }

    printNotification(_PAGEMODIF, 'success');
    redirect($url_redirect, 2);
}

function del($page_id)
{
    global  $nuked;

    $del = nkDB_execute("DELETE FROM " . PAGE_TABLE . " WHERE id = '" . $page_id . "'");

    printNotification(_PAGEDELETE, 'success');
    redirect("index.php?file=Page&page=admin",2);
}

function main_pref()
{
    global $nuked, $language;

        echo "<div class=\"content-box\">\n" //<!-- Start Content Box -->
    . "<div class=\"content-box-header\"><h3>Gestion des Pr�f�rences</h3>\n"
    . "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/Page.html\" rel=\"modal\">\n"
    . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a>\n"
    . "</div></div>\n"
    . "<div class=\"tab-content\" id=\"tab2\">\n";

    nkAdminMenu(3);

    echo "<form method=\"post\" action=\"index.php?file=Page&amp;page=admin&amp;op=change_pref\">\n"
    . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">\n"
    . "<tr><td align=\"center\" colspan=\"2\"><big>" . _PREFS . "</big></td></tr>\n"
    . "<tr><td>" . _PAGEINDEX . " :</td><td><select name=\"index_page\"><option value=\"\">" . _NONE_PAGE . "</option>\n";

    $sql = nkDB_execute("SELECT titre FROM " . PAGE_TABLE . " ORDER BY titre");
    while (list($titre) = nkDB_fetchArray($sql))
    {
        if ($titre == $nuked['index_page']) $selected = "selected=\"selected\"";
        else $selected = "";

        echo "<option value=\"" . $titre . "\" " . $selected . ">" . $titre . "</option>\n";
    }

    echo "</select></td></tr></table>\n"
    . "<div style=\"text-align: center;\"><br /><input class=\"button\" type=\"submit\" value=\"" . __('SEND') . "\" /><a class=\"buttonLink\" href=\"index.php?file=Page&amp;page=admin\">" . __('BACK') . "</a></div>\n"
    . "</form><br /></div></div>\n";
}

function change_pref($index_page)
{
    global $nuked;

    $upd = nkDB_execute("UPDATE " . CONFIG_TABLE . " SET value = '" . $index_page . "' WHERE name = 'index_page'");

    printNotification(_PREFUPDATED, 'success');
    redirect("index.php?file=Page&page=admin", 2);
}

function nkAdminMenu($tab = 1) {
    global $language, $user, $nuked;

    $class = ' class="nkClassActive" ';
?>
    <div class= "nkAdminMenu">
        <ul class="shortcut-buttons-set" id="1">
            <li <?php echo ($tab == 1 ? $class : ''); ?>>
                <a class="shortcut-button" href="index.php?file=Page&amp;page=admin">
                    <img src="modules/Admin/images/icons/speedometer.png" alt="icon" />
                    <span><?php echo _PAGE; ?></span>
                </a>
            </li>
            <li <?php echo ($tab == 2 ? $class : ''); ?>>
                <a class="shortcut-button" href="index.php?file=Page&amp;page=admin&amp;op=add">
                    <img src="modules/Admin/images/icons/add_page.png" alt="icon" />
                    <span><?php echo _ADDPAGE; ?></span>
                </a>
            </li>
            <li <?php echo ($tab == 3 ? $class : ''); ?>>
                <a class="shortcut-button" href="index.php?file=Page&amp;page=admin&amp;op=main_pref">
                    <img src="modules/Admin/images/icons/process.png" alt="icon" />
                    <span><?php echo _PREFS; ?></span>
                </a>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
<?php
}


?>
<script type="text/javascript">
function checkType( type, action, id )
{
    var ids = document.getElementById('contents');
    var spa = document.getElementById('cke_contents');

    if ( type == 'html' ) {
        if ( action == 'add' )
        {
            window.location.href=('index.php?file=Page&page=admin&op=add');
        }
        else
        {
            window.location.href=('index.php?file=Page&page=admin&op=edit&page_id=' + id);
        }
    }
    else {
        ids.className  = 'noeditor';
        ids.style.display  = 'block';
        spa.parentNode.removeChild( spa );
    }
}
</script>

<?php

switch($GLOBALS['op']) {
    case "add":
    add();
    break;

    case "del":
    del($_REQUEST['page_id']);
    break;

    case "do_edit":
    do_edit($_REQUEST['page_id'], $_REQUEST['titre'], $_REQUEST['type'], $_REQUEST['niveau'], $_REQUEST['content'], $_REQUEST['menu']);
    break;

    case "edit":
    edit($_REQUEST['page_id']);
    break;

    case "do_add":
    do_add($_REQUEST['titre'], $_REQUEST['type'], $_REQUEST['niveau'], $_REQUEST['content'], $_REQUEST['menu']);
    break;

    case "main_pref":
    main_pref();
    break;

    case "change_pref":
    change_pref($_REQUEST['index_page']);
    break;

    default:
        main();
    break;
}

?>
