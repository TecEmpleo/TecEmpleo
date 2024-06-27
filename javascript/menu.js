function toggleNav() {
    const menu = document.getElementById("myMenu");
    const isOpen = menu.style.width === "250px";
    menu.style.width = isOpen ? "0" : "250px";
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
