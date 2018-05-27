<?php
/**
 * index.php
 *
 * Frontend of Links module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! moduleInit('Links'))
    return;

compteur('Links');

include 'modules/Vote/index.php';


function index(){
    global $nuked;

    opentable();

    echo '<br /><div style="text-align: center"><big><b>' . _WEBLINKS . '</b></big></div>'."\n"
    . '<div style="text-align: center"><br />'."\n"
    . '[ <b>' . _INDEXLINKS . '</b> | '
    . '<a href="index.php?file=Links&amp;op=classe&amp;orderby=news">' . _NEWSLINK . '</a> | '
    . '<a href="index.php?file=Links&amp;op=classe&amp;orderby=count">' . _TOPLINKS . '</a> | '
    . '<a href="index.php?file=Suggest&amp;module=Links">' . _SUGGESTLINK . '</a> ]</div>'."\n";

    $sql = nkDB_execute('SELECT id FROM ' . LINKS_TABLE);
    $nb_links = nkDB_numRows($sql);

    $sql_nbcat = nkDB_execute('SELECT cid FROM ' . LINKS_CAT_TABLE);
    $nb_cat = nkDB_numRows($sql_nbcat);
    if ($nb_cat > 0){
        echo '<table style="margin: auto" cellspacing="15" cellpadding="5">'."\n";

        $sql_cat = nkDB_execute('SELECT cid, titre, description FROM ' . LINKS_CAT_TABLE . ' WHERE parentid = 0 ORDER BY position, titre');
        $test = 0;
        $last_cid = 0;
        while (list($cid, $titre, $description) = nkDB_fetchArray($sql_cat)){
            $description = icon($description);

            if ($cid != $last_cid){
                $test++;
                if ($test == 1) echo '<tr>';

                echo '<td valign="top"><img src="modules/Links/images/fleche.gif" alt="" /><a href="index.php?file=Links&amp;op=categorie&amp;cat=' . $cid . '"><b>' . printSecuTags($titre) . '</b></a>';

                $sql2 = nkDB_execute('SELECT cat FROM ' . LINKS_TABLE . ' WHERE cat = ' . $cid);
                $nb_lk = nkDB_numRows($sql2);

                if ($nb_lk > 0) echo '<small>&nbsp;(' . $nb_lk . ')</small>'."\n";
                if (!empty($description)) echo '<div>' . $description . '</div>'."\n";
                else echo '<br />';

                $t = 0;
                $sql_subcat = nkDB_execute('SELECT cid, titre FROM ' . LINKS_CAT_TABLE . ' WHERE parentid = ' . $cid . ' ORDER BY position, titre LIMIT 0, 4');
                while (list($sub_cat_id, $sub_cat_titre) = nkDB_fetchArray($sql_subcat)){
                    $sub_cat_titre = printSecuTags($sub_cat_titre);
                    $t++;
                    if ($t <= 3) echo '<small><a href="index.php?file=Links&amp;op=categorie&amp;cat=' . $sub_cat_id . '">' . $sub_cat_titre . '</a></small>&nbsp;&nbsp;';
                    else echo '<a href="index.php?file=Links&amp;op=categorie&amp;cat=' . $cid . '"><small>...</small></a>';
                }

                echo '</td>',"\n";

                if ($test == 2){
                    $test = 0;
                    echo '</tr>'."\n";
                }

                $last_cid = $cid;
            }
        }

        if ($test == 1) echo '</tr>'."\n";
        echo '</table>'."\n";
    }
    else{
        echo '<br />'."\n";
    }

    classe('0', '0');

    if ($nb_cat > 0 || $nb_links > 0) echo '<div style="text-align: center"><br /><small><i> ( ' . _THEREIS . '&nbsp;' . $nb_links . '&nbsp;' . _LINKS . ' &amp; ' . $nb_cat . '&nbsp;' . _NBCAT . '&nbsp;' . _INDATABASE . ' )</i></small></div><br />'."\n";
    else echo '<div style="text-align: center"><br />' . _NOLINKINDB . '</div><br /><br />'."\n";

    closetable();
}

function categorie($cat){
    global $nuked;

    opentable();

    $sql = nkDB_execute('SELECT titre, description, parentid FROM ' . LINKS_CAT_TABLE . ' WHERE cid = ' . $cat);

    if(nkDB_numRows($sql) <= 0)
        redirect('index.php?file=404');

    list($cat_titre, $cat_desc, $parentid) = nkDB_fetchArray($sql);

    $cat_titre = printSecuTags($cat_titre);
    $cat_desc = icon($cat_desc);

    if ($parentid > 0){
        $sql_parent = nkDB_execute('SELECT titre FROM ' . LINKS_CAT_TABLE . ' WHERE cid = ' . $parentid);
        list($parent_titre) = nkDB_fetchArray($sql_parent);

        echo '<br /><div style="text-align: center"><a href="index.php?file=Links" style="text-decoration:none"><big><b>' . _WEBLINKS . '</b></big></a> &gt; <a href="index.php?file=Links&amp;op=categorie&amp;cat=' . $parentid . '" style="text-decoration:none"><big><b>' . nkHtmlEntities($parent_titre) . '</b></big></a> &gt; <big><b>' . $cat_titre . '</b></big></div><br />'."\n";
    }
    else{
        echo '<br /><div style="text-align: center"><a href="index.php?file=Links" style="text-decoration:none"><big><b>' . _WEBLINKS . '</b></big></a> &gt; <big><b>' . $cat_titre . '</b></big></div><br />'."\n";
    }

    $sql3 = nkDB_execute('SELECT cid, titre, description  FROM ' . LINKS_CAT_TABLE . ' WHERE parentid = ' . $cat . ' ORDER BY position, titre');
    $nb_subcat = nkDB_numRows($sql3);
    $count = 0;

    if ($nb_subcat > 0){
        echo '<table style="margin: auto" cellspacing="15" cellpadding="5">'."\n";

        while (list($catid, $parentcat, $parentdesc) = nkDB_fetchArray($sql3)){
            $parentdesc = icon($parentdesc);

            $sql_nbcat = nkDB_execute('SELECT id FROM ' . LINKS_TABLE . ' WHERE cat = ' . $catid);
            $nb_lkcat = nkDB_numRows($sql_nbcat);

            if ($catid != $last_catid){
                $count++;

                if ($count == 1) echo '<tr>';

                echo '<td valign="top">'."\n"
                . '<img src="modules/Links/images/fleche.gif" alt="" /><a href="index.php?file=Links&amp;op=categorie&amp;cat=' . $catid . '"><b>' . printSecuTags($parentcat) . '</b></a> <small>(' . $nb_lkcat . ')</small><br />' . $parentdesc . ''."\n"
                . '</td>';

                if ($count == 2){
                    $count = 0;
                    echo '</tr>'."\n";
                }

                $last_catid = $catid;
            }
        }

        if ($count == 1) echo '</tr>'."\n";
        echo '</table>'."\n";

    }
    else{
        echo '<div style="text-align: center">' . $cat_desc . '</div><br />'."\n";
    }

    classe($cat, $nb_subcat);

    echo '<br />'."\n";

    closetable();
}

function do_link($link_id){
    nkTemplate_setPageDesign('none');

    $sql = nkDB_execute('SELECT url, count FROM ' . LINKS_TABLE . ' WHERE id = ' . $link_id);
    if(nkDB_numRows($sql) <= 0){
        redirect('index.php?file=404');
    }
    else{
        list($link_url, $count) = nkDB_fetchArray($sql);
        $new_count = $count + 1;

        $upd = nkDB_execute('UPDATE ' . LINKS_TABLE . ' SET count = ' . $new_count . ' WHERE id = ' . $link_id);

        redirect($link_url);
    }
}

function broken($link_id){
    global $nuked;

    $sql = nkDB_execute('UPDATE ' . LINKS_TABLE . ' SET broke = broke + 1 WHERE id = ' . $link_id);

    opentable();
    printNotification(_LTHXBROKENLINK, 'success');
    closetable();
    redirect('index.php?file=Links', 2);
}

function description($link_id){
    global $nuked, $user, $visiteur, $bgcolor1, $bgcolor2, $bgcolor3;

    $sql = nkDB_execute('SELECT id, date, titre, description, webmaster, country, cat, count FROM ' . LINKS_TABLE . ' WHERE id = ' . $link_id);
    if(nkDB_numRows($sql) <= 0){
        redirect('index.php?file=404');
    }
    else{
        list($link_id, $date, $titre, $description, $webmaster, $country, $cat, $count) = nkDB_fetchArray($sql);

        $titre = printSecuTags($titre);
        $description = icon($description);

        $sql2 = nkDB_execute('SELECT titre, parentid FROM ' . LINKS_CAT_TABLE . ' WHERE cid = ' . $cat);
        list($cat_name, $parentid) = nkDB_fetchArray($sql2);
        $cat_name = printSecuTags($cat_name);

        if ($cat == 0) $category = __('NONE_CATEGORY');
        else if ($parentid > 0){
            $sql3 = nkDB_execute('SELECT titre FROM ' . LINKS_CAT_TABLE . ' WHERE cid = ' . $parentid);
            list($parent_name) = nkDB_fetchArray($sql3);
            $parent_name = printSecuTags($parent_name);

            $category = '<a href="index.php?file=Links&amp;op=categorie&amp;cat=' . $parentid . '">' . $parent_name . '</a> -&gt; <a href="index.php?file=Links&amp;op=categorie&amp;cat=' . $cat. '">' . $cat_name . '</a>';
        }
        else $category = '<a href="index.php?file=Links&amp;op=categorie&amp;cat=' . $cat . '">' . $cat_name . '</a>';

        if (!empty($country) && file_exists('images/flags/' . $country)){
            list ($pays, $ext) = explode ('.', $country);
            $link_pays = '<img src="images/flags/' . $country . '" alt="" title="' . $pays . '" />';
        }
        else{
            $pays = '';
            $link_pays = '&nbsp;';
        }

        opentable();

        if ($visiteur >= admin_mod('Links')){
            echo '<script type="text/javascript">'."\n"
            . '<!--'."\n"
            . "\n"
            . 'function del_link(titre, id)'."\n"
            . '{'."\n"
            . 'if (confirm(\'' . _DELETELINK . ' \'+titre+\' ! ' . _CONFIRM . '\'))'."\n"
            . '{document.location.href = \'index.php?file=Links&page=admin&op=del&link_id=\'+id;}'."\n"
            . '}'."\n"
            . "\n"
            . '// -->'."\n"
            . '</script>'."\n";

            echo '<div style="text-align: right"><a href="index.php?file=Links&amp;page=admin&amp;op=edit_link&amp;link_id=' . $link_id . '"><img style="border: 0" src="images/edition.gif" alt="" title="' . _EDIT . '" /></a>'
            . '&nbsp;<a href="javascript:del_link(\'' . addslashes($titre) . '\', \'' . $link_id . '\');"><img style="border: 0" src="images/delete.gif" alt="" title="' . _DEL . '" /></a></div>'."\n";
        }

        echo '<br /><div style="text-align: center"><a href="index.php?file=Links" style="text-decoration:none"><big><b> ' . _WEBLINKS . ' </b></big></a></div><br />'."\n"
        . '<table style="margin: auto" width="80%" border="0" cellspacing="3" cellpadding="3">'."\n"
        . '<tr><td style="background: ' . $bgcolor2 . ';border: 1px solid ' . $bgcolor3 . '" align="center">'."\n"
        . '<table width="100%" border="0" cellspacing="0" cellpadding="0">'."\n"
        . '<tr><td style="width: 5%">&nbsp;</td>'."\n"
        . '<td style="width: 90%" align="center"><big><b>' . $titre . '</b></big></td>'."\n"
        . '<td style="width: 5%" align="center">' . $link_pays . '</td></tr></table></td></tr>'."\n";

        if (!empty($description)){
            echo '<tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '">' . $description . '</td></tr>'."\n"
            . '<tr style="background: ' . $bgcolor2 . '"><td>&nbsp;</td></tr>'."\n";
        }

        echo '<tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '"><b>' . _CAT . ' :</b> ' . $category . '</td></tr>'."\n"
        . '<tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '"><b>' . _ADDTHE . ' :</b> ' . nkDate($date) . '</td></tr>'."\n";

        if (!empty($webmaster)){
            echo '<tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '"><b>' . _WEBMASTER . ' :</b> ' . printSecuTags($webmaster) . '</td></tr>'."\n";
        }

        if (!empty($country) && !empty($pays)){
            echo '<tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '"><b>' . _COUNTRY . ' :</b> ' . $pays . '</td></tr>'."\n";
        }

        echo '<tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '"><b>' . _VISITED . ' :</b> ' . $count . '&nbsp;' . _LTIMES . '</td></tr>'."\n";

        $sql = nkDB_execute(
            'SELECT active
            FROM '. VOTE_MODULES_TABLE .'
            WHERE module = \'links\''
        );

        list($active) = nkDB_fetchArray($sql);

        if($active == 1 && $visiteur >= nivo_mod('Vote') && nivo_mod('Vote') > -1){
            echo '<tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '">';
            vote_index('Links', $link_id);
            echo '</td></tr>'."\n";
        }

        if ($visiteur > 0) echo '<tr style="background: ' . $bgcolor2 . '"><td>&nbsp;</td></tr>'."\n"
        . '<tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '"><img src="modules/Links/images/warning.gif" alt="" /> [ <a href="index.php?file=Links&amp;op=broken&amp;link_id=' . $link_id . '">' . _LINDICATELINK . '</a> ]</td></tr>';
        echo '</table>'."\n"
        . '<div style="text-align: center"><br /><input type="button" value="' . _VISITTHISSITE . '" onclick="window.open(\'index.php?file=Links&amp;op=do_link&amp;link_id=' . $link_id . '\')" /></div><br />';

        $sql = nkDB_execute(
            'SELECT active
            FROM '. COMMENT_MODULES_TABLE .'
            WHERE module = \'links\''
        );

        list($active) = nkDB_fetchArray($sql);

        if($active == 1 && $visiteur >= nivo_mod('Comment') && nivo_mod('Comment') > -1){
            echo '<table style="margin: auto" width="80%" border="0" cellspacing="3" cellpadding="3"><tr style="background: ' . $bgcolor1 . '"><td style="border: 1px dashed ' . $bgcolor3 . '">';

            include_once 'modules/Comment/index.php';
            com_index('Links', $link_id);

            echo '</td></tr></table>'."\n";
        }

        closetable();
    }
}

function classe(){
    global $op, $nuked, $theme, $bgcolor1, $bgcolor2, $bgcolor3, $visiteur;

    $arrayRequest = array('cat', 'nb_subcat');

    foreach ($arrayRequest as $key) {
        if(array_key_exists($key, $_REQUEST)){
            ${$key} = $_REQUEST[$key];
        }
        else{
            ${$key} = '';
        }
    }

    if ($op == 'classe'){
        echo '<br /><div style="text-align: center"><big><b>' . _WEBLINKS . '</b></big></div>'."\n"
        . '<div style="text-align: center"><br />'."\n"
        . '[ <a href="index.php?file=Links">' . _INDEXLINKS . '</a> | ';

        if ($_REQUEST['orderby'] == 'news')
            echo '<b>' . _NEWSLINK . '</b> | ';
        else
            echo '<a href="index.php?file=Links&amp;op=classe&amp;orderby=news">' . _NEWSLINK . '</a> | ';

        if ($_REQUEST['orderby'] == 'count')
            echo '<b>' . _TOPLINKS . '</b> | ';
        else
            echo '<a href="index.php?file=Links&amp;op=classe&amp;orderby=count">' . _TOPLINKS . '</a> | ';

        echo '<a href="index.php?file=Suggest&amp;module=Links">' . _SUGGESTLINK . '</a> ]</div><br />'."\n";
    }

    $nb_liens = $nuked['max_liens'];
    if(array_key_exists('p', $_REQUEST)){
        $page = $_REQUEST['p'];
    }
    else{
        $page = 1;
    }
    $start = $page * $nb_liens - $nb_liens;

    $where = isset($cat) && $cat != '' ? 'WHERE L.cat = ' . $cat : '';

    if(!array_key_exists('orderby', $_REQUEST)){
        $_REQUEST['orderby'] = '';
    }

    if ($_REQUEST['orderby'] == 'name')
        $order = 'ORDER BY L.titre';
    else if ($_REQUEST['orderby'] == 'count')
        $order = 'ORDER BY L.count DESC';
    else if ($_REQUEST['orderby'] == 'note')
        $order = "ORDER BY note DESC";
    else{
        $_REQUEST['orderby'] = 'news';
        $order = ' ORDER BY L.id DESC ';
    }

    $sql = nkDB_execute('SELECT L.id, L.date, L.titre, L.description, L.count, L.country, AVG(V.vote) AS note  FROM ' . LINKS_TABLE . ' AS L LEFT JOIN ' . VOTE_TABLE . ' AS V ON L.id = V.vid AND V.module = \'Links\' ' . $where . ' GROUP BY L.id ' . $order);
    $nb_lk = nkDB_numRows($sql);

    if ($nb_lk > 1 && !empty($cat)){
        echo '<table style="margin: auto" width="90%">'."\n"
        . '<tr><td align="right"><small>' . _ORDERBY . ' : ';

        if ($_REQUEST['orderby'] == 'news') echo '<b>' . _DATE . '</b> | ';
        else echo '<a href="index.php?file=Links&amp;op=' . $op . '&amp;orderby=news&amp;cat=' . $cat . '">' . _DATE . '</a> | ';
        if ($_REQUEST['orderby'] == 'count') echo '<b>' . _LTOPFILE . '</b> | ';
        else echo '<a href="index.php?file=Links&amp;op=' . $op . '&amp;orderby=count&amp;cat=' . $cat . '">' . _LTOPFILE . '</a> | ';
        if ($_REQUEST['orderby'] == 'name') echo '<b>' . _NAME . '</b> | ';
        else echo '<a href="index.php?file=Links&amp;op=' . $op . '&amp;orderby=name&amp;cat=' . $cat . '">' . _NAME . '</a> | ';
        if ($_REQUEST['orderby'] == 'note') echo '<b>' . _NOTE . '</b>';
        else echo '<a href="index.php?file=Links&amp;op=' . $op . '&amp;orderby=note&amp;cat=' . $cat . '">' . _NOTE . '</a>';

        echo '</small></td></tr></table>'."\n";
    }

    if (!empty($cat)) {
        $categorie = '&amp;cat=' . $cat;
    }
    else{
        $categorie = '';
    }

    if ($nb_lk > 0){
        if ($nb_lk > $nb_liens){
            echo '<table style="margin: auto" width="90%"><tr><td>';
            $url_page = 'index.php?file=Links&amp;op='. $op . $categorie . '&amp;orderby=' . $_REQUEST['orderby'];
            number($nb_lk, $nb_liens, $url_page);
            echo '</td></tr></table>'."\n";
        }

        echo '<br />';

        $sqlhot = nkDB_execute('SELECT id FROM ' . LINKS_TABLE . ' ORDER BY count DESC LIMIT 0, 10');

        $seek = nkDB_dataSeek($sql, $start);
        for($i = 0;$i < $nb_liens;$i++){
            if (list($link_id, $date, $titre, $description, $count, $country) = nkDB_fetchArray($sql)){
                $titre = printSecuTags($titre);
                $newsdate = time() - 604800;
                $att = '';

                if (!empty($date) && $date > $newsdate) $att = '&nbsp;&nbsp;' . _NEW;

                if (!empty($description)){
                    $description = str_replace('\r', '', $description);
                    $description = str_replace('\n', ' ', $description);
                    $texte = strip_tags($description);

                    if (strlen($texte) > 150){
                        $texte = substr($texte, 0, 150) . '...';
                    }
                }
                else
                    $texte = '';

                nkDB_dataSeek($sqlhot, 0);
                while (list($id_hot) = nkDB_fetchArray($sqlhot)){
                    if ($link_id == $id_hot && $nb_lk > 1 && $count > 9) $att .= '&nbsp;&nbsp;' . _LHOT;
                }

                if (!empty($date)) $alt = 'title="' . _ADDTHE . '&nbsp;' . nkDate($date) . '"';
                else $alt = '';

                if (file_exists('themes/' . $theme . '/images/liens.gif'))
                    $img = '<img src="themes/' . $theme . '/images/liens.gif" alt="" ' . $alt . '/>';
                else
                    $img = '<img src="modules/Links/images/liens.gif" alt="" ' . $alt . '/>';

                if (!empty($country) && file_exists('images/flags/' . $country)){
                    list ($pays, $ext) = explode ('.', $country);
                    $link_pays = '<img src="images/flags/' . $country . '" alt="" title="' . $pays . '" />';
                }
                else
                    $link_pays = '&nbsp;';

                echo '<table style="background: ' . $bgcolor3 . ';margin: auto" width="90%" cellspacing="1" cellpadding="0">'."\n"
                . '<tr><td><table style="background: ' . $bgcolor2 . '" width="100%" border="0" cellspacing="1" cellpadding="2">'."\n"
                . '<tr><td style="width: 100%">' . $img . '&nbsp;<a href="index.php?file=Links&amp;op=description&amp;link_id=' . $link_id . '"><big><b>' . $titre . '</b></big></a>' . $att . '</td>'."\n"
                . '<td>' . $link_pays . '</td></tr>';

                if (!empty($texte))
                    echo '<tr><td colspan="2">' . $texte . '</td></tr>',"\n";

                echo '<tr style="background: ' . $bgcolor1 . '"><td colspan="2">&nbsp;<b>' . _HITS . ' :</b> ' . $count . ' &nbsp;';
                if($visiteur >= nivo_mod('Vote') && nivo_mod('Vote') > -1)
                vote_index('Links', $link_id);

                echo '</td></tr></table></td></tr></table><br />'."\n";
            }
        }

        if (!empty($cat)) {
            $categorie = '&amp;cat=' . $cat;
        }
        else{
            $categorie = '';
        }

        if ($nb_lk > $nb_liens){
            echo '<table style="margin: auto" width="90%"><tr><td>';
            $url_page = 'index.php?file=Links&amp;op='. $op . $categorie . '&amp;orderby=' . $_REQUEST['orderby'];
            number($nb_lk, $nb_liens, $url_page);
            echo '</td></tr></table>'."\n";
        }
    }
    else{
        if ($nb_subcat == 0 && $cat > 0) echo '<div style="text-align: center"><br />' . _NOLINKS . '</div><br /><br />'."\n";
        if ($op == 'classe') echo '<div style="text-align: center"><br />' . _NOLINKINDB . '</div><br /><br />'."\n";
    }
}

switch ($GLOBALS['op']){
    case 'categorie':
        categorie($_REQUEST['cat']);
        break;
    case 'classe':
        opentable();
        classe();
        closetable();
        break;
    case 'do_link':
        do_link($_REQUEST['link_id']);
        break;
    case 'broken':
        broken($_REQUEST['link_id']);
        break;
    case 'description':
        description($_REQUEST['link_id']);
        break;
    default:
        index();
        break;
}

?>
