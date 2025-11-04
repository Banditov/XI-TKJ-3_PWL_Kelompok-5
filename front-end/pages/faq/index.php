<?php
    require_once __DIR__ . '/../../../back-end/actions/faq/get-qa.php';
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ATK SKI - FAQ</title>
		<link rel="icon" type="image/x-icon" href="/front-end/global/resources/image/logo.ico">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/faq/styles/style.css">
		<link rel="stylesheet" type="text/css" href="/front-end/global/styles/globalStyle.css">
		<link rel="stylesheet" type="text/css" href="/front-end/pages/faq/styles/responsive.css">
	</head>
	<body>

<!-- Loading Screen -->

        <?php include '../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

		<?php include '../../components/header/header.php'; ?>

		<div id="content">

<!-- Page Title -->

			<div id="pageTitle">
				<b>FAQ</b>
			</div>

<!-- Search -->

			<div id="search">
				<input type="text" id="searchInput" name="search" placeholder="Search...">
			</div>

<!-- Content -->

			<div class="content">
        <?php $i = 1; foreach($qna as $index => $qa): ?>
				<div class="qaRow <?= $i > 5 ? 'hiddenRow' : '' ?>">
					<div class="qaQuestionRow">
						<div class="qaQuestion">
							<p><?= $qa['id'] ?>.</p>
							<p class="questionText"><?= $qa['question'] ?></p>
						</div>
						<button class="dropDown">+</button>
					</div>
					<div class="qaAnswerRow">
						<p><?= $qa['answer'] ?></p>
					</div>
				</div>
        <?php $i++; endforeach; ?>
				<div class="extendQA">
					<button id="extendQA">
						<img src="/front-end/global/resources/image/arrow.png" id="extendQAIcon" style="transform: rotate(0deg);">
					</button>
				</div>
			</div>

		</div>

<!-- Footer -->

		<?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

		<script src="/front-end/global/scripts/loading-screen.js"></script>
		<script src="/front-end/pages/faq/scripts/dropDown.js"></script>
		<script src="/front-end/pages/faq/scripts/extendQA.js"></script>
		<script src="/front-end/pages/faq/scripts/search.js"></script>
	</body>
</html>