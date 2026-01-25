<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BankWebhook;
use Illuminate\Support\Str;

class BankWebhookFactory extends Factory
{

    public function definition(): array
    {
        $bank = $this->faker->randomElement(['PayTech', 'Acme']);

        return [
            'bank' => $bank,
            'payload' => $this->generatePayloadForBank($bank),
            'status' => $this->faker->randomElement(['pending', 'processed']),
            'received_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    private function generatePayloadForBank(string $bank): string
    {
        $linesCount = rand(1, 5);

        return match ($bank) {
            'PayTech' => $this->generatePayTechPayload($linesCount),
            'Acme' => $this->generateAcmePayload($linesCount),
            default  => '',
        };
    }

    private function generatePayTechPayload(int $linesCount): string
    {
        return collect(range(1, $linesCount))
            ->map(function () {
                return sprintf(
                    '%s,%.2f#%s#note/%s/internal_reference/%s',
                    $this->faker->date('Ymd'),
                    $this->faker->randomFloat(2, 10, 5000),
                    $this->faker->unique()->numerify('202506########'),
                    $this->faker->words(3, true),
                    Str::upper(Str::random(8))
                );
            })
            ->implode("\n");
    }

    private function generateAcmePayload(int $linesCount): string
    {
        return collect(range(1, $linesCount))
            ->map(function () {
                return sprintf(
                    '%.2f//%s//%s',
                    $this->faker->randomFloat(2, 10, 5000),
                    $this->faker->unique()->numerify('202506########'),
                    $this->faker->date('Ymd')
                );
            })
            ->implode("\n");
    }
}
