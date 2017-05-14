<div class="container-fluid" id="container">
	<div class="row">
		<div id="sidebar">
			<img src="/img/logo.png" alt="" class="logo">
			<div class="welcome">
				<p>Привiт, <b><?php $var = explode(" ", $data["user"]->fio, 2); echo $var[0]; ?></b>!</p>
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


                    <?php
                    $quest = $data["quest"];
                    $user  = $data["user"];

                    function count_right($q) {
                        return count(array_filter(array($q->a1, $q->a2, $q->a3, $q->a4), function ($e) {
                            return !!$e->right;
                        }));
                    }

                    ?>

                    <form action="/Quests/pass" method="post">
                        <div class="quest alert alert-warning">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h3> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <?= $quest->name ?></h3>
                                        <p><?= $quest->target ?></p>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <a class="btn btn-danger back-link" href="/Quests"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Повернутися до квестiв</a>
                                    </div>
                                </div>
                            </div> 
                        </div>


                        <div style="clear: both; margin-bottom: 40px;"></div>

                        <input type="text" name="qid" value="<?= $quest->id ?>" hidden>
                    <!--    <div class="tab-content">-->
                        <?php foreach ($quest->questions as $question) {
                            ?><div class="alert alert-success"><?php
                                $atype = count_right($question) > 1 ? "checkbox" : "radio";

                                if ($question->type === "image") { ?>
                                    <img src="/<?= $question->content ?>" style="width: 300px;">
                                <?php } else if ($question->type === "puzzle") { ?>
                                    <img src="/<?= $question->content ?>" style="width: 300px;">
                                <?php } else if ($question->type === "text") { ?>
                                    <p><?= $question->content ?></p>
                                <?php } else if ($question->type === "video") { ?>
                                    <div class="quest-video"><?= $question->content ?></div>
                                <?php } else if ($question->type === "map") { ?>
                                    <div class="quest-map"><?= $question->content ?></div>
                                <?php }?>

                                <p style="margin-top: 20px; margin-bottom: 20px; font-size: 1.2em; font-weight: bold;"><?= $question->question ?></p>

                                <p><input type="<?= $atype ?>" name="a1"> <label for="a1"> <?= $question->a1->text ?></label></p>
                                <p><input type="<?= $atype ?>" name="a2"> <label for="a2"> <?= $question->a2->text ?></label></p>
                                <p><input type="<?= $atype ?>" name="a3"> <label for="a3"> <?= $question->a3->text ?></label></p>
                                <p><input type="<?= $atype ?>" name="a4"> <label for="a4"> <?= $question->a4->text ?></label></p>

                            </div>
                        <?php } ?>
                    <!--    </div>-->
                        <input type="submit" value="Надіслати" class="btn btn-default">
                    </form>


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
