<?php
require_once 'class/User.php';
require_once 'class/Field.php';
require_once 'class/Booking.php';
include 'view/header.php';
include 'view/navbar.php';
include 'view/alert.php';

$userObj = new User();
$fieldObj = new Field();
$bookingObj = new Booking();
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Routing utama
echo '<div class="container mb-5">';
switch ($page) {
    case 'users':
        $users = $userObj->getAll();
        include 'view/user_table.php';
        renderUserTable($users);
        break;
    case 'fields':
        $fields = $fieldObj->getAll();
        include 'view/field_table.php';
        renderFieldTable($fields);
        break;
    case 'bookings':
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $bookings = $bookingObj->getAll($search);
        include 'view/booking_table.php';
        renderBookingTable($bookings, $search);
        break;
    // Form tambah/edit user
    case 'add_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userObj->create($_POST['name'], $_POST['email'], $_POST['phone']);
            header('Location: index.php?page=users&msg=User berhasil ditambah'); exit;
        }
        echo '<h3>Add User</h3><form method="post"><div class="mb-2"><input name="name" class="form-control" placeholder="Name" required></div><div class="mb-2"><input name="email" class="form-control" placeholder="Email" required></div><div class="mb-2"><input name="phone" class="form-control" placeholder="Phone" required></div><button class="btn btn-success">Save</button></form>';
        break;
    case 'edit_user':
        $u = $userObj->getById($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userObj->update($_GET['id'], $_POST['name'], $_POST['email'], $_POST['phone']);
            header('Location: index.php?page=users&msg=User berhasil diupdate'); exit;
        }
        echo '<h3>Edit User</h3><form method="post"><div class="mb-2"><input name="name" class="form-control" value="'.htmlspecialchars($u['name']).'" required></div><div class="mb-2"><input name="email" class="form-control" value="'.htmlspecialchars($u['email']).'" required></div><div class="mb-2"><input name="phone" class="form-control" value="'.htmlspecialchars($u['phone']).'" required></div><button class="btn btn-success">Update</button></form>';
        break;
    case 'delete_user':
        $userObj->delete($_GET['id']);
        header('Location: index.php?page=users&msg=User berhasil dihapus'); exit;
    // Form tambah/edit field
    case 'add_field':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fieldObj->create($_POST['name'], $_POST['type'], $_POST['location']);
            header('Location: index.php?page=fields&msg=Field berhasil ditambah'); exit;
        }
        echo '<h3>Add Field</h3><form method="post"><div class="mb-2"><input name="name" class="form-control" placeholder="Name" required></div><div class="mb-2"><input name="type" class="form-control" placeholder="Type" required></div><div class="mb-2"><input name="location" class="form-control" placeholder="Location" required></div><button class="btn btn-success">Save</button></form>';
        break;
    case 'edit_field':
        $f = $fieldObj->getById($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fieldObj->update($_GET['id'], $_POST['name'], $_POST['type'], $_POST['location']);
            header('Location: index.php?page=fields&msg=Field berhasil diupdate'); exit;
        }
        echo '<h3>Edit Field</h3><form method="post"><div class="mb-2"><input name="name" class="form-control" value="'.htmlspecialchars($f['name']).'" required></div><div class="mb-2"><input name="type" class="form-control" value="'.htmlspecialchars($f['type']).'" required></div><div class="mb-2"><input name="location" class="form-control" value="'.htmlspecialchars($f['location']).'" required></div><button class="btn btn-success">Update</button></form>';
        break;
    case 'delete_field':
        $fieldObj->delete($_GET['id']);
        header('Location: index.php?page=fields&msg=Field berhasil dihapus'); exit;
    // Form tambah/edit booking
    case 'add_booking':
        $users = $userObj->getAll();
        $fields = $fieldObj->getAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingObj->create($_POST['user_id'], $_POST['field_id'], $_POST['booking_date'], $_POST['time_slot'], $_POST['status']);
            header('Location: index.php?page=bookings&msg=Booking berhasil ditambah'); exit;
        }
        echo '<h3>Add Booking</h3><form method="post">';
        echo '<div class="mb-2"><select name="user_id" class="form-control" required><option value="">Pilih User</option>';
        foreach ($users as $u) echo '<option value="'.$u['id'].'">'.$u['name'].'</option>';
        echo '</select></div>';
        echo '<div class="mb-2"><select name="field_id" class="form-control" required><option value="">Pilih Field</option>';
        foreach ($fields as $f) echo '<option value="'.$f['id'].'">'.$f['name'].'</option>';
        echo '</select></div>';
        echo '<div class="mb-2"><input type="date" name="booking_date" class="form-control" required></div>';
        echo '<div class="mb-2"><input name="time_slot" class="form-control" placeholder="08:00-10:00" required></div>';
        echo '<div class="mb-2"><select name="status" class="form-control"><option>Booked</option><option>Done</option></select></div>';
        echo '<button class="btn btn-success">Save</button></form>';
        break;
    case 'edit_booking':
        $users = $userObj->getAll();
        $fields = $fieldObj->getAll();
        $b = $bookingObj->getById($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingObj->update($_GET['id'], $_POST['user_id'], $_POST['field_id'], $_POST['booking_date'], $_POST['time_slot'], $_POST['status']);
            header('Location: index.php?page=bookings&msg=Booking berhasil diupdate'); exit;
        }
        echo '<h3>Edit Booking</h3><form method="post">';
        echo '<div class="mb-2"><select name="user_id" class="form-control" required>';
        foreach ($users as $u) echo '<option value="'.$u['id'].'"'.($u['id']==$b['user_id']?' selected':'').'>'.$u['name'].'</option>';
        echo '</select></div>';
        echo '<div class="mb-2"><select name="field_id" class="form-control" required>';
        foreach ($fields as $f) echo '<option value="'.$f['id'].'"'.($f['id']==$b['field_id']?' selected':'').'>'.$f['name'].'</option>';
        echo '</select></div>';
        echo '<div class="mb-2"><input type="date" name="booking_date" class="form-control" value="'.htmlspecialchars($b['booking_date']).'" required></div>';
        echo '<div class="mb-2"><input name="time_slot" class="form-control" value="'.htmlspecialchars($b['time_slot']).'" required></div>';
        echo '<div class="mb-2"><select name="status" class="form-control">';
        foreach (["Booked","Done"] as $s) echo '<option'.($b['status']==$s?' selected':'').'>'.$s.'</option>';
        echo '</select></div>';
        echo '<button class="btn btn-success">Update</button></form>';
        break;
    case 'delete_booking':
        $bookingObj->delete($_GET['id']);
        header('Location: index.php?page=bookings&msg=Booking berhasil dihapus'); exit;
    default:
        echo '<div class="jumbotron"><h1 class="display-5">Sistem Booking Lapangan Olahraga</h1><p class="lead">Kelola data user, lapangan, dan booking secara mudah dan terstruktur.</p></div>';
}
echo '</div>';
include 'view/footer.php';
?>
