<?php
namespace Svpernova09\HomesteadSkeleton\Commands;

use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Inspiring;

class HomesteadCreateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'homestead:create';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy Homestead Skeleton files to the project root.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $rootPath = str_replace('app', '', app_path());
        $srcPath = str_replace('src/Commands', 'files/', __DIR__);
        copy($srcPath . 'aliases', $rootPath . 'aliases');
        copy($srcPath . 'Homestead.yaml', $rootPath . 'Homestead.yaml');
        copy($srcPath . 'Vagrantfile', $rootPath . 'Vagrantfile');

        if (!file_exists($rootPath . 'scripts'))
        {
            mkdir($rootPath . 'scripts');
            copy($srcPath . 'scripts/after.sh', $rootPath . 'scripts/after.sh');
            copy($srcPath . 'scripts/blackfire.sh', $rootPath . 'scripts/blackfire.sh');
            copy($srcPath . 'scripts/create-mysql.sh', $rootPath . 'scripts/create-mysql.sh');
            copy($srcPath . 'scripts/create-postgres.sh', $rootPath . 'scripts/create-postgres.sh');
            copy($srcPath . 'scripts/homestead.rb', $rootPath . 'scripts/homestead.rb');
            copy($srcPath . 'scripts/serve.sh', $rootPath . 'scripts/serve.sh');
            copy($srcPath . 'scripts/serve-hhvm.sh', $rootPath . 'scripts/serve-hhvm.sh');

            $string = Inspiring::quote();
            $pieces = explode(' ', $string);
            $vbName = strtolower(array_pop($pieces));

            // Update virtualbox name
            $file = file_get_contents($rootPath . 'scripts/homestead.rb');
            $newFile = str_replace("vb.name = 'homestead'", "vb.name = '" . $vbName . "'", $file);
            file_put_contents($rootPath . 'scripts/homestead.rb', $newFile);
        }
        else
        {
            $this->error('The scripts/ folder exists, please delete and run php artisan homeastead:create again.');
            die();
        }

        $this->info('Files Copied');
        $this->info('Ready to edit Homestead.yaml!');
    }
}