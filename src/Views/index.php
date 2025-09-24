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
<?php include __DIR__ . '/first-section.php'; ?>
<?php include __DIR__ . '/orange-section.php'; ?>
<?php include __DIR__ . '/how-to-prevent.php'; ?>
<?php include __DIR__ . '/how-to-protect.php'; ?>


<button id="enviarEmail" style=" position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 1;
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;" onclick="abrirModal('login')">
        ENVIAR EMAIL PHISHING
</button>

<?php include __DIR__ . '/footer.php'; ?>