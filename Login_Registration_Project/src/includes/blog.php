
<?php require_once "./sessionMang.inc.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <link rel="stylesheet" href="../css/blog.css">
</head>
<body>
    <header>
        <h1>Smtr Blog</h1>
    </header>
    <main>

        <section id="write-post">
            <h2>Write a New Post</h2>
            <form method="POST" action="./blogProcess.inc.php">
                <div>
                    <label for="post-title">Title:</label>
                    <input type="text" name="title" required>
                </div>
                <div>
                    <label for="post-content">Content:</label>
                    <textarea name="content" rows="4" required></textarea>
                </div>

                <button type="submit">Post</button> 
                <?php
        
                require_once "./loginMVC/loginV.inc.php";
                showErrors();   
                Update();
                ?>
            </form>
        </section>

        <section id="posts-container">
           <?php require_once "./DBconn.inc.php";
                 require_once "./blog/blogM.inc.php";
                 getPosts($PDO);?>
        </section>
    </main>
</body>
</html
