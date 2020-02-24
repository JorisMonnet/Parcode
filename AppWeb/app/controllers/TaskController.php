<?php

require "app/models/Task.php";
require "core/Logger.php";

class TaskController
{
    public function index(){
        $tasks = Task::fetchAll($_SESSION['userid']);

        $task_added_success = 0; // avoid warning

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['updated']) &&  ctype_digit($_GET['updated'])){
                $task_added_success = $_GET['updated'];
            }

            $task_added_failure = "";
            if (isset($_GET['delay_failed'])) {
                $task_added_failure = "submission too fast";
            }
        }

        return Helper::view("show_tasks",[
                'tasks' => $tasks,
                'task_added_success' => $task_added_success,
                'task_added_failure' => $task_added_failure,
            ]);
    }

    public function show(){
        if(isset($_GET["id"]) && ctype_digit($_GET["id"]))
        {
            $task = Task::fetchId($_GET["id"]);
            if($task == null)
            {
                // raising an exception maybe not the best solution
                throw new Exception("TASK NOT FOUND.", 1);
            }
        }
        else {
            throw new Exception("TASK NOT FOUND.", 1);
        }

        return Helper::view("show_task",[
                'currentTask' => $task,
            ]);
    }

    public function update(){
        if(isset($_GET['id']) && ctype_digit($_GET['id']))
        {
            $task = Task::fetchId($_GET["id"]);
            if($task == null)
            {
                // raising an exception maybe not the best solution
                throw new Exception("TASK NOT FOUND.", 1);
            }

        }
        else
        {
            throw new Exception("Error retrieving the task. ID is not valid", 1);
        }
        return Helper::view('update_task',[
                'currentTask' => $task,
            ]);
    }

    public function parseUpdate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(
                isset($_POST['id']) &&
                ctype_digit($_POST['id']) &&
                isset($_POST['description']) &&
                // isset($_POST['completed']) && // a checkbox is not sent if not checked
                isset($_POST['deadline'])
                )
            {
                if(isset($_POST['completed']))
                  if($_POST['completed'] == 'on')
                    $completed = true;
                $entry = [
                  'description' => $_POST['description'],
                  'completed' => $completed ?? false,
                  'deadline' => $_POST['deadline'],
                  'login' => $_SESSION['userid'],
                  'id' => $_POST['id']
                ];
                Task::update($entry);
            }
            else {
                throw new Exception("Some data are missing...", 1);
            }
            // alternative: use the $_SESSION, so you can't make
            // our application say (constrained by number) things
            $task = Task::fetchId($_POST['id']);
            Logger::addLogEvent($_SESSION['user'].' updated: "'. $task->getDescription() . '" (task number: '. $task->getId().')');
            $path = App::get('config')['install_prefix'] . '/tasks?updated=2';
            header("Location: /{$path}");
            exit();
        }
    }

    public function showAddView(){
        return Helper::view('add_task');
    }

    public function showUpdateView(){
        return Helper::view('update_view');
    }

    public function parseInput(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['description']))
            {
                // echo "Parsing the requests\n";
              $task = new Task;
            	$task->setDescription($_POST['description']); // Not escaped yet (right thing to do)
            	if(isset($_POST['completed']))
            	{
            		// echo "======= ";
            		// echo gettype($_POST['completed']);
            		// echo " =======";

            		$task->setCompleted(1); //$_POST['completed'];
            	}
            	else
            	{
            		$task->setCompleted(0);
            	}

                if($_POST['deadline'] === "")
                {
                    // date is not set - setting the current date
                    $task->setDeadline(date('Y-m-d'));
                }
                else {
                    $task->setDeadline($_POST['deadline']);
                }
                $task->setLogin($_SESSION['userid']);
                $allow_insert = true;
                if (isset($_COOKIE['task_per_minute_counter']))
                {
                  if ($_COOKIE['task_per_minute_counter'] > 90)
                  {
                    echo "set false";
                    $allow_insert = false;
                  }
                  else
                  {
                    setcookie("task_per_minute_counter",
                              $_COOKIE['task_per_minute_counter'] + 1);
                  }
                }
                else
                {
                   setcookie("task_per_minute_counter", 1, time() + 60);

                }
                if ($allow_insert) {
                    $task->save();
                    $path = App::get('config')['install_prefix'] . '/tasks?updated=1';
                }
                else {
                   $path = App::get('config')['install_prefix'] . '/tasks?delay_failed=1';
                }
                Logger::addLogEvent($_SESSION['user'].' added "'.$_POST['description'] . '" task');
                header("Location: /{$path}");
                exit();
            }
            else
            {
            	throw new Exception("Description can't be empty.", 1);
            }
        }
    }

    public function parseDelete(){
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['id'])){
          $task = Task::fetchId($_POST['id']);
          Task::delete($_POST['id']);
        }
        else{
          throw new Exception("Task don't exist", 1);
        }
        Logger::addLogEvent($_SESSION['user'].' deleted '. $task->getDescription());
        $path = App::get('config')['install_prefix'];
        header("Location: /{$path}");
        exit();
      }
    }
}
