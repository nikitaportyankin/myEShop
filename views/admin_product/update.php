<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <br>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li class="active">Редактировать товар</li>
                </ol>
            </div>
            <h4>Редактирование товара #<?php echo $id; ?></h4>
            <br>
            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <p>Название товара</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $product['name']; ?>" />

                        <p>Артикул</p>
                        <input type="text" name="code" placeholder="" value="<?php echo $product['code']; ?>" />

                        <p>Стоимость, грн</p>
                        <input type="text" name="price" placeholder="" value="<?php echo $product['price']; ?>" />

                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesListForAdmin)): ?>
                                <?php foreach ($categoriesListForAdmin as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach;?>
                            <?php endif;?>
                        </select>
                        <br><br>

                        <p>Производитель</p>
                        <input type="text" name="brand" placeholder="" value="<?php echo $product['brand']; ?>" />

                        <p>Изображение товара</p>
<!--                        <img src="--><?php //echo Product::getImage($product['id']); ?><!--" width="200px" alt="" />-->
                        <input type="file" name="image" placeholder="" value="<?php echo $product['image']; ?>" />

                        <p>Детальное описание</p>
                        <textarea name="description"><?php echo $product['description'];?></textarea>
                        <br><br>

                        <p>Наличие на складе</p>
                        <select name="availability">
                            <option value="1" <?php if ($product['availability'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($product['availability'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        <br><br>

                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" <?php if ($product['is_new'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($product['is_new'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        <br><br>

                        <p>Рекомендуемые</p>
                        <select name="is_recommended">
                            <option value="1" <?php if ($product['is_recommended'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($product['is_recommended'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        <br><br>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Отображать</option>
                            <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Скрыть</option>
                        </select>
                        <br><br>

                        <input type="submit" name="submit" class="btn btn-default" data-toggle="modal" data-target="#myModal" value="Сохранить"/>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
