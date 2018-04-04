<div class="row">
	<h1>Produtos</h1>
</div>
<div class="row">
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nome</th>
				<th>Preço</th>
				<th>Preço com desconto</th>
				<th>Descrição</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($produtos as $produto) { 
			?>
			<tr>
				<td><?= $produto['id'] ?></td>
				<td><?= $produto['nome'] ?></td>
				<td><?= $this->Currency->format($produto['preco']) ?></td>
				<td><?= $this->Currency->format($produto->calculaDesconto()) ?></td>
				<td><?= $produto['descricao'] ?></td>
				<td>
					<?php echo $this->Html->Link('Editar', ['controller' => 'produtos', 'action' => 'editar', $produto['id']]) ?> | 
					<?php echo $this->Form->postLink('Excluir', ['controller' => 'produtos', 'action' => 'excluir', $produto['id']],['confirm' => 'Deseja realmente excluir o produto '.$produto['nome'].'?']) ?>
					
				</td>
			</tr>
			<?php 
				} 
			?>
		</tbody>
	</table>
	<?php 
		echo $this->Html->Link('Novo Produto',['controller' => 'produtos', 'action' => 'novo']);
	 ?>
</div>