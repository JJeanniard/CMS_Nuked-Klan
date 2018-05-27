<?php
/**
 * french.lang.php
 *
 * French translation file of Textbox module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

// define("_NONICKNAME","Vous n\'avez pas entr� de pseudo !");
//Resctriction to logged users
define("_NONICKNAME","Identifiez vous pour pouvoir poster un message !");
// End

define("_YOURMESS","");
define("_REFRESH","Rafra�chir");
define("_SEEARCHIVES","Voir les archives");
define("_SHOUTSUCCES","Message envoy� avec succ�s.");
define("_TNOFLOOD","Flood interdit ! veuillez patienter quelques instants...");
define("_SHOUTINDB","messages dans la base de donn�es");
define("_LISTSMILIES","Liste des smilies");
define("_DELETETEXT","Vous �tes sur le point de supprimer le message de");
define("_FRANCE", "France");
define("_BELGIUM", "Belgique");
define("_SPAIN", "Espagne");
define("_UNITED-KINGDOM", "Royaume-Uni");
define("_GREECE", "Gr&egrave;ce");
define("_TUNISIA", "Tunisie");
define("_MOROCCO", "Maroc");
define("_LOADINPLSWAIT", "Chargement en cours...");
define("_PLEASEWAITTXTBOX","Veuillez patienter...");
define("_THANKSFORPOST","Merci de votre participation !");
define("_LOADINGERRORS","Impossible de charger le block !");

return array(
    // modules/Textbox/index.php
    // views/frontend/modules/Textbox/block.php
    'ADD_SMILEY'        => 'Ajouter un smilies',
    // views/frontend/modules/Textbox/block.php
    'YOUR_NICK'         => 'Votre pseudo',
    'YOUR_MESSAGE'      => 'Votre message',
    // modules/Textbox/backend/index.php
    // modules/Textbox/backend/setting.php
    'ADMIN_SHOUTBOX'    => 'Administration Tribune Libre',
    'CONFIRM_TO_DELETE_ALL_SHOUTBOX_MESSAGE' => 'Vous �tes sur le point de supprimer tous les messages, continuer ?',
    // modules/Textbox/backend/index.php
    'SHOUTBOX_MESSAGE_MODIFIED' => 'Message modifi� avec succ�s.',
    'ACTION_EDIT_SHOUTBOX_MESSAGE' => 'a modifi� un message de la tribune libre.',
    'SHOUTBOX_MESSAGE_DELETED' => 'Message effac� avec succ�s.',
    'ACTION_DELETE_SHOUTBOX_MESSAGE' => 'a supprim� un message de la tribune libre.',
    'ACTION_DELETE_ALL_SHOUTBOX_MESSAGE' => 'a supprim� tous les messages de la tribune libre.',
    'ALL_SHOUTBOX_MESSAGE_DELETED' => 'Tous les messages ont �t� effac�s.',
    // modules/Textbox/backend/menu.php
    'DELETE_ALL_MESSAGE' => 'Supprimer tous les messages',
    // modules/Textbox/backend/config/shoutboxMessage.php
    'NICKNAME'          => 'Pseudo',
    'IP_ADRESS'         => 'Adresse Ip',
    'EDIT_THIS_SHOUTBOX_MESSAGE' => 'Editer ce message',
    'DELETE_THIS_SHOUTBOX_MESSAGE' => 'Supprimer ce message',
    'CONFIRM_TO_DELETE_SHOUTBOX_MESSAGE' => 'Vous �tes sur le point de supprimer le message de %s ! Confirmer',
    'NO_SHOUTBOX_MESSAGE_IN_DB' => 'Il n\'y a pas encore de message',
    'MESSAGE'           => 'Message',
    'MODIFY'            => 'Modifier',
    // modules/Textbox/backend/config/setting.php
    'NOTIFY_TEXTBOX_INFOS_DISPLAY' => 'Lorsque l\'affichage de l\'avatar est d&eacute;sactiv&eacute;, l\'apparence de la textbox est celle d\'un tchat basique, la date n\'est pas affich&eacute;e. En revanche il est possible de connaitre la date du post en survolant le pseudo du posteur avec la souris.',
    'NUMBER_SHOUT'      => 'Nombre de messages par page',
    'DISPLAY_AVATAR'    => 'Afficher l\'avatar du posteur',
);

?>
