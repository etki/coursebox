<?php

try {
    $currentFile = new SplFileInfo(__FILE__);
    $currentFile->openFile();
} catch (RuntimeException $e) {
    // обработка исключения
} catch (Exception $e) {
    // обработка исключения
} finally {
    unset($currentFile);
    // код, который будет выполнен в любом случае
}

// выброс исключения

throw new Exception;
