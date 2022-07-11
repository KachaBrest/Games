<?php

include_once ROOT . './models/User.php';

class LoginController
{
    public function actionIndex(){

        if (isset($_POST['logout'])){
            unset($_SESSION['level']);
            unset($_SESSION['user']);
            header("Location: /login");
        }

        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
                $name = $email = $password = '';

                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $errors = false;

                // Валидация полей
                if(!User::checkName($name)){
                    $errors[] = 'имя не должно быть короче 2-х символов';
                }

                if(!User::checkEmail($email)){
                    $errors[] = 'неправильный email';
                }

                if(!User::checkPassword($password)){
                    $errors[] = 'неправильный пароль';
                }
                // Проверяем, существует ли пользователь
                $userId = User::checkUserData($email, $password);

                if(!$userId == false){
                    // Если данные не верны, показываем ошибку
                    $errors[] = 'Неправильные данные для входа на сайт';
                } else {
                // Если данные правильные, записываем пользователя
                User::register($name, $email, $password);
                User::auth($name);

                header('Location: /index.php');
                 }
            }
        if (isset($_POST['email_check']) && isset($_POST['password_check'])) {

            $email = $password = '';

            $email = $_POST['email_check'];
            $password = $_POST['password_check'];

            $errors = false;

            // Валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = 'неправильный email';
            } print_r($errors);
            if (!User::checkPassword($password)) {
                $errors[] = 'неправильный пароль';
            }

            // Проверяем, существует ли пользователь
            $userName = User::checkUserData($email, $password);

            if ($userName == false) {
                // Если данные не верны, показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, записываем пользователя
                User::auth($userName);

                header('Location: /index.php');
            }
        }


        require_once ROOT . '/views/site/login.php';
        return true;
    }
}