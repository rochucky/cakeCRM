<div class="row">
	<h1>Novo Produto</h1>
</div>
<div class="row">
	<?php 
		echo $this->Form->create($item,['url' => ['action' => 'salvar']]);
		echo $this->Form->input('id');
		foreach ($fields as $key => $data){
			echo $this->Form->input($key, $data);	
		}
		echo $this->Form->button('Salvar');
		echo $this->Html->Link('Cancelar',$controller,['class' => 'button']);
		echo $this->Form->end();
	 ?>
</div>