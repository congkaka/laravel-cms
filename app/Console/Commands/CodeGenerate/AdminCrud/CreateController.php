<?php

namespace App\Console\Commands\CodeGenerate\AdminCrud;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-controller {name}';

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
        $content = file_get_contents(dirname(__FILE__) . "/Template/Controller.txt");
        $content = generateCodeReplaceName($content, $name);

        $routeFilePath = base_path("app/Http/Controllers/Admin/$name/$name" . "Controller.php");

        if (File::exists($routeFilePath)) {
            $this->warn('controller existed!');
            return;
        }

        if (!File::exists("app/Http/Controllers/Admin/$name")) {
            File::makeDirectory("app/Http/Controllers/Admin/$name", 0755, true, true);
        }

        File::put($routeFilePath, $content);

        $this->info('create controller successfully!');
    }
}
