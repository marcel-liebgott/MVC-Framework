<div class="container">
	{if $updateAvailable == true}
		<h3 style="color:red;">Es ist eine neue Version verfügbar</h3>
	{else}
		<h3 style="color: green;">Du nutzt die aktuellste Version</h3>
	{endif}
	<br>
	Aktuelle User-Informationen:<br>
	<b>User-Name:</b> {$username}<br>
	<b>angemeldet:</b> {if $loggedin == true}ja{else}nein{endif}<br>
	<b>Usergruppe:</b> {$usergroups}
</div>