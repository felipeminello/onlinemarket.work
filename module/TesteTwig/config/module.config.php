<?php
return array(
    'router' => array(
        'routes' => array(
            'twig' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/twig',
                    'defaults' => array(
                        'controller' => 'TesteTwig\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'TesteTwig\Controller\Index' => 'TesteTwig\Controller\IndexController'
        ),
    ),
    'module_layouts' => array(
        'TesteTwig' => 'layout/twig',
    ),
    'view_manager' => array(
        'strategies' => array('ZfcTwigViewStrategy'),
        'template_map' => array(
            'layout/twig'           => __DIR__ . '/../view/teste-twig/layout/twig.twig',
            'teste-twig/index/index' => __DIR__ . '/../view/teste-twig/index/index.twig',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    )
);