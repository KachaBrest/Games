<?php

include_once ROOT. './models/Game.php';

class SiteController
{

    public function actionIndex (){

        require_once ROOT . '/views/index.php';
        return true;
    }

}