<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Token;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Set how many failed logins are allowed before being locked out.
     */
    public $maxAttempts = 3;

    /**
     * Set how many seconds a lockout will last.
     */
    public $decayMinutes = 1;

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {

        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        $user = app('auth')->getProvider()->retrieveByCredentials($request->only('email', 'password'));
        if ( $user && $user->two_factor == 1) {
            //validate password
            if (! $this->guard()->validate($this->credentials($request)) ){
                $this->incrementLoginAttempts($request);

                return $this->sendFailedLoginResponse($request);
            }
            //user logged in clear his record
            $this->clearLoginAttempts($request);

            $token = Token::create([
                'user_id' => $user->id
            ]);

            if ($token->sendCode()) {

                session()->put("token_id", $token->id);
                session()->put("user_id", $user->id);
                session()->put("remember", $request->get('remember'));

                return redirect()->route("code");
            }

            $token->delete();// delete token because it can't be sent
            return redirect('/login')->withErrors([
                "Unable to send verification code"
            ]);
        }else{


            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }


        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Show second factor form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showCodeForm()
    {
//        dd(Session::all());
        if (! session()->has("token_id")) {
            return redirect("login");
        }

        return view("auth.code");
    }

    /**
     * Store and verify user second factor.
     */
    public function storeCodeForm(Request $request)
    {
        // throttle for too many attempts
        if (! session()->has("token_id", "user_id")) {
            return redirect("login");
        }

        $token = Token::find(session()->get("token_id"));
//        dd(\session()->all());

        if (! $token ||
            ! $token->isValid() ||
            $request->code !== $token->code ||
            (int)session()->get("user_id") !== $token->user->id
        ) {
            return redirect("code")->withErrors(["Invalid token"]);
        }

        $token->used = true;
        $token->save();
        $this->guard()->login($token->user, session()->get('remember', false));

        session()->forget('token_id', 'user_id', 'remember');

        return redirect('home');
    }
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
//        AUTHENTICATION COMPLETED
//        dd($user->two_factor);
//        if ($user->two_factor == 1){
//            return redirect()->route("code");
//        }else{
//            return redirect()->route("dashboard");
//        }
    }
}
