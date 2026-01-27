<?php

namespace App\Parsers;

interface BankParserInterface
{
    public function parse(string $payload): array;
}