<?php

// module/StickyNotes/config/module.config.php:
return array(
	'db' => array(
		'driver'         => 'Pdo',
		'dsn'            => 'mysql:dbname=onlinemarket.work;host=localhost',
		'driver_options' => array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
		),
	),
	'service_manager' => array(
		'factories' => array(
			'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
		),
	),
	
    'controllers' => array(
        'invokables' => array(
            'sticky-notes-controller' => 'StickyNotes\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'stickynotes' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/stickynotes[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'sticky-notes-controller',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
	'module_layouts' => array(
		'StickyNotes' => 'layout/sticky-notes',
	),
	'view_manager' => array(
		'template_map' => array(
			'layout/sticky-notes'           => __DIR__ . '/../view/sticky-notes/layout/layout.phtml',
			'sticky-notes/index/index' => __DIR__ . '/../view/sticky-notes/index/index.phtml',
		),
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
);
