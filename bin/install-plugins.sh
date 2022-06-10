#!/bin/bash

wp plugin install svg-favicon
wp plugin install wps-hide-login
wp plugin install "http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=ZTE1ZWQzNWEyN2IyOGQ3MmUyN2VkNmE5YzA4MTU0ZmQwODE2ZmNmYzQ4YzJmYzhmZjkxOTFh"
wp plugin install contact-form-7
wp plugin install contact-form-cfdb7
wp plugin install wordpress-seo
wp plugin install acf-content-analysis-for-yoast-seo
wp plugin install wp-fastest-cache

wp plugin activate svg-favicon
wp plugin activate advanced-custom-fields-pro
wp plugin activate contact-form-7
wp plugin activate contact-form-cfdb7

# only on production/staging
# wp plugin install wps-hide-login
# wp plugin install wordpress-seo
# wp plugin install acf-content-analysis-for-yoast-seo
# wp plugin install wp-fastest-cache