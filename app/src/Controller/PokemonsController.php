<?php

namespace App\Controller;

use Cake\Controller\Controller;

class PokemonsController extends Controller{

    public function initialize(){
        parent::initialize();
        $this->loadModel('Pokemons');
        $this->loadModel('Attributes');
    }

    public function index()
    {
        $pokemons = $this->Pokemons->find();
        $this->set(compact('pokemons'));
    }

    public function add()
    {
        $newPokemon = $this->Pokemons->newEntity();
        $attributes = $this->Attributes->find()->reduce(function ($array, $value){
         $array[$value->id] = "{$value->attribute_name}";
         return $array;
        },[]);
        if($this->request->is('post','patch')){
         $newPokemon = $this->Pokemons->patchEntity($newPokemon,$this->request->getData());
         
         if($this->Pokemons->save($newPokemon)){
          return $this->redirect(['action'=>'index']);
         }
        }
       
        $this->set('attributes',$attributes);
        $this->set('newPokemon', $newPokemon);
    }

    public function edit(string $name){
      $pokemon = $this->Pokemons->findByName($name)->firstOrFail();
      $attributes = $this->Attributes->find()->reduce(function ($array, $value){
        $array[$value->id] = "{$value->attribute_name}";
        return $array;
       },[]);
      if($this->request->is('put','patch')){
        $pokemon = $this->Pokemons->patchEntity($pokemon,$this->request->getData());
        if($this->Pokemons->save($pokemon)){
            return $this->redirect(['action'=>'index']);
        }
      }
      $this->set(compact('attributes'));
      $this->set(compact('pokemon'));
    }
}