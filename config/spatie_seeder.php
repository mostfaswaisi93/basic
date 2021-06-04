<?php

return [
    'roles_structure'       => [
        'super_admin'   => [
            'brands'            => 'c,r,u,d,p,t,l',
            'categories'        => 'c,r,u,d,p,t,l',
            'multipics'         => 'c,r,u,d,p,t',
            'sliders'           => 'c,r,u,d,p,t',
            'contacts'          => 'c,r,u,d,p,t',
            'users'             => 'c,r,u,d,p,t,l',
            // 'settings'          => 'c,r,u,d,p,t',
        ],
        'admin' => []
    ],

    'permissions_map'       => [
        'c'     => 'create',
        'r'     => 'read',
        'u'     => 'update',
        'd'     => 'delete',
        'p'     => 'print',
        't'     => 'trash',
        'l'     => 'trashlist',
    ]
];
