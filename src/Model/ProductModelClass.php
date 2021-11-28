<?php
namespace App\Model;
use App\DatabaseClass;

class ProductModelClass extends DatabaseClass
{
    private $data;
    private $file;
    private $errors = [];
    private static $fields = ['name','customer_price','wholesaler_price'];
    private $user_id;

    public function __construct($post_data,$file,$user_id)
    {
        $this->data = $post_data;
        $this->file = $file;
        $this->user_id = $user_id;
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

        $this->validateProductName();
        $this->validatePrice();

        if($this->file["image"]["name"])
        {
            $this->validateImage();
        }

        return $this->errors;
    }

    private function validateProductName()
    {
        $name = trim($this->data['name']);

        if(empty($name))
        {
            $this->addError('name','Product Name is required.');
        } 
        else
        {
            if(!preg_match('/^[a-zA-Z0-9]{5,255}$/',$name))
            {
                $this->addError('name','Name must be alphanumeric and min 5 chars.');
            }
        } 
    }

    public function validatePrice()
    {
        $customer_price = trim($this->data['customer_price']);

        if(empty($customer_price))
        {
            $this->addError('customer_price','Customer price is required.');
        }
        else
        {
            if(!preg_match('/^\d*\.?\d*$/',$customer_price))
            {
                $this->addError('customer_price','Must be positive number');
            }
        }
    }

    public function validateImage()
    {
        $imgSize = $this->file["image"]["size"];
        $imgName = $this->file["image"]["name"];
        $imageFileType = strtolower(pathinfo($imgName,PATHINFO_EXTENSION));
        
        if($imgSize > 500000)
        {
            $this->addError('image','Size must be less tha 500KB');
        }

        if( !in_array($imageFileType ,["jpg" ,"png","jpeg","gif"]) ) {
            $this->addError('image','Only JPG, JPEG, PNG & GIF files are allowed.');
        }

    }

    public function saveProduct()
    {
        $target_dir = $_SERVER['DOCUMENT_ROOT']."/assets/img/";
        $image_name = strtotime("now").basename($this->file["image"]["name"]);
        $target_file = $target_dir . $image_name;
        move_uploaded_file($this->file["image"]["tmp_name"], $target_file);
        $product_name = $this->data['name'];
        $price_customer = $this->data['customer_price'];
        $price_wholesaler = $this->data['wholesaler_price'];
        $image_name_modify = "/assets/img/".$image_name;
        $user_id = $this->user_id;
        $sql = "INSERT INTO products (name,price_customer,price_wholesaler,image,user_id) VALUES ('$product_name', '$price_customer', '$price_wholesaler', '$image_name_modify', '$user_id')";
        return $this->connection()->query($sql);
    }

    public function editProduct()
    {
        if($this->file["image"]["name"])
        {
            $target_dir = $_SERVER['DOCUMENT_ROOT']."/assets/img/";
            $image_name = strtotime("now").basename($this->file["image-edit"]["name"]);
            $target_file = $target_dir . $image_name;
            move_uploaded_file($this->file["image-edit"]["tmp_name"], $target_file);
        }
        $product_name = $this->data['name'];
        $price_customer = $this->data['customer_price'];
        $price_wholesaler = $this->data['wholesaler_price'];
        if($this->file["image"]["name"]){
            $image_name_modify = "/assets/img/".$image_name;
        }
        else
        {
            $image_name_modify = $this->data['image'];
        }
        $user_id = $this->user_id;

        
        $sql = "UPDATE products SET name = '$product_name',price_customer='$price_customer',price_wholesaler='$price_wholesaler',image='$image_name_modify',user_id='$user_id'";
        return $this->connection()->query($sql);
    }

    public function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }
}