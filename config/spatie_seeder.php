<?php

return [
    'roles_structure'       => [
        'super_admin'   => [
            'appointments'      => 'c,r,u,d,p,t',
            'patients'          => 'c,r,u,d,p,t',
            'services'          => 'c,r,u,d,p,t',
            'drugs'             => 'c,r,u,d,p,t',
            'tests'             => 'c,r,u,d,p,t',
            'invoices'          => 'c,r,u,d,p,t',
            // 'notifications'     => 'c,r,u,d,p,t',
            'contacts'          => 'c,r,u,d,p,t',
            'countries'         => 'c,r,u,d,p,t',
            'cities'            => 'c,r,u,d,p,t',
            'districts'         => 'c,r,u,d,p,t',
            'locations'         => 'c,r,u,d,p,t',
            'constants'         => 'c,r,u,d,p,t',
            // 'payments'          => 'c,r,u,d,p,t',
            'receipts'          => 'c,r,u,d,p,t',
            'transactions'      => 'c,r,u,d,p,t',
            'users'             => 'c,r,u,d,p,t',
            'roles'             => 'c,r,u,d,p,t',
            // 'reports'           => 'c,r,u,d,p,t',
            'settings'          => 'c,r,u,d,p,t',
        ],
        'doctor'       => [
            'services'          => 'r,u,d',
            'users'             => 'c,r,u,d,p,t',
        ],
        'secretary'    => [
            'users'             => 'c,r,u,d,p,t',
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
