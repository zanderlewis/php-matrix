<?php
namespace Zanderlewis\PhpMatrix;

use Zanderlewis\PhpMatrix\Helpers\BigNumber;
use Zanderlewis\PhpMatrix\Exceptions\MatrixException;

class Matrix
{
    private array $data;
    private int $rows;
    private int $columns;

    public function __construct(array $data)
    {
        $this->validateMatrix($data);
        $this->data = $data;
        $this->rows = count($data);
        $this->columns = count($data[0]);
    }

    private function validateMatrix(array $data): void
    {
        $columnCount = count($data[0]);
        foreach ($data as $row) {
            if (count($row) !== $columnCount) {
                throw new MatrixException('All rows in the matrix must have the same number of columns.');
            }
        }
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function add(Matrix $other): Matrix
    {
        if ($this->rows !== $other->getRows() || $this->columns !== $other->getColumns()) {
            throw new MatrixException('Matrices must have the same dimensions for addition.');
        }
        $result = [];
        for ($i = 0; $i < $this->rows; $i++) {
            $row = [];
            for ($j = 0; $j < $this->columns; $j++) {
                $sum = BigNumber::add($this->data[$i][$j], $other->getData()[$i][$j]);
                $row[] = $sum;
            }
            $result[] = $row;
        }
        return new Matrix($result);
    }

    public function subtract(Matrix $other): Matrix
    {
        if ($this->rows !== $other->getRows() || $this->columns !== $other->getColumns()) {
            throw new MatrixException('Matrices must have the same dimensions for subtraction.');
        }
        $result = [];
        for ($i = 0; $i < $this->rows; $i++) {
            $row = [];
            for ($j = 0; $j < $this->columns; $j++) {
                $difference = BigNumber::subtract($this->data[$i][$j], $other->getData()[$i][$j]);
                $row[] = $difference;
            }
            $result[] = $row;
        }
        return new Matrix($result);
    }

    public function multiply(Matrix $other): Matrix
    {
        if ($this->columns !== $other->getRows()) {
            throw new MatrixException('The number of columns in the first matrix must match the number of rows in the second matrix for multiplication.');
        }
        $result = [];
        for ($i = 0; $i < $this->rows; $i++) {
            $row = [];
            for ($j = 0; $j < $other->getColumns(); $j++) {
                $product = '0';
                for ($k = 0; $k < $this->columns; $k++) {
                    $product = BigNumber::add($product, BigNumber::multiply($this->data[$i][$k], $other->getData()[$k][$j]));
                }
                $row[] = $product;
            }
            $result[] = $row;
        }
        return new Matrix($result);
    }

    public function divide(Matrix $other): Matrix
    {
        if ($this->rows !== $other->getRows() || $this->columns !== $other->getColumns()) {
            throw new MatrixException('Matrices must have the same dimensions for division.');
        }
        $result = [];
        for ($i = 0; $i < $this->rows; $i++) {
            $row = [];
            for ($j = 0; $j < $this->columns; $j++) {
                if ($other->getData()[$i][$j] == '0') {
                    throw new MatrixException('Division by zero in matrix element.');
                }
                $quotient = BigNumber::divide($this->data[$i][$j], $other->getData()[$i][$j]);
                $row[] = $quotient;
            }
            $result[] = $row;
        }
        return new Matrix($result);
    }
}