<!DOCTYPE html>
<html><head>
	<meta charset="UTF-8">
	<title>CY Bank</title>
	<style>
		body {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: space-evenly;
			font-family: Arial, sans-serif;
			font-size: 1.5rem;
			background-color: #fafafa;
		}
		#form-container {
			width: 600px;
			border: 1px solid #aaaaff;
			text-align: center;
			padding: 20px;
			border-radius: 6px;
			background-color: #ccccff;
		}
		form>input {
			font-size: 1.5rem;
			margin: 5px;
		}
		form>label {
			display: block;
		}
        img{
            width: 300px;
        }
        a{
            text-align: left;
        }
		.warning {
			font-size: 0.9rem;
			font-weight: bolder;
			color: red;
			padding: 10px;
		}
	</style>
</head>
<body>
					<div id="form-container">
                    <a href="pageAcceuil.php">Retour à l'accueil</a>
                    <br>
					<img src="img/banque.png" alt="Logo de CY Bank">
					<p>La banque de vos projets</p>
					<div>
						Vendeur : <b><?php if(isset($_POST["vendeur"])){ echo $_POST["vendeur"] ;} ?></b>
						<br>Identifiant de la transaction : <i><?php if(isset($_POST["transaction"])){ echo $_POST["transaction"] ;} ?></i>
						<br>Montant de la transaction : <b><?php if(isset($_POST["montant"])){ echo $_POST["montant"] ;} ?></b>
					</div>
					<form action="paiement.php" method="POST">
						<input type="hidden" name="transaction" value="154632ABCD">
						<input type="hidden" name="montant" value="8900">
						<input type="hidden" name="vendeur" value="MI-5_J">
						<input type="hidden" name="retour" value="http://localhost/paiement.php?session=s">
						<input type="hidden" name="control" value="03ca2a639c26f5b41634225e2a52bfa2">
						<br><div class="warning">Ce formulaire est fictif, n'utilisez pas les informations d'une vraie carte.</div><br>
						<label for="titulaire">Titulaire de la carte : </label>
						<input type="text" id="titulaire" name="titulaire" placeholder="Marie Curie" maxlength="19">
						<label for="cardNUmber">Numéro de carte bancaire : </label>
						<input type="text" id="cardNumber" name="cardNumber" placeholder="Numéro de carte" maxlength="19" size="19">
						<label for="cryptogramme">Code de sécurité : </label>
						<input type="text" id="cryptogramme" name="cryptogramme" placeholder="666" maxlength="3" size="3">
						<label for="expiration">Expire le : </label>
						<input type="text" id="expiration" name="expiration" placeholder="01/21" maxlength="5" size="5">
						<br><input type="submit" value="Payer">
					</form>
				</div>
				
</body>