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