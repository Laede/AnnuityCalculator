<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;

class ValidateRequest
{
    /**
     * @var Validator
     */
    private $validator;

    public function __construct(Factory $validator)
    {

        $this->validator = $validator;
    }
    /**
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        try {
            $this->validator->validate($request->query(), [
                'loan' => 'required',
                'percent' => 'required|min:1|max:100',
                'months' => 'required|integer',
                'date' => 'required|date'
            ]);
        } catch (ValidationException $e)
        {
            return redirect(route('home'));
        }

        return $next($request);
    }
}