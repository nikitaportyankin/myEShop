<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController

    'catalog' => 'catalog/index', //actionIndex in CatalogController
    
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory in CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', //actionCategory in CatalogController
    
    'cart/checkout' => 'cart/checkout', //actionCheckout in CartController
    'cart/add/([0-9]+)' => 'cart/add/$1', //actionAdd in CartContloller
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', //actionAddAJAX in CartContloller
    'cart' => 'cart/index', //actionIndex in CartController
    
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    
    'contacts' => 'site/contact',

    '' => 'site/index', // actionIndex in SiteController
    
);
