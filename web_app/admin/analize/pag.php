<header>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">
		function openNav(){
			$(".sidebar").toggleClass('is-active');
		}
	</script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!--<link = "stylesheet" type= "text/css" href ="css/stil.css">-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title >Meniu Medic</title>
	<!--<div class = "card">
		<div class = "card-body" style = "background-color:#3498DB; color:#ffffff;font: italic bold 40px Georgia, serif">
			<center><h2>PatientsManager</h2><center>
		</div>
	</div>-->
	
	
</header>
<style>
.navbar-brand
		{
		  font-family: 'Lato', sans-serif;
		  color:white;
		  font-size: 30px;
		  margin: 0px;
		  background-color:#3498DB;
		}
.navbar{
			background-color:#3498DB;
		}		
body {
  margin: 0;
  overflow-x: hidden;
  font-family: "Lato", sans-serif; color:grey;
}
.sidebar {
  display: none;
  width: 220px;
  height: calc(100vh - 28px);
  background: #eee;
  border-right: #ccc;
  padding: 14px;
  position: relative;
  left: -220px;
}

.sidebar.is-active {
  display: block;
  left: 0;
  transition: all 2000ms ease;
}
.sidebar.is-active~.main-content {
  width: 100vw;
  height: calc(100vh - 28px);
  position: absolute;
  left: calc(220px + 28px);
}

.main-content {
  width: 100%;
  padding: 14px;
}

.row {
  display: flex;
  flex-wrap: no-wrap;
  flex-direction: colomn;
  justify-content: space;
}

.row .cell {
  width: 100%;
  background: #eee;
  padding: 14px;
}
.row .cell:nth-of-type(2) {
  border-right: 1px solid lightgray;
  border-left: 1px solid lightgray;
}

nav a {
  display: block;
  padding: 14px;
}

.menu-btn {
  position: absolute;
  right: 0;
  z-index: 9999;
}

.wrapper {
  width: 100%;
  height: 100vh;
  display: flex;
}
@media screen and (max-height: 450px) {
		.sidebar {padding-top: 15px;}
		.sidebar a {font-size: 18px;}
.pagination {
  display: inline-block;
  position:center;
 
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
   font-size: 40px;
}
</style>
<body>
	<nav class="navbar">
			<span class="navbar-brand mb-0 h1">PatientsManager</span>
			<!--<span style="font-size:30px;color:white;">Pacienti</span>-->
			<span style="font-size:30px;color:white;cursor:pointer" onclick="openNav()">&#9776; Meniu</span>
			<!--<span></span>
			<span></span>-->
			<input id="input-search" class="form-control" type ="text" placeholder="Search..">
	</nav>
	
	<div class="wrapper">
	  <div class="sidebar">
		<nav>
			<a href="acasa.php"><i class="fa fa-fw fa-home"></i> Acasa</a>
			<a href="afisare_programari.php"><i class="fa fa-calendar"></i> Programari</a>
			<a href="afisare_pacienti.php"><i class="fa fa-fw fa-user"></i> Pacienti</a>
			<a href="profilul_meu.php"><i class="fa fa-user"></i> Profilul meu</a>
			<a href="login.php"><i class="fa fa-sign-out"></i> Iesire</a>
		</nav>
	  </div>

	  <div class="main-content">
		<table class= "table table-hover" style= "position:relative;">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">Nr.crt.</th>
				  <th scope="col">Nume</th>
				  <th scope="col">Prenume</th>
				  <th scope="col">CNP</th>
				  <th scope="col">Detalii</th>
				</tr>
			  </thead>
			  <tbody id ="table-body">
			  </tbody>
		</table>
	  </div>
	</div>	
	


<div class="container ">
    <div id="pagination-wrapper"></div>
</div>
	 



<?php
    
	function readDB(){
		$username = "";
		$email    = "";
		$errors = array(); 
		$_SESSION['success'] = "";

		// connect to database
		$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
		$query = "SELECT id, nume, prenume, cnp FROM pacienti";
		$results = mysqli_query($db, $query);
		$myArray =array();
		if(mysqli_num_rows($results) > 0 ){
			while($row = mysqli_fetch_assoc($results)){
				$myArray[] = ($row);
			} 
		}	
		return $myArray;
	}
	
?>


<script>
/*
	1 - Loop Through Array & Access each value
  2 - Create Table Rows & append to table
*/
tableData = <?php echo json_encode(readDB()); ?>;
var state = {
    'querySet': tableData,

    'page': 1,
    'rows': 10,
    'window': 5,
}

$('#input-search').on('keyup', function(){
			var value = $(this).val()
			console.log("Value:", value)
			data = searchTable(value, tableData)
			//state.querySet = data
			buildTable()
		})

buildTable()

		   
function searchTable(value, data){
	var filteredData = []
	for(var i = 0; i < data.length; i++){
		value = value.toLowerCase()
		var name = data[i].nume.toLowerCase()
		if(name.includes(value))
			filteredData.push(data[i])
	}
		
	return filteredData
}

function pagination(querySet, page, rows) {

    var trimStart = (page - 1) * rows
    var trimEnd = trimStart + rows

    var trimmedData = querySet.slice(trimStart, trimEnd)

    var pages = Math.round(querySet.length / rows);

    return {
        'querySet': trimmedData,
        'pages': pages,
    }
}

function pageButtons(pages) {
    var wrapper = document.getElementById('pagination-wrapper')

    wrapper.innerHTML = ``
	console.log('Pages:', pages)

    var maxLeft = (state.page - Math.floor(state.window / 2))
    var maxRight = (state.page + Math.floor(state.window / 2))

    if (maxLeft < 1) {
        maxLeft = 1
        maxRight = state.window
    }

    if (maxRight > pages) {
        maxLeft = pages - (state.window - 1)
        
        if (maxLeft < 1){
        	maxLeft = 1
        }
        maxRight = pages
    }
    
    

    for (var page = maxLeft; page <= maxRight; page++) {
    	wrapper.innerHTML += `<button value=${page} class="page btn btn-sm btn-info">${page}</button>`
    }

    if (state.page != 1) {
        wrapper.innerHTML = `<button value=${1} class="page btn btn-sm btn-info">&#171; First</button>` + wrapper.innerHTML
    }

    if (state.page != pages) {
        wrapper.innerHTML += `<button value=${pages} class="page btn btn-sm btn-info">Last &#187;</button>`
    }

    $('.page').on('click', function() {
        $('#table-body').empty()

        state.page = Number($(this).val())

        buildTable()
    })

}

function buildTable() {
    var table = $('#table-body')

    var data = pagination(state.querySet, state.page, state.rows)
    var myList = data.querySet

    for (var i = 1 in myList) {
        //Keep in mind we are using "Template Litterals to create rows"
        var row = `<tr>
						<td>${myList[i].id}</td>
						<td>${myList[i].nume}</td>
						<td>${myList[i].prenume}</td>
						<td>${myList[i].cnp}</td>
						<td><a href ="detalii_pacient.php?subject=${myList[i].id}">mai multe informatii</a></td>>
                  `
        table.append(row)
    }

    pageButtons(data.pages)
}
</script>

