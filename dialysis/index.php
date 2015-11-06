<?php include_once '../lib/dbconfig.php'; ?>
<?php require_once '../inc/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar"><?php require_once '../inc/sidebar.php'; ?></div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dialisis</h1>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                    <div class="panel-tools pull-right">
                        <a href="add.php" class="btn btn-sm btn-default"> Daftar Pusat Dialisis</a>                            
                    </div>
                </div>
                <div class="panel-body">
                    <table id="example" class="table table-condensed table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pusat</th>
                                <th>Pengurus</th>
                                <th>Alamat</th>
                                <th>Telefon Pejabat</th>
                                <th>Telefon Bimbit</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM dialisis";
                            $dialysis->dataviewDialysis($query);
                            ?>                        
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>
    </div>
</div> <!-- /container-fluid -->
<?php
require_once '../inc/footer.php';
