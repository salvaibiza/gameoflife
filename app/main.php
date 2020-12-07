<?php

namespace Application;

require __DIR__ . '/../vendor/autoload.php';


use Application\src\GameOfLife;
use Application\src\helpers\BoardGenerator;


class Play {

    private $helpText = "Options:
            -c\t number of columns (required)
            -r\t number of rows (required)\n
    Example: \e[0;32m php main.php -c 4 -r 5\e[0m\n";


    public function start()
    {
        $options = getopt('c:r:');
        if ($error = $this->validateInput($options)) {
            echo $error;
            return;
        }

        $generator = new BoardGenerator();
        $board = $generator->generateRandomInitialBoard($options['r'], $options['c']);

        $gameOfLife = new GameOfLife($board);

        $handle = fopen ("php://stdin","r");
        while(1) {
            echo "Run next generation (yes/no)?\n";
            $line = fgets($handle);
            if (trim($line) != 'yes'){
                fclose($handle);
                exit;
            }
            $gameOfLife->nextGen();
        }

    }

    /**
     * @param array $options
     * @return bool|string
     */
    private function validateInput(array $options)
    {
        $hasErrors = false;
        if (!$options) {
            $hasErrors = $this->helpText;
        }

        if (!$hasErrors &&
            (!isset($options['c']) || !isset($options['r']) || !$options['c'] || !$options['r']
                || !is_numeric($options['c']) || !is_numeric($options['r']))) {
            $hasErrors = "\033[0;31mError: required numeric values for rows (-r) and columns (-c) \033[0m";
        }
        return $hasErrors;
    }
}

(new Play())->start();