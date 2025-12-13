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
    border-radius: 5px;
    font-size: 1rem;
    width: 100%;
}

button[type="submit"] {
    background-color: var(--mint-green);
    color: var(--paynes-gray);
    font-weight: bold;
    padding: 12px 20px;
    border-radius: 8px;
    cursor: pointer;
}
</style>

<h2>Introduction Form</h2>

<form action="contents/introprocess.php" method="post" style="max-width:800px;margin:0 auto;">

<fieldset>
<legend>Your Information</legend>

<label>First Name:
<input type="text" name="first" value="Dajabre" required>
</label>

<label>Middle Initial:
<input type="text" name="middle" maxlength="1">
</label>

<label>Last Name:
<input type="text" name="last" value="Torain-Williams" required>
</label>

<label>About You:
<textarea name="about" rows="4">My name is Dajabre and this is my last semester at CPCC...</textarea>
</label>
</fieldset>

<fieldset>
<legend>Backgrounds</legend>

<label>Personal Background:
<textarea name="personal">She/her, 25, Born in Brooklyn, NY...</textarea>
</label>

<label>Professional Background:
<textarea name="professional">I had quite a few food service jobs...</textarea>
</label>

<label>Academic Background:
<textarea name="academic">Lifelong student...</textarea>
</label>

<label>Background in this Subject:
<textarea name="background_subject">I've been using computers since I was 7...</textarea>
</label>

<label>Primary Computer Platform:
<input type="text" name="platform" value="ASUS gaming PC, Windows 11">
</label>
</fieldset>

<fieldset>
<legend>Image</legend>

<label>Image URL:
<input type="text" name="image" value="images/gudetamame.png">
</label>

<label>Caption:
<input type="text" name="caption" value="My Mood">
</label>
</fieldset>

<fieldset>
<legend>Courses</legend>

<label>Course 1:
<input type="text" name="courses[]" value="WEB250 - Database Driven Websites: Learning more about how databases are used for web development">
</label>

<label>Course 2:
<input type="text" name="courses[]" value="WEB215 - Adv Markup and Scripting: Learning more about creating interactive and accessible websites">
</label>

<label>Course 3:
<input type="text" name="courses[]">
</label>

<label>Course 4:
<input type="text" name="courses[]">
</label>

<label>Course 5:
<input type="text" name="courses[]">
</label>
</fieldset>

<fieldset>
<legend>Fun Fact</legend>

<label>Something funny or interesting:
<input type="text" name="funFact" value="I crochet and design my own clothing!">
</label>
</fieldset>

<button type="submit">Generate Introduction</button>
</form>
