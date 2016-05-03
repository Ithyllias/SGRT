<?php

namespace App\Http\Controllers;

use App\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use Illuminate\Support\Facades\Session;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LdapAuthController extends Controller
{
    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postLogin(Request $request)
    {
        // Validate credentials
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');

        $id = Enseignant::getIdFromLogin($username);
        $user = false;

        if($id > 0){
            $user = auth()->attempt($request->only('username', 'password'));
        }

        if ( $user ) {
            $token = null;
            try {
                // verify the credentials and create a token for the user
                if (! $token = JWTAuth::fromId($id)) {
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e) {
                // something went wrong
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
            //Redirect to indented page or fall back to index page
            Session::put('jwt',$token);
            Session::put('connected_user', $username);
            return redirect()->intended('/home');
        }

        return redirect()->back()->with('error', 'Username and/or Password are not matching!');
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        Session::forget('jwt');
        Session::forget('connected_user');

        return redirect('/');
    }
}
