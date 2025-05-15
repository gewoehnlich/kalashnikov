<?php

namespace Gewoehnlich\Kalashnikov\Controllers;

use Gewoehnlich\Kalashnikov\Services\WordService;

class WordController
{
    private WordService $wordService;

    public function __construct()
    {
        $this->wordService = new WordService();
    }

    public function index(): void
    {
        try {
            $response = $this->wordService->index();

            http_response_code(201);
            echo json_encode(['message' => 'Success message', 'word' => $response]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
