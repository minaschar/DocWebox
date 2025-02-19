<?php
  include_once(__DIR__ . "/../../../../config.php");
?>

<?php //Just to can understand file as .php ?>

    <link rel="stylesheet" href="<?php echo '/' . ROOT_PATH . '/public/styles/headers/landing-header.css'?>" />
    <link rel="stylesheet" href="<?php echo '/' . ROOT_PATH . '/public/styles/footers/landing-footer.css'?>" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" , initial-scale="1.0" />
    <title>DocWebox - Find your Doctor!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="<?php echo '/' . ROOT_PATH . '/public/src/js/utils/scroll/no-scrolling.js'?>" defer></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?php echo '/' . ROOT_PATH . '/public/resources/favicon/the-icon.ico'?>" />
  </head>
  <body>
    <header>
      <nav class="header-nav">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <a class="header-logo" href="<?php echo '/' . ROOT_PATH . '/index.php'?>"><img src="<?php echo '/' . ROOT_PATH . '/public/resources/logos/logo-main-transparent.png'?>" alt="DocWebox logo" class="nav__logo" id="logo" /></a>
        <ul class="header-ul">
          <li class="header-li">
            <a class="header-a" href="<?php echo '/' . ROOT_PATH . '/index.php'?>">Home</a>
          </li>
          <li class="header-li">
            <a class="header-a" href="<?php echo '/' . ROOT_PATH . '/public/views/faq.php'?>">FAQs</a>
          </li>
          <li class="header-li">
            <a class="header-a" href="<?php echo '/' . ROOT_PATH . '/public/views/sign-up.php'?>">Sign up</a>
          </li>
          <li class="header-li">
            <a class="header-a" href="<?php echo '/' . ROOT_PATH . '/public/views/login.php'?>">Login ▶</a>
          </li>
        </ul>
      </nav>
    </header>