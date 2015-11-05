<?php
/*
 * Table `dialisis` 
 * `dialisis_id`, `nama_pusat`, `nama_pengurus`, `alamat`, `emel`, `tel_pejabat`, `tel_bimbit`, `x_coor`, `y_coor`, `tarikh_wujud`, `tarikh_kemaskini`
 */

class dialysis {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    /*
     * Create New Data
     */

    public function createDialysis($namaPusat, $alamat, $namaPengurus, $emel, $telPejabat, $telBimbit, $xCoor, $yCoor) {
        try {
            $stmt = $this->db->prepare("INSERT INTO dialisis("
                    . "nama_pusat,nama_pengurus,alamat,emel,tel_pejabat,tel_bimbit,x_coor,y_coor,tarikh_wujud,tarikh_kemaskini)"
                    . "VALUES(:namaPusat,:namaPengurus,:alamat, :emel, :telPejabat, :telBimbit, :xCoor, :yCoor, now(), now())");
            $stmt->bindparam(":namaPusat", $namaPusat);
            $stmt->bindparam(":alamat", $alamat);
            $stmt->bindparam(":namaPengurus", $namaPengurus);
            $stmt->bindparam(":emel", $emel);
            $stmt->bindparam(":telPejabat", $telPejabat);
            $stmt->bindparam(":telBimbit", $telBimbit);
            $stmt->bindparam(":xCoor", $xCoor);
            $stmt->bindparam(":yCoor", $yCoor);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getDialysisID($id) {
        $stmt = $this->db->prepare("SELECT * FROM dialisis WHERE dialisis_id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function updateDialysis($id,$namaPusat, $alamat, $namaPengurus, $emel, $telPejabat, $telBimbit, $xCoor, $yCoor) {        
        try {
            $stmt = $this->db->prepare("UPDATE dialisis SET nama_pusat=:namaPusat,nama_pengurus=:namaPengurus,alamat=:alamat,emel=:emel,tel_pejabat=:telPejabat,tel_bimbit=:telBimbit,x_coor=:xCoor,y_coor=:yCoor WHERE dialisis_id=:id ");
            $stmt->bindparam("namaPusat", $namaPusat);
            $stmt->bindparam("alamat", $alamat);
            $stmt->bindparam("namaPengurus", $namaPengurus);
            $stmt->bindparam("emel", $emel);
            $stmt->bindparam("telPejabat", $telPejabat);
            $stmt->bindparam("telBimbit", $telBimbit);
            $stmt->bindparam("xCoor", $xCoor);
            $stmt->bindparam("yCoor", $yCoor);
            $stmt->bindparam("id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteDialysis($id) {
        $stmt = $this->db->prepare("DELETE FROM dialisis WHERE dialisis_id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }

    public function dataviewDialysis($query) {
        $i = 1;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        //nama_pusat,nama_pengurus,alamat,emel,tel_pejabat,tel_bimbit,x_coor,y_coor,tarikh_wujud,tarikh_kemaskini
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($i++); ?></td>
                    <td><?php print($row['nama_pusat']); ?></td>
                    <td><?php print($row['nama_pengurus']); ?></td>
                    <td><?php print($row['alamat']); ?></td>
                    <td><?php print($row['tel_pejabat']); ?></td>
                    <td><?php print($row['tel_bimbit']); ?></td>
                    <td align="center">
                        <a class="btn btn-sm btn-primary" href="view.php?view_id=<?php print($row['dialisis_id']); ?>"><i class="glyphicon glyphicon-search"></i></a>                                            
                        <a class="btn btn-sm btn-primary" href="edit.php?edit_id=<?php print($row['dialisis_id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>                                            
                        <a onclick="if (confirm('Are you sure to delete this data ?')) {
                                                    document.post_<?php print($row['dialisis_id']); ?>.submit();
                                                }
                                                event.returnValue = false;
                                                return false;" class="btn btn-sm btn-primary" href="#" ><i class="glyphicon glyphicon-remove-circle"></i></a>
                        <form method="post" style="display:none;" id="post_<?php print($row['dialisis_id']); ?>" name="post_<?php print($row['dialisis_id']); ?>" action="delete.php">
                            <input type="hidden" value="POST" name="_method">
                            <input type="hidden" name="delete_id" value="<?php print($row['dialisis_id']); ?>">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>            
            <?php
        }
//        else {
//            echo '<tr><td colspan="6">No Data</td></tr>';
//        }
    }

}
