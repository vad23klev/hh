<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
	'default' => array
	(
		// 'type'       => 'mysql',
		// 'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname     server hostname, or socket
			 * string   database     database name
			 * string   username     database username
			 * string   password     database password
			 * boolean  persistent   use persistent connections?
			 * array    variables    system variables as "key => value" pairs
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
	// 		'hostname'   => '127.0.0.1',//'localhost',
	// 		'database'   => 'infokwfm_faq',
	// 		'username'   => 'infokwfm_faq',
	// 		'password'   => '190976',
	// 		'persistent' => FALSE,
	// 	),
	// 	'table_prefix' => 'ss_',
	// 	'charset'      => 'utf8',
	// 	'caching'      => FALSE,
	// 	'profiling'    => TRUE,
	// ),
	// 'alternate' => array(
		'type'       => 'mysql',
		'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname     server hostname, or socket
			 * string   database     database name
			 * string   username     database username
			 * string   password     database password
			 * boolean  persistent   use persistent connections?
			 * array    variables    system variables as "key => value" pairs
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
			'hostname'   => 'bora.beget.ru',
			'database'   => 'infokwfm_faq',
			'username'   => 'infokwfm_faq',
			'password'   => 'rfN&t2Ql',
			'persistent' => FALSE,
		),
		'table_prefix' => 'ss_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
);
