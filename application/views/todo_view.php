<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Todo List" />
	<meta name="author" content="Rakib Ibna Hamid Chowdhury" />

	<link rel="icon" href="<?= site_url('public/assets/images/favicon.ico') ?>">

	<title>Assignment</title>

	<link rel="stylesheet" href="<?= site_url('public/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') ?>">
	<link rel="stylesheet" href="<?= site_url('public/assets/css/font-icons/entypo/css/entypo.css') ?>">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="<?= site_url('public/assets/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?= site_url('public/assets/css/neon-core.css') ?>">
	<link rel="stylesheet" href="<?= site_url('public/assets/css/neon-theme.css') ?>">
	<link rel="stylesheet" href="<?= site_url('public/assets/css/neon-forms.css') ?>">
	<link rel="stylesheet" href="<?= site_url('public/assets/css/custom.css') ?>">

	<script src="<?= site_url('public/assets/js/jquery-1.11.3.min.js') ?>"></script>

	<!--[if lt IE 9]><script src="<?= site_url('public/assets/js/ie8-responsive-file-warning.js') ?>"></script><![endif]-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body" data-url="http://neon.dev">

<div class="page-container">

	<div class="main-content">
		<div class="row">

			<div class="col-sm-5">
				<h3>Todos</h3>
				<div class="tile-block tile-white" id="todo_tasks">
					<div class="tile-content" id="checkboxes">

						<input type="text" id="task_name" name="task_name"
							   class="form-control" placeholder="What needs to be done?" />
						<hr>
						<ul class="todo-list" id="todo_list">

						</ul>

					</div>

					<div class="tile-footer">
						<div class="row">
							<div class="col-md-3">
								<span id="total_task_span"></span>
							</div>
							<div class="col-md-9">
								<div class="col-md-1">
									<a href="javascript:void(0)" onclick="#"><span>All</span></a>
								</div>
								<div class="col-md-2">
									<a href="javascript:void(0)" onclick="#"><span>Active</span></a>
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0)" onclick="#"><span>Completed</span></a>
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0)" onclick="#"><span>Clear Completed</span></a>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>

		<br />
		<!-- Footer -->
		<footer class="main">

			&copy; <?= date('Y') ?> <strong>Todo</strong> Designed & Developed By Rakib Ibna Hamid Chowdhury</a>

		</footer>
	</div>
</div>





<!-- Imported styles on this page -->

<!-- Bottom scripts (common) -->
<script src="<?= site_url('public/assets/js/gsap/TweenMax.min.js') ?>"></script>
<script src="<?= site_url('public/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') ?>"></script>
<script src="<?= site_url('public/assets/js/bootstrap.js') ?>"></script>
<script src="<?= site_url('public/assets/js/joinable.js') ?>"></script>
<script src="<?= site_url('public/assets/js/resizeable.js') ?>"></script>
<script src="<?= site_url('public/assets/js/neon-api.js') ?>"></script>


<!-- JavaScripts initializations and stuff -->
<script src="<?= site_url('public/assets/js/neon-custom.js') ?>"></script>


<!-- Demo Settings -->
<script src="<?= site_url('public/assets/js/neon-demo.js') ?>"></script>

</body>
</html>
