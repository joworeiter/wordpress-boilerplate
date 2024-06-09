<?php

WP_CLI::add_hook( 'before_ssh', function() {

	putenv( 'WP_CLI_SSH_PRE_CMD=export PATH=$HOME/.linuxbrew/bin:$PATH' );

});