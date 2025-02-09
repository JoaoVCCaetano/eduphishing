<?php 
    include __DIR__ . '/header.php';

    if(isset($_SESSION['message'])) {
        echo "<script>
        Swal.fire({
            title: '{$_SESSION['message']['title']}',
            text: '{$_SESSION['message']['text']}',
            icon: 'success',
            confirmButtonText: 'OK'
            });
        </script>";

        unset($_SESSION['message']);
    } 

?>

<h2>Index</h2>
<div class="table-responsive">

</div>

<?php include __DIR__ . '/footer.php'; ?>