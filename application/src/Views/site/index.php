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
<ul>
    <li>
        <code>POST /api/v1/user</code> - создать пользователя. Параметры - login, password.
    </li>
    <li>
        <code>GET /api/v1/user</code> - получить список пользователей.
    </li>
    <li>
        <code>GET /api/v1/user/:id</code> - получить конкретного пользователя.
    </li>
    <li>
        <code>GET /api/v1/auth</code> - получить информацию о текущем пользователе.
    </li>
    <li>
        <code>POST /api/v1/auth</code> - залогиниться. Параметры - login, password.
    </li>
    <li>
        <code>POST /api/v1/post</code> - запостить пост. Параметры - title, content.
    </li>
    <li>
        <code>GET /api/v1/post</code> - получить все посты.
    </li>
    <li>
        <code>GET /api/v1/post/:id</code> - получить конкретный пост.
    </li>
</ul>
<h1>Задание</h1>
<ol>
    <li>Написать страницу с формой регистрации пользователя</li>
    <li>Написать страницу с формой логина пользователя</li>
    <li>Написать страницу, выводящую все посты</li>
    <li>Написать страницу, на которой можно создать новый пост (после логина)</li>
</ol>
<h1>Пример запроса</h1>
<pre>
$.ajax({
    url: 'http://c.etki.name/api/v1/user',
    method: 'post',
    data: { login: 'login', password: 'password' },
    success: function (data) {
        // blah!
    },
    error: function () {
        // double blah!
    }
});
</pre>