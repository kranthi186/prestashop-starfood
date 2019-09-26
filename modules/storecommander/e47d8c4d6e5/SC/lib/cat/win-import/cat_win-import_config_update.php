<?php
/**
 * Store Commander
 *
 * @category administration
 * @author Store Commander - support@storecommander.com
 * @version 2015-09-15
 * @uses Prestashop modules
 * @since 2009
 * @copyright Copyright &copy; 2009-2015, Store Commander
 * @license commercial
 * All rights reserved! Copying, duplication strictly prohibited
 *
 * *****************************************
 * *           STORE COMMANDER             *
 * *   http://www.StoreCommander.com       *
 * *            V 2015-09-15               *
 * *****************************************
 *
 * Compatibility: PS version: 1.1 to 1.6.1
 *
 **/

	if(Tools::getValue('act','')=='cat_win-import_config_update')
	{
		$csvFile=html_entity_decode(Tools::getValue('gr_id'));
		$files = array_diff( scandir( SC_CSV_IMPORT_DIR ), array_merge( Array( ".", "..", "index.php", ".htaccess", SC_CSV_IMPORT_CONF)) ); 
		readImportConfigXML($files);
		$fields=array('supplier','fieldsep','valuesep','categorysep','utf8','idby','iffoundindb','fornewproduct','forfoundproduct','mapping','firstlinecontent','createcategories','importlimit','createelements');
		foreach($fields AS $field)
		{
			if (isset($_POST[$field]))
			{
				$importConfig[$csvFile][$field]=psql(html_entity_decode(Tools::getValue($field)));
			}
		}
		writeImportConfigXML();
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
		 		header("Content-type: application/xhtml+xml"); } else {
		 		header("Content-type: text/xml");
		}
		echo '<?xml version="1.0" encoding="UTF-8"?><data><action type=\'update\' sid=\''.$csvFile.'\' tid=\''.$csvFile.'\' /></data>';
	}
			