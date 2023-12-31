<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PusherController;


### Start Guest Routes ###

Route::get('/', [Controllers\ItemController::class, 'indexmain'])->name('indexmain');

Route::get('/about', function () {
    return view('Template component/about');
});
Route::get('/contact', function () {
    return view('Template component/contact');
});
Route::get('/faq', function () {
    return view('Template component/faq');
});
Route::get('/product-detail', function () {
    return view('Template component/product-detail');
});
Route::get('/sign-in', function () {
    return view('Sign/sign-in');
});
Route::get('/sign-up', function () {
    return view('Sign/sign-up');
});
### End Guest Routes ###

Route::get('/chat/{Id}', 'App\Http\Controllers\PusherController@index')->name('chatIndex');
Route::post('/broadcast', 'App\Http\Controllers\PusherController@broadcast');
Route::post('/receive', 'App\Http\Controllers\PusherController@receive');
Route::delete('/chat/{id}', 'App\Http\Controllers\PusherController@destroy')->name('deleteMessages');
Route::get('/admin/chatAdmin', [Controllers\PusherController::class, 'indexAdmin'])->name('pusher.indexAdmin');
Route::post('/admin/chatAdminSend', [Controllers\PusherController::class, 'chatAdminSend'])->name('pusher.chatAdminSend');
Route::put('/messages/{id}', 'App\Http\Controllers\AdminChatController@update')->name('updateMessage');
Route::delete('/delete-message/{id}', 'App\Http\Controllers\PusherController@delete')->name('deleteMessage');

Route::get('/admin_chat/create', 'App\Http\Controllers\AdminChatController@create')->name('adminChat.create');
Route::post('/admin_chat/store', 'App\Http\Controllers\AdminChatController@store')->name('adminChat.store');
Route::get('/admin_chat', 'App\Http\Controllers\AdminChatController@index')->name('adminChat.index');
Route::get('/admin_chat/{id}/edit', 'App\Http\Controllers\AdminChatController@edit')->name('adminChat.edit');
Route::put('/admin_chat/{id}/update', 'App\Http\Controllers\AdminChatController@update')->name('adminChat.update');
Route::delete('/admin_chat/{id}/destroy', 'App\Http\Controllers\AdminChatController@destroy')->name('adminChat.destroy');



Route::get('/showmain/{id}', [Controllers\ItemController::class, 'showmain'])->name('showmain');
//Route::resource('/products',Controllers\ItemController::class);

//Route::resource('/items', Controllers\ItemController::class);
Route::get('/items', [Controllers\ItemController::class, 'index'])->name('items.index');
Route::get('/items/create', [Controllers\ItemController::class, 'create'])->name('items.create');
Route::post('/items', [Controllers\ItemController::class,'store'])->name('items.store');
Route::get('/items/{item}', [Controllers\ItemController::class,'show'])->name('items.show');
Route::get('/items/{item}/edit', [Controllers\ItemController::class,'edit'])->name('items.edit');
Route::put('/items/{item}', [Controllers\ItemController::class,'update'])->name('items.update');
Route::delete('/items/{item}', [Controllers\ItemController::class,'destroy'])->name('items.destroy');
Route::get('/items/main', [Controllers\ItemController::class,'indexmain'])->name('items.indexmain');
Route::get('/items/{id}/showmain',[Controllers\ItemController::class,'showmain'])->name('items.showmain');
Route::get('/download-pfe/{id}', [Controllers\ItemController::class, 'downloadPFE'])->name('download.pfe');

//Route::resource('/admin/itemsAdmin', Controllers\ItemAdminController::class);


//Remove this or you'll get banned :( :p
//Route::resource('/admin/tradesAdmin', App\Http\Controllers\AdminTradeController::class);
Route::group(['prefix'=>'admin','middleware'=>['admin','auth']], function() {
Route::get('/tradesAdmin', [Controllers\AdminTradeController::class, 'index'])->name('tradesAdmin.index');
Route::get('/tradesAdmin/{id}', [Controllers\AdminTradeController::class, 'show'])->name('tradesAdmin.show');
Route::delete('/tradesAdmin/{id}', [Controllers\AdminTradeController::class,'destroy'])->name('tradesAdmin.destroy');
});

Route::resource('Comment', Controllers\CommentController::class);
//Route::resource('Complaint', Controllers\ComplaintsController::class);
Route::resource('Conversation', Controllers\ConversationController::class);
Route::resource('Message', Controllers\MessageController::class);




Route::get('/posts', [Controllers\PostController::class, 'index'])->name('posts.index');
//The resource will overwrite the bellow line
Route::get('/posts/create', [Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/post/{post}', [Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('posts/{post}/edit', [Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::delete('/posts/{post}', [Controllers\PostController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/{post}', [Controllers\PostController::class, 'update'])->name('posts.update');
Route::get('/posts/create', [Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/sort-by-date-asc', [Controllers\PostController::class, 'sortByDateAsc'])->name('posts.sortByDateAsc');
Route::get('/post/{post}', [Controllers\PostController::class, 'show'])->name('posts.show');


Route::get('/complaints/create', [Controllers\ComplaintsController::class, 'goToComplaintPage'])->name('complaints.create');
Route::post('/complaints', [Controllers\ComplaintsController::class, 'store'])->name('complaints.store');

Route::get('/user/profile',[Controllers\UsersController::class,'edit'])->name('edit-profile');
Route::put('/user/profile',[Controllers\UsersController::class,'update'])->name('update-profile');
Route::put('/user/profile/image/update',[Controllers\UsersController::class,'updateProfileImage'])->name('update-profile-image');

### Start Admin Routes ###
// The Prefix is added after login based on user role - Auth LoginController
Route::group(['prefix'=>'admin','middleware'=>['admin','auth']], function(){
    //dashboard
    Route::get('/', [Controllers\AdminController::class,'index'])->name('admin-dashboard');;


//Complaint routes
Route::get('/complaints', [Controllers\ComplaintsController::class, 'index'])->name('complaints.index');
Route::put('/complaints/{complaint}', [Controllers\ComplaintsController::class, 'update'])->name('complaints.update');
Route::delete('/complaints/{complaintId}', [Controllers\ComplaintsController::class, 'destroy'])->name('complaints.delete');

//Please change the resource to individual links
    // Route::resource('Post', Controllers\PostController::class);


Route::get('/post', [Controllers\PostController::class, 'allPost'])->name('posts.allPost');
Route::post('/post', [Controllers\PostController::class, 'storeToAdmin'])->name('posts.storeToAdmin');
Route::get('/post/{post}/edit', [Controllers\PostController::class, 'editToAdmin'])->name('posts.editToAdmin');
Route::put('/post/{post}', [Controllers\PostController::class, 'updateToAdmin'])->name('posts.updateToAdmin');
Route::delete('/posts/{post}',[Controllers\PostController::class, 'destroyAdmin'])->name('posts.destroyAdmin');


Route::delete('/commentDelete/{comment}', [Controllers\CommentController::class, 'destroyByAdmin'])->name('comments.destroyByAdmin');
Route::post('/comments', [Controllers\CommentController::class, 'storeFromAdmin'])->name('comments.storeFromAdmin');
Route::get('/comment/{comment}/edit', [Controllers\CommentController::class, 'editFromAdmin'])->name('comments.editFromAdmin');
Route::put('/comment/{comment}', [Controllers\CommentController::class, 'updateFromAdmin'])->name('comments.updateFromAdmin');
Route::get('/comment', [Controllers\CommentController::class, 'allComment'])->name('comments.allComment');

//Users Management
    Route::get('users/',[Controllers\AdminController::class,'index'])->name('users.index');
    Route::get('users/create',[Controllers\AdminController::class,'create'])->name('users.create');
    Route::post('users/',[Controllers\AdminController::class,'store'])->name('users.store');
    Route::post('/{user}/grantAdminPrivileges',[Controllers\AdminController::class,'grantAdminPrivileges'])->name('users.grant-admin-privileges');
    Route::post('{userId}/revokeAdminPrivileges',[Controllers\AdminController::class,'revokeAdminPrivileges'])->name('users.revoke-admin-privileges');
    Route::delete('{userId}/deleteUser',[Controllers\AdminController::class,'deleteUser'])->name('users.delete-user');
    //Profile
    Route::get('users/profile',[Controllers\UsersController::class,'edit'])->name('user.edit-profile');
    Route::put('users/profile',[Controllers\UsersController::class,'update'])->name('user.update-profile');
    Route::put('users/profile/image/update',[Controllers\UsersController::class,'updateProfileImage'])->name('user.update-profile-image');

    //Items Management

    Route::get('itemsAdmin', [Controllers\ItemAdminController::class, 'index'])->name('itemsAdmin.index');
    Route::get('itemsAdmin/create', [Controllers\ItemAdminController::class, 'create'])->name('itemsAdmin.create');
    Route::post('itemsAdmin', [Controllers\ItemAdminController::class, 'store'])->name('itemsAdmin.store');
    Route::get('itemsAdmin/{id}', [Controllers\ItemAdminController::class, 'show'])->name('itemsAdmin.show');
    Route::get('itemsAdmin/{id}/edit', [Controllers\ItemAdminController::class, 'edit'])->name('itemsAdmin.edit');
    Route::put('itemsAdmin/{id}', [Controllers\ItemAdminController::class, 'update'])->name('itemsAdmin.update');
    Route::delete('itemsAdmin/{id}', [Controllers\ItemAdminController::class,'destroy'])->name('itemsAdmin.destroy');
    Route::get('download-items', [Controllers\ItemAdminController::class, 'downloadItems'])->name('downloadItems');
    //Category Management

    Route::get('categories', [Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');


});

Route::get('/comments/create', [Controllers\CommentController::class, 'create'])->name('comments.create');

Route::resource('comments', Controllers\CommentController::class);
Route::post('/comments', [Controllers\CommentController::class, 'store'])->name('comments.store');
Route::post('/commentPost', [Controllers\CommentController::class, 'storePost'])->name('comments.storePost');
Route::delete('/commentDelete/{comment}', [Controllers\CommentController::class, 'delete'])->name('comments.delete');

Route::delete('/commentDelete/{comment}', [Controllers\CommentController::class, 'delete'])->name('comments.delete');


// Routes pour TradeController
    Route::get('/trades', [Controllers\TradeController::class, 'index'])->name('trades.index');
    Route::get('/tradess', [Controllers\TradeController::class, 'index1'])->name('trades.index1');
    Route::get('/trades/create', [Controllers\TradeController::class, 'create'])->name('trades.create');
    Route::post('/trades', [Controllers\TradeController::class, 'store'])->name('trades.store');
    Route::get('/trades/{id}', [Controllers\TradeController::class, 'show'])->name('trades.show');
    Route::get('/trades/{id}/edit', [Controllers\TradeController::class, 'edit'])->name('trades.edit');
    Route::put('/trades/{id}', [Controllers\TradeController::class, 'update'])->name('trades.update');
    Route::delete('/trades/{id}', [Controllers\TradeController::class, 'destroy'])->name('trades.destroy');
    Route::get('/trades/search/{search}', [Controllers\TradeController::class, 'search'])->name('trades.search');
    Route::get('/calendar', [Controllers\TradeController::class, 'calendar'])->name('trades.calendar');
    Route::get('/calendarr', [Controllers\TradeController::class, 'calendarr'])->name('trades.calendarr');

    Route::post('/trades/{trade}/accept', [Controllers\TradeController::class, 'accept'])->name('trades.accept');
    Route::post('/trades/{trade}/reject', [Controllers\TradeController::class, 'reject'])->name('trades.reject');

    Route::get('/avis/create', [Controllers\AvisController::class, 'create'])->name('avis.create');
    Route::post('/avis', [Controllers\AvisController::class, 'store'])->name('avis.store');

    // Edit an existing avis
    Route::get('/avis/{id}/edit', [Controllers\AvisController::class, 'edit'])->name('avis.edit');
    Route::put('/avis/{id}', [Controllers\AvisController::class, 'update'])->name('avis.update');

// Delete an avis
Route::delete('/avis/{id}', [Controllers\AvisController::class, 'destroy'])->name('avis.destroy');





//Route::resource('/trades', Controllers\TradeController::class);
//Route::get('/trades/search/{search}', 'App\Http\Controllers\TradeController@search')->name('trades.search');



//Route::resource('admin/categories', Controllers\CategoryController::class);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


