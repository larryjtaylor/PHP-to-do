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
            $date = "Easter";
            $finished = true;
            $test_task = new Task($description, $date, $finished);

            //Act
            $result = $test_task->getDescription();

            //Assert
            $this->assertEquals($description, $result);
        }

        function testSetDescription()
        {
            //Arrange
            $description = "Do dishes.";
            $date = "April 25";
            $finished = true;
            $test_task = new Task($description, $date, $finished);

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
            $date = "July 4";
            $finished = true;
            $test_task = new Task($description, $date, $finished);
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
            $date = "July 4";
            $finished = true;
            $test_task = new Task($description, $date, $finished);

            //Act
            $executed = $test_task->save();

            //Assert
            $this->assertTrue($executed, "Task not successfully saved to database");
        }

        function testGetAll()
        {
            //Arrange
            $description = "Wash the dog";
            $date = "July 5";
            $finished = true;
            $test_task = new Task($description, $date, $finished);
            $test_task->save();

            $description_2 = "Water the lawn";
            $date_2 = "Christmas";
            $finished_2 = true;
            $test_task_2 = new Task($description_2, $date_2, $finished_2);
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
            $date = "July 5";
            $finished = true;
            $test_task = new Task($description, $date, $finished);
            $test_task->save();

            $description_2 = "Water the lawn";
            $date_2 = "Christmas";
            $finished_2 = true;
            $test_task_2 = new Task($description_2, $date_2, $finished_2);
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
            $date = "July 4";
            $finished = true;
            $test_task = new Task($description, $date, $finished);
            $test_task->save();

            $description_2 = "Water the lawn";
            $date_2 = "Christmas";
            $finished_2 = true;
            $test_task_2 = new Task($description_2, $date_2, $finished_2);
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
            $date = "Oct 1";
            $finished = true;
            $test_task = new Task($description, $date, $finished);
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
            $date = "Aug 2";
            $finished = true;
            $test_task = new Task($description, $date, $finished);
            $test_task->save();

            $description2 = "Water the lawn";
            $date2 = "Aug 1";
            $finished_2 = true;
            $test_task2 = new Task($description2, $date2, $finished_2);
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
            $date = "Oct 1";
            $finished = false;
            $test_task = new Task($description, $date, $finished);
            $test_task->save();

            $new_finished = true;

            //Act
            $test_task->updateFinished($new_finished);

            //Assert
            $this->assertEquals(true, $test_task->getFinished());

        }
    }
?>
