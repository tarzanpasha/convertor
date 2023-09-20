<?php

namespace App\Services\Interfaces;
interface OrganizationDataManipulationServiceInterface
{
    public function generateXmlWithFakeData(int $qty): void;
    public function getXmlFileUrl(): string;
    public function convertXmlToJson(string $content): string;
    public function getXmlFileName(): string;

    public function convertLocalXmltoJson(): string;
}
