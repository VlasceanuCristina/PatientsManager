<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    th{ 
        cursor: pointer;
        color:#fff;
            }
</style>

<nav class="navbar">
			<span class="navbar-brand mb-0 h1">PatientsManager</span>
			<!--<span style="font-size:30px;color:white;">Pacienti</span>-->
			<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">&#9776; Meniu</span>
			<!--<span></span>
			<span></span>-->
			<input id="input-search" class="form-control" type ="text" placeholder="Search..">
	</nav>
	<!---
<table class="table table-striped">
    <tr  class="bg-info">
        <th  class="bg-info" data-colname="name" data-order="desc">Name &#9650</th>
        <th  data-colname="age" data-order="desc">Age &#9650</th>
        <th  data-colname="birthdate" data-order="desc">Birthday &#9650</th>
    </tr>
    <tbody id="myTable">
        
    </tbody>
</table>-->

<head>
<script>
var myArray = [
    {'name':'Michael', 'age':'30', 'birthdate':'11/10/1989'},
    {'name':'Mila', 'age':'32', 'birthdate':'10/1/1989'},
    {'name':'Paul', 'age':'29', 'birthdate':'10/14/1990'},
    {'name':'Dennis', 'age':'25', 'birthdate':'11/29/1993'},
    {'name':'Tim', 'age':'27', 'birthdate':'3/12/1991'},
    {'name':'Erik', 'age':'24', 'birthdate':'10/31/1995'},
]




$('#input-search').on('keyup', function(){
	var value = $(this).val()
	console.log("Value:", value)
	//data = searchTable(value, myArray)
	//buildTable(data)
})

buildTable(myArray)

 /*$('th').on('click', function(){
     var column = $(this).data('colname')
     var order = $(this).data('order')
     var text = $(this).html()
     text = text.substring(0, text.length - 1);
     
     
     
     if (order == 'desc'){
        myArray = myArray.sort((a, b) => a[column] > b[column] ? 1 : -1)
        $(this).data("order","asc");
        text += '&#9660'
     }else{
        myArray = myArray.sort((a, b) => a[column] < b[column] ? 1 : -1)
        $(this).data("order","desc");
        text += '&#9650'
     }

    $(this).html(text)
    buildTable(myArray)
    })*/

function searchTable(value, data){
	var filteredData = []
	for(var i = 0; i < data.length; i++){
		value = value.toLowerCase
		var name = data[i].name.toLowerCase()
		if(name(include(value)))
			filteredData.push(data[i])
	}
		
	return filteredData
}
 
    
function buildTable(data){
    var table = document.getElementById('myTable')
    table.innerHTML = ''
    for (var i = 0; i < data.length; i++){
        var row = `<tr>
                        <td>${data[i].name}</td>
                        <td>${data[i].age}</td>
                        <td>${data[i].birthdate}</td>
                   </tr>`
        table.innerHTML += row
    }
}

</script>
</head>