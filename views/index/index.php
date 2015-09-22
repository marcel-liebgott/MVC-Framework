{if $updateAvailable}
	<h1>Es ist eine neue Version verfügbar</h1>
{else}
	<h1>Du nutzt die aktuellste Version</h1>
{endif}

<div class="container">
	Aktuelle User-Informationen:<br>
	<b>User-Name:</b> {$username}<br>
	<b>angemeldet:</b> {if $loggedin == true}ja{else}nein{endif}<br>
	<b>Usergruppe:</b> {$usergroups}
</div>