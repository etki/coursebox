<?php /** @type SiteController $this */ ?>
<h1>Документация</h1>
Все методы возвращают JSON, в котором всегда есть свойство <code>success</code>
и <code>data</code>:
<pre>
{
    success: true,
    data: [
        {
            id: 1,
            title: 'Post title',
            content: 'Post content'
        }
    ]
}
</pre>
В <code>data</code> находится непосредственно запрашиваемая информация.
<h3>Пользователи</h3>
<ul>
    <li>
        <code>GET /api/v1/user</code> - получить список пользователей.
    </li>
    <li>
        <code>POST /api/v1/user</code> - создать пользователя. Параметры -
        <code>login</code>, <code>password</code>.
    </li>
    <li>
        <code>GET /api/v1/user/:id</code> - получить конкретного пользователя.
    </li>
    <li>
        <code>PUT /api/v1/user/:id</code> - обновить конкретного пользователя.
        Параметры - <code>login</code> (новый логин), <code>password</code>
        (старый пароль), <code>new-password</code> (новый пароль).
    </li>
    <li>
        <code>DELETE /api/v1/user/:id</code> - удалить конкретного пользователя
        и все его посты. Требуется авторизация под этим пользователем.
    </li>
</ul>
<h3>Авторизация</h3>
<ul>
    <li>
        <code>GET /api/v1/auth</code> - получить информацию о текущей
        авторизации. Вернет 403 при отсутствии авторизации и 200 при ее наличии.
    </li>
    <li>
        <code>POST /api/v1/auth</code> - залогиниться. Параметры -
        <code>login</code>, <code>password</code>.
    </li>
    <li>
        <code>DELETE /api/v1/auth</code> - разлогиниться.
    </li>
</ul>
<h3>Посты</h3>
<ul>
    <li>
        <code>GET /api/v1/post</code> - получить все посты.
    </li>
    <li>
        <code>POST /api/v1/post</code> - запостить пост. Параметры -
        <code>title</code>, <code>content</code>.
    </li>
    <li>
        <code>GET /api/v1/post/:id</code> - получить конкретный пост.
    </li>
    <li>
        <code>PUT /api/v1/post/:id</code> - отредактировать конкретный пост.
        Параметры - <code>title</code>, <code>content</code>. Требуется
        авторизация под автором поста.
    </li>
    <li>
        <code>DELETE /api/v1/post/:id</code> - удалить конкретный пост.
        Требуется авторизация под автором поста.
    </li>
</ul>
<h1>Идеальная реализация</h1>

Идеальное приложение должно выводить все посты, которые есть, и иметь кнопки
"Войти" и "Зарегистрироваться" с очевидным функционалом. После входа у
пользователя появляются меняется меню - теперь оно состоит из кнопок
"Мои посты", "Написать пост" и "Выход". В "Моих постах" выводится список постов,
отфильтрованный по `user_id`, соответствующему текущему пользователю. Каждый из
своих постов можно отредактировать либо удалить.

<h1>Примеры запроса</h1>
<pre>
$.ajax({
    url: '<?php echo $this->createAbsoluteUrl('user/create'); ?>',
    method: 'post',
    data: { login: 'login', password: 'password' },,
    xhrFields: { withCredentials: true }
    success: function (response) {
        console.log('Регистрация прошла успешно: ' + response.data.login);
    },
    error: function () {
        console.log('Зарегистрироваться не удалось');
    }
});
</pre>
<pre>
$.ajax({
    url: '<?php echo $this->createAbsoluteUrl('user/create'); ?>',
    method: 'post',
    data: { login: 'login', password: 'password' },
    xhrFields: { withCredentials: true }
}).done(function (response) {
    console.log('Регистрация прошла успешно: ' + response.data.login);
}).fail(function () {
    console.log('Зарегистрироваться не удалось');
});
</pre>
<h3>Документация</h3>
<ul>
    <li><a href="http://api.jquery.com/jQuery.ajax">jQuery.ajax // En</a></li>
    <li>
        <a href="http://jquery.page2page.ru/index.php5/Ajax-%D0%B7%D0%B0%D0%BF%D1%80%D0%BE%D1%81">
            jQuery.ajax // Ru
        </a>
    </li>
</ul>
