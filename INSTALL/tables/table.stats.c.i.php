<?php
/**
 * table.stats.c.i.php
 *
 * `[PREFIX]_stats` database table script
 *
 * @version 1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */

$dbTable->setTable(STATS_TABLE);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Table configuration
///////////////////////////////////////////////////////////////////////////////////////////////////////////

$statsTableCfg = array(
    'fields' => array(
        'nom'   => array('type' => 'varchar(50)', 'null' => false, 'default' => '\'\''),
        'type'  => array('type' => 'varchar(50)', 'null' => false, 'default' => '\'\''),
        'count' => array('type' => 'int(11)',     'null' => false, 'default' => '\'0\'')
    ),
    'primaryKey' => array('nom', 'type'),
    'engine' => 'MyISAM'
);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Check table integrity
///////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($process == 'checkIntegrity') {
    // table and field exist in 1.6.x version
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

if ($process == 'install') {
    $dbTable->createTable($statsTableCfg);

    $sql = 'INSERT INTO `'. STATS_TABLE .'` VALUES
        (\'Gallery\', \'pages\', 0),
        (\'Archives\', \'pages\', 0),
        (\'Calendar\', \'pages\', 0),
        (\'Defy\', \'pages\', 0),
        (\'Download\', \'pages\', 0),
        (\'Guestbook\', \'pages\', 0),
        (\'Irc\', \'pages\', 0),
        (\'Links\', \'pages\', 0),
        (\'Wars\', \'pages\', 0),
        (\'News\', \'pages\', 0),
        (\'Search\', \'pages\', 0),
        (\'Recruit\', \'pages\', 0),
        (\'Sections\', \'pages\', 0),
        (\'Server\', \'pages\', 0),
        (\'Members\', \'pages\', 0),
        (\'Team\', \'pages\', 0),
        (\'Forum\', \'pages\', 0);';

    $dbTable->insertData('INSERT_DEFAULT_DATA', $sql);
}

?>
