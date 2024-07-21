<?php

namespace App\Console\Commands\CodeGenerate\AdminCrud;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-migration {name}';

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
        $lowerName = toSnakeCase($name);
        $content = file_get_contents(dirname(__FILE__) . "/Template/Migration.txt");
        $content = generateCodeReplaceName($content, $name);

        $current_time = date('Y_m_d_His');
        $routeFilePath = 'database/migrations/' . $current_time . '_create_' . $lowerName . 's_table.php';
        if (File::exists($routeFilePath)) {
            $this->warn('migration existed!');
            return;
        }

        File::put($routeFilePath, $content);

        $this->info('create migration successfully!');
    }
}
