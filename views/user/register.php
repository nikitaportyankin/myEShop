<?php include 'views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="col-sm-4 col-sm-offset-4 padding-right">
            <?php if($result): ?>
                <p>Вы успешно зарегистрировались!</p>
            <?php else: ?>    
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error;?></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
                <div class="signup-form"> <!--sign up form-->
                    <h2>Регистрация на сайте</h2>
                    <form action="#" method="post">
                        <input type="text" name="name" placeholder="Имя" value="<?php echo $name;?>"/>
                        <input type="email" name="email" placeholder="E-mail" value="<?php echo $email;?>"/>
                        <input type="password" name="password" placeholder="Пароль" value=""/>
                        <input type="submit" name="submit" class="btn btn-default" value="Зарегистрироваться"/>
                    </form> <!--sign up form-->                
                </div>
            <?php endif;?>    
        </div>
    </div>
</section>


<?php include 'views/layouts/footer.php'; ?>
