<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Sample Page</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Sample Content
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
      <div class="col-md-6 mt-3 bg-info p-4 rounded">
        <h2 class="bg-light p-2 rounded text-center text-dark">ID : <?= $vid; ?></h2>
        <div class="text-center">
          <img src="<?= $vphoto; ?>" width="300" class="img-thumbnail">
        </div>
        <h4 class="text-light">Name : <?= $vname; ?></h4>
        <h4 class="text-light">Email : <?= $vemail; ?></h4>
        <h4 class="text-light">Phone : <?= $vphone; ?></h4>
      </div>
    </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>