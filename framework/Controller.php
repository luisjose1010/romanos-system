<?php

namespace Framework;

abstract class Controller
{
    abstract public function index(array $parameters);

    public static function redirect($route)
    {
        echo "<script>window.location.href = '$route'</script>";
        exit();
    }
}
