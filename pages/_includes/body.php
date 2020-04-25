</head>

<body>
  <nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="#">Google Classroom</a>
    <?php
    if ($_SESSION["authenticated"] == "1") {
    ?>
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#modelId">
            <i class="fas fa-plus"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-sign-out-alt" onclick="logout();"></i>
          </a>
        </li>
      </ul>
      <!-- Button trigger modal -->

      <!-- Modal -->
      <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Classroomer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


              <!-- Accordian -->
              <div class="accordion" id="accordionExample">

                <!-- CREATE CLASSROOM -->

                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Create Classroom
                      </button>
                    </h2>
                  </div>

                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <!--Create classroom form  -->
                      <form>
                        <div class="form-group">
                          <label for="classroom_name">Classroom Name</label>
                          <input type="text" class="form-control form-control-md" name="" id="classroom_name" aria-describedby="helpId" placeholder="Give a name to your classroom eg. Science">

                        </div>

                        <div class="form-group">
                          <label for="classroom_name">Classroom Description</label>
                          <input type="text" class="form-control form-control-md" name="" id="classroom_desc" aria-describedby="helpId" placeholder="Give a name to your classroom eg. Science">

                        </div>

                        <button class="btn btn-primary" type="button" onclick="createClassroom();">Create</button>

                      </form>
                    </div>
                  </div>
                </div>

                <!-- JOIN CLASSROOM -->

                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Join Classroom
                      </button>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                      <!-- Join classroom form -->
                      <form>
                        <div class="form-group">
                          <label for="">Enter Classroom Id</label>
                          <input type="text" class="form-control form-control-md" name="" id="classroom_id" aria-describedby="helpId" placeholder="">
                        </div>
                        <button class="btn btn-primary" type="button" onclick="joinClassroom();">Join</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </nav>