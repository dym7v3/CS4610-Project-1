# CS4610-Project-1
Manage Math Question Bacnk

Project Done by: Dennis Moyseyev

Description
In this programming project, we will develop some features that help us maintain a Math Question Bank. We can add new math questions into the bank. Then you can edit any math question in the bank. We list all the math questions in multiple pages. We can also change the order of the questions.
 
Requirements
Database
The initial data is given in the example Listing Math Questions, where you can find the database script file mathprobdb.sql in the db folder. In order to change the order of the questions, you are allowed to either add a column to the table or add a new table to the database.
User interface
You need to use HTML/CSS/JavaScript to create your user interface. The look may not be that important. The bottom line is that your interface supports all the features required for this project.
List questions
When you come to the page, the math questions in the bank are listed (in multiple pages). Each question should have an order number, and this number is displayed with each question.
Pagination
We list all the questions in multiple pages. Each page has 20 questions except the last page. There is a Prev button and a Next button to help you navigate to different pages. When you navigate the pages, you should display the current page number and the total page number on the page.
Enter questions
There is a question input area and a Submit button above the question list area. After you insert a new question, the page should be updated to list the first page of the questions with the newest question on top.
Input validation
When a new question is entered, check if the input is valid. If a question is not empty, it is valid. If the input is empty, an error message should be displayed.
Edit questions
For each math question, you can associate it with an Edit button. When you click this button, a textarea that contains the content of the current question is displayed. After you change the content and click the Update button, the question is modified.
Change order
For each math question, you can associate it with an up and/or down arrow buttons. When you click an arrow button, the order of the current question is changed accordingly. Note that the order-change feature also works across two adjacent pages.
Support Latex commands
In order to display math formulas in professional look, your programs should support the Latex commands.
Delete questions
For each math question, you can associate it with a Delete button. When you click this button, this question is deleted from the question bank. After each deletion, the question order should be adjusted accordingly.
Undo deletions
Put an Undo button on the page. Assume that several questions have been deleted. When you press the Undo button, the most recently deleted question is recovered. You can use this button to recover several deleted questions. Note that the question order should be adjusted after a deleted question is recovered.
Use graphical buttons
Try to use as many graphical buttons as possible from the Bootstrap.
