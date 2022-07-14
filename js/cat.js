window.onload = () => {
    fetch("json/data.json")
        .then(response => response.json())
        .then(data => setCategory(data));

    select.onchange = () => {
        let i = 0;
        for (let j = 1; j <= select.childElementCount; j++) {
            if (select.childNodes[j].selected) {
                i = j;
                break;

            }

        }
        fetch("json/data.json")
            .then(response => response.json())
            .then(data => setData(data, i));
        hideCard(i);
    }
}

let select = document.getElementById("category");
let info = document.getElementById("info");
function setCategory(data) {
    for (const key in data.categories) {
        let cate = document.createElement("option");
        cate.value = data.categories[key].cat_id;
        cate.innerHTML = data.categories[key].name;
        select.appendChild(cate);
    }
}

function setData(data, i) {
    console.log(i);
    info.hidden = false;
    for (const key in data.categories) {
        if (data.categories[key].cat_id == i) {
            info.childNodes[1].innerHTML = data.categories[key].name;
            info.childNodes[3].src = data.categories[key].picture;
            info.childNodes[7].innerHTML = data.categories[key].description;

        }
    }

}

let cards = document.getElementsByClassName("jscard");
function hideCard(i) {
    for (let j = 0; j < cards.length; j++) {
        if (cards[j].childNodes[1].innerHTML != i) {
            cards[j].hidden = true;
        }
        else {
            cards[j].hidden = false;
        }
    }
}