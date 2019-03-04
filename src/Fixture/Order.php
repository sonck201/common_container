<?php

namespace App\Fixture;

class Order
{
    private static $data;

    public static function setData($data): void
    {
        self::$data = $data;
    }

    public static function getFixture(): array
    {
        return [
            'date' => self::$data[0],
            'name' => self::$data[1],
            'status' => self::$data[2],
            'tracking_code' => self::$data[3],
            'saler_id' => self::$data[4],
            'totalQuantity' => self::$data[9],
            'discount' => self::$data[10],
            'total' => self::$data[11],
            'detail' => [self::getOrderDetail()],
        ];
    }

    public static function getOrderDetail(): array
    {
        return [
            'product' => self::$data[5],
            'quantity' => self::$data[6],
            'unit' => self::$data[7],
            'price' => self::$data[8],
        ];
    }
}
