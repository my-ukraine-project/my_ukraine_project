<div class="container-fluid" id="container">
	<div class="row">
		<div id="sidebar">
			<img src="/img/logo.png" alt="" class="logo">
			<div class="welcome">
				<p>Привiт, <b>Username</b>!</p>
			</div>
			<div class="main-menu">
				<ul>
					<li><a href="/"> <i class="fa fa-home" aria-hidden="true"></i> Головна</a></li>
					<li><a href="/Information"> <i class="fa fa-info" aria-hidden="true"></i> Інформація</a></li>
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
          <button type="button" class="btn btn-danger">Вийти</button>
				</div>
			</div>
		</div>
		<div id="content">
			<div class="container-fluid">

			<ul id="myTab2" class="nav nav-tabs">
			  <li><a data-toggle="tab" href="#panely1">Пазли</a></li>
			  <li><a data-toggle="tab" href="#panely2">Тести</a></li>
	      <li><a data-toggle="tab" href="#panely3">???</a></li>
			</ul>
			 
			<div class="tab-content">
			  <div id="panely1" class="tab-pane fade in active">
					<h3>Пазли</h3>
					<div class="row">
					<div class="col-sm-3">
						<img class="puzzle" src="/img/portrait.jpg"><br><br>
						<img class="puzzle" onLoad="snapfit.add(this);" src="/img/portrait.jpg" id="portrait">
						<br><br>
							<strong>Рівень складності</strong> <select id="level" size="1" onchange="snapfit.reset(document.getElementById('portrait'),parseInt(this.options[this.selectedIndex].value));">
							  <option value="0" selected="selected">160px (самый легкий)</option>
							  <option value="1">128px (очень легкий)</option>
							  <option value="2">104px (легкий)</option>
							  <option value="3">080px (средний)</option>
							  <option value="4">064px (высокий)</option>
							  <option value="5">056px (очень высокий)</option>
							  <option value="6">048px (самый высокий)</option>
							</select><br><br>
							<button class="btn btn-primary" type="button" onclick="snapfit.admix(document.getElementById('portrait'));">Перемішати</button>
							<button class="btn btn-success" type="button" onclick="snapfit.solve(document.getElementById('portrait'));">Зібрати</button><br>
					</div>

					<div class="col-sm-9">
						<h4>Як керувати?</h4>
						<p><b>перейти:</b> перетягнути</p>
						<p><b>перевернути:</b> подвійний клік</p>
						<p><b>фліп-у:</b> подвійний клік + [Shift] або середньою кнопкою миші</p>
						<p><b>фліп-х:</b> подвійний клік + [Alt] або правою кнопки миші</p>
						<br>
						<p><b>скинути:</b> натисніть [escape]</p>
						<p><b>перемішати:</b> натисніть [enter]</p>
					</div>
				</div>
				</div>
			  <div id="panely2" class="tab-pane fade">
			    <h3>Тести</h3>
			    <?php
						$quest_counter = 0;
						foreach ($data["quests"] as $quest) {
						    $quest_counter++;
						?>
						    <div>
						        <a href="/Quests/pass?q=<?= $quest->id ?>">
						            <span><?= $quest_counter ?></span>
						            <p><?= $quest->data->target ?></p>
						            <span><?= $quest->fio ?></span>
						        </a>
						    </div>
					<?php } ?>
			  </div>
			  <div id="panely3" class="tab-pane fade">
			    <h3>3</h3>
			  </div>
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

<!-- Отображение 1 таба по умолчанию -->
<script type="text/javascript">
$(document).ready(function(){ 
    $("#myTab2 li:eq(0) a").tab('show');
});
</script>