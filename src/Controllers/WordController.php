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
            if (!empty($response)) {
                echo json_encode(
                    ['message' => 'Найдена рифма!', 'word' => $response],
                    JSON_UNESCAPED_UNICODE
                );
            } else {
                echo json_encode(
                    ['message' => 'Рифма не найдена :('],
                    JSON_UNESCAPED_UNICODE
                );
            }
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
