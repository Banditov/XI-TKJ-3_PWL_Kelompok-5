<?php
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ATK SKI - Status</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/status/styles/style.css">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/status/styles/animation.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/status/styles/responsive.css">
	</head>
	<body>

<!-- Loading Screen -->

        <?php include '../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

		<?php include '../../components/header/header.php'; ?>

		<div id="content">

<!-- Page Title -->

			<div id="pageTitle">
				<b>STATUS</b>
			</div>

<!-- Content -->

			<div id="container">
				<div class="statusRow">
					<div class="rowHead">
						<div class="rowTitle">
							<p>#123</p>
							<p class="status">Order Status</p>
						</div>
						<img src="/front-end/global/resources/image/statusDropOff.png" class="dropDownButton">
					</div>
					<div class="rowBottom">
						<button>Cancel</button>
					</div>
				</div>
				<div class="statusRow">
					<div class="rowHead">
						<div class="rowTitle">
							<p>#123</p>
							<p class="status">Order Status</p>
						</div>
						<img src="/front-end/global/resources/image/statusRemove.png">
					</div>
				</div>
			</div>

		</div>

<!-- Footer -->

		<?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

		<script src="/front-end/pages/status/scripts/dropDown.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>