<?php
include_once ROOT. '/views/layouts/header.php';
?>


    <div class="games">
        <div class="home">
            <a href="../index.php" class="btn">Домой</a>
            <a href="login" class="btn">Войти</a>
            <p class="info_post">*Для сохранения результатов, необходимо войти!</p>
        </div>
        <div class="row" id="row">
            <div class="col" id="1"></div>
            <div class="col" id="2"></div>
            <div class="col" id="3"></div>
            <div class="col" id="4"></div>
            <div class="col" id="5"></div>
            <div class="col" id="6"></div>
            <div class="col" id="7"></div>
            <div class="col" id="8"></div>
            <div class="col" id="9"></div>
        </div>
        <h2 class="games_h2"><?php
            if (isset($_SESSION['level'])) {
                echo $_SESSION['user']. ', ваш уровень - ' . $_SESSION['level'];
            }
            ?>
        </h2>

    </div>
<script src="/template/js/button.js"></script>

<?php
include_once ROOT. '/views/layouts/footer.php';
?>



