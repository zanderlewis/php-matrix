<?php
namespace Zanderlewis\PhpMatrix;

use Zanderlewis\PhpMatrix\MatrixException;
use Zanderlewis\PhpMatrix\MatrixArithmetic;

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

    public function add(Matrix $matrix): Matrix
    {
        $matrixArithmetic = new MatrixArithmetic();
        return $matrixArithmetic->add($this, $matrix);
    }

    public function subtract(Matrix $matrix): Matrix
    {
        $matrixArithmetic = new MatrixArithmetic();
        return $matrixArithmetic->subtract($this, $matrix);
    }

    public function multiply(Matrix $matrix): Matrix
    {
        $matrixArithmetic = new MatrixArithmetic();
        return $matrixArithmetic->multiply($this, $matrix);
    }

    public function divide(Matrix $matrix): Matrix
    {
        $matrixArithmetic = new MatrixArithmetic();
        return $matrixArithmetic->divide($this, $matrix);
    }
}