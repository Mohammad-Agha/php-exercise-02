<?php

namespace App\Controller;

use App\Model\User as User;

class Users
{
  public function register()
  {
    $User = new User();
    // if the method is post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // init data
      $data = [
        'email' => trim($_POST['email']),
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'username_err' => '',
        'password_err' => ''
      ];

      // validate email
      if (empty($data['email'])) {
        $data['email_err'] = 'Email is required';
      } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $data['email_err'] = "Invalid email";
      } else if ($User->findUserByEmail($data['email'])) {
        $data['email_err'] = 'Email is already taken';
      }

      // validate username
      if (empty($data['username'])) {
        $data['username_err'] = 'Username is required';
      } else {
        // check if username exists
        if ($User->findUserByUsername($data['username'])) {
          $data['username_err'] = 'Username is already taken';
        }
      }

      // validate password 
      if (empty($data['password'])) {
        $data['password_err'] = 'Password is required';
      } else {
        // check if password is strong
        $uppercase = preg_match('@[A-Z]@', $data['password']);
        $lowercase = preg_match('@[a-z]@', $data['password']);
        $number    = preg_match('@[0-9]@', $data['password']);
        $specialChars = preg_match('@[^\w]@', $data['password']);

        // if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($data['password']) < 8) {
        //   $data['password_err'] = 'Password should be at least 8 characters, include at least one upper case letter, one number, and one special character.';
        // }
      }

      // Make sure errors are empty
      if (empty($data['email_err']) && empty($data['username_err']) && empty($data['password_err'])) {

        // Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register User
        if ($User->register($data)) {
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
}
