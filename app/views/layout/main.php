<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/css/stylesheet.css">
</head>
<body>
<div id="grid-container">

    <header id="header">
        <div class="flex-container">

            <div class="column content-left">
                <div id="burger-button" class="menu-button">
                    <div id="open-sidenav">
                        <a href="#sidebar">
                            <svg viewBox="0 0 100 80" width="30" height="20">
                                <rect width="100" height="20" rx="8"></rect>
                                <rect y="30" width="100" height="20" rx="8"></rect>
                                <rect y="60" width="100" height="20" rx="8"></rect>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="logo">
                    <a href="/">
                        <strong>NETNIX</strong>
                    </a>
                </div>
            </div>
            <nav class="menu-horizontal">
                <ul>
                    <li><a href="/genre">Genres</a></li>
                    <li><a href="/movies">Films</a></li>
                    <li><a href="/search">Zoeken</a></li>
                </ul>
            </nav>

            <div class="content-right">
                <?php if(!isset($_SESSION['user'])) : ?>
                <a href="/login" class="btn btn-primary">Inloggen</a>
                    <?php else : ?>
                    <a href="/profile" class="btn btn-primary"><?php echo $_SESSION['user_name'] ?></a>
                <?php endif; ?>
            </div>

        </div>
    </header>

    <aside id="sidebar">
        <nav class="menu-vertical">
            <a href="#">Home</a>
            <a href="/movies">Films</a>
            <a href="/genre">Genres</a>
            <a href="/search">Uitgebreid zoeken</a>
        </nav>
    </aside>

    <main>
        {{content}}
    </main>

    <footer>
        <div class="flex-container">
            <p>© Footer</p>
        </div>
    </footer>

    <div id="overlay"></div>
</div>
</body>
</html>
