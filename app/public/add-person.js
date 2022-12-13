document.getElementById('add-person').onclick = function () {
    let div = document.createElement('div');
    div.className = 'person';

    let nameInput = document.createElement('input');
    nameInput.className = 'name';
    nameInput.type = 'text';
    nameInput.placeholder = 'Имя';
    div.append(nameInput);

    let emailInput = document.createElement('input');
    emailInput.className = 'email';
    emailInput.type = 'email';
    emailInput.placeholder = 'Email';
    div.append(emailInput);

    let deleteButton = document.createElement('input');
    deleteButton.className = 'delete-person';
    deleteButton.type = 'button';
    deleteButton.value = 'Delete';
    deleteButton.onclick = function (event) {
        let personDiv = deleteButton.parentNode;
        personDiv.parentNode.removeChild(personDiv);
    }
    div.append(deleteButton);

    document.getElementById('persons').append(div);
}

document.getElementById('send').onclick = function () {
    let data = [];
    let formIsValid = true;

    let persons = document.getElementsByClassName('person');

    Array.prototype.forEach.call(persons, child => {
        let name = child.getElementsByClassName('name')[0].value
        let email = child.getElementsByClassName('email')[0].value
        
        if (name.replace(/^\s+/, "").length == 0 || email.replace(/^\s+/, "").length == 0) {
            alert('Заполните все поля');
            formIsValid = false;
        }

        if (!validateEmail(email)) {
            alert('Неверный формат почты ' + email);
            formIsValid = false;
        }

        data.push({
            "name": name,
            "email": email
        });
    });

    if (data.length < 4) {
        formIsValid = false;
        alert('В игре должно участвовать минимум 4 человека!');
    }
    
    if (formIsValid) {
        var xhr = new XMLHttpRequest();
        var url = "send";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        let payload = JSON.stringify(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Successful');
            } else {
                alert('Bad request');
            }
        };
        xhr.send(payload);
    }
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}



