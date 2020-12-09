<?php

namespace App\Model;

use App\Database\Database as DB;

class Blog
{
  private $db;

  public function __construct()
  {
    $this->db = new DB();
  }

  public function addBlog($data, $user)
  {
    $this->db->query('INSERT INTO blog (title, overview, content, user_id) VALUES(:title, :overview, :content, :user_id)');

    $this->db->bind(':title', $data['title']);
    $this->db->bind(':overview', $data['overview']);
    $this->db->bind(':content', $data['content']);
    $this->db->bind(':user_id', $user);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getBlogsWithoutContent($start, $limit)
  {
    $this->db->query('SELECT id, title, overview, created_at FROM blog LIMIT :start, :limit');
    $this->db->bind(':start', $start);
    $this->db->bind(':limit', $limit);
    $row = $this->db->resultSet();
    return $row;
  }

  public function getBlogsWithContent($start, $limit)
  {
    $this->db->query('SELECT id, title, overview, content created_at FROM blog LIMIT :start, :limit');
    $this->db->bind(':start', $start);
    $this->db->bind(':limit', $limit);
    $row = $this->db->resultSet();
    return $row;
  }

  public function countBlogs()
  {
    $this->db->query('SELECT COUNT(id) AS total FROM blog');
    $row = $this->db->single();
    return $row;
  }
}
