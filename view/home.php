<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$fullname?> Wallet</title>
    <link href="assets/css/home.css" rel="stylesheet" >

</head>
<body>

    <?php if (!defined("IN_WALLET")) { die("Auth Error"); } ?>
    <div class="background-container">
        <div class="center-container">
            <div>
                <div class="logo">
                    <img src=assets/images/stipend-logo.png>
                </div>
                <div class="title">
                    <div class="title-text"><?php echo $lang['PAGE_HEADER']; ?></div>
                    <?php
                        if (!empty($error)) {
                            echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                        }
                    ?>
                </div>
                <br />
                <br />
                <div class="data-container">
                    <div class="data-box">
                        <div class="login-data">
                            <div><?php echo $lang['FORM_LOGIN']; ?></div><br />
                            <form action="index.php" method="POST" class="clearfix">
                                <input type="hidden" name="action" value="login" />
                                <div><input type="text" name="username" placeholder="<?php echo $lang['FORM_USER']; ?>"></div><br />
                                <div><input type="password" name="password" placeholder="<?php echo $lang['FORM_PASS']; ?>"></div><br />
                                <div><input type="text" name="auth" placeholder="<?php echo $lang['FORM_2FA']; ?>"></div><br />
                                <div><button class="submit-button" type="submit"><?php echo $lang['FORM_LOGIN']; ?></button></div>
                            </form>
                        </div>
                        <div class="register-data">
                            <div><?php echo $lang['FORM_CREATE']; ?></div><br />
                            <form action="index.php" method="POST" class="clearfix">
                                <input type="hidden" name="action" value="register" />
                                <div><input type="text" class="form-control" name="username" placeholder="<?php echo $lang['FORM_USER']; ?>"></div><br />
                                <div><input type="password" class="form-control" name="password" placeholder="<?php echo $lang['FORM_PASS']; ?>"></div><br />
                                <div><input type="password" class="form-control" name="confirmPassword" placeholder="<?php echo $lang['FORM_PASSCONF']; ?>"></div><br />
                                <div><button class="submit-button" type="submit" class="btn btn-default"><?php echo $lang['FORM_SIGNUP']; ?></button></div>
                            </form>
                        </div>
                    </div>
                    <div class="credit-box">
                        <b><center><p class="credits">Powered By: <a href="http://github.com/johnathanmartin/piWallet">piWallet</a></p></center></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
