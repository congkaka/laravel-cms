<?php

namespace App\Console\Commands\CodeGenerate\AdminCrud;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-model {name}';

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
        $content = file_get_contents(dirname(__FILE__) . "/Template/Model.txt");
        $content = generateCodeReplaceName($content, $name);

        $routeFilePath = base_path("app/Models/$name.php");
        if (File::exists($routeFilePath)) {
            $this->warn('model existed!');
            return;
        }

        File::put($routeFilePath, $content);

        $this->info('create model successfully!');
    }
}
