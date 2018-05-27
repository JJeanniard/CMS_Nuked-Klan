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
    global $page, $nuked, $user;

    if (is_array($content)) {
        $titre = "<strong>" . _VALIDNEWS . "</strong>";
        $action = "index.php?file=Suggest&amp;page=admin&amp;op=valid_suggest&amp;module=News";
        $autor = $content[2];
        $autor_id = $content[3];
        $date = $content[4];

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
        $titre = "<a href=\"index.php?file=News\" style=\"text-decoration:none\"><strong>" . _NEWS . "</strong></a> &gt; <strong>" . _SUG . "</strong>";
        $action = "index.php?file=Suggest&amp;op=add_sug&amp;module=News";

        if ($user) {
            $autor = $user[2];
            $autor_id = $user[0];
        }
        else
            $autor = $autor_id = '';

        $date = time();
        $refuse = "</div></form><br />\n";
    }

    echo "<br /><div style=\"text-align: center;\">" . $titre . "</div><br />\n"
            . "<form method=\"post\" action=\"" . $action . "\">\n"
            . "<table style=\"margin: auto; text-align: left;\" cellspacing=\"0\" cellpadding=\"2\"border=\"0\">\n"
            . "<tr><td><b>" . _TITLE . " :</b> <input type=\"text\" name=\"titre\" maxlength=\"100\" size=\"45\" value=\"" . $content[0] . "\" /></td></tr>\n"
            . "<tr><td><b>" . _SUBJECT . " :</b> <select name=\"cat\">\n";

    $sql = nkDB_execute("SELECT nid, titre FROM " . NEWS_CAT_TABLE . " ORDER BY titre");
    while (list($nid, $cat_name) = nkDB_fetchArray($sql)){
        $cat_name = printSecuTags($cat_name);
        $selected = "";

        if ($content && $cat_name == $content[5]) $selected = "selected=\"selected\"";

        echo "<option value=\"" . $nid . "\" " . $selected . ">" . $cat_name . "</option>\n";
    }

    echo "</select></td></tr>\n"
            . "<tr><td><b>" . _TEXT . " :</b></td></tr>\n"
            . "<tr><td><textarea ";

    echo $page == 'admin' ? 'class="editor" ' : 'id="e_advanced" ';

    echo " name=\"texte\" cols=\"65\" rows=\"12\">" . $content[1] . "</textarea></td></tr>\n"
        . "<tr><td>&nbsp;\n";

    if (initCaptcha()) echo create_captcha();

    echo "<input type=\"hidden\" name=\"sug_id\" value=\"" . $sug_id . "\" />\n"
        . "<input type=\"hidden\" name=\"auteur\" value=\"" . $autor . "\" />\n"
        . "<input type=\"hidden\" name=\"auteur_id\" value=\"" . $autor_id . "\" />\n"
        . "<input type=\"hidden\" name=\"date\" value=\"" . $date . "\" /></td></tr>\n"
        . "</table><div style=\"text-align: center;\"><br /><input style=\"margin-right:10px\" class=\"button\" type=\"submit\" value=\"" . __('SEND') . "\" />" . $refuse;
}

function make_array($data){
    $data['titre'] = printSecuTags($data['titre']);
    $data['auteur'] = nkHtmlEntities($data['auteur']);
    $data['auteur_id'] = nkHtmlEntities($data['auteur_id']);
    $data['date'] = nkHtmlEntities($data['date']);
    $data['cat'] = printSecuTags($data['cat']);

    $data['titre'] = str_replace("|", "&#124;", $data['titre']);
    $data['texte'] = str_replace("|", "&#124;", $data['texte']);

    $content = $data['titre'] . "|" . $data['texte'] . "|" . $data['auteur'] . "|" . $data['auteur_id'] . "|" . $data['date'] . "|" . $data['cat'];
    return $content;
}

function send($data){
    global $nuked;

    if ($data['auteur'] != ""){
        $autor = $data['auteur'];
    }
    else{
        $autor = $user[2];
    }

    if ($data['auteur_id'] != ""){
        $autor_id = $data['auteur_id'];
    }
    else{
        $autor_id = $user[0];
    }

    $data['texte'] = nkHtmlEntityDecode($data['texte']);
    $data['titre'] = nkDB_realEscapeString(stripslashes($data['titre']));
    $data['texte'] = nkDB_realEscapeString(stripslashes($data['texte']));

    $add = nkDB_execute("INSERT INTO " . NEWS_TABLE . " ( `id` , `cat` , `titre` , `auteur` , `auteur_id` , `texte` , `suite` , `date`) VALUES ( '' , '" . $data['cat'] . "' , '" . $data['titre'] . "' , '" . $autor . "' , '" . $autor_id . "' , '" . $data['texte'] . "' , '' , '" . $data['date'] . "')");
    $sqls = nkDB_execute("SELECT id FROM " . NEWS_TABLE . " WHERE titre = '" . $data['titre'] . "' AND date = '".$data['date']."'");
    list($news_id) = nkDB_fetchArray($sqls);

    setPreview('index.php?file=News&op=suite&news_id='. $news_id, 'index.php?file=Suggest&page=admin');
}
?>
