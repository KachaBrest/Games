let div = document.getElementsByClassName('col');

let cross = [];
let zero = [];
let round = [];

// функция для отправки крестиков и получения ноликов
function getPost(id) {
    let xhr = new XMLHttpRequest();

    xhr.open('POST', './ajax', false);
    xhr.setRequestHeader('Content-type', 'application/json');

    try {
        xhr.send(id);
        if (xhr.status != 200) {
            alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
        } else {
            let num = xhr.response.indexOf('zero');
            return xhr.response.charAt(num-1);
        }
    } catch (err) { // для отлова ошибок
        alert("Запрос не удался");
    }
}

// функция для отправки данных о выйгрыше/пройгрыше/ничье
function gameOver(id) {
    let xhr = new XMLHttpRequest();

    xhr.open('POST', './over', false);
    xhr.setRequestHeader('Content-type', 'application/json');

    try {
        xhr.send(id);
        if (xhr.status != 200) {
            alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
        } else {
            console.log(xhr.response)
        }
    } catch (err) { // для отлова ошибок
        alert("Запрос не удался");
    }
}


for (let i = 0; i < div.length; i++) {
    div[i].onclick = function (e) {
        if (!e.srcElement.innerHTML.length ){
            e.srcElement.innerHTML = 'X';

            // в массив крестиков заносим поставленные id
            cross.push(e.srcElement.id);

            let id = {
                cross,
                zero,
            };
            // проверка, если крестиков меньше 5, тогда мы можем отправлять запрос на сервер
            if (cross.length <= 4 ) {
                let json = JSON.stringify(id);

                // записываем ответ от сервера
                let answer = getPost(json);

                // в массив ноликов заносим поставленные id
                zero.push(answer);

                // в элемент с ноликом ставим 0
                let number  = answer - 1;
                div[number].innerHTML = '0';
                console.log(id);
            }

            //делаем проверку на победу/пройгрыш/ничью
            if ((cross.includes('1') && cross.includes('2') && cross.includes('3'))
            || (cross.includes('4') && cross.includes('5') && cross.includes('6'))
            || (cross.includes('7') && cross.includes('8') && cross.includes('9'))

            || (cross.includes('1') && cross.includes('4') && cross.includes('7'))
            || (cross.includes('2') && cross.includes('5') && cross.includes('8'))
            || (cross.includes('3') && cross.includes('6') && cross.includes('9'))

            || (cross.includes('1') && cross.includes('5') && cross.includes('9'))
            || (cross.includes('3') && cross.includes('5') && cross.includes('7'))
            ) {
                alert("Игрок выйграл")
                round[0] = "1";
                let game = JSON.stringify(round)
                gameOver(game);
                location.reload();
            } else if ((zero.includes('1') && zero.includes('2') && zero.includes('3'))
                || (zero.includes('4') && zero.includes('5') && zero.includes('6'))
                || (zero.includes('7') && zero.includes('8') && zero.includes('9'))

                || (zero.includes('1') && zero.includes('4') && zero.includes('7'))
                || (zero.includes('2') && zero.includes('5') && zero.includes('8'))
                || (zero.includes('3') && zero.includes('6') && zero.includes('9'))

                || (zero.includes('1') && zero.includes('5') && zero.includes('9'))
                || (zero.includes('3') && zero.includes('5') && zero.includes('7'))

            ) {
                alert("Игрок проиграл")
                round[0] = "-1";
                let game = JSON.stringify(round)
                gameOver(game);
                location.reload();
            } else if (zero.length > 3 && cross.length > 4) {
                alert("Ничья")
                round[0] = "0";
                let game = JSON.stringify(round)
                gameOver(game);
                location.reload();

            }
        }

    }
}




