setInterval(function() {
    updatePortfolioValue('update');
}, 2000);


function generatePage(action) {
    $.get("backend.php?action=" + action, function(data) {
        document.getElementById('mioportafoglio').innerHTML = data;
    });
}

function updatePortfolioValue(action) {

    var x = document.getElementById('portfolio').rows
    var rowCount = x.length - 1; //vale 9
    var id = new Array();
    for (var i = 1; i <= rowCount; i++) {
        var y = x[i].cells;
        id[i - 1] = y[4].id;
    }
    var mycryptos = id.toString();
    $.get("backend.php?action=" + action + "&crypto=" + mycryptos, function(data) {

        var lines = data.split(" ");
        var totalePortfolio = 0;
        for (var i = 0; i <= lines.length - 2; i++) {

            var datiDaAggiornare = lines[i].split(",");

            //document.getElementById("numerorighe").innerHTML = datiDaAggiornare[1] + " - " + datiDaAggiornare[2] + "<br>";
            var totaleValuta = datiDaAggiornare[1] * datiDaAggiornare[2];
            var cocatenaTotaleValuta = "val" + datiDaAggiornare[0];

            document.getElementById(datiDaAggiornare[0]).innerHTML = datiDaAggiornare[1];
            document.getElementById(cocatenaTotaleValuta).innerHTML = totaleValuta.toFixed(2);

            totalePortfolio = totalePortfolio + totaleValuta;


        }
        document.getElementById("totale").innerHTML = totalePortfolio.toFixed(2);
    });
}

function cancellagnosa() {
	var array = $('form').serializeArray();
	if (array != '') {
	    $.post("./cancella.php",
	        {
	          delete: array //qui va messo il valore dell'array che pick from the form
	        }, function(result) {
	        $("span").html(result);
	    });
	    location.reload(true);
	}
}

function activateButton() {
	var vettore = $('#cancellagnosa').serializeArray();
	if (vettore != '') {
	    document.getElementById('cassa').className = 'negative ui button mini';
	}
	else {
		document.getElementById('cassa').className = 'negative ui button disabled mini';
	}
}

function displayEditor(data) {
	    $(".editor").modal('show');
	    $(".editor").modal({
	        closable: true
	    });
	    document.getElementById('cryptoToBeModified').innerHTML = data;
}


