</head>

<body>
  <nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="#">Google Classroom</a>
    <?php
    if ($_SESSION["authenticated"] == "1") {
    ?>
      <ul class="nav navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-sign-out-alt" onclick="logout();"></i>
          </a>
        </li>
      </ul>
    <?php } ?>
  </nav>