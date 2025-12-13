<style>
@import url('https://fonts.googleapis.com/css?family=Open+Sans');

:root {
    --paynes-gray: #5d737e;
    --verdigris: #64b6ac;
    --mint-green: #daffef;
    --baby-powder: #fcfffd;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

fieldset {
    border: 2px solid var(--verdigris);
    border-radius: 8px;
    padding: 15px;
    background-color: var(--mint-green);
}

legend {
    font-weight: bold;
    padding: 0 10px;
    color: var(--paynes-gray);
}

label {
    display: flex;
    flex-direction: column;
    font-weight: bold;
    margin-bottom: 10px;
}

input[type="text"],
textarea {
    padding: 8px;
    border: 1px solid var(--verdigris);
    bor
