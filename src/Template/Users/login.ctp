<div class="row">
	<div class="col-md-12">
		<p class="text-center header">INSTORE</p>
	</div>
</div>
<div class="row">
	<div class="col-lg-4"></div>
	<div class="col-lg-4">	
		<form method="post" action="/">
			<div class="form-group">
				<label for="username">Usuário: </label>
				<input type="text" class="form-control fill" id="username" name="username" />
			</div>
			<div class="form-group">
				<label for="password">Senha: </label>
				<input type="password" class="form-control fill" id="password" name="password" />
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary fill">Entrar</button>
			</div>
		</form>
	</div>
</div>



<?= $this->Html->script('user/login.js');