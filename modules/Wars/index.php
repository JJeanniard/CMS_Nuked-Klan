<?php
/**
 * index.php
 *
 * Frontend of Wars module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! moduleInit('Wars'))
    return;

compteur('Wars');


function index(){
    global $bgcolor1, $bgcolor2, $bgcolor3, $nuked, $theme, $language;

    opentable();

    $sql = nkDB_execute('SELECT warid FROM '.WARS_TABLE.' WHERE etat = 1');
    $nb_matchs = nkDB_numRows($sql);

    if ($nb_matchs > 0){
        $sql_victory = nkDB_execute('SELECT warid FROM '.WARS_TABLE.' WHERE etat = 1 AND tscore_team > tscore_adv');
        $nb_victory = nkDB_numRows($sql_victory);

        $sql_defeat = nkDB_execute('SELECT warid FROM '.WARS_TABLE.' WHERE etat = 1 AND tscore_adv > tscore_team');
        $nb_defeat = nkDB_numRows($sql_defeat);

        $nb_nul = $nb_matchs - ($nb_victory + $nb_defeat);
    }
    else{
        $nb_victory = 0;
        $nb_defeat = 0;
        $nb_nul = 0;
    }

    $nb_wars = $nuked['max_wars'];

    if(array_key_exists('p', $_REQUEST)){
        $page = $_REQUEST['p'];
    }
    else{
        $page = 1;
    }

    $start = $page * $nb_wars - $nb_wars;

    if ($nb_matchs == 0){
        echo '<br /><div style="text-align: center"><big><b>'._MATCHES.' - '.$nuked['name'].'</b></big></div>
                <br /><div style="text-align: center;">'._NOMATCH.'</div><br />';
    }
    else{
        $sql2 = nkDB_execute('SELECT A.titre, B.team FROM '.TEAM_TABLE.' AS A LEFT JOIN '.WARS_TABLE.' AS B ON A.cid = B.team WHERE B.etat = 1 GROUP BY B.team ORDER BY A.ordre, A.titre');
        $nb_team = nkDB_numRows($sql2);

        if (!$_REQUEST['tid'] && $nb_team > 1){
            while (list($team_name, $team) = nkDB_fetchArray($sql2)){
                if ($team_name != ''){
                    $team_name = printSecuTags($team_name);
                }
                else{
                    $team_name = $nuked['name'];
                }

                echo '<br /><div style="text-align: center"><big><b>'._MATCHES.' - </b></big><a href="index.php?file=Wars&amp;tid='.$team.'"><b><big>'.$team_name.'</b></big></a></div>
                        <table style="margin-left: auto;margin-right: auto;text-align: left;background: '.$bgcolor2.';border: 1px solid '.$bgcolor3.';" width="100%" cellpadding="2" cellspacing="1">
                        <tr style="background: '.$bgcolor3.'">
                        <td style="width: 5%;">&nbsp;</td>
                        <td style="width: 10%;"><b>'._DATE.'</b></td>
                        <td style="width: 30%;text-align:center;"><b>'._OPPONENT.'</b></td>
                        <td style="width: 15%;text-align:center;"><b>'._TYPE.'</b></td>
                        <td style="width: 15%;text-align:center;"><b>'._STYLE.'</b></td>
                        <td style="width: 15%;text-align:center;"><b>'._RESULT.'</b></td>
                        <td style="width: 10%;text-align:center;"><b>'._DETAILS.'</b></td></tr>';

                $sql6 = nkDB_execute('SELECT warid FROM '.WARS_TABLE.' WHERE etat = 1 AND team = \''.$team.'\' ');
                $count = nkDB_numRows($sql6);

                $sql4 = nkDB_execute('SELECT warid, adversaire, url_adv, pays_adv, type, style, game, date_jour, date_mois, date_an, tscore_team, tscore_adv FROM '.WARS_TABLE.' WHERE etat = 1 AND team = '.$team.' ORDER BY date_an DESC, date_mois DESC, date_jour DESC LIMIT 0, 10');
                while (list($war_id, $adv_name, $adv_url, $pays_adv, $type, $style, $game, $jour, $mois, $an, $score_team, $score_adv) = nkDB_fetchArray($sql4)){
                    $adv_name = printSecuTags($adv_name);
                    $type = printSecuTags($type);
                    $style = printSecuTags($style);

                    list ($pays, $ext) = explode ('.', $pays_adv);

                    if ($language == 'french'){
                        $date = $jour . '/' . $mois . '/' . $an;
                    }
                    else{
                        $date = $mois . '/' . $jour . '/' . $an;
                    }

                    if ($score_team > $score_adv){
                        $color = '#009900';
                    }
                    else if ($score_team < $score_adv){
                        $color = '#990000';
                    }
                    else{
                        $color = '#3333FF';
                    }

                    if ($j == 0){
                        $bg = $bgcolor2;
                        $j++;
                    }
                    else{
                        $bg = $bgcolor1;
                        $j = 0;
                    }

                    $sql5 = nkDB_execute('SELECT name, icon FROM ' . GAMES_TABLE . ' WHERE id = \'' . $game . '\' ');
                    list($game_name, $icon) = nkDB_fetchArray($sql5);
                    $game_name = printSecuTags($game_name);

                    if ($icon != '' && is_file($icon)){
                        $icone = $icon;
                    } else {
                        $icone = 'images/games/icon_nk.png';
                    }

                    echo '<tr style="background: '. $bg . '">
                            <td style="width: 5%;">&nbsp;<img src="' . $icone . '" alt="" title="' . $game_name . '" /></td>
                            <td style="width: 10%;">' . $date . '</td>
                            <td style="width: 30%;"><img src="images/flags/' . $pays_adv . '" alt="" title="' . $pays . '" /> ';

                    if ($adv_url != ''){
                        echo '<a href="' . $adv_url . '" onclick="window.open(this.href); return false;">' . $adv_name . '</a>';
                    }
                    else{
                        echo $adv_name;
                    }

                    if (is_file('themes/' . $theme . '/images/report.png')){
                        $img = 'themes/' . $theme . '/images/report.png';
                    }
                    else{
                        $img = 'modules/Wars/images/report.png';
                    }

                    echo '</td><td style="width: 15%;text-align:center;">' . $type . '</td>
                            <td style="width: 15%;text-align:center;">' . $style . '</td>
                            <td style="background: ' . $color . ';width: 15%;text-align:center;"><span style="color: #FFFFFF;"><b>' . $score_team . '/' . $score_adv . '</b></span></td>
                            <td style="width: 10%;text-align:center;"><a href="index.php?file=Wars&amp;op=detail&amp;war_id=' . $war_id . '"><img style="border: 0;" src="' . $img . '" alt="" /></a></td></tr>';
                }
                echo '</table>';

                if ($count > 10){
                    echo '<div style="text-align: right;"><a href="index.php?file=Wars&amp;tid=' . $team . '">' . _MORE . '</a></div>';
                }
                $j = 0;
            }
        }
        else{
            $nb_wars = $nuked['max_wars'];

            if (!$_REQUEST['p']) $_REQUEST['p'] = 1;

            $start = $_REQUEST['p'] * $nb_wars - $nb_wars;

            if (!$_REQUEST['tid'] && $team > 0){
                $_REQUEST['tid'] = $team;
            }

            $and = '';

            if ($_REQUEST['tid'] != ''){
                $sql6 = nkDB_execute('SELECT titre FROM ' . TEAM_TABLE . ' WHERE cid = \'' . $_REQUEST['tid'] . '\' ');
                list($team_name, $team) = nkDB_fetchArray($sql6);
                $team_name = printSecuTags($team_name);
                $and = 'AND team = \'' . $_REQUEST['tid'] . '\' ';
                $sql7 = nkDB_execute('SELECT warid FROM ' . WARS_TABLE . ' WHERE etat = 1 AND team = \'' . $_REQUEST['tid'] . '\' ');
                $count = nkDB_numRows($sql7);
            }
            else{
                $team_name = $nuked['name'];
                $and = '';
                $count = $nb_matchs;
            }

            echo '<br /><div style="text-align: center;"><big><b>' . _MATCHES . ' - ' . $team_name . '</b></big></div>';

            if (!$_REQUEST['orderby']){
                $_REQUEST['orderby'] = 'date';
            }

            if ($_REQUEST['orderby'] == 'date'){
                $order = 'ORDER BY date_an DESC, date_mois DESC, date_jour DESC';
            }
            else if ($_REQUEST['orderby'] == 'adver'){
                $order = 'ORDER BY adversaire';
            }
            else if ($_REQUEST['orderby'] == 'game'){
                $order = 'ORDER BY game';
            }
            else if ($_REQUEST['orderby'] == 'type'){
                $order = 'ORDER BY type';
            }
            else if ($_REQUEST['orderby'] == 'style'){
                $order = 'ORDER BY style';
            }
            else{
                $order = 'ORDER BY date_an DESC, date_mois DESC, date_jour DESC';
            }

            if ($count > 1){
                echo '<br /><table width="100%"><tr><td style="text-align:right;">' . _ORDERBY . ' : </b>';

                if ($_REQUEST['orderby'] == 'date'){
                    echo '<b>' . _DATE . '</b> | ';
                }
                else{
                    echo '<a href="index.php?file=Wars&amp;tid=' . $_REQUEST['tid'] . '&amp;orderby=date">' . _DATE . '</a> | ';
                }

                if ($_REQUEST['orderby'] == 'adver'){
                    echo '<b>' . _OPPONENT . '</b> | ';
                }
                else{
                    echo '<a href="index.php?file=Wars&amp;tid=' . $_REQUEST['tid'] . '&amp;orderby=adver">' . _OPPONENT . '</a> | ';
                }

                if ($_REQUEST['orderby'] == 'game'){
                    echo '<b>' . _GAME . '</b> | ';
                }
                else{
                    echo '<a href="index.php?file=Wars&amp;tid=' . $_REQUEST['tid'] . '&amp;orderby=game">' . _GAME . '</a> | ';
                }

                if ($_REQUEST['orderby'] == 'type'){
                    echo '<b>' . _TYPE . '</b> | ';
                }
                else{
                    echo '<a href="index.php?file=Wars&amp;tid=' . $_REQUEST['tid'] . '&amp;orderby=type">' . _TYPE . '</a> | ';
                }

                if ($_REQUEST['orderby'] == 'style'){
                    echo '<b>' . _STYLE . '</b>';
                }
                else{
                    echo '<a href="index.php?file=Wars&amp;tid=' . $_REQUEST['tid'] . '&amp;orderby=style">' . _STYLE . '</a>';
                }

                echo '</td></tr></table>';
            }

            if ($count > $nb_wars){
                $url_page = 'index.php?file=Wars&amp;tid=' . $_REQUEST['tid'] . '&amp;orderby=' . $_REQUEST['orderby'];
                number($count, $nb_wars, $url_page);
            }

            echo '<table style="margin-left: auto;margin-right: auto;text-align: left;background: ' . $bgcolor2 . ';border: 1px solid ' . $bgcolor3 . ';" width="100%" cellpadding="2" cellspacing="1">
            <tr style="background: ' . $bgcolor3 . '">
            <td style="width: 5%;">&nbsp;</td>
            <td style="width: 10%;"><b>' . _DATE . '</b></td>
            <td style="width: 30%;text-align:center;"><b>' . _OPPONENT . '</b></td>
            <td style="width: 15%;text-align:center;"><b>' . _TYPE . '</b></td>
            <td style="width: 15%;text-align:center;"><b>' . _STYLE . '</b></td>
            <td style="width: 15%;text-align:center;"><b>' . _RESULT . '</b></td>
            <td style="width: 10%;text-align:center;"><b>' . _DETAILS . '</b></td></tr>';

            $sql4 = nkDB_execute('SELECT warid, adversaire, url_adv, pays_adv, type, style, game, date_jour, date_mois, date_an, tscore_team, tscore_adv FROM ' . WARS_TABLE . ' WHERE etat = 1 ' . $and . $order . ' LIMIT ' . $start . ',' . $nb_wars.' ');
            while (list($war_id, $adv_name, $adv_url, $pays_adv, $type, $style, $game, $jour, $mois, $an, $score_team, $score_adv) = nkDB_fetchArray($sql4)){
                $adv_name = printSecuTags($adv_name);
                $type = printSecuTags($type);
                $style = printSecuTags($style);

                list ($pays, $ext) = explode ('.', $pays_adv);

                if ($language == 'french'){
                    $date = $jour . '/' . $mois . '/' . $an;
                }
                else{
                    $date = $mois . '/' . $jour . '/' . $an;
                }

                if ($score_team > $score_adv){
                    $color = '#009900';
                }
                else if ($score_team < $score_adv){
                    $color = '#990000';
                }
                else{
                    $color = '#3333FF';
                }

                if ($j == 0){
                    $bg = $bgcolor2;
                    $j++;
                }
                else{
                    $bg = $bgcolor1;
                    $j = 0;
                }

                $sql5 = nkDB_execute('SELECT name, icon FROM ' . GAMES_TABLE . ' WHERE id = \'' . $game . '\' ');
                list($game_name, $icon) = nkDB_fetchArray($sql5);
                $game_name = printSecuTags($game_name);

                if ($icon != '' && is_file($icon)){
                    $icone = $icon;
                }
                else{
                    $icone = 'images/games/icon_nk.png';
                }

                echo '<tr style="background: '. $bg . '">
                        <td style="width: 5%;">&nbsp;<img src="' . $icone . '" alt="" title="' . $game_name . '" /></td>
                        <td style="width: 10%;">' . $date . '</td>
                        <td style="width: 30%;"><img src="images/flags/' . $pays_adv . '" alt="" title="' . $pays . '" />';

                if ($adv_url != ''){
                    echo '<a href="' . $adv_url . '" onclick="window.open(this.href); return false;">' . $adv_name . '</a>';
                }
                else{
                    echo $adv_name;
                }

                if (is_file('themes/' . $theme . '/images/report.png')){
                    $img = 'themes/' . $theme . '/images/report.png';
                }
                else{
                    $img = 'modules/Wars/images/report.png';
                }

                echo '</td><td style="width: 15%;text-align:center;">' . $type . '</td>
                <td style="width: 15%;text-align:center;">' . $style . '</td>
                <td style="background: ' . $color . ';width: 15%;text-align:center;"><span style="color: #FFFFFF;"><b>' . $score_team . '/' . $score_adv . '</b></span></td>
                <td style="width: 10%;text-align:center;"><a href="index.php?file=Wars&amp;op=detail&amp;war_id=' . $war_id . '"><img style="border: 0;" src="' . $img . '" alt="" /></a></td></tr>';
            }

            echo '</table>';

            if ($count > $nb_wars){
                $url_page = 'index.php?file=Wars&amp;tid=' . $_REQUEST['tid'] . '&amp;orderby=' . $_REQUEST['orderby'];
                number($count, $nb_wars, $url_page);
            }
        }
    }

    if ($nb_matchs > 0){
        if ($nb_matchs > 1) $war = _MATCHES; else $war = _MATCH;
        echo '<br /><div style="text-align: center;"><small><b>' . $nb_matchs . '</b> ' . $war . ' : <b><span style="color: #009900;">' . $nb_victory . '</span></b> ' . _WIN . ' - <b><span style="color: #990000;">' . $nb_defeat . '</span></b> ' . _LOST . ' - <b><span style="color: #3333FF;">' . $nb_nul . '</span></b> ' . _DRAW . '</small></div><br />';
    }

    if (array_key_exists('p', $_REQUEST) && $_REQUEST['p'] == 1 OR !array_key_exists('p', $_REQUEST)){
        $sqlx = nkDB_execute("SELECT warid FROM " . WARS_TABLE . " WHERE etat = 0");
        $nb_matchs2 = nkDB_numRows($sqlx);

        if ($nb_matchs2 > 0){
            echo '<br /><div style="text-align: center;"><big><b>' . _NEXTMATCHES . '</b></big></div><br />';

            echo '<table style="margin-left: auto;margin-right: auto;text-align: left;background: ' . $bgcolor2 . ';border: 1px solid ' . $bgcolor3 . ';" width="100%" cellpadding="2" cellspacing="1">
                    <tr style="background: ' . $bgcolor3 . '">
                    <td style="width: 5%;">&nbsp;</td>
                    <td style="width: 10%;"><b>' . _DATE . '</b></td>
                    <td style="width: 30%;text-align:center;"><b>' . _OPPONENT . '</b></td>
                    <td style="width: 20%;text-align:center;"><b>' . _TYPE . '</b></td>
                    <td style="width: 20%;text-align:center;"><b>' . _STYLE . '</b></td>
                    <td style="width: 15%;text-align:center;"><b>' . _DETAILS2 . '</b></td>';

            $sql4x = nkDB_execute('SELECT warid, adversaire, url_adv, pays_adv, type, style, game, date_jour, date_mois, date_an, tscore_team, tscore_adv FROM ' . WARS_TABLE . ' WHERE etat = 0  LIMIT ' . $start . ',' . $nb_wars.' ');
            $j = 0;
            while (list($war_id, $adv_name, $adv_url, $pays_adv, $type, $style, $game, $jour, $mois, $an, $score_team, $score_adv) = nkDB_fetchArray($sql4x)){
                $adv_name = printSecuTags($adv_name);
                $type = printSecuTags($type);
                $style = printSecuTags($style);

                list ($pays, $ext) = explode ('.', $pays_adv);

                if ($language == 'french'){
                    $date = $jour . '/' . $mois . '/' . $an;
                }
                else{
                    $date = $mois . '/' . $jour . '/' . $an;
                }

                if ($score_team > $score_adv){
                    $color = '#009900';
                }
                else if ($score_team < $score_adv){
                    $color = '#990000';
                }
                else{
                    $color = '#3333FF';
                }

                if ($j == 0){
                    $bg = $bgcolor2;
                    $j++;
                }
                else{
                    $bg = $bgcolor1;
                    $j = 0;
                }

                $sql5 = nkDB_execute('SELECT name, icon FROM ' . GAMES_TABLE . ' WHERE id = \'' . $game . '\' ');
                list($game_name, $icon) = nkDB_fetchArray($sql5);
                $game_name = printSecuTags($game_name);

                if ($icon != '' && is_file($icon)){
                    $icone = $icon;
                }
                else{
                    $icone = 'images/games/icon_nk.png';
                }

                echo '<tr style="background: '. $bg . '">
                        <td style="width: 5%;">&nbsp;<img src="' . $icone . '" alt="" title="' . $game_name . '" /></td>
                        <td style="width: 10%;">' . $date . '</td>
                        <td style="width: 30%;"><img src="images/flags/' . $pays_adv . '" alt="" title="' . $pays . '" />';

                if ($adv_url != ''){
                    echo '<a href="' . $adv_url . '" onclick="window.open(this.href); return false;">' . $adv_name . '</a>';
                }
                else{
                    echo $adv_name;
                }

                if (is_file('themes/' . $theme . '/images/report.png')){
                    $img = 'themes/' . $theme . '/images/report.png';
                }
                else{
                    $img = 'modules/Wars/images/report.png';
                }

                echo '</td><td style="width: 20%;text-align:center;">' . $type . '</td>
                        <td style="width: 20%;text-align:center;">' . $style . '</td>
                        <td style="width: 15%;text-align:center;"><a href="index.php?file=Wars&amp;op=detail&amp;war_id=' . $war_id . '"><img style="border: 0;" src="' . $img . '" alt="" /></a></td>';
            }
            echo '</table>';
        }
    }
    closetable();
}

function detail($war_id){
    global $nuked, $user, $visiteur, $language, $bgcolor1, $bgcolor2, $bgcolor3;

    opentable();

    # include css and js library shadowbox
    nkTemplate_addCSSFile('media/shadowbox/shadowbox.css');
    nkTemplate_addJSFile('media/shadowbox/shadowbox.js');
    nkTemplate_addJS('Shadowbox.init();');

    $sql = nkDB_execute('SELECT team, adversaire, url_adv, pays_adv, date_jour, date_mois, date_an, type, style, tscore_team, tscore_adv, map, score_adv, score_team, report, auteur, url_league, etat FROM ' . WARS_TABLE . ' WHERE warid = \'' . $war_id . '\' ');

    if(nkDB_numRows($sql) <= 0)
        redirect('index.php?file=404');

    list($team, $adv_name, $adv_url, $pays_adv, $jour, $mois, $an, $type, $style, $tscore_team, $tscore_adv, $map, $score_team, $score_adv, $report, $auteur, $url_league, $etat) = nkDB_fetchArray($sql);
    list ($pays, $ext) = explode ('.', $pays_adv);

    $adv_name = printSecuTags($adv_name);
    $type = printSecuTags($type);
    $style = printSecuTags($style);
    $score_adv = printSecuTags($score_adv);
    $score_team = printSecuTags($score_team);
    $map = explode('|', $map);;
    $score_team = explode('|', $score_team);;
    $score_adv = explode('|', $score_adv);;

    if ($language == 'french'){
        $date = $jour . '/' . $mois . '/' . $an;
    }
    else{
        $date = $mois . '/' . $jour. '/' . $an;
    }

    if ($team > 0){
        $sql_team = nkDB_execute('SELECT titre FROM ' . TEAM_TABLE . ' WHERE cid = \'' . $team . '\' ');
        list($team_name) = nkDB_fetchArray($sql_team);
        $team_name = printSecuTags($team_name);
    }
    else{
        $team_name = $nuked['name'];
    }

    if ($visiteur >= admin_mod('Wars')){
        ?>
        <script type="text/javascript">
        function delmatch(adversaire, id){
            if (confirm('<?php echo _DELETEMATCH; ?>'+adversaire+' ! <?php echo _CONFIRM; ?>')){
                document.location.href = 'index.php?file=Wars&page=admin&op=del_war&war_id='+id;
            }
        }
        </script>
        <?php

        echo '<div style="text-align: right;"><a href="index.php?file=Wars&amp;page=admin&amp;op=match&amp;do=edit&amp;war_id=' . $war_id . '"><img style="border: 0;" src="images/edition.gif" alt="" title="' . _EDIT . '" /></a>
                &nbsp;<a href="javascript:delmatch(\''. addslashes($adv_name) . '\', \'' . $war_id . '\');"><img style="border: 0;" src="images/delete.gif" alt="" title="' . _DEL . '" /></a>&nbsp;</div>';
    }

    echo '<br /><table style="margin-left: auto;margin-right: auto;text-align: left;background: ' . $bgcolor2 . ';" width="90%" border="0" cellpadding="3" cellspacing="3">
            <tr><td style="background: ' . $bgcolor2 . ';border: 1px solid ' . $bgcolor3 . ';text-align:center;" colspan="2"><big><b>' . $team_name . '</b> ' . _VS . ' <b>' . $adv_name . '</b></big></td></tr>
            <tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';"><b>' . _OPPONENT . '</b> :&nbsp;';

    if ($adv_url != ''){
        echo '<a href="' . $adv_url . '" onclick="window.open(this.href); return false;">' . $adv_name . '</a>';
    }
    else{
        echo $adv_name;
    }

    echo '&nbsp;<img src="images/flags/' . $pays_adv . '" alt="" title="' . $pays . '" /></td></tr>
            <tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';"><b>' . _DATE . '</b> : ' . $date . '</td></tr>
            <tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';"><b>' . _TYPE . '</b> : ' . $type . '</td></tr>
            <tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';"><b>' . _STYLE . '</b> : ' . $style . '</td></tr>
            <tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';"><b>' . _MAPS . '</b> :<br/><br/>';

    $size = count($map);

    for ($nbr=1; $nbr <= $size; $nbr++){
        echo '<br /><u>Map n&deg; ' . $nbr . ' :</u> ' . $map[$nbr-1];
        if ($etat != 0){
            echo '<br />' . _SCORE . ' : ';
            if ($score_team[$nbr-1] < $score_adv[$nbr-1]){
                echo '&nbsp;<span style="color: #990000;"><b>' . $score_adv[$nbr-1] . '</b></span> - <span style="color: #009900;"><b>' . $score_team[$nbr-1] . '</b></span><br />';
            }
            else if ($score_team[$nbr-1] > $score_adv[$nbr-1]){
                echo '&nbsp;<span style="color: #009900;"><b>' . $score_adv[$nbr-1] . '</b></span> - <span style="color: #990000;"><b>' . $score_team[$nbr-1] . '</b></span><br />';
            }
            else{
                echo '&nbsp;<b>' . $score_team[$nbr-1] . ' - ' . $score_adv[$nbr-1] . '</b><br />';
            }
        }
    }


    if($etat != 0){
        echo '</td></tr><tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';"><b>' . _RESULT . '</b> :';

        if ($tscore_team < $tscore_adv){
            echo '&nbsp;<span style="color: #990000;"><b>' . $tscore_team . '</b></span> - <span style="color: #009900;"><b>' . $tscore_adv . '</b></span></td></tr>';
        }
        else if ($tscore_team > $tscore_adv){
            echo '&nbsp;<span style="color: #009900;"><b>' . $tscore_team . '</b></span> - <span style="color: #990000;"><b>' . $tscore_adv . '</b></span></td></tr>';
        }
        else{
            echo '&nbsp;<b>' . $tscore_team . ' - ' . $tscore_adv . '</b></td></tr>';
        }
    }

    echo '<tr style="background: ' . $bgcolor2 . ';"><td>&nbsp;</td></tr>';

    if ($report != ''){
        if ($etat == 0) $xtitle = _DETAILS2 . ' ' . _WFROM; else $xtitle = _REPORTBY;

        echo '<tr><td style="background: ' . $bgcolor2 . ';border: 1px dashed ' . $bgcolor3 . ';"><b>' . $xtitle . ' <a href="index.php?file=Members&amp;op=detail&amp;autor=' . urlencode($auteur) . '">' . $auteur . '</a> : </b></td></tr>
                <tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';">' . $report;

        if ($url_league != '' AND $etat != 0){
            echo '<br /><br /><a href="' . $url_league . '" onclick="window.open(this.href); return false;"><i>' . _OFFICIALREPORT . '</i></a>';
        }

        echo '</td></tr><tr style="background: ' . $bgcolor2 . ';"><td>&nbsp;</td></tr>';
    }

    $sql_screen = nkDB_execute('SELECT url FROM ' . WARS_FILES_TABLE . ' WHERE module = \'Wars\' AND type = \'screen\' AND im_id = \'' . $war_id . '\' ');
    $nb_screen = nkDB_numRows($sql_screen);

    if ($nb_screen > 0){
        echo '<tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';">';

        while (list($url) = nkDB_fetchArray($sql_screen)){
            echo '<a href="' . $url . '" rel="shadowbox"><img src="' . $url . '" alt="" style="max-width:150px;max-height:150px;margin:10px" /></a>';
        }

        echo '</td></tr><tr style="background: ' . $bgcolor2 . ';"><td>&nbsp;</td></tr>';
    }

    $sql_demo = nkDB_execute('SELECT url FROM ' . WARS_FILES_TABLE . ' WHERE module = \'Wars\' AND type = \'demo\' AND im_id = \'' . $war_id . '\' ');
    $nb_demo = nkDB_numRows($sql_demo);

    if ($nb_demo > 0){
        $l = 1;
        echo '<tr style="background: ' . $bgcolor2 . ';"><td><table style="text-align:center;">';

        while (list($url) = nkDB_fetchArray($sql_demo)){
            if ($nb_demo > 1){
                $demos = $l . '/' . $nb_demo;
            }
            else{
                $demos = '';
            }

            $l++;
            echo '<tr><td><img src="modules/Wars/images/demo.png" alt="" /></td><td><a href="' . $url . '" onclick="window.open(this.href); return false;">' . _DOWNLOADDEMO . ' ' . $demos . '</a></td></tr>';
        }

        echo '</table></td></tr>';
    }

    echo '</table><br />';

    $sql = nkDB_execute(
        'SELECT active
        FROM '. COMMENT_MODULES_TABLE .'
        WHERE module = \'wars\''
    );

    list($active) = nkDB_fetchArray($sql);

    if($active ==1 && $visiteur >= nivo_mod('Comment') && nivo_mod('Comment') > -1){
    echo '<table style="margin-left: auto;margin-right: auto;text-align: left;" width="80%" border="0" cellspacing="3" cellpadding="3"><tr style="background: ' . $bgcolor1 . ';"><td style="border: 1px dashed ' . $bgcolor3 . ';">';

        include_once 'modules/Comment/index.php';
        com_index('match', $war_id);

        echo '</td></tr></table>';
    }
    closetable();
}

switch ($GLOBALS['op']){
    case 'index':
        index();
        break;

    case 'detail':
        detail($_REQUEST['war_id']);
        break;

    default:
        index();
        break;
}

?>
