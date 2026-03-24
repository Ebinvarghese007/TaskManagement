<?php
session_start();
require_once 'config.php';
if($_POST['function'] == 1){
    
    $user_id = $_SESSION['user_id'];

    $task_name = $_POST['task_name'] ?? '';
    $task_priority = $_POST['task_priority'] ?? '';
    $task_due_date = $_POST['task_due_date'] ?? '';


    if (empty($task_name) || empty($task_priority) || empty($task_due_date)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'All fields are required'
    ]);
    exit;
    }

    try {
    $stmt = $pdo->prepare("
        INSERT INTO user_tasks (user_id, task_name, task_priority, task_due_date,task_status)
        VALUES (:user_id, :task_name, :task_priority, :task_due_date,:task_status)
    ");
    $stmt->execute([
        'user_id' => $user_id,
        'task_name' => $task_name,
        'task_priority' => $task_priority,
        'task_due_date' => $task_due_date,
        'task_status' => 'active'
    ]);

    echo json_encode([
        'status' => 'success',
        'message' => 'Task created successfully'
    ]);

    } catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to create task'
        // 'debug' => $e->getMessage() // 
    ]);
    }
}


if($_POST['function'] == 2){
    $user_id = $_SESSION['user_id'];
    $taskStatus = $_POST['taskStatus'];
    $class =  'bg-success';
    if($taskStatus == 'active'){
    $stmt = $pdo->prepare("
            SELECT *
            FROM user_tasks
            WHERE user_id = :user_id 
            AND task_due_date >= CURRENT_DATE
            ORDER BY task_due_date ASC"
            );
           $class =  'bg-success';
    }elseif($taskStatus == 'pending'){
        $stmt = $pdo->prepare("
                SELECT *
                FROM user_tasks
                WHERE user_id = :user_id 
                AND task_due_date < CURRENT_DATE
                AND task_status!= 'complete'
                ORDER BY task_due_date ASC"
                );
                $class =  'bg-warning';
    }else{
        $stmt = $pdo->prepare("
                SELECT *
                FROM user_tasks
                WHERE user_id = :user_id 
                AND task_status = :task_status
                ORDER BY task_due_date ASC"
                );
    }
    if($taskStatus=='complete'){
    $stmt->execute(
        [
            'user_id' => $user_id,
            'task_status'=> $taskStatus
        ],
        );
    }else{
       $stmt->execute(
        [
            'user_id' => $user_id
        ],
        ); 
    }
        
// echo $stmt->queryString;
$taskdetailsArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
$taskhtml = '';
$result = array();

$taskhtml .= '<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Task</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Due Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>';
if(!empty($taskdetailsArr)){
    foreach ($taskdetailsArr as $key => $value) {
        $taskhtml .= '<tr>
            <td>' . ($key + 1) . '</td>
            <td>' . htmlspecialchars($value['task_name']) . '</td>
            <td><span class="badge text-dark '.$class.'">'. htmlspecialchars($taskStatus) . '</span></td>
            <td>' . htmlspecialchars($value['task_priority']) . '</td>
            <td>' . htmlspecialchars($value['task_due_date']) . '</td>
            <td>';
            if($value['task_status']!='complete'){
                $taskhtml .=   '<button class="btn btn-sm btn-primary" onclick="edit_task('.$value['task_id'].')">Edit</button>';
                                                           
            } 
            $taskhtml .=   '&nbsp&nbsp<button class="btn btn-sm btn-danger" onclick="delete_task('.$value['task_id'].')">Delete</button>
                                    </td>
                                </tr>';  

    }
    $taskhtml .= '</tbody></table>';
    $result['taskHtml'] = $taskhtml; 
    $result['status'] = 'success';

}else{
    $result['status'] = 'error';
    $result['taskHtml'] = 'No data found';
}
  echo json_encode($result);
}


if($_POST['function']==3){
$user_id = $_SESSION['user_id'];
if (empty($_POST['task_id']) && empty($user_id)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'All fields are required'
    ]);
    exit;
    }
    $stmt = $pdo->prepare("
            SELECT *
            FROM user_tasks
            WHERE user_id = :user_id 
            AND task_id = :task_id"
            );
            $stmt->execute(
            [
                'user_id' => $user_id,
                'task_id'=> $_POST['task_id']
            ],
            );
            $taskdetailsArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($taskdetailsArr);
           $task_name =  $taskdetailsArr[0]['task_name'];
            $task_status =  $taskdetailsArr[0]['task_status'];
            $task_priority =  $taskdetailsArr[0]['task_priority'];
            $task_due_date =  $taskdetailsArr[0]['task_due_date'];
            $resArr = array(
                'task_id' => $_POST['task_id'],
                'task_name' => $task_name,
                'task_status' => $task_status,
                'task_priority' => $task_priority,
                'task_due_date' => $task_due_date

            );
            $result['result'] = $resArr;
            echo json_encode($result);
}
 if ($_POST['function'] == 4) {

    $user_id = $_SESSION['user_id'];
    $task_id = $_POST['task_id'];
    $task_name = $_POST['task_name'];
    $task_priority = $_POST['task_priority'];
    $task_due_date = $_POST['task_due_date'];

    // validation
    if (empty($task_id) || empty($user_id) || empty($task_name) || empty($task_priority)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'All fields are required'
        ]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            UPDATE user_tasks
            SET task_name = :task_name,
                task_priority = :task_priority,
                task_due_date = :task_due_date
            WHERE task_id = :task_id
              AND user_id = :user_id
        ");

        $stmt->execute([
            'task_name' => $task_name,
            'task_priority' => $task_priority,
            'task_due_date' => $task_due_date,
            'task_id' => $task_id,
            'user_id' => $user_id
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Task updated successfully'
        ]);

    } catch (PDOException $e) {
        // return actual error for debugging (optional)
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed: ' . $e->getMessage()
        ]);
    }

} 
if ($_POST['function'] == 5) {

    $user_id = $_SESSION['user_id'];
    $task_id = $_POST['task_id'];

    // validation
    if (empty($task_id) || empty($user_id)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid request'
        ]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            DELETE FROM user_tasks
            WHERE task_id = :task_id
            AND user_id = :user_id
        ");

        $stmt->execute([
            'task_id' => $task_id,
            'user_id' => $user_id
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Task deleted successfully'
        ]);

    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}