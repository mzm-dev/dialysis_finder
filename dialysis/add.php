<?php
include_once '../lib/dbconfig.php';
if (isset($_POST['btn-save'])) {

    //print_r($_POST);
    // keep track validation errors
    $namaPusat = null;
    $alamat = null;
    $namaPengurus = null;
    $emel = null;
    $telPejabat = null;
    $telBimbit = null;
    $xCoor = null;
    $yCoor = null;

    // keep track post values
    $namaPusat = $_POST['pusat'];
    $alamat = $_POST['alamat'];
    $namaPengurus = $_POST['pengurus'];
    $emel = $_POST['email'];
    $telPejabat = $_POST['pejabat'];
    $telBimbit = $_POST['bimbit'];
    $xCoor = $_POST['lat'];
    $yCoor = $_POST['lng'];


    // validate input
    $valid = true;

    if (empty($namaPusat)) {
        $namaPusatError = 'Nama Pusat Dialisis wajib diisi';
        $valid = false;
    }
    if (empty($alamat)) {
        $alamatError = 'Alamat Pusat Dialisis wajib diisi';
        $valid = false;
    }
    if (empty($namaPengurus)) {
        $namaPengurusError = 'Nama Pengurus Pusat Dialisis wajib diisi';
        $valid = false;
    }
    if (empty($emel)) {
        $emelError = 'Alamat Emel wajib diisi';
        $valid = false;
    } else if (!filter_var($emel, FILTER_VALIDATE_EMAIL)) {
        $emelError = 'Alamat Emel tidak sah';
        $valid = false;
    }
    if (empty($telPejabat)) {
        $telPejabatError = 'No Telefon wajib diisi';
        $valid = false;
    } elseif (!filter_var($string, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^01[1,2,3,4,6,7,8,9]\d{7,8}$/")))) {
        $telPejabatError = 'No Telefon tidak sah';
        $valid = false;
    }
    if (empty($telBimbit)) {
        $telBimbitError = 'No Telefon Bimbit wajib diisi';
        $valid = false;
    } elseif (!filter_var($string, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^0[1,2,3,4,6,7,8,9]\d{7,9}$/")))) {
        $telBimbitError = 'No Telefon Bimbit tidak sah';
        $valid = false;
    }
    if (empty($xCoor)) {
        $xCoorError = 'Koordinat X wajib diisi';
        $valid = false;
    } elseif (!filter_var($string, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[-+]?\d+(\.\d+)?$/")))) {
        $xCoorError = 'Koordinat X tidak sah';
        $valid = false;
    }
    if (empty($yCoor)) {
        $yCoorError = 'Koordinat Y wajib diisi';
        $valid = false;
    } elseif (!filter_var($string, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[-+]?\d+(\.\d+)?$/")))) {
        $yCoorError = 'Koordinat Y tidak sah';
        $valid = false;
    }
    if ($valid) {
        if ($crud->create($namaPusat, $namaPengurus, $emel, $telPejabat, $telBimbit)) {
            //header("Location: add.php?inserted");
            $msg = '<div class="alert alert-success alert-dismissable">' .
                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' .
                    '<strong>WOW!</strong> Record was inserted successfully <a href="index.php">HOME</a>!' .
                    '</div>';
        } else {
            //header("Location: add.php?failure");
            $msg = '<div class="alert alert-warning alert-dismissable">' .
                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' .
                    '<strong>SORRY!</strong> ERROR while updating record !' .
                    '</div>';
        }
    }
}
?>
<?php include_once '../inc/header.php'; ?>
<style>
    .required label::after {
        color: #e32;
        content: "*";
        display: inline;
    }
</style>
<div class="container-fluid">   
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar"><?php require_once '../inc/sidebar.php'; ?></div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Pusat Dialisis</h3>
                    <div class="panel-tools pull-right">
                        <a href="index.php" class="btn btn-sm btn-default"> Back</a>                            
                    </div>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="required form-group <?php echo (!empty($namaPusatError) ? 'has-error' : ''); ?>">
                            <label for="inputPusat">Nama Pusat Dialisis</label>
                            <input name="pusat" id="inputPusat" type="text"
                                   class="form-control"  placeholder="Nama Pusat Dialisis" 
                                   value="<?php echo (!empty($namaPusat) ? $namaPusat : ''); ?>">                        
                            <?php if (!empty($namaPusatError)): ?><span class="help-block"><?php echo $namaPusatError; ?></span><?php endif; ?>
                        </div>
                        <div class="required form-group <?php echo (!empty($namaPengurusError) ? 'has-error' : ''); ?>">
                            <label for="inputPengurus">Nama Pengurus</label>
                            <input name="pengurus" id="inputPengurus" type="text"
                                   class="form-control"  placeholder="Nama Pusat Dialisis" 
                                   value="<?php echo (!empty($namaPengurus) ? $namaPengurus : ''); ?>">                        
                            <?php if (!empty($namaPengurusError)): ?><span class="help-block"><?php echo $namaPengurusError; ?></span><?php endif; ?>
                        </div>
                        <div class="required form-group <?php echo (!empty($emelError) ? 'has-error' : ''); ?>">
                            <label for="inputEmel">Alamat Emel</label>
                            <input name="email" id="inputEmel" type="text"
                                   class="form-control"  placeholder="xam@example.com" 
                                   value="<?php echo (!empty($emel) ? $emel : ''); ?>">                        
                            <?php if (!empty($emelError)): ?><span class="help-block"><?php echo $emelError; ?></span><?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="required form-group <?php echo (!empty($alamatError) ? 'has-error' : ''); ?>">
                                    <label for="inputAlamat">Alamat Emel</label>
                                    <textarea rows="5" name="alamat" id="inputAlamat" type="text"
                                              class="form-control" 
                                              value="<?php echo (!empty($alamat) ? $alamat : ''); ?>"></textarea>
                                    <?php if (!empty($alamatError)): ?><span class="help-block"><?php echo $alamatError; ?></span><?php endif; ?>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="required form-group <?php echo (!empty($telPejabatError) ? 'has-error' : ''); ?>">
                                    <label for="inputPejabat">No Telefon Pejabat</label>
                                    <input name="pejabat" id="inputPejabat" type="text"
                                           class="form-control"  placeholder="0377779977" 
                                           value="<?php echo (!empty($telPejabat) ? $telPejabat : ''); ?>">                        
                                    <?php if (!empty($telPejabatError)): ?><span class="help-block"><?php echo $telPejabatError; ?></span><?php endif; ?>
                                </div>

                                <div class="required form-group <?php echo (!empty($xCoorError) ? 'has-error' : ''); ?>">
                                    <label for="inputKoordinatX">Koordinat X</label>
                                    <input name="lat" id="inputKoordinatX" type="text"
                                           class="form-control"  placeholder="2.935383" 
                                           value="<?php echo (!empty($xCoor) ? $xCoor : ''); ?>">                        
                                    <?php if (!empty($xCoorError)): ?><span class="help-block"><?php echo $xCoorError; ?></span><?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="required form-group <?php echo (!empty($telBimbitError) ? 'has-error' : ''); ?>">
                                    <label for="inputBimbit">No Telefon Bimbit</label>
                                    <input name="bimbit" id="inputBimbit" type="text"
                                           class="form-control"  placeholder="01777779977" 
                                           value="<?php echo (!empty($telPejabat) ? $telPejabat : ''); ?>">                        
                                    <?php if (!empty($telBimbitError)): ?><span class="help-block"><?php echo $telBimbitError; ?></span><?php endif; ?>
                                </div>
                                <div class="required form-group <?php echo (!empty($yCoorError) ? 'has-error' : ''); ?>">
                                    <label for="inputKoordinatY">Koordinat Y</label>
                                    <input name="lng" id="inputKoordinatY" type="text"
                                           class="form-control"  placeholder="101.694343" 
                                           value="<?php echo (!empty($yCoor) ? $yCoor : ''); ?>">                        
                                    <?php if (!empty($yCoorError)): ?><span class="help-block"><?php echo $yCoorError; ?></span><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success"  name="btn-save">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>
</div> <!-- /container-fluid -->

<?php include_once '../inc/footer.php'; ?>