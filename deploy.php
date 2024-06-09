<?php
namespace Deployer;

require 'recipe/common.php';
// Config

set('repository', 'git@github.com:Elektronik-Printing/eder.git');
//set('update_code_strategy', 'clone');
set('bin/php', '/usr/bin/php83');
set('bin/wp', '~/.linuxbrew/bin/wp');

set('forward_agent', false);

task('setPATH', function () {
    run('export PATH=$HOME/.linuxbrew/bin:$PATH');
    run(' export PHPVERSION=8.3 && php -v', [], null, null, null, null, true);
})->desc('Exporting PATH for non-interactive shell');

// Hosts
import('.hosts.yaml');

//Shared files, create the needed dir/copy the files on the server into shared/
add('shared_files', ['.env']);
add('shared_files', ['wp-cli.yml']);
add('shared_files', ['web/.htaccess']);
add('shared_dirs', ['web/app/uploads']);
add('shared_dirs', ['web/app/languages']);


desc('Deploy Project');
task('deploy', [
	'deploy:prepare',
	'deploy:vendors',
//    'npm:install',
	'deploy:shared',
	'deploy:publish',
])->desc('Deploy Project');

task('rewriteflush', function () {
    run('cd {{release_or_current_path}} && wp rewrite flush --hard');
})->desc('rewriting flush');

task('updateDb', function () {
    run('cd {{release_or_current_path}} && wp core update-db');
})->desc('updating wp db');

//task('npm:install', function () {
//    run('cd {{release_or_current_path}}/packages/themes/theme-basic10 && npm i && npm run build');
//})->verbose(true)->desc('NPM');


//task('git:submodule_update', function () {
//    cd('{{release_path}}');
//    run('git submodule init');
//    run('git submodule update');
//});



// Hooks
after('deploy:failed', 'deploy:unlock');
after('deploy:setup', 'setPATH');
after('deploy:publish', 'rewriteflush');
before('rewriteflush', 'updateDb');
