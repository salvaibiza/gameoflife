<?php


namespace Application\src\models;


class Cell
{
    const ALIVE_CELL = 1;
    const DEAD_CELL = 0;

    private $state = self::DEAD_CELL;

    public function __construct($state)
    {
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return bool
     */
    public function isAlive()
    {
        return $this->getState() == self::ALIVE_CELL;
    }

    /**
     * @return bool
     */
    public function isDead()
    {
        return $this->getState() == self::DEAD_CELL;
    }
}