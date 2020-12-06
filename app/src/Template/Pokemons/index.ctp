<div style='width:80%; margin:0 auto; text-align:center;'>

<h2>ポケモン一覧</h2>
<?= $this->Html->link('ポケモンを追加したい場合はこちら',['controller'=>'pokemons','action'=>'add']) ?>
<ul>
<?php foreach($pokemons as $pokemon): ?>
<li style=' list-style:none; border: medium solid black; width:20%; margin:10px auto;'>
 <p>名前 : <?= $pokemon->name ?></p>
 <p>属性 : <?= $pokemon->attribute->attribute_name ?></p> 
 <?= $this->Html->image($pokemon->image, ['height' => 100, 'width' => 100]) ?>
 <?=$this->Html->link('編集',['controller'=>'pokemons','action'=>'edit',$pokemon->id])?> 
 <?= $this->Form->PostLink('削除',['controller'=>'pokemons','action'=>'delete','method'=>'delete', $pokemon->id ],['confirm' => 'このポケモンを削除してよろしいですか?']) ?>
 </li>
<?php endforeach; ?>
</ul>

<div class='paginator'>
  <ul class='pagination'>
      <?= $this->Paginator->first('最初へ')?>
      <?= $this->Paginator->prev('前へ')?>
      <?= $this->Paginator->numbers()?>
      <?= $this->Paginator->next('次へ')?>
      <?= $this->Paginator->last('最後へ')?>
</ul>
</div>

</div>
