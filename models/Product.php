<?php

class Product
{
    const SHOW_BY_DEFAULT = 6;

    /**
     * Returnes an array of products
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        //Соединение с БД
        $db = Db::getConnection();

        //Текст запроса к БД
        $sql = 'SELECT id, `name`, price, is_new FROM dr_product '
             . 'WHERE status = "1" ORDER BY id DESC '
             . 'LIMIT :count';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $productsList = [];
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
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
            $results = $db->query("SELECT id, `name`, price, is_new FROM dr_product "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id DESC "
                . "LIMIT ".self::SHOW_BY_DEFAULT
                . ' OFFSET ' . $offset);
        }

        $i = 0;
        while($row = $results->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
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

    /**
     * Возвращает список рекомендуемых товаров
     * @return array
     */
    public static function getRecommendedProducts()
    {
        //Соединение с БД
        $db = Db::getConnection();

        //Получение и возврат результатов
        $result = $db->query('SELECT id, `name`, price, is_new FROM dr_product '
                . 'WHERE status = "1" AND is_recommended = "1" '
                . 'ORDER BY id DESC');
        $i = 0;
        $productsList = [];
        while ($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Возвращает список товаров
     * @return array
     */
    public static function getProductsList()
    {
        //Соединение с БД
        $db = Db::getConnection();

        //Получение товаров и возврат результатов
        $result = $db->query('SELECT id, `name`, price, code FROM dr_product ORDER BY id ASC');
        $productsList = [];
        $i = 0;
        while ($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['code'] = $row['code'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Удаляет товар с указанным id
     * @param integer $id
     * @return boolean
     */
    public static function deleteProductById($id)
    {
        //Соединение с БД
        $db = Db::getConnection();

        //Текст запроса
        $sql = 'DELETE FROM dr_product WHERE id = :id';

        //Получение и возврат результатов(подготовленый запрос)
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной записи в таблицу</p>
     */
    public static function createProduct($options)
    {
        //Соединение с БД
        $db = Db::getConnection();

        //Текст запроса к БД
        $sql = 'INSERT INTO dr_product '
             . '(name, category_id, code, price, availability, brand, description, is_new, is_recommended, status) '
             . 'VALUES '
             . '(:name, :category_id, :code, :price, :availability, :brand, :description, :is_new, :is_recommended, :status)';

        //Получение и возврат результатов(подготовленный запрос)
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()){
            //Если запрос выполнен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        //Иначе возвращаем 0
        return 0;
    }

    /**
     * Редактирует товар с заданным id
     * @param integer $id <p>id товара</p>
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateProductById($id, $options)
    {
        //Соединение с БД
        $db = Db::getConnection();

        //Текст запроса к БД
        $sql = "UPDATE dr_product 
                SET 
                name = :name, 
                category_id = :category_id, 
                code = :code, 
                price = :price, 
                availability = :availability, 
                brand = :brand, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status 
                WHERE id = :id";

        //Получение и возврат результатов(подготовленный запрос)
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImageThumbnail($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        // Путь к папке с товарами
        $path = '/upload/images/products/thumbnails/';
        // Путь к изображению товара
        $pathToProductImage = $path . 'thumb' . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

    public static function getImageBig($id)
    {
        // Название изображения-пустышки
        $noImageBig = 'no-image-big.jpg';
        // Путь к папке с товарами
        $path = '/upload/images/products/big/';
        // Путь к изображению товара
        $pathToProductImage = $path . 'big' . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImageBig;
    }
}