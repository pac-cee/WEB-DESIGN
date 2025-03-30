<?php
/**
 * PHP BASICS
 * This file covers fundamental PHP concepts for beginners
 * 
 * Topics covered:
 * - Syntax and basic structure
 * - Variables and data types
 * - Operators
 * - Control structures
 * - Functions
 * - Arrays
 * - Form handling
 */

// ====================================
// SYNTAX AND BASIC STRUCTURE
// ====================================

// PHP code is enclosed in <?php ?> tags
// Statements end with semicolons

// Output methods
echo "Hello World!"; // Outputs strings or numbers
print("Hello World!"); // Similar to echo but returns 1
var_dump("Hello"); // Outputs type and value (useful for debugging)

// Comments
// Single line comment
# Alternative single line comment
/*
   Multi-line
   comment
*/

// ====================================
// VARIABLES AND DATA TYPES
// ====================================

// Variables start with $ followed by name
$name = "John"; // String
$age = 25; // Integer
$height = 6.2; // Float
$isActive = true; // Boolean
$user = null; // Null

// Variable naming conventions
$firstName; // camelCase (recommended)
$first_name; // snake_case
$FirstName; // PascalCase

// Constants
define("PI", 3.14159);
const DATABASE_NAME = "my_app"; // Alternative constant definition

// Data type checking
echo gettype($name); // Returns the type as string
var_dump($name); // Outputs type and value
is_string($name); // Type-specific check, returns boolean

// Type casting
$numString = "42";
$num = (int)$numString; // Cast to integer
$stringNum = (string)$num; // Cast to string

// ====================================
// OPERATORS
// ====================================

// Arithmetic operators
$a = 10;
$b = 3;
echo $a + $b; // Addition: 13
echo $a - $b; // Subtraction: 7
echo $a * $b; // Multiplication: 30
echo $a / $b; // Division: 3.33...
echo $a % $b; // Modulus (remainder): 1
echo $a ** $b; // Exponentiation: 1000

// Assignment operators
$c = 5; // Basic assignment
$c += 3; // $c = $c + 3; (value becomes 8)
$c -= 2; // $c = $c - 2; (value becomes 6)
$c *= 2; // $c = $c * 2; (value becomes 12)
$c /= 4; // $c = $c / 4; (value becomes 3)
$c %= 2; // $c = $c % 2; (value becomes 1)

// Comparison operators
$a == $b; // Equal (value)
$a === $b; // Identical (value and type)
$a != $b; // Not equal
$a !== $b; // Not identical
$a > $b; // Greater than
$a >= $b; // Greater than or equal to
$a < $b; // Less than
$a <= $b; // Less than or equal to
$a <=> $b; // Spaceship operator (returns -1, 0, or 1)

// Logical operators
$x && $y; // Logical AND
$x || $y; // Logical OR
!$x; // Logical NOT
$x and $y; // Alternative AND (lower precedence)
$x or $y; // Alternative OR (lower precedence)
$x xor $y; // Exclusive OR

// String operators
$greeting = "Hello";
$fullGreeting = $greeting . " World!"; // Concatenation
$greeting .= " World!"; // Concatenation assignment

// ====================================
// CONTROL STRUCTURES
// ====================================

// If-else statements
$score = 85;

if ($score >= 90) {
    echo "Grade: A";
} elseif ($score >= 80) {
    echo "Grade: B";
} elseif ($score >= 70) {
    echo "Grade: C";
} else {
    echo "Grade: D";
}

// Switch statement
$day = "Monday";

switch ($day) {
    case "Monday":
        echo "Start of work week";
        break;
    case "Friday":
        echo "End of work week";
        break;
    case "Saturday":
    case "Sunday":
        echo "Weekend";
        break;
    default:
        echo "Regular work day";
}

// Ternary operator
$age = 20;
$status = ($age >= 18) ? "Adult" : "Minor";

// Null coalescing operator (PHP 7+)
$username = $_GET['username'] ?? "Guest";

// Loops
// For loop
for ($i = 1; $i <= 5; $i++) {
    echo "Iteration: $i<br>";
}

// While loop
$counter = 1;
while ($counter <= 5) {
    echo "Counter: $counter<br>";
    $counter++;
}

// Do-while loop
$num = 1;
do {
    echo "Number: $num<br>";
    $num++;
} while ($num <= 5);

// Foreach loop (for arrays)
$colors = ["red", "green", "blue"];
foreach ($colors as $color) {
    echo "Color: $color<br>";
}

// Foreach with key => value
$person = [
    "name" => "John",
    "age" => 30,
    "job" => "Developer"
];
foreach ($person as $key => $value) {
    echo "$key: $value<br>";
}

// Loop control
for ($i = 1; $i <= 10; $i++) {
    if ($i == 3) continue; // Skip this iteration
    if ($i == 8) break; // Exit the loop
    echo $i;
}

// ====================================
// FUNCTIONS
// ====================================

// Basic function
function sayHello() {
    echo "Hello!";
}
sayHello(); // Call the function

// Function with parameters
function greet($name) {
    echo "Hello, $name!";
}
greet("Maria"); // Output: Hello, Maria!

// Function with default parameter
function greetPerson($name = "Guest") {
    echo "Hello, $name!";
}
greetPerson(); // Output: Hello, Guest!
greetPerson("Alex"); // Output: Hello, Alex!

// Return values
function add($a, $b) {
    return $a + $b;
}
$sum = add(5, 3); // $sum = 8

// Type declarations (PHP 7+)
function multiply(int $a, int $b): int {
    return $a * $b;
}

// Variable-length parameter lists
function sum(...$numbers) {
    return array_sum($numbers);
}
echo sum(1, 2, 3, 4); // Output: 10

// Passing by reference
function addFive(&$num) {
    $num += 5;
}
$value = 10;
addFive($value); // $value becomes 15

// Anonymous functions (closures)
$multiply = function($a, $b) {
    return $a * $b;
};
echo $multiply(4, 5); // Output: 20

// Arrow functions (PHP 7.4+)
$multiply = fn($a, $b) => $a * $b;

// ====================================
// ARRAYS
// ====================================

// Indexed arrays
$fruits = ["Apple", "Banana", "Cherry"];
echo $fruits[0]; // Output: Apple

// Creating arrays
$numbers = array(1, 2, 3, 4, 5); // Traditional way
$colors = ["Red", "Green", "Blue"]; // Short syntax (PHP 5.4+)

// Associative arrays (key-value pairs)
$user = [
    "name" => "John",
    "email" => "john@example.com",
    "age" => 30
];
echo $user["email"]; // Output: john@example.com

// Multidimensional arrays
$contacts = [
    ["name" => "John", "phone" => "1234567890"],
    ["name" => "Jane", "phone" => "0987654321"],
    ["name" => "Bob", "phone" => "5555555555"]
];
echo $contacts[1]["name"]; // Output: Jane

// Common array functions
$numbers = [3, 1, 4, 1, 5];
sort($numbers); // Sort in ascending order
rsort($numbers); // Sort in descending order
count($numbers); // Count elements
array_push($numbers, 9); // Add to end
array_pop($numbers); // Remove from end
array_unshift($numbers, 0); // Add to beginning
array_shift($numbers); // Remove from beginning
array_sum($numbers); // Sum of elements
in_array(3, $numbers); // Check if value exists
array_key_exists("name", $user); // Check if key exists

// ====================================
// FORM HANDLING
// ====================================

// Handling GET requests
// URL: page.php?name=John&age=25
$name = $_GET["name"] ?? ""; // Using null coalescing operator
$age = $_GET["age"] ?? 0;

// Handling POST requests
// <form method="post" action="process.php">
//   <input type="text" name="username">
//   <input type="password" name="password">
//   <button type="submit">Submit</button>
// </form>
$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

// Processing form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if ($email) {
        // Valid email
        echo "Thank you for submitting: $email";
    } else {
        // Invalid email
        echo "Please enter a valid email address";
    }
}

// File uploads
if (isset($_FILES["upload"])) {
    $fileName = $_FILES["upload"]["name"];
    $tempPath = $_FILES["upload"]["tmp_name"];
    $fileSize = $_FILES["upload"]["size"];
    $fileType = $_FILES["upload"]["type"];
    $error = $_FILES["upload"]["error"];
    
    // Check for errors
    if ($error === 0) {
        // Move the file to a permanent location
        move_uploaded_file($tempPath, "uploads/" . $fileName);
        echo "File uploaded successfully!";
    }
}

// Form security
// Prevent XSS (Cross-Site Scripting)
$userInput = htmlspecialchars($_POST["comment"] ?? "");

// CSRF (Cross-Site Request Forgery) protection
session_start();
$token = md5(uniqid(rand(), true));
$_SESSION["csrf_token"] = $token;
// In your form: <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
// Then verify: if ($_POST["csrf_token"] == $_SESSION["csrf_token"]) { /* Process form */ }
?>
