<?php

namespace App\Security;

use FOS\UserBundle\Security\UserProvider;

class FosUserProvider extends UserProvider
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $user = parent::loadUserByUsername($username);

        if (!$user->getToken()) {
            $user->setToken(md5($user->getId().time()));
            $this->userManager->updateUser($user);
        }

        return $user;
    }

    public function loadUserByToken($token)
    {
        return $this->userManager->findUserBy(["token" => $token] );
    }
}