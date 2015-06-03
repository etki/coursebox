<form action="/index.php" method="post">
    <label for="pdo-type">PDO type</label>
    <select name="pdo-type" id="pdo-type">
        <option value="postgresql" <?= $_REQUEST['pdo-type'] === 'postgresql' ? 'selected="selected"' : '' ?>>PostgreSQL</option>
        <option value="mysql" <?= $_REQUEST['pdo-type'] === 'mysql' ? 'selected="selected"' : '' ?>>MySQL</option>
        <option value="sqlite" <?= $_REQUEST['pdo-type'] === 'sqlite' ? 'selected="selected"' : '' ?>>SQLite</option>
    </select>
    <div>
        <div><label for="query">Query</label></div>
        <textarea name="query" id="query" cols="30" rows="10"><?php
            if (!empty($_REQUEST['query'])) {
                echo $_REQUEST['query'];
            }
        ?></textarea>
    </div>
    <input type="submit"/>
</form>
<?php

$connectionInfo = [
    'mysql' => [
        'dsn' => 'mysql:host=mysql;port=3306;dbname=root',
        'username' => 'root',
        'password' => 'password',
    ],
    'postgresql' => [
        'dsn' => 'pgsql:host=postgresql;port=5432;dbname=root',
        'username' => 'root',
        'password' => 'password',
    ],
    'sqlite' => [
        'dsn' => 'sqlite:/tmp/db.sqlite',
        'username' => null,
        'password' => null,
    ],
];

$pdoType = isset($_REQUEST['pdo-type']) ? $_REQUEST['pdo-type'] : 'mysql';

if (!in_array($pdoType, ['mysql', 'sqlite', 'postgresql'], true)) {
    die('unknown pdo type: ' . $pdoType);
}

$connectionDetails = $connectionInfo[$pdoType]; ?>
<div>Connecting to database using following options:</div>
<div><strong>DSN:</strong> <?php echo $connectionDetails['dsn']; ?></div>
<div><strong>username:</strong> <?php echo $connectionDetails['username']; ?></div>
<div><strong>password:</strong> <?php echo $connectionDetails['password']; ?></div>

<?php $pdo = new PDO(
    $connectionDetails['dsn'],
    $connectionDetails['username'],
    $connectionDetails['password']
); ?>
<div>Connection successful. Creating default structure.</div>
<div><strong>users</strong>: id int, login varchar(64), password varchar(64)</div>
<?php

if ($pdoType === 'postgresql') {
    $query =
        'CREATE TABLE IF NOT EXISTS users (
            id SERIAL,
            login VARCHAR(64),
            password VARCHAR(64)
        )';
} else {
    $query =
        'CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            login VARCHAR(64),
            password VARCHAR(64)
        )';
}
$pdo->exec($query);

?>
<pre>
<?php
try {
    if (!empty($_REQUEST['query'])) {
        $statement = $pdo->prepare($_REQUEST['query']);
        $statement->execute();
        print_r($statement->fetchAll(PDO::FETCH_ASSOC));
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
</pre>