# Picture-This
Assignment from school to create a social media clone entirely in HTML, CSS, JavaScript and PHP.


__The assignment requirements:__
* As a user I should be able to create an account. 
* As a user I should be able to login.
* As a user I should be able to logout.
* As a user I should be able to edit my account email, password and biography.
* As a user I should be able to upload a profile avatar image.
* As a user I should be able to create new posts with image and description.
* As a user I should be able to edit my posts.
* As a user I should be able to delete my posts.
* As a user I should be able to like posts.
* As a user I should be able to remove likes from posts.

__Fulfilled requirements:__
* All the features above is met.

### Extra features: 

* As a user I'm able to follow and unfollow other users.
* As a user I'm able to view a list of posts by users I follow.
* As a user I'm able to search for other users. 

### Hidden features. Need to know before use. 

* To be able to edit your posts you need to be on your home page and click on the image.

### Prerequisites

You will need a server software.

Exemple:
UBUNTU SERVER or MAMPA.

### Installing


1. Clone the repository

```
$ git clone https://github.com/APandzic/Picture-This
```

2. Navigate to the folder where you cloned the repository via the terminal

3. Start a local server
```
php -S localhost:8000
```

4. Open up your favorite browser and enter localhost:8888/index.php in the url

5. Enjoy!



## Built With

* HTML
* CSS
* JAVASCRIPT Vanilla
* PHP

__We were not allowed to use any other language or framework for this assignment.__


## Responsive Design and compatibility


__Browsers:__
- [] Google Chrome
- [] Firefox
- [] Safari



## Authors

* **Andreas Pandzic** - *Initial work* - [Andreas](https://apandzic.github.io)

## Testers
* Viktor Sjöblom
* Betsy Alva Soplin


## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details


## Code review - Daniel Thorsen
1. You can break out:
$message = $_SESSION[‘message’] ?? ‘’; unset($_SESSION[‘message’]);
Into a file, place it for example in view and then require that file where users gets messages.
2. If you comment in the functions under /app it is easier for another developer to understand what the different steps do and why.
3. You can place
$userId = $_SESSION[‘user’][‘id’]
in /autoload.php and then use the variable instead since you use it many times and the variable name describe the usage.
4. Nice funtions - Well described
5. Echo out the profile-name in the alt-tag + avatar. Maybe add the post-description to the alt-tag on post, but it might be too long.
6. Add loading=“lazy”  on images in post and those beneath the folder will be lazy-loaded and the user load the feed quicker.
7.  Why no GIF-support? Everyone loves a fun GIF!
8. Instead of
<?php echo count(getLikes($post[‘id’], $pdo)); ?>
You can count and return this in SQL. That will go quicker and save memory and CPU.
9. Maybe give the user a confirm message when logged out.
10.  edit-settings.php lines 52-54 - The preg_match-functions can be done in one line with regEX.

YRGO 2019


### Picture That

## [Viktor Sjöblom](https://github.com/ViktorSjoblom)

* Added comments, edit comments and delete comments.
* Added remove account.
