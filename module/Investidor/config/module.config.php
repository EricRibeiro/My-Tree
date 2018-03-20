<?php
return array(
    'router' => array(
        'routes' => array(
            'investidor' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/investidor[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Investidor\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/investidor[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Investidor\Controller\Cadastro' => 'Investidor\Controller\InvestidorController',
            'Investidor\Controller\Dashboard' => 'Investidor\Controller\DashboardInvestidorController',
            'Investidor\Controller\Mapa' => 'Investidor\Controller\MapaInvestidorController',
            'Investidor\Controller\Perfil' => 'Investidor\Controller\PerfilInvestidorController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view/',
        )
    ),
    'moduleLayouts' => array(
        'Investidor' => 'layout/layout-investidor'
    ),

    'doctrine' => array(
        'driver' => array(
            'investidor_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Investidor/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Investidor\Entity' => 'investidor_entities'
                ),
            ),
        ),
    ),
);