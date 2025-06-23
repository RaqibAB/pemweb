<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | PerpusDigital</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        html, body { height: 100%; }
        body { display: flex; align-items: center; padding-top: 40px; padding-bottom: 40px; background-color: #f5f5f5; }
        .form-signin { width: 100%; max-width: 330px; padding: 15px; margin: auto; }
    </style>
</head>
<body class="text-center">
<main class="form-signin">
    <form action="<?= site_url('login') ?>" method="post">
         <?= csrf_field() ?>
        <h1 class="h3 mb-3 fw-normal">Silakan Login</h1>
         <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>
        <div class="form-floating">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@gmail.com" required>
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mt-2">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Login</button>
        <p class="mt-5 mb-3 text-muted">&copy; Perpus Digital Ci4</p>
    </form>
</main>
</body>
</html>