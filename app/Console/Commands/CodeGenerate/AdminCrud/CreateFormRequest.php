<?php

namespace App\Console\Commands\CodeGenerate\AdminCrud;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateFormRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-request {name}';

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
        $this->createRequest();
        $this->createUpdateRequest();
    }

    private function createRequest(){
        $name = $this->argument('name');
        $className = $name.'Create';
        $content = file_get_contents(dirname(__FILE__) . "/Template/FormRequest.txt");
        $content = str_replace("#name#", $className, $content);

        $routeFilePath = base_path("app/Http/Requests/Admin/$name/$className"."Request.php");
        if (File::exists($routeFilePath)) {
            $this->warn('request existed!');
            return;
        }

        if(!File::exists("app/Http/Requests/Admin/$name")) {
            File::makeDirectory("app/Http/Requests/Admin/$name", 0755, true, true);
        }
        File::put($routeFilePath, $content);
        $this->info('create request successfully!');
    }

    private function createUpdateRequest(){
        $name = $this->argument('name');
        $className = $name.'Update';
        $content = file_get_contents(dirname(__FILE__) . "/Template/FormRequest.txt");
        $content = str_replace("#name#", $className, $content);

        $routeFilePath = base_path("app/Http/Requests/Admin/$name/$className"."Request.php");
        if (File::exists($routeFilePath)) {
            $this->warn('request existed!');
            return;
        }

        File::put($routeFilePath, $content);
        $this->info('update request successfully!');
    }
}
