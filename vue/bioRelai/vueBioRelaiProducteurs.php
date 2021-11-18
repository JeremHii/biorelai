<div class="conteneur">
	<div class="contentInscription">
		<div class='inscription'>
			<div class='titre'>Veuillez inscrire un nouveau producteur</div>
			<?php 
				$formulaireInscription->afficherFormulaire();
			?>
			<div class='titre'>Les différents producteurs</div>
			<?php 
				$tableauProducteurs->show();
			?>
		</div>
	</div>
</div>