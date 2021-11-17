<div class="conteneur">
	<div class="contentProduits">
        <div class='titre'>Vos commandes</div>
        <br>
        <?php 
            foreach($tableaux as $tableau){
                $tableau->show();
                echo "<br>";
            }
        ?>
	</div>
</div>