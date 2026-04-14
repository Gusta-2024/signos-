<?php include('layouts/header.php'); 

$data_nascimento = $_POST['data_nascimento'] ?? null;

if (!$data_nascimento) {
    header("Location: index.php");
    exit;
}

$signos = simplexml_load_file("signos.xml");
$data_usuario = date("m-d", strtotime($data_nascimento));
$signo_encontrado = null;

foreach ($signos->signo as $signo) {
    $inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio)->format('m-d');
    $fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim)->format('m-d');

    if ($inicio > $fim) {
        if ($data_usuario >= $inicio || $data_usuario <= $fim) {
            $signo_encontrado = $signo;
            break;
        }
    } else {
        if ($data_usuario >= $inicio && $data_usuario <= $fim) {
            $signo_encontrado = $signo;
            break;
        }
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh; margin-top: 20px;">
    
    <div class="glass-card animar p-5">
        
        <?php if ($signo_encontrado): ?>
            
            <h1 class="display-4 fw-bold animar delay-nome mb-4 text-white">
                <?= htmlspecialchars($signo_encontrado->signoNome) ?>
            </h1>

            <div class="mb-4 animar delay-img">
                <img src="assets/img/<?= trim((string)$signo_encontrado->imagem) ?>" 
                     class="img-fluid rounded-circle shadow-lg" 
                     alt="Signo"
                     style="width: 200px; height: 200px; object-fit: cover; border: 3px solid rgba(255,255,255,0.2);">
            </div>

            <div class="animar delay-desc">
                <p class="fs-5 fw-light text-light mb-5">
                    "<?= htmlspecialchars($signo_encontrado->descricao) ?>"
                </p>
                
                <a href="index.php" class="btn btn-outline-light btn-lg rounded-pill px-5 hover-glow">
                    Voltar ao Início
                </a>
            </div>

        <?php else: ?>
            <div class="animar">
                <h2 class="text-warning">Não foi possível ler os astros.</h2>
                <a href="index.php" class="btn btn-primary mt-3">Tentar Novamente</a>
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html>