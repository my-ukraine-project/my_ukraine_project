<form action="" id="auth-form">
    <div class="auth-form-header">
        <h4 class="text-center">
            <div style="display:inline-block">
                <p>Авторизація</p>
                <img src="/img/auth-logo.png" alt="">
                <p><a href="/SignUp">Реєстрація</a></p>
                <div class="cb"></div>
            </div>
        </h4>
        <div class="cb"></div>

    </div>
    <div class="cb"></div>
    <div class="auth-form-inp">
        <form action="/main/login" method="post">
        <div>
            <input type="email" class="auth-inp" placeholder="email"><br>
            <input type="password" class="auth-inp" placeholder="password">
        </div>
            <input type="submit" value="Увійти" id="auth-submit-btn">
        </form>
    </div>
</form>
