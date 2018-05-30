<?php
return array(
    'router' => array(
        'routes' => array(
            'administrador' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/administrador[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller' => 'dashboard',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/administrador[:controller[/:action]]',
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
            'Administrador\Controller\Dashboard' => 'Administrador\Controller\DashboardAdministradorController',
            'Administrador\Controller\Campanha' => 'Administrador\Controller\CampanhaAdministradorController',
            'Administrador\Controller\tipomuda' => 'Administrador\Controller\MudaAdministradorController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view/',
        )
    ),
    'moduleLayouts' => array(
        'Administrador' => 'layout/layout-administrador'
    ),
    'doctrine' => array(
        'driver' => array(
            'administrador_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Administrador/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Administrador\Entity' => 'administrador_entities'
                ),
            ),
        )
    ),
);