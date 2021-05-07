<?php

namespace Neuffer\FileHandler;

/**
 *
 * Class AbstractAction
 */
abstract class AbstractAction
{
    protected $sourceFilePath;
    protected $logFilePath;
    protected $resultFilePath;

    private $resultBuffer = [];
    private $logBuffer = [];

    private $sourceFileResource = null;
    protected $actionName;

    /**
     * @param $sourceFilePath
     * @return $this
     */
    public function setSourceFilePath(string $sourceFilePath) :AbstractAction
    {
        $this->sourceFilePath = $sourceFilePath;
        return $this;
    }

    /**
     * @param $resultFilePath
     * @return $this
     */
    public function setResultFilePath(string $resultFilePath) : AbstractAction
    {
        $this->resultFilePath = $resultFilePath;
        return $this;
    }

    /**
     * @param $logFilePath
     * @return $this
     */
    public function setLogFilePath(string $logFilePath) : AbstractAction
    {
        $this->logFilePath = $logFilePath;
        return $this;
    }

    /**
     * execute operations
     *
     * @throws \Exception
     */
    public function execute() : void
    {
        $this->validateParams();
        $this->deleteLogFile();
        $this->deleteResultFile();
        $sourceFileResource = $this->getSourceFile();
        $this->pushLogBuffer(sprintf("Started %s operation", $this->actionName));
        while (($data = fgetcsv($sourceFileResource, 1000, ";"))) {
            $a = $this->prepareNumber($data[0]);
            $b = $this->prepareNumber($data[1]);
            if($this->isGood($a, $b)) {
                $result = $this->result($a, $b);
                $data = implode(";", [$a, $b, $result]) . "\r\n";
                $this->pushResultBuffer($data);

            } else {
                $this->wrongNumbers($a, $b);
            }
            $this->saveResult();
            $this->saveLog();
        }
        $this->pushLogBuffer(sprintf("Finish %s operation", $this->actionName));
        $this->saveResult();
        $this->saveLog();
    }

    /**
     * @throws \Exception
     */
    private function validateParams()
    {
        if (!$this->resultFileIsSet()) {
            throw new \Exception("Result file is not set");
        }

        if (!$this->logFileIsSet()) {
            throw new \Exception("Log file is not set");
        }

        if (!$this->sourceFileIsSet()) {
            throw new \Exception("Source file is not set");
        }
    }
    /**
     * @return bool
     */
    private function logFileIsSet() : bool
    {
        return !empty($this->logFilePath);
    }

    /**
     * @return bool
     */
    private function resultFileIsSet() : bool
    {
        return !empty($this->resultFilePath);
    }

    /**
     * @return bool
     */
    private function sourceFileIsSet() : bool
    {
        return !empty($this->resultFilePath);
    }

    /**
     * Delete log file if exists
     *
     */
    private function deleteLogFile() : void
    {
        if (file_exists($this->logFilePath)) {
            unlink($this->logFilePath);
        }
    }

    /**
     * Delete result file if exists
     *
     */
    private function deleteResultFile() : void
    {
        if (file_exists($this->resultFilePath)) {
            unlink($this->resultFilePath);
        }
    }

    /**
     * save result in file
     *
     * @param bool $append
     */
    protected function saveResult() : void
    {
        file_put_contents($this->resultFilePath, $this->resultBuffer, FILE_APPEND);
        $this->resultBuffer = [];
    }

    /**
     * save result in file
     *
     * @param bool $append
     */
    protected function saveLog() : void
    {
        file_put_contents($this->logFilePath, $this->logBuffer, FILE_APPEND);
        $this->logBuffer = [];
    }

    /**
     * Push data to temporary result buffer
     *
     * @param $data
     */
    protected function pushResultBuffer(string $data) : void
    {
        array_push($this->resultBuffer, $data);
    }

    /**
     * Push data to temporary log buffer
     *
     * @param $data
     */
    protected function pushLogBuffer($data) :void
    {
        array_push($this->logBuffer, $data);
    }

    /**
     * Open source file and return file point
     *
     * @return bool|resource|null
     * @throws \Exception
     */
    protected function getSourceFile()
    {
        if (!$this->sourceFileResource) {
            if (empty($this->sourceFilePath) || (!$this->sourceFileResource = fopen($this->sourceFilePath, 'r'))) {
                throw new \Exception("Can't open source file");
            }
        }
        return $this->sourceFileResource;
    }

    /**
     * prepare number before action
     * @param string $value
     * @return int
     */
    protected function prepareNumber($value) : int
    {
        $value = trim($value);
        $value = intval($value);
        return $value;
    }

    /**
     * @param $a
     * @param $b
     */
    public function wrongNumbers($a, $b) : void
    {
        $this->pushLogBuffer("numbers ".$a . " and ". $b." are wrong \r\n");
    }

    abstract protected function isGood(int $a, int $b);
    abstract protected function result(int $a, int $b);
}