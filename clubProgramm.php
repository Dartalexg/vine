<body>
<!-- Блок меню -->
<?php include("menu.php"); ?>

<!-- Блок клубная программа -->
<div class="container-fluid p0 m0">
    <div class="row p0 m0">
        <div class="club col-md-10 mx-auto p0">
            <div class="clubMainImg">
                <img src="styles/img/клубная%20программа/club.png" alt="">
                <button><div class="enterClub" id="myScroll">Вступить</div></button>
            </div>
            <div class="clubSys">
                <span class="clubTitle">Клубная программа действует по накопительной системе</span> <br>
                <span class="clubText">Стоимость всех ваших заказов суммируется и учитывается в Клубной программе. Чем больше сумма всех
                покупок, тем выше скидка</span>
            </div>
        </div>
        <div class="formForDiscount col-md-10 mx-auto p0 m0" id="myElementToScroll">
            <!-- Форма для отправки информации в бд -->
            <form class="registerForDiscount" method="post" action="do_register.php">
                <div class="registerForDiscountTitle text-center"><span>Заполните форму и получите скидку прямо сейчас!</span></div>
                <div class="col-md-12 mx-auto row">
                    <div class="mb-4 col-md-6 mx-auto">
                        <label for="username" class="form-label">Введите фамилию</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>

                <div class="col-md-12 mx-auto row">
                    <div class="mb-4 col-md-3 ms-auto">
                        <label for="first_name" class="form-label">Введите имя</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-4 col-md-3 me-auto ">
                        <label for="third_name" class="form-label">Введите отчество</label>
                        <input type="text" class="form-control" id="third_name" name="third_name" required>
                    </div>
                </div>

                <div class="col-md-12 mx-auto row">
                    <div class="mb-4 col-md-3 ms-auto">
                        <label for="email" class="form-label">Введите email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-4 col-md-3 me-auto ">
                        <label for="phone" class="form-label">Введите телефон</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>

                <div class="col-md-12 mx-auto row">
                    <div class="mb-4 col-md-3 ms-auto">
                        <label for="password" class="form-label">Введите пароль</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-4 col-md-3 me-auto ">
                        <label for="passwordCheck" class="form-label">Подтвердите пароль</label>
                        <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" required>
                    </div>
                </div>

                <div style="text-align: center">
                    <button type="submit" class=" getDiscountButton">ПОЛУЧИТЬ</button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- Блок footer -->
<?php include("footer.html"); ?>

</body>