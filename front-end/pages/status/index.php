<?php
    require_once __DIR__ . '/../../../back-end/actions/users/session-check.php';
    require_once __DIR__ . '/../../../back-end/actions/sales/get-status.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>Status | ATK SKI</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo/logo.ico">
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

			<div id="pageTitle" class="noInteract">
				<b>STATUS</b>
			</div>

<!-- Content -->

			<div id="container">
				<?php if (empty($orders)): ?>
					<div class="emptyState">
						<p>No Orders Found</p>
						<p>You haven't placed any orders yet.</p>
					</div>
				<?php else: ?>
					<?php foreach ($orders as $order): ?>
						<div class="statusRow noInteract">
							<div class="rowHead">
								<div class="rowTitle">
									<p>#<?php echo htmlspecialchars($order['order_number']); ?></p>
									<p class="status"><?php echo htmlspecialchars($order['act']); ?></p>
								</div>
								<?php if ($order['act'] == 'Not Ready'): ?>
									<img src="/front-end/global/resources/image/icon/statusDropOff.png" class="dropDownButton">
								<?php else: ?>
									<img src="/front-end/global/resources/image/icon/statusRemove.png" 
										class="staticIcon removeBtn" 
										data-order-id="<?php echo $order['id']; ?>" 
										data-order-number="<?php echo $order['order_number']; ?>">
								<?php endif; ?>
							</div>
							<?php if ($order['act'] == 'Not Ready'): ?>
								<div class="rowBottom">
									<button class="cancelBtn" data-order-id="<?php echo $order['id']; ?>" data-order-number="<?php echo $order['order_number']; ?>">Cancel</button>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

		</div>

		<div id="confirmPopUp" class="noInteract">
			<div id="confirmContainer">
				<h2 id="confirmText">Apakah anda yakin ingin membatalkan order ini?</h2>
				<div id="confirmButtons">
					<button id="cancelConfirmButton" class="false">Tidak</button>
					<button id="confirmButton" class="true">Ya</button>
				</div>
			</div>
		</div>

<!-- Footer -->

		<?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

		<script src="/front-end/pages/status/scripts/removeOrder.js"></script>
		<script src="/front-end/pages/status/scripts/cancelOrder.js"></script>
		<script src="/front-end/pages/status/scripts/dropDown.js"></script>
		<script src="/front-end/global/scripts/loading-screen.js"></script>
	</body>
</html>