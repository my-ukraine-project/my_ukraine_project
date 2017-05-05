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
        <h1>Славетний шлях Петра Сагайдачного</h1>
    </header>

    <?php include 'application/views/' . $content_view; ?>

    <footer id="footer">
    <div class="auth-footer">
            <div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name;providers=google,vkontakte,odnoklassniki,mailru,facebook,instagram;redirect_uri=http%3A%2F%2F;mobilebuttons=0;"></div>      </div>
    </footer>

    <script src="//ulogin.ru/js/ulogin.js"></script>
</body>
</html>
