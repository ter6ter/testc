<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <link type="text/css" href="css/style.css" rel="Stylesheet" />
</head>
<body>
    <div class="login-block">
        <?php if (!$user):?>
        <div>
            Вы не авторизованны. <a href="#" id="show-login-form">Войти</a>
        </div>
        <div id="login-form">
            <form action="index.php?method=login" method="post">
                <table>
                    <tr>
                        <td>Логин</td>
                        <td><input name="login" type="text" placeholder="login"></td>
                    </tr>
                    <tr>
                        <td>Пароль</td>
                        <td><input name="password" type="password" placeholder="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <input type="submit" value="Войти">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php else:?>
        <div>
            Вы вошли как <b><?=$user->login?></b>. <a href="index.php?method=logout">Выйти</a></b>
        </div>
        <?php endif;?>
    </div>
    <div id="slider-block">
        <input type="button" id="slider-prev" value="<=">
        <?php foreach ($comments_slider as $comment):?>
            <div class="slider-comment">
                <span class="slider-comment-author"><?=$comment->user->login?></span>
                написал <span class="slider-comment-date"><?=$comment->date?></span>:<br>
                <?=$comment->text?>
            </div>
        <?php endforeach;?>
        <input type="button" id="slider-next" value="=>">

        <!-- <?php if (isset($comments_slider[0])):?>
        <div class="slider-comment">
            <span class="slider-comment-author"><?=$comments_slider[0]->user->login?></span>
            написал <span class="slider-comment-date"><?=$comments_slider[0]->date?></span>:<br>
            <?=$comments_slider[0]->text?>
        </div>
        <?endif;?>
        <?php if (isset($comments_slider[1])):?>
            <div class="slider-comment">
                <span class="slider-comment-author"><?=$comments_slider[1]->user->login?></span>
                написал <span class="slider-comment-date"><?=$comments_slider[1]->date?></span>:<br>
                <?=$comments_slider[1]->text?>
            </div>
        <?endif;?> -->
    </div>
    <div id="error-message" <?=(isset($error_message) ? 'style="display:block";' : '')?>>
        <?=(isset($error_message) ? $error_message : '')?>
    </div>
    <div class="main-text">
        <p>Генеральный директор Государственного Эрмитажа Михаил Пиотровский подтвердил, что поддержал идею снять клип в интерьерах музея и предоставил Линдеманну возможность провести съемки. Он отметил, что съемки организовали как одно из событий года "Россия - Германия", который начался выставкой "Железный век. Европа без границ". По словам Пиотровского, она "совместила размах научного сотрудничества с интеллигентной манерой обращения с "перемещенным искусством".</p>
        <p>Руководитель Эрмитажа отметил, что в клипе "Любимый город" Линдеманн поет русскую военную песню в интерьерах здания немецкого архитектора Лео фон Кленце, которое от налетов немецкой авиации защитили ленинградцы. "Творения Кленце в Мюнхене были уничтожены американо-британскими бомбардировками. В этом контексте небезразлично, что Рамштайн (с одним "м" в отличие от названия группы) - главная военно-воздушная база США в Германии", - говорится в комментарии Пиотровского, размещенном на сайте Эрмитажа.</p>
        <p>Пиотровский отметил, что "диалог культур может принимать самые парадоксальные формы, оставаясь при этом диалогом и мостом над разорванным миром".</p>
    </div>
    <div id="comments">
        <div style="margin: 5px">
            Автор: <input type="text" id="filter-text"> <input type="button" value="фильтровать">
            <div id="filter-variants">
                <div>test1</div>
                <div>test2</div>
                <div>test3</div>
            </div>
        </div>
        <?php foreach ($comments as $comment):?>
        <?php include("templ/comment.php");?>
        <?php endforeach;?>
        <?php if ($comments_count > count($comments)):?>
        <div style="text-align: center">
            <a href="#c" id="show-more" data-loaded="<?=count($comments)?>">Показать ещё</a>
        </div>
        <?php endif;?>
        <?php if ($user):?>
        <div id="add-comment">
            <h3>Добавить комментарий</h3>
            <textarea></textarea><br>
            <input type="button" value="Добавить">
        </div>
        <?php endif;?>
    </div>
</body>
</html>