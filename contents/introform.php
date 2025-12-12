<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Index/Home">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Dajabre Torain">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Link to CSS file(s) -->
    <link rel="stylesheet" href="styles/default.css">

    <title> Dajabre Torain's Daring Tiger | WEB215 |Introduction</title>

    <!-- Dynamic header/footer JS -->
    <script src="scripts/components215.js" defer></script>

    <script src="https://lint.page/kit/6664c1.js" crossorigin="anonymous"></script>

    <style>


/* ------------------ Form Styling ------------------ */
form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

fieldset {
  border: 2px solid var(--reseda-green);
  border-radius: 8px;
  padding: 15px;
  background-color: var(--flax);
}

legend {
  font-weight: bold;
  padding: 0 10px;
  color: var(--smoky-black);
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
  border: 1px solid var(--reseda-green);
  border-radius: 5px;
  font-size: 1rem;
  width: 100%;
  box-sizing: border-box;
}

textarea {
  resize: vertical;
}

button[type="submit"] {
  background-color: var(--reseda-green);
  color: var(--smoky-black);
  font-weight: bold;
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
  align-self: flex-start;
}

button[type="submit"]:hover {
  background-color: var(--icterine);
  transform: scale(1.05);
}

/* Smaller note for extra courses */
form p {
  font-size: 0.85rem;
  color: var(--smoky-black);
  margin-top: 5px;
}

/* Optional: make fieldsets stack nicely on mobile */
@media (max-width: 600px) {
  fieldset {
    padding: 10px;
  }
  
  button[type="submit"] {
    width: 100%;
  }
}

    </style>
</head>

<body>
    <header></header>
    <main>
        <h2>Introduction Form</h2>

        <form action="introprocess.php" method="post" enctype="multipart/form-data"
            style="max-width:800px; margin:0 auto;">

            <fieldset>
                <legend>Your Information</legend>
                <label>First Name:
                    <input type="text" name="first" value="Dajabre" required>
                </label>
                <label>Middle Initial:
                    <input type="text" name="middle" maxlength="1" value="">
                </label>

                <label>Last Name:
                    <input type="text" name="last" value="Torain-Williams" required>
                </label>
                <label>About You:
                    <textarea name="about" rows="4"
                        required>My name is Dajabre and this is my last semester at CPCC. I am working full time as a customer care agent for an Internet Service Provider (ISP). I enjoy watching anime, crocheting, manual QA testing for code, and sometimes, playing video games.</textarea>
                </label>
            </fieldset>

            <fieldset>
                <legend>Backgrounds</legend>
                <label>Personal Background:
                    <textarea name="personal"
                        rows="2">She/her, 25, Born in Brooklyn, NY. Raised in Charlotte, NC. I have 2 dogs and 1 cat (Tokoyami and Nami, Clove). I love gaming, anime, and crocheting.</textarea>
                </label>
                <label>Professional Background:
                    <textarea name="professional"
                        rows="2">I had quite a few food service jobs before starting on the path of being an IT professional. Aiming for a software QA role or Pharmacy Technician.</textarea>
                </label>
                <label>Academic Background:
                    <textarea name="academic"
                        rows="2">Lifelong Student; Studied psychology before choosing IT/ Computer Science. Hoping to graduate AAS in IT by Fall 2025</textarea>
                </label>
                <label>Background in this Subject:
                    <textarea name="background_subject"
                        rows="2">I've been using computers since I was 7. From learning to burn Fantasia & Destiny’s Child CD’s to designing my own Tumblr page using HTML & CSS</textarea>
                </label>
                <label>Primary Computer Platform:
                    <input type="text" name="platform"
                        value="ASUS gaming PC, Desktop, Windows 11, home office/ladies’ den">
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
                    <input type="text" name="courses[]"
                        value="WEB250 - Database Driven Websites: Learning more about how databases are used for web development">
                </label>
                <label>Course 2:
                    <input type="text" name="courses[]"
                        value="WEB215 - Adv Markup and Scripting: Learning more about creating interactive and accessible websites">
                </label>
                <label>Course 3:
                    <input type="text" name="courses[]" value="">
                </label>
                <label>Course 4:
                    <input type="text" name="courses[]" value="">
                </label>
                <label>Course 5:
                    <input type="text" name="courses[]" value="">
                </label>
                <p style="font-size:0.9em; color:#555;">(Leave extra course fields blank if not needed.)</p>
            </fieldset>

            <fieldset>
                <legend>Fun Fact</legend>
                <label>Something funny or interesting:
                    <input type="text" name="funFact" value="I crochet and design my own clothing!">
                </label>
            </fieldset>

            <button type="submit">Generate Introduction</button>
        </form>
    </main>
    <footer></footer>
</body>

</html>