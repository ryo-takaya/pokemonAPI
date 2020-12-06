<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Datasource\Exception\RecordNotFoundException;

class PokemonsController extends AppController{

    public function initialize(){
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Pokemons');
        $this->loadModel('Attributes');
    }


    public function index()
    {
        
        $pokemons = $this->Paginate($this->Pokemons->find()->contain('Attributes'),[
            'limit' => 5,
            'order' => ['Pokeons.id' => 'DESC']
        ]);
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

    public function edit(string $id){
        try{
            $pokemon = $this->Pokemons->findById($id)->firstOrFail();
        }catch(RecordNotFoundException $e){
            throw new RecordNotFoundException('存在しないポケモンです');
        }
      
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

    public function delete(string $id){
        try{
            $pokemon = $this->Pokemons->findById($id)->firstOrFail();
        }catch(RecordNotFoundException $e){
            throw new RecordNotFoundException('存在しないポケモンです');
        }
        
        if($this->request->is('post')){
          if($this->Pokemons->delete($pokemon)){
            $this->Flash->success('成功しました');
          }else{
              var_dump('失敗');
            $this->Flash->error(__('The {0} article has been deleted.', $pokemon->name));
          }
        }
        return $this->redirect(['action'=>'index']);
    }
}