<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'market-index-controller' => 'Market\Controller\IndexController',
			'market-view-controller' => 'Market\Controller\ViewController' 
		),
		'factories' => array(
			'market-post-controller' => 'Market\Factory\PostControllerFactory' 
		),
		'aliases' => array(
			'alt' => 'market-view-controller' 
		) 
	),
	'router' => array(
		'routes' => array(
			'home' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/',
					'defaults' => array(
						'controller' => 'market-index-controller',
						'action' => 'index' 
					) 
				) 
			),
			'market' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/market[/]',
					'defaults' => array(
						'controller' => 'market-index-controller',
						'action' => 'index' 
					) 
				),
				
				'may_terminate' => true,
				'child_routes' => array(
					'view' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => 'view[/]',
							'defaults' => array(
								'controller' => 'market-view-controller',
								'action' => 'index' 
							) 
						),
						'may_terminate' => true,
						'child_routes' => array(
							'main' => array(
								'type' => 'Segment',
								'options' => array(
									'route' => 'main[/:category][/]',
									'defaults' => array(
										'action' => 'index' 
									) 
								) 
							),
							'item' => array(
								'type' => 'Segment',
								'options' => array(
									'route' => 'item[/:itemId][/]',
									'defaults' => array(
										'action' => 'item' 
									),
									'constraints' => array(
										'itemId' => '[0-9]*' 
									) 
								) 
							) 
						) 
					),
					'post' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => 'post[/]',
							'defaults' => array(
								'controller' => 'market-post-controller',
								'action' => 'index' 
							) 
						) 
					) 
				) 
			)
		)         
	),
	'service_manager' => array(
		'factories' => array(
			'market-post-form' => 'Market\Factory\PostFormFactory',
			'market-post-filter' => 'Market\Factory\PostFormFilterFactory' 
		),
		'services' => array(
			'minhas-opcoes-captcha' => array(
				'imgdir' => './public/images/captcha',
				'imgDelete' => true,
				'imgurl' => '/public/images/captcha',
				'font' => './data/fonts/arial.ttf',
				'fontSize' => 50,
				'height' => 100,
				'width' => 200,
				'dotNoiseLevel' => 40,
				'lineNoiseLevel' => 3
			)
		)
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'Market' => __DIR__ . '/../view' 
		),
		'template_map' => array() 
	),
    'asset_bundle' => array(
    	'production' => false, // Application environment (Developpement => false)
    	'lastModifiedTime' => null, // Arbitrary last modified time in production
    	'cachePath' => '@zfRootPath/public/cache', // Cache directory absolute path
    	'assetsPath' => '@zfRootPath/public', // Assets directory absolute path (allows you to define relative path for assets config)
    	'tmpDirPath' => sys_get_temp_dir(), // Temp directory absolute path
    	'processedDirPath' => '@zfRootPath/data/AssetsBundle/processed', // Processed files directory absolute path
    	'baseUrl' => '@zfBaseUrl', // Base URL of the application
    	'cacheUrl' => '@zfBaseUrl/cache/', // Cache directory base url
    	'mediaExt' => array('jpeg', 'jpg', 'png', 'gif', 'cur', 'ttf', 'eot', 'svg', 'woff'), // Put here all media extensions to be cached
    	'recursiveSearch' => false, // Allows search for matching assets in required folder and its subfolders
		'assets' => array(
			
			'less' => array('@zfRootPath/vendor/twbs/bootstrap/less/bootstrap.less'),
//			'css' => array('css'),
//			'js' => array(
//				'js/jquery.min.js',
//				'js/bootstrap.min.js'
//			),
//			'media' => array('img','fonts')
         )
     ),
);
