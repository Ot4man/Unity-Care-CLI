<?php

class Validation
{
    public static function notEmpty($value): bool
    {
        return preg_match('/\S+/', $value);
    }

    public static function email($email): bool
    {
        return preg_match('/^[\w\.-]+@[\w\.-]+\.\w{2,}$/', $email);
    }

    public static function phone($phone): bool
    {
        return preg_match('/^\+?[0-9]{8,15}$/', $phone);
    }
}
