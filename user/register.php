<?php
require_once realpath("../vendor/autoload.php");

use App\Controller\Users as User;

if (isset($_POST['register'])) {
  $user = new User();
  $result = $user->register();
  if ($result['success']) {
    header('Location: login.php');
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page | Admin's Dashboard Register</title>
  <link rel="stylesheet" href="register.css">
</head>

<body>
  <div class="wrapper">
    <div class="form-wrapper">
      <h1>Register Form</h1>
      <form action="" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <span class="error">
            <?php if (isset($_POST['register'])) {
              echo $result['data']['email_err'];
            }
            ?>
          </span>
          <input value="<?php
                        if (isset($_POST['email'])) {
                          echo $result['data']['email'];
                        }
                        ?>" type="text" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <span class="error">
            <?php if (isset($_POST['register'])) {
              echo $result['data']['username_err'];
            }
            ?>
          </span>
          <input type="text" value="<?php
                                    if (isset($_POST['username'])) {
                                      echo $result['data']['username'];
                                    }
                                    ?>" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <span class="error">
            <?php if (isset($_POST['register'])) {
              echo $result['data']['password_err'];
            }
            ?>
          </span>
          <input type="password" value="<?php
                                        if (isset($_POST['password'])) {
                                          echo $result['data']['password'];
                                        }
                                        ?>" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
          <input class="btn" type="submit" value="Register" name="register">
        </div>
      </form>
    </div>
  </div>
</body>

</html>