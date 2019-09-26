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

function upgrade_module_4_3_2($module)
{
	$upgrade = $module->upgrade;

	$upgrade->updateConfiguration('LAST_DATE_NEWSLETTER_BLOCK_SYNC', '0000-00-00 00:00:00');
	$upgrade->updateConfiguration('SHOW_CLEAR_CACHE', 1);

	return $upgrade->success();
}