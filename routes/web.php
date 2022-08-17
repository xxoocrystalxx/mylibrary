<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\AuthorController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\GenreController;
use App\Http\Controllers\Dashboard\MyLibraryController;
use App\Http\Controllers\Dashboard\ReviewController;

/*------------------------------------------
Guest Routes List
--------------------------------------------*/

Route::get('/', function () {
    return view('frotend.index');
})->name('home');

Route::controller(BookController::class)->group(function () {
    Route::get('/book/details/{id}', 'BookDetails')->name('book.details');
    Route::get('/book/rank', 'BookRank')->name('book.rank');
});

Route::get('/genre/details/{id}', [GenreController::class, 'GenreDetails'])->name('genre.details');
Route::get('/genre/list', [GenreController::class, 'GenreList'])->name('genre.list');
Route::get('/author/list', [AuthorController::class, 'AuthorList'])->name('author.list');
Route::get('/author/details/{id}', [AuthorController::class, 'AuthorDetails'])->name('author.details');

Route::post('/search', [BookController::class, 'SearchList'])->name('search');

/*------------------------------------------
MANAGER and ADMIN Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager,super-admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::controller(AuthorController::class)->group(function () {
        Route::get('/all/author', 'AllAuthor')->name('all.author');
        Route::get('/add/author', 'AddAuthor')->name('add.author');
        Route::post('/store/author', 'StoreAuthor')->name('store.author');
        Route::post('/update/author/{id}', 'UpdateAuthor')->name('update.author');
        Route::get('/delete/author/{id}', 'DeleteAuthor')->name('delete.author');
    });

    Route::controller(BookController::class)->group(function () {
        Route::get('/all/book', 'AllBook')->name('all.book');
        Route::get('/add/book', 'AddBook')->name('add.book');
        Route::post('/store/book', 'StoreBook')->name('store.book');
        Route::get('/delete/book/{id}', 'DeleteBook')->name('delete.book');
        Route::get('/edit/book/{id}', 'EditBook')->name('edit.book');
        Route::post('/update/book', 'UpdateBook')->name('update.book');
    });

    Route::controller(GenreController::class)->group(function () {
        Route::get('/all/genre', 'AllGenre')->name('all.genre');
        Route::get('/add/genre', 'AddGenre')->name('add.genre');
        Route::post('/store/genre', 'StoreGenre')->name('store.genre');
        Route::post('/update/genre/{id}', 'UpdateGenre')->name('update.genre');
        Route::get('/delete/genre/{id}', 'DeleteGenre')->name('delete.genre');
    });
});


/*------------------------------------------
Normal Users Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/write/review/{id}', [ReviewController::class, 'WriteReview'])->name('write.review');
    Route::post('/store/rating/{id}', [ReviewController::class, 'StoreRating']);

    Route::controller(ReviewController::class)->group(function () {
        Route::get('/write/review/{id}', 'WriteReview')->name('write.review');
        Route::post('/store/rating/{id}', 'StoreRating');
        Route::post('/store/review/', 'StoreReview')->name('store.review');
        Route::get('/my/reviews', 'MyReviews')->name('my.reviews');
        Route::get('/edit/review/{id}', 'EditReview')->name('edit.review');
        Route::get('/delete/review/{id}', 'DeleteReview')->name('delete.review');
        Route::post('/update/review/{id}', 'UpdateReview')->name('update.review');
    });

    Route::controller(MyLibraryController::class)->group(function () {
        Route::post('/store/library', 'StoreLibrary')->name('store.library');
        Route::get('/my/library/', 'MyLibrary')->name('my.library');
        Route::get('/delete/reading/book/{id}', 'DeleteReadingBook')->name('delete.reading.book');
    });
});

/*------------------------------------------
All Super Admin Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:super-admin'])->group(function () {
});

/*------------------------------------------
All Admin Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all.user');
        Route::get('/delete/user/{id}', 'DeleteUser')->name('delete.user');
    });
});

/*------------------------------------------
All logged user routes
--------------------------------------------*/
Route::middleware(['auth'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');
    });
});


require __DIR__ . '/auth.php';
