<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;


class LoginController extends Controller
{
    protected $maxAttempts = 3; 
    protected $decayMinutes = 5; 
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }
    public function vuelogin(Request $request)
    {
        $this->validateLogin($request);
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

                $user = User::select("*")->where('email',$request->email)->first();
            
                    $token = $user->createToken('Dishtansya')->accessToken;
                return response("'Access Token'=>$token",201);     
            }
            else {
                $message = ['message'=>'Invalid credentials'];
                return response( $message, 401);
            }
    }
    

}
