<?php 
use Import\Importer;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DocImport extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'doc:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import a document';

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
	public function fire()
	{
		$importer = new Importer();

		$importer->importFile($this->argument('path'));
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('path', InputArgument::REQUIRED, 'The document path to import.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('all', null, InputOption::VALUE_NONE, 'Indicates \'path\' argument is a directory.  All files in the directory will be imported.', null),
		);
	}

}
