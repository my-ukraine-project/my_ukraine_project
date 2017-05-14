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
                if (select === "image" || select === "puzzle") {
                    item = $("input[type=file][name="+ select + index +"]");
                    if (item.val() === "") {
                        item.css("border", "1px solid #d61907");
                        isok = false;
                        return;
                    } else { item.css("border", ""); }

                } else if (select === "text" || select === "map" || select === "video") {
                    item = $("textarea[name="+ select + index +"]");
                    if (item.val() === "") {
                        item.css("border", "1px solid #d61907");
                        isok = false;
                        return;
                    } else { item.css("border", ""); }
                }

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
                    <input name="quest-id" type="text" value="<?= $data->quest->id ?>" hidden>
                    <h4>Назва квесту</h4>
                    <input class="form-control" name="quest-name" id="quest-name" type="text" value="<?= $data->quest->name ?>">

                    <h4>Мета квесту</h4>
                    <textarea class="form-control" name="quest-target" id="quest-target" cols="30" rows="10"><?= $data->quest->target ?></textarea>

                    <br><br>

                    <ul id="myTab" class="nav nav-tabs">
                      <li id="tab1" class="tab active"><a href="#panel1">Завдання 1</a></li>
                      <li id="tab2" class="tab"><a href="#panel2">Завдання 2</a></li>
                      <li id="tab3" class="tab"><a href="#panel3">Завдання 3</a></li>
                      <li id="tab4" class="tab"><a href="#panel4">Завдання 4</a></li>
                      <li id="tab5" class="tab"><a href="#panel5">Завдання 5</a></li>
                    </ul>

                    <div class="tab-content">
                        <?php
                        $cnt = 0;
                        foreach ( $data->quest->questions as $question) { $cnt++; ?>

                        <div id="panel<?= $cnt ?>" data-panel="<?= $cnt ?>" class="tab-pane fade <?= $cnt == 1 ? "in active" : "" ?>">

                            <h4>Який елемент додаємо?</h4>

                            <select class="form-control" name="content<?= $cnt ?>" class="select-content">
                                <option value="image" <?= $question->type == "image" ? "selected":"" ?>>Картинку</option>
                                <option value="text" <?= $question->type == "text" ? "selected":"" ?>>Текст</option>
                                <option value="video" <?= $question->type == "video" ? "selected":"" ?>>Видео</option>
                                <option value="map" <?= $question->type == "map" ? "selected":"" ?>>Карту</option>
                                <option value="puzzle" <?= $question->type == "puzzle" ? "selected":"" ?>>Пазл</option>
                            </select>

                            <div class="add-image" style="display:block; margin-top: 30px;">
                                <h4>Виберіть зображення</h4>
                                <input type="file" name="image<?= $cnt ?>">
                            </div>
                            <div class="add-text" style="display:none">
                                <h4>Додайте текст</h4>
                                <textarea class="form-control" name="text<?= $cnt ?>" cols="30" rows="10"><?= $question->content ?></textarea>
                            </div>
                            <div class="add-video" style="display:none">
                                <h4>Додайте код відео</h4>
                                <textarea class="form-control" name="video<?= $cnt ?>" cols="30" rows="5"><?= $question->content ?></textarea>
                            </div>
                            <div class="add-map" style="display:none">
                                <h4>Додайте код карти</h4>
                                <textarea class="form-control" name="map<?= $cnt ?>" cols="30" rows="5"><?= $question->content ?></textarea>
                            </div>
                            <div class="add-puzzle" style="display:none">
                                <h4>Виберіть зображення для пазлу</h4>
                                <input type="file" name="puzzle<?= $cnt ?>">
                            </div>

                            <h4>Питання</h4>
                            <input class="form-control" name="question<?= $cnt ?>" type="text" value="<?= $question->question ?>">

                            <h4>Варіанти відповідей</h4>
                            <p style="font-style: italic;">Вкажіть правильні варіанти відповідей за допомогою чекбоксів</p>
                            <input class="form-control" type="text" name="answer<?= $cnt ?>-1" placeholder="Ответ 1" value="<?= $question->a1->text ?>">
                            <input type="checkbox" name="right-answer<?= $cnt ?>-1" <?= $question->a1->right ? "checked" : "" ?>><br><br>
                            <input class="form-control" type="text" name="answer<?= $cnt ?>-2" placeholder="Ответ 2" value="<?= $question->a2->text ?>">
                            <input type="checkbox" name="right-answer<?= $cnt ?>-2" <?= $question->a2->right ? "checked" : "" ?>> <br><br>
                            <input class="form-control" type="text" name="answer<?= $cnt ?>-3" placeholder="Ответ 3" value="<?= $question->a3->text ?>">
                            <input type="checkbox" name="right-answer<?= $cnt ?>-3" <?= $question->a3->right ? "checked" : "" ?>> <br><br>
                            <input class="form-control" type="text" name="answer<?= $cnt ?>-4" placeholder="Ответ 4" value="<?= $question->a4->text ?>">
                            <input type="checkbox" name="right-answer<?= $cnt ?>-4" <?= $question->a4->right ? "checked" : "" ?>> <br>
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


<!-- НАЧАЛО обработчика формы -->

<script>
// $('#quest-submit').onclick(function(){
//    alert("KUKU");
// });
</script>

<!-- КОНЕЦ обработчика формы -->

<script src="/js/auxiliary.js"></script>
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>

<!--<script type="text/template" id="template-panel">-->
<!--</script>-->
<!---->
<!--<script type="text/template" id="template-tab">-->
<!--    <li id="tab{id}"><a href="#panel{id}">Завдання {id}</a></li>-->
<!--</script>-->


<script>
$(function () {
    $("div.tab-content").on("change", "select", function (e) {
        var b = ["image", "text", "video", "map", "puzzle"];

        for (var i = 0; i < b.length; i++) {
            var item = $(this).parent().children(".add-" + b[i]);
            item.css({"display": $(this).val() === b[i] ? "block" : "none"});
        }
    });

    $("div.tab-content select").trigger("change");
});
</script>

<script>
    var counter = 0;
    $( "#addTab" ).click(function() {
        counter++;

        $("#addTab").before(aux.template("template-tab", {
            "id": counter
        }));

        $("#tab" + counter).on("click", 'a', function(e){
            e.preventDefault();

            $('#addTab').removeClass("active");
            for (var i = 1; i <= counter; i++) {
                if ($('#tab'+ i).hasClass('active')) {
                    $('#tab'+ i).removeClass("active");
                }
            }
            $(this).toggleClass('active');
        });

        for (var i = 1; i <= counter; i++) {
            $('#panel' + i).removeClass("in active");

            if ($('#tab'+ i).hasClass('active')) {
                $('#tab'+ i).removeClass("active");
            }
        }

        $("#tab"+ counter).addClass("active");

        $('div.tab-content').append(aux.template("template-panel", {
            "id": counter
        }));

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


<!-- ========== Обработка формы =========== -->
<script type="text/javascript">

//function QuestAdd() {}
//
//QuestAdd.prototype.run = function () {
//    var self = this;
//
//    $("div.tab-content")
//        .on("click", 'input[name=add]', self.add)
//        .on("click", '.quest-answers input[type=button]', self.remove);
//
//    $("#add-quest").on("click", self.sendForm);
//};
//
//QuestAdd.prototype.add = function () {
//    var parent = $(this).parent();
//
//    var answer = parent.children("input[name=answer]");
//    var answers = parent.children("div.quest-answers");
//
//    $('<div/>', {
//        "class":"answer",
//        "html": [
//            $("<span/>", { "text": answer.val() }),
//            $("<input/>", { "type": "checkbox" }),
//            $("<input/>", { "type": "button", "class": "btn btn-default", "value":"Видалити" })
//        ]
//    }).appendTo(answers);
//
//};
//
//QuestAdd.prototype.remove = function (e) {
//    $(this).parent("div.answer").remove();
//};
//
//QuestAdd.prototype.sendForm = function () {
//    var content = $("#content");
//
//    var quest = {
//        "type": parseInt($("select").val()),
//        "target": $("textarea[name=quest-target]").val(),
//        "name": $("input[name=quest-name]").val(),
//        "questions": []
//
//    };
//
//    var handle_answers = function (item) {
//        var array = [];
//        item.find('div.quest-answers div.answer').each(function (index, elem) {
//            var span = $(elem).children("span");
//            var checkbox = $(elem).children("input[type=checkbox]");
//            array.push({ "text": span.text(), "name": ("a" + index),  "checked": checkbox.is(':checked')});
//        });
//        return array;
//    };
//
//    var handle_attached = function (item) {
//        var obj = { "type": item.children("select").val() };
//
//        if (["puzzle", "img"].indexOf(obj.type) >= 0) {
//            obj.value = item.find("div.add-"+ obj.type +" input").val();
//        } else if (["text", "video", "map"].indexOf(obj.type) >= 0) {
//            obj.value = item.find("div.add-"+ obj.type +" textarea").val();
//        }
//
//        return obj;
//    };
//
//    $('div.tab-content div.tab-pane').each(function (i, item) {
//        var obj = {
//            "question": $(item).children("input[name=question]").val(),
//            "answers": handle_answers($(item)),
//            "attached": handle_attached($(item))
//        };
//
//        quest.questions.push(obj);
//    });
//
//    console.log(quest);

//
//    $("div.answer").each(function (index, elem) {
//        var span = $(elem).children("span");
//        var checkbox = $(elem).children("input[type=checkbox]");
//        obj.answers.push({
//            "text": span.text(),
//            "name": ("a" + index),
//            "checked": checkbox.is(':checked')
//        });
//    });
//
//    var jqxhr = $.post("/Quests/add", {"quest": JSON.stringify(obj) });
//    jqxhr.done(function (data) {
//        data = JSON.parse(data);
//        console.log(data);
//    });

//};
//
//$(function () {
//    var app = new QuestAdd();
//    app.run();
//});
</script>
<!-- =========== КОНЕЦ обработки формы ========== -->
