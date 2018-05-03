<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/28/2018
 * Time: 10:37 AM
 */
class Setting extends TPBase
{
    public function getPhone()
    {
        return $this->getPostMeta('setting-phone');
    }
    public function getAddress()
    {
        return wpautop($this->getPostMeta('setting-address'));
    }
    public function getEmail()
    {
        return $this->getPostMeta('setting-email');
    }
    public function getHours()
    {
        return wpautop($this->getPostMeta('setting-hours'));
    }
}