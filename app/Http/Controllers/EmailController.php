<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateEmailRequest;
use App\Service\DomainValidationService;
use Illuminate\Http\Request;

class EmailController extends Controller
{


    public function __construct(
        protected DomainValidationService $domainValidationService
    ) {
    }

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
    public function validate(ValidateEmailRequest $request)
    {

        $validatedEmails = $this->domainValidationService->validate(collect($request->data));

        return response()->json($validatedEmails->toArray(), 200);
    }
}
