<div class="container-fluid" id="container">
	<div class="row">
		<div id="sidebar">
			<img src="/img/logo.png" alt="" class="logo">
			<div class="welcome">
				<p>Привiт, <b><?php $var = explode(" ", $data->user->fio, 2); echo $var[0]; ?></b>!</p>
			</div>
			<div class="main-menu">
				<ul>
					<li><a href="/"> <i class="fa fa-home" aria-hidden="true"></i> Головна</a></li>
					<li><a href="/Information"> <i class="fa fa-info" aria-hidden="true"></i> Інформація</a></li>
					<li><a href="/Map"> <i class="fa fa-map-marker" aria-hidden="true"></i> Гра на мапі</a></li>
					<li><p style="color: #FF7416; text-shadow: 0px 0px 1px #000; font-weight: bold;"> <i class="fa fa-tasks" aria-hidden="true"></i> Квести</p></li>
					<li><a href="/Rating"> <i class="fa fa-bar-chart" aria-hidden="true"></i> Рейтинг</a></li>
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

				<div class="row">
					<div class="col-sm-10"><h1>Квести</h1></div>
					<div class="col-sm-2"><a class="btn btn-danger" href="/Quests/add" style="margin-top: 40px;">Додати квест</a></div>
				</div>

                <div class="row">


				<?php

				if (empty($data->quests)) {
					?><h3> Ще не додано жодного квесту, зробіть це прямо зараз! </h3><?php
				} else {

                    $counter = 0;
                    foreach ($data->quests as $quest) { $counter++; ?>
                        <div class="quest alert alert-warning">
                            <span><?= $counter ?></span>
                            <a href="/Quests/passing?q=<?= $quest->id ?>"><h3> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <?= $quest->data->name ?></h3></a><br>
                            <p><b>Мета квесту:</b> <?= $quest->data->target ?></p><br>
                            <span><b>Додав квест:</b> <?= $quest->fio ?></span>
                        </div>

                    <?php }

				}

				?>


                </div>

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
