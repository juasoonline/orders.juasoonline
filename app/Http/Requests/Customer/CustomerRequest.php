<?php

namespace App\Http\Requests\Customer;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CustomerRequest extends FormRequest
{
    /**
     * @param Validator $validator
     */
    protected function failedValidation( Validator $validator )
    {
        throw new HttpResponseException(
            response() -> json([ 'status' => 'Error', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'errors' => $validator -> errors() -> all() ])
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        if ( in_array( $this -> getMethod (), [ 'PUT', 'PATCH' ] ) )
        {
            return $rules =
            [
                'data'                                                  => [ 'required' ],
                'data.id'                                               => [ 'required', 'string', 'exists:customers,id' ],
                'data.type'                                             => [ 'required', 'string', 'in:Customer' ],

                'data.attributes.first_name'                            => [ 'sometimes', 'string' ],
                'data.attributes.middle_name'                           => [ 'sometimes', 'string' ],
                'data.attributes.last_name'                             => [ 'sometimes', 'string' ],

                'data.attributes.email'                                 => [ 'sometimes', 'email', 'unique:customers,email' ],
                'data.attributes.mobile_phone'                          => [ 'sometimes', 'min:10', 'numeric', 'unique:customers,mobile_phone' ],
            ];
        }
        return
        [
            'data'                                                      => [ 'required' ],
            'data.type'                                                 => [ 'required', 'string', 'in:Customer' ],

            'data.attributes.first_name'                                => [ 'required', 'string' ],
            'data.attributes.middle_name'                               => [ 'sometimes', 'string' ],
            'data.attributes.last_name'                                 => [ 'required', 'string' ],

            'data.attributes.email'                                     => [ 'required', 'email', 'unique:customers,email' ],
            'data.attributes.mobile_phone'                              => [ 'required', 'min:10', 'numeric', 'unique:customers,mobile_phone' ],
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages() : array
    {
        return
        [
            'data.required'                                             => "The data field is invalid",

            'data.type.required'                                        => "The type is required",
            'data.type.string'                                          => "The type must be of a string",
            'data.type.in'                                              => "The type is invalid",

            'data.attributes.first_name.required'                       => "The first name is required",
            'data.attributes.first_name.string'                         => "The first name must be of a string type",

            'data.attributes.middle_name.string'                        => "The middle name must be of a string type",

            'data.attributes.last_name.required'                        => "The last name is required",
            'data.attributes.last_name.string'                          => "The last name must be of a string type",

            'data.attributes.email.required'                            => "The email is required",
            'data.attributes.email.email'                               => "The email address is invalid",
            'data.attributes.email.unique'                              => "The email address is already taken",

            'data.attributes.mobile_phone.required'                     => "The mobile phone number is required",
            'data.attributes.mobile_phone.min'                          => "The mobile phone number must have a minimum of 10 digits",
            'data.attributes.mobile_phone.numeric'                      => "The mobile phone number must only contain numbers",
            'data.attributes.mobile_phone.unique'                       => "The mobile phone number is already taken",
        ];
    }
}
