<?php
register_shutdown_function( function () {
        // CLI environment is currently not supported
        if (php_sapi_name() == 'cli' || !function_exists('xhprof_disable')) {
                return;
        }
        $v=xhprof_disable();
        if (!is_array($v)) {
                return;
        }
        if (function_exists('fastcgi_finish_request')) {
                fastcgi_finish_request();
        }
        // by registering register_shutdown_function at the end of the file
        // I make sure that all execution data, including that of the earlier
        // registered register_shutdown_function, is collected.

        $config = require __DIR__ . '/../xhprof/includes/config.inc.php';
        require_once __DIR__ . '/../xhprof/classes/data.php';
        $xhprof_data_obj = new \ay\xhprof\Data($config['pdo']);
        $xhprof_data_obj->save($v);
});
