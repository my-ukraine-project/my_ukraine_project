<!-- НАЧАЛО обработчика формы -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#main-form").submit(function() {

            if($("#quest-name").val()=="") {
                $("#quest-name").css("border", "1px solid #d61907");
                return false;
            } else {
                $("#quest-name").css("border", "");
            }

            if($("#quest-target").val()=="") {
                $("#quest-target").css("border", "1px solid #d61907");
                return false;
            } else {
                $("#quest-target").css("border", "");
            }

            var isok = true;

            $(".tab-content .tab-pane").each(function (idx, e) {
                var index = idx + 1;
                var select = $("select[name=content"+ index +"]").val();

                var item = undefined;
                if (select === "image") {
                    item = $("input[type=file][name="+ select + index +"]");
                    if (item.val() === "") {
                        item.css("border", "1px solid #d61907");
                        isok = false;
                        return;
                    } else { item.css("border", ""); }

                } else if (select === "puzzle") {
                    item = $("input[type=file][name="+ select + index +"]");
                    if (item.val() === "") {
                        item.css("border", "1px solid #d61907");
                        isok = false;
                        return;
                    } else { item.css("border", "");}

                } else if (select === "text" || select === "map" || select === "video") {
                    item = $("textarea[name="+ select + index +"]");
                    if (item.val() === "") {
                        item.css("border", "1px solid #d61907");
                        isok = false;
                        return;
                    } else { item.css("border", ""); }
                }

                if (select !== "puzzle") {

                    var question = $("input[type=text][name=question"+ index +"]");
                    if (question.val() === "") {
                        question.css("border", "1px solid #d61907");
                        isok = false;
                        return;
                    } else { question.css("border", ""); }


                    var array_right = [];
                    for (var i = 1; i <= 4; i++) {
                         var answer = $("input[type=text][name=answer"+ index +"-"+ i +"]");

                         if (answer.val() === "") {
                             answer.css("border", "1px solid #d61907");
                             isok = false;
                             return;
                         } else { answer.css("border", ""); }

                        array_right.push($("input[type=checkbox][name=right-answer"+ index +"-"+ i +"]").is(':checked'));
                    }

                    if (array_right.indexOf(true) < 0) {
                        alert("Хотя бы один ответ должен быть правильным.");
                        isok = false;
                    }
                }
            });

            return isok;
        });
     });
</script>

<!-- КОНЕЦ обработчика формы -->

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

            <div class="row">
                <div class="col-sm-10"><h1>Додавання квесту</h1></div>
                <div class="col-sm-2"><a class="btn btn-danger" href="/Quests" style="margin-top: 40px;">Повернутися на квести</a></div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <form action="/Quests/add" method="post" enctype="multipart/form-data" id="main-form" name="main-form">
                    <h4>Назва квесту</h4>
                    <input class="form-control" name="quest-name" id="quest-name" type="text">

                    <h4>Мета квесту</h4>
                    <textarea class="form-control" name="quest-target" id="quest-target" cols="30" rows="10"></textarea>

                    <br><br>

                    <ul id="myTab" class="nav nav-tabs">
                      <li id="tab1" class="tab active"><a href="#panel1">Завдання 1</a></li>
                      <li id="tab2" class="tab"><a href="#panel2">Завдання 2</a></li>
                      <li id="tab3" class="tab"><a href="#panel3">Завдання 3</a></li>
                      <li id="tab4" class="tab"><a href="#panel4">Завдання 4</a></li>
                      <li id="tab5" class="tab"><a href="#panel5">Завдання 5</a></li>
<!--                      <li id="addTab" class="tab"><a href="#">+</a></li>-->
                    </ul>

                    <div class="tab-content">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <div id="panel<?= $i ?>" data-panel="<?= $i ?>" class="tab-pane fade <?= $i == 1 ? "in active" : "" ?>">
                            <h4>Який елемент додаємо?</h4>

                            <select class="form-control" name="content<?= $i ?>" class="select-content">
                                <option value="image">Картинку</option>
                                <option value="text">Текст</option>
                                <option value="video">Видео</option>
                                <option value="map">Карту</option>
                                <option value="puzzle">Пазл</option>
                            </select>

                            <div class="add-image" style="display:block; margin-top: 30px;">
                                <h4>Виберіть зображення</h4>
                                <input type="file" name="image<?= $i ?>">
                            </div>
                            <div class="add-text" style="display:none">
                                <h4>Додайте текст</h4>
                                <textarea class="form-control" name="text<?= $i ?>" cols="30" rows="10"></textarea>
                            </div>
                            <div class="add-video" style="display:none">
                                <h4>Додайте код відео</h4>
                                <textarea class="form-control" name="video<?= $i ?>" cols="30" rows="5"></textarea>
                            </div>
                            <div class="add-map" style="display:none">
                                <h4>Додайте код карти</h4>
                                <textarea class="form-control" name="map<?= $i ?>" cols="30" rows="5"></textarea>
                            </div>
                            <div class="add-puzzle" style="display:none">
                                <h4>Виберіть зображення для пазлу</h4>
                                <input type="file" name="puzzle<?= $i ?>">
                            </div>

                            <div class="question-block">
                                <h4>Питання</h4>
                                <input class="form-control" name="question<?= $i ?>" type="text">

                                <h4>Варіанти відповідей</h4>
                                <p style="font-style: italic;">Вкажіть правильні варіанти відповідей за допомогою чекбоксів</p>
                                <input class="form-control" type="text" name="answer<?= $i ?>-1" placeholder="Ответ 1">
                                <input type="checkbox" name="right-answer<?= $i ?>-1"> <br><br>
                                <input class="form-control" type="text" name="answer<?= $i ?>-2" placeholder="Ответ 2">
                                <input type="checkbox" name="right-answer<?= $i ?>-2"> <br><br>
                                <input class="form-control" type="text" name="answer<?= $i ?>-3" placeholder="Ответ 3">
                                <input type="checkbox" name="right-answer<?= $i ?>-3"> <br><br>
                                <input class="form-control" type="text" name="answer<?= $i ?>-4" placeholder="Ответ 4">
                                <input type="checkbox" name="right-answer<?= $i ?>-4"> <br>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div style="margin-top: 40px;">
                        <input class="btn btn-primary btn-lg" id="quest-submit" type="submit" name="quest" value="Додати квест">
                    </div>
                    </form>
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


<script src="/js/auxiliary.js"></script>
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>


<script>
$(function () {
    $("div.tab-content").on("change", "select", function (e) {
        var b = ["image", "text", "video", "map", "puzzle"];

        for (var i = 0; i < b.length; i++) {
            var item = $(this).parent().children(".add-" + b[i]);
            var qblock = $(this).parent().children(".question-block");
            item.css({"display": $(this).val() === b[i] ? "block" : "none"});
            qblock.css({"display": $(this).val() !== "puzzle" ? "block" : "none"});
        }
    });

    $("div.tab-content select").trigger("change");
});
</script>

<!-- Для отображения табов -->
<script type="text/javascript">
    $(document).ready(function(){
        $(".nav-tabs").on('click', 'a', function(e){
            e.preventDefault();
            $(this).tab('show');
        });
    });

</script>

