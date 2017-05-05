<h1>Управление пользователями</h1>

<?php  foreach ($data["users"] as $user) { ?>
    <form action="/Admin/user_update" method="post">
        <span><?= $user["fio"] ?></span>
        <input type="checkbox" name="permission" <?php echo !!$user["permission"] ? "checked" : "" ?>>
        <input type="hidden" name="id" value="<?= $user["id"] ?>">
        <input type="submit" value="Update">
    </form>
<?php } ?>
