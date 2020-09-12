<?php

namespace Helper\Traits;

trait CalculationTrait
{
    private function isNegative($first, $second): bool
    {
        return $first < $second;
    }

    private function getSign($first, $second): string
    {
        return $this->isNegative($first, $second) ? ' - ' : ' + ';
    }

    private function getPercentage($change, $value): float
    {
        if ($change !== 0 && $value !== 0) {
            return round($change * 100 / $value, 2);
        }

        return 0;
    }
}
