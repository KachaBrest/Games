<?php
include_once ROOT. './models/Game.php';

class GameController
{

    public function actionView (){

        require_once ROOT . '/views/site/games.php';

        $this->actionRequest();
        $this->actionOver();
        return true;
    }

    public function actionRequest() {
        //создаем рандомное чсло
        $number = mt_rand(1, 9);

        //получаем JSON с front-end и сразу декодируем его в массив
        $answer[] = json_decode(file_get_contents('php://input'), true);

        //цикл который проверяет, что бы рандомное число не совпадала с уже отмеченными полями
        for ($i = 0; $i < 1;)
        {
            if(isset($answer[0]['cross']) && isset($answer[0]['zero'])){
            //если число не нйадено в массиве крестиков/ноликов, отправляем его на front и перекращяем цикл
            if (!in_array($number, $answer[0]['cross']) && !in_array($number, $answer[0]['zero']))
            {
                if (count($answer[0]['cross']) == 5)
                {
                    break;
                }

                else {
                    echo $number.'zero';
                    break;
                }
            } else {
                // если рандомное число уже было в отмеченных, получаем новое рандомное число
                $number = mt_rand(1, 9);
            }
        } else{
                break;
            }

        }
    }

    public function actionOver(){
        //получаем JSON с front-end и сразу декодируем его в массив
        if(isset(json_decode(file_get_contents('php://input'), true)[0])) {
            $answer = json_decode(file_get_contents('php://input'), true)[0];


            if ( $answer === '1'){
                $_SESSION['level'] ++;
            } elseif ( $answer === '-1') {
                if ($_SESSION['level'] > 1) {
                    $_SESSION['level']--;
                };
            }

            User::edit($_SESSION['user'], $_SESSION['level']);
        }
    }
}