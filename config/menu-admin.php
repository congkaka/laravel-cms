<?php

return [
    [
        'text' => 'Dashboard',
        'icon' => 'bi bi-grid',
        'route' => 'admin.dashboard',
        'activeIs' => 'admin.dashboard',
    ],
    [
        'text' => 'User manager',
        'icon' => 'bi bi-people',
        'route' => 'admin.user.index',
        'activeIs' => 'admin.user.*',
    ],

    [
        'text' => 'Blogs manager',
        'icon' => 'bi bi-book',
        'route' => 'admin.blogs.index',
        'activeIs' => 'admin.blogs.*',
    ],


    // [
    //     'text' => 'Dòng tiền',
    //     'icon' => 'bi bi-wallet2',
    //     'route' => 'admin.user.wallet_history',
    //     'activeIs' => 'admin.user.wallet_history',
    // ],
    // [
    //     'text' => 'Cài đặt dịch vụ',
    //     'icon' => 'bi bi-gear',
    //     'activeIs' => 'admin.categories.*|admin.product*',
    //     'children' => [
    //         [
    //             'text' => 'Loại dịch vụ',
    //             'route' => 'admin.categories.index',
    //             'activeIs' => 'admin.categories.*',
    //             'icon' => 'bi bi-circle'
    //         ],
    //         [
    //             'text' => 'Dịch vụ',
    //             'route' => 'admin.product.index',
    //             'activeIs' => 'admin.product.*',
    //             'icon' => 'bi bi-circle'
    //         ],
    //         [
    //             'text' => 'Giá dịch vụ',
    //             'route' => 'admin.product_variant.index',
    //             'activeIs' => 'admin.product_variant.*',
    //             'icon' => 'bi bi-circle'
    //         ]
    //     ],
    // ],
    // [
    //     'text' => 'Quản lý đơn hàng',
    //     'icon' => 'bi bi-cart4',
    //     'route' => 'admin.order.index',
    //     'activeIs' => 'admin.order.*',
    // ],
    // [
    //     'text' => 'Yêu cầu nạp tiền',
    //     'icon' => 'bi bi-cash',
    //     'route' => 'admin.deposit.index',
    //     'activeIs' => 'admin.deposit.*',
    // ],
    // [
    //     'text' => 'Cài đặt trang',
    //     'icon' => 'bi bi-gear',
    //     'activeIs' => 'admin.setting.*',
    //     'children' => [
    //         [
    //             'text' => 'Cài đặt liên hệ',
    //             'route' => 'admin.setting.contact',
    //             'activeIs' => 'admin.setting.contact',
    //             'icon' => 'bi bi-circle'
    //         ],
    //         [
    //             'text' => 'Thông báo telegram',
    //             'route' => 'admin.setting.telegram',
    //             'activeIs' => 'admin.setting.telegram',
    //             'icon' => 'bi bi-circle'
    //         ],
    //         [
    //             'text' => 'Cài đặt ngân hàng',
    //             'route' => 'admin.setting.pay',
    //             'activeIs' => 'admin.setting.pay',
    //             'icon' => 'bi bi-circle'
    //         ]
    //     ],
    // ]
];
