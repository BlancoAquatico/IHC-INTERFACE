<?php
    $header = file_get_contents("header.html");
    $footer = file_get_contents("footer.html");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabys Unha</title>
    
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
    <?php echo $header; ?>

    <main class="content">
        <div class="container">
            
            <section class="card-agendamento">
                <h2>Realce sua Beleza</h2>
                <p>Agende seu horário de forma rápida e fácil com apenas alguns cliques.</p>
                <a href="agendamento.php" class="btn-agendar">Agendar Agora</a>
            </section>

            <section class="descricao">
                <h3>Como Funciona o Agendamento Online?</h3>
                <p>
                    Nosso sistema de agendamento foi pensado para sua comodidade. Escolha o serviço desejado, 
                    selecione o melhor dia e horário na agenda da nossa profissional e confirme. Você receberá 
                    uma notificação com todos os detalhes. Simples assim!
                </p>
            </section>
            
            <section class="servicos">
                <h3>Nossos Serviços</h3>
                <ul>
                    <li>Manicure Tradicional</li>
                    <li>Pedicure Completa</li>
                    <li>Unha em Gel</li>
                    <li>Spa dos Pés</li>
                    <li>Alongamento em Fibra de Vidro</li>
                    <li>Esmaltação em Gel</li>
                </ul>
            </section>

        </div>
    </main>

    <?php echo $footer; ?>

</body>
</html>