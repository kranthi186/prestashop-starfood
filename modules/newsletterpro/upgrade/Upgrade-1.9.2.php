<?php
/**
* 2013-2015 Ovidiu Cimpean
*
* Ovidiu Cimpean - Newsletter Pro © All rights reserved.
*
* DISCLAIMER
*
* Do not edit, modify or copy this file.
* If you wish to customize it, contact us at addons4prestashop@gmail.com.
*
* @author    Ovidiu Cimpean <addons4prestashop@gmail.com>
* @copyright 2013-2015 Ovidiu Cimpean
* @version   Release: 4
* @license   Do not edit, modify or copy this file
*/

if (!defined('_PS_VERSION_'))
	exit;

function upgrade_module_1_9_2($module)
{
	$upgrade = $module->upgrade;

	// hooks update (no)
	// configuration update (no)
	// database update (no)

	$upgrade->addColumn('newsletter_pro', 'id_newsletter_pro_tpl_history', "`id_newsletter_pro_tpl_history` INT(11) UNSIGNED NOT NULL DEFAULT '0'", 'id_step');

	$upgrade->addColumn('newsletter_pro_task', 'id_newsletter_pro_tpl_history', "`id_newsletter_pro_tpl_history` INT(10) UNSIGNED NOT NULL DEFAULT '0'", 'id_newsletter_pro_smtp');

	return $upgrade->success();
}