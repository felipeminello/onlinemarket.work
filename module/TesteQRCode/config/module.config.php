<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'qrcode-index-controller' => 'TesteQRCode\Controller\IndexController',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'QrCodeService' => 'Acelaya\QrCode\Service\QrCodeService',
        ),
    ),
    'router' => array(
        'routes' => array(
            'qrcode' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/qrcode',
                    'defaults' => array(
                        'controller' => 'qrcode-index-controller',
                        'action' => 'index'
                    )
                )
            ),            
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'TesteQRCode' => __DIR__ . '/../view'
        ),
    )
);
