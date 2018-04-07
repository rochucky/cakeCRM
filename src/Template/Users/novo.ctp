<div class="row">
	<h2>Novo Usuário</h2>
</div>
<div class="row">
	<?php 
		echo $this->Form->create($item, ['url' => ['action' => 'salvar']]);
		echo $this->Form->input('id'); 
		echo $this->Form->input('name',['label' => 'Nome']); 
		echo $this->Form->input('email',['label' => 'E-mail']); 
		echo $this->Form->input('username',['label' => 'Usuário']); 
		echo $this->Form->input('password', ['label' => 'Senha']); 
		echo $this->Form->button('Salvar');
		echo $this->Form->end(); 
	?>
</div>