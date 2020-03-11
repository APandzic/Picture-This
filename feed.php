<?php

require __DIR__.'/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<div class="container-feed">
    <div class="container-error-message">
        <?php if ($message !== '') { ?>
            <p class="error-message"><?php echo $message; ?></p>
        <?php } ?>
    </div>

    <?php foreach (getAllPosts($pdo) as $post) { ?>
        <div class="container-feed-post">
            <div class="container-feed-post-header">
                <div class="container-img-avatar-feed">
                    <img class="img-avatar" src="<?php echo '/img-avatar/'.getUsersAvatar($post['user_id'], $pdo) ?>" alt="avatar">
                </div>
                <p><?php echo getUsersUsername($post['user_id'], $pdo); ?></p>
            </div>
            <div class="container-img-posts">
                <img class="img-post" src="<?php echo '/img-posts/'.$post['post_img']; ?>" alt="posts">
            </div>

            <form class="form like-form" method="post">
                <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
                <button class="like-button" type="submit"><?php echo checkIfPostIsLiked($post['id'], $_SESSION['user']['id'], $pdo); ?></button>
                <div class="container-like-counter">
                    <p class="like-counter"><?php echo count(getLikes($post['id'], $pdo)); ?></p>
                    <p class="like-counter"> Likes</p>
                </div>
            </form>
            <div class="container-post-description">
                <a class="post-username" href="<?php echo 'home.php?id='.$post['user_id'] ?>"><?php echo getUsersUsername($post['user_id'], $pdo); ?></a>
                <p class="post-description"><?php echo $post['description']; ?></p>
            </div>
            <?php foreach (getComments($pdo, $post['id']) as $comment) { ?>
                <div class="comment-list">
                    <p> <?php echo $comment['username'].': '.$comment['content']; ?></p>

                    <div class="comment-icons">
                        <form class="form-editcomment" action="app/posts/edit-comment.php" method="POST" enctype="multipart/form-data" name="editcomment">
                            <input type="hidden" name="commentid" value="<?= $comment['id'] ?>">
                            <input type="hidden" name="postid" value="<?= $post['id'] ?>">
                            <input class="edit-comment" type="text" name="editcomment" placeholder="Edit your comment" autocomplete="off">
                            <button type="submit" class="comment-edit"></button>
                        </form>
                        <form class="form-delete" action="app/posts/delete-comment.php" method="POST" enctype="multipart/form-data" name="delete-comment">
                            <input type="hidden" name="commentid" value="<?= $comment['id'] ?>">
                            <input type="hidden" name="postid" value="<?= $post['id'] ?>">
                            <button class="delete-button" type="submit" name="delete-comment"></button>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <form action="/app/posts/comment.php" method="post">
                <div class="comment-container">
                    <input type="hidden" name="postid" value="<?= $post['id'] ?>">
                    <input class="comment-input" type="text" name="comment" placeholder="Leave your comment here" autocomplete="off">
                    <button type="submit" class="comment-submit"></button>
                </div>
            </form>

        </div>
    <?php } ?>


</div>

<?php require __DIR__.'/views/footer.php'; ?>