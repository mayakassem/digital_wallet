<?php

namespace App\Parsers;

use Illuminate\Support\Facades\Log;

class PayTechBankParser implements BankParserInterface
{
    private string $cleanPayload;

    public function parse(string $payload): array
    {
        // Remove JSON encoding if present (strip surrounding quotes and escaped characters)
        $this->cleanPayload = trim($payload, '"');
        $this->cleanPayload = stripslashes($this->cleanPayload);
        
        Log::info('PayTech Original Payload:', ['original' => $payload]);
        Log::info('PayTech Cleaned Payload:', ['cleaned' => $this->cleanPayload]);
        
        return [
            'date'      => $this->getDateFromPayload($this->cleanPayload),
            'amount'    => $this->getAmountFromPayload($this->cleanPayload),
            'reference' => $this->getReferenceFromPayload($this->cleanPayload),
        ];
    }

    public function getDateFromPayload(string $payload)
    {
        $date = substr($payload, 0, 8);
        
        $year = substr($date, 0, 4);
        $month = substr($date, 4, 2);
        $day = substr($date, 6, 2);

        return [
            [
                'year'  => $year,
                'month' => $month,
                'day'   => $day,
            ]
        ];
    }

    public function getAmountFromPayload(string $payload)
    {
        $firstHashPos = strpos($payload, '#');
        
        if ($firstHashPos === false) {
            return '0';
        }

        $amountRaw = substr($payload, 8, $firstHashPos - 8);
        
        Log::info('PayTech Amount Extraction:', [
            'payload' => $payload,
            'raw_amount' => $amountRaw,
            'first_hash_pos' => $firstHashPos
        ]);

        $amount = trim($amountRaw);

        $amount = str_replace(',', '.', $amount);
        $amount = preg_replace('/[^0-9.]/', '', $amount);
        
        Log::info('PayTech Cleaned Amount:', [
            'cleaned_amount' => $amount
        ]);

        return $amount;
    }

    public function getReferenceFromPayload(string $payload)
    {
        $reference = '';
        $hashCount = 0;

        for ($i = 0; $i < strlen($payload); $i++) {
            if ($payload[$i] === '#') {
                $hashCount++;

                if ($hashCount === 2) {
                    break;
                }

                continue;
            }

            if ($hashCount === 1) {
                $reference .= $payload[$i];
            }
        }

        return trim($reference);
    }
}