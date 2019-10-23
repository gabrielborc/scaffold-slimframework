<?php

namespace App\Config;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class HandlerLog
{   
    private $pathLog;
    private $log;

    public function __construct() {
        $this->log = new Logger('access');
        $this->pathLog = __DIR__ . "/../../logs/";
    }

    public function registerLog($description, $logData='') {
        $this->createFileLog();
        $this->log->info($description, $logData);
    }

    private function createFileLog() {
        $now = new \DateTime();
        $pathFileLog = $this->pathLog . 'access_' . $now->format('d_m_Y__H') . '.txt';
        $this->log->pushHandler(new StreamHandler($pathFileLog, Logger::DEBUG));
    }
}