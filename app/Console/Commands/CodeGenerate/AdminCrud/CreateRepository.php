<?php

namespace App\Console\Commands\CodeGenerate\AdminCrud;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-repository {name}';

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
        $content = file_get_contents(dirname(__FILE__) . "/Template/Repository.txt");
        $content = generateCodeReplaceName($content, $name);

        $routeFilePath = base_path("app/Repositories/$name"."Repository.php");
        if (File::exists($routeFilePath)) {
            $this->warn('repository existed!');
            return;
        }
        File::put($routeFilePath, $content);

        $this->info('create repository successfully!');
    }
}
