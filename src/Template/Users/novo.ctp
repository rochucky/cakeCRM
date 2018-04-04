<div class="row">
	<h2>Novo Usuário</h2>
</div>
<div class="row">
	<?php 
		echo $this->Form->create($user, ['url' => ['action' => 'salvar']]); 
		echo $this->Form->input('username',['caption' => 'Usuário']); 
		echo $this->Form->input('password', ['caption' => 'Senha']); 
		echo $this->Form->button('Salvar');
		echo $this->Form->end(); 
	?>
</div>