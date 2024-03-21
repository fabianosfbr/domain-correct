<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{



    /**
     * @param  Request  $request  Request data
     * @return \Illuminate\Http\JsonResponse
     *
     * @queryParam data array required Array of data to validate.
     *
     * validate
     *
     * @response array{data: array{array{email: "user@example.com", user: "user", domain: "example.com", sugestion: "validexample.com"}}}
     */
    public function validate(Request $request)
    {

        return response()->json(['data' => 'ok'], 200);
    }
}
