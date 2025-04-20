<?php
// Tabel Fields
function renderFieldTable($fields) {
    echo '<a href="index.php?page=add_field" class="btn btn-success mb-2">Add Field</a>';
    echo '<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Name</th><th>Type</th><th>Location</th><th>Action</th></tr></thead><tbody>';
    foreach ($fields as $f) {
        echo '<tr><td>'.$f['id'].'</td><td>'.$f['name'].'</td><td>'.$f['type'].'</td><td>'.$f['location'].'</td>';
        echo '<td><a href="index.php?page=edit_field&id='.$f['id'].'" class="btn btn-warning btn-sm">Edit</a> ';
        echo '<a href="index.php?page=delete_field&id='.$f['id'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Delete field?\')">Delete</a></td></tr>';
    }
    echo '</tbody></table>';
}
?>
