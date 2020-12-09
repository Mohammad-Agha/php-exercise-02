<?php

namespace App\Controller;

use App\Model\Blog as Blog;

class Blogs
{
  public function __construct()
  {
    $this->Blog = new Blog();
  }

  public function addBlog($user)
  {
    // if the method is post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // init data
      $data = [
        'title' => trim($_POST['title']),
        'overview' => trim($_POST['overview']),
        'content' => trim($_POST['content']),
        'title_err' => '',
        'overview_err' => '',
        'content_err' => ''
      ];

      // validate title
      if (empty($data['title'])) {
        $data['title_err'] = 'Title is required';
      }

      // validate overview
      if (empty($data['overview'])) {
        $data['overview_err'] = 'Overview is required';
      }

      // validate content
      if (empty($data['content'])) {
        $data['content_err'] = 'Content is required';
      }



      // Make sure errors are empty
      if (empty($data['title_err']) && empty($data['overview_err']) && empty($data['content_err'])) {
        // Add blog
        if ($this->Blog->addBlog($data, $user)) {
          $data['msg'] = 'Blog was added successfully';
          $data['title'] = '';
          $data['overview'] = '';
          $data['content'] = '';
          return [
            'success' => true,
            'data' => $data
          ];
        } else {
          die('Something went wrong');
        }
      } else {
        return [
          'success' => false,
          'data' => $data
        ];
      }
    }
  }

  public function getBlogsWithoutContent($page, $limit)
  {
    $start = ($page - 1) * $limit;

    return $this->Blog->getBlogsWithoutContent($start, $limit);
  }

  public function getTotalBlogs()
  {
    return $this->Blog->countBlogs();
  }
}
