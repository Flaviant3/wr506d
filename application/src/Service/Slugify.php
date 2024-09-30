<?php

namespace App\Service;

use Symfony\Component\String\Slugger\AsciiSlugger;

class Slugify
{
    public function slugify(string $stringToSlugify): string
    {
        $slugger = new AsciiSlugger();
        return $slugger->slug($stringToSlugify)->lower(); // On peut également utiliser ->upper() si nécessaire
    }
}