<?php
namespace App\Controller;

use App\DatabaseClass;

class ProductsControllerClass extends DatabaseClass
{
    public function getProducts($id = null, $user_id=null)
    {
        $sql = "SELECT * FROM products";
        if($id)
        {
            $sql = $sql." "."WHERE id = '$id' LIMIT 1";
        }

        if($user_id)
        {
            $sql = $sql." "."WHERE user_id = '$user_id'";
        }
        
        $result = $this->connection()->query($sql);

        return $result;
    }
}