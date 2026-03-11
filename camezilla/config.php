<?php
use Camezilla\Models\Config;

function init_config(): void {
    $GLOBALS['config'] = Config::load(__DIR__ . '/../camezilla.config.json');
}

function get_config(): Config {
    if ($GLOBALS['config'] === null) {
        throw new Exception("Config not initialized");
    }
    
    return $GLOBALS['config'];
}