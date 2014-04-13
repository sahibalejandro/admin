<?php
use Illuminate\Auth\UserInterface;

class Admin extends Eloquent implements UserInterface
{
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}