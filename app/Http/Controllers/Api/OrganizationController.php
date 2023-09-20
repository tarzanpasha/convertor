<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\OrganizationDataManipulationServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class OrganizationController extends Controller
{
    public function __construct(
        private readonly OrganizationDataManipulationServiceInterface $dataManipulationService
    )
    {

    }

    /**
     * @throws ValidationException
     */
    public function getXml(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Неправильно задано количество записей для формирования xml'
            ]);
        }

        $qty = (int)$validator->validated()['qty'];

        $this->dataManipulationService->generateXmlWithFakeData($qty);

        return response()->json([
            'error' => false,
            'url' => $this->dataManipulationService->getXmlFileUrl(),
        ]);
    }

    public function convertXmlToJson(Request $request)
    {
        if (!$request->hasFile('xml')) {
            return response()->json([
                'error' => 'Не задан xml файл для обработки'
            ], 400);
        }
        return response()->json([
            'error' => false,
            'json' => $this->dataManipulationService->convertXmlToJson($request->file('xml')->getContent())
        ], 200);
    }

}
