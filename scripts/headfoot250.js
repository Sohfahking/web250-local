// Function to load external HTML

function loadComponent(tagName, filePath) {
    fetch(filePath)
        .then(function (response) {
            if (!response.ok) {
                throw new Error("HTTP error! Status: " + response.status);
            }
            return response.text();
        })
        .then(function (data) {
            const elements = document.getElementsByTagName(tagName);
            if (elements.length > 0) {
                elements[0].innerHTML = data;
            } else {
                console.error("No <" + tagName + "> element found in the document.");
            }
        })
        .catch(function (error) {
            console.error("Error loading " + filePath + ":", error);
        });
}

document.addEventListener("DOMContentLoaded", function () {
    loadComponent("header", "components/header250.html");
    loadComponent("footer", "components/footer250.html");
});