<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Console\Command;

class systemInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('DB connection is ' . config('database.default'));

        $this->warn('migration started...');
        $this->call('migrate:fresh');
        $this->info('migration done...');

        $this->warn('setup roles & permissions started...');
        $this->seedAdminRole();
        $this->info('roles & permissions  setup done...');

        $this->warn('Create Super Admin');
        $this->call('create:admin');

//        $this->call('db:seed');

//        $this->call('key:generate');
        $this->call('route:clear');
        $this->alert('Hoorah! Your environment is completely setup');

        return 0;
    }

    public function seedAdminRole()
    {
        $ar = ['*'];
        $role =  new Role();
        $role->name = 'Admin';
        $role ->permissions = array_values($ar);
        $role ->save();
    }

    public function seedShop()
    {

    }
}
