<?php
/**
 * Simple logger facility.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class Logger
{
    /**
     * Generic category.
     *
     * @since 0.1.0
     */
    const CATEGORY_APPLICATION = 'coursebox';
    /**
     * Category for authentication-related logging.
     *
     * @since 0.1.0
     */
    const CATEGORY_AUTHENTICATION = 'coursebox.authentication';
    /**
     * Informational / notice logging level.
     *
     * @since 0.1.0
     */
    const LEVEL_INFO = CLogger::LEVEL_INFO;
    /**
     * Warning logging level.
     *
     * @since 0.1.0
     */
    const LEVEL_WARNING = CLogger::LEVEL_WARNING;
    /**
     * Trace logging level.
     *
     * @since 0.1.0
     */
    const LEVEL_TRACE = CLogger::LEVEL_TRACE;
    /**
     * Error logging level.
     *
     * @since 0.1.0
     */
    const LEVEL_ERROR = CLogger::LEVEL_ERROR;

    /**
     * Logs incoming message.
     *
     * @param string $message  Complete message or sprintf-ready format string.
     * @param array  $args     List of additional arguments to populate format
     *                         string.
     * @param string $category Message category.
     * @param string $level    Log level.
     *
     * @return void
     * @since 0.1.0
     */
    public static function log(
        $message,
        array $args = null,
        $category = self::CATEGORY_APPLICATION,
        $level = self::LEVEL_INFO
    ) {
        if ($args) {
            $message = vsprintf($message, $args);
        }
        // support for passing category as null
        if (!$category) {
            $category = self::CATEGORY_APPLICATION;
        }
        Yii::log($message, $level, $category);
    }

    /**
     * Creates trace log record.
     *
     * @param string $message  Complete message or sprintf-ready format string.
     * @param array  $args     List of additional arguments to populate format
     *                         string.
     * @param string $category Message category.
     *
     * @return void
     * @since 0.1.0
     */
    public static function trace(
        $message,
        array $args = null,
        $category = self::CATEGORY_APPLICATION
    ) {
        static::log($message, $args, $category, static::LEVEL_TRACE);
    }

    /**
     * Creates info log record.
     *
     * @param string $message  Complete message or sprintf-ready format string.
     * @param array  $args     List of additional arguments to populate format
     *                         string.
     * @param string $category Message category.
     *
     * @return void
     * @since 0.1.0
     */
    public static function info(
        $message,
        array $args = null,
        $category = self::CATEGORY_APPLICATION
    ) {
        static::log($message, $args, $category, static::LEVEL_INFO);
    }

    /**
     * Creates warning log record.
     *
     * @param string $message  Complete message or sprintf-ready format string.
     * @param array  $args     List of additional arguments to populate format
     *                         string.
     * @param string $category Message category.
     *
     * @return void
     * @since 0.1.0
     */
    public static function warning(
        $message,
        array $args = null,
        $category = self::CATEGORY_APPLICATION
    ) {
        static::log($message, $args, $category, static::LEVEL_WARNING);
    }

    /**
     * Creates error log record.
     *
     * @param string $message  Complete message or sprintf-ready format string.
     * @param array  $args     List of additional arguments to populate format
     *                         string.
     * @param string $category Message category.
     *
     * @return void
     * @since 0.1.0
     */
    public static function error(
        $message,
        array $args = null,
        $category = self::CATEGORY_APPLICATION
    ) {
        static::log($message, $args, $category, static::LEVEL_ERROR);
    }
}
