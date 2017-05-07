<header id="header">
        <h1>Славетний шлях Петра Сагайдачного</h1>
</header>

<div class="container">
	<form action="/SignUp/register" id="auth-form" method="post">
		<div class="auth-form-header">
			<h4 class="text-center">
				<div style="display:inline-block">
					<p><a href="/">Авторизація</a></p>
					<img class="logo" src="/img/logo.png" alt="">
					<p>Реєстрація</p>
					<div class="cb"></div>
				</div>
			</h4>
			<div class="cb"></div>
		</div>
		<div class="cb"></div>
		<div class="auth-form-inp">
			<div>
				<p id="error-name"></p>
				<input name="fio" type="text" class="auth-inp" placeholder="Прізвище та ім'я">
				<p id="error-email"></p>
				<input name="email" type="text" class="auth-inp" placeholder="Email">
				<p id="error-password"></p>
				<input name="password" type="password" class="auth-inp" placeholder="Пароль">
			</div>
			<input id="auth-submit-btn" type="submit" name="register" value="Зареєструватися">
		</div>
	</form>
</div>

<footer id="footer">
<div class="auth-footer">
        <div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name;providers=google,vkontakte,odnoklassniki,mailru,facebook,instagram;redirect_uri=http%3A%2F%2F;mobilebuttons=0;"></div>      </div>
</footer>

<script src="//ulogin.ru/js/ulogin.js"></script>