<?php

namespace App\Controller;

class UserPasswordEncoderInterface
{
    public function encodePassword($user, $plainPassword)
    {
        return $plainPassword;
    }

    public function isPasswordValid($encoded, $submitted, $user)
    {
        return $encoded === $submitted;
    }

    public function needsRehash($encoded)
    {
        return false;
    }
}