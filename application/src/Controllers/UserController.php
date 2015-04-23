<?php
/**
 *
 *
 * @version 0.1.0
 * @since   
 * @package 
 * @author  Etki <etki@etki.name>
 */
class UserController extends RestController
{
    public function actionCreate()
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
        }
        if (UserModel::model()->findByAttributes(array('login' => $login))) {
            $this->respond(array('error' => 'User exists'), false);
        }
        $user = new UserModel;
        $user->password = $password;
        $user->login = $login;
        if ($user->save()) {
            $this->respond(array('login' => $login,));
        } else {
            $this->respond(array('error' => 'validation error'), false);
        }
    }
    public function actionExport()
    {
        $user = Yii::app()->getUser();
        if ($user->getIsGuest()) {
            $this->respond(array('error' => 'Not authorized'), false);
        }
        $this->respond(array('id' => $user->getId(), 'login' => $user->getState('login')));
    }
}
