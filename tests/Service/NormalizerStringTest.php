<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\NormalizerString;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NormalizerStringTest extends TestCase
{
    private NormalizerString $normalizer;

    protected function setUp(): void
    {
        $this->normalizer = new NormalizerString();
    }

    #[DataProvider('provideStringsToNormalize')]
    public function testNormalizeStringToUpperCaseWithNoAccent(string $input, string $expected): void
    {
        $result = $this->normalizer->normalizeStringToUpperCaseWithNoAccent($input);
        $this->assertSame($expected, $result);
    }

    public static function provideStringsToNormalize(): array
    {
        return [
            'simple string' => ['hello', 'HELLO'],
            'with spaces' => ['hello world', 'HELLO WORLD'],
            'with numbers' => ['hello 123', 'HELLO 123'],
            'with accents' => ['été', 'ETE'], // Note: current regex might not handle this as expected if it's meant to REMOVE accents, or KEEP accented letters.
            'with special characters' => ['hello!', 'HELLO'],
            'empty string' => ['', ''],
            'mixed case 1' => ['HeLLo', 'HELLO'],
            'mixed case 2' => ['Oursinières', 'OURSINIERES'],
            'mixed case 3' => ['OursInières', 'OURSINIERES'],
        ];
    }
}
