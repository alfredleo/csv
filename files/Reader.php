<?php

namespace Actor\Library;

use DivisionByZeroError;
use Exception;

class Reader
{
    private $file = null;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * main function, execute main code
     * @throws Exception
     */
    public function execute(Action $action): void
    {
        $logger = new Logger(); // DI later
        $this->validateResourceFile();

        $logger->logInfo("Started $action->name operation");

        $handle = fopen($this->getFile(), 'r');
        while (($line = fgetcsv($handle)) !== FALSE) {
            list($value1, $value2) = $this->prepareValues($line[0]);

            try {
                $result = $action->getResult($value1, $value2);
                if ($this->isResultValid($result)) {
                    $logger->writeSuccessResult($value1, $value2, $result);
                } else {
                    $logger->wrongResultLog($value1, $value2);
                }
            } catch (DivisionByZeroError $e) {
                $logger->wrongDivisionLog($value1, $value2);
            }

        }

        $logger->logInfo("Finished $action->name operation");
    }

    /**
     * @return void
     * @throws Exception
     */
    public function validateResourceFile(): void
    {
        if ($this->getFile() === null || !file_exists($this->getFile())) {
            throw new Exception("Please define file with data");
        }

        if (!is_readable($this->getFile())) {
            throw new Exception("We have not rights to read this file");
        }
    }

    /**
     * prepare numbers before action, explode it from csv string
     * @param string $line
     * @return array
     */
    public function prepareValues(string $line): array
    {
        $line = explode(";", $line);
        $value1 = $this->prepareNumber($line[0]);
        $value2 = $this->prepareNumber($line[1]);
        return [$value1, $value2];
    }


    /**
     * prepare number before action
     * @param string $value
     * @return int
     */
    private function prepareNumber(string $value): int
    {
        // remove \ufeff BOM character, no correct mb_trim function for that
        $value = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', ($value));
        return intval(trim($value));
    }

    /**
     * validate if result is valid
     * @param mixed $result
     * @return bool
     */
    private function isResultValid($result): bool
    {
        if ($result > 0)
            return true;

        return false;
    }

}