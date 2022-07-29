<?php

use App\Models\Photo;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::get('/article', function () {
    return Inertia::render('Article', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
        'photos' => Photo::all(),
    ]);
});

// Back-office

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/', function () { return Inertia::render('Dashboard'); })->name('dashboard');



    // Photo

    Route::get('/photos', function () {
        return inertia('Admin/Photos', ['photos' => Photo::all(),]);
    })->name('photos');

    Route::get('/photos/create', function () {
        return inertia('Admin/PhotosCreate');
    })->name('photos.create');

    Route::post('/photos', function (Request $request) {

        $validated_data = $request->validate([
            'path' => ['required', 'image', 'max:2500'],
            'description' => ['required']
        ]);
        $path = Storage::disk('public')->put('photos', $request->file('path'));
        $validated_data['path'] = $path;
        Photo::create($validated_data);
        return to_route('admin.photos');
    })->name('photos.store');


    // Posts

    Route::get('/posts', function () {
        return inertia('Admin/Posts');
    })->name('posts');
});
