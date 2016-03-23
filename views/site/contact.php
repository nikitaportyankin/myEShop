<?php include 'views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if($result): ?>
                    <p>Сообщение отправлено! Мы ответим Вам на указанный e-mail адресс.</p>
                <?php else: ?>    
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error;?></li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                    <div class="signup-form"> <!--sign up form-->
                        <h2>Обратная связь</h2>
                        <h5>Есть вопрос? Напишите нам.</h5>
                        <form action="#" method="post">
                            <p>Ваш e-mail</p>
                            <input type="email" name="user_email" placeholder="E-mail" value="<?php echo $userEmail ;?>"/>
                            <p>Тема письма</p>
                            <input type="text" name="user_letter_subject" placeholder="Тема письма" value="<?php echo $userLetterSubject ;?>"/>
                            <p>Сообщение</p>
                            <input type="text" name="user_text" placeholder="Сообщение" value="<?php echo $userText ;?>"/>
                            <br>
                            <input type="submit" name="submit" class="btn btn-default" value="Отправить"/>
                        </form> <!--sign up form-->                
                    </div>
                <?php endif;?>
            </div>
        </div>    
    </div>
</section>


<?php include 'views/layouts/footer.php'; ?>
