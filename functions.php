<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "phptodolist");

// Query Data
function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($result) ) {
    $rows[] = $row;
  }
  return $rows;
}


// Add Data
function add($data) {

  global $conn;

  $list = htmlspecialchars($data['list']);

  $query = "INSERT INTO todolist 
              VALUES
            ('', '$list')
  ";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

  if ( isset($_POST['submit']) ) {

    if ( add($_POST) > 0 ) {
    $_SESSION['status'] = "Data Added Successfully";
    $_SESSION['status_code'] = "success";
    header('Location: index.php');
    die();
    } else {
    $_SESSION['status'] = "Error";
    $_SESSION['status_code'] = "error";
    header('Location: index.php');
    die();
    }
  }

// Remove Data
function delete($data){
  global $conn;

  $id = htmlspecialchars($data['id']);

  $query = "DELETE FROM todolist WHERE id = $id";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if ( isset($_POST['delete']) ) {

  if ( delete($_POST) > 0 ) {
  $_SESSION['status'] = "Data Delete Successfully";
  $_SESSION['status_code'] = "success";
  header('Location: index.php');
  die();
  } else {
  $_SESSION['status'] = "Error";
  $_SESSION['status_code'] = "error";
  header('Location: index.php');
  die();
  }
}

// Edit Data
function edit($data){
  global $conn;

  $list = htmlspecialchars($data['list']);
  $id = htmlspecialchars($data['id']);

  $query = "UPDATE todolist SET
              list = '$list'
            WHERE id = $id";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if ( isset($_POST['edit']) ) {

  if ( edit($_POST) > 0 ) {
  $_SESSION['status'] = "Data Edit Successfully";
  $_SESSION['status_code'] = "success";
  header('Location: index.php');
  die();
  } elseif(edit($_POST) < 1 ) {
    header('Location: index.php');
    die();
  } else {
  $_SESSION['status'] = "Error";
  $_SESSION['status_code'] = "error";
  header('Location: index.php');
  die();
  }
}

?>