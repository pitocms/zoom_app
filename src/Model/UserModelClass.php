<?php
namespace App\Model;
use App\DatabaseClass;

class UserModelClass extends DatabaseClass
{
    private $data;
    private $errors = [];
    private static $fields = ['username','email','password','user_type'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateForm()
    {
        foreach(self::$fields as $field)
        {
            if(!array_key_exists($field, $this->data))
            {
                trigger_error("$field access permission denied.");
                return;
            }
        }

        $this->validateUserName();
        $this->validateEmail();
        $this->findByEmail();
        $this->validatePassword();

        return $this->errors;
    }

    private function validateUserName()
    {
        $username = trim($this->data['username']);

        if(empty($username))
        {
            $this->addError('username','Username is required.');
        } 
        else
        {
            if(!preg_match('/^[a-zA-Z0-9]{3,20}$/',$username))
            {
                $this->addError('username','Username must be alphanumeric and max 20 chars.');
            }
        } 
    }

    private function validateEmail()
    {
        $email = trim($this->data['email']);

        if(empty($email))
        {
            $this->addError('email','Email is required.');
        } 
        else
        {
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $this->addError('email','Email must be valid email.');
            }
        } 
    }

    public function findByEmail()
    {
        $email = trim($this->data['email']);
        $sql = "SELECT email FROM users WHERE users.email = '$email' limit 1";
        $num_rows = $this->connection()->query($sql)->num_rows;
        
        if($num_rows != 0)
        {
            $this->addError('email','Email already exist.');
        }
    }

    public function validatePassword()
    {
        if(empty($this->data['password']))
        {
            $this->addError('password','Password is required.');
        }

        if($this->data['password'] != $this->data['repassword'])
        {
            $this->addError('password','Password match failed.');
        }
    }

    private function passwordHas($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }

    public function saveUser($postData)
    {
        $username = $postData['username'];
        $email = $postData['email'];
        $password = $this->passwordHas($postData['password']);
        $user_type = $postData['user_type'];

        $sql = "INSERT INTO users (username, email, password,user_type)VALUES ('$username','$email','$password','$user_type')";

        return $this->connection()->query($sql);
    }
}