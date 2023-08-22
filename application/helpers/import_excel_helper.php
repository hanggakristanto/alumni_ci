<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once __DIR__ . "/../libraries/PHPExcel/PHPExcel.php";

class ImportExcel
{
    /**
     * @var PHPExcel
     */
    protected $objExcel;
    protected $collection;
    protected $callback;
    protected $header;

    public function __construct($file, $header = [])
    {
        $this->objExcel = PHPExcel_IOFactory::load($file);
        $this->objExcel->setActiveSheetIndex(0);
        $this->header = $header;
        $this->processImport();
    }
    public static function import($file, $header = [])
    {
        return new static($file, $header);
    }

    public function getHighestRow()
    {
        return $this->objExcel->getActiveSheet()->getHighestRow();
    }
    public function getHighestColumn($toColumnIndex = false)
    {
        $column = $this->objExcel->getActiveSheet()->getHighestColumn();
        if ($toColumnIndex) {
            return PHPExcel_Cell::columnIndexFromString($column);
        }
        return $column;
    }

    public function getCellByColAndRow($col, $row)
    {
        return $this->objExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
    }

    protected function processImport()
    {
        $total_rows = $this->getHighestRow();
        if (empty($this->header)) {
            $highestColumnIndex = $this->getHighestColumn(true);
        } else {
            $highestColumnIndex = count($this->header);
        }
        for ($row = 1; $row <= $total_rows; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $cell = $this->getCellByColAndRow($col, $row);
                $val = $cell->getValue();
                $this->collection[$row][$this->header[$col] ?? $col] = $val;
            }
        }
    }

    public function getobjExcel()
    {
        return $this->objExcel;
    }

    public function toArray()
    {
        return $this->collection;
    }

    public static function formatDate($value, $format = 'YYYY-MM-DD')
    {
        return PHPExcel_Style_NumberFormat::toFormattedString($value, $format);
    }
}
