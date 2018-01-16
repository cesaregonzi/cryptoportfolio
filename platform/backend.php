<?php
session_start();
$user = $_SESSION['username'];
$action = $_GET['action'];

switch ($action) {
	case 'generatepage':
		generapagina();
		break;

	case 'update':
		aggiornavaloreportfolio();
		break;

	case 'cancella':
		cancellaposizioni();
		break;
	
	default:
		# code...
		break;
}

function generapagina() {
	session_start();
	$user = $_SESSION['username'];
	include 'connect.php';

	$sql = "SELECT
				portfolio.buyprice,
				portfolio.symbol,
				portfolio.quantity,
				cryptolist.lastusd
			FROM portfolio
			INNER JOIN cryptolist
			ON portfolio.symbol = cryptolist.symbol WHERE portfolio.user = '$user'";
	$result = mysqli_query($mysqli, $sql);
	$tabella = '';
	$tabella .= "<div id='portfolioCointainer'>
		<form id='cancellagnosa' method='post' action='cancella.php'>
			<table class='ui compact celled definition table' id='portfolio'>
				<thead>
					<tr>
						<th></th>
						<th>Symbol</th>
						<th>Quantity</th>
						<th>Buy Price</th>
						<th>Last Price in USD</th>
						<th>Value in USD</th>
						<th></th>
					</tr>
				</thead>
					
				<tbody>";
					
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$rounded = round($row['quantity'] * $row['lastusd'],2);
			   $tabella .= "<tr>
						<td class='collapsing' style='width:70px;min-width:70px'>
							<div class='ui fitted slider checkbox'>
								<input type='checkbox' name='delete[]' value='".$row['symbol']."' onclick='activateButton()'> <label></label>
							</div>
						</td>
						<td>".$row['symbol']."</td>
						<td>".$row['quantity']."</td>
						<td>".$row['buyprice']."</td>
						<td id=\"".$row['symbol']."\" style='width:200px;min-width:100px'>".$row['lastusd']."</td>
						<td id=\"val".$row['symbol']."\" style='width:200px;min-width:100px'>".$rounded."</td>
						<td class='collapsing'><i class=\"edit icon\" onclick='displayEditor(\"".$row['symbol']."\")'></i></td>
					</tr>
				";

		//echo $row['symbol'] . "," . $row['quantity'] . "," . $row['buyprice'] . "," . $row['lastusd'] . "<br>" . $symbolList;
	}

	$tabella .= "			
				</tbody>
			</table>";
	$tabella .= "
			<table class='ui compact celled definition table' id='administration'>
				<tbody>
					<tr>
						<td class='collapsing' style='width:70px;min-width:70px'>
							<input type='button' value='del' class='negative ui button disabled mini' onclick=\"cancellagnosa()\" id='cassa'>
						</td>
						<td colspan='3'></td>
						<td style='width:200px;min-width:100px'>Total</td>
						<td id='totale' style='width:200px;min-width:100px'></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>

	
	<div class='ui modal mini editor'>
	<div id='modifica'>
	<h2 id='cryptoToBeModified'></h2>
		<form method='post' action='update.php'>

			<div class='ui right labeled input'>
			  <input type='text' placeholder='Enter weight..' name='quantity'>
			  <div class='ui basic label'>
			    n°
			  </div>
			</div>
			<div class='ui right labeled input'>
			  <label for='amount' class='ui label'>$</label>
			  <input type='text' placeholder='Amount' id='amount' name='price'>
			  <div class='ui basic label'>.00</div>
			</div>
			<div class='ui submit positive button'>Submit</div>
			
		</form>
	</div>
	</div>
	";

	echo $tabella;

}

function aggiornavaloreportfolio() {
	session_start();
	$user = $_SESSION['username'];
	include 'connect.php';
	$crypto = $_GET['crypto'];
	
	$singleCrypto = explode(",", $crypto);
	$len = count($singleCrypto);

	$query = "SELECT cryptolist.symbol, cryptolist.lastusd, portfolio.quantity FROM portfolio INNER JOIN cryptolist ON portfolio.symbol = cryptolist.symbol WHERE portfolio.user = '$user'";

	$result = mysqli_query($mysqli, $query);

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo $row['symbol'] . "," . $row['lastusd'] . "," . $row['quantity'] . " ";
	}

}


?>