<?php

class Product
{
    const SHOW_BY_DEFAULT = 6;

    /**
     * Returnes an array of products
     */

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $productsList = [];

        $result = $db->query('SELECT id, `name`, price, image, is_new FROM dr_product '
                . 'WHERE status = "1" '
                . 'ORDER BY id DESC '
                . 'LIMIT ' . $count);

        $i = 0;
        while($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if($categoryId){
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            
            $db = Db::getConnection();
            $products = [];
            $resuls = $db->query("SELECT id, `name`, price, image, is_new FROM dr_product "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id DESC "
                . "LIMIT ".self::SHOW_BY_DEFAULT
                . ' OFFSET ' . $offset);
        }

        $i = 0;
        while($row = $resuls->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }
    
    public static function getProductById($id)
    {
        if($id){
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM dr_product WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            return $result->fetch();
        }
    }
    
    /**
     * Returns total products
     */
    
    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT count(id) as count FROM dr_product '
                . 'WHERE status="1" AND category_id="'. $categoryId .'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        
        return $row['count'];
    }
    
    /*
     * Returns products
     */ 
    public static function getProductsByIds($idsArray){
        $products = [];
        
        $db = Db::getConnection();
        
        $idsString = implode(',', $idsArray);
        
        $sql = "SELECT * FROM dr_product WHERE status='1' AND id IN ($idsString)";
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }
}