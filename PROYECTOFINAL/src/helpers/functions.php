<?php 

require __DIR__.'/../config/database.php';

$config = require __DIR__.'/../config/config.php';

define('BASE_URL', $config['base_url']);

define('ASSETS_URL', $config['assets_url']);

define('SRC_URL', $config['src_url']);

define('CAREERS_CACHE_FILE',  __DIR__ .'/../cache/careers.json');