<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

        function testGetDescription()
        {
            //Arrange
            $description = "Do dishes.";
            $due_date = "Easter";
            $test_task = new Task($description, $due_date);

            //Act
            $result = $test_task->getDescription();

            //Assert
            $this->assertEquals($description, $result);
        }

        function testSetDescription()
        {
            //Arrange
            $description = "Do dishes.";
            $due_date = "April 25";
            $test_task = new Task($description, $due_date);

            //Act
            $test_task->setDescription("Drink coffee.");
            $result = $test_task->getDescription();

            //Assert
            $this->assertEquals("Drink coffee.", $result);
        }
        function testGetID()
        {
            // Arrange
            $description = "Wash the dog";
            $due_date = "July 4";
            $test_task = new Task($description, $due_date);
            $test_task->save();

            //Acts
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $description = "Wash the dog";
            $due_date = "July 4";
            $test_task = new Task($description, $due_date);

            //Act
            $executed = $test_task->save();

            //Assert
            $this->assertTrue($executed, "Task not successfully saved to database");
        }

        function testGetAll()
        {
            //Arrange
            $description = "Wash the dog";
            $due_date = "July 5";
            $test_task = new Task($description, $due_date);
            $test_task->save();

            $description_2 = "Water the lawn";
            $due_date_2 = "Christmas";
            $test_task_2 = new Task($description_2, $due_date_2);
            $test_task_2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $description = "Wash the dog";
            $due_date = "July 5";
            $test_task = new Task($description, $due_date);
            $test_task->save();

            $description_2 = "Water the lawn";
            $due_date_2 = "Christmas";
            $test_task_2 = new Task($description_2, $due_date_2);
            $test_task_2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $description = "Wash the dog";
            $due_date = "July 4";
            $test_task = new Task($description, $due_date);
            $test_task->save();

            $description_2 = "Water the lawn";
            $due_date_2 = "Christmas";
            $test_task_2 = new Task($description_2, $due_date_2);
            $test_task_2->save();

            //Act
            $result = Task::find($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }

        function testUpdate()
        {
            //Arrange
            $description = "Wash the dog";
            $due_date = "Oct 1";
            $test_task = new Task($description, $due_date);
            $test_task->save();

            $new_description = "Clean the dog";

            //Act
            $test_task->update($new_description);

            //Assert
            $this->assertEquals("Clean the dog", $test_task->getDescription());
        }

        function test_deleteTask()
        {
            //Arrange
            $description = "Wash the dog";
            $due_date = "Aug 2";
            $test_task = new Task($description, $due_date);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "Aug 1";
            $test_task2 = new Task($description2, $due_date2);
            $test_task2->save();


            //Act
            $test_task->delete();

            //Assert
            $this->assertEquals([$test_task2], Task::getAll());
        }
        function testUpdateFinished()
        {
            //Arrange
            $description = "Wash the dog";
            $due_date = "Oct 1";
            $finished = false;
            $test_task = new Task($description, $due_date);
            $test_task->save();

            $new_finished = true;

            //Act
            $test_task->updateFinished($new_finished);

            //Assert
            $this->assertEquals(true, $test_task->getFinished());

        }
    }
?>
