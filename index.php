<?php
	$host = "abdusyserver.database.windows.net";
    $user = "ahmad";
    $pass = "muhammad.as16";
    $db = "abdusydb";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
	}
	
	if(isset($_POST['loadData']))
	{

	}
	else if(isset($_POST['tambah']))
	{
		$nama = $_POST['nama'];
		$email = $_POST['email'];

		$sql = "insert into [user](nama, email, created_at) values('$nama', '$email', switchoffset(GETUTCDATE(),'+07:00'))";
		$query = $conn->query($sql);
	}
?>
<!doctype html>
<html lang="en">
	<head>
			<!-- Required meta tags -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

			<!-- Bootstrap CSS -->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

			<title>Dicoding - Menjadi Azure Cloud Developer</title>
	</head>
	<body>
		<div class="container">
			<h1>DICODING - MENJADI AZURE CLOUD DEVELOPER</h1>
		</div>
		<div class="container" id="registrasi">
			<h4>Registrasi data</h4>
			<form method="post" enctype="multipart/form-data" action="index.php">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" id="nama" placeholder="Masukkan nama" required name="nama">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" placeholder="Masukkan email" required name="email">
				</div>
				<input type="submit" name="tambah" value="Tambah" class="btn btn-primary">
				<input type="button" name="loadData" value="Load data" class="btn btn-primary" onclick="window.location.href='index.php';">
			</form>
		</div>
		<div class="container mt-4" id="data">
			<h4>List data</h4>
			<table class="table table-stripped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama</th>
						<th scope="col">Email</th>
						<th scope="col">Tanggal tambah</th>
					</tr>
				</thead>
				<?php
					$sql = "select * from [user] order by id desc";
					$query = $conn->query($sql);
					$result = $query->fetchAll();
				?>
				<tbody>
					<?php
						if(count($result) > 0){
							$i = 1;
							foreach($result as $user) {
								echo "<tr><td>".$i."</td>";
								echo "<td>".$user['nama']."</td>";
								echo "<td>".$user['email']."</td>";
								echo "<td>".$user['created_at']."</td></tr>";
								$i++;
							}
						}
						else
						{
							echo "<tr><td colspan=\"4\" >Tidak ada data</td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>