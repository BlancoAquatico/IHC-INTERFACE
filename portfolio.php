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
    <title>Portfólio - Fabys Unhas</title>
    
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php echo $header; ?>

    <main class="content">
        <div class="container">

            <div class="page-title">
                <h1>Nosso Trabalho e Dedicação</h1>
                <p>Conheça um pouco mais sobre os serviços que transformam e a paixão que nos move.</p>
            </div>

            <section class="portfolio-item">
                <div class="portfolio-image">
                    <div class="carousel-container">
                        <input type="radio" id="c1-img1" name="carousel1" checked>
                        <input type="radio" id="c1-img2" name="carousel1">
                        <input type="radio" id="c1-img3" name="carousel1">

                        <div class="carousel-track">
                            <img src="Screenshot_5.png" alt="Exemplo 1 de Unha em Gel">
                            <img src="https://via.placeholder.com/500x500.png?text=Unha+em+Gel+2" alt="Exemplo 2 de Unha em Gel">
                            <img src="https://via.placeholder.com/500x500.png?text=Unha+em+Gel+3" alt="Exemplo 3 de Unha em Gel">
                        </div>
                        
                        <div class="carousel-arrows">
                            <div class="arrows-for-slide1">
                                <label for="c1-img2" class="arrow next">›</label>
                            </div>
                            <div class="arrows-for-slide2">
                                <label for="c1-img1" class="arrow prev">‹</label>
                                <label for="c1-img3" class="arrow next">›</label>
                            </div>
                             <div class="arrows-for-slide3">
                                <label for="c1-img2" class="arrow prev">‹</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-text">
                    <h2>Unhas em Gel</h2>
                    <p>
                        A solução perfeita para quem busca unhas impecáveis por semanas. Utilizando técnicas avançadas, criamos unhas em gel com aspecto natural, alta durabilidade e um brilho que não se apaga. Ideal para o dia a dia corrido da mulher moderna.
                    </p>
                </div>
            </section>

            <section class="portfolio-item reverse">
                <div class="portfolio-image">
                    <div class="carousel-container">
                        <input type="radio" id="c2-img1" name="carousel2" checked>
                        <input type="radio" id="c2-img2" name="carousel2">
                        <input type="radio" id="c2-img3" name="carousel2">

                        <div class="carousel-track">
                            <img src="Screenshot_5.png" alt="Exemplo 1 de Alongamento em Fibra de Vidro">
                            <img src="https://via.placeholder.com/500x500.png?text=Fibra+de+Vidro+2" alt="Exemplo 2 de Alongamento em Fibra de Vidro">
                            <img src="https://via.placeholder.com/500x500.png?text=Fibra+de+Vidro+3" alt="Exemplo 3 de Alongamento em Fibra de Vidro">
                        </div>
                        
                         <div class="carousel-arrows">
                            <div class="arrows-for-slide1">
                                <label for="c2-img2" class="arrow next">›</label>
                            </div>
                            <div class="arrows-for-slide2">
                                <label for="c2-img1" class="arrow prev">‹</label>
                                <label for="c2-img3" class="arrow next">›</label>
                            </div>
                             <div class="arrows-for-slide3">
                                <label for="c2-img2" class="arrow prev">‹</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-text">
                    <h2>Alongamento em Fibra de Vidro</h2>
                    <p>
                        Para quem sonha com unhas longas e resistentes, o alongamento em fibra de vidro é a técnica ideal. Os fios de fibra se moldam perfeitamente à unha natural, criando uma estrutura fina, leve e extremamente durável. O resultado é um alongamento de aparência natural e elegante.
                    </p>
                </div>
            </section>

             <section class="portfolio-item">
                <div class="portfolio-image">
                    <div class="carousel-container">
                        <input type="radio" id="c3-img1" name="carousel3" checked>
                        <input type="radio" id="c3-img2" name="carousel3">
                        <input type="radio" id="c3-img3" name="carousel3">

                        <div class="carousel-track">
                             <img src="https://via.placeholder.com/500x500.png?text=Spa+dos+Pés+1" alt="Imagem 1 de um tratamento de Spa dos Pés">
                             <img src="https://via.placeholder.com/500x500.png?text=Spa+dos+Pés+2" alt="Imagem 2 de um tratamento de Spa dos Pés">
                             <img src="https://via.placeholder.com/500x500.png?text=Spa+dos+Pés+3" alt="Imagem 3 de um tratamento de Spa dos Pés">
                        </div>

                         <div class="carousel-arrows">
                            <div class="arrows-for-slide1">
                                <label for="c3-img2" class="arrow next">›</label>
                            </div>
                            <div class="arrows-for-slide2">
                                <label for="c3-img1" class="arrow prev">‹</label>
                                <label for="c3-img3" class="arrow next">›</label>
                            </div>
                             <div class="arrows-for-slide3">
                                <label for="c3-img2" class="arrow prev">‹</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-text">
                    <h2>Spa dos Pés</h2>
                    <p>
                        Um tratamento completo de relaxamento e cuidado para quem merece uma pausa. Nosso spa dos pés inclui esfoliação, hidratação profunda, massagem relaxante e cutilagem, renovando a saúde e a aparência dos seus pés. Um verdadeiro carinho do começo ao fim.
                    </p>
                </div>
            </section>

            <section class="portfolio-item reverse">
                <div class="portfolio-image">
                    <img src="https://via.placeholder.com/500x500.png?text=Faby" alt="Foto da Faby, a fundadora">
                </div>
                <div class="portfolio-text">
                    <h2>Nossa História</h2>
                    <p>
                        Olá, eu sou a Faby! Desde pequena, sou apaixonada pela arte de transformar unhas em pequenas joias. O que começou como um hobby se tornou minha profissão e meu propósito: elevar a autoestima de cada cliente através de um trabalho feito com amor, precisão e os melhores produtos. A Fabys Unhas nasceu desse sonho e hoje é meu maior orgulho.
                    </p>
                </div>
            </section>

        </div>
    </main>

    <?php echo $footer; ?>

</body>
</html>