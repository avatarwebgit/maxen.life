<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CKEditorController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CommentIndexController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryMethodController;
use App\Http\Controllers\Admin\FunctionalTypeController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\LabelController;
use App\Http\Controllers\Admin\MeasureController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductAttributeVariation;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ticketController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\automatic\DailyFunctions;
use App\Http\Controllers\Home\AddressController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CompareController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\IndexHomeController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Home\WishlistController;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Home\CommentController as HomeCommentController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\CheckoutController as HomeCheckoutController;
use App\Http\Controllers\Home\ArticleController as ArticleHomeController;
use App\Http\Livewire\Auth\Index as LoginIndex;
use App\Http\Controllers\Admin\RedirectJoomlaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');
//Admin
Route::prefix('admin-panel/management/')
//    ->middleware('adminAuth')
    ->name('admin.')
    ->group(function () {
            Route::resource('menus', MenuController::class);
                   Route::get('contact/page', [SettingController::class, 'contact_edit'])->name('contact.edit');
        Route::post('contact/page/update', [SettingController::class, 'contact_update'])->name('contact.update');
        Route::resource('attributes', AttributeController::class);
        Route::resource('functionalType', FunctionalTypeController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('comments', CommentController::class);
        Route::resource('labels', LabelController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('measures', MeasureController::class);
        Route::resource('tags', TagController::class);
        Route::resource('products', ProductController::class);
        Route::get('products/pagination/{show_per_page}', [ProductController::class, 'products_pagination'])->name('products.pagination');
        Route::resource('sliders', SliderController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('offers', OfferController::class);
        Route::resource('news', NewController::class);
        Route::resource('coupons', CouponController::class);
        Route::resource('orders', OrderController::class);
        Route::get('orders/pagination/{show_per_page}/{payment_methods}', [OrderController::class, 'pagination'])->name('orders.pagination');
        Route::resource('transactions', TransactionController::class);
        Route::get('transactions/pagination/{show_per_page}', [TransactionController::class, 'index_pagination'])->name('transactions.pagination');
        Route::get('/comments/{comment}/change-approve', [CommentController::class, 'changeApprove'])->name('comments.change-approve');
        //        ================================================== category ===================================================
        Route::post('/categories/showOnIndex', [CategoryController::class, 'showOnIndex'])->name('category.showOnIndex');
        Route::post('/categories/sale_active', [CategoryController::class, 'sale_active'])->name('category.sale_active');
        Route::get('/category/personalityNavbar', [CategoryController::class, 'personalityNavbar'])->name('category.personalityNavbar');
        Route::post('/category/personalityNavbar_update', [CategoryController::class, 'personalityNavbar_update'])->name('category.personalityNavbar.update');
        Route::post('/categories/get', [CategoryController::class, 'get'])->name('categories.get');
        Route::get('/categories_send_setting/edit/{category}', [CategoryController::class, 'send_setting'])->name('category.send_setting.edit');
        Route::put('/categories_send_setting/update/{category}', [CategoryController::class, 'send_setting_update'])->name('category.send_setting.update');
        Route::get('/categories_peyk_price/{category}', [CategoryController::class, 'peyk_price'])->name('category.peyk.price');
        Route::post('/categories_peyk_price_update/', [CategoryController::class, 'peyk_price_update'])->name('category.peyk.price.update');
        Route::post('/categories_peyk_price_group_update/', [CategoryController::class, 'peyk_price_group_update'])->name('category.peyk.price_group.update');
        //        ================================================== tickets ===================================================
        Route::get('/ticket/index', [ticketController::class, 'index'])->name('ticket.index');
        Route::get('/ticket/show/{id}', [ticketController::class, 'show'])->name('ticket.show');
        Route::get('/ticket/show/admin/{id}', [ticketController::class, 'show_admin'])->name('ticket.show_admin');
        Route::post('/ticket/changeStatusAjax}', [ticketController::class, 'changeStatusAjax'])->name('ticket.changeStatusAjax');
        Route::post('/ticket/replay', [ticketController::class, 'replay'])->name('ticket.replay');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/ticket/remove', [ticketController::class, 'remove'])->name('ticket.remove');
        Route::get('/ticket/new', [ticketController::class, 'new_ticket'])->name('ticket.new');
          Route::post('/ticket/new/send', [ticketController::class, 'store_ticket'])->name('ticket.send');
        // Get Category Attributes
        Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);
        // Edit Product Image
        Route::get('/products/{product}/images-edit', [ProductImageController::class, 'edit'])->name('products.images.edit');
        Route::delete('/products/{product}/images-destroy', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
        Route::put('/products/{product}/images-set-primary', [ProductImageController::class, 'setPrimary'])->name('products.images.set_primary');
        Route::post('/products/images-set_as_second_image-primary', [ProductImageController::class, 'set_as_second_image'])->name('products.images.set_as_second_image');
        Route::post('/products/{product}/images-add', [ProductImageController::class, 'add'])->name('products.images.add');
        // Edit Product Category
        Route::get('/products/{product}/category-edit', [ProductController::class, 'editCategory'])->name('products.category.edit');
        Route::put('/products/{product}/category-update', [ProductController::class, 'updateCategory'])->name('products.category.update');
        Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');
        Route::post('/product/ajax', [ProductController::class, 'ajax'])->name('product.ajax');
        Route::post('/products/get', [ProductController::class, 'get'])->name('products.get');
        // Update Products Price
        Route::get('/update/products/single', [ProductController::class, 'update_single'])->name('products.single.update');
        Route::get('/update/products/single/pagination/{show_per_page}', [ProductController::class, 'update_single_pagination'])->name('products.single.update.pagination');
        Route::post('/update/products/single/quantity', [ProductController::class, 'update_single_product_quantity'])->name('products.single.update.quantity');
        Route::post('/update/products/single/price_user', [ProductController::class, 'update_single_price'])->name('products.single.update.update_single_price');
        Route::post('/update/products/single/search', [ProductController::class, 'single_product_search'])->name('products.single.search');
        Route::get('/update/products/multi', [ProductController::class, 'update_multi'])->name('products.multi.update');
        Route::get('/update/products/multi/pagination/{show_per_page}', [ProductController::class, 'update_multi_pagination'])->name('products.multi.update.pagination');
        Route::post('/update/products/multi/quantity', [ProductController::class, 'update_multi_product_quantity'])->name('products.multi.update.quantity');
        Route::post('/update/products/multi/price_user', [ProductController::class, 'update_multi_price'])->name('products.multi.update.update_multi_price');
        Route::post('/update/products/multi/search', [ProductController::class, 'multi_product_search'])->name('products.multi.search');
        //update discount
                         Route::get('sections/title/{section}', [SettingController::class, 'setting_title'])->name('setting.title');
         Route::post('sections/title/update', [SettingController::class, 'setting_title_update'])->name('setting.title.update');

        Route::post('/updatePercent/products/single', [ProductController::class, 'update_single_product_discount_quantity'])->name('products.single.updatePercent');
        Route::post('/updateActiveDiscount/products/single', [ProductController::class, 'update_single_product_discount_updateActiveDiscount'])->name('products.single.updateActiveDiscount');
        //pages
        Route::get('/pages/index', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}/update', [PageController::class, 'update'])->name('pages.update');
        Route::post('/pages/destroy', [PageController::class, 'destroy'])->name('page.destroy');
        //Setting
        
     
        
        
        Route::get('setting/{setting}', [SettingController::class, 'edit'])->name('setting.edit');
        Route::post('setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
        Route::post('priority_show_active}', [SettingController::class, 'priority_show_active'])->name('setting.priority_show_active');
        Route::get('setting/animation_banner/edit', [SettingController::class, 'animation_banner_edit'])->name('animation_banner.edit');
        Route::put('setting/animation_banner/update', [SettingController::class, 'animation_banner_update'])->name('animation_banner.update');
        Route::get('sections/index', [SettingController::class, 'sections_index'])->name('sections.index');
        Route::put('setting/sections/update', [SettingController::class, 'sections_update'])->name('sections.update');
        Route::get('paymentMethods', [AdminPaymentController::class, 'paymentMethod'])->name('paymentMethods');
        Route::get('paymentMethods/{payment}/{status}', [AdminPaymentController::class, 'changeStatus'])->name('paymentMethods.changeStatus');
        Route::get('paymentMethods/{payment}', [AdminPaymentController::class, 'config'])->name('paymentMethods.config');
        Route::post('paymentMethods/{payment}', [AdminPaymentController::class, 'edit'])->name('paymentMethods.edit');
        Route::get('commentIndex', [CommentIndexController::class, 'index'])->name('Comment_index');
        Route::get('commentIndex/show/{comment}', [CommentIndexController::class, 'show'])->name('Comment_index.show');
        Route::delete('commentIndex/delete/{comment}', [CommentIndexController::class, 'delete'])->name('Comment_index.delete');
        Route::get('/commentIndex/{comment}/change-approve', [CommentIndexController::class, 'changeApprove'])->name('Comment_index_show.change-approve');
        //remove Functions
        Route::post('/category', [CategoryController::class, 'remove'])->name('category.remove');
        Route::post('/attribute', [AttributeController::class, 'remove'])->name('attribute.remove');
        Route::post('/product/delete', [ProductController::class, 'remove'])->name('products.delete');
        Route::post('/label/delete', [LabelController::class, 'remove'])->name('label.remove');
        Route::post('/coupon/delete', [CouponController::class, 'remove'])->name('coupon.remove');
        Route::post('/brand/delete', [BrandController::class, 'remove'])->name('brand.remove');
        Route::post('/measure/delete', [MeasureController::class, 'remove'])->name('measure.remove');
        Route::post('/functionalType/delete', [FunctionalTypeController::class, 'remove'])->name('functionalType.remove');
        //        ================================================= Gift ===================================================
        Route::get('/gift', [GiftController::class, 'index'])->name('gift.index');
        Route::get('/gift/create', [GiftController::class, 'create'])->name('gift.create');
        Route::post('/gift/store', [GiftController::class, 'store'])->name('gift.store');
        Route::get('/gift/{gift}/edit', [GiftController::class, 'edit'])->name('gift.edit');
        Route::put('/gift/{gift}/update', [GiftController::class, 'update'])->name('gift.update');
        Route::post('/gift/remove', [GiftController::class, 'remove'])->name('gift.remove');
        //        ================================================= Wallet ===================================================
        Route::get('/wallet/{user}/index', [WalletController::class, 'index'])->name('wallet.index');
        Route::post('/wallet/add', [WalletController::class, 'add'])->name('wallet.add');
        //        ================================================= delivery_method ===================================================
        Route::get('deliveryMethod', [DeliveryMethodController::class, 'index'])->name('delivery_method.index');
        Route::get('deliveryMethod/{method}/{status}', [DeliveryMethodController::class, 'changeStatus'])->name('delivery_method.changeStatus');
        Route::get('deliveryMethod/{method}/', [DeliveryMethodController::class, 'edit'])->name('delivery_method.edit');
        Route::get('deliveryMethodCreate/{method}', [DeliveryMethodController::class, 'create'])->name('delivery_method.create');
        Route::post('deliveryMethodPostAdd/{method}', [DeliveryMethodController::class, 'PostAdd'])->name('delivery_method.post.add');
        Route::get('deliveryMethodPostEdit/{id}', [DeliveryMethodController::class, 'PostEdit'])->name('delivery_method.post.edit');
        Route::post('deliveryMethodPostUpdate', [DeliveryMethodController::class, 'PostUpdate'])->name('delivery_method.post.update');
        Route::post('deliveryMethodPeykAdd/{method}', [DeliveryMethodController::class, 'PeykAdd'])->name('delivery_method.peyk.add');
        Route::get('deliveryMethodPeykEdit/{id}', [DeliveryMethodController::class, 'PeykEdit'])->name('delivery_method.peyk.edit');
        Route::put('deliveryMethodPeykUpdate/{id}', [DeliveryMethodController::class, 'PeykUpdate'])->name('delivery_method.peyk.update');
        Route::delete('deliveryMethodDelete/', [DeliveryMethodController::class, 'delete'])->name('delivery_method.delete');
        Route::post('deliveryMethodDInfo', [DeliveryMethodController::class, 'info'])->name('delivery_method.info');
        Route::post('deliveryMethodDUpdate', [DeliveryMethodController::class, 'update'])->name('delivery_method.update');
        Route::post('deliveryMethodConfig', [DeliveryMethodController::class, 'config'])->name('delivery_method.config');
        Route::put('deliveryMethodAloPeykUpdate', [DeliveryMethodController::class, 'AlopeykUpdate'])->name('AlopeykUpdate.update');

        //        ================================================= articles ===================================================
        Route::get('/articles/index/', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/index/{cat}', [ArticleController::class, 'index_category_sort'])->name('articles.index_category_sort');
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('/articles/edit/{article}', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/update/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::post('/articles/destroy', [ArticleController::class, 'destroy'])->name('article.destroy');
        //        ================================================= article categories ===================================================
        Route::get('/articles/categories/index/', [ArticleController::class, 'categories_index'])->name('articles.categories.index');
        Route::get('/articles/categories/create', [ArticleController::class, 'categories_create'])->name('articles.categories.create');
        Route::post('/articles/categories/store', [ArticleController::class, 'categories_store'])->name('articles.categories.store');
        Route::get('/articles/categories/edit/{category}', [ArticleController::class, 'categories_edit'])->name('articles.categories.edit');
        Route::post('/articles/categories/update/{category}', [ArticleController::class, 'categories_update'])->name('articles.categories.update');
        Route::post('/articles/categories/remove/', [ArticleController::class, 'categories_remove'])->name('articles.categories.remove');
//        ================================================= users ===================================================
        Route::post('/user/AjaxGet', [UserController::class, 'AjaxGet'])->name('user.AjaxGet');
        Route::post('/user/searchUser', [UserController::class, 'searchUser'])->name('user.searchUser');
        Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/index/pagination/{show_per_page}', [UserController::class, 'index_pagination'])->name('users.pagination');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/tickets/{user}', [UserController::class, 'userTickets'])->name('user.tickets.index');
        Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::post('/user/destroy', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/user/change/role/index', [UserController::class, 'change_role_index'])->name('user.change_role.index');
        Route::get('/user/change/role/{user}/edit', [UserController::class, 'change_role_edit'])->name('user.change_role.edit');
        Route::post('/user/role/confirm', [UserController::class, 'change_role_confirm'])->name('user.change_role.confirm');
        Route::post('/user/role/deny', [UserController::class, 'change_role_deny'])->name('user.change_role.deny');
        Route::post('/users/get', [UserController::class, 'get'])->name('users.get');
        Route::post('/users/change_password/{user}', [UserController::class, 'change_password'])->name('user.change_password');
        //        ================================================= product variations ===================================================
        Route::get('/products/variations/index/{product}', [ProductController::class, 'product_variations_index'])->name('product.variations.index');
        Route::get('/products/variations/create/{product}', [ProductController::class, 'product_variations_create'])->name('product.variations.create');
        Route::post('/products/variations/store', [ProductController::class, 'product_variations_store'])->name('product.variations.store');
        Route::get('/products/variations/edit/{variation}', [ProductController::class, 'product_variations_edit'])->name('product.variations.edit');
        Route::put('/products/variations/update/{variation}', [ProductController::class, 'product_variations_update'])->name('product.variations.update');
        Route::get('/products/variations/remove_image/{variation}', [ProductController::class, 'product_variations_remove_image'])->name('product.variations.remove_image');
        Route::post('/products/variations/remove', [ProductController::class, 'product_variations_remove'])->name('product.variations.remove');
        Route::post('/products/changeStatus', [ProductController::class, 'changeStatus'])->name('product.changeStatus');
        Route::post('/products/specialSale', [ProductController::class, 'specialSale'])->name('product.specialSale');
        Route::post('/products/Set_as_new', [ProductController::class, 'Set_as_new'])->name('product.Set_as_new');
        Route::post('/products/priority_show_update', [ProductController::class, 'priority_show_update'])->name('products.priority_show_update');
        //        ================================================= product options ===================================================
        Route::get('/products/options/index/{product}', [ProductController::class, 'product_options_index'])->name('product.options.index');
        Route::get('/products/options/create/{product}', [ProductController::class, 'product_options_create'])->name('product.options.create');
        Route::post('/products/options/store', [ProductController::class, 'product_options_store'])->name('product.options.store');
        Route::get('/products/options/edit/{option}', [ProductController::class, 'product_options_edit'])->name('product.options.edit');
        Route::put('/products/options/update/{option}', [ProductController::class, 'product_options_update'])->name('product.options.update');
        Route::post('/products/options/remove', [ProductController::class, 'product_options_remove'])->name('product.options.remove');
        //        ================================================= product Copy ===================================================
        Route::post('/products/copy', [ProductController::class, 'product_copy'])->name('product.copy');
        //        ================================================= product Attributes Variation ===================================================
        Route::get('/products/variations/attribute/edit/{product}', [ProductAttributeVariation::class, 'edit'])->name('product.variations.attribute.edit');
        Route::post('/products/variations/attribute/update', [ProductAttributeVariation::class, 'update'])->name('product.variations.attribute.update');
        Route::post('/products/variations/attribute/save_colors/{product}', [ProductAttributeVariation::class, 'save_colors'])->name('product.variations.attribute.save_colors');
        Route::post('/products/variations/attribute/color_remove/', [ProductAttributeVariation::class, 'color_remove'])->name('product.variations.attribute.colors.remove');
        Route::post('/products/variations/attribute/add_product/{product}', [ProductAttributeVariation::class, 'add_product'])->name('product.variations.attribute.add_product');
        Route::post('/products/variations/attribute/value/attr_remove', [ProductAttributeVariation::class, 'attr_remove'])->name('product.variations.attribute.attr_remove');
        //        ================================================= product Attributes ===================================================
        Route::get('/products/attributes/index/{product}', [ProductController::class, 'product_attributes_index'])->name('product.attributes.index');
        Route::post('/products/attributes/add_or_update', [ProductController::class, 'product_attributes_add_or_update'])->name('product.attributes.addOrUpdate');
        Route::get('/products/attributes/{attribute}', [ProductController::class, 'product_attributes_remove'])->name('product.attributes.remove');
        Route::post('/products/attributes/change_active', [ProductController::class, 'product_attributes_change_active'])->name('product.attributes.change_active');
        Route::post('/products/attributes/change_original', [ProductController::class, 'product_attributes_change_original'])->name('product.attributes.change_original');
        //        ================================================= Attributes Values ===================================================
        Route::get('/attributes/values/index/{attribute}', [AttributeController::class, 'attributes_values_index'])->name('attributes.values.index');
        Route::post('/attributes/values/add_or_update', [AttributeController::class, 'attributes_values_add_or_update'])->name('attributes.value.addOrUpdate');
        Route::post('/attributes/values', [AttributeController::class, 'attributes_value_remove'])->name('attributes.value.remove');
        Route::post('/attributes/values/priority_show_update', [AttributeController::class, 'priority_show_update'])->name('attribute_values.priority_show_update');
        //        =================================================  Attributes Groups ===================================================
        Route::get('/attribute/group/index', [AttributeController::class, 'attribute_group_index'])->name('attributes.groups.index');
        Route::get('/attribute/group/create', [AttributeController::class, 'attribute_group_create'])->name('attributes.group.create');
        Route::post('/attribute/group/store', [AttributeController::class, 'attribute_group_store'])->name('attributes.group.store');
        Route::get('/attribute/group/edit/{group}', [AttributeController::class, 'attribute_group_edit'])->name('attributes.group.edit');
        Route::put('/attribute/group/update/{group}', [AttributeController::class, 'attribute_group_update'])->name('attributes.group.update');
        Route::post('/attribute/group/remove', [AttributeController::class, 'attribute_group_remove'])->name('attributes.group.remove');
        //        =================================================  Orders ===================================================
        Route::post('/orders/update_delivery_status', [OrderController::class, 'update_delivery_status'])->name('orders.update_delivery_status');
        Route::post('/orders/get_orders', [OrderController::class, 'get_orders'])->name('orders.get');
        Route::post('/orders/get_with_status', [OrderController::class, 'get_with_status'])->name('orders.get_with_status');
         Route::post('/orders/searchKeyWord', [OrderController::class, 'searchKeyWord'])->name('orders.searchKeyWord');
        Route::get('/orders/{order}/print', [OrderController::class, 'print'])->name('orders.print');
        Route::get('/orders/{order}/print_peyk', [OrderController::class, 'print_peyk'])->name('orders.print_peyk');
        Route::post('/orders/active_sms', [OrderController::class, 'active_sms'])->name('order.active_sms');
        Route::post('/orders/remove', [OrderController::class, 'remove'])->name('order.remove');
        Route::get('orders/pagination/{show_per_page}/{payment_methods}', [OrderController::class, 'pagination'])->name('orders.pagination');
        Route::post('/orders/excel', [OrderController::class, 'excel'])->name('orders.excel');
        Route::get('/limit/edit', [OrderController::class, 'limit_edit'])->name('orders.limit');
        Route::put('/limit/update/{id}', [OrderController::class, 'limit_update'])->name('orders.limit.update');
        //        ======================================== transaction ===================================================
        Route::post('/transaction/get', [TransactionController::class, 'get'])->name('transactions.get');
        //        ======================================== OTHER FUNCTIONS ===================================================
        Route::post('/order/{order}/TrackingCodeUpdate', [OrderController::class, 'TrackingCodeUpdate'])->name('order.TrackingCodeUpdate');
        //        ======================================== OTHER FUNCTIONS ===================================================
        Route::resource('provinces', ProvinceController::class);
        Route::post('/provinces/remove', [ProvinceController::class,'province_remove'])->name('province.remove');
        Route::get('/cities/{province}/index', [ProvinceController::class,'cities_index'])->name('cities.index');
        Route::get('/cities/{province}/create', [ProvinceController::class,'city_create'])->name('city.create');
        Route::post('/cities/{province}/store', [ProvinceController::class,'city_store'])->name('city.store');
        Route::get('/cities/{city}/edit', [ProvinceController::class,'city_edit'])->name('city.edit');
        Route::put('/cities/{city}/update', [ProvinceController::class,'city_update'])->name('city.update');
        Route::post('/cities/remove', [ProvinceController::class,'city_remove'])->name('city.remove');
        //        ======================================== Group ===================================================
        Route::get('/group/index', [ProvinceController::class,'groups_index'])->name('groups.index');
        Route::get('/group/create', [ProvinceController::class,'group_create'])->name('group.create');
        Route::post('/group/store', [ProvinceController::class,'group_store'])->name('group.store');
        Route::get('/group/{group}/edit', [ProvinceController::class,'group_edit'])->name('group.edit');
        Route::put('/group/{group}/update', [ProvinceController::class,'group_update'])->name('group.update');
        Route::post('/group/remove', [ProvinceController::class,'group_remove'])->name('group.remove');
        Route::put('/bijack/{bijack}', [OrderController::class, 'order_bijack'])->name('bijack.update');
        Route::get('/bijack/{order}', [OrderController::class, 'bijack_show'])->name('bijack.show');
        //        ======================================== OTHER FUNCTIONS ===================================================
        Route::get('/contact', [CommentController::class, 'contact_index'])->name('contact.index');
        Route::get('/contact/show/{id}', [CommentController::class, 'contact_show'])->name('contact.show');
        Route::delete('/contact/destroy/{id}', [CommentController::class, 'contact_destroy'])->name('contact.destroy');
                //        ======================================== contacts ===================================================
        Route::get('/redirects/index',[RedirectJoomlaController::class,'index'])->name('redirects.index');
        Route::post('/redirects/store',[RedirectJoomlaController::class,'store'])->name('redirect.store');
        Route::post('/redirects/remove',[RedirectJoomlaController::class,'remove'])->name('redirect.remove');
    });
//Home

Route::get('/', [IndexHomeController::class, 'index'])->name('home.index');

Route::post('/insuranceResult', [IndexHomeController::class, 'insuranceResult'])->name('home.insuranceResult');
Route::get('/cashPage/{order}', [IndexHomeController::class, 'cashPage'])->name('home.cashPage');
//cart routes
Route::get('/cart', [CartController::class, 'index'])->name('home.cart');
Route::post('/add_to_cart', [CartController::class, 'add'])->name('home.cart.add');
Route::post('/get_cart_info', [CartController::class, 'get'])->name('home.cart.get');
Route::post('/update_cart', [CartController::class, 'update'])->name('home.cart.update');
Route::post('/remove_cart', [CartController::class, 'remove_cart'])->name('home.cart.remove');
Route::post('/remove_carts', [CartController::class, 'remove_carts'])->name('home.carts.remove');
Route::get('/clear_cart', [CartController::class, 'clear'])->name('home.cart.clear');
Route::post('/clear_cart', [CartController::class, 'clear'])->name('home.cart.clear');
Route::post('/checkCartAjax', [CartController::class, 'checkCartAjax'])->name('home.cart.checkCartAjax');

Route::get('/especialSale', [IndexHomeController::class, 'especialSale'])->name('home.especialSale');
Route::post('/emailNews/add', [IndexHomeController::class, 'AddEmailNews'])->name('home.emailNews.add');

Route::post('/check-coupon', [HomeCheckoutController::class, 'checkCoupon'])->name('home.coupons.check');
Route::get('/checkout', [HomeCheckoutController::class, 'checkout'])->name('home.checkout');
Route::post('/checkout_calculate_delivery', [HomeCheckoutController::class, 'checkout_calculate_delivery'])->name('home.checkout_calculate_delivery');
Route::post('/select_delivery_method', [HomeCheckoutController::class, 'select_delivery_method'])->name('home.select_delivery_method');
Route::post('/calculateAloPeykPrice', [HomeCheckoutController::class, 'calculateAloPeykPrice'])->name('home.calculateAloPeykPrice');
Route::post('/checkout/checkoutSaveStep1', [HomeCheckoutController::class, 'checkoutSaveStep1'])->name('home.checkoutSaveStep1');
Route::post('/checkout/AddPostalCodeToAddress', [HomeCheckoutController::class, 'AddPostalCodeToAddress'])->name('home.AddPostalCodeToAddress');
Route::post('/calculateDeliveryPrice', [HomeCheckoutController::class, 'calculateDeliveryPrice'])->name('home.calculateDeliveryPrice');
Route::get('/preview-checkout', [HomeCheckoutController::class, 'preview_checkout'])->name('home.checkout.preview');
Route::post('/WalletUsage', [HomeCheckoutController::class, 'WalletUsage'])->name('home.checkout.WalletUsage');
Route::post('/check_limit', [HomeCheckoutController::class, 'check_limit'])->name('home.checkout.check_limit');
Route::post('/check_national_code', [HomeCheckoutController::class, 'check_national_code'])->name('home.checkout.check_national_code');
Route::post('/check_sale_for_legal', [HomeCheckoutController::class, 'check_sale_for_legal'])->name('home.checkout.check_sale_for_legal');
Route::post('/add_national_code', [HomeCheckoutController::class, 'add_national_code'])->name('home.checkout.add_national_code');
Route::post('/payment', [PaymentController::class, 'payment'])->name('home.payment');
Route::post('/charge_wallet', [PaymentController::class, 'charge_wallet'])->name('home.payment.charge_wallet');
Route::get('/payment-verify/{gatewayName}', [PaymentController::class, 'paymentVerify'])->name('home.payment_verify');
Route::get('/payment-pasargad_verify', [PaymentController::class, 'pasargad_paymentVerify'])->name('home.pasargad_verify');
Route::get('/payment_pasargad_wallet_verify', [PaymentController::class, 'payment_pasargad_wallet_verify'])->name('home.payment_pasargad_wallet_verify');
Route::post('/payment-mellat_verify', [PaymentController::class, 'mellat_paymentVerify'])->name('home.mellat_verify');
Route::post('/order_cash2_submit/{order}', [PaymentController::class, 'cash_2_submit'])->name('home.cash_2_submit');

Route::post('/payment_wallet_verify', [PaymentController::class, 'payment_wallet_verify'])->name('home.payment_wallet_verify');
Route::get('/categories', [IndexHomeController::class, 'categories'])->name('home.categories');
Route::post('/search', [HomeProductController::class, 'search'])->name('home.product.search');
Route::get('/search', [HomeProductController::class, 'search_page'])->name('home.product.search');
Route::post('/products/variation_getPrice', [IndexHomeController::class, 'variation_getPrice'])->name('home.variation.getPrice');
Route::get('/brands', [HomeProductController::class, 'brands'])->name('home.brands');
Route::get('/articles', [ArticleHomeController::class, 'articles'])->name('home.articles');
Route::get('/article/{alias}', [ArticleHomeController::class, 'article'])->name('home.article');
Route::get('/articles/{category}/category', [ArticleHomeController::class, 'articles_category'])->name('home.articles.category');
//================================================== PRODUCT =====================================================================
Route::get('/product/{alias}', [HomeProductController::class, 'product'])->name('home.product');
Route::post('/product/productVariation', [HomeProductController::class, 'productVariation'])->name('home.product.productVariation');
Route::post('/getProductColors', [HomeProductController::class, 'getProductColors'])->name('home.getProductColors');
Route::post('/getAttributeVariation', [HomeProductController::class, 'getAttributeVariation'])->name('home.getAttributeVariation');
Route::post('/getAllProductVariations', [HomeProductController::class, 'getAllProductVariations'])->name('home.getAllProductVariations');
Route::post('/getAllProductColors', [HomeProductController::class, 'getAllProductColors'])->name('home.getAllProductColors');
Route::get('/product-categories/{category:alias}/', [HomeProductController::class, 'product_categories'])->name('home.product_categories');
Route::get('/product-categories-filter/{category}/{sort}/{price_amount}', [HomeProductController::class, 'product_categories_filter'])->name('home.product_categories_filter');
Route::get('/has_discount_products', [HomeProductController::class, 'has_discount_products'])->name('home.has_discount_products');
Route::post('/informMe', [HomeProductController::class, 'informMe'])->name('product.informMe');
Route::get('/torob', [HomeProductController::class, 'torob']);
Route::get('/emalls', [HomeProductController::class, 'emalls']);
//================================================== other products page =====================================================================
Route::get('/products/new', [HomeProductController::class, 'products_new'])->name('home.products.new');
Route::get('/products/special', [HomeProductController::class, 'products_special'])->name('home.products.special');
Route::get('/products/discount', [HomeProductController::class, 'products_discount'])->name('home.products.discount');
Route::get('/products-brand/{brand:alias}', [HomeProductController::class, 'products_brand'])->name('home.products.brand');
Route::get('/products/{type}/type', [HomeProductController::class, 'products_type'])->name('home.products.type');
//================================================== wishlist =====================================================================
Route::post('/add-to-wishlist/', [WishlistController::class, 'add'])->name('home.wishlist.add');
Route::post('/remove-from-wishlist/', [WishlistController::class, 'remove'])->name('home.wishlist.remove');
Route::post('/get-wishlist-info/', [WishlistController::class, 'get'])->name('home.wishlist.get');
Route::post('/check_order', [IndexHomeController::class, 'check_order'])->name('home.check_order');
//================================================== product compare =====================================================================
Route::get('/product-compare/index', [CompareController::class, 'index'])->name('home.compare');
Route::post('/compare/add', [CompareController::class, 'add'])->name('home.compare.add');
Route::post('/compare/get', [CompareController::class, 'get'])->name('home.compare.get');
Route::get('/compare/remove/{productId}', [CompareController::class, 'remove'])->name('home.compare.remove');
Route::post('/compare/remove_sideBar', [CompareController::class, 'remove_sideBar'])->name('home.compare.remove_sideBar');
//================================================== Contact Us =====================================================================
Route::get('/contact', [ContactController::class, 'index'])->name('home.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('home.contact');
//================================================== page =====================================================================
Route::get('page/{page:alias}', [IndexHomeController::class, 'page'])->name('home.page');
//automatic functions
Route::get('/visit_insurance', [DailyFunctions::class, 'index']);
Route::get('/ExpireOrder', [DailyFunctions::class, 'ExpireOrder']);

//login & logout
Route::get('/logout', [IndexHomeController::class, 'logout'])->name('logout');
Route::get('/login/{provider}', [AuthController::class, 'redirectToProvider'])->name('provider.login');
Route::get('/login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
//================================================== comments =====================================================================
Route::get('/comments/create', [HomeCommentController::class, 'create'])->name('home.comment.create');
Route::post('/comment_index/store', [HomeCommentController::class, 'store_index'])->name('home.comment_index.store');
Route::get('/comment_index/edit/{comment}', [HomeCommentController::class, 'edit'])->name('home.comment.edit');
Route::put('/comment_index/update/{comment}', [HomeCommentController::class, 'update_index'])->name('home.comment_index.update');
Route::get('/comment_index/delete/{comment}', [HomeCommentController::class, 'delete'])->name('home.comment_index.delete');
Route::post('/comments/{product}', [HomeCommentController::class, 'store'])->name('home.comments.store');
//redirect after login
Route::get('/redirects', [IndexHomeController::class, 'redirects'])->name('home.redirects');
//joomla redirect
Route::get('/component/jshopping/{alias?}/{alias2?}', [IndexHomeController::class, 'redirect_joomla']);
//================================================== profile =====================================================================
Route::prefix('profile')
    ->middleware('userAuth')
    ->name('home.')
    ->group(function () {
        Route::get('/', [UserProfileController::class, 'index'])->name('users_profile.index');
        Route::post('/userUpdateInfo', [UserProfileController::class, 'userUpdateInfo'])->name('userUpdateInfo');
        Route::post('/user/chang_password/{user}', [UserProfileController::class, 'change_password'])->name('user.chang_password');
        Route::get('/comments', [HomeCommentController::class, 'usersProfileIndex'])->name('comments.users_profile.index');
        Route::get('/wishlist', [WishlistController::class, 'usersProfileIndex'])->name('wishlist.users_profile.index');
        Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
        Route::get('/coupons', [UserProfileController::class, 'coupon'])->name('profile.coupon.index');
        Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
        Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
        Route::get('/addresses/{address}/delete', [AddressController::class, 'delete'])->name('addresses.delete');
        Route::get('/orders', [UserProfileController::class, 'orders'])->name('orders.users_profile.index');
        Route::get('/order/{order}/bijack', [UserProfileController::class, 'orders_bijack'])->name('orders.user_bijack');
        Route::get('/order/{order}', [UserProfileController::class, 'order_show'])->name('orders.users_profile.show');
        Route::get('/order/print/{order}', [UserProfileController::class, 'order_print'])->name('orders.users_profile.print');
        Route::post('/order_image/{order}/', [UserProfileController::class, 'order_image'])->name('orders.order_image');
        //ticket
        Route::get('/ticketIndex', [UserProfileController::class, 'TicketIndex'])->name('ticket.index');
        Route::get('/createTicket', [UserProfileController::class, 'createTicket'])->name('ticket.create');
        Route::post('/storeTicket', [UserProfileController::class, 'storeTicket'])->name('ticket.store');
        Route::get('/showTicket/{ticket}', [UserProfileController::class, 'showTicket'])->name('ticket.show');
        Route::post('/replay', [UserProfileController::class, 'replay'])->name('ticket.replay');
        //wallet
        Route::get('/wallet', [UserProfileController::class, 'wallet'])->name('profile.wallet.index');
        //informMe موجود شد به من اطلاع بده
        Route::get('/informMe', [UserProfileController::class, 'informMe'])->name('profile.informMe.index');
        Route::post('/informMe/remove', [UserProfileController::class, 'remove'])->name('profile.informMe.remove');
        //role_request درخواست اکانت همکار
        Route::get('/role-request', [UserProfileController::class, 'role_request_index'])->name('profile.role_request.index');
        Route::put('/change_role', [UserProfileController::class, 'change_role'])->name('profile.change_role');
        


    });
//CkEditor


Route::get('/check_order_expire', [DailyFunctions::class, 'check_order']);
Route::post('ckeditor/image_upload', [CKEditorController::class, 'upload'])->name('upload');
//sms send test
Route::post('/comment_login', [IndexHomeController::class, 'comment_login'])->name('comment_login');
Route::any('/smsLogin', [AuthController::class, 'smsLogin']);
Route::post('/check-otp', [AuthController::class, 'checkOtp']);
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
Route::get('/updateoption', [AttributeController::class, 'updateoption_value']);
//get cities
Route::get('/get-province-cities-list', [AddressController::class, 'getProvinceCitiesList']);
//Login Livewire
Route::get('/login', LoginIndex::class)->name('login');

Route::get('en',[IndexHomeController::class,'en'])->name('en');
Route::get('fa',[IndexHomeController::class,'fa'])->name('fa');
Route::post('maxen/news/join-user', [IndexHomeController::class, 'join_news'])->name('join.news');
