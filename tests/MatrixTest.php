<?php

use PHPUnit\Framework\TestCase;
use Zanderlewis\PhpMatrix\Matrix;

class MatrixTest extends TestCase
{
    public function testMatrixAddition()
    {
        $matrixA = new Matrix([[1, 2], [3, 4]]);
        $matrixB = new Matrix([[5, 6], [7, 8]]);
        $result = $matrixA->add($matrixB);

        $this->assertEquals([[6, 8], [10, 12]], $result->getData());
    }

    public function testMatrixSubtraction()
    {
        $matrixA = new Matrix([[1, 2], [3, 4]]);
        $matrixB = new Matrix([[5, 6], [7, 8]]);
        $result = $matrixA->subtract($matrixB);

        $this->assertEquals([[-4, -4], [-4, -4]], $result->getData());
    }

    public function testMatrixMultiplication()
    {
        $matrixA = new Matrix([[1, 2], [3, 4]]);
        $matrixB = new Matrix([[5, 6], [7, 8]]);
        $result = $matrixA->multiply($matrixB);

        $this->assertEquals([[19, 22], [43, 50]], $result->getData());
    }

    public function testMatrixDivision()
    {
        $matrixA = new Matrix([[10, 20], [20, 10]]);
        $matrixB = new Matrix([[2, 4], [4, 2]]);
        $result = $matrixA->divide($matrixB);

        $this->assertEquals([[5, 5], [5, 5]], $result->getData());
    }
}