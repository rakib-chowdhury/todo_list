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
<script type="text/javascript">
	var total_tasks = 0;
	jQuery(document).ready(function($) {
		initialise_tasks();
		//clear_tasks();
		var $todo_tasks = $("#todo_tasks");

		$todo_tasks.find('input[type="text"]').on('keydown', function(ev)
		{
			if(ev.keyCode == 13)
			{
				ev.preventDefault();
				var task_id = add_task($.trim($(this).val()));
				if(task_id > 0){
					initialise_tasks();
				}
			}
		});
	});

	function add_task(task_name) {
		var result = 0;
		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo site_url("post_task");?>',
			data: {
				'task_name': task_name
			},
			success: function (data) {
				if(data > 0){
					result = data;
				}
			}
		});
		if(result > 0){
			return result;
		}else{
			return false;
		}
	}

	function initialise_tasks(task_status=null) {
		$('#todo_list').empty();
		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo site_url("get_tasks");?>',
			data: {
				'status': task_status
			},
			success: function (data) {
				let res = $.parseJSON(data);
				let total_tasks = Object.keys(res.data).length;
				let new_res = {...res};
				let todos = '';
				for (var key of Object.keys(new_res.data)) {
					let task_id = res.data[key].id;
					let title = res.data[key].title;
					let status = res.data[key].status;
					if(task_status){
						if(status == task_status){
							todos = '<li id="task_'+task_id+'"><div class="checkbox checkbox-replace color-white"><input type="checkbox" class="custom_checkbox" id="'+task_id+'" value="'+task_id+'" /><label onclick="toggle_input_field(\''+task_id+'\', \''+title+'\')">'+title+'</label><button type="button" class="close" onclick="remove_task('+task_id+')" data-dismiss="alert">\n' +
								'\t\t\t\t\t\t\t\t\t\t<span aria-hidden="true">&times;</span>\n' +
								'\t\t\t\t\t\t\t\t\t\t<span class="sr-only">Close</span>\n' +
								'\t\t\t\t\t\t\t\t\t</button></div></li>';
						}else{
							todos = '<li id="task_'+task_id+'"><div class="checked checkbox checkbox-replace color-white"><input type="checkbox" class="custom_checkbox" id="'+task_id+'" value="'+task_id+'" /><label style="text-decoration: line-through" onclick="toggle_input_field(\''+task_id+'\', \''+title+'\')">'+title+'</label><button type="button" class="close" onclick="remove_task('+task_id+')" data-dismiss="alert">\n' +
								'\t\t\t\t\t\t\t\t\t\t<span aria-hidden="true">&times;</span>\n' +
								'\t\t\t\t\t\t\t\t\t\t<span class="sr-only">Close</span>\n' +
								'\t\t\t\t\t\t\t\t\t</button></div></li>';
						}
					}else{
						if(status == <?= PENDING ?>){
							todos = '<li id="task_'+task_id+'"><div class="checkbox checkbox-replace color-white"><input type="checkbox" class="custom_checkbox" id="'+task_id+'" value="'+task_id+'" /><label onclick="toggle_input_field(\''+task_id+'\', \''+title+'\')">'+title+'</label><button type="button" class="close" onclick="remove_task('+task_id+')" data-dismiss="alert">\n' +
								'\t\t\t\t\t\t\t\t\t\t<span aria-hidden="true">&times;</span>\n' +
								'\t\t\t\t\t\t\t\t\t\t<span class="sr-only">Close</span>\n' +
								'\t\t\t\t\t\t\t\t\t</button></div></li>';
						}else{
							todos = '<li id="task_'+task_id+'"><div class="checked checkbox checkbox-replace color-white"><input type="checkbox" class="custom_checkbox" id="'+task_id+'" value="'+task_id+'" /><label style="text-decoration: line-through" onclick="toggle_input_field(\''+task_id+'\', \''+title+'\')">'+title+'</label><button type="button" class="close" onclick="remove_task('+task_id+')" data-dismiss="alert">\n' +
								'\t\t\t\t\t\t\t\t\t\t<span aria-hidden="true">&times;</span>\n' +
								'\t\t\t\t\t\t\t\t\t\t<span class="sr-only">Close</span>\n' +
								'\t\t\t\t\t\t\t\t\t</button></div></li>';
						}
					}
					$('#todo_list').append(todos);
					replaceCheckboxes();
				}
				$('#total_task_span').html(total_tasks+' tasks left');
			}
		});
	}
</script>
</body>
</html>