<?php
/**
 * Simple user identity
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Coursebox
 * @author  Etki <etki@etki.name>
 */
class UserIdentity extends CUserIdentity
{
    /**
     * User identifier, as stolen from database.
     *
     * @type int
     * @since 0.1.0
     */
    private $id;

    /**
     * Authenticates user.
     *
     * @return bool
     * @since 0.1.0
     */
    public function authenticate()
    {
        $this->errorCode = self::ERROR_NONE;
        $criteria = array('login' => $this->username,);
        $user = UserModel::model()->findByAttributes($criteria);
        if (!$user || !StringHashProcessor::verify($this->password, $user->password)) {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        } else {
            $this->id = $user->id;
            $this->setState('login', $user->login);
        }
        $message = sprintf(
            'Logging attempt (%s:%s = %d)',
            $this->username,
            $this->password,
            $this->errorCode
        );
        Yii::log($message);
        return $this->errorCode === self::ERROR_NONE;
    }

    /**
     * Retrieves user ID.
     *
     * @return int
     * @since 0.1.0
     */
    public function getId()
    {
        return $this->id;
    }
}
