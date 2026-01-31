document.addEventListener('DOMContentLoaded', function() {
    
    const seatsContainer = document.getElementById('seatsContainer');
    const hiddenInput = document.getElementById('selected_seat_input');
    const displaySpan = document.getElementById('displaySeat');

    const bookedSeats = (window.bookedSeatsFromDB || []).map(String);

    for (let i = 1; i <= 60; i++) {
        let btn = document.createElement('button');
        btn.type = 'button'; 
        btn.className = 'seat-btn';
        btn.innerText = i;

        if (bookedSeats.includes(String(i))) {
            btn.classList.add('occupied');
            btn.disabled = true;
            btn.title = "Already Booked";
        } else {
            btn.onclick = function() {
                selectSeat(i, btn);
            };
        }
        
        seatsContainer.appendChild(btn);
    }

    function selectSeat(seatNum, btnElement) {

        if(hiddenInput) hiddenInput.value = seatNum;
        if(displaySpan) displaySpan.innerText = seatNum;

        let allSeats = document.querySelectorAll('.seat-btn');
        allSeats.forEach(seat => {
            if (!seat.classList.contains('occupied')) {
                seat.classList.remove('selected');
            }
        });

        btnElement.classList.add('selected');
    }
});