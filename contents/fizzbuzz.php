<style>
/* Brand colors  */
:root {
  --paynes-gray: #5d737e;
  --verdigris: #64b6ac;
  --mint-green: #daffef;
  --baby-powder: #fcfffd;
}

/* Form container */
#fizzForm {
  background-color: #fcfffd; 
  padding: 25px;
  border-radius: 12px;
  max-width: 720px;
  margin: 25px auto;
  box-shadow: 0 6px 12px rgba(0,0,0,0.1);
  text-align: left;
}


#fizzForm .form-grid {
  display:flex;
  flex-wrap: wrap;       /* allow items to go to next row */
  gap: 16px;             /* spacing between items */
  margin-top: 20px;
}

/* Make each field group take 1/3 of the width */
#fizzForm .field-group {
  flex: 1 1 calc(33.333% - 16px);  /* 3 columns with spacing */
  display: inlinflex;
  flex-direction: column;
  gap: 6px;
  box-sizing: border-box;
}

/* Responsive: collapse to single column on small screens */
@media (max-width: 700px) {
  #fizzForm .field-group {
    flex: 1 1 100%;
  }
}

/* Labels */
#fizzForm .field-group label {
  font-weight: bold;
  color: #5d737e; /* paynes-gray */
  font-size: 14px;
}

/* Inputs */
#fizzForm .field-group input {
  padding: 8px 10px;
  border: 1px solid #5d737e;
  border-radius: 6px;
  font-size: 14px;
  background-color: #daffef; /* mint-green */
  color: #5d737e;
  transition: border 0.3s ease, box-shadow 0.3s ease;
}

/* Focus outline only */
#fizzForm .field-group input:focus {
  border-color: #64b6ac; /* verdigris */
  box-shadow: 0 0 4px #64b6ac;
  outline: none;
}

/* Button */
#fizzForm button[type="button"] {
  margin-top: 20px;
  background-color: #5d737e; /* paynes-gray */
  color: #daffef; /* mint-green */
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
</style>


    <h2>FizzBuzz Project</h2>

    <form id="fizzForm">
        <div class="form-grid">

            <!-- Row 1: Names -->
            <div class="field-group">
                <label>First Name</label>
                <input type="text" id="first" value="Daring" required>
            </div>

            <div class="field-group">
                <label>Middle Initial</label>
                <input type="text" id="middle" value ="H" maxlength="1">
            </div>

            <div class="field-group">
                <label>Last Name</label>
                <input type="text" id="last" value="Tiger" required>
            </div>

            <!-- Row 2: Default + Count -->
            <div class="field-group">
                <label>Default Word</label>
                <input type="text" id="defaultWord" value="Bubble">
            </div>

            <div class="field-group">
                <label>Count</label>
                <input type="number" id="count" value="111" min="1">
            </div>

            <div></div> <!-- empty cell to keep spacing -->

            <!-- Row 3: Words -->
            <div class="field-group">
                <label>Word 1</label>
                <input type="text" id="word1" value="Blue">
            </div>

            <div class="field-group">
                <label>Word 2</label>
                <input type="text" id="word2" value="Water">
            </div>

            <div class="field-group">
                <label>Word 3</label>
                <input type="text" id="word3" value="Lilly">
            </div>

            <!-- Row 4: Divisors -->
            <div class="field-group">
                <label>Divisor 1</label>
                <input type="number" id="div1" value="3">
            </div>

            <div class="field-group">
                <label>Divisor 2</label>
                <input type="number" id="div2" value="5">
            </div>

            <div class="field-group">
                <label>Divisor 3</label>
                <input type="number" id="div3" value="7">
            </div>
        </div>

        <button type="button" onclick="fizzBuzz()">FizzBuzz Ready!</button>
    </form>



<div id="output"></div>


    <div id="results"></div>

    <!-- Load external script -->
    <script src="/web250-local/scripts/fizzbuzz.js"></script>
