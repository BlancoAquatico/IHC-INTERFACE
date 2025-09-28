<?php
session_start();

$header = file_get_contents("header.html");
$footer = file_get_contents("footer.html");
$services_data = [
    'manicure' => [ 'nome' => 'Manicure Tradicional', 'preco' => 30.00, 'duracao' => 45, 'options' => [ 'cor' => [ 'label' => 'Cor do Esmalte', 'items' => [ 'vermelho' => ['nome' => 'Vermelho Intenso', 'preco' => 0, 'duracao' => 0], 'nude' => ['nome' => 'Nude Clássico', 'preco' => 0, 'duracao' => 0], 'francesinha' => ['nome' => 'Francesinha', 'preco' => 5.00, 'duracao' => 10], ] ] ] ],
    'pedicure' => ['nome' => 'Pedicure Completa', 'preco' => 40.00, 'duracao' => 60],
    'unha_gel' => [ 'nome' => 'Aplicação de Unha em Gel', 'preco' => 120.00, 'duracao' => 150, 'options' => [ 'design' => [ 'label' => 'Design Especial', 'items' => [ 'nenhum' => ['nome' => 'Nenhum', 'preco' => 0, 'duracao' => 0], 'glitter' => ['nome' => 'Glitter Encapsulado', 'preco' => 15.00, 'duracao' => 20], 'baby_boomer' => ['nome' => 'Baby Boomer', 'preco' => 20.00, 'duracao' => 30], ] ] ] ],
    'fibra_vidro' => ['nome' => 'Alongamento em Fibra de Vidro', 'preco' => 150.00, 'duracao' => 180],
    'spa_pes' => ['nome' => 'Spa dos Pés', 'preco' => 50.00, 'duracao' => 45],
    'esmalte_gel' => ['nome' => 'Esmaltação em Gel', 'preco' => 60.00, 'duracao' => 60],
];
$day_translations = ['Monday'=>'Segunda', 'Tuesday'=>'Terça', 'Wednesday'=>'Quarta', 'Thursday'=>'Quinta', 'Friday'=>'Sexta', 'Saturday'=>'Sábado', 'Sunday'=>'Domingo'];
$month_translations = ['January'=>'Janeiro', 'February'=>'Fevereiro', 'March'=>'Março', 'April'=>'Abril', 'May'=>'Maio', 'June'=>'Junho', 'July'=>'Julho', 'August'=>'Agosto', 'September'=>'Setembro', 'October'=>'Outubro', 'November'=>'Novembro', 'December'=>'Dezembro'];

$stage = $_POST['stage'] ?? (isset($_SESSION['booking_details']) ? 'calendar' : 'selection');
if (isset($_GET['reset'])) { session_destroy(); header('Location: agendamento.php'); exit(); }
function get_bookings() { if (!file_exists('bookings.json')) file_put_contents('bookings.json', '[]'); return json_decode(file_get_contents('bookings.json'), true); }

if ($stage === 'process_selection') {
    $total_price = 0; $total_duration = 0; $selected_services_names = []; $final_selection = [];
    if (isset($_POST['servicos'])) {
        foreach ($_POST['servicos'] as $service_key) {
            $service = $services_data[$service_key]; $total_price += $service['preco']; $total_duration += $service['duracao']; $service_name_with_options = $service['nome']; $final_selection[$service_key]['nome'] = $service['nome'];
            if (isset($_POST['options'][$service_key])) {
                $options_text = [];
                foreach ($_POST['options'][$service_key] as $opt_key => $item_key) {
                    $option_item = $service['options'][$opt_key]['items'][$item_key]; $total_price += $option_item['preco']; $total_duration += $option_item['duracao'];
                    if ($option_item['preco'] > 0 || strtolower($option_item['nome']) !== 'nenhum') { $options_text[] = $option_item['nome']; }
                    $final_selection[$service_key]['options'][$opt_key] = $option_item['nome'];
                }
                if (!empty($options_text)) { $service_name_with_options .= " (" . implode(', ', $options_text) . ")"; }
            }
            $selected_services_names[] = $service_name_with_options;
        }
        $_SESSION['booking_details'] = [ 'price' => $total_price, 'duration' => $total_duration, 'names' => $selected_services_names, 'selection_data' => $final_selection ];
        header('Location: agendamento.php'); exit();
    } else { $error_message = "Você precisa selecionar pelo menos um serviço."; $stage = 'selection'; }
}

if ($stage === 'book_confirm') {
    $errors = [];
    if (empty(trim($_POST['nome']))) { $errors['nome'] = 'O campo Nome é obrigatório.'; }
    if (empty(trim($_POST['sobrenome']))) { $errors['sobrenome'] = 'O campo Sobrenome é obrigatório.'; }
    if (empty(trim($_POST['telefone']))) { $errors['telefone'] = 'O campo Telefone é obrigatório.'; }

    if (!empty($errors)) {
        $stage = 'user_info'; // Volta para a etapa de informações se houver erros
    } else {
        $bookings = get_bookings(); $booking_details = $_SESSION['booking_details'];
        $new_booking = [ 'nome_cliente' => htmlspecialchars($_POST['nome']) . ' ' . htmlspecialchars($_POST['sobrenome']), 'telefone' => htmlspecialchars($_POST['telefone']), 'pagamento' => htmlspecialchars($_POST['pagamento']), 'servicos' => $booking_details['selection_data'], 'preco_total' => $booking_details['price'], 'duracao_total' => $booking_details['duration'], 'data_hora' => $_POST['data_hora'] ];
        $is_available = !in_array($new_booking['data_hora'], array_column($bookings, 'data_hora'));
        if ($is_available) {
            $bookings[] = $new_booking; file_put_contents('bookings.json', json_encode($bookings, JSON_PRETTY_PRINT), LOCK_EX);
            $confirmation_message = "Agendamento confirmado com sucesso para " . date('d/m/Y \à\s H:i', strtotime($new_booking['data_hora'])) . "!";
            session_destroy();
        } else {
            $error_message = "Desculpe, o horário " . date('d/m/Y \à\s H:i', strtotime($new_booking['data_hora'])) . " foi agendado por outra pessoa. Por favor, escolha outro.";
            $stage = 'calendar';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento - Fabys Unhas</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php echo $header; ?>

    <main class="content">
        <div class="container">
            <div class="page-title">
                <h1>Faça seu Agendamento</h1>
                <p>Siga os passos abaixo para garantir seu horário conosco.</p>
            </div>
            
            <?php if (isset($error_message) && $stage === 'selection'): ?><div class="notice error"><?= $error_message ?></div><?php endif; ?>

            <?php if ($stage === 'selection'): ?>
                <div id="stage-selection" class="form-stage">
                <form method="POST" action="agendamento.php">
                    <input type="hidden" name="stage" value="process_selection">
                    <fieldset><legend>1. Selecione os serviços e detalhes</legend><div class="services-list">
                        <?php foreach ($services_data as $key => $service): ?>
                            <div class="service-item-wrapper">
                                <div class="service-item-option"><input type="checkbox" id="<?= $key ?>" name="servicos[]" value="<?= $key ?>"><label for="<?= $key ?>"><span class="service-name"><?= $service['nome'] ?></span><span class="service-price">R$ <?= number_format($service['preco'], 2, ',', '.') ?></span></label></div>
                                <?php if (isset($service['options'])): ?><div class="service-details" id="details-<?= $key ?>">
                                    <?php foreach ($service['options'] as $opt_key => $option_group): ?><div class="form-group-details"><label for="option-<?= $key ?>-<?= $opt_key ?>"><?= $option_group['label'] ?></label><select name="options[<?= $key ?>][<?= $opt_key ?>]" id="option-<?= $key ?>-<?= $opt_key ?>">
                                        <?php foreach ($option_group['items'] as $item_key => $item): ?><option value="<?= $item_key ?>"><?= $item['nome'] ?><?php if($item['preco'] > 0) echo " (+ R$ " . number_format($item['preco'], 2, ',', '.') . ")" ?></option><?php endforeach; ?>
                                    </select></div><?php endforeach; ?>
                                </div><?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div></fieldset>
                    <button type="submit" class="btn-agendar">Ver Calendário de Horários</button>
                </form>
            </div>
            <?php endif; ?>
            
            <?php if ($stage === 'calendar'): ?>
                <?php if (isset($error_message)): ?><div class="notice error"><?= $error_message ?></div><?php endif; ?>
                <div id="stage-calendar" class="form-stage">
                <?php $booking_details = $_SESSION['booking_details']; ?>
                <div class="simulation-summary"><h3>2. Escolha o dia e a hora</h3><p><strong>Serviços Selecionados:</strong> <?= implode('; ', $booking_details['names']) ?></p><p><strong>Valor estimado:</strong> R$ <?= number_format($booking_details['price'], 2, ',', '.') ?></p><p><strong>Duração estimada:</strong> <?= floor($booking_details['duration'] / 60) ?>h e <?= $booking_details['duration'] % 60 ?>min</p></div>
                <div class="calendar-wrapper">
                    <?php
                        date_default_timezone_set('America/Sao_Paulo');
                        $current_month = $_GET['month'] ?? date('n'); $current_year = $_GET['year'] ?? date('Y'); $selected_day = $_GET['day'] ?? null;
                        $prev_month = $current_month == 1 ? 12 : $current_month - 1; $prev_year = $current_month == 1 ? $current_year - 1 : $current_year;
                        $next_month = $current_month == 12 ? 1 : $current_month + 1; $next_year = $current_month == 12 ? $current_year + 1 : $current_year;
                        $month_name = date('F', mktime(0,0,0,$current_month,1,$current_year));
                    ?>
                    <div class="calendar-nav"><a href="?month=<?= $prev_month ?>&year=<?= $prev_year ?>" class="nav-arrow">‹</a><span class="month-name"><?= $month_translations[$month_name] ?> de <?= $current_year ?></span><a href="?month=<?= $next_month ?>&year=<?= $next_year ?>" class="nav-arrow">›</a></div>
                    <table class="calendar-table">
                        <thead><tr><th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th></tr></thead>
                        <tbody>
                            <?php
                                $days_in_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
                                $first_day_of_week = date('N', mktime(0,0,0,$current_month,1,$current_year)) % 7 + 1;
                                $day_counter = 1; echo "<tr>"; for ($i = 1; $i < $first_day_of_week; $i++) echo "<td></td>";
                                while($day_counter <= $days_in_month) {
                                    if ($first_day_of_week > 7) { echo "</tr><tr>"; $first_day_of_week = 1; }
                                    $current_date_str = "$current_year-$current_month-$day_counter"; $is_past = strtotime($current_date_str) < strtotime(date('Y-m-d')); $is_sunday = $first_day_of_week == 1; $is_selected = $selected_day == $day_counter;
                                    $class = $is_past || $is_sunday ? 'past' : ''; $class .= $is_selected ? ' selected' : '';
                                    if ($is_past || $is_sunday) { echo "<td class='$class'>$day_counter</td>"; } else { echo "<td class='$class'><a href='?month=$current_month&year=$current_year&day=$day_counter'>$day_counter</a></td>"; }
                                    $day_counter++; $first_day_of_week++;
                                }
                                while($first_day_of_week <= 7) { echo "<td></td>"; $first_day_of_week++; } echo "</tr>";
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($selected_day): ?>
                <div class="time-slots-container">
                    <h4>Horários disponíveis para <?= "$selected_day/" . str_pad($current_month,2,'0',STR_PAD_LEFT) . "/$current_year" ?></h4>
                    <div class="time-slots">
                    <?php
                        $bookings = get_bookings(); $booked_slots = array_column($bookings, 'data_hora'); $selected_date = "$current_year-$current_month-$selected_day";
                        $start_time = strtotime($selected_date . ' 09:00'); $end_time = strtotime($selected_date . ' 18:00');
                        for ($time = $start_time; $time <= $end_time; $time += 30 * 60) {
                            if (in_array(date('Y-m-d H:i:s', $time), $booked_slots)) { echo "<span class='time-slot unavailable'>" . date('H:i', $time) . "</span>"; } else {
                                echo "<form method='POST' action='agendamento.php' class='time-slot-form'><input type='hidden' name='stage' value='user_info'><input type='hidden' name='data_hora' value='" . date('Y-m-d H:i:s', $time) . "'><button type='submit' class='time-slot available'>" . date('H:i', $time) . "</button></form>";
                            }
                        }
                    ?>
                    </div>
                </div>
                <?php endif; ?>
                <a href="?reset=true" class="btn-reset">Cancelar e Escolher Outros Serviços</a>
            </div>
            <?php endif; ?>

            <?php if ($stage === 'user_info'): ?>
            <div id="stage-user-info" class="form-stage">
                <div class="final-summary">
                    <h3>3. Confirme seus dados</h3>
                    <p><strong>Data e Hora:</strong> <?= date('d/m/Y \à\s H:i', strtotime($_POST['data_hora'])) ?></p>
                    <p><strong>Valor Total:</strong> R$ <?= number_format($_SESSION['booking_details']['price'], 2, ',', '.') ?></p>
                </div>
                
                <div class="back-link-wrapper">
                    <a href="agendamento.php" class="back-link">‹ Voltar e escolher outro horário</a>
                </div>

                <form id="booking-form" method="POST" action="agendamento.php">
                    <input type="hidden" name="stage" value="book_confirm">
                    <input type="hidden" name="data_hora" value="<?= $_POST['data_hora'] ?>">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" class="<?= isset($errors['nome']) ? 'input-error' : '' ?>" required>
                            <?php if (isset($errors['nome'])): ?><span class="error-message"><?= $errors['nome'] ?></span><?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" id="sobrenome" name="sobrenome" value="<?= htmlspecialchars($_POST['sobrenome'] ?? '') ?>" class="<?= isset($errors['sobrenome']) ? 'input-error' : '' ?>" required>
                             <?php if (isset($errors['sobrenome'])): ?><span class="error-message"><?= $errors['sobrenome'] ?></span><?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone (WhatsApp)</label>
                        <input type="tel" id="telefone" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>" class="<?= isset($errors['telefone']) ? 'input-error' : '' ?>" required>
                         <?php if (isset($errors['telefone'])): ?><span class="error-message"><?= $errors['telefone'] ?></span><?php endif; ?>
                    </div>
                    <fieldset>
                        <legend>Forma de Pagamento</legend>
                        <div class="payment-options">
                        <div class="payment-item"><input type="radio" id="dinheiro" name="pagamento" value="dinheiro" checked><label for="dinheiro"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><circle cx="12" cy="12" r="4"></circle></svg>Dinheiro</label></div>
                        <div class="payment-item"><input type="radio" id="pix" name="pagamento" value="pix"><label for="pix"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2z"></path><path d="M16 8a4 4 0 1 0-8 0"></path><path d="M12 12v4"></path><path d="M12 18v.01"></path></svg>Pix</label></div>
                    </div>
                    </fieldset>
                    <button type="submit" id="confirm-booking-btn" class="btn-agendar">Confirmar Agendamento</button>
                </form>
            </div>
            <?php endif; ?>

            <?php if (isset($confirmation_message)): ?>
                <div id="stage-confirmation" class="form-stage confirmation-box">
                    <h3 class="success"><?= $confirmation_message ?></h3><p>Aguardamos você! Qualquer dúvida, entre em contato.</p><a href="agendamento.php" class="btn-agendar">Fazer Novo Agendamento</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <?php echo $footer; ?>
    <button id="help-button" class="help-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>AJUDA</button>
    <div id="help-modal" class="modal-overlay"><div class="modal-content"><span class="modal-close">&times;</span><h2>Como Agendar</h2><div class="help-steps"><div class="help-step"><div class="help-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></div><div class="help-text"><strong>Passo 1:</strong> Marque os serviços que deseja e escolha os detalhes como cor ou design, se disponível.</div></div><div class="help-step"><div class="help-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></div><div class="help-text"><strong>Passo 2:</strong> No calendário, navegue entre os meses e clique no dia em que deseja o atendimento.</div></div><div class="help-step"><div class="help-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div><div class="help-text"><strong>Passo 3:</strong> Abaixo do calendário, clique em um dos horários disponíveis que aparecerem.</div></div><div class="help-step"><div class="help-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div><div class="help-text"><strong>Passo 4:</strong> Preencha seus dados, escolha a forma de pagamento e clique em "Confirmar Agendamento". Pronto!</div></div></div></div></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script para os detalhes dos serviços (sem alteração)
            const serviceCheckboxes = document.querySelectorAll('.service-item-option input[type="checkbox"]');
            serviceCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const detailsDiv = document.getElementById('details-' + this.id);
                    if (detailsDiv) { if (this.checked) { detailsDiv.style.display = 'block'; } else { detailsDiv.style.display = 'none'; } }
                });
            });

            // Script para o popup de ajuda (sem alteração)
            const helpButton = document.getElementById('help-button');
            const helpModal = document.getElementById('help-modal');
            const closeModalButton = helpModal.querySelector('.modal-close');
            helpButton.addEventListener('click', function() { helpModal.style.display = 'flex'; });
            closeModalButton.addEventListener('click', function() { helpModal.style.display = 'none'; });
            helpModal.addEventListener('click', function(event) { if (event.target === helpModal) { helpModal.style.display = 'none'; } });

            // NOVO SCRIPT: Feedback de carregamento no botão final
            const bookingForm = document.getElementById('booking-form');
            if(bookingForm) {
                bookingForm.addEventListener('submit', function() {
                    const confirmButton = document.getElementById('confirm-booking-btn');
                    confirmButton.disabled = true;
                    confirmButton.innerHTML = '<span class="spinner"></span>Aguarde...';
                });
            }
        });
    </script>
</body>
</html>