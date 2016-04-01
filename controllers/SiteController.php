<?php

/**
 * Class SiteController
 */
class SiteController
{
    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        //Список категорий для левого меню
        $categories = [];
        $categories = Category::getCategoryList();

        //Список последних товаров
        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(6);

        //Список товаров для слайдера
        $sliderProducts = [];
        $sliderProducts = Product::getRecommendedProducts();

        //Подключаем представление(вид)
        require_once(ROOT . '/views/site/index.php');
        return true;
    }
    
    public function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $userLetterSubject = '';
        $result = false;
        
        if (isset($_POST['submit'])){
            $userEmail = $_POST['user_email'];
            $userLetterSubject = $_POST['user_letter_subject'];
            $userText = $_POST['user_text'];
            
            $errors = false;
            
            //Валидация полей
            if (!User::checkEmail($userEmail)){
                $errors = 'Неправильный e-mail';
            }
            
            if ($errors == false){
                $adminEmail = 'nikita.portyankin@gmail.com';
                $message = "Текст: {$userText}. От: {$userEmail}";
                $result = mail($adminEmail, $userLetterSubject, $message);
                $result = true;
            }
        }
        require_once (ROOT . '/views/site/contact.php');
        
        return true;
    }    
}
