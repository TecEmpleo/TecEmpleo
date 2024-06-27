function toggleNav() {
    const menu = document.getElementById("myMenu");
    const isOpen = menu.style.width === "250px";
    menu.style.width = isOpen ? "0" : "250px";

    // Oculta o muestra el icono del menú según el estado
    const menuBtn = document.getElementById("menuBtn");
    menuBtn.style.display = isOpen ? "block" : "none";

    document.getElementById("resultContainer").innerHTML = "";
}

function searchFolders() {
    const query = document.getElementById("searchInput").value;
    const resultContainer = document.getElementById("resultContainer");

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            resultContainer.innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "carpetas.php?query=" + query, true);
    xmlhttp.send();
}