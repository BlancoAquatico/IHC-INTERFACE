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
    <title>Contato - Fabys Unhas</title>
    
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php echo $header; ?>

    <main class="content">
        <div class="container">

            <div class="page-title">
                <h1>Entre em Contato</h1>
                <p>Estamos ansiosas para atender você! Utilize um dos canais abaixo para falar conosco.</p>
            </div>

            <div class="contact-wrapper">
                
                <div class="contact-info">
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div class="info-text">
                            <h3>Nosso Endereço</h3>
                            <p>Rua Exemplo, 123 - Bairro Modelo, São Paulo - SP</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div class="info-text">
                            <h3>Telefone / WhatsApp</h3>
                            <a href="tel:+5511999999999" class="contact-link">(11) 99999-9999</a>
                        </div>
                    </div>

                    <div class="contact-social">
                        <h3>Siga Nossas Redes</h3>
                        <div class="social-links">
                            <a href="https://www.instagram.com/seu-usuario" target="_blank">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Ícone do Instagram">
                            </a>
                            <a href="https://www.facebook.com/sua-pagina" target="_blank">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Ícone do Facebook">
                            </a>
                            <a href="https://wa.me/5511999999999" target="_blank">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="Ícone do WhatsApp">
                            </a>
                        </div>
                    </div>

                </div>

                <div class="contact-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.197512999411!2d-46.65657118502213!3d-23.56133998468246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59c8da0aa315%3A0x206d0585a507d9f7!2sAv.%20Paulista%2C%20S%C3%A3o%20Paulo%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1664323456789!5m2!1spt-BR!2sbr" 
                        width="600" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>

        </div>
    </main>

    <?php echo $footer; ?>

</body>
</html>