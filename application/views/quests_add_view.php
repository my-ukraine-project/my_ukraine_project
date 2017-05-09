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
                <div class="col-sm-6">
                    <h3>Який елемент додаємо?</h3>
                    <select class="form-control" name="content">
                        <option value="1">Картинку</option>
                        <option value="2">Текст</option>
                        <option value="3">Видео</option>
                        <option value="4">Карту</option>
                    </select>

                    <h3>Мета квесту</h3>
                    <textarea class="form-control" name="target" id="" cols="30" rows="10"></textarea>

                    <h3>Варіанти відповідей</h3>
                    <input class="form-control" type="text" name="answer"/>
                    <input  class="form-control"type="button" name="add" value="Додати ще один варіант">
                    
                    <div id="quest-answers"></div>

                    <div style="margin-top: 40px;">
                        <input class="btn btn-primary btn-lg" type="button" name="send-form" value="Добавить квест">
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