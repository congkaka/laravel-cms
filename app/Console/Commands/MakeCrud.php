<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-crud {name}';

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
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->call('admin:make-controller', ['name' => $name]);
        $this->call('admin:make-request', ['name' => $name]);
        $this->call('admin:make-model', ['name' => $name]);
        $this->call('admin:make-repository', ['name' => $name]);
        $this->call('admin:make-route', ['name' => $name]);
        $this->call('admin:make-view', ['name' => $name]);
        $this->call('admin:make-migration', ['name' => $name]);
    }
}
