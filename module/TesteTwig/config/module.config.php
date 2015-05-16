<?php
return array(
    'router' => array(
        'routes' => array(
            'twig' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
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
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'TesteTwig\Controller\Index' => 'TesteTwig\Controller\IndexController'
        ),
    ),
    'zfctwig' => array(
        /**
         * Service manager alias of the loader to use with ZfcTwig. By default, it uses
         * the included ZfcTwigLoaderChain which includes a copy of ZF2's TemplateMap and
         * TemplatePathStack.
         */
        'environment_loader' => 'ZfcTwigLoaderChain',
        
        /**
         * Optional class name override for instantiating the Twig Environment in the factory.
         */
        'environment_class' => 'Twig_Environment',
        
        /**
         * Options that are passed directly to the Twig_Environment.
         */
        'environment_options' => array(),
        
        /**
         * Service manager alias of any additional loaders to register with the chain. The default
         * has the TemplateMap and TemplatePathStack registered. This setting only has an effect
         * if the `environment_loader` key above is set to ZfcTwigLoaderChain.
         */
        'loader_chain' => array(
            'ZfcTwigLoaderTemplateMap',
            'ZfcTwigLoaderTemplatePathStack'
        ),
        
        /**
         * Service manager alias or fully qualified domain name of extensions. ZfcTwigExtension
         * is required for this module to function!
         */
        'extensions' => array(
            'zfctwig' => 'ZfcTwigExtension'
        ),
        
        /**
         * The suffix of Twig files. Technically, Twig can load *any* type of file
         * but the templates in ZF are suffix agnostic so we must specify the extension
         * that's expected here.
         */
        'suffix' => 'twig',
        
        /**
         * When enabled, the ZF2 view helpers will get pulled using a fallback renderer. This will
         * slightly degrade performance but must be used if you plan on using any of ZF2's view helpers.
         */
        'enable_fallback_functions' => true,
    
        /**
         * If set to true disables ZF's notion of parent/child layouts in favor of
         * Twig's inheritance model.
         */
        'disable_zf_model' => true,
    
        /**
         * ZfcTwig uses it's own HelperPluginManager to avoid renderer conflicts with the PhpRenderer. You must register
         * any view helpers in this array that require access to the renderer. The defaults from ZF2 (navigation,
         * partial, etc.) are done for you.
         */
        'helper_manager' => array(
            'configs' => array(
                'Zend\Navigation\View\HelperConfig'
            )
        )
    ),
    'view_manager' => array(
        'strategies' => array('ZfcTwigViewStrategy'),
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/teste-twig/layout/layout.twig',
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