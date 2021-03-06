<?php

if (!if_user_loggedin()) {
    redirect('/');
}

    if (isset($_SESSION['user']['id'])) {
        if (isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
        }
        $userId = (int) $_SESSION['user']['id'];

        $statement = $pdo->prepare('SELECT * FROM posts WHERE p_id = :user_id');
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':user_id', $post_id, PDO::PARAM_STR);
        $statement->execute();

        $post = $statement->fetch(PDO::FETCH_ASSOC);

        // checks if the user is the owner of post
        if (!is_user_owner((int) $post['user_id'], $userId)) {
            redirect('/posts.php');
        }

        // changes the post text
        if (isset($_POST['post-text'])) {
            $statement = $pdo->prepare('UPDATE posts SET post_text = :post_text WHERE p_id = :post_id');

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }
            $statement->bindParam(':post_text', nl2br(filter_var($_POST['post-text']), FILTER_SANITIZE_STRING), PDO::PARAM_STR);
            $statement->bindParam(':post_id', $post_id, PDO::PARAM_STR);
            $statement->execute();

            redirect('/posts.php');
        }

        // deletes the post
        if (isset($_POST['delete'])) {
            // delete post img
            $statement = $pdo->prepare('SELECT img FROM posts WHERE p_id = :id');

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':id', $post_id, PDO::PARAM_STR);
            $statement->execute();

            $userpost = $statement->fetchAll(PDO::FETCH_ASSOC);

            $path = __DIR__.'/../img/post_img/';

            foreach ($userpost as $post) {
                unlink($path.$post['img']);
            }

            $statement = $pdo->prepare('DELETE FROM posts WHERE p_id = :post_id');

            $statement->bindParam(':post_id', $post_id, PDO::PARAM_STR);
            $statement->execute();


            $statement = $pdo->prepare('DELETE FROM likes WHERE post_id = :post_id');

            $statement->bindParam(':post_id', $post_id, PDO::PARAM_STR);
            $statement->execute();

            redirect('/posts.php');
        }
    };
