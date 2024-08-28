<?php

namespace app\core;

use app\core\Router;

/**
 * Class Request
 * 
 * @author Md. Tanjir Mahabub <md.tanjir.mahabub@gmail.com>
 * @package app\core;
 */

 class Request
 {
    public function getPath() 
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $postion = strpos($path, '?');
        
        if($postion === false) {
            return $path;
        }

        return substr($path, 0, $postion);
    }

    public function getMethod() 
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
 }