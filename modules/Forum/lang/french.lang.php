<?php
/**
 * french.lang.php
 *
 * French translation file of Forum module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

/*
define("_PAGES","Pages");
define("_SMILEY","Smilies");
define("_LISTSMILIES","Liste des smilies");
define("_UPLOADFAILED","Impossible d'uploader ce fichier !!!");
define("_NONEXIST","n'existe pas dans la base de donn�es.");
define("_ADDMODO","Ajouter un mod�rateur");
define("_DELOLDMESSAGES","Supprimer les anciens sujets du Forum depuis le :");
define("_PERMALINK","Permalien");

// Viewforum
define('_BAD_FORUM_ID', 'L\'ID que vous avez utilis� n\'est pas correct.');
define('_TOPIC', 'Sujet');
define('_CREATED_BY', 'Cr&eacute;&eacute; par');

// Admin
define("_NONAME","Vous n'avez pas entr� de nom !");
define("_INCORRECT_ORDER","L'ordre ne contient pas que des entiers !");
define("_INCORRECT_RANK_MESSAGE","Le seuil de message du rang ne contient pas que des entiers !");
*/

return array(
    // modules/Forum/poll.php
    // modules/Forum/post.php
    // modules/Forum/viewtopic.php
    'TOPIC_NO_EXIST'    => 'D�sol� ce topic n\'existe pas ou a �t� supprim�',
    // modules/Forum/poll.php
    // modules/Forum/post.php
    // modules/Forum/viewforum.php
    // modules/Forum/viewtopic.php
    'FORUM_NO_EXIST'    => 'D�sol� ce forum n\'existe pas ou a �t� supprim�',
    // modules/Forum/main.php
    // modules/Forum/post.php
    // modules/Forum/viewforum.php
    // modules/Forum/viewtopic.php
    'NO_ACCESS_FORUM_CATEGORY' => 'D�sol� vous n\'avez pas acc�s a cette cat�gorie forum',
    // modules/Forum/post.php
    // modules/Forum/viewforum.php
    // modules/Forum/viewtopic.php
    'NO_ACCESS_FORUM' => 'D�sol� vous n\'avez pas acc�s a ce forum',
    // modules/Forum/post.php
    // views/frontend/modules/Forum/post.php
    'MESSAGE'           => 'Message',
    // modules/Forum/core.php
    // modules/Forum/backend/config/forum.php
    'MODERATOR'         => array('Mod�rateur', 'Mod�rateurs'),
    // modules/Forum/search.php
    // modules/Forum/viewforum.php
    'NO_TEXT_RESUME'    => 'Aucun aper�u disponible...',
    // modules/Forum/core.php
    'SEE_MODERATOR'     => 'Voir le profil de ',
    'FORUM_INDEX'       => 'Index du Forum',
    'FTODAY'            => 'aujourd\'hui �',
    'FYESTERDAY'        => 'hier �',
    // modules/Forum/index.php
    'CONFIRM_DELETE_FILE' => 'Etes-vous s�r de vouloir supprimer ce fichier ?',
    'FILE_DELETED'      => 'Fichier joint supprim� avec succ�s.',
    'NOTIFY_IS_ON'      => 'Notification activ� avec succ�s.',
    'NOTIFY_IS_OFF'     => 'Notification d�sactiv� avec succ�s.',
    'CONFIRM_DELETE_TOPIC' => 'Etes-vous s�r de vouloir supprimer ce topic ?',
    'TOPIC_DELETED'     => 'Topic supprim� avec succ�s.',
    'TOPIC_MOVED'       => 'Topic d�plac� avec succ�s.',
    'TOPIC_LOCKED'      => 'Topic ferm� avec succ�s.',
    'TOPIC_UNLOCKED'    => 'Topic ouvert avec succ�s.',
    'TOPIC_MODIFIED'    => 'Topic modifi� avec succ�s.',
    'MESSAGES_MARK'     => 'Tous les messages sont � pr�sent marqu�s comme lus',
    // modules/Forum/main.php
    'FORUM_CATEGORY_NO_EXIST' => 'D�sol� cette cat�gorie forum n\'existe pas ou a �t� supprim�',
    'YEARS_OLD'         => 'ans',
    'NO_BIRTHDAY'       => 'aucun membre ne f�te son anniversaire.',
    'ONE_BIRTHDAY'      => 'il y a 1 membre qui f�te son anniversaire :',
    'MANY_BIRTHDAY'     => 'il y a %d membres qui f�tent leur anniversaire :',
    // modules/Forum/poll.php
    'CONFIRM_DELETE_POLL' => 'Etes-vous s�r de vouloir supprimer ce sondage ?',
    'OPTION'            => 'Option',
    '2_OPTION_MIN'      => 'Vous devez entrer 2 options minimum !',
    'FORUM_POLL_ADDED'  => 'Sondage ajout� avec succ�s.',
    'FORUM_POLL_MODIFIED' => 'Sondage modifi� avec succ�s.',
    'FORUM_POLL_DELETED' => 'Sondage supprim� avec succ�s.',
    'FORUM_POLL_NO_EXIST' => 'D�sol� ce sondage n\'existe pas ou a �t� supprim�',
    'VOTE_SUCCES'       => 'Votre vote a bien �t� pris en compte.',
    'ALREADY_VOTE_FORUM' => 'D�sol� vous avez d�j� Vot� !!',
    'BAD_VOTE_LEVEL'    => 'D�sol� vous n\'avez pas le niveau requis pour voter !!',
    'ONLY_MEMBERS_VOTE' => 'D�sol� seul les membres peuvent voter !!',
    'NO_OPTION'         => 'Vous n\'avez pas cocher de r�ponse',
    // modules/Forum/post.php
    'POST_EDIT'         => 'Editer le sujet',
    'POST_NEW_TOPIC'    => 'Poster un nouveau sujet',
    'POST_REPLY'        => 'Poster une r�ponse',
    'NO_FLOOD'          => 'Vous avez d�j� post� un message il y a peu de temps, veuillez patienter quelques instants...',
    'FIELD_EMPTY'       => 'Assurez vous d\'avoir rempli tout les champs."',
    'MESSAGE_SEND'      => 'Message envoy� avec succ�s.',
    'EDIT_BY'           => 'Edit� par',
    'MESSAGE_MODIFIED'  => 'Message modifi� avec succ�s.',
    'EMAIL_REPLY_NOTIFY' => 'Il y a eu une r�ponse a ce message :',
    'CONFIRM_DELETE_POST' => 'Etes-vous s�r de vouloir supprimer ce message ?',
    'FORUM_POST_DELETED' => 'Message supprim� avec succ�s.',
    // modules/Forum/search.php
    '3_CHARS_MIN'       => 'Vous devez entrer plus de 2 caract�res',
    'NO_WORDS_TO_SEARCH' => 'Veuillez entrer une expression a rechercher',
    // modules/Forum/viewtopic.php
    'IS_ONLINE'         => 'En ligne !',
    'REGISTERED'        => 'Inscrit(e) le',
    'IP'                => 'Ip',
    'LAST_THREAD'       => 'Sujet pr�c�dent',
    'NEXT_THREAD'       => 'Sujet suivant',
    // modules/Forum/config/forumPoll.php
    'QUESTION'          => 'Question',
    'ADD_THIS_POLL'     => 'Ajouter ce sondage',
    'MODIF_THIS_POLL'   => 'Modifier ce sondage',
    // modules/Forum/backend/config/prune.php
    'FORUM'             => array('Forum', 'Forums'),
    // modules/Forum/backend/category.php
    // modules/Forum/backend/index.php
    // modules/Forum/backend/prune.php
    // modules/Forum/backend/rank.php
    // modules/Forum/backend/setting.php
    'ADMIN_FORUM'       => 'Administration Forum',
    // modules/Forum/backend/index.php
    'ADD_FORUM'         => 'Ajouter un Forum',
    'EDIT_THIS_FORUM'   => 'Editer ce Forum',
    'DELETE_THIS_FORUM' => 'Supprimer ce Forum',
    'NO_FORUM_IN_DB'    => 'Aucun forum dans la base de donn�es',
    'FORUM_ADDED'       => 'Forum ajout� avec succ�s.',
    'FORUM_MODIFIED'    => 'Forum modifi� avec succ�s.',
    'FORUM_DELETED'     => 'Forum supprim� avec succ�s.',
    'ACTION_ADD_FORUM'  => 'a ajout� le forum',
    'ACTION_EDIT_FORUM' => 'a modifi� le forum',
    'ACTION_DELETE_FORUM' => 'a supprim� le forum',
    'DELETE_THIS_MODERATOR' => 'Supprimer ce mod�rateur',
    'ACTION_DELETE_MODERATOR' => 'a supprim� le mod�rateur',
    'MODERATOR_DELETED' => 'Mod�rateur supprim� avec succ�s.',
    // modules/Forum/backend/category.php
    'ACTION_ADD_FORUM_CATEGORY' => 'a ajout� la cat�gorie forum', // _ACTIONADDCATFO
    'ACTION_EDIT_FORUM_CATEGORY' => 'a modifi� la cat�gorie forum', // _ACTIONMODIFCATFO
    'ACTION_DELETE_FORUM_CATEGORY' => 'a supprim� la cat�gorie forum', // _ACTIONDELCATFO
    // modules/Forum/backend/moderator.php
    'MODERATOR_MANAGEMENT'    => 'Gestion des Mod�rateurs',
    'ADD_MODERATOR'           => 'Ajouter un mod�rateur',
    'EDIT_THIS_MODERATOR'     => 'Editer ce mod�rateur',
    'DELETE_THIS_MODERATOR'   => 'Supprimer ce mod�rateur',
    'NO_MODERATOR_IN_DB'      => 'Aucun mod�rateur dans la base de donn�es',
    'ADD_THIS_MODERATOR'      => 'Cr�er un mod�rateur',
    'MODIFY_THIS_MODERATOR'   => 'Modifier ce mod�rateur',
    'MODERATOR_ADDED'         => 'Mod�rateur ajout�e avec succ�s.',
    'MODERATOR_MODIFIED'      => 'Mod�rateur modifi�e avec succ�s.',
    'MODERATOR_DELETED'       => 'Mod�rateur supprim�e avec succ�s.',
    'ACTION_ADD_MODERATOR'    => 'a ajout� le mod�rateur',
    'ACTION_EDIT_MODERATOR'   => 'a modifi� le mod�rateur',
    'ACTION_DELETE_MODERATOR' => 'a supprim� le mod�rateur',
    // modules/Forum/backend/rank.php
    'ACTION_ADD_FORUM_RANK'  => 'a ajout� le rang forum',
    'ACTION_EDIT_FORUM_RANK' => 'a modifi� le rang forum',
    'ACTION_DELETE_FORUM_RANK' => 'a supprim� le rang forum',
    // modules/Forum/backend/prune.php
    'NO_DAY'            => 'Vous n\'avez pas entr� de nombre de jours !',
    'PRUNE'             => 'D�lestage des Forums',
    'INCORRECT_PRUNE_DAY'=> 'Le nombre de jours ne contient pas que des entiers !',
    'ACTION_PRUNE_FORUM' => 'a d�lest� le forum',
    'FORUM_PRUNE'       => 'D�lestage des forums effectu� avec succ�s.',
    // modules/Forum/backend/config/forum.php
    'LEVEL_ACCES'       => 'Niveau d\'acc�s',
    'LEVEL_POST'        => 'Niveau d\'utilisation',
    'LEVEL_POLL'        => 'Niveau sondage',
    'LEVEL_VOTE'        => 'Niveau vote',
    'ADD_THIS_FORUM'    => 'Ajouter ce Forum',
    'MODIFY_THIS_FORUM' => 'Modifier ce Forum',
    // modules/Forum/backend/config/forumCategory.php
    'NOTIFY_FORUM_IMAGE_SIZE' => 'Afin d\'optimiser l\'affichage de votre site, pensez � ajuster la taille de vos image � la largeur de votre th�me.<br />Les images seront redimensionn&eacute;es automatiquement � la largeur de votre site.',
    // modules/Forum/backend/config/forumRank.php
    'MESSAGES'          => 'Messages',
    // modules/Forum/backend/config/moderator.php
    'NICKNAME'          => 'Pseudo',
    // modules/Forum/backend/config/prune.php
    'NUMBER_OF_DAY'     => 'Nombre de jours',
    // modules/Forum/backend/config/setting.php
    'FORUM_TITLE'       => 'Titre du Forum',
    'FORUM_DESCRIPTION' => 'Description du Forum',
    'USE_RANK_TEAM'     => 'Utiliser les rangs team lorsque c\'est possible',
    'DISPLAY_FORUM_IMAGE' => 'Afficher les images pour chaques Forum',
    'DISPLAY_CATEGORY_IMAGE' => 'Remplacer les titres des cat&eacute;gories par des images lorsque c\'est possible',
    'DISPLAY_BIRTHDAY'  => 'Afficher les anniversaires des membres sur la page d\'accueil du forum',
    'DISPLAY_GAMER_DETAILS' => 'Afficher le jeu de l\'utilisateur et les pr�f�rences jeu',
    'DISPLAY_USER_DETAILS' => 'Afficher les couleurs des rangs team et la l�gende',
    'DISPLAY_LABELS'    => 'Afficher les labels en CSS au lieu des images (fichiers joints, sondages et annonces',
    'DISPLAY_MODERATORS' => 'Afficher la liste des mod�rateurs sur chaque forum de la page d\'accueil',
    'NUMBER_THREAD'     => 'Nombre de sujets par page',
    'NUMBER_POST'       => 'Nombre de messages par page',
    'TOPIC_HOT'         => 'Seuil de Messages pour �tre Populaire',
    'POST_FLOOD'        => 'Dur�e en secondes entre 2 messages (flood)',
    'MAX_SURVEY_FIELD'  => 'Nombre maximal d\'options pour les sondages',
    'JOINED_FILES'      => 'Autoriser les fichiers joints',
    'FILE_LEVEL'        => 'Niveau requis pour poster des fichiers joints',
    'MAX_SIZE_FILE'     => 'Taille maximale pour les fichiers joints (en Ko)',
    // views/frontend/modules/Forum/main.php
    // views/frontend/modules/Forum/searchForm.php
    // views/frontend/modules/Forum/searchResult.php
    'SEARCH'            => 'Recherche',
    // views/frontend/modules/Forum/block.php
    // views/frontend/modules/Forum/main.php
    // views/frontend/modules/Forum/viewForum.php
    'LAST_POST'         => 'Dernier message',
    'VIEW_LATEST_POST'  => 'Voir le dernier message',
    // views/frontend/modules/Forum/block.php
    // views/frontend/modules/Forum/searchForm.php
    // views/frontend/modules/Forum/searchResult.php
    // views/frontend/modules/Forum/viewForum.php
    'SUBJECTS'          => 'Sujets',
    // views/frontend/modules/Forum/post.php
    // views/frontend/modules/Forum/viewForum.php
    'POLL'              => 'Sondage',
    'ATTACH_FILE'       => 'Fichier joint',
    // views/frontend/modules/Forum/post.php
    // views/frontend/modules/Forum/viewtopic.php
    'POSTED_ON'         => 'Post�',
    // views/frontend/modules/Forum/block.php
    // views/frontend/modules/Forum/viewForum.php
    'ANSWERS'           => 'r�ponses',
    'VIEWS'             => 'vues',
    // views/frontend/modules/Forum/post.php
    // views/frontend/modules/Forum/viewForum.php
    'ANNOUNCEMENT'      => 'Annonce',
    // views/frontend/modules/Forum/block.php
    'VISIT_FORUMS'      => 'Visiter les Forums',
    // views/frontend/modules/Forum/editPoll.php
    'POST_SURVEY'       => 'Poster un sondage',
    // views/frontend/modules/Forum/main.php
    'ADVANCED_SEARCH'   => 'Recherche avanc�e',
    'TODAY_IS'          => 'Date &amp; Heure',
    'YOUR_LAST_VISIT'   => 'Votre derni�re visite',
    'TOPICS'            => 'sujets',
    'NO_POST'           => 'Pas de Messages',
    'TOTAL_MEMBERS_POSTS' => 'Nos membres ont post� un total de %s message(s).',
    'WE_HAVE_N_REGISTERED_MEMBERS' => 'Nous avons %d membres enregistr�s.',
    'LAST_USER_IS'      => 'L\'utilisateur enregistr� le plus r�cent est ',
    'FORUM_ONLINE_LEGEND' => 'Il y a %d visiteur(s), %d membre(s) et %d administrateur(s) en ligne.',
    'MEMBERS_ONLINE'    => 'Membres en ligne',
    'RANK_LEGEND'       => 'L�gende des rangs',
    'TODAY'             => 'Aujourd\'hui',
    'MARK_READ'         => 'Marquer tous les messages comme lus',
    'VIEW_LAST_VISIT_MESS' => 'Voir les nouveaux messages depuis votre derni�re visite',
    'NEW_POST_LAST_VISIT' => 'Nouveaux messages depuis votre derni�re visite',
    'NO_POST_LAST_VISIT' => 'Pas de nouveaux messages depuis votre derni�re visite',
    // views/frontend/modules/Forum/moveThread.php
    'MOVE_TOPIC_TO'     => 'D�placer vers le forum',
    // views/frontend/modules/Forum/post.php
    'NICKNAME'          => 'Pseudo',
    // TODO : Use login & logout in main translation file
    'FLOGOUT'           => 'logout',
    'FLOGIN'            => 'login',
    'OPTIONS'           => 'Options',
    'USER_SIGNATURE'    => 'Attacher sa signature',
    'EMAIL_NOTIFY'      => 'M\'avertir lorsqu\'une r�ponse est post�e',
    'DISPLAY_EDIT_TEXT' => 'Afficher le message d\'�dition',
    'NUMBER_OPTIONS'    => 'Nombre d\'options',
    'MAXIMUM'           => 'Maximum',
    'MO'                => 'Mo',
    'KO'                => 'Ko',
    'MAXIMUM_FILE_SIZE' => 'Taille maximale',
    'PREVIOUS_MESSAGES' => 'Message(s) pr&eacutec&eacutedent(s)',
    // views/frontend/modules/Forum/searchForm.php
    'SEARCHING'         => 'Rechercher',
    'KEYWORDS'          => 'Mots cl�s',
    'MATCH_OR'          => 'Rechercher n\'importe lequel de ces termes',
    'MATCH_AND'         => 'Rechercher tous les termes',
    'MATCH_EXACT'       => 'Rechercher l\'expression',
    'SEARCH_INTO'       => 'Recherche dans',
    'BOTH'              => 'Tous les deux',
    'NB_ANSWERS'        => 'Nombre de r�ponses',
    // views/frontend/modules/Forum/searchResult.php
    'FSEARCH_RESULT'    => 'R�sultats de la recherche',
    'FSEARCH_FOUND'     => 'r�ponse(s) trouv�e(s) pour',
    'FNO_SEARCH_FOUND'  => 'Aucune r�ponse trouv�e pour',
    'FNO_LAST_VISIT_MESSAGE' => 'Aucun message post� depuis votre derni�re visite',
    'FNO_SEARCH_RESULT' => 'Aucune r�ponse trouv�e pour vos crit�res de recherche',
    // views/frontend/modules/Forum/viewForum.php
    'NEW'               => 'Nouveau',
    'MARK_SUBJECT_READ' => 'Marquer tous les sujets comme lus',
    'NO_POST_FORUM'     => 'Il n\'y a pas de messages dans ce forum',
    'CREATED_BY'        => 'Cr�e par',
    'POST_NEW'          => 'Nouveaux messages',
    'NO_POST_NEW'       => 'Pas de nouveaux messages',
    'POST_NEW_CLOSE'    => 'Nouveaux messages ferm�s',
    'SUBJECT_CLOSE'     => 'Sujet ferm�',
    'POST_NEW_HOT'      => 'Nouveaux messages populaires',
    'NO_POST_NEW_HOT'   => 'Pas de nouveaux messages populaires',
    'JUMP_TO'           => 'Sauter vers',
    'SELECT_FORUM'      => 'S�lectionner un forum',
    'SEE_THE_TOPIC'     => 'Montrer les sujets depuis',
    'THE_FIRST'         => 'le d�but',
    'ONE_DAY'           => '1 jour',
    'ONE_WEEK'          => '1 semaine',
    'ONE_MONTH'         => '1 mois',
    'SIX_MONTH'         => '6 mois',
    'ONE_YEAR'          => '1 an',
    // views/frontend/modules/Forum/viewtopic.php
    'NEW_TOPIC'         => 'Nouveau message',
    'REPLY'             => 'R�pondre',
    'EDIT_POLL'         => 'Editer le sondage',
    'DELETE_POLL'       => 'Supprimer le sondage',
    'TOTAL_VOTE'        => 'Total votes',
    'BACK_TO_TOP'       => 'Revenir en haut',
    'PERMALINK_TITLE'   => 'Lien direct vers ce message',
    'FAVORITE_GAME'     => 'Jeu favori',
    'REPLY_QUOTE'       => 'R�pondre en citant',
    'EDIT_MESSAGE'      => 'Editer ce message',
    'DELETE_MESSAGE'    => 'Supprimer ce message',
    'DOWNLOAD_FILE'     => 'T�l�charger ce fichier joint',
    'DELETE_FILE'       => 'Supprimer ce fichier joint',
    'SEE_PROFIL'        => 'Voir le profil',
    'SEND_PM'           => 'Lui envoyer un message priv�',
    'NOTIFY_ON'         => 'Surveiller le sujet',
    'NOTIFY_OFF'        => 'Arr�ter de surveiller le sujet',
    'TOPIC_UNLOCK'      => 'Ouvrir le sujet',
    'TOPIC_LOCK'        => 'Fermer le sujet',
    'TOPIC_DOWN'        => 'Mettre en sujet',
    'TOPIC_UP'          => 'Mettre en annonce',
    'TOPIC_DELETE'      => 'Supprimer ce sujet',
    'TOPIC_MOVE'        => 'D�placer ce sujet'
);

?>
