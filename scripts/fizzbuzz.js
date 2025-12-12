function fizzBuzz() {

    let first = document.getElementById("first").value.trim();
    let middle = document.getElementById("middle").value.trim();
    let last = document.getElementById("last").value.trim();

    let defaultWord = document.getElementById("defaultWord").value.trim();
    let count = parseInt(document.getElementById("count").value);

    let word1 = document.getElementById("word1").value.trim();
    let div1 = parseInt(document.getElementById("div1").value);

    let word2 = document.getElementById("word2").value.trim();
    let div2 = parseInt(document.getElementById("div2").value);

    let word3 = document.getElementById("word3").value.trim();
    let div3 = parseInt(document.getElementById("div3").value);

    if (!first || !last) {
        alert("First and last name are required.");
        return;
    }

    if (middle && middle.length !== 1) {
        alert("Middle initial must be exactly one letter.");
        return;
    }

    let fullName = middle ? `${first} ${middle}. ${last}` : `${first} ${last}`;

    let output = `<h3>Welcome, ${fullName}!</h3>`;
    output += "<ol>";

    for (let n = 1; n <= count; n++) {
        let text = "";

        if (word1 && div1 && n % div1 === 0) text += word1;
        if (word2 && div2 && n % div2 === 0) text += word2;
        if (word3 && div3 && n % div3 === 0) text += word3;

        if (!text) text = defaultWord;

        output += `<li>${text}</li>`;
    }

    output += "</ol>";

    document.getElementById("output").innerHTML = output;
}