<?php
$list = [1, 2, 3, 'test'];
?>
Before:
<?php
var_dump($list);
$imploded = implode('|', $list);
?>
<hr/>
Imploded:
<?php
var_dump($imploded);
$exploded = explode('|', $imploded);
?>
<hr/>
Exploded:
<?php
var_dump($exploded);
