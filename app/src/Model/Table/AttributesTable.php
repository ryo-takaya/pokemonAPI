<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AttributesTable extends Table{
    public function initialize(array $config)
    {
      parent::initialize($config);
      $this->setTable('attributes');
      $this->setPrimaryKey('id');
      $this->hasMany('Pokemons')
          ->foreignKey('attribute_id');
    }

   
}