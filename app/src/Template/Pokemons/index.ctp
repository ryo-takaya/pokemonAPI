
<ul>
<?php foreach($pokemons as $pokemon): ?>
<li>名前<?= $pokemon->name ?> 属性<?= $pokemon->attribute_id ?></li>
<?php endforeach; ?>
</ul>