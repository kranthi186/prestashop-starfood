<?php
	/*
	Export Konfigurationen
	*/
	
	// Order Status Update
	if (defined('UPDATE_ORDER_STATUS') && UPDATE_ORDER_STATUS != '') {
		// Werte aus  conf/definitions/ verwenden
		
	} else 
		define('UPDATE_ORDER_STATUS',false);			// "true", wenn der Bestellstatus nach Bestellabruf geändert werden soll, zB von offen auf "In Bearbeitung"
	
	// Standard Order Status definieren, wenn NICHT über definitions.inc mit Werten aus conf/definitions/ bereits gegeben
	if (defined('ORDER_STATUS_GET') && ORDER_STATUS_GET != '') {
		// Werte aus  conf/definitions/ verwenden
		
	} else
		if (strpos(strtolower(SHOPSYSTEM), 'shopware') !== false) {
			// Standard Order Status Shopware zB Offen, "In Bearbeitung (Wartet)", 
			// steht im Feld Description von Tabelle s_core_states
			define('ORDER_STATUS_GET','Offen');		// Abzurufender Orderstatus
			define('ORDER_STATUS_SET','In Bearbeitung (Wartet)');		// Zu setzender Orderstatus
		} else if (strpos(strtolower(SHOPSYSTEM), 'presta') !== false) {
			// Standard Order Status Presta zB 2 für Zahlung eingegangen und 4 für versendet und 5 Erfolgreich abgeschlossen.
			define('ORDER_STATUS_GET','2');		// Abzurufender Orderstatus
			define('ORDER_STATUS_SET','4');		// Zu setzender Orderstatus
		} else if (strpos(strtolower(SHOPSYSTEM), 'woocommerce') !== false) {
			// Standard Order Status woocommerce: wc-completed bzw completed, pending, processing, on-hold, cancelled
			define('ORDER_STATUS_GET','wc-on-hold');		// Abzurufender Orderstatus
			define('ORDER_STATUS_SET','wc-processing');		// Zu setzender Orderstatus
		} else if (strpos(strtolower(SHOPSYSTEM), 'joom') !== false) {
			// Standard Order Status Joomshopping zB "Offen", "Bestätigt", steht im Feld name_de-DE von Tabelle jshopping_order_status
			define('ORDER_STATUS_GET','Offen');		// Abzurufender Orderstatus
			define('ORDER_STATUS_SET','Bestätigt');		// Zu setzender Orderstatus
		} else if (strpos(strtolower(SHOPSYSTEM), 'virtue') !== false) {
			// Standard Order Status Virtuemart zB U = Confirmed by shopper, P = Pending, C = Confirmed 
			define('ORDER_STATUS_GET','P');		// Abzurufender Orderstatus
			define('ORDER_STATUS_SET','C');		// Zu setzender Orderstatus
		} else {
			// bei Gambio etc 1=offen, 2= in bearbeitung etc
			define('ORDER_STATUS_GET','1');		// Abzurufender Orderstatus
			define('ORDER_STATUS_SET','2');		// Zu setzender Orderstatus
		}
	
	// ZB bei Veyton moeglich: Abruf nur aus bestimmten shopIDs
	define('ORDER_SHOP_IDS','1');		// mehrere durch @ getrennt

	//define('ORDER_STATUS_GET','1@8');				// offen	6=An WaWi -> neu: mehrere durch @ getrennt
	//define('ORDER_STATUS_SET',3);					// 7 = In WaWi
	//define('ORDER_STATUS_GET','U');				// virtuemart U = Confirmed by shopper, P = Pending
	//define('ORDER_STATUS_SET','C');				// virtuemart C = Confirmed
	define('ORDER_STATUS_NOTIFY_CUSTOMER',false); 	// "true", wenn der Kunden wegen Statusänderung informiert werden soll. (Shopabhängig)
	define('UPDATE_FIRST_ORDER_ID',false);			// Verwende FIRST_ORDER_ID.dmc und schreibe die nächste Bestellnummer hinein	
	

	// Netto/Bruttopreise im Shop
	define('BRUTTO_SHOP',false);	
	// define('FIRST_ORDER_ID',1); steht in definitions.inc
	
	define('SET_TIME_LIMIT',0);   // use   xtc_set_time_limit(0);
	//define('CHARSET','iso-8859-1');
	define('CHARSET_EXPORT','UTF-8');
	define('LANG_ID',2);
	define('OPENTRANS',true);		// Standard true
	
	$version_year    = '2016';
	$version_month    = '06';
	$version_datum = '2016.06.27';

	// falls die MWST vom shop vertauscht wird, hier false setzen.
	define('SWITCH_MWST',true);
 
	// Steuer
	define('TAX_SHIPPING',1.19);						//  Steuersatz bei Versandkosten
	define('TAX_SURCHARGE',1.19);						//  Steuersatz bei Aufschlaegen
	define('TAX_DISCOUNT',1.19);						//  Steuersatz bei Rabatten

  // Export Modus
    define('EXPORT_SHIPPING_AS_PRODUCT',false);					// Versandkosten als Produkt (NICHT BEI GSA, Lexware XML)
    define('EXPORT_SHIPPING_AS_PRODUCT_SKU','versand');			// Versandkosten_artikel als Produkt
    define('EXPORT_PAYPAL_AS_PRODUCT',false);					// Paypal als Produkt
    define('EXPORT_PAYPAL_AS_PRODUCT_SKU','paypal');			// Paypal_artikel als Produkt
    define('EXPORT_COD_AS_PRODUCT',false);						// Nachnahmegebuehr als Produkt
    define('EXPORT_COD_AS_PRODUCT_SKU','nachnahme');			// Nachnahmegebuehr_artikel als Produkt
    define('EXPORT_DISCOUNT_AS_PRODUCT',false);					// Nachlass als Produkt
    define('EXPORT_DISCOUNT_AS_PRODUCT_SKU','Nachlass');		// Nachlass_artikel als Produkt
    define('EXPORT_GV_AS_PRODUCT',true);						// Gutschein als Produkt
    define('EXPORT_GV_AS_PRODUCT_SKU','gutschein');				// Gutschein_artikel als Produkt
    define('EXPORT_BONUS_AS_PRODUCT',false);					// Coupon/ Bonus als Produkt
	define('EXPORT_BONUS_AS_PRODUCT_SKU','Bonus');				// Bonus_artikel als Produkt
	define('EXPORT_DISCOUNT_PAYMENT_AS_PRODUCT', false); 		// Zahlungsrabatt als Produkt
	define('EXPORT_DISCOUNT_PAYMENT_AS_PRODUCT_SKU', false); 	// Zahlungsrabatt_artikel als Produkt
	define('EXPORT_PREPAYMENT_AS_PRODUCT',false);				// Vorkasse als Produkt
	define('EXPORT_PREPAYMENT_AS_PRODUCT_SKU',false);			// Vorkasse_artikel als Produkt
	
	define('COMPARE_SHIPPING_ADRESSE_WITH','billing');			// Versandadresse vergleichen mit Rechnungsadresse (billing) oder Kundenadresse (customer)
	
?>