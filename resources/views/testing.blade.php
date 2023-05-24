<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>

<table id="taxtab">

</table>


<div id="astab">
</div>
</body>
<script>

    setInterval(function(){ 
    fetch('http://127.0.0.1:8000/test')
      .then(response => response.json())
      .then(data => {
        var tax = data.taxes;
        var assur = data.assurances;
        var t = document.getElementById('taxtab');
        var a = document.getElementById('astab');
        t.innerHTML = `<tr>
            <th>Matricule</th>
            <th>date_taxe</th>
            <th>id_taxe</th>
        </tr>`;
        a.innerHTML = "";
        tax.forEach(item => {
            t.innerHTML += `
            <tr>
                <td>`+ item.Matricule +`</td>
                <td>`+ item.date_taxe +`</td>
                <td>`+ item.id_taxe +`</td>
            </tr>
            `;
        });

        assur.forEach(item => {
            a.innerHTML += "<p>" + item.Matricule + " | " + item.dateAssur + " | " + item.id_assurance + "</p>";
        });


      })
      .catch(error => {
        console.error('Error:', error);
      });

    }, 5000);
</script>
</html>