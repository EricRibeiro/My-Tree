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
        'Investidor\Controller\Dashboard' => 'Investidor\Controller\DashboardController',
            'Investidor\Controller\Perfil' => 'Investidor\Controller\PerfilController',
            'Investidor\Controller\Mapa' => 'Investidor\Controller\MapaController',
           'Application\Controller\cadastro-investidor' => 'Investidor\Controller\CadastroInvestidorController',

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
            'application_entities' => array(
              'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
              'paths' => array(__DIR__ . '/../src/Investidor/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Investidor\Entity' => 'application_entities'
                ),
            ),
        ),
      ),


);