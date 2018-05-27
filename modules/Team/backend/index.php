<?php
/**
 * index.php
 *
 * Backend of Team module - Team management
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! adminInit('Team'))
    return;

require_once 'Includes/nkAction.php';

nkAction_setParams(array(
    'dataName'              => 'team',
    'tableId'               => 'cid',
    'tableName'             => TEAM_TABLE,
    'titleField_dbTable'    => 'titre',
    'previewUrl'            => 'index.php?file=Team'
));


/* Team list function */

/**
 * Callback function for nkList.
 * Format Team row.
 *
 * @param array $row : The Team row.
 * @param int $nbData : The list count.
 * @param int $r : The number of row.
 * @param array $functionData : The external data of list passed to this function.
 * @return array : The Team row formated.
 */
function formatTeamRow($row, $nbData, $r, $functionData) {
    if ($row['gameName'] == '')
        $row['gameName'] = __('NA');

    return $row;
}

/* Team edit form function */

/**
 * Callback function for nkAction_edit.
 * Prepare form configuration to add Team.
 *
 * @param array $form : The Team form configuration.
 * @return array : The Team form configuration prepared.
 */
function prepareFormForAddTeam(&$form) {
    unset($form['items']['coverageImg']);
}

/**
 * Callback function for nkAction_edit.
 * Prepare form configuration to edit Team.
 *
 * @param array $form : The Team form configuration.
 * @param array $team : The Team data.
 * @return array : The Team form configuration prepared.
 */
function prepareFormForEditTeam(&$form, $team, $id) {
    if ($team['coverage'] != '') {
        $form['items']['coverage']['html'] = '<div><img src="'. $team['coverage']
            . '" title="'. printSecuTags($team['titre']) .'" id="teamCoverageImg" /></div>';
    }
}


// Action handle
switch ($GLOBALS['op']) {
    case 'edit' :
        // Display Team form for addition / editing.
        nkAction_edit();
        break;

    case 'save' :
        // Save / modify Team.
        nkAction_save();
        break;

    case 'delete' :
        // Delete Team.
        nkAction_delete();
        break;

    default:
        // Display Team list.
        nkAction_list();
        break;
}

?>
