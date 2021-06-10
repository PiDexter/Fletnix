<?php


namespace app\src;


class Validator
{

    public array $errors = [];

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function validate(array $request, array $rules): bool|array
    {
        foreach ($request as $key => $value) {

            if (array_key_exists($key, $rules)) {

                foreach ($rules[$key] as $rule) {

                    if (!is_array($rule)) {

                        switch ($rule) {
                            case 'required':
                                if (empty($value)) {
                                    $this->errors[$key] = 'Required field cannot be empty';
                                }
                                break;

                            case 'type:email':
                                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                    $this->errors[$key] = 'Email address is not valid';
                                }
                                break;

                            case 'numeric':
                                if (!is_numeric($value)) {
                                    $this->errors[$key] = 'Only numbers are accepted';
                                }
                                break;

                            case 'string':
                                if (!is_string($value)) {
                                    $this->errors[$key] = 'Only letters are accepted';
                                }
                                break;

                            default:
                                break;
                        }
                    } else {
                        $this->handleRuleArray($value, $rule);
                    }
                }

            }
        }

        if (empty($this->errors)) {
            return true;
        }

        $this->errors = array_map(static function($value) { return '<label class="validation-error">' . $value . '</label>'; }, $this->errors);

        var_dump($this->errors);
        return $this->errors;
    }

    public function handleRuleArray($inputValue, array $rules): void
    {

        foreach ($rules as $rule => $value) {

            switch ($rule) {
                case 'min':
                    if (strlen($inputValue) < $value) {
                        $this->errors[$rule] = 'To short, use a minimum of ' . $value . ' characters';
                    }
                    break;

                case 'max':
                    if (strlen($inputValue) > $value) {
                        $this->errors[$rule] = 'To long, use a maximum of ' . $value . ' characters';
                    }
                    break;

                default:
                    break;
            }

        }
    }

}