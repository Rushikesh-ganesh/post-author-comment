Problem Statement :

● Users can register. Also create a login, logout module, Change password & forgot password. 
● User can create a post 
○ Post contains title, date, author ,description,tags(it will be used to filter posts) 
● Users can see all posts but only be able to edit their own posts, not others. ○ Users can edit & delete only their own posts. 
○ They can not delete others posts and deletion can only occur if there are no comments after it 
● On the listing page (which will be the Home page) there should be only post title, date, author name, & comment counts, upon clicking on that description, it should be visible (in a new page) 
● Each page has a maximum of 2 posts available per page for other post users to click on the next page using standard pagination. 
● Any User can comment on the post. 
○ If a guest tries to comment, they will be prompted to login or register. ○ They can not delete others posts and deletion can only occur if there are no comments after it


Steps to Run the Project 
- Take a clone of project 
- composer Install
- Set Database to Project's .env file 
- run " php artisan migrate"
- run "php artisan db:seede"
- Enjoy the Blog site 


Thank you .
