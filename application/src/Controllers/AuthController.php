<?php
/**
 * This controller handles all auth requests.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Coursebox
 * @author  Etki <etki@etki.name>
 */
class AuthController extends RestController
{
    /**
     * Logs user in,
     *
     * @return void
     * @since 0.1.0
     */
    public function actionLogin()
    {
        $this->barricade(array('post' => array('login', 'password')));
        $login = $this->getRequest()->getPost('login');
        $password = $this->getRequest()->getPost('password');
        if (AuthenticationManager::authenticate($login, $password)) {
            $this->emitNormalResponse();
        }
        $this->emitBadRequestResponse();
    }

    /**
     * Logs user out.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionLogout()
    {
        if ($this->getUser()->getIsGuest()) {
            $this->emitNotAuthorizedResponse();
        }
        AuthenticationManager::logout();
        $this->emitNormalResponse();
    }

    /**
     * Returns current authentication status.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionStatus()
    {
        if ($this->getUser()->getIsGuest()) {
            $this->emitNotAuthorizedResponse();
        }
        $this->emitNormalResponse(
            array(
                'id' => $this->getUser()->getId(),
                'login' => $this->getUser()->getState('login'),
            )
        );
    }
}
