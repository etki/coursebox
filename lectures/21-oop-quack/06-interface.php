<?php

interface AuthSystemInterface
{
    public function authorizeUser(User $user);
    public function isUserAuthorized(User $user);
}

class AuthSystem implements AuthSystemInterface
{
    public function authorizeUser(User $user)
    {
        if ($this->checkPassword($user->username, $user->password)) {
            $user->token = $this->generateToken();
        }
    }
    public function isUserAuthorized(User $user)
    {
        return (bool) $user->token;
    }
}