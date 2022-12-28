<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,600;1,600&family=Fraunces:opsz,wght@9..144,700;9..144,900&family=Public+Sans:wght@300;400;700&family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/fontawesome-free-6.2.0-desktop/svg/">
    <script defer src="./css/fontawesome-free-6.2.0-web/fontawesome-free-6.2.0-web/js/all.min.js"></script>
    <link rel="stylesheet" href="./css/fontawesome-free-6.2.0-web/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="./css/sass/vendors/open-props/open-props.min.css">
    <link rel="stylesheet" href="./css/sass/vendors/bootstrap-5.2.3-dist/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/script.js" defer></script>
</head>
<!-- have to tranfer this to the corresponding css file -->
<style>
    body {
        background-color: rgb(225, 225, 225);
    }

    .user-image {
        object-fit: cover;
        aspect-ratio: 10/ 10;
        inset-block: 0;
    }

    .comment-img-wrapper {
        display: flex;
        position: relative;
        width: 35px;
    }

    .comment-input {
        border: none;
    }

    .like-btn {
        font-size: 1.35rem;
        transition: all .2s ease-in-out;
    }

    .like-btn:hover {
        transform: scale(1.2);
    }

    .user-image-comment {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 2px solid transparent;
    }

    .user-image-comment>img,
    .comment-img-wrapper>img {
        width: 100%;
    }

    .comment-img-wrapper>img:nth-child(2) {
        position: absolute;
        left: 200px;
        width: 100%;
        height: 100%;
        border: 5px solid white;
    }

    .comment-img-wrapper>div:nth-child(2) {
        border-radius: 50%;
        position: absolute;
        left: 10px;
        width: 100%;
        height: 100%;
        border: 2px solid white;
    }

    .comment-img {
        border-radius: 50%;
    }

    .comment-like {
        transition: all .2s ease-in;
    }

    .comment-like:hover {
        transform: scale(1.2);
    }

    .edit-dots {
        display: flex;
        flex-direction: column;
        gap: 2px;
        cursor: pointer;
    }

    .edit-dots span {
        display: block;
        background-color: black;
        width: 4px;
        height: 4px;
        border-radius: 50%;
    }

    .article-options {
        position: relative;
        border-color: aqua;
    }

    .article-option-list {
        position: absolute;
        display: none;
        right: 8px;
        z-index: 9999999;
        width: 100px;
    }
</style>

<body>
    <?php require_once "includes/init.php";
