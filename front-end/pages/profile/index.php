<?php
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
    require_once __DIR__ . '/../../../back-end/actions/users/get-user.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title><?= $user['name']; ?> | ATK SKI</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/profile/styles/style.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/profile/styles/animation.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/profile/styles/responsive.css">
	</head>
	<body>

<!-- Loading Screen -->

		<?php include '../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

		<?php include '../../components/header/header.php'; ?>

		<div id="content" class="noInteract">

<!-- Page Title -->

			<div id="pageTitle">
				<b>Profile</b>
			</div>

<!-- Content -->

			<div id="infoContainer">
				<p id="title">Informasi</p>
				<div id="row">
					<div class="column">
						<p class="columnTitle">Nama</p>
						<p><?= $user['name']; ?></p>
					</div>
					<div class="column sideLine">
						<p class="columnTitle">Kelas</p>
						<p><?= $user['class']; ?></p>
					</div>
					<div class="column sideLine">
						<p class="columnTitle">Email</p>
						<p><?= $user['email']; ?></p>
					</div>
				</div>
			</div>

			<button id="logOut">Log Out</button>

		</div>

		<div id="confirmPopUp" class="noInteract">
			<div id="confirmContainer">
				<img src="/front-end/global/resources/image/icon/leave.png" id="icon">
				<h2>Keluar dari Akun?</h2>
				<p id="confirmText">Apakah anda yakin ingin keluar dari akunmu sekarang? Anda dapat kembali login kapan pun.</p>
				<div id="confirmButtons">
					<button id="confirmButton" class="false">Batal</button>
					<button id="confirmButton" class="true">Keluar</button>
				</div>
			</div>
		</div>

<!-- Footer -->

		<?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

		<script src="/front-end/pages/profile/scripts/popUp.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>