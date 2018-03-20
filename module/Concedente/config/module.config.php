<?php
return array(
    'router' => array(
        'routes' => array(
            'concedente' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/concedente[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Concedente\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/concedente[:controller[/:action]]',
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
            'Concedente\Controller\Cadastro-Concedente' => 'Concedente\Controller\ConcedenteController',
            'Concedente\Controller\Dashboard' => 'Concedente\Controller\DashboardController',
            'Concedente\Controller\Mapa' => 'Concedente\Controller\MapaController',
            'Concedente\Controller\Perfil' => 'Concedente\Controller\PerfilController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view/',
        )
    ),
    'moduleLayouts' => array(
        'Concedente' => 'layout/layout-concedente'
    ),
    'doctrine' => array(
        'driver' => array(
            'concedente_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Concedente/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Concedente\Entity' => 'concedente_entities'
                ),
            ),
        )
    ),
);