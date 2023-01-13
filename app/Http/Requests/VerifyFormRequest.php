<?php

namespace App\Http\Requests;

use App\Rules\MinSizeRule;
use App\Rules\MinSpecialCharsRule;
use App\Rules\MinDigitRule;
use App\Rules\MinUppercaseRule;
use App\Rules\MinLowercaseRule;
use App\Rules\NoRepetedRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyFormRequest extends FormRequest
{
    protected array $rules = [];
    protected array $match = [];
    protected bool $verify = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->rules = [
            "minSize"         => 8,
            "minSpecialChars" => 2,
            "noRepeted"       => 0,
            "minDigit"        => 4,
            "minUppercase"    => 1,
            "minLowercase"    => 1
        ];

        return [
            'password' => [
                new NoRepetedRule(),
                new MinSizeRule($this->rules['minSize']),
                new MinDigitRule($this->rules['minDigit']),
                new MinUppercaseRule($this->rules['minUppercase']),
                new MinLowercaseRule($this->rules['minLowercase']),
                new MinSpecialCharsRule($this->rules['minSpecialChars'])
            ]
        ];
    }

    /**
     * Get the user objects and merge.
     *
     * @return array
     */
    protected function passedValidation()
    {
        $this->merge([
            'rules'  => $this->rules,
            'match'  => $this->match,
            'verify' => $this->verify,
        ]);
    }


    /**
     * In case validation fails, return message.
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $this->verify = false;
        $this->match = $validator->errors()->all();
    }

}
