<?php

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
return $db->getConn();
