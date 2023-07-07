# multi-tenant
# README #
* ReadMe of Multi-Tenant

### Version Change ###
* Change Version in config/version.php
* Change Version of Module Service Providers

### Custom Commands ###
* php artisan create:migration {module} {Tablename} {--version}
* php artisan run:migration (you will get options)
* php artisan migrate:fresh (run all migrations)
* php artisan create:model {module} {Name}
* php artisan create:model {module} {Name} --versions={version}
* php artisan create:seeder {module} {Name} --versions={version}
* php artisan create:module {module} {--version}


### Notes ###

# Seeder #
* If you want to run seeder then you must register the seeder into app/database/seeder


# Module #
* If you want to create module then first register your module in app/config/module.php
