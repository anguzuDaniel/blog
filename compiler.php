<?php

use ScssPhp\ScssPhp\Compiler;

try {
    $scss = new Compiler();
    $scss->setImportPaths('./css/scss/main.scss');
    $css = $scss->compileString('@import "newstyle.css";');
    file_put_contents('newstyle.css', $css);
} catch (Exception $e) {
    exit($e->getMessage());
}


// require_once "scssphp/scss.inc.php";

// use ScssPhp\ScssPhp\Compiler;

// $compiler = new Compiler();

// echo $compiler->compileString('
//   $color: #abc;
//   div { color: lighten($color, 20%); }
// ')->getCss();