
<?php

require_once 'Validation.php';

$data = [
  'name' => trim($_POST['name'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'phone' => trim($_POST['phone'] ?? ''),
    'password' => trim($_POST['password'] ?? ''),
];

$validator = new Validation();

$validator->check($data, [
    'name' => ['required', 'string'],
    'email' => ['required', 'email'],
    'phone' => ['required', 'phone'],
    'password' => ['required', 'string'],
]);

$errors = $validator->getErrors();

if (empty($errors)) {
    echo "Validation passed!";
} else {
    var_dump($errors);
}
