<div class="container">
	<h1>Standardseite</h1>
	{$username}
	<form action="{url}login" method="POST">
		<input name="name" type="text" placeholder="Username"><br>
		<input name="pass" type="password" placeholder="Password"><br>
		<input name="submit" type="submit" value="login">
	</form>
</div>