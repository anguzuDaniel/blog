<?php
spl_autoload_register(function ($class) {
    require_once dirname(__DIR__) . "/classes/{$class}.php";
});

session_start();
