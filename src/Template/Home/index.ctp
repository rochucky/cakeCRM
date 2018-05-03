<div class="row">
	<?php if(date('H') < 12): ?>
		<h2 class="title">Bom Dia, <?= $user ?></h2>
	<?php elseif(date('H') < 18): ?>
		<h2 class="title">Boa Tarde, <?= $user ?></h2>
	<?php else: ?>
		<h2 class="title">Boa Noite, <?= $user ?></h2>
	<?php endif; ?>
</div>