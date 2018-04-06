<?php
return array(
    'router' => array(
        'routes' => array(
            'plantador' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/plantador[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Plantador\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/plantador[:controller[/:action]]',
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
            'Plantador\Controller\Cadastro' => 'Plantador\Controller\PlantadorController',
            'Plantador\Controller\Dashboard' => 'Plantador\Controller\DashboardPlantadorController',
            'Plantador\Controller\Mapa' => 'Plantador\Controller\MapaPlantadorController',
            'Plantador\Controller\Perfil' => 'Plantador\Controller\PerfilPlantadorController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view/',
        )
    ),
    'moduleLayouts' => array(
        'Plantador' => 'layout/layout-plantador'
    ),
    'doctrine' => array(
        'driver' => array(
            'plantador_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Plantador/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Plantador\Entity' => 'plantador_entities'
                ),
            ),
        )
    ),
);