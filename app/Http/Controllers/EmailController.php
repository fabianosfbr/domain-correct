<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateEmailRequest;
use App\Service\DomainValidationService;
use Illuminate\Http\Request;

/**
 * @group Email
 *
 * APIs for managing emails
 */
class EmailController extends Controller
{
    public function __construct(
        protected DomainValidationService $domainValidationService
    ) {
    }

    /**
     * Validate email
     *
     * To send request to this endpoint, you need to provide and `API KEY` in the header of the request.
     *
     * You can use the following instruction in your header to send request to this endpoint.
     *
     * ````
     *  Authorization: Bearer YOUR_API_KEY
     * ````
     *
     * @param  ValidateEmailRequest  $request  Request data
     * @return \Illuminate\Http\JsonResponse
     *
     * @queryParam data array required Array of data to validate.
     *
     *
     * @response array{data: array{array{email: "user@example.com", is_valid: true, user: "user", domain: "example.com", sugestion: "validexample.com"}}}
     */
    public function validate(ValidateEmailRequest $request)
    {
        $validatedEmails = $this->domainValidationService->validate(collect($request->data));

        return response()->json($validatedEmails->toArray(), 200);
    }
}
