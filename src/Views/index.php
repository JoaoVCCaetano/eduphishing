<?php 
    include __DIR__ . '/header.php';

    if(isset($_SESSION['fecharModal'])) {
        unset($_SESSION['fecharModal']);
        echo "<script>
        window.top.Fancybox.close();
        window.top.location.reload();
        </script>";
        exit;
    }

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

    if(isset($_SESSION['userId'])) {
        $acao =  'form';
    } else {
        $acao = 'login';
    }

?>
<?php include __DIR__ . '/first-section.php'; ?>


<button id="enviarEmail" style=" position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 1;
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;" onclick="abrirModal('<?=$acao?>')">
        ENVIAR EMAIL PHISHING
</button>

<?php include __DIR__ . '/footer.php'; ?>