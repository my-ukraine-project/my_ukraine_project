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
                                        <a class="btn btn-success edit-link" href="/Quests/add?edit=<?= $quest->id ?>"> Редагувати квест <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div> 
                        </div>


                        <div style="clear: both; margin-bottom: 40px;"></div>

                        <input type="text" name="qid" value="<?= $quest->id ?>" hidden>
                    <!--    <div class="tab-content">-->
                        <?php $cnt = 0; foreach ($quest->questions as $question) { $cnt++;
                            ?><div class="alert alert-success"><?php
                                $atype = null;
                                if ($question->type !== "puzzle") {
                                    $atype = count_right($question) > 1 ? "checkbox" : "radio";
                                }

                                if ($question->type === "image") { ?>
                                    <img src="/<?= $question->content ?>" style="width: 300px;">
                                <?php } else if ($question->type === "puzzle") { ?>
                                    <p>Собирите пазл</p>
                                    <img src="/<?= $question->content ?>" id="<?= $question->type ."-". $cnt ?>" style="width: 300px;">
                                    <script type="text/javascript">
                                        $(function () {
                                            $('#input-<?= $question->type ."-". $cnt ?>').prop('checked', false);
                                            snapfit.add(document.getElementById('<?= $question->type ."-". $cnt ?>'), {
                                                "level": 1, "mixed": true, simple: true, polygon: true, callback: function () {
                                                    $('#input-<?= $question->type ."-". $cnt ?>').prop('checked', true);
                                                    alert("вы собрали пазл");
                                                }
                                            });
                                        })
                                    </script>
                                <?php } else if ($question->type === "text") { ?>
                                    <p><?= $question->content ?></p>
                                <?php } else if ($question->type === "video") { ?>
                                    <div class="quest-video"><?= $question->content ?></div>
                                <?php } else if ($question->type === "map") { ?>
                                    <div class="quest-map"><?= $question->content ?></div>
                                <?php }?>

                            <?php if ($question->type === "puzzle") { ?>
                                <input type="checkbox" name="<?= $question->type ."-". $cnt ?>"
                                       id="input-<?= $question->type ."-". $cnt ?>" hidden>

                            <?php } else { ?>

                                <p style="margin-top: 20px; margin-bottom: 20px; font-size: 1.2em; font-weight: bold;"><?= $question->question ?></p>
                                <?php if ($atype == "radio") { ?>
                                    <p><input type="radio" name="answer<?= $cnt ?>" value="1"> <label><?= $question->a1->text ?></label></p>
                                    <p><input type="radio" name="answer<?= $cnt ?>" value="2"> <label><?= $question->a2->text ?></label></p>
                                    <p><input type="radio" name="answer<?= $cnt ?>" value="3"> <label><?= $question->a3->text ?></label></p>
                                    <p><input type="radio" name="answer<?= $cnt ?>" value="4"> <label><?= $question->a4->text ?></label></p>
                                <?php } else { ?>
                                    <p><input type="checkbox" name="answer<?= $cnt ?>-1"> <label><?= $question->a1->text ?></label></p>
                                    <p><input type="checkbox" name="answer<?= $cnt ?>-2"> <label><?= $question->a2->text ?></label></p>
                                    <p><input type="checkbox" name="answer<?= $cnt ?>-3"> <label><?= $question->a3->text ?></label></p>
                                    <p><input type="checkbox" name="answer<?= $cnt ?>-4"> <label><?= $question->a4->text ?></label></p>
                                <?php } ?>

                            <?php } ?>

                            </div>
                        <?php } ?>
                    <!--    </div>-->
                        <input type="submit" value="Надіслати" class="btn btn-default">
                    </form>


                </div>

                <div class="row">
                    <hr>
                        <p style="font-size: 2em; color: #aaaaaa;">Понравився квест? Постав лайк!</p>
                    <hr>
                    <span class="likebtn-wrapper" data-lang="ru" data-identifier="item_1"></span>
                    <script>(function(d,e,s){if(d.getElementById("likebtn_wjs"))return;a=d.createElement(e);m=d.getElementsByTagName(e)[0];a.async=1;a.id="likebtn_wjs";a.src=s;m.parentNode.insertBefore(a, m)})(document,"script","//w.likebtn.com/js/w/widget.js");</script>
                </div>

                <div class="row">
                        <hr>
                            <p style="font-size: 2em; color: #aaaaaa;">Коментарi</p>
                        <hr>
                    <div id="mc-container"></div>
                    <script type="text/javascript">
                    cackle_widget = window.cackle_widget || [];
                    cackle_widget.push({widget: 'Comment', id: 52905});
                    (function() {
                        var mc = document.createElement('script');
                        mc.type = 'text/javascript';
                        mc.async = true;
                        mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
                    })();
                    </script>
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDivmZHbm2P1MFI278_IWoKxSy59UeNOnY&callback=initMap"></script>