<?php

/*
 * * Format 3x5
 */

require_once(_PS_MODULE_DIR_ . 'scpdfcatalog/sctcpdf/tcpdf.php');
require_once(_PS_MODULE_DIR_ . 'scpdfcatalog/SCPDFCatalogCreator.php');

class catalog extends SCPDFCatalogCreator {

    public $last_y1 = 0;
    public $last_y2 = 0;
    public $cell_width=47;
    public $title_length=70;
      

    public function createCatalog($format, $start, $limit, $orderBy, $orderWay) {
	    
	    $image_height=16;
		$image_width=16;	 
	    
	    
        $this->format = $format;
        $active = $this->conf['PS_SC_PDFCATALOG_ACTIVEPRODUCT'];
        $this->showPageNum = true;
        $posx = array(10, 57, 104, 151,
        			10, 57, 104, 151, 
        			10, 57, 104, 151, 
        			10, 57, 104, 151, 
        			10, 57, 104, 151, 
        			10, 57, 104, 151);
        $idx = 0;
        if(!empty($this->conf['PS_SC_PDFCATALOG_CATEGORY_NEW_PAGE']))
       		$this->AddPage();
        foreach ($this->categories AS $id_category) {
        	$this->header_page=false;
            $this->currentCategory = $id_category;
            $category = new Category($id_category);
            /*if (!$category->active)
                continue;*/
		  
		  $products = Product::getProducts($this->id_lang, $start, $limit, $orderBy, $orderWay, $id_category, $active);
			$products = $this->filtersByStockAndManufacturer($products);
			//$products = array_merge($products,$products,$products,$products,$products,$products,$products,$products,$products);
       	  if (count($products) > 0)
			{
				if ($this->conf['PS_SC_PDFCATALOG_CATEGCOVER'])
					$this->addCategoryCoverPage(parent::hideCategoryPosition($category->getName($this->id_lang)), $category->description[$this->id_lang], $id_category);
				else
				{ 
					if(empty($this->conf['PS_SC_PDFCATALOG_CATEGORY_NEW_PAGE']))
					{
						$idx = 0;
       				 	$this->header_page=true;
						$this->AddPage();
						$actual_pos_y = $this->GetY();
					}
				}
			
				$this->calculPrefix($id_category, $category);
				$this->addBookmark($id_category, $category);
			
				if ($this->conf['PS_SC_PDFCATALOG_CATEGCOVER'])
				{
					if(empty($this->conf['PS_SC_PDFCATALOG_CATEGORY_NEW_PAGE']))
					{
						$idx = 0;
       				 	$this->header_page=true;
						$this->AddPage();
						$actual_pos_y = $this->GetY();
					}
				}
			}
			else
			{
				$this->calculPrefix($id_category, $category);
				$this->categ_waiting[] = $id_category;
			}
			
            foreach ($products AS $productrow) {
                $product = new Product((int)($productrow['id_product']));
                /*if (!$product->active)
                    continue;*/
                if (Validate::isLoadedObject($product)) {
                    if ($idx == 24) {
                        $idx = 0;
                         
                        $this->AddPage();
                    }

                    $table = false;
					
					if($idx==0 || $idx==4 || $idx==8 || $idx==12 || $idx==16 || $idx==20)
						$actual_pos_y = $this->GetY()+5;

                    $this->addProductBox($product,$image_width,$image_height, $posx[$idx], $actual_pos_y, 'small', "", $idx);
                    $idx++;
                }else {
                    die('Invalid product');
                }
            }
        }
    }

    public function addProductBox($product, $width, $height, $posx, $posy, $theme, $newy="", $idx) {
        $this->SetFillColor(240, 240, 240);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->fontname(), '', 8);
        $this->SetXY($posx, $posy);
        $coverid = Product::getCover($product->id);
        if (version_compare(_PS_VERSION_, '1.4.3', '>=')) {
            $imagefile = _PS_IMG_DIR_ . 'p/' . $this->getImgFolderStatic($coverid['id_image']) . $coverid['id_image'] . '-' . $this->imageformat . '.jpg';
            if (Configuration::get('PS_LEGACY_IMAGES') && !file_exists($imagefile))
                $imagefile = _PS_IMG_DIR_ . 'p/' . $product->id . '-' . $coverid['id_image'] . '-' . $this->imageformat . '.jpg';
        }else {
            $imagefile = _PS_IMG_DIR_ . 'p/' . $product->id . '-' . $coverid['id_image'] . '-' . $this->imageformat . '.jpg';
        }
        
        if (version_compare(_PS_VERSION_, '1.5.0.0', '>='))
    		$pdt_link = $product->getLink();
    	else
    		$pdt_link = SCPDFCatalog::getHttpHost(). __PS_BASE_URI__ . 'product.php?id_product=' . (int)($product->id);
        
            if (file_exists($imagefile)) {
                $iwh = getimagesize($imagefile);
				if($iwh[0]>$iwh[1])
					$height = $width * $iwh[1] / $iwh[0];
				else
					$width = $height * $iwh[0] / $iwh[1];
				//center the image
				$offset_center=floor(($this->cell_width-$width)/2);
				
				
                $this->Image($imagefile, $posx+$offset_center, $posy,  $width, $height, '', ($this->conf['PS_SC_PDFCATALOG_LINKS'] ? $pdt_link : ''));
            }
            $product_label = $this->displayProductLabel($product->name[$this->id_lang], $product->description_short[$this->id_lang],$this->title_length);
			
            $chaineHTML = $product_label;
            //if (Tools::strlen($product->reference) > 0)
            $chaineHTML .= "<br/> ".$this->mod->tt('Ref:'). $product->reference;

            if ($this->vatexc == 1) {
                $chaineHTML .= "<br/>" . $this->mod->tt('Price Exc. Tax') . str_repeat('.', 20 - Tools::strlen(trim($this->mod->tt('Price Exc. Tax'))));
                $chaineHTML .= $this->getPrice($product->id, 0, 0);
            }

            if ($this->vatinc == 1) {
                $chaineHTML .= "<br/>" . $this->mod->tt('Price Inc. Tax') . str_repeat('.', 20 - Tools::strlen(trim($this->mod->tt('Price Inc. Tax'))));
                $chaineHTML .= $this->getPrice($product->id, 0, 1);
            }

            $this->WriteHTMLCell($this->cell_width, '', $posx, $posy+$height+2, $chaineHTML, 0, 1, 0, true, 'L');
            // $this->SetXY($posx, $newy+$height-20);
            //$this->WriteHTML($chaineHTML,true,false,true);

           /* if (($idx % 3) == 0)
                $this->last_y1 = ceil($this->GetY());
            else
                $this->last_y2 = ceil($this->GetY());*/
        }
    

}