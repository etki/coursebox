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
    public function actionIndex()
    {
        $users = UserModel::model()->findAll();
        $data = array();
        /** @type UserModel $user */
        foreach ($users as $user) {
            $posts = PostModel::model()->count('user_id = :user_id', array('user_id' => $user->id));
            $data[] = array(
                'id' => $user->id,
                'login' => $user->login,
                'posts' => $posts
            );
        }
        $this->respond($data);
    }
    public function actionSingle()
    {
        $id = Yii::app()->getRequest()->getQuery('id');
        if (!$id) {
            $this->respond(array('error' => 'Missing id parameter',), false);
        }
        if (!($user = UserModel::model()->findByPk($id))) {
            $this->respond(array('error' => 'No such user',), false, 404);
        }
        $posts = PostModel::model()->count('user_id = :user_id', array('user_id' => $user->id));
        $data = array(
            'id' => $user->id,
            'login' => $user->login,
            'posts' => $posts
        );
        $this->respond($data);
    }
}
