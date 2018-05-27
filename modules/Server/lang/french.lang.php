<?php
/**
 * french.lang.php
 *
 * French translation file of Server module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

define("_ON","sur");
define("_MOREINFOS","+ d'infos");
define("_SEVERDOWN","Serveur Down...");

define("_MAP","Map");
define("_PLAYER","Joueurs");
define("_NOSERVER","Aucun serveur pour cette cat�gorie");
define("_SERVERINFOS","Infos sur un serveur");
define("_SSEARCH","Chercher");
define("_EXECTHISFILE","Cochez Ex�cutez ce programme � partir de son emplacement actuel et cliquez sur ok pour rejoindre le serveur");

define("_SERVERDETAIL","Serveur en d�tails");
define("_ADDRESS","Adresse");
define("_NBPLAYER","Nb de joueurs");
define("_SERVERTYPE","Type de serveur");
define("_SERVERRULES","Serveur Rules");
define("_SERVERVERSION","Version");
define("_PLAYERID","Id");
define("_SSCORE","Score");
define("_FRAG","Frags");
define("_HONOR","Honeur");
define("_DEATHS","Morts");
define("_PING","Ping");
define("_NOPLAYERS","Aucun joueur sur ce serveur");

return array(
    // modules/Server/backend/category.php
    // modules/Server/backend/index.php
    'ADMIN_SERVER'         => 'Administration Serveurs',
    // modules/Server/backend/index.php
    'ADD_SERVER'           => 'Ajouter un Serveur',
    'EDIT_THIS_SERVER'     => 'Editer ce Serveur',
    'DELETE_THIS_SERVER'   => 'Supprimer ce Serveur',
    'NO_SERVER_IN_DB'      => 'Aucune serveur dans la base de donn�es',
    'ADD_THIS_SERVER'      => 'Cr�er un Serveur',
    'MODIFY_THIS_SERVER'   => 'Modifier ce Serveur',
    'SERVER_ADDED'         => 'Serveur ajout�e avec succ�s.',
    'SERVER_MODIFIED'      => 'Serveur modifi�e avec succ�s.',
    'SERVER_DELETED'       => 'Serveur supprim�e avec succ�s.',
    'ACTION_ADD_SERVER'    => 'a ajout� le serveur',
    'ACTION_EDIT_SERVER'   => 'a modifi� le serveur',
    'ACTION_DELETE_SERVER' => 'a supprim� le serveur',
    // modules/Server/backend/category.php
    'ACTION_ADD_SERVER_CATEGORY' => 'a ajout� la cat�gorie serveur',
    'ACTION_EDIT_SERVER_CATEGORY' => 'a modifi� la cat�gorie serveur',
    'ACTION_DELETE_SERVER_CATEGORY' => 'a supprim� la cat�gorie serveur',
    // modules/Server/backend/config/menu.php
    'SERVER'                => 'Serveurs',
    // modules/Server/backend/config/server.php
    'SERVER_IP'             => 'Adresse Ip',
    'SERVER_PORT'           => 'Port',
    'SERVER_GAME'           => 'Type de serveur',
    'SERVER_PASSWORD'       => 'Password'
);

?>
