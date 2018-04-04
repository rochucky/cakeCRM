<div class="row">
	<h1>Novo Produto</h1>
</div>
<div class="row">
	<?php 
		echo $this->Form->create($item,['url' => ['action' => 'salva']]);
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('preco', ['label' => 'Preço']);
		echo $this->Form->input('descricao', ['label' => 'Descrição']);
		echo $this->Form->button('Salvar');
		echo $this->Form->end();
	 ?>
</div>