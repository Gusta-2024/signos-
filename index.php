<?php 
include('layouts/header.php'); 
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    
    <div class="glass-card animar p-5">
        
        <header class="mb-4 text-center">
            <h1 class="fw-bold animar delay-1">Signo Zodiacal</h1>
            <p class="text-white-50 animar delay-1">Descubra o que os astros reservam para você.</p>
        </header>

        <form action="show_zodiac_sign.php" method="POST" class="animar delay-2">
            
            <div class="mb-4 text-start">
                <label for="data_nascimento" class="form-label text-white-50 ms-2">Sua Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" 
                       class="form-control form-control-lg rounded-pill custom-input text-center" 
                       required>
            </div>

            <button type="submit" class="btn btn-light btn-lg w-100 rounded-pill fw-bold hover-glow py-3">
                Descobrir Agora
            </button>
        </form>

    </div>
</div>

</body>
</html>