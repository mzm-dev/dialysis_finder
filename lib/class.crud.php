<?php

class crud {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($fname, $lname, $email, $contact) {
        try {
            $stmt = $this->db->prepare("INSERT INTO tbl_users(first_name,last_name,email_id,contact_no) VALUES(:fname, :lname, :email, :contact)");
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":contact", $contact);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id) {
        $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id, $fname, $lname, $email, $contact) {
        try {
            $stmt = $this->db->prepare("UPDATE tbl_users SET first_name=:fname,last_name=:lname,email_id=:email, contact_no=:contact WHERE id=:id ");
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":contact", $contact);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tbl_users WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }

    public function dataview($query) {
        $i = 1;
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($i++); ?></td>
                    <td><?php print($row['first_name']); ?></td>
                    <td><?php print($row['last_name']); ?></td>
                    <td><?php print($row['email_id']); ?></td>
                    <td><?php print($row['contact_no']); ?></td>
                    <td align="center">
                        <a class="btn btn-sm btn-primary" href="view-data.php?view_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-search"></i></a>                                            
                        <a class="btn btn-sm btn-primary" href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>                                            
                        <a onclick="if (confirm('Are you sure to delete this data ?')) { document.post_<?php print($row['id']); ?>.submit(); } event.returnValue = false; return false;" class="btn btn-sm btn-primary" href="#" ><i class="glyphicon glyphicon-remove-circle"></i></a>
                        <form method="post" style="display:none;" id="post_<?php print($row['id']); ?>" name="post_<?php print($row['id']); ?>" action="delete.php">
                            <input type="hidden" value="POST" name="_method">
                            <input type="hidden" name="delete_id" value="<?php print($row['id']); ?>">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>            
            <?php
        } else {
            echo '<tr><td>No Data</td></tr>';
        }
    }

}
