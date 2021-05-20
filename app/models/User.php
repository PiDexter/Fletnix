<?php


namespace app\models;


use app\src\Model;

class User extends Model
{

    protected array $fillableColumns = [
        'email',
        'password',
        'first_name',
        'last_name',
        'country',
        'date_of_birth',
    ];

    public function exists(string $email): bool
    {
        return $this->where('email', "=", $email)->find();
    }

}