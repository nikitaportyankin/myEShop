<?php
class Order
{
    /**
     * Сохранение заказа
     * @param type $name
     * $param type $email
     * @param type $password
     * @return type 
     */
    
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO dr_product_order (user_name, user_phone, user_comment, user_id, products) '
             . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';
        
//        echo '<pre>';
//        var_dump($products);
//        echo '</pre>';
        
        $products = json_encode($products);
        
//        echo '<pre>';
//        var_dump($products);
//        echo '</pre>';
        
        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        
//        $result->execute();
//        die();
        return $result->execute();             
    }
}