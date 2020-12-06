<h2>編集ページ</h2>

<?= $this->Form->create($pokemon)?>
<?= $this->Form->control('name') ?>
<?= $this->Form->select('attribute_id',$attributes)?>
<?= $this->Form->submit('編集'); ?>
<?= $this->Form->end() ?>