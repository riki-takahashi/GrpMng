<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
        // MySQLi ドライバの設定
        'default' => array(
            'type'           => 'mysqli',
            'connection'     => array(
                'hostname'       => '127.0.0.1',
                'port'           => '3306',
                'database'       => 'grpmng',
                'username'       => 'root',
                'password'       => 'hIrO1030',
                'persistent'     => false,
                'compress'       => false,
            ),
            'identifier'     => '`',
            'table_prefix'   => '',
            'charset'        => 'utf8',
            'enable_cache'   => true,
            'profiling'      => false,
            'readonly'       => false,
        ),    
);


