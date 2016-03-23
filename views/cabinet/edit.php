<?php include 'views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if($result): ?>
                    <p>Данные успешно отредактираванны!</p>
                <?php else: ?>    
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error;?></li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif; ?>
                    
                    <div class="signup-form"> <!--sign up form-->
                        <h2>Редактирование данных</h2>
                        <form action="#" method="post">
                            <p>Новое имя:</p>
                            <input type="text" name="name" placeholder="Имя" value="<?php echo $user['name'];?>"/>
                            <p>Новый пароль:</p>
                            <input type="password" name="password" placeholder="Пароль" value=""/>
                            <br>
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить"/>
                        </form> <!--sign up form-->                
                    </div>
                    
                <?php endif;?>    
            </div>
        </div>    
    </div>
</section>


<?php include 'views/layouts/footer.php'; ?>