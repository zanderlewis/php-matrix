<?php
namespace Zanderlewis\PhpMatrix;

use Zanderlewis\PhpMatrix\Helpers\BigNumber;
use Zanderlewis\PhpMatrix\MatrixException;

class MatrixArithmetic
{
    public function add(Matrix $a, Matrix $b): Matrix
    {
        if ($a->getRows() !== $b->getRows() || $a->getColumns() !== $b->getColumns()) {
            throw new MatrixException('Matrices must have the same dimensions for addition.');
        }
        $result = [];
        for ($i = 0; $i < $a->getRows(); $i++) {
            $row = [];
            for ($j = 0; $j < $a->getColumns(); $j++) {
                $sum = BigNumber::add($a->getData()[$i][$j], $b->getData()[$i][$j]);
                $row[] = $sum;
            }
            $result[] = $row;
        }
        return new Matrix($result);
    }

    public function subtract(Matrix $a, Matrix $b): Matrix
    {
        if ($a->getRows() !== $b->getRows() || $a->getColumns() !== $b->getColumns()) {
            throw new MatrixException('Matrices must have the same dimensions for subtraction.');
        }
        $result = [];
        for ($i = 0; $i < $a->getRows(); $i++) {
            $row = [];
            for ($j = 0; $j < $a->getColumns(); $j++) {
                $difference = BigNumber::subtract($a->getData()[$i][$j], $b->getData()[$i][$j]);
                $row[] = $difference;
            }
            $result[] = $row;
        }
        return new Matrix($result);
    }

    public function multiply(Matrix $a, Matrix $b): Matrix
    {
        if ($a->getColumns() !== $b->getRows()) {
            throw new MatrixException('Matrix A\'s column count must match Matrix B\'s row count for multiplication.');
        }
        $result = [];
        for ($i = 0; $i < $a->getRows(); $i++) {
            $row = [];
            for ($j = 0; $j < $b->getColumns(); $j++) {
                $sum = '0';
                for ($k = 0; $k < $a->getColumns(); $k++) {
                    $product = BigNumber::multiply($a->getData()[$i][$k], $b->getData()[$k][$j]);
                    $sum = BigNumber::add($sum, $product);
                }
                $row[] = $sum;
            }
            $result[] = $row;
        }
        return new Matrix($result);
    }

    public function divide(Matrix $matrixA, Matrix $matrixB): Matrix
    {
        $rows = $matrixA->getRows();
        $columns = $matrixA->getColumns();
        $result = [];

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $result[$i][$j] = BigNumber::divide(
                    (string)$matrixA->getData()[$i][$j],
                    (string)$matrixB->getData()[$i][$j]
                );
            }
        }

        return new Matrix($result);
    }
}