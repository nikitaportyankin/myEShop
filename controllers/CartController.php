<?php

class CartController
{
    /**
     * Action для добавления товара в корзину синхронным запросом (для примера, не используется)
     * @param integer $id id товара
     */
    public function actionAdd($id)
    {
        //Добавляем товар в корзину
        Cart::addProduct($id);
        
        //Возвращаем пользователя на страницу
        $referrer = $_SERVER['HTTP_REFERER']; 
        header("Location: $referrer");
    }
    
    
    
    /**
     * Action для добавления товара в корзину при помощи асинхронного запроса (ajax)
     * @param integer $id id товара
     */
    public function actionAddAjax($id)
    {
        //Добавляем товар в корзину
        echo Cart::addProduct($id);
        return true;
    }
    
    public function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoryList();
        
        $productsInCart = false;
        
        //Получаем данные из корзины
        $productsInCart = Cart::getProducts();
        
        if ($productsInCart){
            //Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            
            //Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once (ROOT . '/views/cart/index.php');
        
        return true;
    }
    
    /**
     * Action для страницы "Оформление покупки"
     */
    public function actionCheckout()
    {
        // Получием данные из корзины      
        $productsInCart = Cart::getProducts();
        // Если товаров нет, отправляем пользователи искать товары на главную
        if ($productsInCart == false) {
            header("Location: /");
        }
        
        //Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoryList();
        
        //Статус успешного оформления заказа
        $result = false;
        
        //Форма отправлена - Да
        if (isset($_POST['submit'])){
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            
            //Валидация полей
            $errors = false;
            if (!User::checkName($userName)){
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPhone($userPhone)){
                $errors[] = 'Неправильный номер телефона';
            }
            
            //Заполнена ли корректно фформа?
            if ($errors == false){
                //Форма заполнена корректно - Да
                //Сохраняем заказ в базе данных
                
                //Собираем информацию о заказе
                $productInCart = Cart::getProducts();
                if (User::isGuest()){
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }
                
                //Сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productInCart);
                if($result){
                    //Оповещаем администратора о новом заказе
                    $adminEmail = 'admin@gmail.com';
                    $message = 'http://dresscode.loc/admin/orders';
                    $subject = 'Новый заказ';
                    mail($adminEmail, $message, $subject);
                    
                    //Очищаем корзину
                    Cart::clear();
                }    
            } else {
                //Форма заполнена корректно - Нет
                $productInCart = Cart::getProducts();
                $productsIds = array_keys($productInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();      
            }
        } else{
            //Форма отправлена - Нет
            
            //Получение данных из корзины
            $productInCart = Cart::getProducts();
            
            //В корзине есть товары?
            if ($productInCart == false){
                //В корзене есть товары? - Нет
                //Отправляем пользователя на главную искать товары
                header('Location: /');
            } else {
                //В корзине есть товары? - Да
                //Собираем информацию о товарах в корзине
                $productsIds = array_keys($productInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
                
                $userName = false;
                $userPhone = false;
                $userComment = false;
                
                //Пользователь авторизован?
                if (User::isGuest()){
                    //Нет
                    //Значения для формы пустые
                } else {
                    //Да - авторизован
                    //Плучаем информацию о пользователе из БД по id
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    //Подставляем в форму
                    $userName = $user['name'];
                }
            }      
        }   
        require_once (ROOT . '/views/cart/checkout.php');
        
        return true;
    }
}