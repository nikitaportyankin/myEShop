<?php
/**
 * Абстрактный класс AdminBase содержит общую логику для контроллеров, которые
 * используются в панели администратора
 */
abstract class AdminBase
{
    /**
     * Метод который проверяет пользователя, является ли он админом
     * @return boolean
     */
    public static function checkAdmin()
    {
        //Проверяем авторизирован ли пользователь. Если нет, будет переадресован
        $userId = User::checkLogged();

        //Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        //Если роль текущего пользователя "admin", впускаем его в админпанель
        if ($user['role'] == 'admin'){
            return true;
        }

        //Иначе завершаем работу с сообщением о закрытом доступе
        die('Acсess denied');
    }
}