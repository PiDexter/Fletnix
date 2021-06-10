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

            <div class="column content-left" id="header-left">
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

                    <a href="/" class="logo">
                        <strong>FLETNIX</strong>
                    </a>
            </div>
            <nav class="menu-horizontal" aria-label="Sidebar menu">
                <ul>
                    <li><a href="/about">Over Fletnix</a></li>
                    <li><a href="/genre">Genres</a></li>
                    <li><a href="/movies">Films</a></li>
                    <li><a href="/search">Zoeken</a></li>
                </ul>
            </nav>

            <div class="column content-right">
                <?php if(!isset($_SESSION['user'])) : ?>
                <a href="/login" class="btn btn-primary">Inloggen</a>
                    <?php else : ?>
                    <a href="/profile" class="username vertical-center">
                        <div class="username-text">
                            <span class="pre-text">Ingelogd als</span>
                            <span><?php echo $_SESSION['name'] ?></span>
                        </div>
                        <img src="/images/user-icon.svg" width="34" height="34" alt="">
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </header>

    <aside id="sidebar">
        <!--        HEADER NAV          -->
        <div id="sidebar-header">
            <a href="#" class="row vertical-center">
                <div class="column content-right">
                    <img src="/images/close-icon.svg" width="16" height="16" alt="" class="icon">
                </div>
            </a>
        </div>

        <!--       MAIN NAV ITEMS        -->
        <nav class="menu-vertical" aria-label="Site menu">
            <a href="/movies" class="row vertical-center">
                <div class="column content-left vertical-center">
                    <img src="/images/movies-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="menu-label">Films</span>
                </div>
                <div class="column content-right">
                    <img src="/images/right-arrow-icon.svg" width="16" height="16" alt="" class="icon">
                </div>
            </a>

            <a href="/genre" class="row vertical-center">
                <div class="column content-left vertical-center">
                    <img src="/images/list-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="menu-label">Genres</span>
                </div>
                <div class="column content-right">
                    <img src="/images/right-arrow-icon.svg" width="16" height="16" alt="" class="icon">
                </div>
            </a>

            <a href="/search" class="row vertical-center">
                <div class="column content-left vertical-center">
                    <img src="/images/search-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="menu-label">Zoeken</span>
                </div>
                <div class="column content-right">
                    <img src="/images/right-arrow-icon.svg" width="16" height="16" alt="" class="icon">
                </div>
            </a>
        </nav>

        <!--        FOOTER NAV      -->
        <div class="menu-vertical">
            <a href="/about" class="row vertical-center">
                <div class="column content-left vertical-center">
                    <img src="/images/info-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="menu-label">Over Fletnix</span>
                </div>
            </a>

        <?php if(!isset($_SESSION['user'])) : ?>
            <a href="/about" class="row vertical-center">
                <div class="column content-left vertical-center">
                    <img src="/images/sign-up-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="menu-label">Account aanmaken</span>
                </div>
            </a>
        <?php else : ?>
            <a href="/logout" class="row vertical-center">
                <div class="column content-left vertical-center">
                    <img src="/images/logout-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="menu-label">Uitloggen</span>
                </div>
            </a>
        <?php endif; ?>


        </div>
    </aside>

    <main>
        {{content}}
    </main>

    <footer>
        <div class="flex-container">
            <p>© Christiaan Wiggers</p>
        </div>
    </footer>

    <div id="overlay"></div>
</div>
</body>
</html>
