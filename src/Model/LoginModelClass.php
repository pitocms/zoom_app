<?php
namespace App\Model;
use App\DatabaseClass;

class LoginModelClass extends DatabaseClass
{
    private $data;
    private $errors = [];
    private static $fields = ['email','password'];

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

        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
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

    public function validatePassword()
    {
        if(empty($this->data['password']))
        {
            $this->addError('password','Password is required.');
        }
    }

    public function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }

    public function login($post_data)
    {
        $email = $post_data['email'];
        $password = $post_data['password'];

        $sql = "SELECT * FROM users where users.email = '$email' limit 1";

        $result = $this->connection()->query($sql)->fetch_object();

        if(password_verify($password,$result->password))
        {
            return $result;
        }
    }

}