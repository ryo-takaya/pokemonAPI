<?php

namespace App\Model\Table;

use Cake\Validation\Validator;
use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\ORM\Rule\IsUnique;

class PokemonsTable extends Table{
    public function initialize(array $config)
    {
      parent::initialize($config);
      $this->setTable('pokemons');
      $this->setPrimaryKey('id');
      $this->addBehavior('Timestamp');

      $this->belongsTo('Attributes')
           ->setForeignKey('attribute_id');
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
      $rules->add($rules->isUnique(
        ['name'],
        'このポケモンの名前はすでに使われています'
    ));
      
      return $rules;
    }
}