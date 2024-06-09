<?php
/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;
use function Env\env;

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', true);
Config::define('WP_DEBUG_LOG', env('WP_DEBUG_LOG') ?? true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
Config::define('SCRIPT_DEBUG', true);
Config::define('DISALLOW_INDEXING', true);
Config::define('WP_CACHE', false);
Config::define('WP_ENVIRONMENT_TYPE', 'development');
ini_set('display_errors', '1');

/*
 * so browsersync (bs) URL:PORT works, when we are not logged into the wp admin,
 * if we are logged in, we get redirected to the version without port. Although bs is not always running, we need
 * to change the wp home constant based on the running process, which is in the standard case `npm run watch`
 */
$command    = 'npm run watch';
$proc       = explode("\n", trim(shell_exec(" ps -ef | grep -v grep | grep '$command'") || ''));

if($proc[0]) {
	Config::define('WP_HOME', env('WP_HOME') . ':3000');
}

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);