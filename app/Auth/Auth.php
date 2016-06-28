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
        return isset($_SESSION['admin']);
    }

    public function checkIsHrManager()
    {
        return isset($_SESSION['hrmanager']);
    }

    public function checkIsSimpleUser()
    {
        return isset($_SESSION['simpleuser']);
    }

    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();

        if(!$user){
            return false;
        }

        if(password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            $role = $user->role;
            switch ($role) {
                case "admin":
                    $_SESSION['admin'] = $user->role;
                    break;
                case "hrmanager":
                    $_SESSION['hrmanager'] = $user->role;
                    break;
                case "user":
                    $_SESSION['simpleuser'] = $user->role;
                    break;
            }
            return true;
        }
    }

    public function logOut()
    {
        unset($_SESSION['user']);
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }elseif(isset($_SESSION['hrmanager'])){
            unset($_SESSION['hrmanager']);
        }else{
            unset($_SESSION['simpleuser']);
        }
    }
}