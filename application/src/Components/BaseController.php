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
}
