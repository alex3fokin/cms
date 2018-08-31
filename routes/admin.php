<?php

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
});

Route::post('/add-locale', 'Backend\LocaleController@add')->name('api.locale.add');
Route::put('/update-locale', 'Backend\LocaleController@update')->name('api.locale.update');
Route::delete('/delete-locale', 'Backend\LocaleController@delete')->name('api.locale.delete');

Route::post('/add-general-info', 'Backend\GeneralInfoController@add')->name('api.general_info.add');
Route::put('/update-general-info', 'Backend\GeneralInfoController@update')->name('api.general_info.update');
Route::delete('/delete-general-info', 'Backend\GeneralInfoController@delete')->name('api.general_info.delete');

Route::post('/add-design-block', 'Backend\DesignBlockController@add')->name('api.design_block.add');
Route::put('/update-design-block', 'Backend\DesignBlockController@update')->name('api.design_block.update');
Route::delete('/delete-design-block', 'Backend\DesignBlockController@delete')->name('api.design_block.delete');

Route::post('/add-widget', 'Backend\Widget\WidgetController@add')->name('api.widget.add');
Route::post('/add-widget-design-block', 'Backend\Widget\WidgetController@addDesignBlock')->name('api.widget.design_block.add');
Route::post('/update-widget-design-blocks-order', 'Backend\Widget\WidgetController@updateDesignBlocksOrder')->name('api.widget.design_blocks.order.update');
Route::put('/update-widget', 'Backend\Widget\WidgetController@update')->name('api.widget.update');
Route::delete('/delete-widget', 'Backend\Widget\WidgetController@delete')->name('api.widget.delete');
Route::delete('/delete-widget-design-block', 'Backend\Widget\WidgetController@deleteDesignBlock')->name('api.widget.design_block.delete');
Route::post('/update-widget-content', 'Backend\Widget\WidgetsBlocksLocaleContentController@update')->name('api.widget_content.update');

Route::post('/add-page-template', 'Backend\Page\PageTemplateController@add')->name('api.page_template.add');
Route::put('/update-page-template', 'Backend\Page\PageTemplateController@update')->name('api.page_template.update');
Route::delete('/delete-page-template', 'Backend\Page\PageTemplateController@delete')->name('api.page_template.delete');

Route::post('/add-page', 'Backend\Page\PageController@add')->name('api.page.add');
Route::put('/update-page', 'Backend\Page\PageController@update')->name('api.page.update');
Route::delete('/delete-page', 'Backend\Page\PageController@delete')->name('api.page.delete');
Route::put('/update-page-publicity', 'Backend\Page\PageController@updatePublicity')->name('api.page.publicity.update');
Route::post('/update-page-design-blocks-order', 'Backend\Page\PagesDesignBlockController@updateDesignBlocksOrder')->name('api.page.design_blocks.order.update');
Route::post('/add-page-design-block', 'Backend\Page\PagesDesignBlockController@addDesignBlock')->name('api.page.design_block.add');
Route::post('/add-page-child-design-block', 'Backend\Page\PagesDesignBlockController@addChildDesignBlock')->name('api.page.child_design_block.add');
Route::post('/add-page-widget', 'Backend\Page\PagesDesignBlockController@addWidget')->name('api.page.widget.add');
Route::delete('/delete-page-design-block', 'Backend\Page\PagesDesignBlockController@deleteDesignBlock')->name('api.page.design_block.delete');
Route::delete('/delete-page-widget', 'Backend\Page\PagesDesignBlockController@deleteWidget')->name('api.page.widget.delete');
Route::post('/update-page-content', 'Backend\Page\PagesBlocksLocaleContentController@update')->name('api.page_content.update');

Route::post('/upload-media-file', 'Backend\MediaController@uploadFile')->name('api.file.upload');
Route::delete('/delete-media-file', 'Backend\MediaController@deleteFile')->name('api.file.delete');

Route::post('/add-menu', 'Backend\MenuController@add')->name('api.menu.add');
Route::delete('/delete-menu', 'Backend\MenuController@delete')->name('api.menu.delete');

Route::post('/add-menu-item', 'Backend\MenuItemController@add')->name('api.menu_item.add');
Route::post('/add-child-menu-item', 'Backend\MenuItemController@addChild')->name('api.child_menu_item.add');
Route::post('/update-menu-item', 'Backend\MenuItemController@update')->name('api.menu_item.update');
Route::delete('/delete-menu-item', 'Backend\MenuItemController@delete')->name('api.menu_item.delete');
Route::post('/update-menu-item-order', 'Backend\MenuItemController@updateMenuItemOrder')->name('api.menu_item.order.update');

Route::put('/update-default-locale', 'Backend\DefaultDataController@updateLocale')->name('api.default.locale.update');
Route::put('/update-default-home-page', 'Backend\DefaultDataController@updateHomePage')->name('api.default.home_page.update');