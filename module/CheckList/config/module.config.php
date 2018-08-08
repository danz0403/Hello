<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'CheckList\Controller\Task' => 'CheckList\Controller\TaskController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'task' => array(
                'type'    => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/task[/:action[/:id]]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'CheckList\Controller',
                        'controller'    => 'Task',
                        'action'        => 'index',
                    ),
                    'constrants' => array(
                        'action' => '(add|edit|delete)',
                        'id' => '[0-9]+',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'CheckList' => __DIR__ . '/../view',
        ),
    ),
);
