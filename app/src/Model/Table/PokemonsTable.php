<?php

namespace App\Model\Table;

use Cake\Validation\Validator;
use Cake\ORM\Table;

class PokemonsTable extends Table{
    public function initialize(array $config)
    {
      parent::initialize($config);
      $this->setTable('pokemons');
      $this->setPrimaryKey('id');
      $this->addBehavior('Timestamp');
    }

    public function test()
    {
        return 'test';
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}