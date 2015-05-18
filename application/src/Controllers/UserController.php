<?php
/**
 * This controller handles all the logic with users.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Coursebox
 * @author  Etki <etki@etki.name>
 */
class UserController extends RestController
{
    /**
     * Creates / registers new user.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionCreate()
    {
        $this->barricade(array('post' => array('login', 'password',)));
        $login = $this->getRequest()->getPost('login');
        $password = $this->getRequest()->getPost('password');
        if (UserModel::model()->findByAttributes(array('login' => $login))) {
            $this->emitBadRequestResponse(array('error' => 'User exists',));
        }
        $user = new UserModel;
        $user->password = $password;
        $user->login = $login;
        if (!$user->save()) {
            $this->emitBadRequestResponse($user->getErrors());
        }
        $this->emitNormalResponse($user->getAttributes(array('id', 'login',)));
    }

    /**
     * Lists all users.
     *
     * @return void
     * @since 0.1.0
     */
    public function actionIndex()
    {
        $users = UserModel::model()->with('postCount')->findAll();
        $data = array();
        /** @type UserModel $user */
        foreach ($users as $user) {
            $data[] = array_merge(
                $user->getAttributes(array('id', 'login',)),
                array('postCount' => $user->postCount,)
            );
        }
        $this->emitNormalResponse($data);
    }

    /**
     * Shows information about single user.
     *
     * @SuppressWarnings(PHPMD.ShortVariableName)
     *
     * @return void
     * @since 0.1.0
     */
    public function actionRead()
    {
        $this->barricade(array('get' => array('id',),));
        $id = $this->getRequest()->getQuery('id');
        if (!($user = UserModel::model()->findByPk($id))) {
            $this->emitResourceNotFoundResponse();
        }
        $posts = PostModel::model()->count(
            'user_id = :user_id',
            array('user_id' => $user->id,)
        );
        $data = array(
            'id' => $user->id,
            'login' => $user->login,
            'posts' => $posts
        );
        $this->emitNormalResponse($data);
    }

    /**
     * Sets new user data.
     *
     * @SuppressWarnings(PHPMD.ShortVariableName)
     *
     * @return void
     * @since 0.1.0
     */
    public function actionUpdate()
    {
        $parameters = array(
            'get' => array('id',),
            'post' => array('login', 'password', 'new-password',),
        );
        $this->barricade($parameters);
        $id = $this->getRequest()->getQuery('id');
        /** @type UserModel|null $user */
        $user = UserModel::model()->findByPk($id);
        if (!$user) {
            $this->emitResourceNotFoundResponse();
        }
        if ((int) $user->id !== (int) $this->getUser()->getId()) {
            $this->emitForbiddenResponse();
        }
        $check = StringHashProcessor::verify(
            $this->getRequest()->getPost('password'),
            $user->password
        );
        if (!$check) {
            $this->emitBadRequestResponse(array('error' => 'wrong password',));
        }
        $user->login = $this->getRequest()->getPost('login');
        $user->password = StringHashProcessor::generate(
            $this->getRequest()->getPost('new-password')
        );
        $user->save();
        $this->emitNormalResponse($user->getAttributes(array('id', 'login',)));
    }

    /**
     * Deletes single user.
     *
     * @SuppressWarnings(PHPMD.ShortVariableName)
     *
     * @return void
     * @since 0.1.0
     */
    public function actionDelete()
    {
        $this->barricade(array('get' => array('id',),));
        $id = $this->getRequest()->getQuery('id');
        /** @type UserModel|null $user */
        $user = UserModel::model()->findByPk($id);
        if (!$user) {
            $this->emitResourceNotFoundResponse();
        }
        if ($user->id !== $this->getUser()->getId()) {
            $this->emitForbiddenResponse();
        }
        $attributes = array('user_id' => $user->id,);
        PostModel::model()->deleteAllByAttributes($attributes);
        AuthenticationManager::logout();
        $user->delete();
        $this->emitNormalResponse();
    }

    /**
     * Returns list of protected actions.
     *
     * @return string[]
     * @since 0.1.0
     */
    public function getProtectedActions()
    {
        return array('delete', 'update',);
    }
}
