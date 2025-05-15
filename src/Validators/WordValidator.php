<?php

namespace Gewoehnlich\Kalashnikov\Validators;

use Gewoehnlich\Kalashnikov\DTO\WordDTO;

class WordValidator
{
    private string $word;
    private int $length;
    private int $accentPosition;

    public function __construct(WordDTO $dto)
    {
        $this->word = $dto->word;
        $this->length = $dto->length;
        $this->accentPosition = $dto->accentPosition;
    }

    public function validate(): void
    {
        $this->validateWord();
        $this->validateLength();
        $this->validateAccentPosition();
    }

    private function validateWord(): void
    {
        if (empty($this->word)) {
            throw new \Exception('Слово не может быть пустым');
        }

        if (strlen($this->word) > 30) {
            throw new \Exception('Слово не может быть длиннее 30 символов');
        }
    }

    private function validateLength(): void
    {
        if (empty($this->length)) {
            throw new \Exception('Длина не может быть пустой');
        }

        if ($this->length > strlen($this->word)) {
            throw new \Exception('Указанная длина не может быть больше чем длина слова');
        }
    }

    private function validateAccentPosition(): void
    {
        if (empty($this->accentPosition)) {
            throw new \Exception('Ударение не может быть пустым');
        }

        if ($this->accentPosition > strlen($this->word)) {
            throw new \Exception('Указанная позиция ударения не может быть больше чем длина слова');
        }

        if ($this->accentPosition > $this->length) {
            throw new \Exception('Указанная позиция ударение не может быть больше чем длина слова');
        }
    }
}
