window.onload = () => {
    fetch("json/data.json")
        .then(response => response.json())
        .then(data => setCategory(data));

}

let select = document.getElementById("category");

function setCategory(data) {
    for (const key in data.categories) {
        let cate = document.createElement("option");
        cate.value = data.categories[key].cat_id;
        cate.innerHTML = data.categories[key].name;
        select.appendChild(cate);
    }
}
