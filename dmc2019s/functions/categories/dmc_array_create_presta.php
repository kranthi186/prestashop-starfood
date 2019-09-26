<?php
/****************************************************************************
*                                                                        	*
*  dmConnector for all shop													*
*  dmc_array_create_presta.php												*
*  inkludiert von dmc_write_cat.php 										*	
*  Presta Kategorie Array mit Werten fuellen								*
*  Copyright (C) 2012 DoubleM-GmbH.de										*
*                                                                       	*
*****************************************************************************/
/*
15.03.2012
- neu
*/
			/*Kategorie_ID: 110
			Kategorie_Vater_ID: 100
			kat_ebene: 2
			3073 katebene!=1: 110
			*/
			$insert_sql_data = array(	
										'id_parent' => $Kategorie_Vater_ID,
										'level_depth' => $kat_ebene,
										'active' => 1,
										'date_add' => 'now()',
										'date_upd' => 'now()'
									);
			
			// Category Group
			$insert_sql_grp_data = array(	'id_category' => $new_cat_id,
											'id_group' => 1);
			
			// Shop
			$insert_sql_shop_data = array(	'id_category' => $new_cat_id,
											'id_shop' => 1,
											'position' => 1);
			
			// 4 Description
			if ($meta_desc=='')
			$meta_desc = $Kategorie_Bezeichnung;
			$insert_sql_desc_data = array(	
										'id_category' => $new_cat_id,
										'id_lang' => $language_id,
										'name' => $Kategorie_Bezeichnung,
										'description' => $Kategorie_Beschreibung,
										'link_rewrite' => $language_id.'/'.$seo,
										'meta_description' => $Kategorie_ID,
										'meta_title' => $meta_desc,
										'meta_keywords' => $meta_desc);	
										
			
			
?>
	