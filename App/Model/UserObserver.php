<?php

namespace App\Model;

/**
 * Class UserObserver
 * @package App\Model
 */
class UserObserver
{
    public function observeBeforeSave(User& $user)
    {
        $user->identifier = "{$user->name} - {$user->email}";
    }

    public function observeAfterSave(User $user)
    {
        //echo "User observer after save has been triggered " . $user->getId();
    }

    public function observeBeforeDelete(User $user)
    {
        dump($user);
    }
}