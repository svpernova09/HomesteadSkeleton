<?php
namespace Svpernova09\HomesteadSkeleton\Commands;

use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;
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
        $this->info('Homestead:create Command fired');
    }
}