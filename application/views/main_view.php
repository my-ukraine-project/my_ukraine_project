<form action="/Main/login" method="post" id="auth-form">
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
        <form >
            <div>
                <input type="email" name="email" class="auth-inp" placeholder="email">
                <br>
                <input type="password" name="password" class="auth-inp" placeholder="password">
            </div>
            <input type="submit" name="login" value="Увійти" id="auth-submit-btn">
        </form>
    </div>
</form>
