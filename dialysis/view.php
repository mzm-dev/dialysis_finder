<?php
include_once '../lib/dbconfig.php';

if (isset($_GET['view_id'])) {
    $id = $_GET['view_id'];
    extract($dialysis->getDialysisID($id));
}
?>
<?php include_once '../inc/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar"><?php require_once '../inc/sidebar.php'; ?></div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>   
                    <div class="panel-tools pull-right">
                        <?php echo '<a class="btn btn-sm btn-default" href="index.php">Back</a>' ?> 
                        <?php echo '<a class="btn btn-sm btn-success" href="edit.php?edit_id=' . $dialisis_id . '">Update</a>' ?> 
                    </div>
                </div>
                <div class="panel-body">
                    <table cellspacing="0" cellpadding="0" class="table table-bordered table-striped table-profile">
                        <tbody>                                                                                                                                    
                            <tr>
                                <th>Nama Pusat</th>
                                <td><?php echo $nama_pusat; ?></td>                    
                            </tr>
                            <tr>
                                <th>Pengurus</th>
                                <td><?php echo $nama_pengurus; ?></td>

                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?php echo $alamat; ?></td>
                            </tr>                                                                                    
                            <tr>
                                <th>Telefon Pejabat</th>
                                <td><?php echo $tel_pejabat; ?></td>
                            </tr>                                                                                                            
                            <tr>
                                <th>Telefon Bimbit</th>
                                <td><?php echo $tel_bimbit; ?></td>
                            </tr>                                                                                                            
                            <tr>
                                <th>Tarikh Daftar</th>
                                <td><?php echo date('d-m-Y',  strtotime($tarikh_wujud)); ?></td>
                            </tr>                                                                                                            
                            <tr>
                                <th>Koordinate</th>
                                <td><?php echo $x_coor.", ".$y_coor; ?></td>
                            </tr>                                                                                                            
                        </tbody>
                    </table>
                </div>
            </div>              
        </div>
    </div>
</div> <!-- /container-fluid -->

<?php include_once '../inc/footer.php'; ?>