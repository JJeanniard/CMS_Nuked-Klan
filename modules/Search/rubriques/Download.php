<?php
// -------------------------------------------------------------------------//
// Nuked-KlaN - PHP Portal                                                  //
// https://nuked-klan.fr                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//
if (!defined("INDEX_CHECK")){
	exit('You can\'t run this file alone.');
}

global $nuked, $user, $visiteur;


$and = "";

if ($autor != "" && $main != ""){
    $and .= "(autor LIKE '%" . $autor . "%') AND ";
}
else if ($autor != ""){
    $and .= "(autor LIKE '%" . $autor . "%')";
}

if ($searchtype == "matchexact" && $main != ""){
    $and .= "(titre LIKE '%" . $main . "%' OR description LIKE '%" . $main . "%')";
}
else if ($main != ""){
    $sep = "";
    $and .= "(";

    for($i = 0; $i < count($search); $i++){
        $and .= $sep . "(titre LIKE '%" . $search[$i] . "%' OR description LIKE '%" . $search[$i] . "%')";
        if ($searchtype == "matchor") $sep = " OR ";
        else $sep = " AND ";
    }

    $and .= ")";
}

$searchLevelAccess = max($visiteur, 1);
$req = "SELECT id, titre, date FROM " . DOWNLOAD_TABLE . " WHERE level <= '" . $searchLevelAccess . "' AND " . $and . " ORDER BY id DESC";
$sql_dl = nkDB_execute($req);

$nb_dl = nkDB_numRows($sql_dl);

$tab = array('module' => array(), 'title' => array(), 'link' => array());

if ($nb_dl > 0){
    while (list($dl_id, $dl_titre, $dl_date) = nkDB_fetchArray($sql_dl)){
        $dl_titre = nkHtmlEntities($dl_titre);
        $dl_date = nkDate($dl_date);
        $tab['module'][] = $modname;
        $tab['title'][] = "<b>" . $dl_titre . "</b> - " . _ADDED . "&nbsp;" . $dl_date;
        $tab['link'][] = "index.php?file=Download&amp;op=description&amp;dl_id=" . $dl_id;
    }
}
?>
