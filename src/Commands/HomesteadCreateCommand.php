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
    protected $signature = 'homestead:create
                        {--name= : Name of the virtual machine}
                        {--hostname= : Hostname of the virtual machine}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy Homestead Skeleton files to the project root.';

    /**
     *
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
        $rootPath = $this->getRootPath();
        $sourcePath = $this->getSourcePath();

        // Start Copying Files
        copy($sourcePath . 'aliases', $rootPath . 'aliases');
        copy($sourcePath . 'Homestead.yaml', $rootPath . 'Homestead.yaml');
        copy($sourcePath . 'Vagrantfile', $rootPath . 'Vagrantfile');

        if (!file_exists($rootPath . 'scripts'))
        {
            mkdir($rootPath . 'scripts');
            copy($sourcePath . 'scripts' . DIRECTORY_SEPARATOR . 'after.sh',
                $rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'after.sh');
            copy($sourcePath . 'scripts' . DIRECTORY_SEPARATOR . 'blackfire.sh',
                $rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'blackfire.sh');
            copy($sourcePath . 'scripts' . DIRECTORY_SEPARATOR . 'create-mysql.sh',
                $rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'create-mysql.sh');
            copy($sourcePath . 'scripts' . DIRECTORY_SEPARATOR . 'create-postgres.sh',
                $rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'create-postgres.sh');
            copy($sourcePath . 'scripts' . DIRECTORY_SEPARATOR . 'homestead.rb',
                $rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'homestead.rb');
            copy($sourcePath . 'scripts' . DIRECTORY_SEPARATOR . 'serve.sh',
                $rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'serve.sh');
            copy($sourcePath . 'scripts' . DIRECTORY_SEPARATOR . 'serve-hhvm.sh',
                $rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'serve-hhvm.sh');

            $string = Inspiring::quote();
            $pieces = explode(' ', $string);
            $vbName = strtolower(array_pop($pieces));

            if ($this->option('name'))
            {
                $vbName = $this->option('name');
            }

            // Update virtualbox name
            $file = file_get_contents($rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'homestead.rb');
            $newFile = str_replace("vb.name = 'homestead'", "vb.name = '" . $vbName . "'", $file);


            if ($this->option('hostname'))
            {
                $hostName = $this->option('hostname');
                $newFile = str_replace("settings[\"hostname\"] ||= \"homestead\"", "settings[\"hostname\"] ||= \"" . $hostName ."\"", $file);
            }

            file_put_contents($rootPath . 'scripts' . DIRECTORY_SEPARATOR . 'homestead.rb', $newFile);
        }
        else
        {
            $this->error('The scripts/ folder exists, please delete and run php artisan homeastead:create again.');
            die();
        }

        $this->info('Files Copied');
        $this->info('Ready to edit Homestead.yaml!');
    }

    /**
     * Return path to the Laravel project root
     * @return string
     */
    public function getRootPath()
    {
        $appPath = app_path();
        $folders = explode(DIRECTORY_SEPARATOR, $appPath);
        array_pop($folders);
        $rootPath = implode(DIRECTORY_SEPARATOR, $folders);

        return $rootPath . '/';
    }

    /**
     * Return path to Homestead files in our project
     * @return string
     */
    public function getSourcePath()
    {

        return str_replace('src' . DIRECTORY_SEPARATOR . 'Commands', 'files' . DIRECTORY_SEPARATOR, __DIR__);
    }
}