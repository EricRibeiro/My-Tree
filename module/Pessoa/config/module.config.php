<?php
return array(
    'router' => array(
        'routes' => array(
            'pessoa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/pessoa[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Pessoa\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/pessoa[:controller[/:action]]',
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
            'Pessoa\Controller\Cadastro-Pessoa' => 'Pessoa\Controller\CadastroPessoaController',
            'Pessoa\Controller\Dashboard' => 'Pessoa\Controller\DashboardController',
            'Pessoa\Controller\Mapa' => 'Pessoa\Controller\MapaController',
            'Pessoa\Controller\Perfil' => 'Pessoa\Controller\PerfilController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view/',
        )
    ),
    'moduleLayouts' => array(
        'Pessoa' => 'layout/layout-pessoa'
    ),
    'doctrine' => array(
        'driver' => array(
            'pessoa_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Pessoa/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Pessoa\Entity' => 'pessoa_entities'
                ),
            ),
        ),
    ),
);