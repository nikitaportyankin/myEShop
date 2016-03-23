<?php

class SiteController
{

    public function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoryList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(6);

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
