<?php


Route::group(['namespace' => 'Frontend', 'middleware' => 'frontend'], function () use ($router) {
    $router->get('/', 'MainController@index')->name('fe.landing');
    $router->get('/product/{slug}', 'MainController@detail')->name('fe.product_detail');
    $router->get('/category/{slug}', 'MainController@viewCategoryProduct')->name('fe.cat_product');
    $router->get('/myorder', 'MainController@myOrder')->name('fe.myorder');
    $router->get('/myorder/checkout', 'MainController@purchase')->name('fe.checkout');
    $router->get('/profile', 'MainController@profile')->name('fe.myprofile');
    $router->get('/profile/edit', 'MainController@profileEdit')->name('fe.profile_edit');
    $router->post('/profile/update', 'MainController@profileUpdate')->name('fe.profileUpdate');
    $router->get('/change-password', 'MainController@changePassword')->name('fe.changePassword');
    $router->post('/password/update', 'MainController@updatePassword')->name('fe.updatePassword');
    $router->get('/blog', 'MainController@getBlog')->name('fe.blog');
    $router->get('/blog/{slug}', 'MainController@getBlogView')->name('fe.blog_view');
});
Route::group(['prefix' => 'ajax'], function () use ($router) {
    $router->post('/checkout', 'Frontend\MainController@postCheckout')->name('checkout');
    $router->post('/delete-cart', 'Frontend\MainController@deleteCart')->name('delete_cart');
    $router->post('/cek-auth', 'Frontend\MainController@cekAuth')->name('cek_auth');
    $router->post('/get-city', 'Frontend\MainController@getCityByProvinceId')->name('getCityProvince');
    $router->post('/get-courier', 'Frontend\MainController@getCourier')->name('get_courier');
    $router->post('/add-to-cart', 'Frontend\MainController@addToCart')->name('add_to_cart');
    $router->post('/search-min-max', 'Frontend\MainController@searchMinMax')->name('searchminmax');
    $router->post('/cek-ongkir', 'Frontend\MainController@cekOngkir')->name('cek_ongkir');
});


Auth::routes();

Route::group(['prefix' => 'backoffice', 'middleware' => ['auth', 'superadmin']], function () use ($router) {
    $router->get('/', 'BackOffice\MainController@dashboard')->name('backoffice.dashboard');
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('/', 'BackOffice\UserController@index')->name('backoffice.user_index');
        $router->get('/create', 'BackOffice\UserController@create')->name('backoffice.user_create');
        $router->post('/store', 'BackOffice\UserController@store')->name('backoffice.user_store');
        $router->get('/edit/{id}', 'BackOffice\UserController@show')->name('backoffice.user_show');
        $router->put('/update/{id}', 'BackOffice\UserController@update')->name('backoffice.user_update');
        $router->get('/delete/{id}', 'BackOffice\UserController@destroy')->name('backoffice.user_delete');
    });
    $router->group(['prefix' => 'pcategory'], function () use ($router) {
        $router->get('/', 'BackOffice\Product_categoryController@index')->name('backoffice.pcategory_index');
        $router->get('/create', 'BackOffice\Product_categoryController@create')->name('backoffice.pcategory_create');
        $router->post('/store', 'BackOffice\Product_categoryController@store')->name('backoffice.pcategory_store');
        $router->get('/edit/{id}', 'BackOffice\Product_categoryController@show')->name('backoffice.pcategory_show');
        $router->put('/update/{id}', 'BackOffice\Product_categoryController@update')->name('backoffice.pcategory_update');
        $router->get('/delete/{id}', 'BackOffice\Product_categoryController@delete')->name('backoffice.pcategory_delete');
    });
    $router->group(['prefix' => 'profile'], function () use ($router) {
        $router->get('/', 'BackOffice\ProfileController@profile')->name('backoffice.profile_index');
        $router->put('/update/{id}', 'BackOffice\ProfileController@updateProfile')->name('backoffice.profile_update');

        $router->get('/password', 'BackOffice\ProfileController@password')->name('backoffice.profile_password');
        $router->put('/password/update/{id}', 'BackOffice\ProfileController@updatePassword')->name('backoffice.profile_update_password');
    });
    $router->group(['prefix' => 'courier'], function () use ($router) {
        $router->get('/', 'BackOffice\MainController@getCourier')->name('backoffice.courier');
        $router->post('/update', 'BackOffice\MainController@postCourierUpdate')->name('backoffice.courier_update');
    });
    $router->group(['prefix' => 'store'], function () use ($router) {
        $router->get('/', 'BackOffice\StoreController@index')->name('backoffice.store');
        $router->get('/edit/{id}', 'BackOffice\StoreController@edit')->name('backoffice.store_edit');
        $router->get('/delete/{id}', 'BackOffice\StoreController@delete')->name('backoffice.store_delete');
        $router->get('/create', 'BackOffice\StoreController@create')->name('backoffice.store_create');
        $router->post('/store', 'BackOffice\StoreController@store')->name('backoffice.store_store');
        $router->post('/update', 'BackOffice\StoreController@update')->name('backoffice.store_update');
    });
    $router->group(['prefix' => 'blog'], function () use ($router) {
        $router->get('/', 'BackOffice\BlogController@index')->name('backoffice.blog');
        $router->get('/edit/{id}', 'BackOffice\BlogController@edit')->name('backoffice.blog_edit');
        $router->get('/delete/{id}', 'BackOffice\BlogController@delete')->name('backoffice.blog_delete');
        $router->get('/create', 'BackOffice\BlogController@create')->name('backoffice.blog_create');
        $router->post('/store', 'BackOffice\BlogController@store')->name('backoffice.blog_store');
        $router->post('/update', 'BackOffice\BlogController@update')->name('backoffice.blog_update');
    });
});

// store admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'storeadmin']], function () use ($router) {
    $router->get('/', 'StoreAdmin\MainController@dashboard')->name('admin.dashboard');
    $router->group(['prefix' => 'product'], function () use ($router) {
        $router->get('/', 'StoreAdmin\ProductController@index')->name('admin.product_index');
        $router->get('/create', 'StoreAdmin\ProductController@create')->name('admin.product_create');
        $router->post('/store', 'StoreAdmin\ProductController@store')->name('admin.product_store');
        $router->get('/edit/{id}', 'StoreAdmin\ProductController@show')->name('admin.product_show');
        $router->put('/update/{id}', 'StoreAdmin\ProductController@update')->name('admin.product_update');
        $router->get('/delete/{id}', 'StoreAdmin\ProductController@delete')->name('admin.product_delete');

        // ajax
        $router->get('/ajxIncreaseStock/{id}', 'StoreAdmin\ProductController@increaseStock');
        $router->post('/ajxIncreaseStock', 'StoreAdmin\ProductController@postIncreaseStock');
        $router->get('/ajxDecreaseStock/{id}', 'StoreAdmin\ProductController@decreaseStock');
        $router->post('/ajxDecreaseStock', 'StoreAdmin\ProductController@postDecreaseStock');
    });
    $router->group(['prefix' => 'setting'], function () use ($router) {
        $router->get('/store', 'StoreAdmin\SettingController@settingStore')->name('admin.setting_store');
        $router->get('/store/edit', 'StoreAdmin\SettingController@settingStoreEdit')->name('admin.setting_store_edit');
        $router->put('/store/update', 'StoreAdmin\SettingController@settingStoreUpdate')->name('admin.setting_store_update');


        $router->get('/courier', 'StoreAdmin\SettingController@settingCourier')->name('admin.setting_courier');



        $router->get('/payment', 'StoreAdmin\SettingController@settingPayment')->name('admin.setting_payment');
        $router->get('/payment/add', 'StoreAdmin\SettingController@settingPaymentAdd')->name('admin.setting_payment_add');
        $router->post('/payment/store', 'StoreAdmin\SettingController@settingPaymentStore')->name('admin.setting_payment_store');
        $router->get('/payment/edit', 'StoreAdmin\SettingController@settingPaymentEdit')->name('admin.setting_payment_edit');
        $router->put('/payment/update', 'StoreAdmin\SettingController@settingPaymentUpdate')->name('admin.setting_payment_update');
        $router->get('/payment/delete', 'StoreAdmin\SettingController@settingPaymentDelete')->name('admin.setting_payment_delete');

        $router->post('/courierUpdate', 'StoreAdmin\SettingController@postCourierUpdate');
    });
    $router->group(['prefix' => 'profile'], function () use ($router) {
        $router->get('/', 'StoreAdmin\ProfileController@profile')->name('admin.profile_index');
        $router->put('/update/{id}', 'StoreAdmin\ProfileController@updateProfile')->name('admin.profile_update');

        $router->get('/password', 'StoreAdmin\ProfileController@password')->name('admin.profile_password');
        $router->put('/password/update/{id}', 'StoreAdmin\ProfileController@updatePassword')->name('admin.profile_update_password');
    });
    $router->group(['prefix' => 'transaction'], function () use ($router) {
        $router->get('/list', 'StoreAdmin\TransactionController@index')->name('admin.transaction_index');
        $router->get('/detail/{id}', 'StoreAdmin\TransactionController@detail')->name('admin.transaction_detail');
        $router->post('/paymentStatus', 'StoreAdmin\TransactionController@changePaymentStatus')->name('admin.transaction_ajxpayment');
        $router->post('/transactionStatus', 'StoreAdmin\TransactionController@changeTransactionStatus')->name('admin.transaction_ajxtransaction');
    });

    $router->group(['prefix' => 'report'], function () use ($router) {
        $router->get('/transaction', 'StoreAdmin\ReportController@transaction')->name('admin.report_transaction');
        $router->get('/shipment', 'StoreAdmin\ReportController@shipment')->name('admin.report_shipment');
    });
});
