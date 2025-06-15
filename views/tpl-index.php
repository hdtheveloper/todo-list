<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SITE_TITLE; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="assets/css/bootstrap-rtl.min.css">
  <!-- template rtl version --> 
  <link rel="stylesheet" href="assets/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">لیست وظایف</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="assets/img/avatar.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $user->name ?? 'user'; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column " id="folder_list" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->	
            <li class="nav-item">
              <a href="<?php echo BASE_URL ?>" style="float:right;" class="nav-link <?= isset($_GET['folder_id']) ? '' : 'active' ?> ">
                <i class="fa fa-folder" aria-hidden="true"></i>
                <p>تمام دسته ها</p>
              </a>
            </li>
			
			<?php foreach($folders as $folder): ?>
            <li class="nav-item">
              <a href="?folder_id=<?= $folder->id?>" style="float:right;" class="nav-link <?= (($_GET['folder_id'] ?? null) == $folder->id) ? 'active' : '' ?> ">
                <i class="fa fa-folder" aria-hidden="true"></i>
                <p><?= $folder->name; ?></p>
              </a>
			  <a href="?delete_folder=<?= $folder->id?>" onclick="return confirm('آیا از حذف آیتم مطمینید؟');">
			  	<span style="float:left;margin-left: 35px;cursor:pointer;"  class="nav-link">
				<i class="fa fa-trash" aria-hidden="true"></i>
				</span>
				</a>
            </li>
			<?php endforeach; ?>
	
          </ul>
		  
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#folderModal"><i class="nav-icon fa fa-plus"></i> افزودن دسته بندی </button>
			<hr>
			<a href="<?= site_url('?logout=1') ?>"><button type="button" class="btn btn-warning"><i class="nav-icon fa fa-circle-o text-danger"></i> خروج </button></a>
		  
        </nav>
        <!-- /.sidebar-menu -->
			<!-- start folder  Modal -->
				<div class="modal fade mt-5" id="folderModal" tabindex="-1" aria-labelledby="folderModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header"> 
						<h5 class="modal-title" id="folderModalLabel">افزودن دسته بندی</h5>
					  </div>
					  <div class="modal-body">

						  <div class="form-group">
							<label for="newFolderInput">نام دسته</label>
							<input type="text" class="form-control" id="newFolderInput" name="newFolderInput">
							<small id="emailHelp" class="form-text text-muted">فولدر به صورت ایجکس به لیست فولدر ها اضافه می شود.</small>
						  </div>

						  <button type="button" id="newFolderBtn" class="btn btn-primary">افزودن</button>

					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal">انصراف</button>
					  </div>
					</div>
				  </div>
				</div>
			<!-- end folder  Modal -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>مدیریت تسک ها</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskModal"><i class="nav-icon fa fa-plus"></i> افزودن تسک جدید </button>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 250px;">
					<input type="text" name="table_search" id="taskSearchInput" class="form-control float-right" placeholder="جستجو">
		
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
				<!-- start task  Modal -->
				<div class="modal fade mt-5" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="taskModalLabel">افزودن تسک</h5>
					  </div>
					  <div class="modal-body">
						<form>
						  <div class="form-group">
							<label for="taskName">تسک</label>
							<input type="text" class="form-control" id="newTaskInput" name="newTaskInput">
						  </div>
						  <button type="submit" id="newTaskBtn" class="btn btn-primary">افزودن</button>
						</form>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal">انصراف</button>
					  </div>
					</div>
				  </div>
				</div>
				<!-- end task  Modal -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tr>
                    <th></th>
                    <th>تسک</th>
                    <th>تاریخ ایجاد</th>
                    <th>حذف تسک</th>
                    <th>وضعیت</th>
                  </tr>
				  <?php if( sizeof($tasks)): ?>
				  <?php foreach($tasks as $task):?>
                  <tr>
					<td><input type="checkbox" style="cursor:pointer;" data-taskId = <?= $task->id ?> id="isDone" class="isDone" <?= $task->is_done ? 'checked' : '' ; ?>></td>
                    <td><?= $task->title; ?></td>
                    <td><span><?= $task->created_at; ?></span></td>
					<td>
					<a href="#" class="delete-task" data-task-id="<?= $task->id ?>">
					  <i class="fa fa-trash" aria-hidden="true"></i>
					</a>
					</td>
					<?php if($task->is_done): ?>
                    <td><span class="badge badge-success">انجام شده</span></td>
					<?php else: ?>
                    <td><span class="badge badge-danger">انجام نشده</span></td>
					<?php endif; ?>
                  </tr>
				  <?php endforeach; ?>
				  <?php else: ?>
				  <tr>
                    <td><span class="alert alert-warning">در حال حاضر تسکی برای این فولدر وجود ندارد...</span></td>
				  </tr>
				  <?php endif; ?>
                </table>
              </div>
              <!-- /.card-body -->
				<div class="card-footer clearfix ">

            </div>
            <!-- /.card -->
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>CopyLeft &copy; 2025 <a href="http://github.com/hesammousavi/">حسن درویشی</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Slimscroll -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/js/demo.js"></script>


	<script>
	
	$(document).ready(function(){
		
		/*Add Folder*/
		var btn = $('#newFolderBtn');
		var input = $('input#newFolderInput');
		btn.click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: 'process/ajaxHandeler.php',
				method: 'post',
				dataType: 'json', // ⬅ مهم: پاسخ باید JSON باشه
				data: {action: "addFolder", folderName: input.val()},
				success: function(response){
					if(response.status == 1){					
					   //$('#folder_list').append('<li>aaaa</li>');
			const newFolderHTML = `
			<li class="nav-item">
			  <a href="?folder_id=${response.id}" style="float:right;" class="nav-link">
				<i class="fa fa-folder" aria-hidden="true"></i>
				<p>${response.name}</p>
			  </a>
			  <a href="?delete_folder=${response.id}">
				<span style="float:left;margin-left: 35px;cursor:pointer;" class="nav-link">
				  <i class="fa fa-trash" aria-hidden="true"></i>
				</span>
			  </a>
			</li>
			`;
			$('#folder_list').append(newFolderHTML);
					}else{
					alert(response.message || "خطا در افزودن فولدر");		
					}
				}
			});
		});
		
		
		
		/*Add Task*/
		
				var taskBtn = $('#newTaskBtn');
				var taskInput = $('input#newTaskInput');
				
				taskBtn.click(function(event){
					event.preventDefault();
					$.ajax({
						url: 'process/ajaxHandeler.php',
						method: 'post',
						//dataType: 'json', // ⬅ مهم: پاسخ باید JSON باشه
						data: {action : "addTask", folderId : <?= json_encode($_GET['folder_id'] ?? null) ?> , taskTitle: taskInput.val()},
						success: function(response){ 
													
							if(response == 1){
								location.reload();
							}else{
								alert(response.message || "خطا در افزودن تسک!");		
							}
						}
					});
				});
		
		
			/*check task*/
				$(document).on('change', '.isDone', function() {
					const checkbox = $(this);
					var tId = $(this).attr('data-taskId');
					const newStatus = checkbox.is(':checked') ? 1 : 0;
					
				$.ajax({
					url: 'process/ajaxHandeler.php',
					method: 'POST',
					data: {
						action: 'doneSwitch',
						taskId: tId,
						status: newStatus
					},
					success: function(response) {
						location.reload();
					},
					error: function(xhr) {
						alert('خطا در بروزرسانی وضعیت');
					}
				});
					
				});
		
		// حذف تسک
		$(document).on('click', '.delete-task', function(e) {
		  e.preventDefault();

		  if (!confirm('آیا از حذف آیتم مطمئنید؟')) return;

		  const taskId = $(this).data('task-id');
			const row = $(this).closest('tr');
		  $.ajax({
			url: 'process/ajaxHandeler.php',
			method: 'POST',
			data: {
			  action: 'deleteTask',
			  taskId: taskId
			},
			success: function(response) {
			  try {
				const res = JSON.parse(response);
				if (res.status == 1) {
				    row.fadeOut(300, function () {
					  $(this).remove();
					});
				} else {
				  alert(res.message || 'حذف انجام نشد');
				}
			  } catch(e) {
				alert('پاسخ نامعتبر از سرور');
			  }
			},
			error: function() {
			  alert('خطا در ارتباط با سرور');
			}
		  });
		});
	  
		/*search with Ajax*/
		  $('#taskSearchInput').on('input', function() {
		const query = $(this).val();
		const folderId = <?= json_encode($_GET['folder_id'] ?? null) ?>;

		$.ajax({
		  url: 'process/ajaxHandeler.php',
		  method: 'POST',
		  data: {
			action: 'searchTasks',
			searchQuery: query,
			folderId: folderId
		  },
		  success: function(response) {
			$('table tbody').html(response);
		  },
		  error: function() {
			alert('خطا در جستجو');
		  }
		});
	  });

		
	});

	</script>
</body>
</html>
