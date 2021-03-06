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
            'order' => ['Pokemons.id' => 'DESC']
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
            $fileUrl = $this->Pokemons->uploadImage($this->request->getData('image'));
            $data = [
                'name' => $this->request->getData('name'),
                'attribute_id' => $this->request->getData('attribute_id'),
                'image' => $fileUrl
            ]; 
         $newPokemon = $this->Pokemons->patchEntity($newPokemon,$data);
         
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
            $this->Flash->error('失敗しました');
          }
        }
        return $this->redirect(['action'=>'index']);
    }
}