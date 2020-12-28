<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Авторизация</div>
        <div class="card-body">
            <span style="color: red">{WARN}</span><br><br>

            <form method="post" action="login.php">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="login" id="inputLogin" class="form-control" placeholder="login" required="required" autofocus="autofocus" name="login">
                        <label for="inputLogin">Логин</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="inputPassword" class="form-control"  name="pass" placeholder="Password" required="required">
                        <label for="inputPassword">Пароль</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Вход</button>
            </form>
            <br><br><br><br>
            <a class="btn btn-primary btn-block" href="/index.php">На сайт</a>
        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

