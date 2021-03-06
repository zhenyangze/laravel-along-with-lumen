<?php

use Swoole\Table;

return [
    /*
    |--------------------------------------------------------------------------
    | HTTP server configurations.
    |--------------------------------------------------------------------------
    |
    | @see https://www.swoole.co.uk/docs/modules/swoole-server/configuration
    |
    */
    'server' => [
        'host' => env('SWOOLE_HTTP_HOST', '127.0.0.1'),
        'port' => env('SWOOLE_LUMEN_PORT', '1216'),
        'public_path' => base_path('public'),
        // Determine if to use swoole to respond request for static files
        'handle_static_files' => env('SWOOLE_HANDLE_STATIC', true),
        // You must add --enable-openssl while compiling Swoole
        // Put `SWOOLE_SOCK_TCP | SWOOLE_SSL` if you want to enable SSL
        'socket_type' => SWOOLE_SOCK_TCP,
        'options' => [
            'pid_file' => env('SWOOLE_HTTP_PID_FILE', base_path('storage/logs/swoole_lumen.pid')),
            'log_file' => env('SWOOLE_HTTP_LOG_FILE', base_path('storage/logs/swoole_lumen.log')),
            'daemonize' => env('SWOOLE_HTTP_DAEMONIZE', false),
            // Normally this value should be 1~4 times larger according to your cpu cores.
            'reactor_num' => env('SWOOLE_HTTP_REACTOR_NUM', swoole_cpu_num()),
            'worker_num' => env('SWOOLE_HTTP_WORKER_NUM', swoole_cpu_num()),
            'task_worker_num' => env('SWOOLE_HTTP_TASK_WORKER_NUM', swoole_cpu_num()),
            // The data to receive can't be larger than buffer_output_size.
            'package_max_length' => 20 * 1024 * 1024,
            // The data to send can't be larger than buffer_output_size.
            'buffer_output_size' => 10 * 1024 * 1024,
            // Max buffer size for socket connections
            'socket_buffer_size' => 128 * 1024 * 1024,
            // Worker will restart after processing this number of requests
            'max_request' => 3000,
            // Enable coroutine send
            'send_yield' => true,
            // You must add --enable-openssl while compiling Swoole
            'ssl_cert_file' => null,
            'ssl_key_file' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Enable to turn on websocket server.
    |--------------------------------------------------------------------------
    */
    'websocket' => [
        'enabled' => env('SWOOLE_HTTP_WEBSOCKET', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Console output will be transferred to response content if enabled.
    |--------------------------------------------------------------------------
    */
    'ob_output' => env('SWOOLE_OB_OUTPUT', true),

    /*
    |--------------------------------------------------------------------------
    | Pre-resolved instances here will be resolved when sandbox created.
    |--------------------------------------------------------------------------
    */
    'pre_resolved' => [
        'view', 'files', 'session', 'session.store', 'routes',
        'db', 'db.factory', 'cache', 'cache.store', 'config', 'cookie',
        'encrypter', 'hash', 'router', 'translator', 'url', 'log',
    ],

    /*
    |--------------------------------------------------------------------------
    | Instances here will be cleared on every request.
    |--------------------------------------------------------------------------
    */
    'instances' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Providers here will be registered on every request.
    |--------------------------------------------------------------------------
    */
    'providers' => [
        Illuminate\Pagination\PaginationServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetters for sandbox app.
    |--------------------------------------------------------------------------
    */
    'resetters' => [
        Lamen\Http\Server\Resetters\ResetConfig::class,
        Lamen\Http\Server\Resetters\ResetSession::class,
        Lamen\Http\Server\Resetters\ResetCookie::class,
        Lamen\Http\Server\Resetters\ClearInstances::class,
        Lamen\Http\Server\Resetters\BindRequest::class,
        Lamen\Http\Server\Resetters\RebindKernelContainer::class,
        Lamen\Http\Server\Resetters\RebindRouterContainer::class,
        Lamen\Http\Server\Resetters\RebindViewContainer::class,
        Lamen\Http\Server\Resetters\ResetProviders::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Define your swoole tables here.
    |
    | @see https://www.swoole.co.uk/docs/modules/swoole-table
    |--------------------------------------------------------------------------
    */
    'tables' => [
        // 'table_name' => [
        //     'size' => 1024,
        //     'columns' => [
        //         ['name' => 'column_name', 'type' => Table::TYPE_STRING, 'size' => 1024],
        //     ]
        // ],
    ]
];
