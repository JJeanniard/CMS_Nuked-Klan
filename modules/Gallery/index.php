<?php
/**
 * index.php
 *
 * Frontend of Gallery module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! moduleInit('Gallery'))
    return;

compteur('Gallery');

include 'modules/Gallery/config.php';


function cat($cat)
{
    global $nuked, $bgcolor1, $bgcolor2, $bgcolor3, $img_cat, $img_none, $image_resize, $image_gd, $rep_img, $rep_img_gd, $img_screen1;

    $counter = 0;
    $last_catid = null;

    $sql = nkDB_execute('SELECT cid, titre, description FROM ' . GALLERY_CAT_TABLE . ' WHERE parentid = ' . $cat);
    $nb_subcat = nkDB_numRows($sql);

    if ($nb_subcat > 0)
    {
        echo "<table width=\"100%\" cellspacing=\"5\" cellpadding=\"0\" border=\"0\">\n";

        $sql = nkDB_execute("SELECT cid, titre, description FROM " . GALLERY_CAT_TABLE . " WHERE parentid = '" . $cat . "' ORDER BY position, titre");
        while (list($catid, $parentcat, $parentdesc) = nkDB_fetchArray($sql))
        {

            $parentcat = printSecuTags($parentcat);

            $parentdesc = icon($parentdesc);

            $sql_img = nkDB_execute("SELECT sid, url, url2, date FROM " . GALLERY_TABLE . " WHERE cat = '" . $catid . "' ORDER BY sid DESC");
            $nb_imgcat = nkDB_numRows($sql_img);
            list($sid, $url, $url2, $date) = nkDB_fetchArray($sql_img);

            if ($url2 != "" && $url2 != "http://")
            {
                $image = $url2;
                $link_img = $url2;
            }
            else if ($url2 == "" && $image_gd == "on" && @extension_loaded('gd') && !preg_match("`http://`i", $url) && is_file($url))
            {
                $org = $rep_img;
                $dest = $rep_img_gd;
                $name = str_replace ($org,'',$url);

                require_once 'Includes/miniature.php';

                // instanciation de l'objet
                $thb = new thb;
                // appel du constructeur
                // nim de la source: image.jpeg
                // chemin source: ./ (dossier courant)
                // destianation: ./ (dossier courant)
                $thb->doImg($name, $org, $dest);
                // Config des parametres
                // prefix
                // taille du + grd cot�
                // qualit�
                $thb->SetParam('_tmb', $img_screen1, 90);
                // pour connaitre le nom et chemin de l'image r�duite
                // r�sultat: ./image_thb.jpeg
                $thumb = $thb->GetThbName();
                // pour connaitre le nom et chemin de l'image d'origine
                // r�sultat: ./image.jpeg
                $source = $thb->GetOrigine();
                // Lance le redimensionenemt
                $thb->doThb();
                if ($thumb) $sql_insert = nkDB_execute("UPDATE " . $nuked['prefix'] . "_gallery SET url2 = '" . $thumb . "' WHERE sid = '" . $sid . "'");
                $image = $thumb;
            }
            if (!$image) $image = $url;

            $name = strrchr($image, '/');
            $name = substr($name, 1);
            $name_enc = rawurlencode($name);
            $image = str_replace($name, $name_enc, $image);

            if ($date)
            {
                $date = nkDate($date);
                $last_date = _LASTADD . "&nbsp;" . $date;
            }
            else
            {
                $last_date = "";
            }

            if ($catid != $last_catid)
            {
                $counter++;

                if ($counter == 1)
                {
                    echo "<tr>";
                }

                echo "<td style=\"width: 50%;\" valign=\"top\">\n"
                . "<table style=\"background: " . $bgcolor1 . ";border: 1px solid " . $bgcolor3 . ";\" width=\"100%\" cellspacing=\"1\" cellpadding=\"5\" border=\"0\">\n"
                . "<tr><td colspan=\"2\"><a href=\"index.php?file=Gallery&amp;op=categorie&amp;cat=" . $catid . "\"><b>" . $parentcat . "</b></a></td></tr>\n"
                . "<tr><td style=\"width: 50px;background: " . $bgcolor2 . ";\" align=\"center\" valign=\"middle\">";

                if ($image != "")
                {
                        echo "<a href=\"index.php?file=Gallery&amp;op=categorie&amp;cat=" . $catid . "\">" . img_size($image, $img_cat, $parentcat, $image_resize) . "</a>";
                }
                else
                {
                    echo "<a href=\"index.php?file=Gallery&amp;op=categorie&amp;cat=" . $catid . "\">" . img_size($img_none, $img_cat, $parentcat, $image_resize) . "</a>";
                }

                echo "</td><td style=\"height: 100%;background: " . $bgcolor2 . ";\">\n"
                . "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";

                if ($parentdesc != "") echo "<tr><td>" . $parentdesc . "</td></tr>\n";

                echo "<tr><td>" . $nb_imgcat . "&nbsp;" . _SCREENINDB;

                if ($last_date != "") echo "<br />" . $last_date;

                echo "</td></tr></table></td></tr></table></td>\n";

                if ($counter == 2)
                {
                    $counter = 0;
                    echo "</tr>";
                }

                $last_catid = $catid;
            }
        }

        if ($counter == 1) echo "<td style=\"width: 50%;border: 1px solid " . $bgcolor3 . ";\">&nbsp;</td></tr>\n";

        echo "</table>\n";
    }
}

function categorie($cat)
{
    global $nuked;

    opentable();

    if ($nuked['gallery_title'] != "")
    {
        $title = $nuked['gallery_title'];
    }
    else
    {
        $title = _GALLERY;
    }

    $sql = nkDB_execute("SELECT titre, description, parentid FROM " . GALLERY_CAT_TABLE . " WHERE cid = '" . $cat . "'");

    if(nkDB_numRows($sql) <= 0)
        redirect("index.php?file=404");

    list($cat_titre, $cat_desc, $parentid) = nkDB_fetchArray($sql);

    $cat_titre = printSecuTags($cat_titre);
    $cat_desc = icon($cat_desc);

    if ($parentid > 0)
    {
        $sql_parent = nkDB_execute("SELECT titre FROM " . GALLERY_CAT_TABLE . " WHERE cid = '" . $parentid . "'");
        list($parent_titre) = nkDB_fetchArray($sql_parent);
        $parent_titre = printSecuTags($parent_titre);

        echo "<br /><div style=\"text-align: center;\"><a href=\"index.php?file=Gallery\" style=\"text-decoration:none\"><big><b>" . $title . "</b></big></a> &gt; <a href=\"index.php?file=Gallery&amp;op=categorie&amp;cat=" . $parentid . "\" style=\"text-decoration:none\"><big><b>" . $parent_titre . "</b></big></a> &gt; <big><b>" . $cat_titre . "</b></big></div><br />\n";
    }
    else
    {
        echo "<br /><div style=\"text-align: center;\"><a href=\"index.php?file=Gallery\" style=\"text-decoration:none\"><big><b>" . $title . "</b></big></a> &gt; <big><b>" . $cat_titre . "</b></big></div><br />\n";
    }

    if ($cat_desc != "")
    {
        echo "<div style=\"text-align: center;\">" . $cat_desc . "</div><br />\n";
    }

    cat($cat);
    classe($cat);

    closetable();
}

function description($sid)
{
    global $nuked, $user, $visiteur, $bgcolor1, $bgcolor2, $bgcolor3, $img_width, $image_resize, $language;

    # include css and js library shadowbox
    nkTemplate_addCSSFile('media/shadowbox/shadowbox.css');
    nkTemplate_addJSFile('media/shadowbox/shadowbox.js');
    nkTemplate_addJS('Shadowbox.init();');

    if ($nuked['gallery_title'] != "")
    {
        $title = $nuked['gallery_title'];
    }
    else
    {
        $title = _GALLERY;
    }

    opentable();

    $upd = nkDB_execute("UPDATE " . GALLERY_TABLE . " SET count = count + 1 WHERE sid = '" . $sid . "'");

    $sql = nkDB_execute("SELECT cat, titre, description, autor, url, url_file, date, count FROM " . GALLERY_TABLE . " WHERE sid = '" . $sid . "'");

    if(nkDB_numRows($sql) <= 0)
        redirect("index.php?file=404");

    list($cat, $titre, $description, $autor, $url, $url_file, $date, $count) = nkDB_fetchArray($sql);

    $titre = printSecuTags($titre);
    $autor = nkHtmlEntities($autor);

    $name = strrchr($url, '/');
    $name = substr($name, 1);
    $name_enc = rawurlencode($name);
    $url = str_replace($name, $name_enc, $url);

    if (!$name) $name = __('NA');

    if ($date) $date = nkDate($date);
    else $date = __('NA');

    if ($url_file != "")
    {
        $button = "<br /><div style=\"text-align: center;\"><input type=\"button\" value=\"" . _GDOWNFILE . "\" onclick=\"window.open('" . $url_file . "')\" /></div><br />\n";
    }
    else
    {
        $button = "<br />\n";
    }

    $sql2 = nkDB_execute("SELECT titre, parentid FROM " . GALLERY_CAT_TABLE . " WHERE cid = '" . $cat . "'");
    list($cat_name, $parentid) = nkDB_fetchArray($sql2);
    $cat_name = printSecuTags($cat_name);

    if ($cat == 0)
    {
        $category = __('NONE_CATEGORY');
    }
    else if ($parentid > 0)
    {
        $sql3 = nkDB_execute("SELECT titre FROM " . GALLERY_CAT_TABLE . " WHERE cid = '" . $parentid . "'");
        list($parent_name) = nkDB_fetchArray($sql3);
        $parent_name = printSecuTags($parent_name);

        $category = "<a href=\"index.php?file=Gallery&amp;op=categorie&amp;cat=" . $parentid . "\">" . $parent_name . "</a> -&gt; <a href=\"index.php?file=Gallery&amp;op=categorie&amp;cat=" . $cat . "\">" . $cat_name . "</a>";
    }
    else
    {
        $category = "<a href=\"index.php?file=Gallery&amp;op=categorie&amp;cat=" . $cat . "\">" . $cat_name . "</a>";
    }


    if ($_REQUEST['orderby'] == "name")
    {
        $sql_next = nkDB_execute("SELECT sid FROM " . GALLERY_TABLE . " WHERE cat = '" . $cat . "' AND titre > '" . $titre . "' ORDER BY titre LIMIT 0, 1");
        list($nextid) = nkDB_fetchArray($sql_next);

        $sql_last = nkDB_execute("SELECT sid FROM " . GALLERY_TABLE . " WHERE cat = '" . $cat . "' AND titre < '" . $titre . "' ORDER BY titre DESC LIMIT 0, 1");
        list($lastid) = nkDB_fetchArray($sql_last);
    }
    else if ($_REQUEST['orderby'] == "count")
    {
        $sql_next = nkDB_execute("SELECT sid FROM " . GALLERY_TABLE . " WHERE cat = '" . $cat . "' AND count < '" . $count . "' ORDER BY count DESC LIMIT 0, 1");
        list($nextid) = nkDB_fetchArray($sql_next);

        $sql_last = nkDB_execute("SELECT sid FROM " . GALLERY_TABLE . " WHERE cat = '" . $cat . "' AND count > '" . $count . "' ORDER BY count LIMIT 0, 1");
        list($lastid) = nkDB_fetchArray($sql_last);
    }
    else if ($_REQUEST['orderby'] == "note" && nivo_mod('Vote') > -1)
    {
        $sql_note = nkDB_execute("SELECT AVG(vote) FROM " . VOTE_TABLE . " WHERE vid = '" . $sid . "' AND module = 'Gallery'");
        list($note) = nkDB_fetchArray($sql_note);

        $sql_next = nkDB_execute("SELECT L.sid, AVG(V.vote) AS note FROM " . GALLERY_TABLE . " AS L LEFT JOIN " . VOTE_TABLE . " AS V ON L.sid = V.vid AND V.module = 'Gallery' WHERE L.cat = '" . $cat . "' GROUP BY L.sid HAVING note < '" . $note . "' ORDER BY note DESC LIMIT 0, 1");
        list($nextid) = nkDB_fetchArray($sql_next);

        $sql_last = nkDB_execute("SELECT L.sid, AVG(V.vote) AS note FROM " . GALLERY_TABLE . " AS L LEFT JOIN " . VOTE_TABLE . " AS V ON L.sid = V.vid AND V.module = 'Gallery' WHERE L.cat = '" . $cat . "' GROUP BY L.sid HAVING note > '" . $note . "' ORDER BY note LIMIT 0, 1");
        list($lastid) = nkDB_fetchArray($sql_last);
    }
    else
    {
        $_REQUEST['orderby'] = "news";

        $sql_next = nkDB_execute("SELECT sid FROM " . GALLERY_TABLE . " WHERE cat = '" . $cat . "' AND sid < '" . $sid . "' ORDER BY sid DESC LIMIT 0, 1");
        list($nextid) = nkDB_fetchArray($sql_next);

        $sql_last = nkDB_execute("SELECT sid FROM " . GALLERY_TABLE . " WHERE cat = '" . $cat . "' AND sid > '" . $sid . "' ORDER BY sid LIMIT 0, 1");
        list($lastid) = nkDB_fetchArray($sql_last);
    }

    $prev = $next = '';

    if ($nextid != "")
    {
        $next = "<small><a href=\"index.php?file=Gallery&amp;op=description&amp;sid=" . $nextid . "&amp;orderby=" . $_REQUEST['orderby'] . "\">" . _NEXTIMG . "</a> &gt;</small>";
    }


    if ($lastid != "")
    {
        $prev = "<small>&lt; <a href=\"index.php?file=Gallery&amp;op=description&amp;sid=" . $lastid . "&amp;orderby=" . $_REQUEST['orderby'] . "\">" . _LASTIMG . "</a> &nbsp;</small>";
    }

    echo "<br />\n";

    if ($visiteur >= admin_mod("Gallery"))
    {
        echo"<script type=\"text/javascript\">\n"
        ."<!--\n"
        ."\n"
        . "function delimg(titre, id)\n"
        . "{\n"
        . "if (confirm('" . _SCREENDELETE  . " '+titre+' ! " . _CONFIRM . "'))\n"
        . "{document.location.href = 'index.php?file=Gallery&page=admin&op=del_screen&sid='+id;}\n"
        . "}\n"
        . "\n"
        . "// -->\n"
        . "</script>\n";

        echo "<div style=\"text-align: right;\"><a href=\"index.php?file=Gallery&amp;page=admin&amp;op=edit_screen&amp;sid=" . $sid . "\"><img style=\"border: 0;\" src=\"images/edition.gif\" alt=\"\" title=\"" . _EDIT . "\" /></a>"
        . "&nbsp;<a href=\"javascript:delimg('" . addslashes($titre) . "', '" . $sid . "');\"><img style=\"border: 0;\" src=\"images/delete.gif\" alt=\"\" title=\"" . _DEL . "\" /></a></div>\n";
    }

    echo "<br /><div style=\"text-align: center;\"><a href=\"index.php?file=Gallery\" style=\"text-decoration:none\"><big><b>" . $title . "</b></big></a></div><br />\n"
    . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" cellpadding=\"20\" cellspacing=\"0\" border=\"0\">\n"
    . "<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\">"
    .  "<a href=\"" . $url . "\" rel=\"shadowbox\" title=\"" . $titre . "\">"
    . img_size($url, $img_width, _CLICTOSCREEN, $image_resize) . "</a></td></tr></table><br />\n"
    . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" width=\"90%\" cellpadding=\"3\" cellspacing=\"0\">\n"
    . "<tr><td align=\"left\">" . $prev . "</td><td align=\"right\">" . $next . "</td></tr></table>\n"
    . "<table style=\"margin-left: auto;margin-right: auto;text-align: left;background: " . $bgcolor2 . ";\" width=\"90%\" cellpadding=\"3\" cellspacing=\"3\" border=\"0\">\n"
    . "<tr style=\"background: " . $bgcolor2 . ";\"><td style=\"border: 1px solid " . $bgcolor3 . ";\" align=\"center\"><big><b>" . $titre . "</b></big></td></tr>\n";

    if ($description != "")
    {
        $description = icon($description);

        echo "<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\">" . $description . "</td></tr>\n"
        . "<tr style=\"background: " . $bgcolor2 . ";\"><td>&nbsp;</td></tr>";
    }

    echo "<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\"><b>" . _CAT . " :</b> " . $category . "</td></tr>\n";

    if ($autor != "")
    {
        echo "<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\"><b>" . __('AUTHOR') . " :</b>  " . $autor . "</td></tr>\n";
    }

    echo "<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\"><b>" . _ADDTHE . " :</b>  " . $date . "</td></tr>\n"
    . "<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\"><b>" . _GFILENAME . " :</b> " . $name . "</td></tr>\n"
    . "<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\"><b>" . _GSEEN . " :</b> " . $count . "&nbsp;" . _GTIMES . "</td></tr>\n";

    $sql = nkDB_execute(
        'SELECT active
        FROM '. VOTE_MODULES_TABLE .'
        WHERE module = \'gallery\''
    );

    list($active) = nkDB_fetchArray($sql);

    if($active == 1 && $visiteur >= nivo_mod('Vote') && nivo_mod('Vote') > -1){
        echo "<tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\">";
        include ("modules/Vote/index.php");
        vote_index("Gallery", $sid);
        echo "</td></tr>";
    }

    echo "</table>" . $button."\n";

    $sql = nkDB_execute(
        'SELECT active
        FROM '. COMMENT_MODULES_TABLE .'
        WHERE module = \'gallery\''
    );

    list($active) = nkDB_fetchArray($sql);

    if($active == 1 && $visiteur >= nivo_mod('Comment') && nivo_mod('Comment') > -1)
    {
        echo "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" width=\"80%\" border=\"0\" cellspacing=\"3\" cellpadding=\"3\"><tr style=\"background: " . $bgcolor1 . ";\"><td style=\"border: 1px dashed " . $bgcolor3 . ";\">";

        include_once 'modules/Comment/index.php';
        com_index('Gallery', $sid);

        echo "</td></tr></table>\n";
    }
    closetable();
}

function index()
{
    global $nuked, $bgcolor1, $bgcolor2, $bgcolor3;

    if ($nuked['gallery_title'] != "")
    {
        $title = $nuked['gallery_title'];
    }
    else
    {
        $title = _GALLERY;
    }

    opentable();

    echo "<br /><div style=\"text-align: center;\"><big><b>" . $title . "</b></big></div>\n"
    . "<div style=\"text-align: center;\"><br />\n"
    . "[  " . _INDEXGALLERY . " | "
    . "<a href=\"index.php?file=Gallery&amp;op=classe&amp;orderby=news\" style=\"text-decoration: underline\">" . _NEWSIMG . "</a> | "
    . "<a href=\"index.php?file=Gallery&amp;op=classe&amp;orderby=count\" style=\"text-decoration: underline\">" . _TOPIMG . "</a> | "
    . "<a href=\"index.php?file=Suggest&amp;module=Gallery\" style=\"text-decoration: underline\">" . _SUGGESTIMG . "</a> ]</div><br />\n";

    $sql_nbimages = nkDB_execute("SELECT sid FROM " . GALLERY_TABLE . "");
    $nb_images = nkDB_numRows($sql_nbimages);

    $sql_nbcat = nkDB_execute("SELECT cid FROM " . GALLERY_CAT_TABLE . "");
    $nb_cat = nkDB_numRows($sql_nbcat);

    if ($nb_cat > 0)
    {
        echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td>";

        $sql_cat = nkDB_execute("SELECT cid, titre, description FROM " . GALLERY_CAT_TABLE . " WHERE parentid = '0' ORDER BY position, titre");
        while (list($cid, $titre, $description) = nkDB_fetchArray($sql_cat))
        {

            $titre = printSecuTags($titre);
            $description = icon($description);

            $sql_img = nkDB_execute("SELECT sid, date FROM " . GALLERY_TABLE . " WHERE cat = '" . $cid . "' ORDER BY sid DESC LIMIT 0, 1");
            $nb_imgcat = nkDB_numRows($sql_img);
            list($sid, $date) = nkDB_fetchRow($sql_img);

            $sql_img_tt = nkDB_execute("SELECT sid FROM " . GALLERY_TABLE . ", " . GALLERY_CAT_TABLE . " WHERE cat = cid AND (parentid = '" . $cid . "' OR cid = '" . $cid . "')");
            $nb_imgcat_tt = nkDB_numRows($sql_img_tt);

            $sql_nbcat = nkDB_execute("SELECT cid FROM " . GALLERY_CAT_TABLE . " WHERE parentid = '" . $cid . "'");
            $nb_nbcat = nkDB_numRows($sql_nbcat);

            if ($date != "")
            {
                $date = nkDate($date);
                $last_date = "" . _LASTADD . " $date";
            }
            else
            {
                $last_date = "";
            }

            echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"border: 1px solid " . $bgcolor3 . ";\"><tr><td>\n"
            . "<table style=\"background: " . $bgcolor2 . ";\" width=\"100%\" cellspacing=\"1\" cellpadding=\"5\" border=\"0\">\n"
            . "<tr><td style=\"width: 80%;background: " . $bgcolor1 . ";\"><a href=\"index.php?file=Gallery&amp;op=categorie&amp;cat=" . $cid . "\"><big><b>" . $titre . "</b></big></a></td>\n"
            . "<td style=\"width: 10%;background: " . $bgcolor1 . ";\">" . $nb_imgcat_tt . "&nbsp;" . _SCREENINDB . "</td>\n";

            if ($nb_nbcat)
            {
                echo "<td style=\"width: 10%;background: " . $bgcolor1 . ";\">" . $nb_nbcat . "&nbsp;" . _NBCAT . "</td>";
            }

            echo "</tr></table></td></tr><tr><td>";

            if ($nb_nbcat == 0)
            {
                echo "<table width=\"100%\"><tr><td>&nbsp;</td></tr><tr><td align=\"center\">" . $description . "</td></tr><tr><td>&nbsp;</td></tr></table>\n";
            }
            else
            {
                cat($cid);
            }

            echo "</td></tr></table><br />\n";
        }

        echo "</td></tr></table>\n";
    }
    else
    {
        echo "<br />";
    }

    classe("0");

    if ($nb_cat > 0 || $nb_images > 0) echo "<br /><div style=\"text-align: center;\"><small>( <i>" . _THEREIS . "&nbsp;" . $nb_images . "&nbsp;" . _SCREENINDB . " &amp; " . $nb_cat . "&nbsp;" . _NBCAT . "&nbsp;" . _INDATABASE . "</i> )</small></div><br /><br />\n";
    else echo "<div style=\"text-align: center;\">" . _NOSCREENINDB . "</div><br /><br />\n";

    closetable();
}

function classe()
{
    global $op, $nuked, $bgcolor1, $bgcolor2, $bgcolor3, $img_screen1, $img_screen2, $img_screen3, $image_resize;

    if(array_key_exists('cat', $_REQUEST)){
        $cat = $_REQUEST['cat'];
    }
    else{
        $cat = '';
    }

    $nb_img_guest = $nuked['max_img'];
    $nb_img_line = $nuked['max_img_line'];

    if ($cat > 0)
    {
        $sql = nkDB_execute("SELECT cid FROM " . GALLERY_CAT_TABLE . " WHERE parentid = '" . $cat . "'");
        $nb_subcat = nkDB_numRows($sql);
    }
    else
    {
        $nb_subcat = 0;
    }

    if ($op == "classe")
    {
        if ($nuked['gallery_title'] != "")
        {
            $title = $nuked['gallery_title'];
        }
        else
        {
            $title = _GALLERY;
        }

        echo "<br /><div style=\"text-align: center;\"><big><b>" . $title . "</b></big></div>\n"
        . "<div style=\"text-align: center;\"><br />\n"
        . "[ <a href=\"index.php?file=Gallery\" style=\"text-decoration: underline\">" . _INDEXGALLERY . "</a> | ";

        if ($_REQUEST['orderby'] == "news")
        {
            echo _NEWSIMG . " | ";
        }
        else
        {
            echo "<a href=\"index.php?file=Gallery&amp;op=classe&amp;orderby=news\" style=\"text-decoration: underline\">" . _NEWSIMG . "</a> | ";
        }

        if ($_REQUEST['orderby'] == "count")
        {
            echo _TOPIMG . " | ";
        }
        else
        {
            echo "<a href=\"index.php?file=Gallery&amp;op=classe&amp;orderby=count\" style=\"text-decoration: underline\">" . _TOPIMG . "</a> | ";
        }

        echo "<a href=\"index.php?file=Suggest&amp;module=Gallery\" style=\"text-decoration: underline\">" . _SUGGESTIMG . "</a> ]</div><br />\n";
    }

    if ($cat != "") $where = "WHERE L.cat = '" . $cat . "'";
    else $where = "";

    if(!array_key_exists('orderby', $_REQUEST)){
        $_REQUEST['orderby'] = '';
    }


    if ($_REQUEST['orderby'] == "name")
    {
        $order = "ORDER BY L.titre";
    }

    else if ($_REQUEST['orderby'] == "count")
    {
        $order = "ORDER BY L.count DESC";
    }

    else if ($_REQUEST['orderby'] == "note" && nivo_mod('Vote') > -1)
    {
        $order = "ORDER BY note DESC";
    }

    else
    {
        $_REQUEST['orderby'] = "news";
        $order = "ORDER BY L.sid DESC";
    }

    $sql = nkDB_execute("SELECT L.sid, L.titre, L.url, L.url2, L.date, AVG(V.vote) AS note  FROM " . GALLERY_TABLE . " AS L LEFT JOIN " . VOTE_TABLE . " AS V ON L.sid = V.vid AND V.module = 'Gallery' " . $where . " GROUP BY L.sid " . $order);
    $count = nkDB_numRows($sql);

    if ($count > 1 && $cat != "")
    {
        echo "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" width=\"90%\">\n"
        . "<tr><td align=\"right\"><small>" . _ORDERBY . " : ";

        if ($_REQUEST['orderby'] == "news")
        {
            echo "<b>" . _DATE . "</b> | ";
        }
        else
        {
            echo "<a href=\"index.php?file=Gallery&amp;op=" . $op . "&amp;orderby=news&amp;cat=" . $cat . "\">" . _DATE . "</a> | ";
        }

        if ($_REQUEST['orderby'] == "name")
        {
            echo "<b>" . _NAME . "</b> | ";
        }

        else
        {
            echo "<a href=\"index.php?file=Gallery&amp;op=" . $op . "&amp;orderby=name&amp;cat=" . $cat . "\">" . _NAME . "</a> | ";
        }

        if ($_REQUEST['orderby'] == "count")
        {
            echo "<b>" . _GTOPFILE . "</b> | ";
        }
        else
        {
            echo "<a href=\"index.php?file=Gallery&amp;op=" . $op . "&amp;orderby=count&amp;cat=" . $cat . "\">" . _GTOPFILE . "</a> | ";
        }

        if ($_REQUEST['orderby'] == "note" && nivo_mod('Vote') > -1)
        {
            echo "<b>" . _NOTE . "</b>&nbsp;";
        }
        elseif (nivo_mod('Vote') > -1)
        {
            echo "<a href=\"index.php?file=Gallery&amp;op=" . $op . "&amp;orderby=note&amp;cat=" . $cat . "\">" . _NOTE . "</a>&nbsp;";
        }

        echo "</small></td></tr></table>\n";
    }


    if ($count > 0)
    {
        # include css and js library shadowbox
        nkTemplate_addCSSFile('media/shadowbox/shadowbox.css');
        nkTemplate_addJSFile('media/shadowbox/shadowbox.js');
        nkTemplate_addJS('Shadowbox.init();');

        if(array_key_exists('p', $_REQUEST)){
            $page = $_REQUEST['p'];
        }
        else{
            $page = 1;
        }
        $start = $page * $nb_img_guest - $nb_img_guest;

        echo "<table style=\"margin-left: auto;margin-right: auto;text-align: left;\" width=\"90%\" cellspacing=\"5\" cellpadding=\"10\" border=\"0\">\n"
        . "<tr><td  style=\"background: " . $bgcolor1 . ";border: 1px solid " . $bgcolor3 . ";\" colspan=\"" . $nb_img_line . "\">";

        if ($count > $nb_img_guest)
        {
            $url_page = "index.php?file=Gallery&amp;op=" . $op . "&amp;cat=" . $cat . "&amp;orderby=" . $_REQUEST['orderby'];
            number($count, $nb_img_guest, $url_page);
        }
        else
        {
            echo "&nbsp;";
        }

        echo "</td></tr>\n";

        $l = 0;
        $pourcent = 100 / $nb_img_line;
        $seek = nkDB_dataSeek($sql, $start);
        $last_sid = '';
        for($i = 0;$i < $nb_img_guest;$i++)
        {
            if (list($sid, $titre, $url, $url2, $date) = nkDB_fetchRow($sql))
            {
                if ($url2 != "" && $url2 != "http://")
                {
                    $img = $url2;
                }
                else
                {
                    $img = $url;
                }

                if ($nb_img_line > 4)
                {
                    $img_w = $img_screen3;
                }
                else if ($nb_img_line > 3)
                {
                    $img_w = $img_screen2;
                }
                else
                {
                    $img_w = $img_screen1;
                }

                $name = strrchr($img, '/');
                $name = substr($name, 1);
                $name_enc = rawurlencode($name);
                $img = str_replace($name, $name_enc, $img);

                $titre = printSecuTags($titre);

                if ($date != "") $alt = _ADDTHE . "&nbsp;" . nkDate($date);
                else $alt = $titre;

                if ($sid != $last_sid)
                {
                    $l++;
                    if ($l == 1)
                    {
                        echo "<tr>";
                    }

                    echo "<td style=\"width: " . $pourcent . "%;background: " . $bgcolor1 . ";border: 1px solid $bgcolor3;\" align=\"center\">"
                    . "<a href=\"" . $url . "\" rel=\"shadowbox\">" . img_size($img, $img_w, $alt, $image_resize) . "</a><br />\n"
                    . "<a href=\"index.php?file=Gallery&amp;op=description&amp;sid=" . $sid . "&amp;orderby=" . $_REQUEST['orderby'] . "\"><b>" . $titre . "</b></a></td>\n";

                    if ($l == $nb_img_line)
                    {
                        $l = 0;
                        echo "</tr>";
                    }

                    $last_sid = $sid;
                }
            }
        }

        if ($l > 0)
        {
            for ($j = $l;$j < $nb_img_line;$j++)
            {
                echo "<td style=\"width: " . $pourcent . "%;background: " . $bgcolor1 . ";border: 1px solid $bgcolor3;\">&nbsp;</td>\n";
            }

            echo "</tr>\n";
        }

        if ($nb_subcat == 0 && $count == 0) echo "<tr><td align=\"center\" colspan=\"$nb_img_line\">" . _NOSCREEN . "</td></tr>\n";

        echo "<tr><td style=\"background: " . $bgcolor1 . ";border: 1px solid $bgcolor3;\" colspan=\"$nb_img_line\">";

        if ($count > $nb_img_guest)
        {
            $url_page = "index.php?file=Gallery&amp;op=" . $op . "&amp;cat=" . $cat . "&amp;orderby=" . $_REQUEST['orderby'];
            number($count, $nb_img_guest, $url_page);
        }
        else
        {
            echo "&nbsp;";
        }

        echo "</td></tr></table><br />\n";

    }
    else
    {
            if ($nb_subcat == 0 && $cat > 0) echo "<div style=\"text-align: center;\"><br />" . _NOSCREEN . "</div><br /><br />\n";
            if ($op == "classe") echo "<div style=\"text-align: center;\"><br />" . _NOSCREENINDB . "</div><br /><br />\n";
    }

}

function img_size($image, $largeur, $title, $image_resize)
{
    if ($image_resize == "off") $test = 0;
    else if (preg_match("`http://`i", $image) && $image_resize == "local") $test = 0;
    else  $test = 1;

    if(strpos($_SERVER['HTTP_USER_AGENT'], 'compatible; MSIE 8.0;') !== false){
        $prop_width = 'width';
    }
    else{
        $prop_width = 'max-width';
    }

    if ($test == 1) $style = "style=\"border: 1px solid #000000; overflow: auto; ".$prop_width.": " . $largeur . "px;  width: expression(this.scrollWidth >= " . $largeur . "? '" . $largeur . "px' : 'auto');\"";
    else $style = "style=\"border: 1px solid #000000;\"";

    $image_resize = "<img " . $style . " src=\"" . checkimg($image) . "\" alt=\"\" title=\"" . $title . "\" />";
    return($image_resize);
}

switch ($GLOBALS['op'])
{
    case "description":
        description($_REQUEST['sid']);
        break;

    case "categorie":
        categorie($_REQUEST['cat']);
        break;

    case "classe":
        opentable();
        classe();
        closetable();
        break;

    default:
        index();
        break;
}

?>
