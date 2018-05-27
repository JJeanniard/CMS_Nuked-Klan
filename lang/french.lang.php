<?php
defined('INDEX_CHECK') or die ('You can\'t run this file alone.');

// For 1.7.x compatibility

// install / update
define('_NKVERSION', '1.8');
define("_WELCOMEINSTALL",'Bienvenue sur Nuked-Klan '._NKVERSION);
define("_GUIDEINSTALL","L'assistant va vous guider � travers les �tapes de l'installation de votre portail...<br /><br /><b>Merci de laisser le copyleft sur votre site pour respecter la licence GNU.</b>");
define("_TYPEINSTALL","Que voulez-vous faire ?");
define("_INSTALLPASPAS","Installation avec assistance");
define("_INSTALL","Installation rapide");
define("_UPGRADE","Mise � jour avec informations");
define("_INSTALLNK",'Installation de Nuked-Klan '._NKVERSION);
define('_UNABLE_TO_SAVE_CONFIG_FILE', 'Sauvegarde de votre fichier de configuration impossible.V&eacute;rifiez les permissions du r&eacute;pertoire %s');
define('_DIRECTORY_NOT_WRITEABLE', "Impossible d'&eacute;crire dans le r&eacute;peretoire %s. V&eacute;rifiez ses permissions");
define("_INSTALLPROGRESS","Installation en cours...");
define("_CREATES",".....Cr�e");
define("_MODIFS",".....Modifi�e");
define("_INSERTFIELD","Installation de la base de donn�es termin�e !");
define("_INSERTFINISH","Termin� !");
define("_GODCONF","Configuration de l'administrateur");
define("_CONFIG","Configuration");
define("_GODNICK","Pseudo");
define("_GODPASS","Mot de passe");
define("_PASSCONFIRM","Confirmez le mot de passe");
define("_GODMAIL","Adresse email");
define("_GODFAILDED","Pseudo ou Mot de passe incorrect");
define("_NKUPGRADE",'Mise � Jour de Nuked-Klan 1.7 vers '._NKVERSION);
define("_BADVERSION",'Votre version de Nuked-Klan ne peut pas �tre mise � jour en '._NKVERSION.' !');
define("_CONGRATULATION","F�licitation : Installation Termin�e...");
define("_REDIRECT","Vous allez �tre redirig� vers la page d'accueil de votre site");
define("_CLICIFNO","Cliquez ici si rien ne se passe");
define("_ERRORCHMOD","Veuillez supprimer les fichiers <b>install.php</b> et <b>update.php</b> de votre FTP !<br />Modifiez �galement l'attribut en CHMOD 777 des r�pertoires :<br /><br /><b>- images/icones/<br />- upload/Download/<br />- upload/Forum/<br />- upload/Gallery/<br />- upload/News/<br />- upload/Suggest/<br />- upload/User/<br />- upload/Wars/</b>");
define("_GOHOME","Cliquez ici pour aller sur votre site.");
//define("_FIRSTNEWSTITLE",'Bienvenue sur votre site NuKed-KlaN '._NKVERSION);
//define("_FIRSTNEWSCONTENT","Bienvenue sur votre site NuKed-KlaN, votre installation s\'est, � priori, bien d�roul�e, rendez-vous dans la partie administration pour commencer � utiliser votre site tout simplement en vous loguant avec le pseudo indiqu� lors de l\'install. En cas de probl�mes, veuillez le signaler sur  <a href=\"https://nuked-klan.fr\">https://nuked-klan.fr</a> dans le forum pr�vu � cet effet.");
define("_DBHOST","Host MySQL");
define("_DBUSER","User");
define("_DBPASS","Password");
define("_DBPREFIX","Prefix");
define("_DBNAME","Nom de la Base");
define("_CHMOD","Avant de continuer, assurez-vous d'avoir accord� les droits en �criture<br />sur les fichiers install.php ou update.php");
define("_NEXT","Suivant");
define("_RETRY","R�essayer");
define("_CONFIGSAVE","Configuration sauvegard�e");
define("_ERRORCONNECTDB","Impossible de se connecter � la base de donn�es, assurez vous d'avoir correctement rempli le formulaire !");
define("_BADCHMOD","Impossible d'�crire dans le fichier <b>conf.inc.php</b>, v�rifiez les droits en �criture (CHMOD) !");
define("_CLICNEXTTOINSTALL","Cliquez sur suivant pour continuer l'installation");
define("_CLICNEXTTOUPGRADE","Cliquez sur suivant pour continuer la mise � jour");

define("_ETAPE2","Etape 2");
define("_CHOIX","Explication");

define("_ETAPE3","Etape 3");
define("_CONFIGSQL", "Configuration SQL");
define("_CONFIGSQLASSIS", "Configuration SQL avec explication");
define("_ETAPE4","Etape 4");
define("_UPGRADESPEED","Mise � jour rapide");

define("_SECURITE","S�curit�");
define("_DECOUVERTE",'Nuked-klan '._NKVERSION.': la d�couverte');
define("_NEWSADMIN","Une nouvelle administration");
define("_PROCHE","Un site officiel proche de sa communaut�e");
define("_SIMPLIFIE","Une installation simplifi�e");
define("_DECOUVERTE1",'Vous allez installer Nuked-Klan '._NKVERSION.', cette version orient�e gamers permettra � votre team de b�n�ficier rapidement d\'un site web � votre image.</p><p>Vous pourrez cr�er une vie � votre groupe, le rassembler facilement, g�rer des recrutements, des matchs ou un serveur tr�s facilement.');
define("_NEWSADMIN1","Pour cette nouvelle version, nous avons r�alis� une nouvelle administration plus intuitive et plus agr�able.</p><p>Vous pourrez suivre les actions des administrateurs, voir les notifications, acc�der � un chat priv� entre admininistrateurs et d�couvrir de multiples nouvelles fonctionnalit�s comme le bannissement temporaire.");
define("_PROCHE1","Connecter 24h/24h avec Nuked-Klan.org, nous pouvons vous envoyer des messages, des avertissements sur certains modules et m�me des mises � jour automatiques de votre site.<br />Notre support est disponible quelque soit votre probl�me.");
define("_SIMPLIFIE1","Une installation plus design, plus intuitive, mais surtout une nouvelle installation avec assistance. Si vous avez d�j� mani� l'installation d'un CMS tel que Nuked-Klan alors choisissez l'installation rapide sauf si vous voulez voir les nouvelles fonctionnalit�s.</p><p>Cependant avec l'installation avec assistance, nous vous d�taillons et accompagnons �tape par �tape pour chaque case de formulaire, et si malgr� cela, vous n'y arrivez pas, pas de soucis, nous sommes l� pour vous aider !");

define("_NEWNKNEWRELEASE",'Nouveaut�s Nuked Klan '._NKVERSION);
define("_SECURITE1","Cette nouvelle version a retravaill� enti�rement la s�curit�, les injections SQL et hexad�cimales ou m�me par cookie, upload, et m�me les mots de passe qui ne sont plus en md5.<br /> De plus, un syst�me de signature a �t� mise en place, ainsi si vous installez un module dangereux, nous pourrons vous avertir. Nous avons mis en place aussi un syst�me de mise � jour automatique. D�s qu'une faille est d�couverte, elle est corrig�e imm�diatement sans que vous vous en aperceviez.<br /> Nous pouvons aussi vous envoyer des messages depuis le site officiel, afin de vous avertir, informer ou autre...");
define("_OPTIMISATION","Optimisation");
define("_OPTIMISATION1","Nous avons optimis� quelques codes comme le syst�me de pagination afin de rendre l�g�rement moins lourd votre site, cependant nous n'avons pu optimis� tout le code ne s'agissant que d'une mise � jour 1.7.X.");

define("_ADMINISTRATION1","Afin de r�aliser une administration de notre �poque, nous avons pr�f�r� repartir de z�ro, et concevoir un syst�me dans lequel administrateurs, utilisateurs,
		machines, et sites officiels seraient reli�s.
		Pour cela, nous avons mis en place des syst�mes de communication comme les notifications, les actions, les discussions admin, mais aussi les signatures des modules
		les mises � jour, les messages.
		Cette administration poss�de un panneau capable de vous transporter n'importe o� dans votre administration mais aussi de vous avertir.");
define("_BANTEMP","Ban temporaire");
define("_BANTEMP1","Un syst�me de bannissement temporaire a �t� mise en place, vous avez donc le choix de bannir l'utilisateur 1 jour, 7 jours, 1 mois, 1 an, ou d�finitivement.");
define("_SHOUTBOX","Shoutbox ajax");
define("_SHOUTBOX1","Un nouveau bloc textbox a �t� d�velopp�, il est capable de dire qui est en ligne, il est en ajax, c'est � dire que vous pouvez envoyer des messages sans rechargement de
		la page. De plus, le bloc affiche les nouveaux messages sans rechargement de la page.");
define("_ERRORSQL","Gestions des erreurs SQL");
define("_ERRORSQL1","Ce syst�me est � double sens, lorsqu'un visiteur tombe sur une erreur SQL, plut�t que de voir l'erreur, il est redirig� vers une page d'excuse, et un
		rapport de l'erreur SQL est envoy� dans l'administration.");
define("_MULTIWARS","Multi-map module wars");
define("_MULTIWARS1","Le nouveau module permet de visionner les prochains matchs mais aussi il permet de choisir le nombre de maps, il y a alors un score par map, puis un score final
		qui est la moyenne des scores par map.");
define("_COMSYS","Syst�me commentaires");
define("_COMSYS1","Le nouveau syst�me de commentaires permet rapidement d'envoyer un commentaire en ajax et de visionner les 4 derniers commentaires.");
define("_EDITWYS","Editeur WYSIWYG");
define("_EDITWYS1","Ce nouveau syst�me permet d'avoir une visualisation rapide de votre message, news ou autre apr�s mise en forme.");
define("_MISAJ","Mise � jour automatique");
define("_MISAJ1","Si une faille est d�tect�e, nous pouvons mettre � jour rapidement tous les sites depuis Nuked-Klan.org, et ainsi s�curiser votre site sans effectuer
		de modifications et sans interrompre votre navigation.");
define("_CONT","Module Contact");
define("_CONT1","Nous avons ajout� le module contact indispensable au fonctionnement d'un site web.");
define("_ERREURPASS","Erreur mot de passe");
define("_ERREURPASS1","Lorsqu'un utilisateur se trompe de mot de passe 3 fois de suite, il doit alors recopier un code de s�curit� en plus de son login afin de se connecter � son compte.");
define("_DIFFMODIF","Diff�rentes modifications");
define("_DIFFMODIF1","En plus des modifications pr�c�dentes, nous avons effectu� diverses modifications comme la page 404, o� m�me des modifications non visibles comme le captcha.");
define("_INSTALLHOST","Il s'agit ici de l'adresse du serveur MySQL de votre h�bergement, celui-ci contient toutes vos donn�es textes, membres, messages... En g�n�ral, il s'agit de localhost, mais dans tous les cas, l'adresse est indiqu�e dans votre mail d'inscription de votre h�bergeur ou dans l'administration de votre h�bergement.");
define("_INSTALLDBUSER","Il s'agit de votre identifiant qui vous permet de vous connecter � votre base SQL.");
define("_INSTALLDBPASS","Il s'agit du mot de passe de votre identifiant qui vous permet de vous connecter � votre base SQL.");
define("_INSTALLDBPREFIX", "Le prefix permet d'installer plusieurs fois nuked-klan sur une seule base SQL en utilisant un prefix diff�rent � chaque fois, par d�faut, il s'agit de nuked, mais vous pouvez le changer comme vous le voulez.");
define("_INSTALLDBDBNAME","Il s'agit du nom de votre base de donn�es MySQL, souvent vous devez vous rendre dans l'administration de votre h�bergement pour cr�er une base de donn�es, mais quelques fois celle-ci vous est d�j� fournie dans le mail d'inscription � votre h�bergement.");
// Check installation:
define("_CHECKCURRING", "<p>V�rification de la compatibilit�...<br /></p>\n");
define("_PHPVERSION", 'PHP version &ge; 5.1');
define("_MYSQLEXT", 'Extension MySQL');
define("_SESSIONSEXT", 'Extension des sessions');
define("_QUESPHPVERSION", 'Veuillez demander � votre h�bergeur de passer en PHP 5.1. Certains h�bergeurs demande un .htaccess ou autres.');
define("_SESSIONPATH", 'Veulliez cr�er un r�pertoire nomm�e: ');
define("_DIRECTORY", 'Chemin des sessions');
define("_MHASH", 'Extension mhash');
define("_FINFO", "<p>Nous essayons d'utiliser mime � la place de finfo pour la s�curit�:</p>");
define("_FORCE", "Il y a une ou plusieurs erreurs fatales de compatibilit�s. Nous ne pouvons installer Nuked-Klan.\n");
define("_NEXTLANG", "<p>Tu peux forcer l'installation de nuked-klan <a href=\"?action=install&amp;langue=french\">ici</a></p>\n");
define("_SYSTEMINSTALL","Votre site est pr�t a �tre install�.<br />\n");
define("_NEXTSTEP", "Etape suivante");
// new update
define('_SELECTLANG', 'S�lection de la langue');
define('_CHECKVERSION', 'V�rification de la version install�e');
define('_CHECKCOMPATIBILITY', 'V�rification de la compatibilit�');
define('_CHECKACTIVATION', 'Activation des Statistiques');
define('_DBSAVE', 'Sauvegarde de la Base de donn�es');
define('_CHECKTYPEUPDATE', 'Choix du type de Mise � jour');
define('_CURRENTVERSIONUSED', 'Vous utilisez actuellement la version');
define('_CONFIRM', 'Confirmer');
define('_NOOTHERVERSION', 'Non! J\'utilise une autre version');
define('_PLSSELECTVERSION', 'Veuillez choisir votre version de NK');
define('_WARNCHANGEVERSION', '<b>ATTENTION !!!</b> Modifer votre version uniquement si vous savez ce que vous faites.<br/>Toutes erreurs pourrait entra�ner la suppression de vos donn�es.');
define('_CHECKCOMPATIBILITYHOSTING', 'V�rification de la compatibilit� avec votre hebergement');
define('_ZIPEXT', 'Extension Zip');
define('_FILEINFOEXT', 'Extension File Info');
define('_HASHEXT', 'Extension Hash');
define('_GDEXT', 'Extension GD');
define('_TESTCHMOD', 'Test du CHMOD');
define('_COMPOSANT', 'Composant');
define('_COMPATIBILITY', 'Compatibilit�');
define('_BADHOSTING', 'Votre h�bergement n\'est pas compatible avec la nouvelle version de Nuked-Klan.');
define('_CONTINUE', 'Continuer');
define('_EDITCONFIG', 'Mise � jour de la configuration');

// Common
define('_NONE', 'Aucun');
define('_TITLE', 'Titre');
define('_COLOR', 'Couleurs');
define("_ADMIN","Admin");
define("_ADMINISTRATION","Administration");
define("_MEMBERS","Membres");
define("_SITEURL","URL du Site");
define("_NICK","Pseudo");
define("_PASSWORD","Pass");
define("_YOUVE","Vous avez");
define("_MODULE","Module");
define("_TLINK","Lien");
define("_MESS","message(s)");
define("_ACCOUNT","Compte");
define("_3TYPEMIN","3 caract�res Minimum pour le Pseudo");
define("_4TYPEMIN","4 caract�res Minimum pour le Mot de passe");
define("_PASSFAILED","Vous n\'avez pas saisi le m�me mot de passe");
define("_AT","�");
define("_THE","le");
define("_BY","par");
define("_DATE","Date");
define("_URL","URL");
define("_COMMENT","Commentaire");
define("_RESULT","R�sultats");
define("_REQUIRED","obligatoire");
define("_OPTIONAL","optionnel");
define("_EDIT","Editer");
define("_DEL","Supprimer");
define("_MORE","Suite");
define("_ORDERBY","Classer par");
define("_IMAGE","Image");
define("_NONICK","Vous n\'avez pas entr� votre pseudo !");
define("_HELP","Aides");
define("_DESCR","Description");
define("_CAT","Cat�gorie");
define("_NAME","Nom");
define("_BADMAIL","Adresse email non valide !");
define("_REPLACE","Ecraser");
define("_REPLACEIT","Pour la remplacer veuillez cocher la case \""._REPLACE."\"");
define("_AUTOR", "Auteur");
define("_COUNTRY","Pays");
define("_ADDTHE","Ajout� le");
define("_MAIL","Email");
define("_ALL","Tous");
define("_CONFIRM_TO_DELETE","Vous �tes sur le point de supprimer");
define("_MO","Mo");
define("_KO","Ko");
define("_MODIF","Modifier");
define("_TEAM","Team");
define("_CANCEL","Annuler");
define("_GAME","Jeu");
define("_THEREIS","Il y a");
define("_NBCAT","cat�gories");
define("_INDATABASE","dans la base de donn�es");
define("_NOTE","Note");
define("_NOTEXT","Vous n\'avez pas entr� de texte !");
define("_NOTITLE","Vous n\'avez pas entr� de titre !");
define("_BADTIME","Vous n\'avez pas entr� un horaire correct !");
define("_BADDATE","Vous n\'avez pas entr� une date correcte !");

// menu
define("_NAV","Menu");
define("_NAVHOME","Accueil");
define("_NAVNEWS","News");
define("_NAVFORUM","Forum");
define("_NAVDOWNLOAD","T�l�chargements");
define("_NAVTEAM","Team");
define("_NAVMEMBERS","Membres");
define("_NAVDEFY","Nous D�fier");
define("_NAVRECRUIT","Recrutement");
define("_NAVART","Articles");
define("_NAVSERVER","Serveurs");
define("_NAVLINKS","Liens Web");
define("_NAVCALENDAR","Calendrier");
define("_NAVGALLERY","Galerie");
define("_NAVMATCHS","Matchs");
define("_NAVARCHIV","Archives");
define("_NAVIRC","IrC");
define("_NAVGUESTBOOK","Livre d\'Or");
define("_NAVSEARCH","Recherche");
define("_NAVSTRATS","Strat�gies");
define("_NAVACCOUNT","Compte");
define("_NAVADMIN","Administration");
define("_MEMBER","Membre");

// Block management
define("_BLOCK","Blocs");
define("_POSITION","Position");
define("_TYPE","Type");
define("_LEVEL","Niveau");
define("_LEFT","Gauche");
define("_RIGHT","Droite");
define("_CENTERBLOCK","Centre");
define("_FOOTERBLOCK","Bas");
define("_OFF","D�sactiv�");
define("_HTMLBLOCK","Ce block est en HTML");
define("_MODBLOCK","Blocs d'un module");
define("_PAGESELECT","S�lectionnez les pages o� vous souhaitez que le block s'affiche");
define("_MODIFBLOCK","Modifier ce block");

// bbcode
define("_SIZE","Taille");
define("_CODE","Code");
define("_ENTERSITEURL","Entrez l\'url de votre site");
define("_ENTERSITENAME","Entrez le nom de votre site");
define("_ENTERIMGURL","Entrez l\'url de votre image");
define("_ENTERFLASHURL","Entrez l\'url de votre animation flash");
define("_ENTERWIDTH","Entrez la largeur");
define("_ENTERHEIGHT","Entrez la longueur");
define("_ENTERTEXT","Entrez votre texte");
define("_TAPEYOURTEXT","Tapez votre texte ici");
define("_ENTERMAIL","Entrez l\'email");
define("_TEXT","Texte");
define("_QUOTE","Citation");
define("_LIST","Liste");
define("_BOLD","Gras");
define("_ITAL","Italique");
define("_UNDERLINE","Soulign�");
define("_BBOLD","Gras (Alt + b)");
define("_BITAL","Italique (Alt + i)");
define("_BCENTER","Centr� (Alt + c)");
define("_BUNDERLINE","Soulign� (Alt + u)");
define("_BSCREEN","Image (Alt + g)");
define("_BFLASH","Flash (Alt + s)");
define("_BURL","URL (Alt + w)");
define("_BLIST","Liste (Alt + l)");
define("_BQUOTE","Citation (Alt + q)");
define("_BCODE","Code (Alt + p)");
define("_BMAIL","Email (Alt + m)");
define("_RED","Rouge");
define("_DARKRED","Rouge fonc�");
define("_BLUE","Bleu");
define("_DARKBLUE","Bleu fonc�");
define("_ORANGE","Orange");
define("_BROWN","Marron");
define("_YELLOW","Jaune");
define("_GREEN","Vert");
define("_VIOLET","Violet");
define("_OLIVE","Olive");
define("_CYAN","Cyan");
define("_INDIGO","Indigo");
define("_WHITE","Blanc");
define("_BLACK","Noir");
define("_POLICE","Police");
define("_HASWROTE","a �crit");
define("_BBCLOSE","Fermer&nbsp;les&nbsp;balises");
define("_BBHELP","Aides BBcode");

// block_center.php
define("_BLOKLOGIN","Login");
define("_BLOKSEARCH","Recherche");
define("_BLOKSHOUT","Tribune libre");
define("_BLOKSTATS","Stats");
define("_LATESTWAR","Derniers Matchs");
define("_NEXTWAR","Prochains Matchs");
define("_IRCAWARD","Irc Awards");
define("_SERVERMONITOR","Serveur monitor");

// block_event.php
define("_JAN","Janvier");
define("_FEB","F�vrier");
define("_MAR","Mars");
define("_APR","Avril");
define("_MAY","Mai");
define("_JUN","Juin");
define("_JUL","Juillet");
define("_AUG","Ao�t");
define("_SEP","Septembre");
define("_OCT","Octobre");
define("_NOV","Novembre");
define("_DEC","D�cembre");

// block_login.php
define("_LOGOUT","D�connexion");
define("_BLOGIN","Connexion");
define("_WELCOME","Bienvenue");
define("_LOGIN","Login");
define("_SAVE","Enregistr�");
define("_REGISTER","S'enregistrer");
define("_FORGETPASS","Perdu votre Pass");
define("_ADMINS","Admins");
define("_LASTMEMBER","Dernier");
define("_MESSPV","Messages priv�s");
define("_NOTREAD","Nouveau(x)");
define("_READ","Archiv�(s)");
define("_SHOWAVATAR","Voir l'avatar");

// block_rss.php
define("_TITREACTU","Afficher le titre du flux");
define("_NBRRSS","Nombre de lien affich�");

// block_survey.php
define("_OTHERPOLL","Autres Sondages");
define("_POLL","Sondage");
define("_VOTE","vote(s)");

// block_theme.php
define("_BTHEMESELECT", "Choix du th�me");

// news
define("_NEWSPOSTBY","Post�e par");
define("_NEWSCOMMENT","Commentaires");

// pagination
define("_PAGE","Page");
define("_PREVIOUSPAGE","Page Pr�c�dente");
define("_NEXTPAGE","Page Suivante");

// captcha
define('_MSGCAPTCHA', 'Vous avez fait trop de tentatives, le captcha est d&eacute;sormais actif !');

// secu_html
define('_HTMLNOCORRECT', 'Le code HTML est mal format�');

// admin
define("_PREFS","Pr�f�rences");
define("_MOVEUP","Monter");
define("_MOVEDOWN","Descendre");
define("_NEWPAGE","New page");
define("_PREFUPDATED","Pr�f�rences modifi�es avec succ�s");

//define("_ADMINBLOCK","Gestion des Blocks");
//define("_THEREISNOW","Il y a actuellement");
//define("_ONLINE","en ligne.");
//define("_NOMEMBERONLINE","Aucun membre en ligne");
//define("_MEMBERONLINE","Membres en ligne");
//define("_SENDMESS","Lui envoyer un message priv� ?");
//define("_ONLINES","En ligne");
//define("_MODIFMENU","Modifier le menu");
//define("_NOMOD","Aucun");
//define("_INSERT","Insert");
//define("_PAGEPOLL","Vous �tes actuellement sur la page des sondages");
//define("_NOPOLL","Il n'y a pas encore de Sondage");
//define("_POLLID","ID du Sondage");
//define("_THEREWAS","Il y a eu");
//define("_ATTHISPOLL","� ce sondage");

define("_SUGGEST","Suggestion");
//define("_ONESUGGEST","Une suggestion ?");

//define("_GOTO_PRIVATE_MESSAGES", "Cliquez ici pour consulter votre messagerie");
//define("_CLICK_TO_CLOSE", "Cliquer pour fermer ce messsage");
//define("_MORESMILIES","Tous les smilies");
//define("_BLOKPARTNERS","Partenaires");
//define("_TMAIL","Email");

return array(
    // common
    'BACK'              => 'Retour',
    'YES'               => 'Oui',
    'NO'                => 'Non',
    'SEND'              => 'Envoyer',
    'VISITOR'           => 'Visiteur',
    //define("_VISITORS","visiteurs");
    'IMAGE'             => 'Image',
    'NONE'              => 'Aucun',
    'MEMBER'            => 'Membre',
    'TYPE'              => 'Type',
    'PREFERENCES'       => 'Pr�f�rences',
    'ALL'               => 'Tous',
    'TOKEN_NO_VALID'    => 'Le jeton du formulaire n\'est pas valide !',
    'DATE'              => 'Date',
    'EDIT'              => 'Editer',
    'TITLE'             => 'Titre',
    'COLOR'             => 'Couleur',
    'URL'               => 'URL',
    'BY'                => 'par',
    'STATS'             => 'Statistiques',
    'THE'               => 'le',
    'RESULT'            => 'R�sultats',
    'QUOTE'             => 'Citation',
    'AUTHOR'            => 'Auteur',
    'FILE'              => 'fichier',
    'LINE'              => 'ligne',
    'LINK'              => 'Lien',
    'CODE'              => 'Code',
    'NONE_CATEGORY'     => 'Aucune',
    'NA'                => 'N/C',

    // module name
    'ARCHIVES_MODNAME'  => 'Archives',
    'CALENDAR_MODNAME'  => 'Calendrier',
    'COMMENT_MODNAME'   => 'Commentaires',
    'CONTACT_MODNAME'   => 'Contact',
    'DEFY_MODNAME'      => 'D�fie',
    'DOWNLOAD_MODNAME'  => 'T�l�chargements',
    'EQUIPE_MODNAME'    => 'Equipe',
    'FORUM_MODNAME'     => 'Forum',
    'GALLERY_MODNAME'   => 'Galerie',
    'GAME_MODNAME'      => 'Jeux',
    'GUESTBOOK_MODNAME' => 'Livre d\'or',
    'IRC_MODNAME'       => 'IrC',
    'LINKS_MODNAME'     => 'Liens Web',
    'MEMBERS_MODNAME'   => 'Membres',
    'NEWS_MODNAME'      => 'News',
    'PAGE_MODNAME'      => 'Page',
    'RECRUIT_MODNAME'   => 'Recrutement',
    'SEARCH_MODNAME'    => 'Recherche',
    'SECTIONS_MODNAME'  => 'Articles',
    'SERVER_MODNAME'    => 'Serveurs',
    'STATS_MODNAME'     => 'Stats',
    'SUGGEST_MODNAME'   => 'Suggestion',
    'SURVEY_MODNAME'    => 'Sondage',
    'TEAM_MODNAME'      => 'Team',
    'TEXTBOX_MODNAME'   => 'Tribune libre',
    'VOTE_MODNAME'      => 'Vote',
    'WARS_MODNAME'      => 'Matches',

    // module RSS title
    'NEWS_RSS_TITLE'    => 'Les %d derni�res news',
    'SECTIONS_RSS_TITLE' => 'Les %d derniers articles',
    'DOWNLOAD_RSS_TITLE' => 'Les %d derniers t�l�chargements',
    'LINKS_RSS_TITLE'   => 'Les %d derniers liens',
    'GALLERY_RSS_TITLE' => 'Les %d derni�res images',
    'FORUM_RSS_TITLE'   => 'Les %d derniers sujets',

    // ban.php
    // nkHandle_bannedUser function (nuked.php)
    'BAN_FINISHED'      => ' n\'est plus banni, sa p�riode est arriv�e � expiration: [<a href="index.php?file=Admin&page=user&op=main_ip">Lien</a>].',
    // ban.php
    '1DAY'              => '1 jour',
    '7DAY'              => '1 semaine',
    '1MONTH'            => '1 mois',
    '1YEAR'             => '1 an',
    'FOREVER'           => 'A vie',

    // adminInit function (nuked.php)
    'MODULE_OFF'        => 'D�sol�, ce module n\'est pas activ� !',
    'NO_ENTRANCE'       => 'D�sol� mais vous n\'avez pas les droits pour acc�der � cette page',
    'ZONE_ADMIN'        => 'Cette zone est r�serv�e � l\'Admin, d�sol�...',

    // getCheckNicknameError function (nuked.php)
    'BAD_NICKNAME'      => 'Pseudo incorrect, certains caract�res sont interdits.',
    'RESERVED_NICKNAME' => 'Ce pseudo est d�j� r�serv�.',
    'BANNED_NICKNAME'   => 'Ce pseudo est banni.',
    'NICKNAME_TOO_LONG' => 'Votre pseudo est trop long.',
    // getCheckEmailError function (nuked.php)
    'BAD_EMAIL'         => 'Votre Email n\'est pas correct.',
    'BANNED_EMAIL'      => 'Ce mail est banni.',
    'RESERVED_EMAIL'    => 'Cet Email est d�j� r�serv�.',
    // nkAction_checkConstant - Includes/nkAction.php
    'MISSING_NKACTION_PARAMETERS'  => 'Le param�tre %s n\'a pas �t� d�fini dans la configuration de nkAction!',
    // nkAction_checkConfigurationFile - Includes/nkAction.php
    'MISSING_CFG_FILE'  => 'Le fichier de configuration n\'existe pas !',
    'MISSING_FUNCTION'  => 'La fonction %s n\'existe pas !',
    // nkAction_getSuccessMsg - Includes/nkAction.php
    'DATA_ADDED'        => 'Donn�e ajout�e avec succ�s.',
    'DATA_MODIFIED'     => 'Donn�e modifi�e avec succ�s.',
    'DATA_DELETED'      => 'Donn�e supprim�e avec succ�s.',
    // nkAction_edit - Includes/nkAction.php
    'DATA_NO_EXIST'     => 'Les donn�es n\'existe pas !',
    // nkAction_save - Includes/nkAction.php
    'PREFERENCES_UPDATED' => 'Pr�f�rences modifi�es avec succ�s',
    // nkAction_deleteConfirmation - Includes/nkAction.php
    'OPERATION_CANCELED' => 'Op�ration annul� !',

    // nkAction_delete - Includes/nkAction.php
    'MISSING_ID_URI'    => 'Aucun id %s d�fini !',
    // nkAction_list - Includes/nkAction.php
    'EDIT_THIS_DATA'    => 'Editer cette donn�e',
    'CONFIRM_TO_DELETE_DATA' => 'Vous �tes sur le point de supprimer %s ! Confirmer',
    'DELETE_THIS_DATA'  => 'Supprimer cete donn�e',
    'NO_DATA_IN_DB'     => 'Aucune donn�e dans la base de donn�es',
    'ADD_DATA'          => 'Ajouter une donn�e',
    // validCaptchaCode - Includes/nkCaptcha.php
    'CT_NO_TOKEN'       => 'Token introuvable !<br />Veuillez utiliser le formulaire.',
    'CT_BAD_TOKEN'      => 'Token incorrect !<br />Veuillez utiliser le formulaire.',
    'CT_BAD_JS'         => 'La validation javascript a �chou�e !<br />Veuillez activer javascript.',
    'CT_BAD_FIELD'      => 'La validation antiRobot a �chou�e !<br />Veuillez utiliser le formulaire.',
    // nkDB_execute - Includes/nkDB/*
    'SQL_ERROR_DETECTED' => 'Une erreur SQL a �t� d�tect�e',
    // nkSitemap_write - Includes/nkSitemap.php
    'WRITE_SITEMAP_FAILED' => 'Impossible d\'�crire le fichier sitemap.xml dans le dossier contenant Nuked-Klan<br/>Veuillez mettre manuellement le CHMOD <strong>0755</strong> sur ce dossier.',
    // nkUpload_check - Includes/nkUpload.php
    'UPLOAD_DIRECTORY_NO_EXIST' => 'Le dossier d\'upload n\'existe pas !',
    'UPLOAD_DIRECTORY_NO_WRITEABLE' => 'Le dossier d\'upload n\'a pas les droits d\'�criture !',
    'UPLOAD_IMAGE_FAILED' => 'Le T�l�chargement de l\'image a �chou� !',
    'UPLOAD_FILE_FAILED' => 'Le T�l�chargement du fichier a �chou� !',
    'UPLOAD_HTACCESS_PROHIBITED' => 'Le T�l�chargement de fichier .htaccess est interdit !',
    'UPLOAD_IMAGE_TOO_BIG' => 'Votre image est trop grande, uniquement les images de moins de %d Ko sont autoris�es',
    'UPLOAD_FILE_TOO_BIG' => 'Votre fichier est trop grand, uniquement les fichiers de moins de %d Ko sont autoris�es',
    'BAD_FILE_EXTENSION' => 'L\'extension du fichier n\'est pas autoris� %s',
    'BAD_IMAGE_FORMAT'  => 'Mauvais format d\'image, uniquement les images aux formats jpg, png ou gif sont autoris�es',
    'IMAGE_ALREADY_EXIST' => 'Une image portant le m�me nom est d�j� pr�sente sur votre ftp.',
    'FILE_ALREADY_EXIST' => 'Un fichier portant le m�me nom est d�j� pr�sent sur votre ftp.',
    'REPLACE_FILE'      => 'Pour le(s) remplacer veuillez cocher la case "Ecraser"',
    'OVERWRITE'         => 'Ecraser',
    // nkUserSocial_getLinkTitle - Includes/nkUserSocial.php
    'SEND_EMAIL'        => 'Lui envoyer un email',
    'SEE_HOME_PAGE'     => 'Voir le site web de %s',
    'USER_LABEL_EMAIL'  => 'Email publique',
    'LABEL_EMAIL'       => 'Email',
    // views/frontend/banishmentMessage.php
    'IP_BANNED'         => 'Vous avez �t� banni de ce site et n\'�tes donc plus autoris� � y acc�der.',
    'REASON'            => 'Raison :',
    'CONTACT_WEBMASTER' => 'Pour toutes contestations, veuillez contacter le webmaster',
    'DURING'            => 'Dur�e',
    // views/frontend/notification.php
    // views/frontend/nkAlert/userEntrance.php
    'CLOSE_WINDOW'      => 'Fermer la fen�tre',
    // views/frontend/nkAlert/nkInstallDirTrue.php
    'REMOVE_DIR_INST'   => 'Veuillez supprimer le dossier d\'installation de Nuked-Klan (/INSTALL/)',
    // views/frontend/nkAlert/nkInstallFileTrue.php
    'REMOVE_INSTALL_FILES' => 'Veuillez supprimer les fichiers install.php ou update.php &agrave; la racine de votre FTP.',
    // views/frontend/nkAlert/nkNewPrivateMsg.php
    'NEW_PRIVATE_MESSAGE' => array(1 => 'Vous avez re�u %d nouveau message', 2 => 'Vous avez re�u %d nouveaux messages'),
    'GO_TO_PRIVATE_MESSAGES' => 'Cliquez ici pour consulter votre messagerie',
    // views/frontend/nkAlert/nkSiteClosedLogged.php
    'YOUR_SITE_IS_CLOSED' => 'Votre site est actuellement ferm� et accessible uniquement aux administrateurs supr�mes. En cas de d�connexion, veuillez vous identifiez par cette URL',
    // views/frontend/nkAlert/noExist.php
    'NO_EXIST'          => 'D�sol� cette page n\'existe pas ou l\'adresse que vous avez tap� est incorrecte',
    // TODO : See modules/404/lang/french.lang.php

    // views/frontend/nkAlert/userEntrance.php
    'USER_ENTRANCE'     => 'D�sol� cette zone est r�serv�e aux utilisateurs enregistr�s.',
    'LOGIN_USER'        => 'Identification',
    'REGISTER_USER'     => 'Enregistrement',
    // views/frontend/websiteClosed.php
    'WEBSITE_CLOSED'    => 'Ce site est momentan�ment ferm� pour cause de travaux, merci de r�essayer plus tard',
    // Includes/blocks/block_survey.php TODO : Temporary
    // sondage - modules/Survey/index.php TODO : Temporary
    // views/frontend/modules/Forum/viewTopic.php
    // views/frontend/modules/Vote/voteForm.php
    'TO_VOTE'           => 'Voter',

    // views/frontend/modules/Forum/main.php
    // bloc login
    'WHO_IS_ONLINE'     => 'Qui est en ligne ?',

);

?>
