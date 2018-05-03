<div class="row">
	<h1><?= $title ?></h1>
</div>
<div class="row">
	<div class="col-md-12">
		<form method="POST" action="/<?= $controller ?>/salvar">
			<input type="hidden" id="id" name="id" value="<?= $item['id'] ?>"/>
			<?php foreach ($fields as $key => $data): ?>
				<?php if(!isset($data['type'])): ?>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2">
						    	<label for="<?= $key ?>"><?= $data['label'] ?></label>
							</div>
							<div class="col">
						    	<input type="text" class="form-control" id="<?= $key ?>" name="<?= $key ?>" <?= isset($data['readonly']) ? 'readonly' : '' ?> value="<?= $item[$key] ?>"/>
							</div>	
						</div>
					</div>
				<?php elseif($data['type'] == 'join'): ?>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2">
					    		<label for="<?= $key ?>"><?= $data['label'] ?></label>
					    	</div>
					    	<div class="col">
							    <select id="<?= $key ?>" name="<?= $key ?>" class="form-control" <?= isset($data['readonly']) ? 'readonly' : '' ?>>
							    	<option value="null"></option>
							    	<?php foreach($joins[$data['joinController']] as $join): ?>
										<option value="<?= $join['id'] ?>" <?= ($item[$key] == $join['id']) ? 'selected' : ''; ?>><?= $join[$data['joinCol']] ?></option>
							    	<?php endforeach; ?>
							    </select>
					       	</div>
					    </div>
					</div>
				<?php else: ?>
					<div class="form-group">
					    <div class="row">
							<div class="col-md-2">
						    	<label for="<?= $key ?>"><?= $data['label'] ?></label>
							</div>
							<div class="col">
						    	<input type="<?= $data['type'] ?>" class="form-control" id="<?= $key ?>" name="<?= $key ?>" <?= isset($data['readonly']) ? 'readonly' : '' ?> value="<?= $item[$key] ?>"/>
							</div>	
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="<?= $this->request->referer(); ?>" class="btn btn-secondary">Cancelar</a>
		</form>
	</div>
</div>