<div class="row">
	<h1 class="title">Usuários</h1>
</div>
<div class="row">
	<table class="table">
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
			<tr>
				<?php foreach ($fields as $key => $val) { ?>
					<td>
						<?php 
							if (isset($val['format'])){
								switch ($val['format']){
									case 'currency':
										echo $this->Currency->format($item[$key]);
										break;
									default:
										echo $item[$key];
								}
							} 
							else{
								echo $item[$key];
							}
						?>
					</td>
				<?php } ?>
				<?php if($del || $edit) { ?>
					<td>
						<?php
							if($edit){
								echo $this->Html->Link('Editar', ['controller' => $controller, 'action' => 'editar', $item['id']]);
							} 
						?> 
						<?php 
							if($del){
								echo $this->Form->postLink('Excluir', ['controller' => $controller, 'action' => 'excluir', $item['id']],['confirm' => 'Deseja realmente excluir o produto '.$item['nome'].'?']);
							}
						?>
						
					</td>
				<?php } ?>
			</tr>
			<?php 
				} 
			?>
		</tbody>
	</table>
	<?php
		if($add){
			echo $this->Html->Link('Novo',['controller' => $controller, 'action' => 'novo']);
		} 
	 ?>
</div>