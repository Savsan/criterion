<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
    public function user()
    {
        return User::find($_SESSION['user']);
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function checkIsAdmin()
    {
        if($_SESSION['role'] === User::ADMIN){
            return $_SESSION['role'];
        }
    }

    public function checkIsHrManager()
    {
        if($_SESSION['role'] === User::HR_MANAGER){
            return $_SESSION['role'];
        }
    }

    public function checkIsSimpleUser()
    {
        if($_SESSION['role'] === User::SIMPLE_USER){
            return $_SESSION['role'];
        }
    }

    public function attempt($email, $password)
    {
        
        $user = User::where('email', $email)->first();

        if(!$user){
            return false;
        }
        // Create user's session
        if(password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            $_SESSION['role'] = $user->role;
            return true;
        }
    }

    public function logOut()
    {
        unset($_SESSION['user']);
        unset($_SESSION['role']);

    }
}