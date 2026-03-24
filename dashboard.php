<?php session_start(); $user_name = $_SESSION['user_name'];?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Manager Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-4">
    <!-- Header with Logout -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Task Manager - (<?= $user_name ?>)</h2>
       <a href="login_controller.php?action=logout" class="btn btn-danger">Logout</a>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3" id="taskTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button onclick="viewTask('active')" class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">Active</button>
      </li>
      <li class="nav-item" role="presentation">
        <button onclick="viewTask('complete')" class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">Completed</button>
      </li>
      <li class="nav-item" role="presentation">
        <button onclick="viewTask('pending')" class="nav-link" id="notcompleted-tab" data-bs-toggle="tab" data-bs-target="#notcompleted" type="button" role="tab">Pending</button>
      </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="taskTabsContent">
      <!-- Active Tasks -->
       <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>My Tasks</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal" onclick="showbtns()">
                <i class="fa fa-plus"></i> New Task
            </button>
        </div>
      <!-- <div class="tab-pane fade show active" id="active" role="tabpanel" class="tableContent"> -->
      <div class="tab-pane fade show active tableContent" role="tabpanel">
        
      </div>

      <!-- Completed Tasks -->
      <div class="tab-pane fade" id="completed" role="tabpanel">
        
             
      </div>

      <!-- Not Completed Tasks -->
      <div class="tab-pane fade" id="notcompleted" role="tabpanel">
        
      </div>
    </div>
  </div>
<!-- Task Modal -->
<div class="modal fade" id="taskModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Create New Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- <form method="POST" action="task_controller.php"> -->
        <div class="modal-body">
          
          <div class="mb-3">
            <label class="form-label">Task Name</label>
            <input type="text" name="task_name" id="task_name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Priority</label>
            <select name="task_priority" class="form-select" id="task_priority">
              <option value="Low">Low</option>
              <option value="Medium" selected>Medium</option>
              <option value="High">High</option>
            </select>
          </div>
    
          <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="task_due_date" class="form-control" id="task_due_date">
          </div>
<div class="mb-3" id="task_active_status">
        <label class="form-label">Change Task Status</label>
        <select name="task_status" class="form-select" id="task_status">
            <option value="active">Active</option>
            <option value="complete">Complete</option>
        </select>
        </div>
          <input type="hidden" name="task_id" id="task_id">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
         <div id="tskupdateBtn"></div>
          <button id="createTaskBtn" type="submit" class="btn btn-success" onclick="createTask()">Create Task</button>
          <button id="updateTaskBtn" type="submit" class="btn btn-success" onclick="update_task()">Update Task</button>
        </div>

      <!-- </form> -->

    </div>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$(document).ready(function() {
    $('#updateTaskBtn').hide();
    $('#task_active_status').hide();
    viewTask();
});

function createTask(){
    
    var task_name = $("#task_name").val();
    var task_priority = $("#task_priority").val();
    var task_due_date = $("#task_due_date").val();
    
        $.ajax({
            url: 'taskManageController.php',
            type: 'POST',
            dataType:'json',
            data: {function:1,task_name:task_name,task_priority:task_priority,task_due_date:task_due_date },
            success: function(response) {
                  if(response.status === 'error') {
                    alert(response.message);

                } else {
                    alert(response.message);
                }
                $('#taskModal').modal('hide');
                viewTask('active');
            },
            error: function() {
                alert('Something went wrong!');
            }
        });

}
function viewTask(taskStatus='active'){
    
    var task_name = $("#task_name").val();
    var task_priority = $("#task_priority").val();
    var task_due_date = $("#task_due_date").val();
    
        $.ajax({
            url: 'taskManageController.php',
            type: 'POST',
            dataType:'json',
            data: {function:2,taskStatus:taskStatus},
            success: function(response) {
                  $(".tableContent").html(response.taskHtml);
            },
            error: function() {
                alert('Something went wrong!');
            }
        });

}
function edit_task(task_id="") {
    $.ajax({
        url: 'taskManageController.php',
        type: 'POST',
        dataType: 'json',
        data: {function: 3, task_id: task_id},

        success: function(response) {

            $('#task_name').val(response.result.task_name);
            $('#task_status').val(response.result.task_status);
            $('#task_id').val(response.result.task_id);
            $('#task_due_date').val(response.result.task_due_date);
            $('#task_status').val(response.result.task_status);

            var modal = new bootstrap.Modal($('#taskModal')[0]);
            $('#updateTaskBtn').show();
            $('#createTaskBtn').hide();
            $('#task_active_status').show();
            modal.show();
        },

        error: function() {
            alert('Something went wrong!');
        }
    });
}
function update_task(){
     var task_name = $("#task_name").val();
    var task_priority = $("#task_priority").val();
    var task_due_date = $("#task_due_date").val();
    var task_id = $("#task_id").val();
    $.ajax({
        url: 'taskManageController.php',
        type: 'POST',
        dataType: 'json',
        data: {function: 4, task_id: task_id,task_name:task_name,task_priority:task_priority,task_due_date:task_due_date},
success: function(response) {
 alert('Updated');
            $('#taskModal').modal('hide');
            viewTask('active')
        },
        error: function() {
            alert('Something went wrong!');
        }
    });
}
function delete_task(task_id){
    if(confirm("Are you sure you want to delete?")) {
    $.ajax({
        url: 'taskManageController.php',
        type: 'POST',
        dataType: 'json',
        data: {function: 5,task_id:task_id},
            success: function(response) {
            alert('Task Deleted');
                        viewTask('active')
                    },
                    error: function() {
                        alert('Something went wrong!');
                    }
                });

    }else{
        return false;
    }
}
function showbtns(){
    $('#updateTaskBtn').hide();
    $('#createTaskBtn').show();
    $('#task_active_status').hide();
}
</script>
</body>
</html>