<?php

header("Content-Type: application/json;charset=utf-8");
header("Access-Control-Allow-Origins: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

require__DIR__ . "/config.php";
require__DIR__ . "/routes/rotas.php";