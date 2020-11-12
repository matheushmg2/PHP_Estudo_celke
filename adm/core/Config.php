<?php

session_start();
ob_start();

define('URL', 'http://localhost/showadm/');
define('URLADM', 'http://localhost/showadm/adm/');

define('CONTROLLER', 'HOME');
define('METODO', 'index');

// Credenciais de acesso ao Banco de Dados
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'adm_pratica');