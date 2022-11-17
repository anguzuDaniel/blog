<?php

include_once "includes/init.php";

Auth::logout();

Url::redirect('/blog/index.php');
