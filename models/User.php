<?php

class User
{
    public static function register($name, $email, $password){
        
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO dr_user (name, email, password) '
             . 'VALUES (:name, :email, :password)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result->execute();
        
    }
    
    /**
     * Проверяет имя не меньше, чем 3 символа
     */
    public static function checkName($name){
        if(strlen($name) >= 3){
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет пароль не меньше, чем 6 символа
     */
    public static function checkPassword($password){
        if(strlen($password) >= 6){
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет email
     */
    public static function checkEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    
    public static function checkEmailExists($email){
        
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM dr_user WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        
        if ($result->fetchColumn())
            return true;
        return false;
    }
    
    /**
     * Проверяем существует ли пользователь с заданным $email и $password 
     * @param type $email
     * @param type $password
     * @return mixed : integer $userId or false
     */
    public static function checkUserData($email, $password){
        
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM dr_user WHERE email = :email AND password = :password';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        
        $user = $result->fetch();
        if($user){
            return $user['id'];
        }
        
        return false;
    }
    
    /**
     * Запоминаем пользователя
     * @param string $email 
     * @param string $password
     */
    public static function auth($userId){
        $_SESSION['user'] = $userId;
        
    }
    
    public static function checkLogged(){
        //Если сессия есть вернём идентификатор пользователя
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }
    
    public static function isGuest(){
        if(isset($_SESSION['user'])){
            return false;;
        }
        return true;
    }
    
    /*
     * Returns user by id
     * @param integer $id
     */
    public static function getUserById($id){
        if ($id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM dr_user WHERE id = :id';
            
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            
            //Указываем, что хотим получить параметры в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            return $result->fetch();
        }
    }
    
    public static function edit($id, $name, $password){
        
        $db = Db::getConnection();
        
        $sql = "UPDATE dr_user SET name = :name, password = :password WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }
    
    /**
     * Проверяет телефон: не меньше, чем 10 символов
     * @param string $phone
     * @return boolean
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

}