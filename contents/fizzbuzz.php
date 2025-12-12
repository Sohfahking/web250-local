
    <h1>FizzBuzz!</h1>

    <div class="form-container">
    <h2 class="centered">FizzBuzz Project</h2>

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
                <input type="text" id="defaultWord" value="">
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

        <button type="button" onclick="fizzBuzz()">Run FizzBuzz</button>
    </form>
</div>


<div id="output"></div>


    <div id="results"></div>

    <!-- Load external script -->
    <script src="/scripts/fizzbuzz.js"></script>
