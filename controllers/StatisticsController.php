<?php

include_once ROOT. './models/Statistics.php';

class StatisticsController
{

    public function actionIndex (){

        $info = User::getUserInfo();

        if(isset($info)){
            echo '
            <div>
                <table class="info_table">
                    <tr>
                        <th>Имя</th>
                        <th>Уровень</th>
                    </tr>
            ';
            foreach ($info as $id => $param) {
                echo "
                    <tr>
                        <td>".$param['name']."</td>
                        <td>".$param['level']."</td>
                    </tr>
                ";
            }
            echo '
                </table>
            </div>
            ';
        }

        require_once ROOT . '/views/site/statistics.php';
        return true;
    }
}