<?php
/**
 * Simple UserIdentity wrapper.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class AuthenticationManager
{
    /**
     * Logging category for authentication operations.
     *
     * @since 0.1.0
     */
    const LOGGING_CATEGORY = 'application.auth';

    /**
     * Authenticates user.
     *
     * @param string $login    User login.
     * @param string $password User password.
     *
     * @return bool
     * @since 0.1.0
     */
    public static function authenticate($login, $password)
    {
        /** @type CWebApplication $app */
        $app = Yii::app();
        Logger::info(
            'Authenticating user `%s`',
            array($login),
            Logger::CATEGORY_AUTHENTICATION
        );
        $identity = new UserIdentity($login, $password);
        if ($identity->authenticate()) {
            Logger::trace(
                'Successfully authenticated user `%s`',
                array($login,),
                Logger::CATEGORY_AUTHENTICATION
            );
            $app->getUser()->login($identity);
            return true;
        }
        Logger::trace(
            'Couldn\'t authenticate user `%s`: %s',
            array($login, $identity->errorMessage,),
            Logger::CATEGORY_AUTHENTICATION
        );
        return false;
    }

    /**
     * Logs user out.
     *
     * @return void
     * @since 0.1.0
     */
    public static function logout()
    {
        /** @type CWebApplication $app */
        $app = Yii::app();
        $app->getUser()->logout();
    }
}
