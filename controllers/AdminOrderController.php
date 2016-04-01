<?php
/**
 * Контроллер AdminOrderController
 * Управление заказами в админпанели
 */
class AdminOrderController extends AdminBase
{
    /**
     * Action для страницы "Управление заказами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список заказов
        $ordersList = Order::getOrdersList();
        
        // Подключаем вид
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр заказа"
     */
    public function actionView($id)
    {
        //Проверка доступа
        self::checkAdmin();

        //Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        //Получаем массив с идентификаторами и кол-вом товаров
        $productsQuantity = json_decode($order['products'], true);
        echo '<pre>';
        print_r($productsQuantity);
        echo '</pre>';

        //Получаем массив с идентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        //Получаем список товаров в заказе
        $products = Product::getProductsByIds($productsIds);

        //Подключаем вид
        require_once (ROOT . '/views/admin_order/view.php');
        return true;
    }
}
