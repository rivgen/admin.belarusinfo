<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    protected function ApiResponse($data, $groups = []): JsonResponse
    {
        $response = [
            'data' => $data,
            'user' => $this->getUser()->__toArray(),
            'code' => 200
            ];

        return $this->json($response, 200, [], $groups);
    }
}