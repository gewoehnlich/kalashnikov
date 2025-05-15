<?php

namespace Gewoehnlich\Kalashnikov\Services;

use Gewoehnlich\Kalashnikov\DTO\WordDTO;
use Gewoehnlich\Kalashnikov\Validators\WordValidator;
use Gewoehnlich\Kalashnikov\Repositories\WordRepository;

class WordService
{
    private WordRepository $repository;

    public function __construct()
    {
        $this->repository = new WordRepository();
    }

    public function index(): string
    {
        $dto = new WordDTO();
        $validator = new WordValidator($dto);
        $validator->validate();

        $result = $this->repository->index($dto);
        return $result;
    }
}
