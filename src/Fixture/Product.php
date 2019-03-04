<?php

namespace App\Fixture;

class Product
{
    private static $data;

    public static function setData($data): void
    {
        self::$data = $data;
    }

    public static function getFixture(): array
    {
        return [
            'name' => self::$data[1],
            'original_price' => self::$data[3],
            'expected_price' => self::$data[5],
            'quantity' => self::$data[2],
            'total_origin' => self::$data[4],
            'note' => self::$data[6],
        ];
    }
}
