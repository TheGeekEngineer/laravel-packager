<?php

namespace TheGeekEngineer\Packager\Commands;

use Illuminate\Console\Command;
use TheGeekEngineer\Packager\Conveyor;
use TheGeekEngineer\Packager\ProgressBar;
use TheGeekEngineer\Packager\Wrapping;

/**
 * Enable an existing package.
 *
 * @author TheGeekEngineer
 **/
class EnablePackage extends Command
{
    use ProgressBar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packager:enable {vendor} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a package to composer.json and the providers config.';

    /**
     * Packages roll off of the conveyor.
     *
     * @var object \TheGeekEngineer\Packager\Conveyor
     */
    protected $conveyor;

    /**
     * Packages are packed in wrappings to personalise them.
     *
     * @var object \TheGeekEngineer\Packager\Wrapping
     */
    protected $wrapping;

    /**
     * Create a new command instance.
     */
    public function __construct(Conveyor $conveyor, Wrapping $wrapping)
    {
        parent::__construct();
        $this->conveyor = $conveyor;
        $this->wrapping = $wrapping;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Start the progress bar
        $this->startProgressBar(2);

        // Defining vendor/package
        $this->conveyor->vendor($this->argument('vendor'));
        $this->conveyor->package($this->argument('name'));

        // Start removing the package
        $this->info('Enabling package '.$this->conveyor->vendor().'\\'.$this->conveyor->package().'...');
        $this->makeProgress();

        // Install the package
        $this->info('Installing package...');
        $this->conveyor->installPackage();
        $this->makeProgress();

        // Finished removing the package, end of the progress bar
        $this->finishProgress('Package enabled successfully!');
    }
}
