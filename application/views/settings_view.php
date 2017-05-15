<div class="container-fluid" id="container">
	<div class="row">
		<div id="sidebar">
			<img src="/img/logo.png" alt="" class="logo">
			<div class="welcome">
				<p>Привiт, <b><?php $var = explode(" ", $data->fio, 2); echo $var[0]; ?></b>!</p>
			</div>
			<div class="main-menu">
				<ul>
					<li><a href="/"> <i class="fa fa-home" aria-hidden="true"></i> Головна</a></li>
					<li><a href="/Information"> <i class="fa fa-info" aria-hidden="true"></i> Інформація</a></li>
					<li><a href="/Map"> <i class="fa fa-map-marker" aria-hidden="true"></i> Гра на мапі</a></li>
					<li><a href="/Quests"> <i class="fa fa-tasks" aria-hidden="true"></i> Квести</a></li>
					<li><a href="/Rating"> <i class="fa fa-bar-chart" aria-hidden="true"></i> Рейтинг</a></li>
					<li><p style="color: #FF7416; text-shadow: 0px 0px 1px #000; font-weight: bold;"> <i class="fa fa-cogs" aria-hidden="true"></i> Налаштування</p></li>
				</ul>
			</div>
			<div class="advance">
				<p>Мої <b>успіхи</b></p>
                <div class="advance-percent"><?= $data->progress ?>%</div>
				<p>пройдено</p>
        <div class="logout">
            <a href="/Main/logout" class="btn btn-danger">Вийти</a>
        </div>
			</div>
		</div>
		<div id="content">
			<div class="container-fluid">

				<h1>Налаштування</h1>

			<form action="/Settings/save" name="settings-form" method="post">
				<div class="row">
					<div class="col-sm-4">
						<h2>Основна інформація</h2>
						<p><b>Прізвище, ім'я</b></p>
						<input type="text" class="form-control" name="settings-name" value="<?= $data->fio ?>"><br>
						<p><b>E-mail</b></p>
						<input type="text" class="form-control" name="settings-email" value="<?= $data->email ?>"><br>
						<p><b>Пароль</b></p>
						<input type="password" class="form-control" placeholder="Новий пароль" name="settings-password"><br>
						<p><b>Повторіть пароль</b></p>
						<input type="password" class="form-control" placeholder="Повторіть новий пароль"  name="settings-password-repeat"><br>
						<br>
					</div>

					<div class="col-sm-4">
						<h2>Додаткова інформація</h2>
						<p><b>Номер телефону</b></p>
						<input type="text" class="form-control" placeholder=""  name="settings-phone" value="<?= $data->phone ?>"><br>
						<p><b>Мiсто</b></p>
						<input type="text" class="form-control" placeholder=""  name="settings-city" value="<?= $data->city ?>"><br>
						<p><b>Школа</b></p>
						<input type="text" class="form-control" placeholder=""  name="settings-school" value="<?= $data->school ?>"><br>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 text-center">
          				<input type="submit" name="save" class="btn btn-success btn-lg">
					</div>
				</div>
            </form>

				<div class="row">
					<footer id="footer-dashboard">
						<p>Поділися квестами з друзями! <i class="fa fa-arrow-down" aria-hidden="true"></i> </p>
						<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter"></div>
						<div class="footer-menu">
							<ul>
								<li><a href="/"> <i class="fa fa-home" aria-hidden="true"></i> Головна</a></li>
								<li><a href="/Information"> <i class="fa fa-info" aria-hidden="true"></i> Інформація</a></li>
								<li><a href="/Quests"> <i class="fa fa-tasks" aria-hidden="true"></i> Квести</a></li>
								<li><a href="/Rating"> <i class="fa fa-bar-chart" aria-hidden="true"></i> Рейтинг</a></li>
								<li><a href="/Settings"> <i class="fa fa-cogs" aria-hidden="true"></i> Налаштування</a></li>
							</ul>
						</div>
					</footer>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>