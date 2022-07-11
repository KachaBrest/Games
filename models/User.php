<?php


class User
{

    // Регистрация пользователя
    public static function register($name, $email, $password){

        $db = Db::getConnection();

        $sql = "INSERT INTO user (name, email, password) 
                VALUES (:name, :email, :password)";

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    // Редактирование данных пользователя
    public static function edit($name, $level) {
        $db = Db::getConnection();

        $sql = "UPDATE user SET level = :level WHERE name = :name";

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':level', $level, PDO::PARAM_STR);

        return $result->execute();

    }

    // Проверяем существует ли пользователь с заданными $email и $password
    public static function checkUserData($email, $password) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR, strlen($email));
        $result->bindParam(':password', $password, PDO::PARAM_STR, strlen($password));
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            $player['level'] = $user['level'];
            $player['name'] = $user["name"];
            return $player;
        }
        return false;
    }

    // Получаем все данные с таблицы
    public static function getUserInfo() {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user';

        $result = $db->prepare($sql);
        $result->execute();

        $user = $result->fetchAll();
        if ($user) {
            return $user;
        }
        return false;
    }

    // Запоминаем пользователя
    public static function auth($name) {
        session_start();
        $_SESSION['user'] = $name['name'];
        if (isset($name['level'])) {
            $_SESSION['level'] = $name['level'];
        } else {
            $_SESSION['level'] = 1;
        }

    }

    //Проверка имени на длинну не меньше 2 символов
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    // Проверяем пароль, не меньше 6 символов
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    // Провряем Email на правильность
    public static function checkEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    // Проверяет не занят ли email другим пользователем
    public static function checkEmailExist($email) {

        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM `user` WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR, strlen($email));
        echo $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    // Возвращает пользователя с указанным id
    public static function getUserById($id) {

        if($id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }
}