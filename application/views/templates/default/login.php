<div class="auth_login">
    <?= form_open() ?>
    <div>
        Пользователь <br/>
        <input type="text" name="username" value=""/>
    </div>
    <div>
        Пароль <br/>
        <input type="password" name="password"/>
    </div>
    <div>
        <input type="submit" name="login" value="Войти"/>
    </div>



    <?= form_close() ?>
    <?php if (isset($auth_error)): ?><?= $auth_error ?><?php endif ?>
    <?= validation_errors() ?>
</div>