<?php
/**
 * Simple environment manager.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class EnvironmentManager
{
    const ENVIRONMENT_PRODUCTION = 'production';
    const ENVIRONMENT_DEVELOPMENT = 'development';
    const ENVIRONMENT_TESTING = 'testing';
    /**
     * Name of the environment variable that provides
     *
     * @since 0.1.0
     */
    const ENVIRONMENT_VARIABLE = 'ENVIRONMENT';
    /**
     * Name of the environment file.
     *
     * @since 0.1.0
     */
    const ENVIRONMENT_FILE_NAME = 'ENVIRONMENT';
    /**
     * List of environment mapping.
     *
     * @type string[]
     * @since 0.1.0
     */
    private static $environments = array(
        self::ENVIRONMENT_PRODUCTION => self::ENVIRONMENT_PRODUCTION,
        self::ENVIRONMENT_DEVELOPMENT => self::ENVIRONMENT_DEVELOPMENT,
        self::ENVIRONMENT_TESTING => self::ENVIRONMENT_TESTING,
        'prod' => self::ENVIRONMENT_PRODUCTION,
        'test' => self::ENVIRONMENT_TESTING,
        'dev' => self::ENVIRONMENT_DEVELOPMENT,
    );

    /**
     * Retrieves current environment.
     *
     * @return string
     * @since 0.1.0
     */
    public static function getEnvironment()
    {
        $environment = static::getCurrentEnvironment();
        if (!in_array($environment, static::$environments, true)) {
            $message = sprintf('Unknown environment `%s`', $environment);
            throw new RuntimeException($message);
        }
        return static::$environments[$environment];
    }

    /**
     * Retrieves environment as it was set by user.
     *
     * @return string
     * @since 0.1.0
     */
    private static function getCurrentEnvironment()
    {
        $path = Yii::getPathOfAlias('project') . '/' .
            self::ENVIRONMENT_FILE_NAME;
        $env = null;
        if (file_exists($path)) {
            $contents = trim(file_get_contents($path));
            $lines = explode("\n", $contents);
            $env = trim($lines[0]);
        }
        if (!$env) {
            $env = getenv(self::ENVIRONMENT_VARIABLE);
        }
        return $env;
    }

    /**
     * Sets application environment.
     *
     * @return void
     * @since 0.1.0
     */
    public static function setApplicationEnvironment()
    {
        /** @type CApplication $application */
        $application = Yii::app();
        $application->getParams()->add('environment', static::getEnvironment());
    }
}
