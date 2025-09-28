<?php
    // Carrega o conteúdo do header e do footer
    $header = file_get_contents("header.html");
    $footer = file_get_contents("footer.html");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas Frequentes - Fabys Unhas</title>
    
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php echo $header; ?>

    <main class="content">
        <div class="container">

            <div class="page-title">
                <h1>Perguntas Frequentes</h1>
                <p>Tire suas dúvidas mais comuns sobre nossos serviços e procedimentos.</p>
            </div>

            <div class="faq-container">

                <div class="faq-item">
                    <h3 class="faq-question">Preciso agendar com antecedência?</h3>
                    <p class="faq-answer">
                        <strong>R:</strong> Sim, recomendamos fortemente o agendamento prévio para garantir que tenhamos um horário disponível para você. Você pode usar nosso sistema de agendamento online ou entrar em contato pelo WhatsApp.
                    </p>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">Quanto tempo dura o procedimento de alongamento em gel?</h3>
                    <p class="faq-answer">
                        <strong>R:</strong> O procedimento de aplicação inicial do alongamento em gel leva, em média, de 2 a 3 horas, dependendo da complexidade e do estado das unhas naturais.
                    </p>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">Qual a durabilidade do esmalte em gel?</h3>
                    <p class="faq-answer">
                        <strong>R:</strong> O esmalte em gel é conhecido por sua alta durabilidade. Ele pode durar de 15 a 21 dias sem lascar e com o mesmo brilho do primeiro dia, dependendo dos cuidados diários.
                    </p>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">Quais formas de pagamento vocês aceitam?</h3>
                    <p class="faq-answer">
                        <strong>R:</strong> Aceitamos diversas formas de pagamento para sua conveniência, incluindo Pix, cartões de débito e crédito (principais bandeiras) e dinheiro.
                    </p>
                </div>

                <div class="faq-item">
                    <h3 class="faq-question">O alongamento de unhas danifica minhas unhas naturais?</h3>
                    <p class="faq-answer">
                        <strong>R:</strong> Quando realizado por uma profissional qualificada e com a manutenção correta, o alongamento não danifica as unhas naturais. Utilizamos produtos de alta qualidade e técnicas seguras para garantir a saúde das suas unhas.
                    </p>
                </div>

            </div>

        </div>
    </main>

    <?php echo $footer; ?>

</body>
</html>