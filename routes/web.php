<?php



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\User as UserController;
use App\Http\Controllers\Tache as TaskController;
use App\Http\Controllers\Admin as AdminController;
use App\Http\Controllers\Client as ClientController;
use App\Http\Controllers\Projet as ProjetController;
use App\Http\Controllers\Message as MessageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Personnel as PersonnelController;
use App\Http\Controllers\Commercial as CommercialController;

Route::get('/', function () {
     /*if (Auth::user()->role == 1)*/
     if ((Auth::user()->role == 2) || (Auth::user()->role == 4)) {
          return view('acceuilcommercial');
     } else if (Auth::user()->role == 3) {
          return view('accueilclient');
     }
     return redirect()->route('dashboard');
});
Route::get('/profile', function () {
     return view('profile', ['user' => Auth::user()]);
});

// Login routes

Route::post('/auth/login', [UserController::class, 'login'])
     ->name('check')
     ->middleware('guest');

Route::view('/login', 'LoginTest')
     ->name('login')
     ->middleware('guest');

// Register routes

Route::post('/auth/save', [UserController::class, 'create'])
     ->name('save');

// Logout route

Route::post('/auth/logout', [UserController::class, 'logout'])
     ->name('logout')
     ->middleware('auth');

// User routes

Route::get('/admin/userman', [UserController::class, 'list'])
     ->name('manageusers')
     ->middleware('auth');

Route::get('/user/delete/{id}', [UserController::class, 'delete'])
     ->name('delete')
     ->middleware('auth');


/* ********** Update Users **************** */

Route::get('/user/update/{id}', [UserController::class, 'index'])
     ->name('update')
     ->middleware('auth');

Route::post('/user/updatee/{id}', [UserController::class, 'update'])
     ->name('updatee')
     ->middleware('auth');

/* ************** END Update user ********* */

/* ************** Begin User Role ********* */
Route::get('/user/comm/{id}', [CommercialController::class, 'add'])
     ->name('commadd');

Route::get('/user/admin/{id}', [AdminController::class, 'add'])
     ->name('adminadd');

Route::get('/user/comm/', [CommercialController::class, 'search'])
     ->name('searchcomm');

Route::get('/index', function () {
     if ((Auth::user()->role == 2) || (Auth::user()->role == 4)) {
          return view('acceuilcommercial');
     } else if (Auth::user()->role == 3) {
          return view('accueilclient');
     }
     return redirect()->route('dashboard');
})
     ->name('home')
     ->middleware(['auth', 'verified']);

Route::post('/search', [UserController::class, 'search'])
     ->name('search')
     ->middleware('auth');

Route::get('/profile/{id}', [UserController::class, 'profile'])
     ->name('profile')
     ->middleware('auth');


Route::view('/admin/usersmanagment', 'usermanagement')
     ->name('usermanagement')
     ->middleware('auth');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
     ->name('dashboard')
     ->middleware('auth');

Route::GET('/searchlive/action', [UserController::class, 'action'])
     ->name('livesearch');


/**** Mail Verification  *******/
route::view('/verifyemaill', 'verifyemail')
     ->name('email');

Route::get('/email/verify', function () {
     return redirect()->route('email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
     $request->fulfill();

     return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
     $request->user()->sendEmailVerificationNotification();

     return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



/****** PROJECT ROUTES ******/
Route::get('/projectmanagement', [ProjetController::class, 'list'])
     ->name('projectmanage');
route::POST('/projetadd', [ProjetController::class, 'store'])
     ->name('projectadd');
Route::view('/projectaddd', 'projectadd')
     ->name('ajouterproject');
Route::get('/projectprofile/{id}', [ProjetController::class, 'projectprofile'])
     ->name('projectprofile');
Route::get('/projectdelete/{id}', [ProjetController::class, 'delete'])
     ->name('projectdelete');

/******** TASK Routes ******/
Route::post('/project/task/store/{id}', [TaskController::class, 'store'])
     ->name('taskstore');
Route::get('/project/task/delete/{id}', [TaskController::class, 'deleted'])
     ->name('deletetask');
Route::get('/project/task/add/{id}', [TaskController::class, 'taskaddview'])
     ->name('taskadd');
Route::get('/project/task/perso/{id}', [TaskController::class, 'persotask'])
     ->name('persotask');
Route::get('/project/task/profile/{id}', [TaskController::class, 'profiletask'])
     ->name('profiletask');
Route::get('/project/task/statut/{id}', [TaskController::class, 'statut'])
     ->name('statutchange');


/******* Password Reset ******/
Route::get('/forgot-password', function () {
     return view('forget-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
     $request->validate(['email' => 'required|email']);

     $status = Password::sendResetLink(
          $request->only('email')
     );

     return $status === Password::RESET_LINK_SENT
          ? back()->with(['status' => __($status)])
          : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
     return view('reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
     $request->validate([
          'token' => 'required',
          'email' => 'required|email',
          'password' => 'required|min:8|confirmed',
     ]);

     $status = Password::reset(
          $request->only('email', 'password', 'password_confirmation', 'token'),
          function ($user, $password) use ($request) {
               $user->forceFill([
                    'password' => Hash::make($password)
               ])->setRememberToken(Str::random(60));

               $user->save();
          }
     );

     return $status == Password::PASSWORD_RESET
          ? redirect()->route('login')->with('status', __($status))
          : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

/******* Recherche Instantanée *****/
Route::GET('/searchlive/aaction', [ClientController::class, 'actionn'])
     ->name('livesearcch');
Route::GET('/searchlive/action', [UserController::class, 'action'])
     ->name('livesearch');
Route::get('/messages/searchlive/destinataire', [UserController::class, 'destinataire'])
     ->name('destination');
Route::get('/searchclient/action', [PersonnelController::class, 'action'])
     ->name('tasklivesearch');

/*******Message Routes **********/
Route::get('/messages/inbox', [MessageController::class, 'listrecieved'])
     ->name('inbox');
Route::get('/messages/sent', [MessageController::class, 'listsent'])
     ->name('sentmsg');
Route::POST('/messages/submit', [MessageController::class, 'store'])
     ->name('msgstore');

Route::view('/message/dest', 'Destinataire')
     ->name('destinataire');
Route::get('/message/compose/{id}', [MessageController::class, 'composee'])
     ->name('composemsg');
Route::get('/message/view/{id}', [MessageController::class, 'viewmsg'])
     ->name('viewmsg');


/***** Personnel Routes *******/
Route::POST('/user/addpersonnel', [PersonnelController::class, 'store'])
     ->name('persoadd');
Route::view('/personnelforum', 'personnelcreate')
     ->name('persocreate');
Route::GET('/personnel/tasks', [TaskController::class, 'persotask'])
     ->name('taskmanagement');
