<style>
    /* Form container */
#fizzForm {
  background-color: #fcfffd; /* baby-powder */
  padding: 25px;
  border-radius: 12px;
  max-width: 720px;
  margin: 25px auto;
  box-shadow: 0 6px 12px rgba(0,0,0,0.1);
  text-align: left;
}

/* Each row is a flex container */
#fizzForm .form-row {
  display: flex;
  justify-content: flex-start; /* align fields to start */
  flex-wrap: wrap;             /* allow wrapping if too wide */
  margin-bottom: 16px;
  gap: 16px;                   /* spacing between fields */
}

/* All field groups */
#fizzForm .field-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
  flex: 0 0 auto;              /* don’t stretch to fill row */
}

/* Labels */
#fizzForm .field-group label {
  font-weight: bold;
  color: #5d737e;
  font-size: 14px;
}

/* Inputs: all narrower */
#fizzForm .field-group input {
  max-width: 120px;            /* prevents overflow */
  padding: 5px 5px;
  border: 1px solid #5d737e;
  border-radius: 6px;
  font-size: 14px;
  background-color: #daffef;
  color: #5d737e;
  transition: border 0.3s ease, box-shadow 0.3s ease;
}

#fizzForm .field-group input:focus {
  border-color: #64b6ac;
  box-shadow: 0 0 4px #64b6ac;
  outline: none;
}

/* Button */
#fizzForm button[type="button"] {
  margin-top: 20px;
  background-color: #5d737e;
  color: #daffef;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

#fizzForm button[type="button"]:hover {
  background-color: #64b6ac;
}

/* Output containers */
#output,
#results {
  margin-top: 20px;
  font-family: "Open Sans", sans-serif;
  color: #5d737e;
  line-height: 1.5;
}

/* Mobile: stack fields */
@media (max-width: 700px) {
  #fizzForm .form-row {
    flex-direction: column;
  }
  #fizzForm .field-group {
    flex: 1 1 100%;
    max-width: 100%;
  }
}


</style>

<h2>FizzBuzz Generator</h2>

<form id="fizzForm">
    <div class="form-row">

        <div class="field-group">
            <label>First Name</label>
            <input type="text" id="first" value="Daring" required>
        </div>

        <div class="field-group">
            <label>Middle Initial</label>
            <input type="text" id="middle" maxlength="1">
        </div>

        <div class="field-group">
            <label>Last Name</label>
            <input type="text" id="last" value = "Tiger" required>
        </div>

        <div class="field-group">
            <label>Default Word</label>
            <input type="text" id="defaultWord" value="Lovely">
        </div>
    </div>
    <div class="form-row">
        <div class="field-group">
            <label>Count</label>
            <input type="number" id="count" value="111" min="1">
        </div>

        <div></div> <!-- empty cell to keep spacing -->


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
            <input type="text" id="word3" value="Lily">
        </div>
    </div>

    <div class="form-row">
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


    <button type="button" onclick="fizzBuzz()">Run FizzBuzz</button>
</form>



<div id="output"></div>


<div id="results"></div>

<!-- Load external script -->
<script src="./scripts/fizzbuzz.js"></script>