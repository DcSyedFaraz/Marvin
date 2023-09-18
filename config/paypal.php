<?php 
return [ 
    'client_id' => 'AYlp5qIwDbFMgWP1zlYES0h3mvxYkQFKWAht26vkJd6BeK1kiN39HxcYevn03HA5H3dWdQC4ZyYGLk6j',
	'secret' => 'EJ_hmKgf9UuS38YCEyCN10NF2FLPVz8DIB1sjMBShuMG_cHH4yaZpTvA0LpUFFzBi4-hHzhKUZS7KCQw',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];