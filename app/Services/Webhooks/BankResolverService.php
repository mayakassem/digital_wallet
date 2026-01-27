<?php

namespace App\Services\Webhooks;

use App\Parsers\BankParserInterface;
use App\Parsers\PayTechBankParser;
use App\Parsers\AcmeBankParser;

class BankResolverService
{
    public function resolveBank(string $bank): BankParserInterface
    {
        return match (strtolower($bank)) {
            'paytech' => new PayTechBankParser(),
            'acme'    => new AcmeBankParser(),
        };
    }
}