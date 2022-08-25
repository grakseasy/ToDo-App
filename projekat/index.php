<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "ToDoList");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task!";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}	
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
    
        mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
        header('location: index.php');
    }
?>


<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>ToDo App</title>
  </head>
  <body class="bg-secondary">
    <div class="container bg-dark border shadow mt-5" style="border-radius: 20px;">

        <div class="heading text-white">
            <div class="pb-2"></div>
        <div class="border border-white p-2" style="width: fit-content; border-radius: 20px;">Weather/Calendar API here</div>
    
        <h2 class="m-3" style="font-style: 'Hervetica'; text-align: center;">ToDo List App</h2>
        </div>
        <form method="post" action="index.php" class="input_form">
            <div class="text-white" style="text-align: center;">
                <?php if (isset($errors)) { ?>
                    <p><?php echo $errors; ?></p>
                <?php } ?>
            </div>
            <div style="text-align: center;" class="mb-4">
                  <input type="text" name="task" class="task_input bg-white">
                  <button style="font-weight: bold;" type="submit" name="submit" id="add_btn" class="add_btn bg-white button rounded border">Add</button>
            </div>

        </form>

        <table style="border-radius: 20px;" class="table border border-dark table-striped table-dark">
            <thead>
                <tr>
                    <th>Task Number</th>
                    <th>Task Name</th>
                    <th style="width: 60px;">Delete</th>
                </tr>
            </thead>

            <tbody class="p-3" style="border-radius: 20px;">
                <?php 
                // select all tasks if page is visited or refreshed
                $tasks = mysqli_query($db, "SELECT * FROM tasks");
                $i = 1;
                while ($row = mysqli_fetch_array($tasks)) 
                { ?>

                    <tr>
                        <td> <?php echo $i; ?> </td>
                        <td class="task"> <?php echo $row['task']; ?> </td>
                        <td class="delete"> 
                            <a class="text-white" href="index.php?del_task=<?php echo $row['id'] ?>"><span style="font-weight: bold;">X</span></a> 
                        </td>
                    </tr>

                <?php $i++; } ?>	
            </tbody>
        </table>
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    
  </body>
</html>