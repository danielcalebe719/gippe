flatpickr('#selectedDate', {
    enableTime: false,
    dateFormat: "d/m/Y", // Formato de data alterado para Dia/Mês/Ano
    minDate: "today",
    inline: true, // Exibe o calendário diretamente na página
    locale: "pt", // Define o idioma como português
});

flatpickr('#selectedTime', {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minuteIncrement: 15, // Intervalo de 15 minutos
    onClose: function (selectedDates, dateStr, instance) {
        // Ao fechar o seletor de hora, atualiza o valor do campo de entrada
        document.getElementById('selectedTime').value = dateStr;
    }
});
flatpickr('#selectedTime2', {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minuteIncrement: 15, // Intervalo de 15 minutos
    onClose: function (selectedDates, dateStr, instance) {
        // Ao fechar o seletor de hora, atualiza o valor do campo de entrada
        document.getElementById('selectedTime2').value = dateStr;
    }
});
var num = 2;
document.getElementById('confirmButton').addEventListener('click', function () {
   
     
        setTimeout(()=>{location.href = "../Home-L/index.html" },3000);
        setTimeout(()=>{alert("Dia de entrega enviado para revisão!Fique atento as suas notificações para pagar e finalizar o pedido. ")},0);
  
        
        

})
document.getElementById('confirmButton2').addEventListener('click', function () {

    const selectedDate = document.getElementById('selectedDate').value;
    const selectedTime = document.getElementById('selectedTime').value;
    const selectedTime2 = document.getElementById('selectedTime2').value;
    const confirmationMessage = `Dia de entrega agendado para ${selectedDate} às ${selectedTime} até ${selectedTime2}.`;
    document.getElementById('confirmation').innerText = confirmationMessage;

    
    

})


 
