<meta charset="utf-8"/>
<?php
session_start();
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'save' && isset($_POST['key'], $_POST['value'])) {
        $key = $_POST['key'];
        $value = $_POST['value'];
        $_SESSION[$key] = $value;
    } elseif ($_POST['action'] === 'reset') {
        $_SESSION = [];
    }
}
?>
<pre>
<?php
    print_r($_SESSION)
?>
</pre>

<form method="post">
    <div><label>Ключ</label>
        <input type="text" name="key"/></div>
    <div><label>Значение</label>
        <input type="text" name="value"/></div>
    <button type="submit" name="action" value="save">Сохранить</button>
    <button type="submit" name="action" value="reset">Стереть содержимое сессии</button>
</form>
