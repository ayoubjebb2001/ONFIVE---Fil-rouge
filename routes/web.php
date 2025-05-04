<?php

use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\JoinRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PlayerControlller;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamInvitationController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, '__invoke'])->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate')->middleware('guest');

route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('players', PlayerControlller::class)->middleware('auth');

Route::resource('teams', TeamController::class)->middleware('auth')
    ->missing(function (Request $request) {
        return Redirect::route('teams.create');
    });

Route::get('/teams/{team}/add-players', [TeamController::class, 'showAddPlayers'])->middleware(['auth', 'can:addPlayers,team'])->name('teams.add-players-form');

Route::get('players/search', [PlayerControlller::class, 'search'])->name('players.search');

Route::get('/teams/{team}/invite/{player}', [TeamController::class, 'InvitePlayer'])->middleware(['auth', 'can:invitePlayer,team'])->name('teams.invite');

// Notification routes
Route::get('/notifications', [NotificationController::class, 'index'])
    ->middleware('auth')->name('notifications.index');

Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
    ->middleware('auth')->name('notifications.read');

Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
    ->middleware('auth')->name('notifications.mark-all-read');

// Team invitation routes
Route::post('/team-invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])
    ->middleware('auth')->name('team-invitations.accept');

Route::post('/team-invitations/{invitation}/decline', [TeamInvitationController::class, 'decline'])
    ->middleware('auth')->name('team-invitations.decline');

// Join request routes
Route::post('/join-requests/{team}', [JoinRequestController::class, 'store'])
    ->middleware('auth')->name('join-requests.store');

Route::get('/join-requests/my-requests', [JoinRequestController::class, 'myRequests'])
    ->middleware('auth')->name('join-requests.my-requests');

Route::get('/teams/{team}/join-requests', [JoinRequestController::class, 'index'])
    ->middleware(['auth', 'can:view,team'])->name('join-requests.index');

Route::post('/join-requests/{joinRequest}/accept', [JoinRequestController::class, 'accept'])
    ->middleware('auth')->name('join-requests.accept');

Route::post('/join-requests/{joinRequest}/decline', [JoinRequestController::class, 'decline'])
    ->middleware('auth')->name('join-requests.decline');
