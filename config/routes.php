<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController

    'catalog' => 'catalog/index', //actionIndex in CatalogController
    
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory in CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', //actionCategory in CatalogController
    //Корзина
    'cart/checkout' => 'cart/checkout', //actionCheckout in CartController
    'cart/delete/([0-9]+)' => 'cart/delete/$1', //actionDelete in CartController
    'cart/add/([0-9]+)' => 'cart/add/$1', //actionAdd in CartContloller
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', //actionAddAJAX in CartContloller
    'cart' => 'cart/index', //actionIndex in CartController
    //Пользователь
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    //Управление товарами
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    //Управление категориями
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    //Управление заказами
    //'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    //'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    //Админпанель
    'admin' => 'admin/index',

    'contacts' => 'site/contact',

    '' => 'site/index', // actionIndex in SiteController
    
);
