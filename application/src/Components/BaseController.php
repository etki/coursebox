<?php
/**
 * Base controller implementation, a simple interlayer to share functionality
 * across controllers.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class BaseController extends CController
{
    /**
     * CHttpRequest instance.
     *
     * @type CHttpRequest
     * @since 0.1.0
     */
    private $request;
    /**
     * User instance.
     *
     * @type IWebUser|CWebUser
     * @since 0.1.0
     */
    private $user;
    /**
     * Environment name.
     *
     * @type string
     * @since 0.1.0
     */
    private $environment;

    /**
     * Initializer.
     *
     * @codeCoverageIgnore
     *
     * @return void
     * @since 0.1.0
     */
    public function init()
    {
        /** @type CWebApplication $application */
        $application = Yii::app();
        $this->request = $application->getRequest();
        $this->user = $application->getUser();
        $this->environment = $application->getParams()->itemAt('environment');
    }

    /**
     * Returns request instance.
     *
     * @codeCoverageIgnore
     *
     * @return CHttpRequest
     * @since 0.1.0
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * Returns user instance.
     *
     * @codeCoverageIgnore
     *
     * @return CWebUser|IWebUser
     * @since 0.1.0
     */
    protected function getUser()
    {
        return $this->user;
    }

    /**
     * Retrieves current environment.
     *
     * @return string
     * @since 0.1.0
     */
    protected function getEnvironment()
    {
        return $this->environment;
    }
}
