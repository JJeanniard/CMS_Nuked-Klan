<?php
/**
 * propos.php
 *
 * Backend of Admin module
 *
 * @version     1.8
 * @link https://nuked-klan.fr Clan Management System for Gamers
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright 2001-2016 Nuked-Klan (Registred Trademark)
 */
defined('INDEX_CHECK') or die('You can\'t run this file alone.');

if (! adminInit('Admin', ADMINISTRATOR_ACCESS))
    return;


?>
    <div class="content-box"><!-- Start Content Box -->
        <div class="content-box-header"><h3><?php echo _PROPOS; ?></h3></div>
        <div class="tab-content" id="tab2">
            <div style="margin:20px">
                <?php echo _INFOSPROPOS; ?>
            </div>
            <div style="text-align: center"><br /><a class="buttonLink" href="index.php?file=Admin"><?php echo __('BACK') ?></a><br /><br /><br /></div>
        </div>
    </div>
