<div id="contentarea">
	<nav>
		<div id="sidebar">
			<div class="sidebarheader">NAVIGATION</div>
			<div id="sidebarnav">
			<a class="active" href="index.php?uc=accueil">Home</a>
			<a href="index.php?uc=chat">Chat</a>
			<a href="index.php?uc=news">News</a>
			<a href="index.php?uc=shop">Shop</a>
			<a href="index.php?uc=factures">Factures</a>
			
			<?php
			if(!isset($_SESSION['login'])){
				?>
				<a href="index.php?uc=inscription">S'inscrire</a>
				<?php
				?>
				<a href="index.php?uc=afficheConnexion">Se connecter</a>
			<?php } else { ?>
				<a href="index.php?uc=profil">Profil</a>
				<a href="index.php?uc=deconnexion">Déconnexion</a>
			<?php } ?>	
			<?php
			if (isset($_SESSION['admin'])){
				if ($_SESSION['admin']=='1') { ?>
					<a href="index.php?uc=administration1">Administration - Editer un billet</a>
					<a href="index.php?uc=administration2">Administration - Consulter les données des utilissateurs</a>
			<?php } }?>
		</div>		
	</nav>
</div>