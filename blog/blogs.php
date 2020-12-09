<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== 'authorized') {
  header('Location: ../user/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dashboard page for admins. Here admins can view their own blogs">
  <title>Blog Page | Admin's Blogs</title>
  <link rel="stylesheet" href="main.css">
</head>

<body>
  <nav class="nav">
    <h1 class="nav-logo">Hello Admin</h1>
    <hr class="nav__line" />
    <ul class="nav-links">
      <a class="nav-link" href='blogs.php'>
        <li class="active">Blogs</li>
      </a>

      <a class="nav-link" href='files.php'>
        <li>Files</li>
      </a>

      <a class="nav-link" href='logout.php'>
        <li>Logout</li>
      </a>
    </ul>
  </nav>
</body>


</html>