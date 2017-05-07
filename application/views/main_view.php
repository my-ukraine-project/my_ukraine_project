<header id="header">
        <h1>Славетний шлях Петра Сагайдачного</h1>
</header>

<div class="container">
    <form action="/Main/login" method="post" id="auth-form">
<div class="auth-form-header">
    <h4 class="text-center">
        <div style="display:inline-block">
            <p>Авторизація</p>
            <img class="logo" src="/img/logo.png" alt="">
            <p><a href="/SignUp">Реєстрація</a></p>
            <div class="cb"></div>
        </div>
    </h4>
    <div class="cb"></div>
        </div>
        <div class="cb"></div>
        <div class="auth-form-inp">
            <div>
                <input type="text" name="email" class="auth-inp" placeholder="Email"><br>
                <input type="password" name="password" class="auth-inp" placeholder="Пароль">
            </div>
            <input type="submit" name="login" value="Увійти" id="auth-submit-btn">
        </div>
    </form>
</div>

<footer id="footer">
<div class="auth-footer">
        <div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name;providers=google,vkontakte,odnoklassniki,mailru,facebook,instagram;redirect_uri=http%3A%2F%2F;mobilebuttons=0;"></div>      </div>
</footer>

<script src="//ulogin.ru/js/ulogin.js"></script>