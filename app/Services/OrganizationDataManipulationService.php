<?php

namespace App\Services;

use App\Services\Interfaces\OrganizationDataManipulationServiceInterface;
use Illuminate\Support\Facades\Storage;
use Spatie\ArrayToXml\ArrayToXml;
use Faker\Generator as Faker;

class OrganizationDataManipulationService implements OrganizationDataManipulationServiceInterface
{
    const XML_FILE_NAME = 'organizations.xml';

    public function __construct(private readonly Faker $faker)
    {
    }

    public function getXmlFileUrl(): string
    {
        return Storage::disk('public')->url(self::XML_FILE_NAME) ?? '';
    }

    public function generateXmlWithFakeData(int $qty): void
    {
        $organizations = [];
        for ($index = 0; $index < $qty; $index++) {
            $organizations[] = [
                '_attributes' => ['ogrn' => $this->faker->unique()->numerify('#############')],
                'orgname' => $this->faker->company,
                'address' => [
                    '_attributes' => ['index' => $this->faker->postcode],
                    'city' => $this->faker->city,
                    'street' => $this->faker->streetAddress,
                ]
            ];
        }

        $root = [
            'rootElementName' => 'organizations',
        ];

        $arrayToXml = new ArrayToXml(['organization' => $organizations], $root);
        $result = $arrayToXml->dropXmlDeclaration()->toXml();

        Storage::disk('public')->put(self::XML_FILE_NAME, $result);

    }

    public function convertXmlToJson(string $content): string
    {

        $xml = simplexml_load_string($content);
        $jsonResult = [];
        foreach ($xml->organization as $item) {
            $ogrn = (string)$item['ogrn'];
            $index = (string)$item->address['index'];
            $companyString =
                $item->orgname . ', ' .
                $index . ', ' .
                $item->address->city . ', ' .
                $item->address->street;
            $jsonResult[$ogrn] = $companyString;
        }
        return json_encode($jsonResult, JSON_UNESCAPED_UNICODE);
    }

    public function getXmlFileName(): string
    {
        return self::XML_FILE_NAME;
    }

    public function convertLocalXmltoJson(): string
    {
        $content = Storage::disk('public')->get($this->getXmlFileName());
        return $this->convertXmlToJson($content);
    }

}
