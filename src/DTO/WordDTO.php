<?php

namespace Gewoehnlich\Kalashnikov\DTO;

class WordDTO
{
    public string $word;
    public int $length;
    public int $accentPosition;

    public function __construct()
    {
        $this->word = $_GET['word'];
        $this->length = $_GET['length'];
        $this->accentPosition = $_GET['accentPosition'];
    }
}
