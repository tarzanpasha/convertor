<?php

namespace App\Console\Commands;

use App\Services\Interfaces\OrganizationDataManipulationServiceInterface;
use Illuminate\Console\Command;

class ConvertXmlToJsonCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-xml-to-json-command';

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
        $result = $dataManipulationService->convertLocalXmltoJson();
        return Command::SUCCESS;
    }
}
