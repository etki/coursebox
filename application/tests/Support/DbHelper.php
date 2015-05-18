<?php

namespace Etki\Coursebox\Tests\Support;

use CDbConnection;
use Codeception\Util\Debug;
use Yii;

/**
 * Simple database helper.
 *
 * @SuppressWarnings(PHPMD.ShortVariableName)
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox\Tests\Support
 * @author  Etki <etki@etki.name>
 */
class DbHelper
{
    /**
     * Cleasn database tables.
     *
     * @return void
     * @since 0.1.0
     */
    public static function cleanUp()
    {
        /** @type CDbConnection $db */
        $db = Yii::app()->db;
        $db->createCommand()->delete('posts');
        $db->createCommand()->delete('users');

        Debug::debug('Cleaned out application tables');
    }
}
