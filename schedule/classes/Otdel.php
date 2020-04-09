<?php


class Otdel extends Table
{
    public $otdel_id = 0;
    public $name = '';
    public $active = 1;
    
    public function validate()
    {
        return false;
    }
}