<?php

namespace App\Console\Commands;

use App\Services\Interfaces\OrganizationDataManipulationServiceInterface;
use Illuminate\Console\Command;

class CreateXmlFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-xml-file-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(OrganizationDataManipulationServiceInterface $dataManipulationService)
    {
        $dataManipulationService->generateXmlWithFakeData(100000);
        return Command::SUCCESS;
    }
}
