
<?php
$directory = "stylesheets";

require "scssphp/scss.inc.php";
scss_server::serveFrom(array(
    "cache_dir" => "../../css/sass/cache",
    "scss_formatter" => "scss_formatter_compressed",
    "scss_formatter_opts" => array(
        "debug" => false
    )
));