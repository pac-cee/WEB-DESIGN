<?php
/**
 * PHP BASICS DEMO
 * - Syntax fundamentals
 * - Variable handling
 * - Basic operations
 */

// Strict error reporting
declare(strict_types=1);

// 1. Variables and Output
$message = "Hello, PHP Basics!";
echo "<h1>$message</h1>";

// 2. Conditional Logic
$temperature = 22;
if ($temperature > 25) {
    echo "<p>It's warm!</p>";
} elseif ($temperature > 15) {
    echo "<p>Comfortable weather</p>";
} else {
    echo "<p>It's chilly!</p>";
}

// 3. Loops and Arrays
$colors = ['red', 'green', 'blue'];
echo "<ul>";
foreach ($colors as $color) {
    echo "<li>$color</li>";
}
echo "</ul>";
?>