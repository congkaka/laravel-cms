<?php

namespace App\Console\Commands\CodeGenerate\AdminCrud;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-route {name}';

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
        $nameSnack = toSnakeCase($name);
        $content = file_get_contents(dirname(__FILE__) . "/Template/AdminRoute.txt");
        $content = generateCodeReplaceName($content, $name);

        $routeFilePath = base_path('routes/admin.php');
        $routeContents = File::get($routeFilePath);
        if(str_contains($routeContents, $nameSnack)) {
            $this->warn('route existed!');
            return;
        }

        // Find the end of the existing group and insert the new route before it
        $groupEndPosition = strripos($routeContents, '});');
        $newRouteContents = substr_replace($routeContents, $content, $groupEndPosition, 0);

        // Write the new contents back to the file
        File::put($routeFilePath, $newRouteContents);

        $this->info('New route added successfully!');
    }
}
