<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/29/2018
 * Time: 9:03 PM
 */
class Staff extends TPBase
{
    public function getPosition()
    {
        return $this->getPostMeta('position');
    }
    public function getImage()
    {
        return $this->getPostMeta('staff-image');
    }
    public function getEmail()
    {
        return $this->getPostMeta('staff-email');
    }
}