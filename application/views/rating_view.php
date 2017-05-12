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
					<li><a href="/Quests"> <i class="fa fa-tasks" aria-hidden="true"></i> Квести</a></li>
					<li><p style="color: #FF7416; text-shadow: 0px 0px 1px #000; font-weight: bold;"> <i class="fa fa-bar-chart" aria-hidden="true"></i> Рейтинг</p></li>
					<li><a href="/Settings"> <i class="fa fa-cogs" aria-hidden="true"></i> Налаштування</a></li>
				</ul>
			</div>
			<div class="advance">
				<p>Мої <b>успіхи</b></p>
				<div class="advance-percent">
					40%
				</div>
				<p>пройдено</p>
        <div class="logout">
            <a href="/Main/logout" class="btn btn-danger">Вийти</a>
        </div>
			</div>
		</div>
		<div id="content">
			<div class="container-fluid">

				<h1>Рейтинг</h1>

				 <table class="table table-hover table-bordered">
					 <thead>
						 <tr class="success">
						 <th>Прізвище, ім'я</th>
						 <th>Загальні бали</th>
						 <th>Квест 1</th>
						 <th>Квест 2</th>
						 <th>Квест 3</th>
						 <th>Квест 4</th>
						 <th>Квест 5</th>
						 </tr>
					 </thead>
					 <tbody>
						 <tr>
							 <td>Учасник 3</td>
							 <td>100</td>
							 <td>20</td>
							 <td>20</td>
							 <td>20</td>
							 <td>20</td>
							 <td>20</td>
						 </tr>
						 <tr>
							 <td>Учасник 1</td>
							 <td>50</td>
							 <td>10</td>
							 <td>10</td>
							 <td>10</td>
							 <td>10</td>
							 <td>10</td>
						 </tr>
						 <tr>
							 <td>Учасник 2</td>
							 <td>25</td>
							 <td>5</td>
							 <td>5</td>
							 <td>5</td>
							 <td>5</td>
							 <td>5</td>
						 </tr>
						<tr>
							 <td>Учасник 4</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
						 </tr>
						<tr>
							 <td>Учасник 5</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
						 </tr>
						 <tr>
							 <td>Учасник 6</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
						 </tr>
						 <tr>
							 <td>Учасник 7</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
							 <td>0</td>
						 </tr>
					 </tbody>
				 </table>

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