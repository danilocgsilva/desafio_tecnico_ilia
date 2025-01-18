<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('typestyles', [$this, 'typestring']),
        ];
    }

    public function typestring(string $typeReturned): string
    {
        switch ($typeReturned) {
            case "Lightning":
                return "type-lightning";
            case "Grass":
                return "type-grass";
            case "Water":
                return "type-water";
            case "Psychic":
                return "type-psychic";
            case "Darkness":
                return "type-darkenss";
            case "Fire":
                return "type-fire";
            case "Fighting":
                return "type-fighting";
            case "Dragon":
                return "type-dragon";
            case "Metal":
                return "type-metal";
            default:
                return "type-generic";
        }
    }
}
