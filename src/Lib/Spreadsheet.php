<?php

namespace App\Lib;

use App\Fixture;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Spreadsheet
{
    const PATH_TO_FILE = ROOT . 'src/CSV';
    const PATH_TO_FILE_ORDER = self::PATH_TO_FILE . '/Order.csv';
    const PATH_TO_FILE_PRODUCT = self::PATH_TO_FILE . '/Product.csv';

    private static $reader = null;

    public static function getInstance()
    {
        return new self();
    }

    private function getReader()
    {
        if (self::$reader === null) {
            self::$reader = new Csv();
        }

        return self::$reader;
    }

    public function readOrder()
    {
        $spreadsheet = self::getReader()->load(self::PATH_TO_FILE_ORDER);

        $lastCacheKey = null;
        $arrOrder = [];

        $dataSpreadsheet = $spreadsheet->getActiveSheet()->toArray();
        foreach ($dataSpreadsheet as $k => $row) {
            if ($k === 0) {
                continue;
            }

            $cacheKey = $row[0] . '::' . $k;
            Fixture\Order::setData($row);
            if (!is_null($row[0]) && !is_array($arrOrder[$cacheKey])) {
                $arrOrder[$cacheKey] = Fixture\Order::getFixture();
                $lastCacheKey = $cacheKey;
            } else {
                $arrOrder[$lastCacheKey]['detail'][] = Fixture\Order::getOrderDetail();
            }
        }

        return $arrOrder;
    }

    public function readProduct()
    {
        $spreadsheet = self::getReader()->load(self::PATH_TO_FILE_PRODUCT);

        $arrProduct = [];

        $dataSpreadsheet = $spreadsheet->getActiveSheet()->toArray();
        foreach ($dataSpreadsheet as $k => $row) {
            if ($k === 0) {
                continue;
            }

            Fixture\Product::setData($row);
            $arrProduct[] = Fixture\Product::getFixture();
        }

        return $arrProduct;
    }
}
