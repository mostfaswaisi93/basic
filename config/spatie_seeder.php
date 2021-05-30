<?php

return [
    'roles_structure'       => [
        'super_admin'   => [
            'users'             => 'c,r,u,d,p,t',
            'roles'             => 'c,r,u,d,p,t',
            'settings'          => 'c,r,u,d,p,t',
        ]
    ],

    'permissions_map'       => [
        'c'     => 'create',
        'r'     => 'read',
        'u'     => 'update',
        'd'     => 'delete',
        'p'     => 'print',
        't'     => 'trash',
    ]
];
