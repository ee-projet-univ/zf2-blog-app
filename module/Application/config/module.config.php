<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:page]',
                    'constraints' => array(
                        'page' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/app',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'search' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/app/search[/:tag]',
                    'constraints' => array(
                        'tag' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Search',
                        'action' => 'index',
                    ),
                ),
            ),
            'post-view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/post/view[/:pid[/:page]]',
                    'constraints' => array(
                        'pid' => '[0-9]*',
                        'page' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Post',
                        'action' => 'view',
                    ),
                ),
            ),
            'post-crud' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/post[/:action[/:pid[/:sur]]]',
                    'constraints' => array(
                        'action' => '(create|update|delete)',
                        'pid' => '[0-9]*',
                        'sur' => '(0|1)'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Post',
                        'action' => 'create',
                    ),
                ),
            ),
            'comm-create' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/comm/create[/:pid]',
                    'constraints' => array(
                        'pid' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Comment',
                        'action' => 'create',
                    ),
                ),
            ),
            'comm-ud' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/comm[/:action[/:cid[/:sur]]]',
                    'constraints' => array(
                        'action' => '(update|delete)',
                        'cid' => '[0-9]*',
                        'sur' => '(0|1)'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Comment',
                        'action' => 'update',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
            'zfcuser_doctrine_em' => 'Doctrine\ORM\EntityManager'
        ),
        'factories' => array(
            // Form
            'CommentForm' => 'Application\Factory\Form\CommentFormFactory',
            'PostForm' => 'Application\Factory\Form\PostFormFactory',
            // Services
            'PostService' => 'Application\Factory\PostServiceFactory',
            'TagService' => 'Application\Factory\TagServiceFactory',
            'UserService' => 'Application\Factory\UserServiceFactory',
            // Repository
            'PostRepository' => 'Application\Factory\PostRepositoryFactory',
            'TagRepository' => 'Application\Factory\TagRepositoryFactory',
            'UserRepository' => 'Application\Factory\UserRepositoryFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Search' => 'Application\Controller\SearchController',
            'Application\Controller\Post' => 'Application\Controller\PostController',
            'Application\Controller\Comment' => 'Application\Controller\CommentController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'app/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'app/search/index' => __DIR__ . '/../view/application/search/index.phtml',
            'post/view' => __DIR__ . '/../view/application/post/view.phtml',
            'post/create' => __DIR__ . '/../view/application/post/create.phtml',
            'post/update' => __DIR__ . '/../view/application/post/update.phtml',
            'post/delete' => __DIR__ . '/../view/application/post/delete.phtml',
            'comm/create' => __DIR__ . '/../view/application/comm/create.phtml',
            'comm/update' => __DIR__ . '/../view/application/comm/update.phtml',
            'comm/delete' => __DIR__ . '/../view/application/comm/delete.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
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
    ),
    'doctrine' => array(
        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/Application/Entity',
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'zfcuser_entity',
                ),
            ),
        ),
    ),
    'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class' => 'Application\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
    ),
    
    'bjyauthorize' => array(
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        'role_providers' => array(

            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'Application\Entity\Role',
            ),   
        ),
    
        'guards' => array(
            'BjyAuthorize\Guard\Controller' => array(
                array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'index',
                    'roles' => array('guest', 'user')
                ),
                array(
                    'controller' => 'Application\Controller\Post',
                    'action' => 'view',
                    'roles' => array('guest', 'user')
                ),
                array(
                    'controller' => 'Application\Controller\Post',
                    'action' => array('create', 'update', 'delete'),
                    'roles' =>  'user'
                ),
                array(
                    'controller' => 'Application\Controller\Comment',
                    'action' => array('create', 'update', 'delete'),
                    'roles' =>  'user'
                ),
                array(
                    'controller' => 'Application\Controller\Search',
                    'action' => 'index',
                    'roles' =>  array('guest', 'user')
                ),
                array('controller' => 'zfcuser', 'roles' => array()),
            ),

            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'zfcuser', 'roles' => array('user')),
                array('route' => 'zfcuser/logout', 'roles' => array('user')),
                array('route' => 'zfcuser/login', 'roles' => array('guest')),
                array('route' => 'zfcuser/register', 'roles' => array('guest')),
                array('route' => 'home', 'roles' => array('guest', 'user')),
                array('route' => 'search', 'roles' => array('guest', 'user')),
                array('route' => 'post-view', 'roles' => array('guest', 'user')),
                array('route' => 'post-crud', 'roles' => array('user')),
                array('route' => 'comm-create', 'roles' => array('user')),
                array('route' => 'comm-ud', 'roles' => array('user')),
            ),
        ),
    ),
);
