<?php

namespace Actor\Library;

use Exception;

/**
 * Class Logger
 * Can be set with static calls
 * @package Actor\Library
 */
class Logger
{
    private $resultHandler;
    private $logHandler;
    private const LOG_FILE = "log.txt"; // those file path could be set on logger start
    private const RESULT_FILE = "result.csv"; // for simplicity I left them as is

    /**
     * Logger constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->prepareFiles();
        $this->prepareHandlers();
    }

    /**
     * destructor
     */
    public function __destruct()
    {
        $this->closeHandlers();
    }

    /**
     * write in logs if numbers give wrong result
     * @param int $value1
     * @param int $value2
     * @throws Exception
     */
    public function wrongResultLog(int $value1, int $value2): void
    {
        $message = "numbers " . $value1 . " and " . $value2 . " are wrong";
        $this->logInfo($message);
    }

    /**
     * write in logs if numbers give wrong result
     * @param int $value1
     * @param int $value2
     * @throws Exception
     */
    public function wrongDivisionLog(int $value1, int $value2): void
    {
        $message = "numbers " . $value1 . " and " . $value2 . " are wrong, is not allowed";
        $this->logInfo($message);
    }


    /**
     * check and delete main files before execution
     */
    private function prepareFiles(): void
    {
        //delete log file if it is already exists
        if ($this->isLogFileExists()) {
            unlink(self::LOG_FILE);
        }

        //delete result file if it already exists
        if ($this->isResultFileExists()) {
            unlink(self::RESULT_FILE);
        }
    }


    /**
     * check if result file already exists
     * @return bool
     */
    private function isResultFileExists(): bool
    {
        return file_exists(self::RESULT_FILE);
    }

    /**
     * @return bool
     */
    private function isLogFileExists(): bool
    {
        return file_exists(self::LOG_FILE);
    }

    /**
     * write messages in log file
     * @param string $message
     * @throws Exception
     */
    public function logInfo(string $message): void
    {
        $message = $message . "\r\n";
        fwrite($this->logHandler, $message);
    }

    /**
     * write message in result file
     * @param string $message
     */
    private function successInfo(string $message): void
    {
        $message = $message . "\r\n";
        fwrite($this->resultHandler, $message);
    }

    /**
     * prepare info and save it in result file
     * @param int $value1
     * @param int $value2
     * @param mixed $result
     */
    public function writeSuccessResult(int $value1, int $value2, $result): void
    {
        $message = implode(";", [$value1, $value2, $result]);
        $this->successInfo($message);
    }

    /**
     * prepare handlers to writing
     * @throws Exception
     */
    private function prepareHandlers(): void
    {
        $this->logHandler = fopen(self::LOG_FILE, "a+");

        if ($this->logHandler === false) {
            throw new Exception("Log File cannot be open for writing");
        }

        $this->resultHandler = fopen(self::RESULT_FILE, "a+");

        if ($this->resultHandler === false) {
            throw new Exception("Result File cannot be open for writing");
        }
    }

    /**
     * close opened handlers
     */
    private function closeHandlers(): void
    {
        fclose($this->logHandler);
        fclose($this->resultHandler);
    }
}