<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Agendamento de Horários</title>
</head>
<body>
    <header>

        <div class="inicio">
            <a href="../../index.html"><p>Início</p></a>
            <a href="Perfil/perfil.php"><p>Perfil</p></a>
        </div>
        
        <h1>Veja os horários disponiveis:</h1>
        <form id="form_sala">
            <label for="sala">Sala:</label>
            <select id="sala" name="sala" onclick='selecionarData(this)'>
                <?php
                for ($i = 1; $i <= 8; $i++) {
                    echo "<option value='$i'>Laboratório $i</option>";
                }
                ?>  
            </select>
        </form>

        <div class="dates">
        <?php
            $dias_da_semana = [
                1 => 'Segunda',
                2 => 'Terça',
                3 => 'Quarta',
                4 => 'Quinta',
                5 => 'Sexta'
            ];

            foreach ($dias_da_semana as $id_dia => $nome_dia) {
                echo "<span class='date' data-id_dia='$id_dia' onclick='selecionarData(this)'>$nome_dia</span> ";
            }
        ?>
        </div>
    </header>
    <section id="sempre_novo">

        <div id="tabela">
            <table id="tabela_horarios">
                <!-- Tabela interativa aqui-->
            </table>
            <br>

            <a href="agendar/index.php"><button>Quer agendar algum horário?</button></a>
            <a href="Cadastro/cadastro.php"><button>Cadastrar Professor</button></a>
            <input type="button" value="Limpar" onclick="limparSelecao()">
        </div>
    </section>

    <script>
        function selecionarData(elemento) {
            // Obter o id_dia e id_sala
            var id_dia = elemento.getAttribute('data-id_dia');
            var id_sala = document.getElementById("sala").value;

            // Enviar requisição AJAX para buscar horários de acordo com a sala e o dia selecionado
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "buscar_horarios.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Atualizar a tabela com os horários recebidos
                    document.querySelector("#tabela_horarios").innerHTML = xhr.responseText;
                }
            };
            xhr.send("id_dia=" + id_dia + "&id_sala=" + id_sala);
        }

        function limparSelecao() {
            // Exibe uma mensagem de confirmação
            if (confirm("Certeza?")) {
                fetch('Limpar/limpar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    window.location.href = 'index.php'; // Substitua pelo caminho do arquivo desejado
                })
                .catch((error) => {
                    console.error('Erro:', error);
                });
            }
        }

        function excluirHorario(id_horario) {
            if (confirm("Tem certeza que deseja excluir este horário?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "Limpar/excluir_horario.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        window.location.href = 'index.php'; // Recarrega os horários
                    }
                };
                xhr.send("id_horario=" + id_horario);
            }
        }
    </script>
</body>
</html>