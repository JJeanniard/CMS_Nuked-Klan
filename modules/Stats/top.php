<?php
/**
 * top.php
 *
 * Frontend of Stats module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! moduleInit('Stats'))
    return;

opentable();

global $user, $nuked, $bgcolor3, $bgcolor2, $bgcolor1;

echo '<h2 style="text-align: center; margin-top: 10px">' . _TOP10 . '&nbsp;' . $nuked['name'] . '</h2>'."\n";

if (nivo_mod('Download') != -1) {
    echo '<h3 style="text-align: center; margin-top: 30px">' . _TOPDOWNLOAD . '</h3>'."\n"
    . '<table style="margin: auto; background: ' . $bgcolor2 . '; border: 1px solid ' . $bgcolor3 . ';" width="80%" cellpadding="2" cellspacing="1">'."\n"
    . '<tr style="background: ' . $bgcolor3 . '">'."\n"
    . '<td style="width: 10%" align="center"><b>#</b></td>'."\n"
    . '<td style="width: 60%" align="center"><b>' . _NOM . '</b></td>'."\n"
    . '<td style="width: 30%" align="center"><b>' . _DOWNLOADCOUNT . '</b></td></tr>'."\n";

    $sql = nkDB_execute("SELECT id, titre, count FROM " . DOWNLOAD_TABLE . " ORDER BY count DESC LIMIT 0, 10");
    $nb_dl = nkDB_numRows($sql);
    if ($nb_dl > 0) {
        $idl = 0;
        $j = 0;
        while (list($dl_id, $dl_titre, $dl_count) = nkDB_fetchArray($sql)) {
            $idl++;

            if ($j == 0) {
                $bg = $bgcolor2;
                $j++;
            }
            else {
                $bg = $bgcolor1;
                $j = 0;
            }

            $dl_titre = str_replace(array('&lt;','&gt;','&amp;'), array('<','>','&'), $dl_titre);
            $dl_titre = (strlen($dl_titre) > 40) ? substr($dl_titre, 0, 40) . '...' : $dl_titre;

            echo '<tr style="background: ' . $bg . '">'."\n"
            . '<td style="width: 10%" align="center">' . $idl . '</td>'."\n"
            . '<td style="width: 60%"><a href="index.php?file=Download&amp;op=description&amp;dl_id=' . $dl_id . '">' . nkHtmlEntities($dl_titre) . '</a></td>'."\n"
            . '<td style="width: 30%" align="center">' . $dl_count . '</td></tr>'."\n";
        }
    }
    else {
        echo '<tr><td align="center" colspan="3">' . _NODOWNLOAD . '</td></tr>'."\n";
    }

    echo '</table>'."\n";
}


if (nivo_mod('Links') != -1) {
    echo '<h3 style="text-align: center; margin-top: 30px">' . _TOPLINK . '</h3>'."\n"
    . '<table style="margin: auto; background: ' . $bgcolor2 . '; border: 1px solid ' . $bgcolor3 . ';" width="80%" cellpadding="2" cellspacing="1">'."\n"
    . '<tr style="background: ' . $bgcolor3 . '">'."\n"
    . '<td style="width: 10%" align="center"><b>#</b></td>'."\n"
    . '<td style="width: 60%" align="center"><b>' . _NOM . '</b></td>'."\n"
    . '<td style="width: 30%" align="center"><b>' . _VISITCOUNT . '</b></td></tr>'."\n";

    $sql2 = nkDB_execute("SELECT id, titre, count FROM " . LINKS_TABLE . " ORDER BY count DESC LIMIT 0, 10");
    $nb_link = nkDB_numRows($sql2);
    if ($nb_link > 0) {
        $ilink = 0;
        $j1 = 0;
        while (list($link_id, $link_titre, $link_count) = nkDB_fetchArray($sql2)) {
            $ilink++;

            if ($j1 == 0) {
                $bg1 = $bgcolor2;
                $j1++;
            }
            else {
                $bg1 = $bgcolor1;
                $j1 = 0;
            }

            $link_titre = str_replace(array('&lt;','&gt;','&amp;'), array('<','>','&'), $link_titre);
            $link_titre = (strlen($link_titre) > 40) ? substr($link_titre, 0, 40) . '...' : $link_titre;

            echo '<tr style="background: ' . $bg1 . '">'."\n"
            . '<td style="width: 10%" align="center">' . $ilink . '</td>'."\n"
            . '<td style="width: 60%"><a href="index.php?file=Links&amp;op=description&amp;link_id=' . $link_id . '">' . nkHtmlEntities($link_titre) . '</a></td>'."\n"
            . '<td style="width: 30%" align="center">' . $link_count . '</td></tr>'."\n";
        }
    }
    else {
        echo '<tr><td align="center" colspan="3">' . _NOLINK . '</td></tr>'."\n";
    }

    echo '</table>'."\n";
}


if (nivo_mod('Sections') != -1) {
    echo '<h3 style="text-align: center; margin-top: 30px">' . _TOPARTICLE . '</h3>'."\n"
    . '<table style="margin: auto; background: ' . $bgcolor2 . '; border: 1px solid ' . $bgcolor3 . ';" width="80%" cellpadding="2" cellspacing="1">'."\n"
    . '<tr style="background: ' . $bgcolor3 . '">'."\n"
    . '<td style="width: 10%" align="center"><b>#</b></td>'."\n"
    . '<td style="width: 60%" align="center"><b>' . _NOM . '</b></td>'."\n"
    . '<td style="width: 30%" align="center"><b>' . _READCOUNT . '</b></td></tr>'."\n";

    $sql3 = nkDB_execute("SELECT artid, title, counter FROM " . SECTIONS_TABLE . " ORDER BY counter DESC LIMIT 0, 10");
    $nb_art = nkDB_numRows($sql3);
    if ($nb_art > 0) {
        $iart = 0;
        $j2 = 0;
        while (list($art_id, $art_titre, $art_count) = nkDB_fetchArray($sql3)) {
            $iart++;

            if ($j2 == 0) {
                $bg2 = $bgcolor2;
                $j2++;
            }
            else {
                $bg2 = $bgcolor1;
                $j2 = 0;
            }

            $art_titre = str_replace(array('&lt;','&gt;','&amp;'), array('<','>','&'), $art_titre);
            $art_titre = (strlen($art_titre) > 40) ? substr($art_titre, 0, 40) . '...' : $art_titre;

            echo '<tr style="background: ' . $bg2 . '">'."\n"
            . '<td style="width: 10%" align="center">' . $iart . '</td>'."\n"
            . '<td style="width: 60%"><a href="index.php?file=Sections&amp;op=article&amp;artid=' . $art_id . '">' . nkHtmlEntities($art_titre) . '</a></td>'."\n"
            . '<td style="width: 30%" align="center">' . $art_count . '</td></tr>'."\n";
        }
    }
    else {
        echo '<tr><td align="center" colspan="3">' . _NOART . '</td></tr>'."\n";
    }

    echo '</table>'."\n";
}


if (nivo_mod('Forum') != -1) {
    echo '<h3 style="text-align: center; margin-top: 30px">' . _TOPTHREADS . '</h3>'."\n"
    . '<table style="margin: auto; background: ' . $bgcolor2 . '; border: 1px solid ' . $bgcolor3 . ';" width="80%" cellpadding="2" cellspacing="1">'."\n"
    . '<tr style="background: ' . $bgcolor3 . '">'."\n"
    . '<td style="width: 10%" align="center"><b>#</b></td>'."\n"
    . '<td style="width: 60%" align="center"><b>' . _NOM . '</b></td>'."\n"
    . '<td style="width: 30%" align="center"><b>' . _READCOUNT . '</b></td></tr>'."\n";

    $sql4 = nkDB_execute("SELECT id, forum_id, titre, view FROM " . FORUM_THREADS_TABLE . " ORDER BY view DESC LIMIT 0, 10");
    $nb_topic = nkDB_numRows($sql4);
    if ($nb_topic > 0) {
        $itopic = 0;
        $j3 = 0;
        while (list($tid, $fid, $topic_titre, $views) = nkDB_fetchArray($sql4)) {
            $itopic++;

            if ($j3 == 0) {
                $bg3 = $bgcolor2;
                $j3++;
            }
            else {
                $bg3 = $bgcolor1;
                $j3 = 0;
            }

            $topic_titre = str_replace(array('&lt;','&gt;','&amp;'), array('<','>','&'), $topic_titre);
            $topic_titre = (strlen($topic_titre) > 40) ? substr($topic_titre, 0, 40) . '...' : $topic_titre;

            echo '<tr style="background: ' . $bg3 . '">'."\n"
            . '<td style="width: 10%" align="center">' . $itopic . '</td>'."\n"
            . '<td style="width: 60%"><a href="index.php?file=Forum&amp;page=viewtopic&amp;forum_id=' . $fid . '&amp;thread_id=' . $tid . '">' . nkHtmlEntities($topic_titre) . '</a></td>'."\n"
            . '<td style="width: 30%" align="center">' . $views . '</td></tr>'."\n";
        }
    }
    else {
        echo '<tr><td align="center" colspan="3">' . _NOTOPIC . '</td></tr>'."\n";
    }
    echo '</table><h3 style="text-align: center; margin-top: 30px">' . _TOPUSERFORUM . '</h3>'."\n"
    . '<table style="margin: auto; background: ' . $bgcolor2 . '; border: 1px solid ' . $bgcolor3 . ';" width="80%" cellpadding="2" cellspacing="1">'."\n"
    . '<tr style="background: ' . $bgcolor3 . '">'."\n"
    . '<td style="width: 10%" align="center"><b>#</b></td>'."\n"
    . '<td style="width: 60%" align="center"><b>' . _PSEUDO . '</b></td>'."\n"
    . '<td style="width: 30%" align="center"><b>' . _POSTCOUNT . '</b></td></tr>'."\n";

    $sql5 = nkDB_execute("SELECT pseudo, count FROM " . USER_TABLE . " ORDER BY count DESC LIMIT 0, 10");

    $iuserf = 0;
    $j4 = 0;
    while (list($pseudof, $userfcount) = nkDB_fetchArray($sql5)) {
        $iuserf++;

        if ($j4 == 0) {
            $bg4 = $bgcolor2;
            $j4++;
        }
        else {
            $bg4 = $bgcolor1;
            $j4 = 0;
        }

        $pseudof = str_replace(array('&lt;','&gt;','&amp;'), array('<','>','&'), $pseudof);

        echo '<tr style="background: ' . $bg4 . '">'."\n"
        . '<td style="width: 10%" align="center">' . $iuserf . '</td>'."\n"
        . '<td style="width: 60%"><a href="index.php?file=Members&amp;op=detail&amp;autor=' . urlencode($pseudof) . '">' . nkHtmlEntities($pseudof) . '</a></td>'."\n"
        . '<td style="width: 30%" align="center">' . $userfcount . '</td></tr>'."\n";
    }

    echo '</table>'."\n";
}

echo '<div style="text-align: center"><br /><br />[ <a href="index.php?file=Stats">' . _STATISTICS . '</a> ]<br /><br /></div>'."\n";

closetable();

?>
