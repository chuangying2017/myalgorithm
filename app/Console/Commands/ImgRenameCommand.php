<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImgRenameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature='img:rename {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate the file name';

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
        $imgName = $this->argument('name');

        $path = config('dopant.img_rename');

        if (is_dir($path))
        {
            if ($dh = opendir($path))
            {
                echo "开始图片重命名......!\n";

                $dir = scandir($path);

                $i = 1;

                foreach ($dir as $k => $file)
                {
                    if ($file == '.' || $file == '..')
                    {
                        continue;
                    }

                    if (is_file($path . '\\'. $file))
                    {
                        list($name, $ext) = explode('.', $file);

                        $img = $imgName.$i.'-'.$i.'.'.$ext;

                        rename($path . '\\'.$file, $path . '\\'.$img);
                    }

                    $i += 1;
                }

                echo "完成命名......";
            }
        }
    }
}
