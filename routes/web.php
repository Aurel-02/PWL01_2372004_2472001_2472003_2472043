<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Redirect Setelah Login Berdasarkan Role
|--------------------------------------------------------------------------
*/

Route::get('/redirect-role', function () {

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->role === 'organizer') {
        return redirect()->route('organizer.dashboard');
    }

    return redirect()->route('user.dashboard');

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
    
    // ADMIN SCANNER
    Route::get('/admin/scan', [\App\Http\Controllers\AdminController::class, 'scanForm'])->name('admin.scan');
    Route::post('/admin/scan', [\App\Http\Controllers\AdminController::class, 'validateTicket'])->name('admin.scan.process');
    Route::get('/admin/report/export', [\App\Http\Controllers\ReportController::class, 'exportDashboard'])->name('admin.report.export');

    // ADMIN DATA MANAGEMENT
    Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
    
    Route::get('/admin/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

/*
|--------------------------------------------------------------------------
| Organizer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('/organizer/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('organizer.dashboard');
    
    // ORGANIZER SCANNER
    Route::get('/organizer/scan', [\App\Http\Controllers\AdminController::class, 'scanForm'])->name('organizer.scan');
    Route::post('/organizer/scan', [\App\Http\Controllers\AdminController::class, 'validateTicket'])->name('organizer.scan.process');
    Route::get('/organizer/report/export', [\App\Http\Controllers\ReportController::class, 'exportDashboard'])->name('organizer.report.export');
});

/*
|--------------------------------------------------------------------------
| Shared Admin & Organizer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role_any:admin,organizer'])->group(function () {
        Route::resource('events', EventController::class);
        Route::post('events/{event}/verify', [EventController::class, 'verify'])->name('events.verify');
        Route::get('waitlists', [\App\Http\Controllers\WaitlistController::class, 'index'])->name('waitlists.index');
        Route::post('waitlists/{waitlist}/promote', [\App\Http\Controllers\WaitlistController::class, 'promote'])->name('waitlists.promote');
        Route::post('events/{event}/ticket-types', [\App\Http\Controllers\TicketTypeController::class, 'store'])->name('events.ticket-types.store');
        Route::delete('events/{event}/ticket-types/{ticketType}', [\App\Http\Controllers\TicketTypeController::class, 'destroy'])->name('events.ticket-types.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('user.dashboard');
    
    // User - Event Details & Ticketing
    Route::get('/user/events/{event}', [\App\Http\Controllers\TransactionController::class, 'show'])->name('user.events.show');
    Route::post('/user/events/{event}/buy', [\App\Http\Controllers\TransactionController::class, 'store'])->name('user.events.buy');
    Route::post('/user/events/{event}/waitlist', [\App\Http\Controllers\WaitlistController::class, 'store'])->name('user.events.waitlist');
    
    // User - Payment Simulation
    Route::get('/user/transactions/{transaction}/payment', [\App\Http\Controllers\TransactionController::class, 'payment'])->name('transactions.payment');
    Route::post('/user/transactions/{transaction}/pay', [\App\Http\Controllers\TransactionController::class, 'processPayment'])->name('transactions.pay');
    Route::get('/user/transactions/{transaction}/success', [\App\Http\Controllers\TransactionController::class, 'success'])->name('transactions.success');
    
    // User - My Tickets
    Route::get('/user/my-tickets', [\App\Http\Controllers\TransactionController::class, 'myTickets'])->name('user.tickets');
    
    // User - Balance
    Route::get('/user/balance', [\App\Http\Controllers\BalanceController::class, 'index'])->name('user.balance');
    Route::post('/user/balance/topup', [\App\Http\Controllers\BalanceController::class, 'topup'])->name('user.balance.topup');

    // User - Scan/Validate
    Route::get('/user/scan', [\App\Http\Controllers\TicketCheckController::class, 'index'])->name('user.scan');
    Route::post('/user/scan', [\App\Http\Controllers\TicketCheckController::class, 'check'])->name('user.scan.process');
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';