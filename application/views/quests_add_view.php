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

            <div class="row">
                <div class="col-sm-10"><h1>Додавання квесту</h1></div>
                <div class="col-sm-2"><a class="btn btn-danger" href="/Quests" style="margin-top: 40px;">Повернутися на квести</a></div>
            </div>

            <div class="row">
                <div class="col-sm-6">

                    <h4>Назва квесту</h4>
                    <input class="form-control" type="text">

                    <h4>Мета квесту</h4>
                    <textarea class="form-control" name="target" id="" cols="30" rows="10"></textarea>

                    <br><br>

                    <ul id="myTab" class="nav nav-tabs">
                      <li id="tab1" class="tab active"><a href="#panel1">Завдання 1</a></li>
                      <li id="addTab" class="tab"><a href="#">+</a></li>
                    </ul>

                    <div class="tab-content">
                      <div id="panel1" class="tab-pane fade in active">

                        <h4>Який елемент додаємо?</h4>

                        <select class="form-control" name="content" id="typeOfTask">
                            <option value="1">Картинку</option>
                            <option value="2">Текст</option>
                            <option value="3">Видео</option>
                            <option value="4">Карту</option>
                            <option value="5">Пазл</option>
                        </select>

                        <div id="img" style="display:block; margin-top: 30px;">
                            <h4>Виберіть зображення</h4>
                            <input type="file">
                        </div>
                        <div id="text"  style="display:none">
                            <h4>Додайте текст</h4>
                            <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div id="video"  style="display:none">
                            <h4>Додайте код відео</h4>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div id="map"  style="display:none">
                            <h4>Додайте код карти</h4>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div id="puzzle"  style="display:none">
                            <h4>Виберіть зображення</h4>
                            <input type="file">
                        </div>

                        <h4>Питання</h4>
                        <input class="form-control" type="text">
                        
                        <h4>Варіанти відповідей</h4>
                        <input class="form-control" type="text" name="answer" placeholder="1 варіант"><br>
                        <input class="form-control" type="text" name="answer" placeholder="2 варіант"><br>
                        <input class="form-control" type="text" name="answer" placeholder="3 варіант"><br>
                        <input class="form-control" type="text" name="answer" placeholder="4 варіант"><br>

                    </div>
                </div>

                    <div style="margin-top: 40px;">
                        <input class="btn btn-primary btn-lg" type="button" name="send-form" value="Додати квест">
                    </div>
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

<script>
document.getElementById("typeOfTask")
    .onchange = function () {
        var b = {
            1: "img",
            2: "text",
            3: "video",
            4: "map",
            5: "puzzle"
        }, c = this.value,
            a;
        for (a in b) document.getElementById(b[a])
            .style.display = 0 == c || c == a ? "block" : "none"
};
</script>

<script>

    var counter = 1;
    $( "#addTab" ).click(function() {
        counter++;
        $("#addTab").before('<li id="tab'+counter+'"><a href="#panel'+counter+'">Завдання '+counter+'</a></li>');
        $("#tab"+counter).addClass("active");
        $('#addTab').removeClass("active");

        $("#tab"+counter).on("click", function(event){
            $('#addTab').removeClass("active");
            for (var i = 1; i <= counter; i++) {
                if ($('#tab'+i).hasClass('active')) {
                    $('#tab'+i).removeClass("active");
                }
            };
            $(this).toggleClass('active');
        });

        for (var i = 1; i <= counter; i++) {
            $('#panel'+i).removeClass("in active");
        }

        $('#panel'+(counter-1)).after('<div id="panel'+counter+'" class="tab-pane fade in active">fff</div>');

    });

</script>



<!-- ========== Обработка формы =========== -->
<script type="text/javascript">

function QuestAdd() {}

QuestAdd.prototype.run = function () {
    var self = this;

    $("input[name=add]").on("click", self.add);
    $("input[name=send-form]").on("click", self.sendForm);
    $("#quest-answers").on("click", "input[type=button]", self.remove);
};

QuestAdd.prototype.add = function () {
    var answer = $("input[name=answer]");

    var answers = $("div#quest-answers");

    $('<div/>', {
        "class":"answer",
        "html": [
            $("<span/>", { "text": answer.val() }),
            $("<input/>", { "type": "checkbox" }),
            $("<input/>", { "type": "button" })
        ]
    }).appendTo("#quest-answers");

};

QuestAdd.prototype.remove = function (e) {
    $(this).parent("div.answer").remove();
};

QuestAdd.prototype.sendForm = function () {

    var obj = {
        "type": parseInt($("select").val()),
        "target": $("textarea[name=target]").val(),
        "content":"xxx",
        "answers": []

    };

    $("div.answer").each(function (index, elem) {
        var span = $(elem).children("span");
        var checkbox = $(elem).children("input[type=checkbox]");
        obj.answers.push({
            "text": span.text(),
            "name": ("a" + index),
            "checked": checkbox.is(':checked')
        });
    });

    var jqxhr = $.post("/Quests/add", {"quest": JSON.stringify(obj) });
    jqxhr.done(function (data) {
        data = JSON.parse(data);
        console.log(data);
    });

};

$(function () {
    var app = new QuestAdd();
    app.run();
});
</script>
<!-- =========== КОНЕЦ обработки формы ========== -->

<!-- Для отображения табов -->
<script type="text/javascript">
$(document).ready(function(){ 
  $("#myTab a").click(function(e){
    e.preventDefault();
    $(this).tab('show');
  });
});
</script>
