<?php

abstract class Person
{
    protected string $first_name;
    protected string $last_name;
    protected string $phone;
    protected string $email;
    protected PDO $db;

    public function __construct(PDO $db, $fn, $ln, $phone, $email)
    {
        $this->db = $db;
        $this->first_name = $fn;
        $this->last_name = $ln;
        $this->phone = $phone;
        $this->email = $email;
    }
}
