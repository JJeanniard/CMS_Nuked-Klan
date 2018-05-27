<?php
/**
 * french.lang.php
 *
 * French translation for install / update process
 *
 * @version 1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */

return array(
    #####################################
    # bbcode->apply()
    #####################################
    'CODE'                  => 'Code',
    'QUOTE'                 => 'Citation',
    'HAS_WROTE'             => 'a �crit',
    #####################################
    # db->load()
    #####################################
    'UNKNOW_DATABASE_TYPE'  => 'Type de base de donn�es `%s` inconnu',
    #####################################
    # dbMySQL->_getDbConnectError()
    #####################################
    'DB_HOST_CONNECT_ERROR' => 'Veuillez contr�ler le nom du serveur %s.',
    'DB_LOGIN_CONNECT_ERROR' => 'Veuillez contr�ler le nom d\'utilisateur et le mot de passe.',
    'DB_NAME_CONNECT_ERROR' => 'Veuillez contr�ler le nom de la base de donn�es.',
    'DB_CHARSET_CONNECT_ERROR' => 'Votre base de donn�es ne supporte pas l\'interclassement %s',
    #####################################
    # dbTable->getFieldType()
    #####################################
    'FIELD_DONT_EXIST'      => 'Le champ `%s` n\'existe pas',
    #####################################
    # dbTable->checkIntegrity()
    #####################################
    'MISSING_TABLE'         => 'La table `%s` n\'existe pas',
    'MISSING_FIELD'         => 'Champs `%s` manquant dans la table `%s`',
    #####################################
    # dbTable->checkAndConvertCharsetAndCollation()
    #####################################
    'CONVERT_CHARSET_AND_COLLATION' => 'Table `%s` convertie avec pour interclassement `%s` et collation `%s`',
    #####################################
    # dbTable->createTable()
    #####################################
    'CREATE_TABLE'          => 'Cr�ation de la table `%s`',
    #####################################
    # dbTable->renameTable()
    #####################################
    'RENAME_TABLE'          => 'Table `%s` renomm� en `%s`',
    #####################################
    # dbTable->dropTable()
    #####################################
    'DROP_TABLE'            => 'Supression de la table `%s` si existante',
    #####################################
    # dbTable->addField()
    #####################################
    'FIELD_TYPE_NO_FOUND'   => 'Type du champ `%s` non d�finit',
    'ADD_FIELD'             => 'Champ `%s` ajout� � la table `%s`',
    #####################################
    # dbTable->modifyField()
    #####################################
    'MODIFY_FIELD'          => 'Champ `%s` modifi� � la table `%s`',
    #####################################
    # dbTable->dropField()
    #####################################
    'DROP_FIELD'            => 'Champ `%s` supprim� de la table `%s`',
    #####################################
    # dbTable->addFieldIndex()
    #####################################
    'ADD_FIELD_INDEX'       => 'Index ajout� au champ `%s` de la table `%s`',
    #####################################
    # dbTable->dropForeignKey()
    #####################################
    'FOREIGN_KEY_DONT_EXIST' => 'Cl� �trang�re `%s` manquante dans la table `%s`',
    'DROP_FOREIGN_KEY'      => 'Cl� �trang�re `%s` supprim� de la table `%s`',
    #####################################
    # dbTable->setUpdateFieldData()
    #####################################
    'AND'                   => 'et',
    #####################################
    # dbTable->applyUpdateFieldListToData()
    #####################################
    'CALLBACK_UPDATE_FUNCTION_DONT_EXIST' => 'La fonction de rappel `%s` n\'existe pas',
    #####################################
    # process->main()
    #####################################
    'CORRUPTED_CONF_INC'    => 'Fichier conf.inc.php corrompu, veuillez �diter le fichier conf.inc.php.',
    'DB_PREFIX_ERROR'       => 'Le prefix est erron�, veuillez �diter le fichier conf.inc.php.',// TODO : ou la table est manquante...
    'LAST_VERSION_SET'      => 'Vous avez d�j� la derni�re version %s de Nuked-Klan',
    'BAD_VERSION'           => 'Votre version de Nuked-Klan ne peut pas �tre mise � jour directement.<br/>Veuillez d\'abord mettre � jour vers la version %s',
    #####################################
    # process->runTableProcessAction()
    #####################################
    'MISSING_FILE'          => 'Fichier introuvable : ',
    #####################################
    # process->_formatSqlError()
    #####################################
    'DB_CONNECT_FAIL'       => 'Connexion � la base de donn�es impossible !',
    'FATAL_SQL_ERROR'       => 'Une erreur SQL est survenue<br />Erreur : %s',
    #####################################
    # process->_writeDefaultContent()
    #####################################
    'FIRST_NEWS_TITLE'      => 'Bienvenue sur votre site NuKed-KlaN %s',
    'FIRST_NEWS_CONTENT'    => 'Bienvenue sur votre site NuKed-KlaN, votre installation s\'est, � priori, bien d�roul�e, rendez-vous dans la partie administration pour commencer � utiliser votre site tout simplement en vous loguant avec le pseudo indiqu� lors de l\'install. En cas de probl�mes, veuillez le signaler sur <a href="https://nuked-klan.fr">https://nuked-klan.fr</a> dans le forum pr�vu � cet effet.',
    #####################################
    # processConfiguration->_check()
    #####################################
    'MISSING_CONFIG_KEY'    => 'Cl� `%s` manquante dans le fichier INSTALL/config.php',
    'CONFIG_KEY_MUST_BE_STRING' => 'La cl� `%s` doit �tre une cha�ne de caract�re',
    'CONFIG_KEY_MUST_BE_ARRAY' => 'La cl� `%s` doit �tre un tableau',
    #####################################
    # view::__construct()
    #####################################
    'VIEW_NO_FOUND'         => 'Le fichier de la vue `%s` est manquant',
    #####################################
    # media/js/setDbConfiguration.js
    #####################################
    'DB_HOST_ERROR'         => 'Veuillez saisir le nom du serveur %s.',
    'DB_USER_ERROR'         => 'Veuillez saisir le nom d\'utilisateur.',
    'DB_PASSWORD_ERROR'     => 'Veuillez saisir un mot de passe.',
    'DB_PREFIX_ERROR'       => 'Veuillez saisir un prefix pour les tables de la base de donn�es.',
    'DB_NAME_ERROR'         => 'Veuillez saisir un nom pour la base de donn�es.',
    //'DB_PORT_ERROR'         => 'Veuillez saisir un port correct pour la connection au serveur',
    #####################################
    # media/js/runProcess.js
    #####################################
    'CHECK_TABLE_INTEGRITY' => 'V�rification de l\'integrit� de la table <b>%s</b>',
    'SUCCESS'               => 'R�ussi',
    'FAILURE'               => 'Echec',
    'CONVERTED_TABLE_SUCCESS' => 'Table <b>%s</b> convertie avec <span style="color:green;">succ�s</span>.',
    'FOREIGN_KEY_ADD_TO_TABLE_SUCCESS' => 'Cl�s �trang�res ajout�e � la table <b>%s</b> avec <span style="color:green;">succ�s</span>.',
    'CREATED_TABLE_SUCCESS' => 'Table <b>%s</b> cr�e avec <span style="color:green;">succ�s</span>.',
    'UPDATE_TABLE_SUCCESS'  => 'Table <b>%s</b> mise � jour avec <span style="color:green;">succ�s</span>.',
    'REMOVE_TABLE_SUCCESS'  => 'Table <b>%s</b> supprim�e avec <span style="color:green;">succ�s</span>.',
    'NO_TABLE_TO_DROP'      => 'Aucune table <b>%s</b> � supprimer.',
    'NOTHING_TO_CHECK'      => 'Rien � v�rifier pour la table <b>%s</b>',
    'NO_CONVERT_TABLE'      => 'Aucune conversion pour la table <b>%s</b>',
    'NOTHING_TO_DO'         => 'Aucune modification � effectu�e pour la table <b>%s</b>',
    'STEP'                  => 'Etape',
    'DROP_ALL_TABLE'        => 'Supression des tables',
    'DROP_ALL_TABLE_FAILED' => 'Il y a %d tables non supprim�e(s)',
    'CREATE_ALL_TABLE'      => 'Cr�ation des tables',
    'CREATE_ALL_TABLE_FAILED' => 'Il y a %d tables non cr�e(s)',
    'ADD_FOREIGN_KEY_ALL_TABLE' => 'Ajout des cl�s �trang�res des tables',
    'ADD_FOREIGN_KEY_ALL_TABLE_FAILED' => 'Il y a %d table(s) sans leur(s) cl�(s) �trang�re(s)',
    'CHECK_ALL_TABLE_INTEGRITY' => 'V�rification de l\'integrit� des tables',
    'CHECK_TABLE_CHARSET'   => 'V�rification de l\'encodage des tables',
    'CHECK_INTEGRITY_FAILED' => 'Il y a %d tables corrompue(s)',
    'TABLE_CONVERTION'      => 'Conversion des tables',
    'CONVERTED_TABLE_FAILED' => 'Il y a %d tables non convertie(s)',
    'INSTALL_PROCESS_SUCCESS' => 'L\'installation est termin�e ! Toutes les tables ont bien �t� cr�es.',
    'UPDATE_PROCESS_SUCCESS' => 'La mise � jour est termin�e ! Toutes les tables ont bien �t� modifi�es.',
    'INSTALL_FAILED'        => 'L\'installation est termin�e ! Mais des erreurs sont survenues, %d tables n\'ont pas �t� cr�e(s).',
    'UPDATE_FAILED'         => 'La mise � jour est termin�e ! Mais des erreurs sont survenues, %d tables n\'ont pas �t� modifi�e(s).',
    'PRINT_ERROR'           => ' - Erreur :',
    'UPDATE_TABLE_STEP'     => 'Mise � jour de la table <b>%1$s</b> : Etape <b>%2$s</b>',
    'UPDATE_ALL_TABLE'      => 'Mise � jour des tables',
    'UPDATE_ALL_TABLE_FAILED' => 'Il y a %d tables non mise(s) � jour',
    'CHECK_TABLE_INTEGRITY_ERROR' => 'Une erreur est survenue lors de la v�rification de la table',
    'CREATED_TABLE_ERROR'   => 'Une erreur est survenue lors de la cr�ation de la table',
    'UPDATE_TABLE_ERROR'    => 'Une erreur est survenue lors de la modification de la table',
    'STARTING_INSTALL'      => 'D�marrage de l\'installation.',
    'STARTING_UPDATE'       => 'D�marrage de la mise � jour.',
    #####################################
    # media/js/setSuperAdministrator.js
    #####################################
    'ERROR_NICKNAME'        => 'Le pseudo doit faire minimum 3 caract�res et ne peut contenir les caract�res suivants : $^()\'?%#\<>,;:',
    'ERROR_PASSWORD'        => 'Veuillez saisir un mot de passe.',
    'ERROR_PASSWORD_CONFIRM' => 'Les mots de passe ne correspondent pas.',
    'ERROR_EMAIL'           => 'Veuillez saisir un e-mail valide',
    #####################################
    # tables/table.action.c.fk.i.u.php
    #####################################
    'UPDATE_AUTHOR_DATA'    => 'Mise � jour des donn�es de l\'utilisateur dans les champs `%s` de la table `%s`',
    #####################################
    # tables/table.block.c.i.u.php
    #####################################
    'INSERT_DEFAULT_DATA'   => 'Insertion des donn�es par d�faut de la table `%s`',
    'APPLY_BBCODE'          => 'Application du BBcode sur le champ `%s` de la table `%s`',
    'BLOCK_LOGIN'           => 'Login',
    'NAV'                   => 'Menu',
    'NAV_CONTENT'           => 'Contenu',
    'NAV_NEWS'              => 'News',
    'NAV_ARCHIV'            => 'Archives',
    'NAV_ART'               => 'Articles',
    'NAV_CALENDAR'          => 'Calendrier',
    'NAV_STATS'              => 'Statistiques',
    'NAV_COMMUNITY'         => 'Communaut�',
    'NAV_FORUM'             => 'Forum',
    'NAV_GUESTBOOK'         => 'Livre d\'Or',
    'NAV_IRC'               => 'IrC',
    'NAV_MEMBERS'           => 'Membres',
    'NAV_CONTACT_US'        => 'Nous contacter',
    'NAV_MEDIAS'            => 'M�dias',
    'NAV_DOWNLOAD'          => 'T�l�chargements',
    'NAV_GALLERY'           => 'Galerie',
    'NAV_LINKS'             => 'Liens Web',
    'NAV_GAMES'             => 'Jeux',
    'NAV_TEAM'              => 'Team',
    'NAV_DEFY'              => 'Nous D�fier',
    'NAV_RECRUIT'           => 'Recrutement',
    'NAV_SERVER'            => 'Serveurs',
    'NAV_MATCHS'            => 'Matchs',
    'MEMBER'                => 'Membre',
    'NAV_ACCOUNT'           => 'Compte',
    'NAV_ADMIN'             => 'Administration',
    'BLOCK_SEARCH'          => 'Recherche',
    'POLL'                  => 'Sondage',
    'BLOCK_STATS'           => 'Stats',
    'IRC_AWARD'             => 'Irc Awards',
    'SERVER_MONITOR'        => 'Serveur monitor',
    'SUGGEST'               => 'Suggestion',
    'BLOCK_SHOUTBOX'        => 'Tribune libre',
    'BLOCK_PARTNERS'        => 'Partenaires',
    'GAME_SERVER_RENTING'   => 'Location de serveurs de jeux',
    'INSERT_BLOCK'          => 'Ajout du block %s',
    #####################################
    # tables/table.config.c.i.u.php
    #####################################
    'DELETE_CONFIG'         => 'Suppression de la configuration pour `%s` de la table `%s`',
    'ADD_CONFIG'            => 'Ajout de la configuration pour `%s` de la table `%s`',
    'UPDATE_CONFIG'         => 'Mise � jour de la configuration pour `%s` de la table `%s`',
    #####################################
    # tables/table.forums.c.i.u.php
    #####################################
    'FORUM'                 => 'Forum',
    'TEST_FORUM'            => 'Forum Test',
    'UPDATE_NB_THREAD'      => 'Mise � jour du total de sujets dans le champ `%s` de la table `%s`',
    'UPDATE_NB_MESSAGE'     => 'Mise � jour du total de messages dans le champ `%s` de la table `%s`',
    'REMOVE_EDITOR'         => 'Suppression de l\'�diteur',
    #####################################
    # tables/table.forums_cat.c.i.php
    #####################################
    'CATEGORY'              => 'Cat�gorie',
    #####################################
    # tables/table.forums_rank.c.i.php
    #####################################
    'NEWBIE'                => 'Noob',
    'JUNIOR_MEMBER'         => 'Jeune membre',
    'SENIOR_MEMBER'         => 'Membre averti',
    'POSTING_FREAK'         => 'Posteur Fou',
    'MODERATOR'             => 'Mod�rateur',
    'ADMINISTRATOR'         => 'Administrateur',
    'UPDATE_RANK_IMG'       => 'Mise � jour de l\'image du rang forum dans le champ `%s` de la table `%s`',
    #####################################
    # table.forums_threads.c.fk.i.u.php
    #####################################
    'UPDATE_NB_REPLIES'     => 'Mise � jour du total de r�ponses dans le champ `%s` de la table `%s`',
    #####################################
    # tables/table.games.c.i.u.php
    #####################################
    'ADD_MAP_DATA'          => 'Transf�re de la liste des maps du champ `%s` de la table `%s` dans la table des maps de la base de donn�es',
    'PREF_CS'               => 'Pr�f�rences CS',
    'OTHER_NICK'            => 'Autre pseudo',
    'FAV_MAP'               => 'Map favorite',
    'FAV_WEAPON'            => 'Arme favorite',
    'SKIN_T'                => 'Skin Terro',
    'SKIN_CT'               => 'Skin CT',
    #####################################
    # tables/table.match.c.i.u.php
    #####################################
    'UPDATE_FIELD'          => 'Champ `%s` mise � jour dans la table `%s`',
    #####################################
    # tables/table.modules.c.i.u.php
    #####################################
    'DELETE_MODULE'         => 'Sppression du module %s',
    'ADD_MODULE'            => 'Ajout du module %s',
    #####################################
    # tables/table.news_cat.c.i.php
    #####################################
    'BEST_MOD'              => 'Le meilleur MOD pour Half-Life',
    #####################################
    # tables/table.notification.i.u.php
    #####################################
    'SUHOSIN'               => 'Attention la configuration PHP de suhosin.session.encrypt est sur "On". Veuillez vous r�f�rer � la documentation, en cas de probl�me.',
    #####################################
    # tables/table.smilies.c.i.u.php
    #####################################
    // TODO UPDATE_SMILIES
    #####################################
    # tables/table.sondage.c.i.php
    #####################################
    'LIKE_NK'               => 'Aimez-vous Nuked-klan ?',
    #####################################
    # tables/table.sondage_data.c.i.php
    #####################################
    'ROXX'                  => 'Ca d�chire, continuez !',
    'NOT_BAD'               => 'Mouais, pas mal...',
    'SHIET'                 => 'C\'est naze, arr�tez-vous !',
    'WHATS_NK'              => 'C\'est quoi Nuked-Klan ?',
    #####################################
    # tables/table.users.c.i.u.php
    #####################################
    'UPDATE_PASSWORD'       => 'Mot de passe du champ `%s` mis � jour dans la table `%s`',
    'UPDATE_COUNTRY'        => 'Fichier du drapeau du pays du champ `%s` mis � jour dans la table `%s`',
    'UPDATE_HOMEPAGE'       => 'Url de la page perso du champ `%s` mis � jour dans la table `%s`',
    'ADD_TEAM_MEMBER'       => 'Transf�re de la Team de l\'utilisateur du champ `%s` de la table `%s` dans la table des membres de la team de la base de donn�es',
    #####################################
    # views/changelog.php
    #####################################
    'NEW_FEATURES_NK'       => 'Nouveaut�s Nuked Klan %s',
    'SECURITY'              => 'S�curit�',
    'SECURITY_DETAIL'       => 'La s�curit� a �t� ent�rement revue.<br />Nous pouvons aussi vous envoyer des messages depuis le site officiel, afin de vous avertir, informer ou autre...',
    'OPTIMISATION'          => 'Optimisation',
    'OPTIMISATION_DETAIL'   => 'Certaines parties de Nuked-Klan ont �t� optimis�es comme le syst�me de pagination afin de rendre votre site l�g�rement moins lourd.',
    'ADMINISTRATION'        => 'Administration',
    'ADMINISTRATION_DETAIL' => 'Afin de r�aliser une administration au go�t du jour, nous avons pr�f�r� repartir de z�ro, et concevoir un syst�me dans lequel administrateurs, utilisateurs, machines, et site officiel seraient reli�s. Pour cela, nous avons mis en place des syst�mes de communication comme les notifications, les actions, les discussions admin. Cette administration poss�de un panneau capable de vous transporter n\'importe o� dans votre administration mais aussi de vous avertir.',
    'BAN_TEMP'              => 'Ban temporaire',
    'BAN_TEMP_DETAIL'       => 'Un syst�me de bannissement temporaire a �t� mis en place, vous avez donc le choix de bannir l\'utilisateur 1 jour, 7 jours, 1 mois, 1 an, ou d�finitivement.',
    'SHOUTBOX'              => 'Shoutbox ajax',
    'SHOUTBOX_DETAIL'       => 'Un nouveau bloc textbox en ajax a �t� d�velopp�. Celui-ci est capable d\'afficher qui est en ligne, et d\'envoyer/afficher des nouveaux messages sans recharger la page.',
    'SQL_ERROR'             => 'Gestions des erreurs SQL',
    'SQL_ERROR_DETAIL'      => 'Ce syst�me est � double sens, lorsqu\'un visiteur tombe sur une erreur SQL, plut�t que de voir l\'erreur, il est redirig� vers une page d\'excuse, et un rapport de l\'erreur SQL est envoy� dans l\'administration.',
    'MULTI_WARS'            => 'Multi-map module wars',
    'MULTI_WARS_DETAIL'     => 'Le nouveau module permet de visionner les prochains matchs, il permet aussi de choisir le nombre de maps, il y a alors un score par map, puis un score final qui est la moyenne des scores par map.',
    'COMMENT_SYSTEM'        => 'Syst�me commentaires',
    'COMMENT_SYSTEM_DETAIL' => 'Le nouveau syst�me de commentaires permet rapidement d\'envoyer un commentaire en ajax et de visionner les 4 derniers commentaires.',
    'WYSIWYG_EDITOR'        => 'Editeur WYSIWYG',
    'WYSIWYG_EDITOR_DETAIL' => 'Ce nouveau syst�me permet d\'avoir une visualisation rapide de votre message, news ou autre apr�s mise en forme.',
    'CONTACT'               => 'Module Contact',
    'CONTACT_DETAIL'        => 'Nous avons ajout� le module contact indispensable au fonctionnement d\'un site web.',
    'PASSWORD_ERROR'        => 'Erreur mot de passe',
    'PASSWORD_ERROR_DETAIL' => 'Lorsqu\'un utilisateur se trompe de mot de passe 3 fois de suite, il doit alors recopier un code de s�curit� en plus de son login afin de se connecter � son compte.',
    'VARIOUS_MODIF'         => 'Diff�rentes modifications',
    'VARIOUS_MODIF_DETAIL'  => 'En plus des modifications pr�c�dentes, nous avons effectu� diverses modifications comme la page 404, o� m�me des modifications non visibles comme le captcha.',
    'NEXT'                  => 'Continuer',
    #####################################
    # views/checkCompatibility.php
    #####################################
    'CHECK_COMPATIBILITY_HOSTING' => 'V�rification de la compatibilit� avec votre h�bergement',
    'COMPONENT'             => 'Composant',
    'COMPATIBILITY'         => 'Compatibilit�',
    'WEBSITE_DIRECTORY'     => 'R�pertoire du site web',
    'PHP_VERSION'           => 'PHP version &ge; %s',
    'PHP_VERSION_ERROR'     => 'Erreur PHP',
    'MYSQL_EXT'             => 'Extension MySQL',
    'MYSQL_EXT_ERROR'       => 'Erreur MySQL',
    'MYSQLI_EXT'            => 'Extension MySQLi',
    'MYSQLI_EXT_ERROR'      => 'Erreur MySQLi',
    'SESSION_EXT'           => 'Extension des sessions',
    'SESSION_EXT_ERROR'     => 'Erreur sessions',
    'FILEINFO_EXT'          => 'Extension File Info',
    'FILEINFO_EXT_ERROR'    => 'Erreur fileinfo',
    'GD_EXT'                => 'Extension GD',
    'GD_EXT_ERROR'          => 'Erreur GD',
    'CHMOD_TEST'            => 'Test du CHMOD',
    'CHMOD_TEST_ERROR'      => 'Erreur chmod %s',
    'NO_READABLE_DIRECTORY' => 'Le dossier %s n\'a pas les droits d\'�criture',
    'BAD_HOSTING'           => 'Votre h�bergement n\'est pas compatible avec la nouvelle version de Nuked-Klan.',
    'FORCE'                 => 'Forcer l\'installation',
    #####################################
    # views/chooseSendStats.php
    #####################################
    'SELECT_STATS'          => 'Activation des statistiques anonymes',
    'STATS_INFO'            => '<p>Afin d\'am�liorer au mieux le CMS Nuked Klan, en tenant compte de l\'utilisation des administrateurs de sites NK,<br/>nous avons mis en place sur cette nouvelle version un syst�me d\'envoi de statistiques anonymes.</p><p>Vous avez le choix d\'activer ou non ce syst�me, mais sachez qu\'en l\'activant vous permettrez � l\'�quipe de Developpement/Marketing<br/>de mieux r�pondre � vos attentes.</p><p>Pour une totale transparence, lors de l\'envoi des statistiques, vous serez inform� dans l\'administration, des donn�es envoy�es.<br/>Sachez qu\'� tout moment vous aurez la possibilit� de d�sactiver l\'envoi des statistiques dans les pr�f�rences g�n�rales de votre administration.</p>',
    'CONFIRM_STATS'         => 'Oui, j\'autorise l\'envoi de statistiques anonymes � Nuked-Klan',
    'CONFIRM'               => 'Valider',
    #####################################
    # views/cleaningFiles.php
    #####################################
    'DEPRECATED_FILES'      => 'Fichiers obsol�tes detect�s',
    'CLEANING_FILES'        => 'Un ou plusieurs fichiers obsol�tes n\'ont pas pu �tre effacer.<br />Veuillez supprimer manuellement les fichiers suivants :',
    'RETRY'                 => 'R�essayer',
    #####################################
    # views/confIncFailure.php
    #####################################
    'WEBSITE_DIRECTORY_CHMOD' => 'Impossible d\'�crire dans le dossier contenant Nuked-Klan<br/>Veuillez mettre manuellement le CHMOD <strong>0755</strong> sur ce dossier.',
    'CONF_INC_CHMOD_ERROR'  => 'Impossible de modifier les droits CHMOD du fichier conf.inc.php<br/>Veuillez mettre manuellement le CHMOD <strong>%s</strong> sur ce fichier.',
    'WRITE_CONF_INC_ERROR'  => 'Une erreur est survenue dans la g�n�ration du fichier conf.inc.php',
    'COPY_CONF_INC_ERROR'   => 'Impossible de cr�er la sauvegarde du fichier conf.inc.php<br/>Veuillez t�l�charger le fichier et le sauvegarder manuellement.',
    'DOWNLOAD'              => 'T�l�charger',
    #####################################
    # views/fatalError.php
    #####################################
    'ERROR'                 => 'Une erreur est survenue !!!',
    'BACK'                  => 'Retour',
    'REFRESH'               => 'Rafraichir',
    #####################################
    # views/formError.php
    #####################################
    'ERROR_FIELDS'          => 'Vous avez mal rempli les champs du formulaire.',
    #####################################
    # views/fullPage.php
    #####################################
    'INSTALL_TITLE'         => 'Installation de Nuked-klan %s',
    'UPDATE_TITLE'          => 'Mise � jour de Nuked-klan %s',
    'SELECT_LANGUAGE'       => 'S�lection de la langue',
    'SELECT_TYPE'           => 'Type d\'installation',
    'INSTALL'               => 'Installation',
    'UPDATE'                => 'Mise � jour',
    'YES'                   => 'Oui',
    'NO'                    => 'Non',
    'QUICK'                 => 'Rapide',
    'ASSIST'                => 'Assist�e',
    'SELECT_SAVE'           => 'Sauvegarde de la base de donn�es',
    'IN_PROGRESS'           => 'En cours',
    'FINISH'                => 'Termin�',
    'RESET_SESSION'         => 'R�initialiser',
    'DISCOVERY'             => 'D�couvrer Nuked-Klan !',
    'DISCOVERY_DESCR'       => 'Vous �tes sur le point d\'installer votre site web sur base du CMS Nuked-Klan...</p><p>En quelques clics et en quelques minutes, offrez-vous la possibilit� de g�rer votre team, guilde ou clan, � l\'aide d\'outils sp�cialement con�us � cet effet !</p><p>Vous n\'�tes pas un joueur mais vous d�sirez toutefois utiliser Nuked-Klan pour r�aliser votre site web ?</p><p>Aucun probl�me, une version g�n�raliste (SP) a �galement �t� d�velopp�e et vous est propos�e, express�ment dans cette optique.</p><p>Adopter un design plus adapt� � l\'esprit de votre activit� (palette de couleurs, logos,...) devient, gr�ce � Nuked-Klan, un v�ritable jeu d\'enfant. Avec une collection impressionante de graphismes et une modification (ainsi qu\'une cr�ation) de th�mes certainement une des plus ais�e du march� des CMS, vous aboutirez in�vitablement � un site web qui vous ressemble.</p><p>Nous vous remercions pour l\'int�r�t et la confiance que vous nous apportez au quotidien... et depuis toutes ces ann�es !',
    'NEW_VERSION_CONCEPT'   => 'La 1.8 : une version �volutive',
    'NEW_VERSION_CONCEPT_DESCR' => 'La nouvelle version 1.8 est enfin disponible !<p>Apr�s un cahier des charges trop ambitieux, nous avons revu � la baisse les ambitions de cette nouvelle version afin de vous proposer une version stable qui saura vous satisfaire en attendant la version 2.0 de Nuked Klan.</p><p>Apr�s le redesign de l\'administration sur la version 1.7.9, la version 1.8 restylera et transformera totalement les modules.</p><p>Cette nouvelle version 1.8 se veut modulable : des mises � jour r�guli�res (1.8.1, 1.8.2 etc..) qui apporteront chacune leurs lots de modifications.</p>Voici les grandes lignes de cette nouvelle version : <ul><li>Compatibilit� > PHP 5.4</li><li>Nouveau Captcha invisible</li><li>Int�gration jquery et CSS pour chaque module</li><li>Nouveaux modules et redesign des anciens</li><li>Nouveaux �diteurs (Ckeditor + TinyMce)</li><li>Une version unique (Gamer et SP)</li><li>Correction de nombreux bugs</li><li>Nouveau th�me innovant</li><li>Etc...</li></ul>Et tout un lot d\'am�liorations sur l\'ensemble du CMS, n\'attendez plus et finalisez votre installation!',
    'GITHUB_NK'             => 'Participez au d�veloppement sur Github !',
    'GITHUB_NK_DESCR'       => 'Depuis la sortie de la version 1.7.9, le projet Nuked Klan est pr�sent sur Github.<p>Le d�p�t Github vous permet de suivre l\'avancement des diff�rentes versions et m�me d\'y participer.</p><p>Si vous rencontrez un bug ou avez une id�e d\'am�lioration, vous pouvez utiliser le bug tracker pour nous transmettre vos remarques.<br />Notre �quipe apr�s v�rification et/ou approbation prendra en charge votre demande et pourra la traiter dans les plus brefs d�lais en assurant un suivie de qualit�.</p><p>Vous pouvez aussi consulter le Wiki du d�p�t Github, vous y trouverez des r�ponses, des conseils en tous genres autour du CMS Nuked Klan.</p><p>Enfin si vous vous sentez l\'�me d\'un d�veloppeur vous avez m�me la possibilit� de nous soumettre vos am�liorations et directement contribuer au projet Nuked Klan.</p>',
    'COMMUNAUTY_NK'         => 'La communaut� NK',
    'COMMUNAUTY_NK_DESCR'   => 'Une communaut� sans cesse florissante, avec des membres d\'une grande serviabilit� et poss�dant de nombreuses comp�tences.<br/>Voil� un des avantages non n�gligeable dont vous b�n�ficierez en adoptant Nuked-Klan et en rejoignant la dite communaut�.<br/>Tout naturellement, vous int�grerez cette grande famille, toujours soucieuse du bien-�tre de ses membres.</p><p>De nombreux fan-sites gravitent autour du CMS. Preuve de l\'enthousiasme et de l\'engouement que procure l\'utilisation de Nuked-Klan, ils repr�sentent la colonne vert�brale du CMS.</p><p>Pour cette raison (et pour bien d\'autres), ils apportent � notre �quipe de d�veloppeurs et de communautaires l\'envie d\'avancer, main dans la main, dans la bonne humeur et avec un esprit assidu de communication.</p><p>C\'est ainsi que nous �voluerons, au fil des ann�es, toujours � l\'�coute de vos attentes et de vos besoins.</p><p>Parce que Nuked-Klan est, avant tout, votre CMS !!',
    'NEW_MODULES'           => 'Mises � jour et ajout de nouveaux modules !',
    'NEW_MODULES_DESCR'     => 'Tout au long des mises � jour de cette nouvelle version les modules seront tous am�lior�s, de mani�re � combler les manques des pr�c�dentes versions.<p>Chaque module disposera d�sormais de leur propre feuille de style qui peut �tre modifi�e par le design de votre th�me.<br />Ainsi les possibilit�s de personnalisation de votre site seront d�cupl�es � l\'infini.</p><p>Un nouveau design pour toutes les notifications c�t� client, rendra l\'utilisation de votre site plus agr�able.</p><p>Pour la premi�re release (1.8.0) qui fixe les bases de la branche 1.8, seuls les modules Forum et la Tribune libre ont �t� enti�rement revud en ajoutant tout un lot de modifications pr�sentes sur les patchs les plus utilis�s par la communaut�.<br />Les modules Teams, Wars, News & Articles ont b�n�fici� de l�g�res modifications, afin de s\'adapter aux fonctionnalit�s du nouveau th�me et de pr�parer leur refonte sur les versions suivantes...</p>Le module Page est d�sormais int�gr� par d�faut � Nuked Klan, d\'autres modules suivront avec les mises � jour � venir.',
    'NEW_TEMPLATE'          => 'Un nouveau th�me innovant !',
    'NEW_TEMPLATE_DESCR'    => 'Restless utilise au maximum toutes les fonctionnalit�s de votre nouvelle version 1.8.<p>Ce th�me vous comblera par les innombrables options dont il dispose :</p><ul><li>4 th�mes personnalis�s</li><li>6 couleurs diff�rentes</li><li>Une automatisation avanc�e</li><li>Un syst�me de template innovant</li><li>Un codage ma�tris�</li><li>Une administration pouss�e</li><li>Des blocs in�dits</li></ul>En d�tails :<ul><li>Le menu principal utilise le bloc menu de NK</li><li>Le slider se remplit automatiquement au fur et � mesure de l\'ajout de news (un champ image de couverture vous permet d�sormais d\'illustrer avec une image vos news)</li><li>Le bloc Top match utilise les nouveaux champs images des modules teams et matchs</li><li>Le bloc article utilise lui aussi les images de couverture de vos articles</li><li>Le bloc matchs affichera vos derni�res victoires avec un design �pur�</li><li>Le bloc team mettra en valeur vos �quipes</li><li>Le bloc galerie exposera vos 6 derniers clich�s</li><li>Le bloc t�l�chargement comptabilisera la popularit� de vos derniers fichiers</li><li>Un bloc in�dit mettra en valeur les messages de votre livre d\'or</li><li>Un bloc r�seaux sociaux pour fid�liser votre communaut�</li><li>Un sub menu � deux niveaux dans le footer de votre site optimisera la navigation</li><li>Le slider sponsor du footer ravira vos partenaires</li><li>Etc...</li></ul>Une multitude d\'autres petits d�tails en feront le th�me ultime que vous attendiez !',
    #####################################
    # views/getPartners.php
    #####################################
    'NO_PARTNERS'           => 'Une erreur est survenue lors de la r&eacute;cup&eacute;ration de la liste des partenaires...',
    #####################################
    # views/main.php
    #####################################
    'WELCOME_INSTALL'       => 'Bienvenue sur Nuked-Klan %s',
    'GUIDE_INSTALL'         => 'L\'assistant va vous guider � travers les �tapes de l\'installation de votre portail...<br /><br /><b>Merci de laisser le copyleft sur votre site pour respecter la licence GNU.</b>',
    'START_INSTALL'         => 'D�marrer l\'installation',
    'DETECT_UPDATE'         => 'L\'assistant a d�tect� une installation de la version : %s de Nuked-Klan',
    'START_UPDATE'          => 'D�marrer la mise � jour',
    #####################################
    # views/maliciousScript.php
    #####################################
    'MALICIOUS_SCRIPT_DETECTED' => 'Script malveillant d�tect�',
    'DELETE_TURKISH_FILE'   => 'Impossible de supprimer le fichier. Veuillez le supprimer manuellement et v�rifier encore si il est pr�sent.<br/>&nbsp;Fichier : /modules/404/lang.turkish.lang.php',
    'CHECK_AGAIN'           => 'V�rifier encore',
    #####################################
    # views/processSuccess.php
    #####################################
    'INSTALL_SUCCESS'       => 'Installation termin�e',
    'UPDATE_SUCCESS'        => 'Mise � jour  termin�e',
    'INFO_PARTNERS'         => 'Retrouvez nos partenaires et leurs codes promotionnels,<br/>afin de profiter au mieux de leurs produits et/ou services.',
    'WAIT'                  => 'Veuillez patienter...',
    'ACCESS_SITE'           => 'Acc�der � votre site',
    #####################################
    # views/runProcess.php
    #####################################
    'CREATE_DB'             => 'Cr�ation de la base de donn�es',
    'UPDATE_DB'             => 'Mise � jour de la base de donn�es',
    'WAITING'               => 'Veuillez cliquer sur d�marrer pour commencer...',
    'START'                 => 'D�marrer',
    #####################################
    # views/selectLanguage.php
    #####################################
    'FRENCH'                => 'Fran�ais',
    'ENGLISH'               => 'Anglais',
    'SUBMIT'                => 'Valider',
    #####################################
    # views/selectProcessType.php
    #####################################
    'CHECK_TYPE_INSTALL'    => 'Choix du type d\'installation',
    'INSTALL_SPEED'         => 'Installation rapide',
    'INSTALL_ASSIST'        => 'Installation assist�e',
    'UPDATE_SPEED'          => 'Mise � jour rapide',
    'UPDATE_ASSIST'         => 'Mise � jour assist�e',
    #####################################
    # views/selectSaveDb.php
    #####################################
    'TO_SAVE'               => 'Sauvegarder',
    'SAVE_YOUR_DATABASE'    => 'Vous pouvez sauvegarder votre base de donn�e en cliquant sur le lien ci-dessous.',
    #####################################
    # views/setDbConfiguration.php
    #####################################
    'CONFIG'                => 'Configuration',
    'DB_HOST'               => 'Serveur %s',
    'INSTALL_DB_HOST'       => 'Il s\'agit ici de l\'adresse du serveur %s de votre h�bergement, celui-ci contient toutes vos donn�es textes, membres, messages... En g�n�ral, il s\'agit de localhost, mais dans tous les cas, l\'adresse est indiqu�e dans votre mail d\'inscription de votre h�bergeur ou dans l\'administration de votre h�bergement.',
    'DB_USER'                => 'Utilisateur',
    'INSTALL_DB_USER'       => 'Il s\'agit de votre identifiant qui vous permet de vous connecter � votre base %s.',
    'DB_PASSWORD'           => 'Mot de passe',
    'INSTALL_DB_PASSWORD'   => 'Il s\'agit du mot de passe de votre identifiant qui vous permet de vous connecter � votre base %s.',
    'DB_PREFIX'             => 'Prefix',
    'INSTALL_DB_PREFIX'     => 'Le prefix permet d\'installer plusieurs fois Nuked-Klan sur une seule base %s en utilisant un prefix diff�rent � chaque fois, par d�faut, il s\'agit de \'nuked\', mais vous pouvez le changer comme vous le voulez.',
    'DB_NAME'               => 'Nom de la Base',
    'INSTALL_DB_NAME'       => 'Il s\'agit du nom de votre base de donn�es %s, souvent vous devez vous rendre dans l\'administration de votre h�bergement pour cr�er une base de donn�es, mais parfois celle-ci vous est d�j� fournie dans le mail d\'inscription de votre h�bergement.',
    'ADVANCED_PARAMETERS'   => 'Param�tre avanc�s',
    'DB_TYPE'               => 'Type de base de donn�es',
    'INSTALL_DB_TYPE'       => 'Il s\'agit du type de base de donn�es que vous souhaitez utiliser pour Nuked-Klan.',
    'DB_PORT'               => 'Port',
    //'INSTALL_DB_PORT'       => '',
    'DB_PERSISTENT'         => 'Connexion persistante',
    //'INSTALL_DB_PERSISTENT' => '',
    #####################################
    # views/setAdministrator.php
    #####################################
    'CREATE_ADMINISTRATOR'  => 'Cr�ation du compte Administrateur',
    'NICKNAME'              => 'Pseudo',
    'PASSWORD'              => 'Mot de passe',
    'PASSWORD_CONFIRM'      => 'Mot de passe (confirmez)',
    'EMAIL'                 => 'E-mail',
);

?>
