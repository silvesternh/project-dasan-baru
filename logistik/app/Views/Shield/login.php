<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= lang('Auth.login') ?> - Biro Logistik</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 10%;
            }
        }
    </style>
</head>

<body class="bg-light">
    <?php if (session('error') !== null): ?>
        <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
    <?php elseif (session('errors') !== null): ?>
        <div class="alert alert-danger" role="alert">
            <?php if (is_array(session('errors'))): ?>
                <?php foreach (session('errors') as $error): ?>
                    <?= $error ?>
                    <br>
                <?php endforeach ?>
            <?php else: ?>
                <?= session('errors') ?>
            <?php endif ?>
        </div>
    <?php endif ?>

    <?php if (session('message') !== null): ?>
        <div class="alert alert-success" role="alert"><?= session('message') ?></div>
    <?php endif ?>
    <main role="main" class="container">
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="<?= base_url('img/pexels-mart-production-7415124.jpg') ?>" class="img-fluid h-custom"
                            alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form action="<?= url_to('login') ?>" method="post">
                            <?= csrf_field() ?>
                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" class="form-control form-control-lg" id="floatingEmailInput"
                                    name="email" inputmode="email" autocomplete="email"
                                    placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                                <label for="floatingEmailInput"><?= lang('Auth.email') ?></label>
                            </div>

                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-3">
                                <input type="password" class="form-control form-control-lg" id="floatingPasswordInput"
                                    name="password" inputmode="text" autocomplete="current-password"
                                    placeholder="<?= lang('Auth.password') ?>" required>
                                <label for="floatingPasswordInput"><?= lang('Auth.password') ?></label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                                    <!-- Checkbox -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                        <input type="checkbox" name="remember" class="form-check-input me-2" <?php if (old('remember')): ?> checked<?php endif ?>>
                                        <label class="form-check-label" for="form2Example3">
                                            <?= lang('Auth.rememberMe') ?>
                                        </label>
                                    </div>
                                <?php endif; ?>
                                <?php if (setting('Auth.allowMagicLinkLogins')): ?>
                                    <a href="<?= url_to('magic-link') ?>"
                                        class="text-body"><?= lang('Auth.useMagicLink') ?></a></p>
                                <?php endif ?>
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-block" data-mdb-button-init
                                    data-mdb-ripple-init class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;"><?= lang('Auth.login') ?></button>
                                <?php if (setting('Auth.allowRegistration')): ?>
                                    <p class="text-center"><?= lang('Auth.needAccount') ?> <a
                                            href="<?= url_to('register') ?>"
                                            class="link-danger"><?= lang('Auth.register') ?></a></p>
                                <?php endif ?>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div
                class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <!-- Copyright -->
                <div class="text-white mb-3 mb-md-0">
                    Copyright © 2024. All rights reserved.
                </div>
                <!-- Copyright -->

                <!-- Right -->
                <div>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#!" class="text-white">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <!-- Right -->
            </div>
        </section>
    </main>
</body>

</html>