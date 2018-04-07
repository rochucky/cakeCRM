<div class="row">
	<h2>Login</h2>
</div>
<div class="row">
	<?php 
		echo $this->Form->create(); 
		echo $this->Form->input('username',['label' => 'Usuário']); 
		echo $this->Form->input('password', ['label' => 'Senha']); 
		echo $this->Form->button('Entrar');
		echo $this->Form->end(); 
	?>
</div>