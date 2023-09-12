<body>
<!-- Блок меню -->
<?php include("menu.php"); ?>

<!-- Блок каталог -->
<div class="container-fluid p0 m0">
    <div class="row p0 m0">
        <div class="profile col-md-10 mx-auto">
            <?php
            $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
            $stmt->execute(['id' => $_SESSION['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <!-- Форма для изменения информации о пользователе -->
            <form style="text-align: center" method="post" action="do_profile.php">

                <div class="registrationTitle"><span>ПРОФИЛЬ ПОЛЬЗОВАТЕЛЯ</span></div>

                <div class="col-md-12 mx-auto row">
                    <div class="mb-4 col-md-12 mx-auto">
                        <label for="username" class="form-label">Фамилия</label>
                        <input type="text" value="<?php echo $user['username']; ?>" class="form-control" id="username1"
                               name="username" required>
                    </div>
                </div>

                <div class="col-md-12 mx-auto row">
                    <div class="mb-4 col-md-6 mx-auto">
                        <label for="first_name" class="form-label">Имя</label>
                        <input type="text" value="<?php echo $user['first_name']; ?>" class="form-control"
                               id="first_name1" name="first_name" required>
                    </div>
                    <div class="mb-4 col-md-6 mx-auto ">
                        <label for="third_name" class="form-label">Отчество</label>
                        <input type="text" value="<?php echo $user['third_name']; ?>" class="form-control"
                               id="third_name1" name="third_name" required>
                    </div>
                </div>

                <div class="col-md-12 mx-auto row">
                    <div class="mb-4 col-md-6 mx-auto">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="<?php echo $user['email']; ?>" class="form-control" id="email1"
                               name="email" required>
                    </div>
                    <div class="mb-4 col-md-6 mx-auto ">
                        <label for="phone" class="form-label">Номер телефона</label>
                        <input type="text" value="<?php echo $user['phone']; ?>" class="form-control" id="phone1"
                               name="phone" required>
                    </div>
                </div>

                <div class="col-md-12 mx-auto row">
                    <div class="mb-4 col-md-6 mx-auto">
                        <label for="password" class="form-label">Введите новый пароль</label>
                        <input type="password" class="form-control" id="password1" name="password">
                    </div>
                    <div class="mb-4 col-md-6 mx-auto ">
                        <label for="passwordCheck" class="form-label">Подтвердите новый пароль</label>
                        <input type="password" class="form-control" id="passwordCheck1" name="passwordCheck">
                    </div>
                </div>


                <div style="text-align: center">
                    <button type="submit" class="btn acceptEnter">ИЗМЕНИТЬ</button>
                </div>

            </form>


        </div>
    </div>
</div>


<!-- Блок footer -->
<?php include("footer.html"); ?>

</body>
