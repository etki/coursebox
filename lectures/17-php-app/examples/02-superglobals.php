<!DOCTYPE html>
<html>
    <head>
        <title>mrzhvyach</title>
        <meta charset="UTF-8"/>
    </head>
    <body>
        <form method="post">
            <label>Поле с именем supername</label>
            <input type="text" name="supername"/>
            <input type="submit"/>
        </form>
        <pre>
        <?php
            foreach (array('_GET', '_POST', '_REQUEST') as $sourceName) {
                echo PHP_EOL;
                echo '$', $sourceName, ': ';
                print_r($$sourceName);
            }
        ?>
        </pre>
    </body>
</html>

