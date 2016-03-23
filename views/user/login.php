<?php include 'views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="col-sm-4 col-sm-offset-4 padding-right">
            
            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error;?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>

            <div class="signup-form"> <!--sign up form-->
                <h2>Вход на сайт</h2>
                <form action="#" method="post">
                    <input type="email" name="email" placeholder="E-mail" value="<?php echo $email;?>"/>
                    <input type="password" name="password" placeholder="Пароль" value=""/>
                    <input type="submit" name="submit" class="btn btn-default" value="Вход"/>
                    <a href="/user/register">
                        <input type="button" name="button" class="btn btn-default" value="Регистрация"/>
                    </a>    
                </form> <!--sign up form-->                
            </div>  
        </div>
    </div>
</section>


<?php include 'views/layouts/footer.php'; ?>
