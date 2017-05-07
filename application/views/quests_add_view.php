<div>
    <h3>Выбирети добавляемый элемент</h3>
    <select name="content">
        <option value="1">Картинку</option>
        <option value="2">Текст</option>
        <option value="3">Видео</option>
        <option value="4">Карту</option>
    </select>

    <h3>Цель квеста</h3>
    <textarea name="target" id="" cols="30" rows="10"></textarea>

    <h3>Варианты ответов</h3>
    <input type="text" name="answer"/>
    <input type="button" name="add"/>
    <div id="quest-answers"></div>
</div>
<div>
    <input type="button" name="send-form" value="Добавить квест...">
</div>

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