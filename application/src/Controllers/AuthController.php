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
    public function actionLogin()
    {
        $request = Yii::app()->getRequest();
        $missingParameters = array();
        foreach (array('login', 'password') as $key) {
            $$key = $request->getPost($key);
            if (!$$key) {
                $missingParameters[] = $key;
            }
        }
        if ($missingParameters) {
            $this->respond(array('missingParameters' => implode(', ', $missingParameters)), false);
            Yii::app()->end();
        }
        $identity = new UserIdentity($login, $password);
        if (!$identity->authenticate()) {
            $this->respond(array(), false);
        }
        Yii::app()->getUser()->login($identity);
        $this->respond();
    }
    public function actionLogout()
    {
        Yii::app()->getUser()->logout();
        $this->respond();
    }
    public function actionStatus()
    {
        $user = Yii::app()->getUser();
        if ($user->getIsGuest()) {
            $this->respond(array('error' => 'Not authorized'), false);
        }
        $this->respond(array('id' => $user->getId(), 'login' => $user->getState('login')));
    }
}
