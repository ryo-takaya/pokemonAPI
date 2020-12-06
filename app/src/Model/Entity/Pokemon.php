<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Pokemon extends Entity{
    protected $_accessible = [
        'name' => true,
        'attribute_id' => true,
        'created' => false,
        'modified' => false
    ];
}