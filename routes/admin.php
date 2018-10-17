<?php

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::post('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/admin', 'Backend\DashboardController@index')->name('admin.home');
Route::post('/admin/settings/update/{admin}', 'AdminController@settingsUpdate')->name('admin.settings.update');
Route::post('/admin/password/update/{admin}', 'AdminController@passwordUpdate')->name('admin.password.update');

Route::prefix('dashboard')->group(function() {

    Route::get('/', 'Backend\DashboardController@index')->name('dashboard.home');
    Route::get('/pages', 'Backend\DashboardController@pages')->name('dashboard.pages');
    Route::get('/pages/templates/edit/{page_template}', 'Backend\DashboardController@pageTemplateEdit')->name('dashboard.pages.template.edit');
    Route::get('/pages/edit/{page}', 'Backend\DashboardController@pageEdit')->name('dashboard.page.edit');
    Route::get('/categories', 'Backend\DashboardController@categories')->name('dashboard.categories');
    Route::get('/categories/edit/{category}', 'Backend\DashboardController@categoryEdit')->name('dashboard.category.edit');
    Route::get('/widgets', 'Backend\DashboardController@widgets')->name('dashboard.widgets');
    Route::get('/widgets/edit/{widget}', 'Backend\DashboardController@widgetEdit')->name('dashboard.widget.edit');
    Route::get('/design-blocks', 'Backend\DashboardController@designBlocks')->name('dashboard.design_blocks');
    Route::get('/design-blocks/edit/{design_block}', 'Backend\DashboardController@designBlockEdit')->name('dashboard.design_block.edit');
    Route::get('/menus', 'Backend\DashboardController@menus')->name('dashboard.menus');
    Route::get('/menus/edit/{menu}', 'Backend\DashboardController@menuEdit')->name('dashboard.menu.edit');
    Route::get('/general_info', 'Backend\DashboardController@generalInfo')->name('dashboard.general_info');
    Route::get('/general_info/edit/{general_info}', 'Backend\DashboardController@generalInfoEdit')->name('dashboard.general_info.edit');
    Route::get('/locales', 'Backend\DashboardController@locales')->name('dashboard.locales');
    Route::get('/locales/edit/{locale}', 'Backend\DashboardController@localeEdit')->name('dashboard.locale.edit');
    Route::get('/media', 'Backend\DashboardController@media')->name('dashboard.media');
    Route::get('/admin/settings', 'Backend\DashboardController@adminSettings')->name('dashboard.admin.settings');
    Route::get('/admin/change-password', 'Backend\DashboardController@adminChangePassword')->name('dashboard.admin.change_password');
});

Route::post('/locale/add', 'Backend\LocaleController@add')->name('api.locale.add');
Route::put('/locale/update', 'Backend\LocaleController@update')->name('api.locale.update');
Route::delete('/locale/delete', 'Backend\LocaleController@delete')->name('api.locale.delete');

Route::post('/general-info/add', 'Backend\GeneralInfoController@add')->name('api.general_info.add');
Route::put('/general-info/update', 'Backend\GeneralInfoController@update')->name('api.general_info.update');
Route::delete('/general-info/delete', 'Backend\GeneralInfoController@delete')->name('api.general_info.delete');

Route::post('/design-block/add', 'Backend\DesignBlockController@add')->name('api.design_block.add');
Route::put('/design-block/update', 'Backend\DesignBlockController@update')->name('api.design_block.update');
Route::delete('/design-block/delete', 'Backend\DesignBlockController@delete')->name('api.design_block.delete');

Route::post('/widget/add', 'Backend\Widget\WidgetController@add')->name('api.widget.add');
Route::post('/widget/design-block/add', 'Backend\Widget\WidgetController@addDesignBlock')->name('api.widget.design_block.add');
Route::post('/widget/design-blocks/order/update', 'Backend\Widget\WidgetController@updateDesignBlocksOrder')->name('api.widget.design_blocks.order.update');
Route::put('/widget/update', 'Backend\Widget\WidgetController@update')->name('api.widget.update');
Route::delete('/widget/delete', 'Backend\Widget\WidgetController@delete')->name('api.widget.delete');
Route::delete('/widget/design-block/delete', 'Backend\Widget\WidgetController@deleteDesignBlock')->name('api.widget.design_block.delete');
Route::post('/widget-content/update', 'Backend\Widget\WidgetsBlocksContentController@update')->name('api.widget_content.update');

Route::post('/page-template/add', 'Backend\Page\PageTemplateController@add')->name('api.page_template.add');
Route::put('/page-template/update', 'Backend\Page\PageTemplateController@update')->name('api.page_template.update');
Route::delete('/page-template/delete', 'Backend\Page\PageTemplateController@delete')->name('api.page_template.delete');

Route::post('/page/add', 'Backend\Page\PageController@add')->name('api.page.add');
Route::put('/page/update', 'Backend\Page\PageController@update')->name('api.page.update');
Route::delete('/page/delete', 'Backend\Page\PageController@delete')->name('api.page.delete');
Route::put('/page/publicity/update', 'Backend\Page\PageController@updatePublicity')->name('api.page.publicity.update');
Route::post('/page/design-blocks/order/update', 'Backend\Page\PagesDesignBlockController@updateDesignBlocksOrder')->name('api.page.design_blocks.order.update');
Route::post('/page/design-block/add', 'Backend\Page\PagesDesignBlockController@addDesignBlock')->name('api.page.design_block.add');
Route::post('/page/design-block/child/add', 'Backend\Page\PagesDesignBlockController@addChildDesignBlock')->name('api.page.child_design_block.add');
Route::post('/page/widget/add', 'Backend\Page\PagesDesignBlockController@addWidget')->name('api.page.widget.add');
Route::delete('/page/design-block/delete', 'Backend\Page\PagesDesignBlockController@deleteDesignBlock')->name('api.page.design_block.delete');
Route::delete('/page/widget/delete', 'Backend\Page\PagesDesignBlockController@deleteWidget')->name('api.page.widget.delete');
Route::post('/page/content/update', 'Backend\Page\PagesBlocksContentController@update')->name('api.page_content.update');

Route::get('/files/browse', 'Backend\MediaController@browseFiles')->name('api.files.browse');
Route::post('/media-file/upload', 'Backend\MediaController@uploadFile')->name('api.file.upload');
Route::delete('/media-file/delete', 'Backend\MediaController@deleteFile')->name('api.file.delete');

Route::post('/menu/add', 'Backend\MenuController@add')->name('api.menu.add');
Route::put('/menu/update', 'Backend\MenuController@update')->name('api.menu.update');
Route::delete('/menu/delete', 'Backend\MenuController@delete')->name('api.menu.delete');

Route::post('/menu-item/add', 'Backend\MenuItemController@add')->name('api.menu_item.add');
Route::post('/menu-item/child/add', 'Backend\MenuItemController@addChild')->name('api.child_menu_item.add');
Route::post('/menu-item/update', 'Backend\MenuItemController@update')->name('api.menu_item.update');
Route::delete('/menu-item/delete', 'Backend\MenuItemController@delete')->name('api.menu_item.delete');
Route::post('/menu-item/order/update', 'Backend\MenuItemController@updateMenuItemOrder')->name('api.menu_item.order.update');

Route::post('/category/add', 'Backend\Category\CategoryController@add')->name('api.category.add');
Route::put('/category/update', 'Backend\Category\CategoryController@update')->name('api.category.update');
Route::delete('/category/delete', 'Backend\Category\CategoryController@delete')->name('api.category.delete');

Route::post('/category-page/design-block/child/add', 'Backend\Category\CategoriesPagesDesignBlockController@addChildDesignBlock')->name('api.category_page.child_design_block.add');
Route::delete('/category-page/design-block/delete', 'Backend\Category\CategoriesPagesDesignBlockController@deleteDesignBlock')->name('api.category_page.design_block.delete');
Route::post('/category-page/content/update', 'Backend\Category\CategoriesPagesBlocksContentController@update')->name('api.category_page_content.update');
Route::post('/category-page/design-blocks/order/update', 'Backend\Category\CategoriesPagesDesignBlockController@updateDesignBlocksOrder')->name('api.category_page.design_blocks.order.update');

Route::put('/default/locale/update', 'Backend\DefaultDataController@updateLocale')->name('api.default.locale.update');
Route::put('/default/home-page/update', 'Backend\DefaultDataController@updateHomePage')->name('api.default.home_page.update');