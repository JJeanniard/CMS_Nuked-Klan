<?php
/**
 * admin.php
 *
 * Backend of Server module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! adminInit('Server'))
    return;

require_once 'Includes/nkAction.php';

nkAction_setParams(array(
    'dataName'              => 'server',
    'tableName'             => SERVER_TABLE,
    'tableId'               => SERVER_TABLE_ID,
    'titleField_dbTable'    => 'ip',
    'previewUrl'            => 'index.php?file=Server'
));


/* Server list function */

/**
 * Callback function for nkList.
 * Format Server row.
 *
 * @param array $row : The Server row.
 * @param int $nbData : The list count.
 * @param int $r : The number of row.
 * @param array $functionData : The external data of list passed to this function.
 * @return array : The Server row formated.
 */
function formatServerRow($row, $nbData, $r, $functionData) {
    if ($row['titre'] != '')
        $row['titre'] = printSecuTags(stripslashes($row['titre']));
    else
        $row['titre'] = __('NONE');

    $row['adress'] = $row['ip'] .':'. $row['port'];

    return $row;
}

/* Server edit form function */

/**
 * Get Server game list options.
 *
 * @param void
 * @return array : The server game list for input select option.
 * /
function getServerGameOptions() {
    $options = array();

    // TODO

    return $options;
}

/**
 * Callback function for nkAction_edit.
 * Prepare form configuration to add Server.
 *
 * @param array $form : The Server form configuration.
 * @return array : The Server form configuration prepared.
 * /
function prepareFormForAddServer(&$form) {
    //$form['items']['game']['options'] = getServerGameOptions();
}

/**
 * Callback function for nkAction_edit.
 * Prepare form configuration to edit Server.
 *
 * @param array $form : The Server form configuration.
 * @param array $map : The Server data.
 * @return array : The Server form configuration prepared.
 * /
function prepareFormForEditServer(&$form, $server, $id) {
    //$form['items']['game']['options'] = getServerGameOptions();
}*/


// Action handle
switch ($GLOBALS['op']) {
    case 'edit' :
        // Display Server form for addition / editing.
        nkAction_edit();
        break;

    case 'save' :
        // Save / modify Server.
        nkAction_save();
        break;

    case 'delete' :
        // Delete Server.
        nkAction_delete();
        break;

    default:
        // Display Server list.
        nkAction_list();
        break;
}

?>
