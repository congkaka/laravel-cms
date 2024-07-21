<?php

namespace App\Console\Commands\CodeGenerate\AdminCrud;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-view {name}';

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
        $nameSnake = toSnakeCase($name);
        if (!File::exists("resources/views/admin/$nameSnake")) {
            File::makeDirectory("resources/views/admin/$nameSnake", 0755, true, true);
        }

        $this->viewIndex($nameSnake);
        $this->viewCreate($nameSnake);
        $this->viewEdit($nameSnake);
        $this->viewDetail($nameSnake);
    }

    public function viewIndex($nameSnake)
    {
        $content = file_get_contents(dirname(__FILE__) . "/Template/ViewIndex.txt");
        $content = generateCodeReplaceName($content, $this->argument('name'));
        $routeFilePath = base_path("resources/views/admin/$nameSnake/index.blade.php");
        if (File::exists($routeFilePath)) {
            $this->warn('view existed!');
            return;
        }
        File::put($routeFilePath, $content);
    }

    public function viewCreate($nameSnake)
    {
        $content = file_get_contents(dirname(__FILE__) . "/Template/ViewCreate.txt");
        $content = generateCodeReplaceName($content, $this->argument('name'));
        $routeFilePath = base_path("resources/views/admin/$nameSnake/create.blade.php");
        if (File::exists($routeFilePath)) {
            $this->warn('view create existed!');
            return;
        }
        File::put($routeFilePath, $content);

        $this->info('create view create successfully!');
    }

    public function viewEdit($nameSnake)
    {
        $content = file_get_contents(dirname(__FILE__) . "/Template/ViewEdit.txt");
        $content = generateCodeReplaceName($content, $this->argument('name'));
        $routeFilePath = base_path("resources/views/admin/$nameSnake/edit.blade.php");
        if (File::exists($routeFilePath)) {
            $this->warn('view edit existed!');
            return;
        }
        File::put($routeFilePath, $content);

        $this->info('create view edit successfully!');
    }

    public function viewDetail($nameSnake)
    {
        $content = file_get_contents(dirname(__FILE__) . "/Template/ViewDetail.txt");
        $content = generateCodeReplaceName($content, $this->argument('name'));
        $routeFilePath = base_path("resources/views/admin/$nameSnake/detail.blade.php");
        if (File::exists($routeFilePath)) {
            $this->warn('view detail existed!');
            return;
        }
        File::put($routeFilePath, $content);

        $this->info('create view detail successfully!');
    }
}
