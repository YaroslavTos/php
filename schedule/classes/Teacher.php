<?php


class Teacher extends Table
{
    public $user_id=0;
    public $otdel_id=0;
    public function validate()
    {
        return false;
    }
}