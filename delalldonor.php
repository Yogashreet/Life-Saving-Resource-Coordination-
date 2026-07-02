<?php
require 'db.php';

if (isset($_POST)) {
    if (!empty($_POST['id_ary'])) {
        $id_ary = explode(" ", $_POST['id_ary']);

        foreach ($id_ary as $data) {
            // Check if id is a valid integer
            $data = intval($data);

            // Prepare the select statement
            $query1 = "SELECT uname FROM bloodonor WHERE id = '$data'";
            $result = mysqli_query($con, $query1);

            if ($result) {
                $row = mysqli_fetch_assoc($result);

                if ($row) {
                    $user_name = $row['uname'];

                    // Prepare the delete statements
                    $query2 = "DELETE FROM death WHERE uname = '$user_name'";
                    $query = "DELETE FROM bloodonor WHERE id = '$data'";

                    // Execute the delete statements
                    mysqli_query($con, $query2);
                    mysqli_query($con, $query);
                } else {
                    echo '<div class="alert alert-warning">No user found with id: ' . $data . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Error executing query: ' . mysqli_error($con) . '</div>';
            }
        }
        echo '<div class="alert alert-success">Successfully Deleted.</div><script>window.location.reload();</script>';
    } else {
        echo '<div class="alert alert-warning">Nothing has been selected.</div>';
    }
}
?>
