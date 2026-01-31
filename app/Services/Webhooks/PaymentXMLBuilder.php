<?php

namespace App\Services\Webhooks;

class PaymentXMLBuilder
{
    public function build(array $data): string
    {
        $xml = '';
        $xml .= '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<PaymentRequestMessage>';

        $xml .= '<TransferInfo>';
        $xml .= '<Reference>' . $data['reference'] . '</Reference>';
        $xml .= '<Date>' . $data['date'] . '</Date>';
        $xml .= '<Amount>' . $data['amount'] . '</Amount>';
        $xml .= '<Currency>' . $data['currency'] . '</Currency>';
        $xml .= '</TransferInfo>';

        $xml .= '<SenderInfo>';
        $xml .= '<AccountNumber>' . $data['sender_account'] . '</AccountNumber>';
        $xml .= '</SenderInfo>';

        $xml .= '<ReceiverInfo>';
        $xml .= '<BankCode>' . $data['receiver_bank_code'] . '</BankCode>';
        $xml .= '<AccountNumber>' . $data['receiver_account'] . '</AccountNumber>';
        $xml .= '<BeneficiaryName>' . $data['beneficiary_name'] . '</BeneficiaryName>';
        $xml .= '</ReceiverInfo>';

        if (!empty($data['notes'])) {
            $xml .= '<Notes>';

            foreach ($data['notes'] as $note) {
                $xml .= '<Note>' . $note . '</Note>';
            }

            $xml .= '</Notes>';
        }

        if (isset($data['payment_type']) && $data['payment_type'] !== 99) {
            $xml .= '<PaymentType>' . $data['payment_type'] . '</PaymentType>';
        }

        if (isset($data['charge_details']) && $data['charge_details'] !== 'SHA') {
            $xml .= '<ChargeDetails>' . $data['charge_details'] . '</ChargeDetails>';
        }

        $xml .= '</PaymentRequestMessage>';

        return $xml;
    }
}
