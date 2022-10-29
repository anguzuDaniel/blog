
<?php
$directory = "./sass/main.scss";

require "../scssphp-0.0.12/scssphp/scss.inc.php";
scss_server::serveFrom($directory);
