<?php 
require_once 'app/Mage.php';
umask(0);
Mage::app('default');
$cat_id = 2117;
    

    $skus = array();
    $category = Mage::getModel('catalog/category')->load($cat_id);
    $collection = $category->getProductCollection()->addAttributeToSort('position');
    Mage::getModel('catalog/layer')->prepareProductCollection($collection);
    foreach ($collection as $product) {
        $product_id = $product->getId();
        $_product = Mage::getModel('catalog/product')->load($product_id);
        $skus[] = $_product->getSku();
        $ids[] = $_product->getId();
//        getchild stuff
        $id_c = $_product->getId();
        $productc = Mage::getModel('catalog/product')->load($id_c); 
        $childProducts = Mage::getModel('catalog/product_type_configurable')->getUsedProducts(null,$productc);
        foreach($childProducts as $child) {
            $childsku[] = $child->getSku();
        }
    }
    $sku_list = implode(';', $skus);
    $child_list = implode(';', $childsku);

    
    echo $sku_list;
    echo ";";
    echo $child_list;