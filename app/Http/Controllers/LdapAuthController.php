<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

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

        if ( auth()->attempt( $request->only('username', 'password') ) ) {
            // Redirect to indented page or fall back to index page
            return redirect()->intended('/home');
        }

        return redirect()->back()->withErrors(
            'Username and/or Password are not matching!'
        );
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        auth()->logout();

        return redirect('/');
    }
}
