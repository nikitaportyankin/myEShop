<?php
/**
 * Controller AdminProductController
 * Управление товарами в админпанели
 */
class AdminProductController extends AdminBase
{
    /**
     * Action для страницы "Управление товарами"
     */
    public function actionIndex()
    {
        //Проверка доступа
        self::checkAdmin();

        //Получаем список товаров
        $productsList = Product::getProductsList();

        //Подключаем вид
        require_once (ROOT . '/views/admin_product/index.php');
        return true;
    }
    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        //Проверка доступа
        self::checkAdmin();

        //Обработка формы
        if (isset($_POST['submit'])){
            //Если форма отправлена
            //Удаляем товар
            Product::deleteProductById($id);

            //Перенаправляем пользователя на страницу управления товарами
            header("Location: /admin/product");
        }

        //Подключаем вид
        require_once (ROOT . '/views/admin_product/delete.php');
        return true;
    }
    /**
     * Action для страницы "Добавить товар"
     */
    public function actionCreate()
    {
        //Проверка доступа
        self::checkAdmin();

        //Получаем список категорий для выпадающего списка
        $categoriesListForAdmin = Category::getCategoriesListAdmin();

        //Обработка формы
        if (isset($_POST['submit'])){
            //Если форма отправлена, получаем из неё данные
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            //Устанавливаем флаг ошибок в форме
            $errors = false;

            //При необходимости можно валидировать необходимые поля нужным образом
            if (!isset($options['name']) || empty($options['name'])){
                $errors[] = 'Заполните поля';
            }

            if ($errors == false){
                //Если ошибок нет, добавляем новый товар
                $id = Product::createProduct($options);

                //Если запись добавлена
                if($id){
                    //Проверим загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])){
                        //Если загрузилось, изменяем размер для отображения в категориях и сохраняем в нужную деррикторию
                        $imageThumbnail = new SimpleImage();
                        $imageThumbnail->load($_FILES["image"]["tmp_name"]);
                        $imageThumbnail->resize(220, 170);
                        $imageThumbnail->save($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/thumbnails/thumb{$id}.jpg");
                        //Изменяем размер для отображения в карточке товара и сохраняем в нужную деррикторию
                        $imageBig = new SimpleImage();
                        $imageBig->load($_FILES["image"]["tmp_name"]);
                        $imageBig->resize(370, 320);
                        $imageBig->save($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/big/big{$id}.jpg");
                    }
                }
                //Перенаправляем пользователя на страницу "Управление товарами"
                header("Location: /admin/product");
            }
        }
        //Подключаем вид
        require_once (ROOT . '/views/admin_product/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать товар"
     */
    public function actionUpdate($id)
    {
        //Проверка доступа
        self::checkAdmin();

        //Получаем список категорий для выпадающего списка
        $categoriesListForAdmin = Category::getCategoriesListAdmin();

        //Получаем данные о конкретном товаре
        $product = Product::getProductById($id);

        //Обработка формы
        if (isset($_POST['submit'])) {
            //Если форма отправлена
            //Получаем данные из формы редактирования. При необходимости можно валидировать поля
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            //Сохранем изменения
            if (Product::updateProductById($id, $options)) {
                //Если запись сохранена
                //Проверяем загрузилось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    //Если загружалось, переместим его в нужную папку и дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }
            //Перенаправляем пользователя на страницу "Управление товарами"
            header("Location: /admin/product");
            }
        //Подключаем вид
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }
}