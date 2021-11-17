<div class="conteneur">
	<div class="contentConnexion">
		<div class='monCompte'>
			<div class="titre">Mon compte</div>
			<br>
			<?php 
				$formulaireModif->afficherFormulaire();
				
				echo $message . "<br><br>";

				$formulaireModifMdp->afficherFormulaire();
			?>
		</div>
	</div>
</div>