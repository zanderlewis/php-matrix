<?php
namespace Zanderlewis\PhpMatrix\Helpers;

class BigNumber
{
    public static function add(string $a, string $b): string
    {
        return bcadd($a, $b, 10);
    }

    public static function subtract(string $a, string $b): string
    {
        return bcsub($a, $b, 10);
    }

    public static function multiply(string $a, string $b): string
    {
        return bcmul($a, $b, 10);
    }

    public static function divide(string $a, string $b): string
    {
        return bcdiv($a, $b, 10);
    }
}