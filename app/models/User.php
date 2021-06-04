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


    public function getByEmail($email)
    {
        return $this->builder
            ->select(['user_id', 'email', 'first_name', 'password'], $this->getTable())
            ->where('email', '=', $email)
            ->query()->fetchObject();
    }

}