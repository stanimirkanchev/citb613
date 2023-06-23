{
    let time_slots = document.getElementsByClassName('time_slot');

    for (let i=0; i < time_slots.length; ++i) {
        time_slots[i].addEventListener('click', openReservations);
    }

    function openReservations(e) {
        e.preventDefault();
        const time = e.target.attributes['data-time'].value;
        const day = e.target.attributes['data-day'].value;
        
        document.getElementById('dayHiddenInput').value = day;
        document.getElementById('timeHiddenInput').value = time;
        document.getElementById('reservation_modal').classList.add('shown');
        document.getElementById('reservation_modal_overlay').classList.add('shown');
        
    };

    const closeModal = document.getElementById('reservation_modal_close');
    closeModal.addEventListener('click', function() {
        document.getElementById('reservation_modal').classList.remove('shown');
        document.getElementById('reservation_modal_overlay').classList.remove('shown');
        document.getElementById('dayHiddenInput').value = '';
        document.getElementById('timeHiddenInput').value = '';
    })
}

{
    const people = document.getElementById('peopleInput');
    people.addEventListener('change', function(e) {
        const rawCapacity = document.getElementById('rawCapacity');
        const rawPrice = document.getElementById('rawPrice');
        rawCapacity.value = e.target.value;

        document.getElementById('totalPrice').innerHTML = 
            `${(rawPrice.value * rawCapacity.value).toFixed(2)}лв.`;
    });
}

{
    const form = document.getElementById('reservation_form');
    const submitButton = document.getElementById('reservation_button');
    
    submitButton.addEventListener('click', createReservation);

    async function createReservation(e) {
        e.preventDefault();
        const token = document.querySelector('meta[name=csrf-token]').content;
        const action = form.action;
        const errors = [];
        const firstName = document.getElementById('firstNameInput');
        const lastName = document.getElementById('lastNameInput');
        const phone = document.getElementById('phoneInput');
        const email = document.getElementById('emailInput');
        const people = document.getElementById('peopleInput');
        const password = document.getElementById('passwordInput');
        const passwordConfirmation = document.getElementById('passwordConfirmationInput');
        const day = document.getElementById('dayHiddenInput');
        const time = document.getElementById('timeHiddenInput');

        [firstName,lastName,phone,email,people].some(el => {
            if (!el.value.length) {
                errors.push(`<span>Полето ${el.attributes.placeholder.value} е задължително</span>`);
            }
        });
        
        if (errors.length) {
            const errorsWrapper = document.getElementById('reservationErrorsPlaceholder');
            errorsWrapper.innerHTML = null;
            errors.forEach(error => errorsWrapper.innerHTML += error);
            return false;
        }
        
        if ((password && passwordConfirmation) && (!passwordConfirmation.value || !password.value)) {
            const passwordErrorsWrapper = document.getElementById('reservationErrorsPlaceholder');
            passwordErrorsWrapper.innerHTML = null;
            passwordErrorsWrapper.innerHTML += 'Моля въведете и потвърдете парола за акаунта ви!';
            return false;
        }
        const data = {
            'first_name': firstName.value,
            'last_name': lastName.value,
            'phone': phone.value,
            'email': email.value,
            'people': people.value,
            'password': password?.value || null,
            'password_confirmation': passwordConfirmation?.value || null,
            'day': day.value,
            'time': time.value,
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            const emailExistsError = document.getElementById('emailExistsError');
            const takenError = document.getElementById('takenError');
            const reservationPasswordErrors = document.getElementById('reservationPasswordErrors');
            emailExistsError.innerHTML = null;
            reservationPasswordErrors.innerHTML = null;

            if (xmlhttp.readyState == 4 && xmlhttp.status === 200) {
                const data = JSON.parse(xmlhttp.response);
                window.location.href = `/room/reservation/success/${data.data.reservation_id}`
            } else if(xmlhttp.status > 399) {
                const data = JSON.parse(xmlhttp.response);
                takenError.innerHTML = data.taken;
                emailExistsError.innerHTML = data.data.email;
                reservationPasswordErrors.innerHTML = data.data.password;
                
            }
        }
        xmlhttp.open("POST", action, true);
        xmlhttp.setRequestHeader('Content-Type', 'application/json;');
        xmlhttp.setRequestHeader('X-CSRF-TOKEN', token);
        xmlhttp.send(JSON.stringify(data));
    };
}

console.log('Hi!');