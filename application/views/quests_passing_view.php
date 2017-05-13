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
    <h2><?= $quest->name ?></h2>
    <p><?= $quest->target ?></p>

    <input type="text" name="qid" value="<?= $quest->id ?>" hidden>
<!--    <div class="tab-content">-->
    <?php foreach ($quest->questions as $question) {
        ?><div class="tab-pane"><?php
            $atype = count_right($question) > 1 ? "checkbox" : "radio";

            if ($question->type === "image") { ?>
                <img src="/<?= $question->content ?>" style="width: 300px;">
            <?php } else if ($question->type === "puzzle") { ?>
                <img src="/<?= $question->content ?>" style="width: 300px;">
            <?php } else if ($question->type === "text") { ?>
                <p><?= $question->content ?></p>
            <?php } else if ($question->type === "video") { ?>
                <!-- $question->content -- содержит то что было вставлено в textarea -->
                <h4>Here must be video</h4>
            <?php } else if ($question->type === "map") { ?>
                <h4>Here must be map</h4>
            <?php }?>

            <p><?= $question->question ?></p>
            <p><input type="<?= $atype ?>" name="a1"><label for="a1"><?= $question->a1->text ?></label></p>
            <p><input type="<?= $atype ?>" name="a2"><label for="a2"><?= $question->a2->text ?></label></p>
            <p><input type="<?= $atype ?>" name="a3"><label for="a3"><?= $question->a3->text ?></label></p>
            <p><input type="<?= $atype ?>" name="a4"><label for="a4"><?= $question->a4->text ?></label></p>

        </div>
    <?php } ?>
<!--    </div>-->
    <input type="submit" value="Сдать квест" class="btn-default">
</form>


