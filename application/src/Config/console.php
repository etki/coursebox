<?php

return array_replace_recursive(
    require __DIR__ . '/main.php',
    array(
        'commandMap' => array(
            'migrate' => array(
                'class' => 'system.cli.commands.MigrateCommand',
                'migrationPath' => 'application.Migrations',
            ),
        ),
    )
);
