<?php

declare(strict_types=1);

namespace App\Service;

class NormalizerString
{
    public function normalizeStringToUpperCaseWithNoAccent(string $toNormalize) : string
    {
        $transliterator = \Transliterator::create('Any-Latin; Latin-ASCII; Upper()');
        $normalized = $transliterator->transliterate($toNormalize);
        return preg_replace('/[^\p{L}\p{N}\s]/u', '', $normalized);
    }
}
