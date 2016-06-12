<?php

namespace classes;

class RegisteredUser extends User
{
    public static function auth($login, $password)
    {
        $user_exists = DataBase::getInstance()->getConnection()->query("SELECT COUNT(*) AS count FROM users WHERE login = '$login'")->fetch_object()->count;
        $selected_user = DataBase::getInstance()->getConnection()->query("SELECT * FROM users WHERE login = '$login'")->fetch_array(MYSQLI_ASSOC);

        $password_is_right = password_verify ($password , $selected_user['password']);

        if ($user_exists && $password_is_right){
            session_start();
            $_SESSION['uid'] = $selected_user['id'];

            return true;
        }
        return false;
    }
    
    public static function isAuthorized(){
        return isset($_SESSION['uid']);
    }

    public static function unAuthorize(){
        unset($_SESSION['uid']);
    }
}