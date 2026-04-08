<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <?php
    [cite_start]// 1. Recebe a data de nascimento do formulário [cite: 79, 80]
    $data_nascimento = $_POST['data_nascimento'];

    [cite_start]// 2. Carrega o arquivo XML [cite: 83, 84]
    $signos = simplexml_load_file("signos.xml");

    // 3. Converte a data de nascimento para um objeto DateTime para facilitar a extração do dia/mês
    $data_busca = new DateTime($data_nascimento);
    
    // Criamos uma variável para armazenar o signo encontrado
    $signo_encontrado = null;

    [cite_start]// 4. Itera sobre os signos do XML [cite: 85, 86]
    foreach ($signos->signo as $signo) {
        // Converte as datas do XML em objetos que podemos comparar [cite: 87, 88]
        // Usamos o ano da data de nascimento para garantir que a comparação ocorra no mesmo período
        $data_inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
        $data_fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);

        // Ajusta o ano para o mesmo da data de nascimento para comparação justa
        $data_inicio->setDate($data_busca->format('Y'), $data_inicio->format('m'), $data_inicio->format('d'));
        $data_fim->setDate($data_busca->format('Y'), $data_fim->format('m'), $data_fim->format('d'));

        // Caso especial: Capricórnio (que cruza a virada do ano)
        if ($data_inicio > $data_fim) {
            if ($data_busca >= $data_inicio || $data_busca <= $data_fim) {
                $signo_encontrado = $signo;
                break;
            }
        } else {
            // Verificação padrão: se a data está entre o início e o fim [cite: 87, 89]
            if ($data_busca >= $data_inicio && $data_busca <= $data_fim) {
                $signo_encontrado = $signo;
                break;
            }
        }
    }

    // 5. Exibe o resultado na tela [cite: 17, 34]
    if ($signo_encontrado): ?>
        <div class="card shadow border-0">
            <div class="card-body text-center p-5 bg-dark text-white rounded">
                <h1 class="display-4 mb-4"><?= $signo_encontrado->signoNome ?></h1>
                <p class="lead italic mb-4">"<?= $signo_encontrado->descricao ?>."</p>
                <a href="index.php" class="btn btn-outline-light mt-3">Voltar</a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            Não foi possível identificar seu signo. Verifique os dados e tente novamente.
            <br><a href="index.php" class="btn btn-danger mt-2">Voltar</a>
        </div>
    <?php endif; ?>
</div>

</body> </html>