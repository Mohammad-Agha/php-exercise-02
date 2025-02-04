<?php
session_start();
require_once realpath("../vendor/autoload.php");

use App\Controller\Blogs as Blog;


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== 'authorized') {
  header('Location: ../user/login.php');
} else {
  if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0) {
    $blog = new Blog();
    if (isset($_POST['updateBlog'])) {
      $result = $blog->updateBlog($_GET['id']);
    } else {
      $blogs = $blog->getBlogWithContent($_GET['id']);
    }
  } else {
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dashboard page for admins. Here admins can update their own blogs">
  <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
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

      <a class="nav-link" href='../file/files.php'>
        <li>Files</li>
      </a>

      <a class="nav-link" href='logout.php'>
        <li>Logout</li>
      </a>
    </ul>
  </nav>

  <div class="div-wrapper">
    <div class="component-div">
      <span class="component-name">Update Blog</span>
      <?php
      if (isset($_POST['updateBlog']) && $result['data']['msg']) {
        echo "<span class='reply'>" . $result['data']['msg'] . "</span>";
      }
      ?>
      <span class="reply">

      </span>
    </div>
    <form action="" method="POST">
      <div class="form-group">
        <label>Title <span class="error">
            <?php if (isset($_POST['updateBlog'])) {
              echo $result['data']['title_err'];
            }
            ?>
          </span></label>

        <input value="<?php
                      if (isset($_POST['title'])) {
                        echo $result['data']['title'];
                      } else {
                        echo $blogs->title;
                      }
                      ?>" type="text" name="title" placeholder="Title" />
      </div>
      <div class="form-group">
        <label>Overview <span class="error">
            <?php if (isset($_POST['updateBlog'])) {
              echo $result['data']['overview_err'];
            }
            ?>
          </span></label>
        <input value="<?php
                      if (isset($_POST['overview'])) {
                        echo $result['data']['overview'];
                      } else {
                        echo $blogs->overview;
                      }
                      ?>" type="text" name="overview" placeholder="Overview" />
      </div>
      <div class="form-group">
        <label>Content <span class="error">
            <?php if (isset($_POST['updateBlog'])) {
              echo $result['data']['content_err'];
            }
            ?>
          </span></label>
        <textarea id="editor" value='<?php
                                      if (isset($_POST['content'])) {
                                        echo $result['data']['content'];
                                      } else {
                                        echo $blogs->content;
                                      }
                                      ?>' name="content" cols="30" rows="10"></textarea>
      </div>
      <div class="form-group">
        <button style="border: none; font-size: 18px;" name="updateBlog" class="link-btn">Update Blog</button>
      </div>
    </form>
  </div>

  <script type="text/javascript">
    let editor = document.getElementById("editor");
    console.log(editor, "123");
    let value = editor.attributes.value.value
    CKEDITOR.replace('editor', {
      width: "100%",
      height: "200px"

    })
    if (value != '') {
      console.log(value);
      CKEDITOR.instances['editor'].setData(value)
    }
  </script>
</body>

</html>