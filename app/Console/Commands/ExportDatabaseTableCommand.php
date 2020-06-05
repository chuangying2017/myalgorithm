<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportDatabaseTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:export_structure {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'export table all structure';

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
     * @return mixed
     */
    public function handle()
    {
        $path = storage_path('app');
        $host = env('DB_HOST');
        $user = env('DB_USERNAME');
        $port = env('DB_PORT');
        $database = env('DB_DATABASE');
        $password = env('DB_PASSWORD');
        $file = date('YmdHis') . '.sql';
        $export_database = $this->argument('name');
        if (!$export_database)$export_database = $database;
        $file = $path . '/'.$file;
        exec("mysqldump -P {$port} -h {$host} -u{$user} -p{$password} -d {$export_database} > {$file}");
        echo "successfully......!".PHP_EOL;
    }
}
