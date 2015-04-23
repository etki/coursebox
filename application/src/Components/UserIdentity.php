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
    private $_id;
    public function authenticate()
    {
        $this->errorCode = self::ERROR_NONE;
        $criteria = array('login' => $this->username,);
        $user = UserModel::model()->findByAttributes($criteria);
        if (!$user || !StringHashProcessor::verify($this->password, $user->password)) {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        } else {
            $this->_id = $user->id;
            $this->setState('login', $user->login);
        }
        return $this->errorCode === self::ERROR_NONE;
    }
    public function getId()
    {
        return $this->_id;
    }
}
