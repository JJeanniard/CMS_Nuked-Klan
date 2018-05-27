<?php
/**
 * english.lang.php
 *
 * English translation file of Textbox module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

// define("_NONICKNAME","Please enter your nickname!");
//Resctriction to logged users
define("_NONICKNAME","Log in to post a message !");
// End
define("_REFRESH","Refresh");
define("_SEEARCHIVES","See archives");
define("_SHOUTSUCCES","Message was successfully posted.");
define("_TNOFLOOD","No flood! Please wait a moment...");
define("_SHOUTINDB","messages in the database");
define("_LISTSMILIES","Smilies List");
define("_DELETETEXT","You are about to remove the message of");
define("_FRANCE", "France");
define("_BELGIUM", "Belgium");
define("_SPAIN", "Spain");
define("_UNITED-KINGDOM", "United-Kingdom");
define("_GREECE", "Greece");
define("_TUNISIA", "Tunisia");
define("_MOROCCO", "Morocco");
define("_LOADINPLSWAIT", "Loading ...");
define("_PLEASEWAITTXTBOX","Please wait ...");
define("_THANKSFORPOST","Thank you for your participation!");
define("_LOADINGERRORS","Unable to load the block!");

return array(
    // modules/Textbox/index.php
    // views/frontend/modules/Textbox/block.php
    'ADD_SMILEY'        => 'Add a smilies',
    // views/frontend/modules/Textbox/block.php
    'YOUR_NICK'         => 'Your nickname',
    'YOUR_MESSAGE'      => 'Your message',
    // modules/Textbox/backend/index.php
    // modules/Textbox/backend/setting.php
    'ADMIN_SHOUTBOX'    => 'Shoutbox Administration',
    'CONFIRM_TO_DELETE_ALL_SHOUTBOX_MESSAGE' => 'You are about to remove all messages, continue?',
    // modules/Textbox/backend/index.php
    'SHOUTBOX_MESSAGE_MODIFIED' => 'Message was successfully modified.',
    'ACTION_EDIT_SHOUTBOX_MESSAGE' => 'has modified a message of the textbox.',
    'SHOUTBOX_MESSAGE_DELETED' => 'Message was successfully removed.',
    'ACTION_DELETE_SHOUTBOX_MESSAGE' => 'has deleted a message of the textbox.',
    'ACTION_DELETE_ALL_SHOUTBOX_MESSAGE' => 'has deleted all message of the textbox.',
    'ALL_SHOUTBOX_MESSAGE_DELETED' => 'All messages were removed.',
    // modules/Textbox/backend/menu.php
    'DELETE_ALL_MESSAGE' => 'Remove all messages',
    // modules/Textbox/backend/config/shoutboxMessage.php
    'NICKNAME'          => 'Nickname',
    'IP_ADRESS'         => 'IP Address',
    'EDIT_THIS_SHOUTBOX_MESSAGE' => 'Edit this message',
    'DELETE_THIS_SHOUTBOX_MESSAGE' => 'Remove this message',
    'CONFIRM_TO_DELETE_SHOUTBOX_MESSAGE' => 'You are about to remove the message of %s ! Confirm',
    'NO_SHOUTBOX_MESSAGE_IN_DB' => 'There are yet no messages',
    'MESSAGE'           => 'Message',
    'MODIFY'            => 'Modify',
    // modules/Textbox/backend/config/setting.php
    'NOTIFY_TEXTBOX_INFOS_DISPLAY' => 'When the display of the avatar is disabled, the appearance of the textbox is that of a basic chat, date is not displayed. However it is possible to know the post date flying over the pseudo poster with the mouse.',
    'NUMBER_SHOUT'      => 'Number of messages per page',
    'DISPLAY_AVATAR'    => 'Display user pseudo',
);

?>
