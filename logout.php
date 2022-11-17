<?php

include_once "./init.php";

Auth::logout();

Url::redirect('/blog/index.php');
