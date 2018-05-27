<?php
/**
 * @version     1.8
 * @link https://nuked-klan.fr Clan Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
if (!defined("INDEX_CHECK")){
    exit('You can\'t run this file alone.');
}

function form($content, $sug_id){
    global $page, $op, $nuked, $user, $language;

    translate("modules/Links/lang/" . $language . ".lang.php");

    if (is_array($content)) {
        $titre = "<strong>" . _VALIDLINK . "</strong>";
        $action = "index.php?file=Suggest&amp;page=admin&amp;op=valid_suggest&amp;module=Links";
        $pays = $content[5];

        echo "<script type=\"text/javascript\">\n"
                . "<!--\n"
                . "\n"
                . "function del_sug(id)\n"
                . "{\n"
                . "if (confirm('" . _DELETESUG . " '+id+' ! " . _CONFIRM . "'))\n"
                . "{document.location.href = 'index.php?file=Suggest&page=admin&op=raison&sug_id='+id;}\n"
                . "}\n"
                . "\n"
                . "// -->\n"
                . "</script>\n";

                $refuse = "&nbsp;<input class=\"button\" type=\"button\" value=\"" . _REMOVE . "\" onclick=\"javascript:del_sug('" . $sug_id . "');\" />\n"
                            . "<a class=\"buttonLink\" href=\"index.php?file=Suggest&amp;page=admin\">" . __('BACK') . "</a></div></form><br />\n";
    }
    else{
        $titre = "<strong> " . _WEBLINKS . " </strong></div>\n"
                    . "<div style=\"text-align: center;\"><br />\n"
                    . "[ <a href=\"index.php?file=Links\" style=\"text-decoration: underline\">" . _INDEXLINKS . "</a> | "
                    . "<a href=\"index.php?file=Links&amp;op=classe&amp;orderby=news\" style=\"text-decoration: underline\">" . _NEWSLINK . "</a> | "
                    . "<a href=\"index.php?file=Links&amp;op=classe&amp;orderby=count\" style=\"text-decoration: underline\">" . _TOPLINKS . "</a> | "
                    . _SUGGESTLINK . " ]";

        $action = "index.php?file=Suggest&amp;op=add_sug&amp;module=Links";
        $refuse = "</div></form><br />\n";

        if ($language == "french"){
            $pays = "France.gif";
        }
        else{
            $pays = "";
        }
    }

    echo "<br /><div style=\"text-align: center;\">" . $titre . "</div><br />\n"
            . "<form method=\"post\" action=\"" . $action . "\">\n"
            . "<table style=\"margin: auto; text-align: left;\" cellspacing=\"0\" cellpadding=\"2\"border=\"0\">\n"
            . "<tr><td><b>" . _TITLE . " :</b> <input type=\"text\" name=\"titre\" value=\"" . $content[0] . "\" size=\"40\" /></td></tr>\n"
            . "<tr><td><b>" . _CAT . " :</b> <select name=\"cat\"><option value=\"0\">* " . _NONE . "</option>\n";

    $sql = nkDB_execute("SELECT cid, titre FROM " . LINKS_CAT_TABLE . " WHERE parentid = 0 ORDER BY position, titre");
    while (list($cid, $titre) = nkDB_fetchArray($sql)){
        $titre = printSecuTags($titre);

        if ($content && $cid == $content[3]){
            $selected = "selected=\"selected\"";

        }
        else $selected = "";

        echo "<option value=\"" . $cid . "\" " . $selected . ">* " . $titre . "</option>\n";

        $sql2 = nkDB_execute("SELECT cid, titre FROM " . LINKS_CAT_TABLE . " WHERE parentid = '" . $cid . "' ORDER BY position, titre");
        while (list($s_cid, $s_titre) = nkDB_fetchArray($sql2)){
            $s_titre = printSecuTags($s_titre);

            if ($content){
                if ($s_cid == $content[3]) $selected1 = "selected=\"selected\"";
                else $selected1 = "";
            }

            echo "<option value=\"" . $s_cid . "\" " . $selected1 . ">&nbsp;&nbsp;&nbsp;" . $s_titre . "</option>\n";
        }
    }

    echo "</select></td></tr><tr><td><b>" . _COUNTRY . " :</b> <select name=\"country\"><option value=\"\">* " . _NOCOUNTRY . "</option>\n";

    $rep = @opendir("images/flags");
    while ($f = readdir($rep)){
        if ($f != ".." && $f != "." && $f != "Thumbs.db"){
            if ($f == $pays){
                $checked = "selected=\"selected\"";
            }
            else {
                $checked = "";
            }

            list ($country, $ext) = explode ('.', $f);
            echo "<option value=\"" . $f . "\" " . $checked . ">" . $country . "</option>\n";
        }
    }
    closedir($rep);
    clearstatcache();

    echo "</select></td></tr>\n";

    $button = '';

    if($op == "show_suggest" && $content[1] != ""){$button = "<input type=\"button\" name=\"bscreen\" value=\"" . _VIEW . "\" Onclick=\"window.open('$content[1]');\" /></input>";}

    echo "<tr><td><b>" . _DESCR . " : </b></td></tr>\n"
            . "<tr><td><textarea ";

    echo $page == 'admin' ? 'class="editor" ' : 'id="e_advanced" ';

    echo " name=\"description\" rows=\"10\" cols=\"65\">" . $content[2] . "</textarea></td></tr>\n"
        . "<tr><td><b>" . _URL . " :</b> <input type=\"text\" name=\"url\" value=\"" . $content[1] . "\" size=\"55\" /> " . $button . "</td></tr>\n"
        . "<tr><td><b>" . _WEBMASTER . " :</b>  <input type=\"text\" name=\"webmaster\" value=\"" . $content[4] . "\" size=\"30\" /></td></tr>\n"
        . "<tr><td>&nbsp;\n";

    if (initCaptcha()) echo create_captcha();

    echo "<input type=\"hidden\" name=\"sug_id\" value=\"" . $sug_id . "\" /></td></tr>\n"
        . "</table><div style=\"text-align: center;\"><br /><input style=\"margin-right:10px\" class=\"button\" type=\"submit\" value=\"" . __('SEND') . "\" />" . $refuse;
}

function make_array($data){
    $data['titre'] = printSecuTags($data['titre']);
    $data['url'] = nkHtmlEntities($data['url']);
    $data['cat'] = printSecuTags($data['cat']);
    $data['webmaster'] = nkHtmlEntities($data['webmaster']);
    $data['country'] = nkHtmlEntities($data['country']);

    $data['titre'] = str_replace("|", "&#124;", $data['titre']);
    $data['description'] = str_replace("|", "&#124;", $data['description']);
    $data['webmaster'] = str_replace("|", "&#124;", $data['webmaster']);

    $content = $data['titre'] . "|" . $data['url'] . "|" . $data['description'] . "|" . $data['cat'] . "|" . $data['webmaster'] . "|" . $data['country'];
    return $content;
}

function send($data){
    global $nuked;

    $date = time();
    $data['description'] = nkHtmlEntityDecode($data['description']);
    $data['titre'] = nkDB_realEscapeString(stripslashes($data['titre']));
    $data['description'] = nkDB_realEscapeString(stripslashes($data['description']));
    $data['webmaster'] = nkDB_realEscapeString(stripslashes($data['webmaster']));

    $upd = nkDB_execute("INSERT INTO " . LINKS_TABLE . " ( `id` , `date` , `titre` , `description` , `url` , `cat` , `webmaster`, `country`, `count` ) VALUES ( '' , '" . $date . "' , '" . $data['titre'] . "' , '" . $data['description'] . "' , '" . $data['url'] . "' , '" . $data['cat'] . "' , '" . $data['webmaster'] . "' , ' " . $data['country'] . "' , '' )");
    $sql = nkDB_execute("SELECT id FROM " . LINKS_TABLE . " WHERE titre = '" . $data['titre'] . "' AND date='".$date."'");
    list($link_id) = nkDB_fetchArray($sql);

    setPreview('index.php?file=Links&op=description&link_id='. $link_id, 'index.php?file=Suggest&page=admin');
}
?>
