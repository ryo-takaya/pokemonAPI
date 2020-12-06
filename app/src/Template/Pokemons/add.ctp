<h1>追加したいポケモンを送信してください</h1>

<?=$this->Form->create($newPokemon,['type'=>'file']);?>
<?=$this->Form->control('name');?>
<?=$this->Form->select('attribute_id',$attributes);?>
<?=$this->Form->file('image');?>
<?= $this->Form->submit('Post Pokemon'); ?>
<?=$this->Form->end();?>



