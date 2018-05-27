<?php
/**
 * index.php
 *
 * Frontend of Comment module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2013 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

global $language;

translate('modules/Comment/lang/'. $language .'.lang.php');


/**
 * Check if parent Id of module exist.
 *
 * @param string $module : The name of parent module.
 * @param int $imId : The parent Id of module.
 * @return bool
 */
function checkCommentStatus($module, $imId) {
    if (! empty($module) && preg_match('/^[A-Za-z_]+$/', $module)) {
        if ($module == 'match') $module = 'Wars';

        $tableConstName = strtoupper($module) .'_TABLE';

        if (defined($tableConstName .'_ID'))
            $tableIdName = constant($tableConstName .'_ID');
        else
            $tableIdName = 'id';

        $nbComment = nkDB_totalNumRows(
            'FROM '. nkDB_quote(constant($tableConstName), true) .'
            WHERE '. nkDB_quote($tableIdName, true) .' = '. intval($imId)
        );

        return ($nbComment > 0);
    }

    return false;
}

function NbComment($im_id, $module){
    $im_id = nkDB_realEscapeString(stripslashes($im_id));
    $module = nkDB_realEscapeString(stripslashes($module));
    $Sql = nkDB_execute("SELECT id FROM ".COMMENT_TABLE." WHERE im_id = '$im_id' AND module = '$module'");
    return nkDB_numRows($Sql);
}

function com_index($module, $im_id){
    global $file, $user, $bgcolor1, $bgcolor2, $bgcolor3, $nuked, $visiteur, $language;

    // TODO : Use $GLOBALS['file'] or $module ?
    if (! checkCommentStatus($file, $im_id)) return;

    $captcha = initCaptcha();

    define('EDITOR_CHECK', 1);
    ?>
    <script type="text/javascript">
    //<![CDATA[
        function sent(pseudo, module, im_id, ctToken, ctScript, ctEmail) {
            <?php
                if ($captcha) {
                    echo 'var captchaData = "&ct_token="+ctToken+"&ct_script="+ctScript+"&ct_email="+ctEmail;';
                }
                else{
                    echo 'var captchaData = "";';
                }

                switch ($nuked['editor_type'])
                {
                    case 'cke':
                        echo '
                            var editor_val = CKEDITOR.instances.e_basic.document.getBody().getChild(0).getText().trim();
                            var editor_txt = CKEDITOR.instances.e_basic.getData();
                        ';
                        break;
                    case 'tiny':
                    default:
                        echo '
                            var editor_txt = tinyMCE.activeEditor.getContent();
                            var editor_val = editor_txt.replace(/(<([^>]+)>)/ig,"").trim();
                        ';
                        break;
                }
            ?>
            if(editor_val == ''){
                alert('<?php echo _NOTEXT; ?>');
                return false;
            }
            else if(pseudo == ''){
                alert('<?php echo _NONICK; ?>');
                return false;
            }
            else{
                var OAjax;
                if (window.XMLHttpRequest) OAjax = new XMLHttpRequest();
                else if (window.ActiveXObject) OAjax = new ActiveXObject('Microsoft.XMLHTTP');
                OAjax.open('POST',"index.php?file=Comment&op=post_comment",true);
                OAjax.onreadystatechange = function(){
                    if (OAjax.readyState == 4 && OAjax.status==200){
                        if (document.getElementById){
                            document.getElementById("message").innerHTML = '<div class="nkAlert" id="nkAlertSuccess"><strong><?php echo _THXCOM; ?></strong></div>';
                            setTimeout(function(){
                                document.location.reload();
                            }, 2500);
                        }
                    }
                }
                OAjax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                OAjax.send("texte="+encodeURIComponent(editor_txt)+"&pseudo="+pseudo+"&module="+module+"&im_id="+im_id+"&ajax=1"+captchaData);
                return true;
            }
            return false;
        }
    //]]>
    </script>
    <?php
    $level_access = nivo_mod("Comment");
    $level_admin = admin_mod("Comment");
    $NbComment = NbComment($im_id, $module);

    echo '<h3 style="text-align: center">' . _LAST4COMS . '</h3>
    <table style="background:'.$bgcolor3.';margin:5px" width="98%" cellpadding="3" cellspacing="1">
        <tr style="background:'.$bgcolor3.';">
            <td style="width:30%;text-align:center"><b>'.__('AUTHOR').'</b></td>
            <td style="width:70%;text-align:center"><b>'._COMMENT.'</b></td>
        </tr>';

    $sql = nkDB_execute("SELECT id, titre, comment, autor, autor_id, date, autor_ip FROM ".COMMENT_TABLE." WHERE im_id = '$im_id' AND module = '$module' ORDER BY id DESC LIMIT 0, 4");
    $count = nkDB_numRows($sql);
    $j = 0;
    while($row = nkDB_fetchAssoc($sql)){
        $test = 0;
        $row['date']  = nkDate($row['date']);
        $row['titre'] = nkHtmlEntities($row['titre']);
        $row['titre'] = nk_CSS($row['titre']);
        $row['autor'] = nk_CSS($row['autor']);
        $texte = (!empty($row['titre'])) ? '<b>'.$row['titre'].'</b><br /><br />'.$row['comment'] : $row['comment'];

        if(!empty($row['autor_id'])){
            $sql_member = nkDB_execute("SELECT pseudo, avatar, country FROM ".USER_TABLE." WHERE id = '{$row['autor_id']}'");
            $test = nkDB_numRows($sql_member);
        }

        if(!empty($row['autor_id']) && $test > 0) list($autor, $avatar, $country) = nkDB_fetchArray($sql_member);
        else $autor = $row['autor'];

        if(empty($avatar)) $avatar = "modules/Comment/images/noavatar.png";
        if(empty($country)) $country = "France.gif";

        if($j == 0){$bg = $bgcolor2; $j++;}
        else{$bg = $bgcolor1; $j = 0;}

        if ($visiteur >= $level_admin && $level_admin > -1){

            echo '<script type="text/javascript">function delmess(pseudo, id){if(confirm(\''._DELCOMMENT.' \'+pseudo+\' ! '._CONFIRM.'\')){document.location.href = \'index.php?file=Comment&page=admin&op=del_com&cid=\'+id;}}</script>';

            $admin = '<a class="nkButton icon alone small edit" href="index.php?file=Comment&amp;page=admin&amp;op=edit_com&amp;cid='.$row['id'].'" title="'._EDITTHISCOM.'"></a><a class="nkButton icon alone small remove danger" href="javascript:delmess(\'' . addslashes($autor) . '\', \''.$row['id'].'\');" title="'._DELTHISCOM.'"></a>';

        }else $admin = '';

        echo '<tr style="background:'.$bg.';">
                <td style="width:30%;" valign="top"><img src="images/flags/'.$country.'" alt="'.$country.'" />&nbsp;<b>'.$autor.'</b>';

                if ($visiteur >= $level_admin && $level_admin > -1) echo '<br />Ip : '.$row['autor_ip'];

                echo '<br /><br /><img src="'.$avatar.'" style="max-width: 100px; max-height: 100px;" alt="" />';

                $profil = ($row['autor_id'] != '') ? '<a class="nkButton icon alone small user" href="index.php?file=Members&amp;op=detail&amp;autor='.urlencode($autor).'"></a>' : '';

        echo '  </td>
                <td style="width:70%;" valign="top">
                    <img src="images/posticon.gif" alt="" /><small> '._POSTED.' : '.$row['date'].'</small>
                    <br /><br />'.$texte.'<br /><br />
                </td>
                </tr>
                <tr style="background:'.$bg.';">
                    <td style="width:30%;">&nbsp;</td>
                <td colspan="2"><div class="nkButton-group">'.$profil . $admin.'</div><br /></td>
                </tr>';
        unset($avatar, $autor, $country);
    }

    if ($count == "0") echo '<tr style="background:'.$bgcolor2.';"><td align="center" colspan="2">'._NOCOMMENT.'</td></tr>';

    echo '</table>';

    if ($count >= 0){
        echo '<div style="text-align:center;padding:10px 10px 0 0"><b>'._COMMENTS.' :</b>&nbsp;'.$NbComment.'&nbsp;';

        if ($visiteur >= $level_access && $level_access > -1){
            echo '<br />[ <a href="#" onclick="javascript:window.open(\'index.php?file=Comment&amp;op=view_com&amp;im_id='.$im_id.'&amp;module='.$module.'\',\'popup\',\'toolbar=0,location=0,directories=0,status=0,scrollbars=1,resizable=0,copyhistory=0,menuBar=0,width=600,height=480,top=100,left=100\');return(false)">'._VIEWCOMMENT.'</a> ]';
        }
        echo '</div>';
    }

    if ($captcha) {
        $Soumission = 'sent(this.compseudo.value, this.module.value, this.imid.value, this.ct_token.value, this.ct_script.value, this.ct_email.value);return false;';
    }
    else {
        $Soumission = 'sent(this.compseudo.value, this.module.value, this.imid.value);return false;';
    }

    echo '<div id="message">
            <form id="post_commentary" method="post" onsubmit="javascript:return '.$Soumission.'" action="#post_commentary">
            <table width="100%" cellspacing="5" cellpadding="0" border="0" style="padding-top:15px">';
            if($user) echo '<tr style="display: none"><td colspan="2"><input id="compseudo" type="hidden" name="pseudo" value="'.$user[2].'" /></td></tr>';
            else {
                echo '<tr>
                    <td style="padding-left:5px;width:30%"><b>'._NICK.' :</b></td>
                    <td><input id="compseudo" type="text" size="30" name="pseudo" maxlength="30" /></td>
                </tr>';
            }
                echo '<tr>
                    <td colspan="2" align="center" style="padding-top: 10px"><textarea id="e_basic" name="comtexte" cols="40" rows="3"></textarea></td>
                    </tr>
                    <tr>
                    <td colspan="2" align="center">';

                if ($captcha) echo create_captcha();

    echo '        <tr>
                    <td colspan="2" align="center">
                        <input type="hidden" id="imid" name="im_id" value="'.$im_id.'" />
                        <input type="hidden" id="module" name="module" value="'.$module.'" />
                        <input type="submit" value="'._SEND_COM.'" />
                    </td>
                </tr>
            </table>
            </form>
            </div>';
}

function view_com($module, $im_id){
    global $bgcolor3, $language, $visiteur;

    $module = stripslashes($module);

    nkTemplate_setPageDesign('nudePage');
    nkTemplate_setTitle(_COMMENTS);

    if (! checkCommentStatus($module, $im_id)) return;

    if ($language == "french" && strpos("WIN", PHP_OS)) setlocale (LC_TIME, "french");
    else if ($language == "french" && strpos("BSD", PHP_OS)) setlocale (LC_TIME, "fr_FR.ISO8859-1");
    else if ($language == "french") setlocale (LC_TIME, "fr_FR");
    else setlocale (LC_TIME, $language);

    $level_access = nivo_mod("Comment");
    $level_admin = admin_mod("Comment");
    $module = nkDB_realEscapeString($module);

    echo '<script type="text/javascript">function delmess(autor, id){if (confirm(\''._DELCOMMENT.' \'+autor+\' ! '._CONFIRM.'\')){document.location.href = \'index.php?file=Comment&op=del_comment&cid=\'+id;}}</script>';

    $sql = nkDB_execute("SELECT id, titre, comment, autor, autor_id, date, autor_ip FROM ".COMMENT_TABLE." WHERE im_id = '$im_id' AND module = '$module' ORDER BY id DESC");
    if (nkDB_numRows($sql) != 0){

        while($row = nkDB_fetchAssoc($sql)):

            $row['date'] = nkDate($row['date']);
            $row['titre'] = nkHtmlEntities($row['titre']);
            $row['titre'] = nk_CSS($row['titre']);
            $row['autor'] = nk_CSS($row['autor']);

            if(!empty($row['autor_id'])){
                $sql_member = mysql_query("SELECT pseudo FROM ".USER_TABLE." WHERE id ='{$row['autor_id']}'");
                $test = mysql_num_rows($sql_member);
            }

            if(!empty($row['autor_id']) && $test > 0){
                list($author) = mysql_fetch_array($sql_member);
                $autor = '<a href="index.php?file=Members&amp;op=detail&amp;autor='.urlencode($author).'" onclick="window.open(this.href);return false;">'.$author.'</a>';
            }else $autor = $row['autor'];

            echo '<table style="width:90%;margin:0px auto;" cellspacing="0" cellpadding="0"><tr><td style="width:90%;"><b>'.$titre.'</b>';

            if ($visiteur >= $level_admin && $level_admin > -1){
                echo '&nbsp;('.$row['autor_ip'].') <a href="index.php?file=Comment&amp;op=edit_comment&amp;cid='.$row['id'].'"><img style="border:none;" src="images/edit.gif" alt="" title="'._EDITTHISCOM.'" /></a><a href="javascript:delmess(\''.nkDB_realEscapeString($row['autor']).'\', \''.$row['id'].'\');"><img style="border:none;" src="images/del.gif" alt="" title="'._DELTHISCOM.'"></a>';
            }

            echo '</td></tr><tr><td><img src="images/posticon.gif" alt="" />&nbsp;'._POSTEDBY.'&nbsp;'.$autor.'&nbsp;'._THE.'&nbsp;'.$row['date'].'<br /><br />'.$row['comment'].'<br /><hr style="height:1px;color:'.$bgcolor3.';" /></td></tr></table>';

        endwhile;

    }else{
        echo '<div style="text-align:center;"><br /><br />'._NOCOMMENT.'<br /></div>';
    }

    if ($visiteur >= $level_access && $level_access > -1){
        echo '<div style="text-align:center;"><br /><input type="button" value="'._POSTCOMMENT.'" onclick="document.location=\'index.php?file=Comment&amp;op=post_com&amp;im_id='.$im_id.'&amp;module='.$module.'\'" /></div>';
    }

    echo '<div style="text-align:center;"><br />[ <a href="#" onclick="javascript:window.close();"><b>'. __('CLOSE_WINDOW') .'</b></a> ]</div>';
}

function post_com($module, $im_id){
    global $user, $bgcolor4, $language, $visiteur;

    $module = stripslashes($module);

    nkTemplate_setPageDesign('nudePage');
    nkTemplate_setTitle(_POSTCOMMENT);

    if (! checkCommentStatus($module, $im_id)) return;

    define('EDITOR_CHECK', 1);

    $level_access = nivo_mod("Comment");

    if($visiteur >= $level_access && $level_access > -1){

    echo "<script type=\"text/javascript\">\n"
            ."<!--\n"
            . "\n"
            . "function trim(string)\n"
            . "{"
            . "return string.replace(/(^\s*)|(\s*$)/g,'');"
            . "}\n"
            . "\n"
            . "if (trim(document.getElementById('com_pseudo').value) == \"\")\n"
            . "{\n"
            . "alert('" . _NONICK . "');\n"
            . "return false;\n"
            . "}\n"
            . "return true;\n"
            . "}\n"
            . "\n"
            . "// -->\n"
            . "</script>\n";

    echo "<form method=\"post\" action=\"index.php?file=Comment&op=post_comment\" return verifchamps();\">\n"
            . "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"0\">\n"
            . "<tr><td><b>" . _TITLE . " :</b> <input type=\"text\" name=\"titre\" size=\"40\" maxlength=\"40\" /><br /><br /></td></tr>\n"
            . "<tr><td><b>" . _MESSAGE . " :</b><br />"
            . "<textarea id=\"e_basic\" name=\"texte\" cols=\"40\" rows=\"10\"></textarea></td></tr>\n"
            . "<tr><td><b>" . _NICK . " :</b>";

    if ($user){
        echo "&nbsp;&nbsp;<b>" . $user[2] . "</b><input id=\"com_pseudo\" type=\"hidden\" name=\"pseudo\" value=\"" . $user[2] . "\" /></td>\n";
    }
    else{
        echo "<input id=\"com_pseudo\" type=\"text\" size=\"30\" name=\"pseudo\" maxlength=\"30\" /></td>\n";
    }

    echo "</tr>";

    if (initCaptcha()) echo create_captcha();

    echo "<tr><td align=\"right\" colspan=\"2\">\n"
            . "<input type=\"hidden\" name=\"im_id\" value=\"" . $im_id . "\" />\n"
            . "<input type=\"hidden\" name=\"module\" value=\"" . $module . "\" />\n"
            . "</td></tr></table><div style=\"text-align: center;\"><input type=\"submit\" value=\"" . __('SEND') . "\" /><br /></div></form>";

    nkTemplate_addJSFile('media/ckeditor/ckeditor.js');

    echo '<script type="text/javascript">',"\n"
            , '//<![CDATA[',"\n";
    echo ConfigSmileyCkeditor().'',"\n";
    echo ' CKEDITOR.replace( \'e_basic\',',"\n"
            , '    {',"\n"
            , '        toolbar : \'Basic\',',"\n"
            , '        language : \'' . substr($language, 0,2) . '\',',"\n";
    if(!empty($bgcolor4)) echo '        uiColor : \'' . $bgcolor4 . '\'',"\n";
    echo '    });',"\n"
            , '//]]>',"\n"
            , '</script>',"\n";

    }
    else{
        echo applyTemplate('nkAlert/noEntrance');
    }
}

function post_comment($im_id, $module, $titre, $texte, $pseudo) {
    global $user, $nuked, $user_ip, $visiteur;

    $module = stripslashes($module);

    nkTemplate_setPageDesign('nudePage');
    nkTemplate_setTitle(_POSTCOMMENT);

    if (! checkCommentStatus($module, $im_id)) return;

    if (isset($_REQUEST['ajax'])) {
        $titre = utf8_decode($titre);
        $texte = utf8_decode($texte);
        $pseudo = utf8_decode($pseudo);
    }

    $level_access = nivo_mod("Comment");

    if ($visiteur >= $level_access && $level_access > -1){
        if (initCaptcha() && ! validCaptchaCode())
            return;

        if ($visiteur > 0){
            $autor = $user[2];
            $autor_id = $user[0];
        }
        else{
            $pseudo = stripslashes($pseudo);
            $pseudo = nkHtmlEntityDecode($pseudo);
            $pseudo = nkHtmlEntities($pseudo, ENT_QUOTES);
            $pseudo = checkNickname($pseudo);

            if (($error = getCheckNicknameError($pseudo)) !== false) {
                printNotification($error, 'error', array('backLinkUrl' => 'javascript:history.back()'));
                return;
            }

            $autor = $pseudo;
            $autor_id="";
        }

        $flood = nkDB_execute("SELECT date FROM " . COMMENT_TABLE . " WHERE autor = '" . $autor . "' OR autor_ip = '" . $user_ip . "' ORDER BY date DESC LIMIT 0, 1");
        list($flood_date) = nkDB_fetchRow($flood);
        $anti_flood = $flood_date + $nuked['post_flood'];

        $date = time();

        if ($date < $anti_flood && $user[1] < admin_mod("Comment")){
            printNotification(_CNOFLOOD, 'error');
            $url = "index.php?file=Comment&op=view_com&im_id=" . $im_id . "&module=" . $module;
            redirect($url, 2);
            closetable();
            return;
        }

        $texte = secu_html(nkHtmlEntityDecode($texte));
        $titre = nkDB_realEscapeString(stripslashes($titre));
        $texte = stripslashes($texte);
        $module = nkDB_realEscapeString($module);

        if (strlen($titre) > 40){
             $titre = substr($titre, 0, 40) . "...";
        }

        $add = nkDB_execute("INSERT INTO " . COMMENT_TABLE . " ( `id` , `module` , `im_id` , `autor` , `autor_id` , `titre` , `comment` , `date` , `autor_ip` ) VALUES ( '' , '" . $module . "' , '" . $im_id . "' , '" . $autor . "' , '" . $autor_id . "' , '" . $titre . "' , '" . nkDB_realEscapeString($texte) . "' , '" . $date . "' , '" . $user_ip . "')");
        printNotification(_COMMENTADD, 'success');

        if ($module == "news"){
            echo "<br /><br />[ <a href=\"#\" onclick=\"javascript:window.close();window.opener.document.location.reload(true);\">" . __('CLOSE_WINDOW') . "</a> ]</div>";
        }
        else{
            echo "</div>";

            if (! isset($_REQUEST['ajax'])){
                $url_redir = "index.php?file=Comment&op=view_com&im_id=" . $im_id . "&module=" . $module;
                redirect($url_redir, 2);
            }
        }
    }
    else{
        echo applyTemplate('nkAlert/noEntrance');
    }
}

function del_comment($cid){
    global $visiteur;

    nkTemplate_setPageDesign('nudePage');
    nkTemplate_setTitle(_COMMENTS);

    $level_admin = admin_mod("Comment");

    if ($visiteur >= $level_admin){
        $sql = nkDB_execute("SELECT module, im_id FROM " . COMMENT_TABLE . " WHERE id = '" . $cid . "'");
        list($module, $im_id) = nkDB_fetchArray($sql);

        $del = nkDB_execute("DELETE FROM " . COMMENT_TABLE . " WHERE id = '" . $cid . "'");

        printNotification(_COMMENTDEL, 'success');

        $url_redir = "index.php?file=Comment&op=view_com&im_id=" . $im_id . "&module=" . $module;
        redirect($url_redir, 2);
    }
    else{
        printNotification(__('ZONE_ADMIN'), 'error');

        $url_redir = "index.php?file=Comment&op=view_com&im_id=" . $im_id . "&module=" . $module;
        redirect($url_redir, 5);
    }
}

function modif_comment($cid, $titre, $texte, $module, $im_id){
    global $visiteur;

    $module = stripslashes($module);

    nkTemplate_setPageDesign('nudePage');
    nkTemplate_setTitle(_COMMENTS);

    if (! checkCommentStatus($module, $im_id)) return;

    $level_admin = admin_mod("Comment");
    $texte = secu_html(nkHtmlEntityDecode($texte));

    if ($visiteur >= $level_admin){
        $sql = nkDB_execute("UPDATE " . COMMENT_TABLE . " SET titre = '" . $titre . "', comment = '" . $texte . "' WHERE id = '" . $cid . "'");

        printNotification(_COMMENTMODIF, 'success');

        $url_redir = "index.php?file=Comment&op=view_com&im_id=" . $im_id . "&module=" . $module;
        redirect($url_redir, 2);
    }
    else{
        printNotification(__('ZONE_ADMIN'), 'error');

        $url_redir = "index.php?file=Comment&op=view_com&im_id=" . $im_id . "&amp;module=" . $module;
        redirect($url_redir, 5);
    }
}

function edit_comment($cid){
    global $visiteur;

    nkTemplate_setPageDesign('nudePage');

    define('EDITOR_CHECK', 1);

    $level_admin = admin_mod("Comment");

    if ($visiteur >= $level_admin){
        nkTemplate_setTitle(_POSTCOMMENT);

        $sql = mysql_query("SELECT autor, autor_id, titre, comment, autor_ip, module, im_id FROM " . COMMENT_TABLE . " WHERE id = '" . $cid . "'");
        list($auteur, $autor_id, $titre, $texte, $ip, $module, $im_id) = mysql_fetch_array($sql);

        $titre = nkHtmlEntities($titre);

        if($autor_id != ""){
            $sql_member = mysql_query("SELECT pseudo FROM " . USER_TABLE . " WHERE id = '" . $autor_id . "'");
            list($autor) = mysql_fetch_array($sql_member);
        }
        else{
            $autor = $auteur;
        }

        echo "<form method=\"post\" action=\"index.php?file=Comment&amp;op=modif_comment\" >\n"
                . "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"0\">\n"
                . "<tr><td><b>" . _TITLE . " :</b> <input type=\"text\" name=\"titre\" size=\"40\" maxlength=\"40\" value=\"" . $titre . "\" /><br /><br /></td></tr>\n"
                . "<tr><td><b>" . _MESSAGE . " :</b><br />\n"
                . "<textarea id=\"e_basic\" name=\"texte\" cols=\"58\" rows=\"10\">" . $texte . "</textarea></td></tr>\n"
                . "<tr><td><b>" . _NICK . " :</b> " . $autor ." ( " . $ip . " )</td></tr>\n"
                . "<tr><td align=\"right\" colspan=\"2\">\n"
                . "<input type=\"hidden\" name=\"cid\" value=\"" . $cid . "\" />\n"
                . "<input type=\"hidden\" name=\"im_id\" value=\"" . $im_id . "\" />\n"
                . "<input type=\"hidden\" name=\"module\" value=\"" . $module . "\" />\n"
                . "</td></tr></table><div style=\"text-align: center;\"><input type=\"submit\" value=\"" . __('SEND') . "\" /><br /><br />\n"
                . "<a href=\"#\" onclick=\"javascript:window.close()\"><b>" . __('CLOSE_WINDOW') . "</b></a></div></form>";
    }
    else{
        nkTemplate_setTitle(_COMMENTS);

        printNotification(__('ZONE_ADMIN'), 'error');

        $url_redir = "index.php?file=Comment&op=view_com&im_id=" . $im_id . "&module=" . $module;
        redirect($url_redir, 5);
    }
}

switch ($GLOBALS['op']){
    case"del_comment":
        del_comment($_REQUEST['cid']);
        break;

    case"modif_comment":
        modif_comment($_REQUEST['cid'], $_REQUEST['titre'], $_REQUEST['texte'], $_REQUEST['module'], $_REQUEST['im_id']);
        break;

    case "com_index":
        com_index($_REQUEST['im'], $_REQUEST['im_id']);
        break;

    case "post_com":
        post_com($_REQUEST['module'], $_REQUEST['im_id']);
        break;

    case "view_com":
        view_com($_REQUEST['module'], $_REQUEST['im_id']);
        break;

    case "post_comment":
        post_comment($_REQUEST['im_id'], $_REQUEST['module'], $_REQUEST['titre'], $_REQUEST['texte'], $_REQUEST['pseudo']);
        break;

    case "edit_comment":
        edit_comment($_REQUEST['cid']);
        break;

    default:
        break;
}

?>
