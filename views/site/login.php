<?php
include_once ROOT. '/views/layouts/header.php';
?>

<div class="games">
    <div class="home">
        <a href="../index.php" class="btn">Домой</a>
    </div>

    <div class="favorite_container">

        <?php

        if (!isset($_SESSION['user'])) {
            echo '
        <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Вход
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
          <div class="accordion-body">
            <form action="post" method="POST" class="form_cart">
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email_check" placeholder="kacha.biker@gmail.com"
                     aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password_check" placeholder="Password">
              </div>
              <button type="submit" class="btn-primary">Войти</button>
          </form>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Регистрация
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <form action="post" method="POST" class="form_cart">
              <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Alexandr">
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email" placeholder="kacha.biker@gmail.com"
                     aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <button type="submit" class="btn-primary">Регистрация</button>
              
          </form>
          </div>
        </div>
      </div>
    </div>
        ';
        } else {
            echo ' 
        <div class="cabinet_logout">
            <h2>Приветствуем ' . $_SESSION['user'] . '</h2> 
            <form action="logout" method="post">
                <input type="submit" name="logout" value="Выйти" class="btn-logout"></input> 
            </form>
        </div>
        ';
        }

        ?>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


<?php
include_once ROOT. '/views/layouts/footer.php';
?>



