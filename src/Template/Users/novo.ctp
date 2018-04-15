<div class="row">
	<h1>Novo Usuário</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<form method="POST" action="/<?= $controller ?>/salvar">
			<input type="hidden" id="id" name="id" value="<?= $item['id'] ?>"/>
			<?php foreach ($fields as $key => $data): ?>
				<?php if(!isset($data['type'])): ?>
					<div class="form-group">
					    <label for="<?= $key ?>"><?= $data['label'] ?></label>
					    <input type="text" class="form-control" id="<?= $key ?>" name="<?= $key ?>" value="<?= $item[$key] ?>"/>
					</div>
				<?php else: ?>
					<div class="form-group">
					    <label for="<?= $key ?>"><?= $data['label'] ?></label>
					    <input type="<?= $data['type'] ?>" class="form-control" id="<?= $key ?>" name="<?= $key ?>" value="<?= $item[$key] ?>"/>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="../" class="btn btn-secondary">Cancelar</a>
		</form>
	</div>
</div>