
<?php

class Validation
{
    public array $errors = [];


public function check(array $data, array $validate): void
{ 
    // نفس فالديشن بروجيكت php
    $this->errors = [];

    foreach ($validate as $field => $fieldvalidate) {

        foreach ($fieldvalidate as $rule) {

            if ($rule === 'required') {
                if (!isset($data[$field]) ||(is_string($data[$field]))) {
                    $this->errors[$field] ??="The $field is required.";
                }
            }

            if ($rule === 'string' && isset($data[$field])) {
                if (!is_string($data[$field])) {
                    $this->errors[$field] ??="The $field must be a string.";
                }
            }

            if ($rule === 'email' && !empty($data[$field])) {
                $error = $this->validateEmail($data[$field]);

                if ($error !== '') {
                $this->errors[$field] ??= $error;
                }
            }

            if ($rule === 'phone' && !empty($data[$field])) {
                $error = $this->validatePhone($data[$field]);

                if ($error !== '') {
                    $this->errors[$field] ??= $error;
                }
            }

            if ($rule === 'password' && !empty($data[$field])) {
                $error = $this->validatePassword($data[$field]);

                if ($error !== '') {
                    $this->errors[$field] ??= $error;
                }
            }
        }
    }
}


    public function validateEmail($email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "invalid email";
        }

        return "";
    }

    public function validatePhone($phone): string
    {
        if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
            return "invalid phone number";
        }

        return "";
    }

    public function validatePassword($password): string
    {
        if (strlen($password) < 8) {
            return "password must be at least 8 characters long.";
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return "password must contain at least one uppercase letter.";
        }

        if (!preg_match('/[a-z]/', $password)) {
            return "password must contain at least one lowercase letter.";
        }

        if (!preg_match('/[0-9]/', $password)) {
            return "password must contain at least one number.";
        }

        if (!preg_match('/[\W_]/', $password)) {
            return "password must contain at least one special character.";
        }

        return "";
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
