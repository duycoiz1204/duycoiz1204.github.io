const elementList = document.querySelectorAll(".pagination a.index");
const params = (new URL(window.location)).searchParams;
const page = params.get("page") != null ? parseInt(params.get("page")) : 1;

if (page === 1)
    elementList[0].setAttribute("class", "index actived");
else {
    for (let i = 0; i < elementList.length; i++) {
        if (parseInt(elementList[i].text) === page) {
            elementList[i].setAttribute("class", "index actived");
            break;
        }
    }
}

if(page === 1)
    document.querySelector(".prev").setAttribute("class", "prev disabled");
if((elementList.length == 3 && elementList[2].getAttribute("class").includes("actived")) ||
        (elementList.length == 2 && elementList[1].getAttribute("class").includes("actived")) ||
            (elementList.length == 1))
    document.querySelector(".next").setAttribute("class", "next disabled");

function prevPage() {
    window.location = `${window.location.pathname}?page=${page - 1}`;
}

function nextPage() {
    window.location = `${window.location.pathname}?page=${page + 1}`;
}

function checkForm() {
    let title = document.getElementById("title").value;
    let content = document.getElementById("content").value;
    let linkImage = document.getElementById("link-image").value;
    let isValid = true; // flag to check valid form

    if(title.length === 0) {
        document.getElementById("error-title").innerHTML = "Please enter title";
        isValid = false;
    }
    if(content.length === 0) {
        document.getElementById("error-content").innerHTML = "Please enter content";
        isValid = false;
    }
    if(linkImage.length === 0) {
        document.getElementById("error-link-image").innerHTML = "Please enter link image";
        isValid = false;
    }

    // Check valid form
    if(isValid)
        return true;
    
    return false;
}