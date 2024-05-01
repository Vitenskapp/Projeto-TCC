         // Adicionando evento de clique para as datas
         var dates = document.querySelectorAll('.date');
         dates.forEach(function(date) {
             date.addEventListener('click', function() {
                 // Removendo a classe 'selected-date' de todas as datas
                 dates.forEach(function(d) {
                     d.classList.remove('selected-date');
                     d.classList.remove('darker'); // Remove a classe 'darker' de todas as datas
                 });
                 // Adicionando a classe 'selected-date' à data clicada
                 this.classList.add('selected-date');
                 this.classList.add('darker'); // Adiciona a classe 'darker' à data clicada
             });
         });
         
        function marcarHorario(checkbox) {
            var td = checkbox.parentNode;
            if (checkbox.checked) {
                td.classList.add('selected');
            } else {
                td.classList.remove('selected');
            }
        }

        function mostrarHorariosSelecionados() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            var dataSelecionada = document.querySelector('.selected-date');
            var horariosSelecionados = document.getElementById('horariosSelecionados');
            if (!dataSelecionada) {
                alert("Por favor, selecione uma data.");
                return;
            }
            if (checkboxes.length === 0) {
                alert("Por favor, selecione pelo menos um horário.");
                return;
            }
            var horarios = [];
            checkboxes.forEach(function(checkbox) {
                horarios.push(checkbox.value);
            });
            horariosSelecionados.innerHTML = "<h2>Horários Selecionados para " + dataSelecionada.getAttribute('data-date') + ":</h2>";
            horarios.forEach(function(horario) {
                horariosSelecionados.innerHTML += horario + "<br>";
            });
        }