# Simple-CMS-using-OOP-PHP-and-PDO
Project Description
My project is a Content Management Web App that displays the blog acticles about outdoor activities near Vancouver,BC. The web site hosts outdoor activity blogs that can be categorized in four fields namely hiking, skiing, boating and biking. Each category contains blogs that contain details like title, location, content, image and author. All articles are loaded dynamically from the database using PHP and SQL. The web-apps functionality depends on the type of login credentials, casual users or admin.
![Alt text](./projectPHP.gif)

The user must register\login to gain access to the website content. The user is allowed the following privelleges:
- Read a specific article in detail by clicking on it. 
- Navigate to a specific category to check all articles in that category.
- Click on the Author’s name to check all articles written by that Author.
- Search articles by entering keywords.

The admin can login to create, edit, and delete the articles. The admin is shown the total number of articles present in the database. The admin may create a new article by adding the title, location, author, image, content and category for the blog article. Similarly, admin may edit all the above attributes using the HTML forms. The admin may choose to hide the article on the website by choosing to not display in the editing page. These forms, together with PDO, communicate with database to reflect the changes made by the admin. 

## User Manual
1. Create database using the SQL file included in the data directory.
2. Run XAMPP/MAMP on your machine. Start Apache web server and MySql.
3. Create a symbolic link for directory containing the Web-app in C:\xampp\htdocs (windows machine).
4. Go to localhost/directoty-name/memberLogin.php in your web browser. Register, if you dont have an account. 
SAMPLE LOGIN CREDENTIALS: username: simon password: password 
5. Once loggen in, you will be redirected to the user index page which displays 6 articles.
6. You may choose to navigate to a particular category. Eg hiking by using the navigation bar at the top or by clinking at the link bellow the article image.
7. Click on the author name to access all articles by that author.
8. All the clickable links are highlighted green when hovered by mouse. 
9. Click on search icon in the nav bar to go to search page. Enter the search keyword to view results.
10. Logout to move back to login form.
11. LOGIN AS ADMIN:       username: admin             password: csis3280
12. Once Logged in as admin, you will see the admin-Index page that has the count of all articles and buttons for creating or viewing the articles.
13. Click on view button to see the list of all articles. 
14. Now admin can check all articles with the option of deleting or editing the article.
15. Click on edit. Fill out the web-form with appropriate data. Click save. The admin will be navigated back to the previous page. 
16. Click on delete. Cancel delete to go back. Click confirm delete to delete the article.
17. Click on add new activity and fill out the web-form to add new article.
18. Click on the logo on the nav bar to go back to the admin-Index page.
19. Click on logout to go back to login screen
