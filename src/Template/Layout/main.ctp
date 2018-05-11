<div class="row">
	<div class="col-md-3">
		<p class="header"><?= $title ?></p>
	</div>
</div>
<div class="row">
	<div class="col">
		<a href="" class="btn btn-secondary do-nothing newbtn">Novo</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="datatable" class="display nowrap">
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
						<td name="<?= $key ?>">
							<?php 
								if(isset($param['type'])){
									if($param['type'] == 'join'){
										$value = $item[$param['joinName']][$param['joinCol']];
									}
									else{
										$value = $item[$key];
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
								<a href=""><span class="oi oi-x delete do-nothing" data-id="<?= $item['id'] ?>" title="Excluir" aria-hidden="true"></span></a>								 
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

	<!-- Form Modal -->
	<div class="modal fade" id="data-modal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
					<form method="POST" action="/<?= $controller ?>/salvar">
						<input type="hidden" id="id" name="id" value=""/>
						<?php foreach ($fields as $key => $data): ?>
							<?php if(!isset($data['type'])): ?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
									    	<label for="<?= $key ?>"><?= $data['label'] ?></label>
										</div>
										<div class="col">
									    	<input type="text" class="form-control" id="<?= $key ?>" <?= isset($data['readonly']) ? 'disabled' : 'name="'.$key.'"' ?> value=""/>
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
										    <select id="<?= $key ?>" class="form-control" <?= isset($data['readonly']) ? 'disabled' : 'name="'.$key.'"'?> >
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
									    	<input type="<?= $data['type'] ?>" class="form-control" id="<?= $key ?>" <?= isset($data['readonly']) ? 'disabled' : 'name="'.$key.'"' ?> value=""/>
										</div>	
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</form>
				</div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary do-nothing save-data" data-dismiss="modal">Salvar</button>
            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancelar</button>
          </div>

        </div>
      </div>
    </div>
	
</div>