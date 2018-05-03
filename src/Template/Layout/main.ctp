<div class="row">
	<div class="col-md-3">
		<p class="header"><?= $title ?></p>
	</div>
</div>
<div class="row">
	<div class="col">
		<a href="/<?= $controller ?>/novo" class="btn btn-secondary">Novo</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="datatable display nowrap">
			<thead>
				<tr>
					<?php foreach($fields as $field) { ?>
						<th><?= $field['label'] ?></th>
					<?php } ?>
					<?php if($del || $edit) { ?>
						<th>Ações</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($items as $item) { 
				?>
				<tr id="<?= $item['id'] ?>">
					<?php foreach ($fields as $key => $param) { ?>
						<td>
							<?php 
								if(isset($param['type'])){
									if($param['type'] == 'join'){
										$value = $item[$param['joinName']][$param['joinCol']];
									}
								}
								else{
									$value = $item[$key];
								}

								if (isset($param['format'])){
									switch ($param['format']){
										case 'currency':
											echo $this->Format->currency($value);
											break;
										case 'datetime':
											echo $this->Format->datetime($value);
											break;
										default:
											echo $value;
									}
								} 
								else{
									echo $value;
								}
							?>
						</td>
					<?php } ?>
					<?php if($del || $edit) { ?>
						<td class="actions">
							<?php if($edit): ?>
								<a href="/<?= $controller ?>/editar/<?= $item['id'] ?>"><span class="oi oi-brush" title="Editar" aria-hidden="true"></span></a>								 
							<?php endif; ?> 
							<?php if($del): ?>
								<a href="/<?= $controller ?>/excluir/<?= $item['id'] ?>"><span class="oi oi-x" title="Excluir" aria-hidden="true"></span></a>								 
							<?php endif; ?> 
							
						</td>
					<?php } ?>
				</tr>
				<?php 
					} 
				?>
			</tbody>
		</table>
	</div>
</div>