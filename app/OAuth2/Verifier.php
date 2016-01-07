<?php
/**
 * Created by PhpStorm.
 * User: Elton
 * Date: 03/01/2016
 * Time: 13:09
 */

namespace CodeProject\OAuth2;

use Illuminate\Support\Facades\Auth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}