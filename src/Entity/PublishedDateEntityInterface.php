<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 30.12.18
 * Time: 19:13
 */

namespace App\Entity;


interface PublishedDateEntityInterface
{
    public function setPublished(\DateTimeInterface $published): PublishedDateEntityInterface;
}
