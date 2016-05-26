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

        $this->authenticate($request);

        return redirect()->back()->with('error', 'Username and/or Password are not matching!');
    }

    public function authenticate(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $web = $request->input('web');
        $id = Enseignant::getIdFromLogin($username);
        $user = false;

        if($id > 0){
            $user = auth()->attempt(array('username' => $username, 'password' => $password));
        }

        if ( $user ) {
            $token = null;
            try {
                // verify the credentials and create a token for the user
                if (! $token = JWTAuth::fromId($id)) {
                    http_response_code(401);
                    return json_encode(['error' => 'invalid_credentials']);
                }
            } catch (JWTException $e) {
                // something went wrong
                http_response_code(500);
                return (['error' => 'could_not_create_token']);
            }
            if($web){
                Session::put('jwt',$token);
                Session::put('connected_user', $username);
                Session::put('user_id', $id);
                Session::put('is_admin', Enseignant::getIsCoordoFromId($id));
            }

            $response = array('jwt' => $token,'connected_user' => $username,'user_id' => $id);
            http_response_code(200);
            return json_encode($response);
        }
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
        Session::forget('user_id');
        
        return redirect('/');
    }
}