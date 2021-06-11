<?php


namespace app\src\models;



use app\src\core\Model;

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