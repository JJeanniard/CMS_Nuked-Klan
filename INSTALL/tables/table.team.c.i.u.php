<?php
/**
 * table.team.c.i.u.php
 *
 * `[PREFIX]_team` database table script
 *
 * @version 1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */

$dbTable->setTable(TEAM_TABLE);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Table configuration
///////////////////////////////////////////////////////////////////////////////////////////////////////////

$teamTableCfg = array(
    'fields' => array(
        'cid'      => array('type' => 'int(11)',      'null' => false, 'autoIncrement' => true),
        'titre'    => array('type' => 'varchar(50)',  'null' => false, 'default' => '\'\''),
        'tag'      => array('type' => 'text',         'null' => false),
        'tag2'     => array('type' => 'text',         'null' => false),
        'image'    => array('type' => 'varchar(255)', 'null' => false, 'default' => '\'\''),
        'coverage' => array('type' => 'varchar(255)', 'null' => false, 'default' => '\'\''),
        'ordre'    => array('type' => 'int(5)',       'null' => false, 'default' => '\'0\''),
        'game'     => array('type' => 'int(11)',      'null' => false, 'default' => '\'0\'')
    ),
    'primaryKey' => array('cid'),
    'engine' => 'MyISAM'
);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Check table integrity
///////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($process == 'checkIntegrity') {
    // table exist in 1.6.x version
    $dbTable->checkIntegrity();
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Convert charset and collation
///////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($process == 'checkAndConvertCharsetAndCollation')
    $dbTable->checkAndConvertCharsetAndCollation();

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Table drop
///////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($process == 'drop' && $dbTable->tableExist())
    $dbTable->dropTable();

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Table creation
///////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($process == 'install')
    $dbTable->createTable($teamTableCfg);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Table update
///////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($process == 'update') {
    // install / update 1.8
    if (! $dbTable->fieldExist('image'))
        $dbTable->addField('image', $teamTableCfg['fields']['image']);

    //if (! $dbTable->fieldExist('coverage'))
    //    $dbTable->addField('coverage', $teamTableCfg['fields']['coverage']);
}

?>
