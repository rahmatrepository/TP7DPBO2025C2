<?php
// Tabel Users
function renderUserTable($users) {
    echo '<a href="index.php?page=add_user" class="btn btn-success mb-2">Add User</a>';
    echo '<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr></thead><tbody>';
    foreach ($users as $u) {
        echo '<tr><td>'.$u['id'].'</td><td>'.$u['name'].'</td><td>'.$u['email'].'</td><td>'.$u['phone'].'</td>';
        echo '<td><a href="index.php?page=edit_user&id='.$u['id'].'" class="btn btn-warning btn-sm">Edit</a> ';
        echo '<a href="index.php?page=delete_user&id='.$u['id'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Delete user?\')">Delete</a></td></tr>';
    }
    echo '</tbody></table>';
}
?>
