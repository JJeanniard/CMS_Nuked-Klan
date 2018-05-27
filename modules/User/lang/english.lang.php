<?php
/**
 * english.lang.php
 *
 * English translation file of User module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

define("_OTHER","Other");
define("_YOURACCOUNT","Your Account");
define("_INFO","Infos");
define("_PROFIL","Profile");
define("_THEME","Theme");
define("_MESSNOTREAD","not read");
define("_NOTREADAND","not read and");
define("_FILED","read");
define("_USERPASSWORD","Password");
define("_PASSOLD","Ancien");
define("_REMEMBERME","Remember me");
define("_WEBSITE","Web Site");
define("_PUBLIC","public");
define("_PRIVATE","private");
define("_DATEUSER","Join Date");
define("_HELLO","Hello");
define("_USERLOGOUT","Logout");
define("_PREF","Preferences");
define("_INFOPERSO","Profile");
define("_THEMESELECT","Theme Select");
define("_YOURSTATS","Your Stats");

define("_COUNT","counter");
define("_POSTPV","Send private message");
define("_READPV","Read private message");
define("_POST","send");
define("_MESSINFORUM","Messages to the Forum");
define("_USERCOMMENT","Posted Comments");
define("_USERSUGGEST","Suggestions waiting");
define("_LASTUSERMESS","Last messages");
define("_LASTUSERCOMMENT","Last comments");
define("_NOUSERMESS","You havn't sent any messages");
define("_NOUSERCOMMENT","You havn't posted any comments");
define("_PASS","Password");
define("_TYPEBAN","Some characters are prohibited");
define("_NOPASSWORD","Please enter the password");
define("_MAILFAILED","Invalid email!");
define("_BADOLDPASS","Bad old password!");
define("_DATAFAILED","You introduced erroneous data.");
define("_PASSFIELD","Enter password fields only to update them");
define("_REGISTERSUCCES","Registering in progres");
define("_AVATAR","Avatar");
define("_SEEAVATAR","View avatars");
define("_SIGN","Signature");
define("_YOURPREF","Your Preferences");
define("_LASTNAME","First Name");
define("_BIRTHDAY","Date of birth");
define("_SEXE","Sex");
define("_MALE","Male");
define("_FEMALE","Female");
define("_CITY","City");
define("_NATION","Nationality");
define("_PHOTO","Photo");
define("_HARDCONFIG","Hardware");
define("_MOTHERBOARD","Motherboard");
define("_PROCESSOR","Processor");
define("_MEMORY","Memory");
define("_VIDEOCARD","Videocard");
define("_RESOLUTION","Resolution");
define("_SOUNDCARD","Soundcard");
define("_MONITOR","Monitor");
define("_MOUSE","Mouse");
define("_KEYBOARD","Keyboard");
define("_CONNECT","Connection");
define("_SYSTEMOS","OS System");
define("_MODIFPREF","Modify");
define("_SENDPV","Send this member a private message?");

define("_FAVOURITEWEAPON","Favorite Weapons");
define("_PREFMODIF","Profile was successfully updated");
define("_USERMAILSUCCES","An e-mail has been sent with your nickname and your password to :");
define("_USERMAIL","You can login with this nickname and password on our website.");
define("_USERREGISTER","Registration");
define("_NEWUSER","New Member");
define("_NEWREGISTRATION","has just registered on your site");
define("_NEWREGSUITE","You can now edit this person's profil in the administration.");
define("_REGISTRATIONCLOSE","The inscriptions are closed at the present time, please contact the webmaster for more information.");
define("_NOFIELD","You forgot a field.");
define("_BADLOG","Bad login / password. Please retry");
define("_LOSTPASS","Lost Password?");
define("_TOLOG","Login");
define("_LOGINPROGRESS","Login in progress...");
define("_SESSIONIPOPEN","Warning, you are now set on a temporary session and will therefore be disconnected after " . $nuked['sess_inactivemins'] . " minutes of inactivity!");
define("_ERRORCOOKIE","Your internet browser does not allow cookies from this site to be stored. You must enable the option to accept cookies from this site.");
define("_INFOMODIF","Info was successfully updated");
define("_LOSTPASSWORD","Lost Password");
define("_LOSTPASSTXT","Please enter your email and click the send button. You will receive an email containing a link to reset your password.");


define("_MAILSEND","Email was successfully sent");
define("_CODEIS","Your code is");
define("_NEWPASSIS","Your new Password is");
define("_CHANGEIT","Go quickly and change it ;o)");
define("_BADCODE","Bad code");
define("_MAILNOEXIST","email does not exist!");
define("_AVATARLIST","Avatars List");
define("_CLICAVATAR","Click on an avatar to select it");

define("_THETHEME","Themes Select");
define("_SELECTTHEME","Select a theme in the list");
define("_CHANGETHEME","Change theme");

define("_IAGREE","I agree");
define("_IDESAGREE","I disagree");
define("_UNKNOWNUSER","This nickname does not exist!");
define("_USERVALID","Please click on the link below to verify your account. \n If this link is not clickable you can copy and paste it into your web browser.");
define("_VALIDMAILSUCCES","Validation email has been sent to:");
define("_VALIDADMIN","Your account has been created. An e-mail has been sent to administrator and you will be informed when your account has been activated.");
define("_NOVALIDUSER","Sorry this account is still not validated.");
define("_ALREADYVALID","This account is already validated.");
define("_VALIDUSER","Your account is now validated, you can login with your nickname and your password on our website.");

define("_BADFILEFORMAT","Bad image file type!!! Only gif or jpg are authorized");
define("_NEWUSERREGISTRATION","New User Registration");
define("_DELMYACCOUNT","Remove my account");
define("_REMOVECONFIRM","Are you sure you want to remove your account?");
define("_BADPASSWORD","Bad password!");
define("_ACCOUNTDELETE","Your account was successfully removed.");
define('_HI', 'Hello');

define('_LINKALWAYSACTIVE', 'We have already sent to you a token, please check your mails');
define('_LINKTONEWPASSWORD', 'To regenerate your password please click on the link below :');
define('_LINKTIME', 'This link is valid 1 hour, it will pass this time please repeat the procedure for the forgotten password.');
define('_WRONGMAIL', 'The email address you entered is incorrect.');
define('_WRONGTOKEN', 'The token you entered is incorrect.');
define('_YOURNEWPASSWORD', 'Your new password !');
define('_NEWPASSWORD', 'Please find your new password below');
define('_NEWPASSSEND', 'Your new password has been sent to your mailbox.');
define('_LINKNOACTIVE', 'This link is no longer valid!');

//Security pass check
define("_PASSWEAK", "Weak");
define("_PASSMEDIUM", "Medium");
define("_PASSHIGH", "High");
define("_PASSCHECK", "Password's Security");

define("_REQUESTPV","Write a private message");

return array(
    // modules/Games/backend/index.php
    'DISPLAYED_RANK'    => 'Displayed rank',
    'TEAM'              => 'Team',

);

?>
