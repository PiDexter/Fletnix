<?php


namespace app\src\core;


use app\src\models\User;

class Validator
{

    public array $rules;
    public array $request;
    public array $errors = [];

    private array $errorMessages = [
        'required' => 'Required field cannot be empty',
        'email' => 'Email address is not valid',
        'numeric' => 'Only numbers are accepted',
        'string' => 'Only letters are accepted',
        'password:confirm' => 'Password does not match',
        'unique:email' => 'This email is already registered',
        'min' => 'To short, use a minimum of %s characters',
        'max' => 'To long, use a maximum of %s characters'
    ];

    /**
     * Validator constructor.
     * @param array $request
     * @param array $rules
     */
    public function __construct(array $request, array $rules)
    {
        $this->rules = $rules;
        $this->request = $request;
        $this->validate();
    }


    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->formatError();
    }


    private function formatError(): array
    {
        return array_map(static function($value) {
            return '<label class="input-block fullwidth validation-error">' . $value . '</label>';
        }, $this->errors);
    }


    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }


    public function validate(): void
    {
        foreach ($this->request as $inputField => $inputValue) {
            if ($this->inputFieldHasRule($inputField)) {
                foreach ($this->rules[$inputField] as $rule) {
                    if (!is_array($rule)) {
                        $this->parseRule($rule, $inputValue, $inputField);
                    } else {
                        $this->parseRuleArray($rule, $inputValue, $inputField);
                    }
                }
            }
        }
    }


    private function inputFieldHasRule($inputField): bool
    {
        return array_key_exists($inputField, $this->rules);
    }


    private function parseRule(string $rule, string $inputValue, string $inputField): void
    {
        switch ($rule) {
            case 'required':
                $this->checkRequired($inputValue, $inputField);
                break;

            case 'email':
                $this->isEmail($inputValue, $inputField);
                break;

            case 'numeric':
                $this->isNumeric($inputValue, $inputField);
                break;

            case 'string':
                $this->isString($inputValue, $inputField);
                break;

            case 'password:confirm':
                $this->checkPasswordMatch($inputValue, $inputField);
                break;

            case 'unique:email':
                $this->checkUniqueEmail($inputValue, $inputField);
                break;

            default:
                break;
        }
    }


    private function checkRequired(string $inputValue, string $inputField): void
    {
        if (empty($inputValue)) {
            $this->errors[$inputField] = $this->errorMessages['required'];
        }
    }


    private function isEmail(string $inputValue, string $inputField): void
    {
        if (!filter_var($inputValue, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$inputField] = $this->errorMessages['email'];
        }
    }


    private function isNumeric(string $inputValue, string $inputField): void
    {
        if (!is_numeric($inputValue)) {
            $this->errors[$inputField] = $this->errorMessages['numeric'];
        }
    }


    private function isString(string $inputValue, string $inputField): void
    {
        if (!is_string($inputValue)) {
            $this->errors[$inputField] = $this->errorMessages['string'];
        }
    }


    private function checkPasswordMatch(string $password, string $inputField): void
    {
        if ($password !== $this->getConfirmPassword()) {
            $this->errors[$inputField] = $this->errorMessages['password:confirm'];
        }
    }


    private function getConfirmPassword()
    {
        return $this->request['confirm_password'];
    }


    private function checkUniqueEmail(string $email, string $inputField): void
    {
        if ((new User)->getByEmail($email)) {
            $this->errors[$inputField] = $this->errorMessages['unique:email'];
        }
    }


    public function parseRuleArray(array $nestedRules, string $inputValue, string $inputField): void
    {
        foreach ($nestedRules as $rule => $value) {
            switch ($rule) {
                case 'min':
                    $this->checkMinLength($inputValue, $inputField, $value);
                    break;

                case 'max':
                    $this->checkMaxLength($inputValue, $inputField, $value);
                    break;

                default:
                    break;
            }
        }
    }


    private function checkMinLength(string $inputValue, string $inputField, int $minLength): void
    {
        if (strlen($inputValue) < $minLength) {
            $this->errors[$inputField] = sprintf($this->errorMessages['min'], $minLength);
        }
    }


    private function checkMaxLength(string $inputValue, string $inputField, int $maxLength): void
    {
        if (strlen($inputValue) > $maxLength) {
            $this->errors[$inputField] = sprintf($this->errorMessages['max'], $maxLength);
        }
    }

}