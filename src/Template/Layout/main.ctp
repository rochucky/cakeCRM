<div class="row">
	<div class="col-md-3">
		<p class="header"><?= $title ?></p>
	</div>
</div>
<div class="row" id="buttons">
	<div class="col">
		<?php if($usertype == 'recycle'): ?>
			<button type="button" class="btn btn-secondary restorebtn">Restaurar</button>
		<?php else: ?>
			<?php if($add): ?>
				<button type="button" class="btn btn-secondary newbtn" data-toggle="modal" data-target="#data-modal">Criar</button>
			<?php endif; ?>
			<?php if($del): ?>
				<a href="" class="btn btn-danger do-nothing delbtn">Excluir</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="datatable" class="display nowrap table-striped table-bordered">
			<thead>
				<tr>
					<?php foreach($fields as $field) { ?>
						<th><?= $field['label'] ?></th>
					<?php } ?>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<?php foreach($fields as $field) { ?>
						<th><input type="text" class="form-control" placeholder="Buscar <?= $field['label'] ?>" /></th>
					<?php } ?>
				</tr>
			</tfoot>

		</table>
	</div>

	<!-- Form Modal -->
	<div class="modal fade" id="data-modal" role="dialog">
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
					<form method="POST" id="data-modal-form" class="<?= ($edit) ? '' : 'no-edit' ?>" action="">
						<input type="hidden" id="id" name="id" value=""/>
						<?php foreach ($fields as $key => $data): ?>
							<?php if(!isset($data['type'])): ?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
									    	<label for="<?= $key ?>"><?= $data['label'] ?></label>
										</div>
										<div class="col">
									    	<input type="text" class="form-control" id="<?= $key ?>" <?= isset($data['readonly']) ? 'disabled' : 'name="'.$key.'"' ?> <?= ($data['required']) ? 'required' : '' ?> value=""/>
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
										    <select id="<?= $key ?>" class="form-control <?= ($data == reset($fields)) ? 'first' : '' ?>" <?= isset($data['readonly']) ? 'disabled' : 'name="'.$key.'"'?> <?= ($data['required']) ? 'required' : '' ?> >
										    	<option value="null"></option>
										    	<?php foreach($joins[$data['joinController']] as $join): ?>
													<option value="<?= $join['id'] ?>" ><?= $join[$data['joinCol']] ?></option>
										    	<?php endforeach; ?>
										    </select>
								       	</div>
								    </div>
								</div>
							<?php elseif($data['type'] == 'boolean'): ?>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2">
								    		<label for="<?= $key ?>"><?= $data['label'] ?></label>
								    	</div>
								    	<div class="col">
										    <select id="<?= $key ?>" class="form-control <?= ($data == reset($fields)) ? 'first' : '' ?>" <?= isset($data['readonly']) ? 'disabled' : 'name="'.$key.'"'?> <?= ($data['required']) ? 'required' : '' ?> >
										    	<option value="null"></option>
										    	<option value="1" >Sim</option>
										    	<option value="0" >Não</option>
										    	
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
									    	<input type="<?= $data['type'] ?>" class="form-control <?= ($data == reset($fields)) ? 'first' : '' ?>" id="<?= $key ?>" <?= isset($data['readonly']) ? 'disabled' : 'name="'.$key.'"' ?> <?= ($data['required']) ? 'required' : '' ?> value=""/>
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
            <button type="submit" form="data-modal-form" class="btn btn-primary do-nothing save-data" data-dismiss="modal">Salvar</button>
            <button type="button" class="btn btn-secondary cancel-data"  data-dismiss="modal">Cancelar</button>
          </div>

        </div>
      </div>
    </div>
	
</div>