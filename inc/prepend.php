<?php
// currently not supported
if (php_sapi_name() !== 'cli' && function_exists('xhprof_enable'))
	xhprof_enable(XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_CPU);