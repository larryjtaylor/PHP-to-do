# _To Do List_

#### _PHP Silex & Database Practice, 7.11.2017_

#### By _**Calla Rudolph & Brittany Kerr**_

## Description

_This PHP database exercise allows the user to enter categories and within the category they can add tasks, thus creating a To Do list. The user can add a due date to the tasks, list all tasks and categories, and delete an entire category._

## Setup Requirements

* Open GitHub site on your browser: https://github.com/CallaRudolph/php-toDoList
* Select the dropdown (green box) "Clone or download"
* Copy the link for the GitHub repository
* Open Terminal on your computer
* In Terminal, perform the following steps:
  * type 'cd desktop' and press enter
  * type 'git clone' then copy the repository link and press enter
  * type 'cd php-toDoList-DB' to access the path on your computer
  * type 'composer install' in terminal to download dependencies
* In browser type "localhost:8888/phpmyadmin"
  * Click 'import' tab and choose file 'to_do.sql' to import database.
* Open preferences>ports on MAMP and verify that Apache Port is 8888.
* Go to preferences>web server and click the file folder next to document root.
  * Click web folder and hit select.
  * Click ok at the bottom of preferences and then click 'Start Server'
* In your browser, enter 'localhost:8888' to view the webpage on your browser
* Type a category name in input field to get started.

## Specifications
1 The program returns a list of categories that the user enters.
```
  * Example Input: 'home chores', 'work errands'
  * Example Output:
    * home chores
    * work errands
```
2 The user can click on the category and enter a task description and due date, which is then added to a task list under the category.
```
  * Example Input: 'clean room' '7/7/17'
  * Example Output:
          home chores:
          * clean room
            * Due: 7/7/17
```
3 The user can click 'edit this category' and rename the category, which will then appear updated on home page.
```
  * Example Input: 'home stuff'
  * Example Output: 'home stuff', 'work errands'
```

4 The user can click 'edit this category' and click 'delete this category', allowing the user to return to home page and category to be erased.
```
  * Example Input: click 'delete this category'
  * Example Output: 'work errands'
```

## Technologies Used

* _PHP_
* _HTML_
* _Bootstrap CSS_
* _Silex_
* _Twig_
* _Composer_
* _MAMP_

### License

Copyright &copy; 2017 Calla Rudolph & Brittany Kerr

This software is licensed under the MIT license.
