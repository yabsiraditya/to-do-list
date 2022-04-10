<?php
require 'functions.php';

$todolist  = query("SELECT * FROM todolist ORDER BY ID DESC");

// Tombol Submit Sudah di tekan apa belum 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List App</title>
  <link rel="stylesheet" href="dist/output.css">
  <link rel="stylesheet" href="dist/sweetalert2.css">

</head>
<body>

  
  <!-- Form Start -->
<section class="pt-36">
  <div class="container"> 
    <div class="w-full mb-9 lg:w-2/4 lg:mx-auto">
    <div class="rounded-lg shadow-md bg-slate-100">
    <div class="w-full px-5 py-9">
      <h1 class="font-bold text-2xl">What's Up</h1>
      <p class="text-lg font-semibold mb-9">let's Do Your Tasks!</p>
      <form action="" method="post">
      <input type="text" name="list" placeholder="Add A New To-Do" class="w-full p-2 mb-7 border border-primary focus:outline-none rounded-lg bg-slate-100" required >
      <button type="submit" name="submit" class="w-full p-3 rounded-lg font-semibold text-white bg-primary hover:shadow-md hover:opacity-80">Save Taks</button>
      </form>
    </div>
    </div>
    <p class="mt-9 px-5 text-lg font-semibold">Task List</p>
    </div>
  </div>
</section>
<!-- Form End -->


<?php foreach( $todolist as $row ) : ?>

<!-- Start Modal Box Edit-->
<div id="editModal" class="hidden">
<form action="" method="post">
  <div tabindex="-1" aria-hidden="true" class="modal_body flex h-screen items-center justify-center bg-black bg-opacity-80 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex justify-between items-start p-5 rounded-t border-b">
                  <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl">Update</h3>
                  <button type="button" class="closeModal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="popup-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-1">
                <input type="hidden" name="id" id="id" value="<?php echo $row["id"]; ?>">
                <input type="text" class="w-full p-2 mb-7 border bg-white border-primary focus:outline-none rounded-lg" name="list" id="list">
              </div>
              <!-- Modal footer -->
              <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200">
                  <button type="submit" name="edit" class="text-white bg-primary hover:shadow-md hover:opacity-80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">I accept</button>
                  <button type="button" class="closeModal text-black bg-slate-200 hover:shadow-md hover:opacity-80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Decline</button>
              </div>
          </div>
      </div>
</div>
</form>
</div>
<!-- End Modal Box Edit -->

<!-- Start Modal Box Remove-->
<div id="deletModal" class="hidden">
<form action="" method="post">
  <div tabindex="-1" aria-hidden="true" class="modal_body flex h-screen items-center justify-center bg-black bg-opacity-80 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-md h-full md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex justify-between items-start p-5 rounded-t border-b">
                  <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl">Delete</h3>
                  <button type="button" class="closeModal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="popup-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-1">
                <input type="hidden" name="id" id="id" value="<?php echo $row["id"]; ?>">
                <p class="w-full p-2 text-center text-lg" name="list" id="list">Are you sure you want to delete this?</p>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200">
                  <button type="submit" name="delete" class="text-white bg-red-500 hover:shadow-md hover:opacity-80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Yes, I'm sure</button>
                  <button type="button" class="closeModal text-black bg-slate-200 hover:shadow-md hover:opacity-80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">No, Cancel</button>
              </div>
          </div>
      </div>
</div>
</form>
</div>
<!-- End Modal Box Remove-->

<!-- Tasks List Start -->
<section>
<div class="container">
    <div class="w-full mb-9 lg:w-2/4 lg:mx-auto">
    <div class="rounded-lg shadow-md bg-slate-100">
      <div class="flex flex-warp">
        <div class="w-4/5 px-5 py-9">
          <p class="text-md break-words"><?php echo $row["list"]; ?></p>
        </div>
        <div class="flex ml-5 items-center">
          <button class="mr-7 openEditModal" data-id="<?php echo $row["id"]; ?>" data-list="<?php echo $row["list"]; ?>">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-500 hover:opacity-80" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
          </svg>
          </button>
          <button class="openDeletModal" data-id="<?php echo $row["id"]; ?>" data-list="<?php echo $row["list"]; ?>">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-red-500 hover:opacity-80" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
          </svg>
          </button>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>
<!-- Tasks List End -->

<?php endforeach; ?>

<script src="dist/sweatalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php 
  if(isset($_SESSION['status']) && $_SESSION['status'] != '') {
?>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: "<?php echo $_SESSION['status_code'] ?>",
      title: "<?php echo $_SESSION['status'] ?>"
    })
  </script>
<?php 
  unset($_SESSION['status']);
}
?>

<script>
        $(document).ready(function () {
            $('.openEditModal').on('click', function(e){
              let id = $(this).data('id');
              let list = $(this).data('list');

              $(".modal_body #id").val(id);
              $(".modal_body #list").val(list);

                $('#editModal').removeClass('hidden');
            });
            $('.closeModal').on('click', function(e){
                $('#editModal').addClass('hidden');
            });
        });
</script>
<script>
        $(document).ready(function () {
            $('.openDeletModal').on('click', function(e){
              let id = $(this).data('id');
              let list = $(this).data('list');

              $(".modal_body #id").val(id);
              $(".modal_body #list").val(list);

                $('#deletModal').removeClass('hidden');
            });
            $('.closeModal').on('click', function(e){
                $('#deletModal').addClass('hidden');
            });
        });
</script>
</body>
</html>