<?php
/**
 * Configuration overrides for WP_ENV === 'production'
 */

use Roots\WPConfig\Config;
use function Env\env;

/**
 * You should try to keep staging as close to production as possible. However,
 * should you need to, you can always override production configuration values
 * with `Config::define`.
 *
 * Example: `Config::define('WP_DEBUG', true);`
 * Example: `Config::define('DISALLOW_FILE_MODS', false);`
 */

Config::define('SMTP_HOST', env('SMTP_HOST'));
Config::define('SMTP_USER', env('SMTP_USER'));
Config::define('SMTP_PASSWORD', env('SMTP_PASSWORD'));
Config::define('SMTP_FROM', env('SMTP_FROM'));
Config::define('SMTP_FROMNAME', env('SMTP_FROMNAME'));
Config::define('SMTP_PORT', env('SMTP_PORT'));
Config::define('SMTP_AUTH', env('SMTP_AUTH'));
Config::define('SMTP_SECURE', env('SMTP_SECURE'));

/*
 * since the fkn prosolution plugin seems only to work, or at least generates an output, if debug is true, well,
 * here we are.
 */
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', false);
Config::define('WP_DEBUG_LOG', true);

Config::define('WP_ENVIRONMENT_TYPE', 'production');
