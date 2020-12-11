<?php


namespace Application\src\models;

class Board
{

    private $numColumns;
    private $numRows;

    private $cells = [];

    public function __construct($rows, $columns)
    {
        $this->numColumns = $columns;
        $this->numRows = $rows;
    }

    /**
     * @return int
     */
    public function getNumColumns()
    {
        return $this->numColumns;
    }

    /**
     * @return int
     */
    public function getNumRows()
    {
        return $this->numRows;
    }

    /**
     * @return array
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @param Cell $cell
     * @param int $row
     * @param int $column
     * @throws \Exception
     */
    public function addCell(Cell $cell, $row, $column)
    {
        if ($row >= $this->getNumRows() || $column >= $this->getNumColumns()) {
            throw new \Exception("Posición fuera de tablero");
        }

        $this->cells[$row][$column] = $cell;
    }

    /**
     * @param int $row
     * @param int $column
     * @return Cell|null
     * @throws \Exception
     */
    public function getCell($row, $column)
    {
        if (!isset($this->cells[$row]) || !isset($this->cells[$row][$column])) {
            throw new \Exception("No existe la celda [$row, $column]");
        }

        return $this->cells[$row][$column];
    }

}