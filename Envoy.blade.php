@setup
    function logMessage($message) {
        return "echo '\033[32m" .$message. "\033[0m';\n";
    }
@endsetup

@servers(['prod' => 'ubuntu@3.91.220.78'])

@story('deploy')
    run_deployment
    run_maintenance
    queue_wokers
@endstory

@task('run_deployment', ['on' => ['prod'], 'parallel' => true])
    cd /var/www/html/kouponzetu

    {{ logMessage("git pull master") }}
    git pull origin master -q

    {{ logMessage("Running composer") }}
    composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader

    {{ logMessage("running php artisan optimize") }}
    php artisan optimize

    # Set dir permissions
    {{ logMessage("Set permissions") }}

    sudo chown -R ubuntu:www-data .
    sudo find . -type f -exec chmod 664 {} \;
    sudo find . -type d -exec chmod 775 {} \;
    sudo chgrp -R www-data storage bootstrap/cache
    sudo chmod -R ug+rwx storage bootstrap/cache

    {{ logMessage("Restart nginx") }}
    sudo service nginx restart

    {{ logMessage("Restart php fpm") }}
    sudo service php8.0-fpm restart
@endtask

@task('run_maintenance', ['on' => ['prod']])
    cd /var/www/html/kouponzetu

    {{ logMessage("Running migrations") }}
    php artisan migrate --force

    {{ logMessage("Showing migration status") }}
    php artisan migrate:status
@endtask

@task('queue_wokers', ['on' => ['prod']])
    cd /var/www/html/kouponzetu

    {{ logMessage("Restart queues") }}
    php artisan queue:restart
@endtask

@finished
    echo "Envoy deployment script finished.\r\n";
@endfinished

