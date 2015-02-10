<?php
if ($is_friend == -2)
	echo "<span class='add_button'><input type='submit' value='Ajouter' class='add_button' ></span>";
else if ($is_friend == NULL)
	echo "<span class='del_button'><input type='submit' value='Supprimer'></span>";
else 
	echo "<span class='pending_button'><input type='submit' value='Invitation envoyé'></span>";
?>