<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=""/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <link rel="shortcut icon" href="favicon.png"/>

    <title>Главная</title>
    <link rel="stylesheet" href="/libs/bootstrap/bootstrap.min.css" media="screen" title="no title" charset="utf-8">

    <link rel="stylesheet" href="/css/main.css" media="screen" title="no title" charset="utf-8">

    <script src="/libs/jquery/jquery-3.1.0.min.js" charset="utf-8"></script>
    <script src="/libs/bootstrap/bootstrap.min.js" charset="utf-8"></script>

    <script src="/js/main.js" charset="utf-8"></script>

</head>
<body>
<header id="header">
    <div class="auth-header">
        <div class="auth-header-bg">

        </div>
        <div class="auth-header-title">
            <h1>Славетний шлях Петра Сагайдачного</h1>
        </div>
    </div>
</header>

<?php include 'application/views/' . $content_view; ?>

<footer id="footer">
    <div class="auth-footer">
        <div class="auth-btns-wrap text-center">
            <button class="auth-btn"><img src="/img/vk.png" alt="Sign in with Vk.com"></button>
            <button class="auth-btn"><img src="/img/ok.png" alt="Sign in with Ok.ru"></button>
            <button class="auth-btn"><img src="/img/mail.png" alt="Sign in with Mail.ru"></button>
            <button class="auth-btn"><img src="/img/facebook.png" alt="Sign in with Facebook.com"></button>
            <button class="auth-btn"><img src="/img/google.png" alt="Sign in with Google"></button>
        </div>
    </div>
</footer>
</body>
</html>
