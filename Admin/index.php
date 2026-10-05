<?php

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$totalPosts = 0;
$publishedPosts = 0;
$draftPosts = 0;

$result = $conn->query("
    SELECT COUNT(*) AS total
    FROM posts
");

if ($result) {
    $totalPosts =
        (int)$result->fetch_assoc()['total'];
}

$result = $conn->query("
    SELECT COUNT(*) AS total
    FROM posts
    WHERE status = 'published'
");

if ($result) {
    $publishedPosts =
        (int)$result->fetch_assoc()['total'];
}

$result = $conn->query("
    SELECT COUNT(*) AS total
    FROM posts
    WHERE status = 'draft'
");

if ($result) {
    $draftPosts =
        (int)$result->fetch_assoc()['total'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Admin Dashboard
    </title>

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

</head>

<body class="admin-page">


<header class="admin-header">

    <div class="admin-header-inner">

        <div class="admin-brand">

            <img
                src="../assets/images/city-abe-logo.png"
                alt="ABE Office"
            >

            <div>

                <strong>
                    ABE OFFICE
                </strong>

                <span>
                    Administration
                </span>

            </div>

        </div>


        <div class="admin-user">

            <span>
                Welcome,
                <?php
                echo e(
                    $_SESSION['admin_name']
                    ?? 'Administrator'
                );
                ?>
            </span>

            <a href="logout.php">
                Logout
            </a>

        </div>

    </div>

</header>


<div class="admin-container">

    <div class="admin-title">

        <div>

            <h1>
                Dashboard
            </h1>

            <p>
                Manage public announcements and
                website content.
            </p>

        </div>

        <a
            href="post_add.php"
            class="admin-button"
        >
            + Add New Update
        </a>

    </div>


    <div class="stats-grid">

        <div class="stat-card">

            <span>
                Total Updates
            </span>

            <strong>
                <?php echo $totalPosts; ?>
            </strong>

        </div>


        <div class="stat-card">

            <span>
                Published
            </span>

            <strong>
                <?php echo $publishedPosts; ?>
            </strong>

        </div>


        <div class="stat-card">

            <span>
                Drafts
            </span>

            <strong>
                <?php echo $draftPosts; ?>
            </strong>

        </div>

    </div>


    <div class="admin-menu">

        <a href="posts.php">

            <strong>
                Manage Updates
            </strong>

            <span>
                Add, edit and delete public
                announcements.
            </span>

        </a>


        <a href="../index.php">

            <strong>
                View Website
            </strong>

            <span>
                Open the public department website.
            </span>

        </a>

    </div>

</div>

</body>
</html>