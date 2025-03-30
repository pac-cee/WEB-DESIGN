<?php
/**
 * PHP INTERMEDIATE
 * This file covers intermediate PHP concepts
 * 
 * Topics covered:
 * - Working with strings
 * - Date and time handling
 * - Error handling
 * - File system operations
 * - Sessions and cookies
 * - Regular expressions
 * - Object-oriented programming basics
 * - Namespaces
 * - JSON and XML handling
 */

// ====================================
// WORKING WITH STRINGS
// ====================================

// String functions
$message = "Hello, World!";
echo strlen($message); // Length: 13
echo strtolower($message); // hello, world!
echo strtoupper($message); // HELLO, WORLD!
echo ucfirst("hello"); // Hello
echo ucwords("hello world"); // Hello World
echo strpos($message, "World"); // Position: 7 (zero-indexed)
echo substr($message, 0, 5); // Hello
echo str_replace("World", "PHP", $message); // Hello, PHP!
echo trim(" Hello "); // Removes whitespace from start and end

// String interpolation
$name = "John";
echo "Hello, $name!"; // Variables inside double quotes are parsed
echo 'Hello, $name!'; // Variables inside single quotes are not parsed
echo "Array element: {$array['key']}"; // Complex expressions need curly braces

// Heredoc (variables are parsed)
$text = <<<EOT
This is a multi-line string
using heredoc syntax.
Hello, $name!
EOT;

// Nowdoc (variables are not parsed, PHP 5.3+)
$text = <<<'EOT'
This is a multi-line string
using nowdoc syntax.
Hello, $name! (not parsed)
EOT;

// String comparison
$a = "hello";
$b = "hello";
var_dump($a == $b); // Equality check
var_dump(strcmp($a, $b)); // Returns 0 if equal
var_dump(strcasecmp($a, strtoupper($b))); // Case-insensitive comparison

// ====================================
// DATE AND TIME HANDLING
// ====================================

// Getting current time
echo time(); // Unix timestamp (seconds since Jan 1, 1970)
echo microtime(true); // Unix timestamp with microseconds

// Creating dates
$date = date("Y-m-d H:i:s"); // Formatted current date and time
$date = date("F j, Y, g:i a"); // e.g. March 10, 2023, 5:16 pm

// Date formats
// Y - Four digit year (e.g. 2023)
// y - Two digit year (e.g. 23)
// m - Month with leading zeros (01-12)
// n - Month without leading zeros (1-12)
// F - Full month name (e.g. January)
// M - Short month name (e.g. Jan)
// d - Day with leading zeros (01-31)
// j - Day without leading zeros (1-31)
// D - Short day name (e.g. Mon)
// l - Full day name (e.g. Monday)
// H - 24-hour format with leading zeros (00-23)
// h - 12-hour format with leading zeros (01-12)
// i - Minutes with leading zeros (00-59)
// s - Seconds with leading zeros (00-59)
// a - Lowercase am/pm
// A - Uppercase AM/PM

// Working with timestamps
$timestamp = strtotime("next Monday");
$timestamp = strtotime("+1 week");
$timestamp = strtotime("2023-12-31");
echo date("Y-m-d", $timestamp);

// DateTime object (PHP 5.2+)
$date = new DateTime(); // Current date/time
$date = new DateTime("2023-12-31 23:59:59");
$date->format("Y-m-d H:i:s");

// Adding/subtracting time
$date = new DateTime();
$date->modify("+1 day");
$date->modify("-2 hours");

// DateInterval (PHP 5.3+)
$date = new DateTime();
$interval = new DateInterval("P1Y2M3D"); // 1 year, 2 months, 3 days
$date->add($interval);
$date->sub($interval);

// Date differences
$date1 = new DateTime("2023-01-01");
$date2 = new DateTime("2024-06-15");
$diff = $date1->diff($date2);
echo "Difference: " . $diff->y . " years, " . $diff->m . " months, " . $diff->d . " days";

// Timezone handling
date_default_timezone_set("America/New_York");
$date = new DateTime();
$date->setTimezone(new DateTimeZone("Europe/London"));

// ====================================
// ERROR HANDLING
// ====================================

// Error reporting settings
error_reporting(E_ALL); // Report all errors
error_reporting(E_ALL & ~E_NOTICE); // All errors except notices
ini_set('display_errors', 1); // Display errors (for development)
ini_set('display_errors', 0); // Hide errors (for production)

// Custom error handler
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "Error [$errno] $errstr on line $errline in file $errfile";
    // Log error to file
    error_log("Error [$errno] $errstr on line $errline in file $errfile", 3, "error.log");
    return true; // Prevent standard PHP error handler
}
set_error_handler("customErrorHandler");

// Try-catch blocks
try {
    // Code that might throw an exception
    $file = fopen("non_existent_file.txt", "r");
    if (!$file) {
        throw new Exception("Failed to open file");
    }
} catch (Exception $e) {
    // Handle the exception
    echo "Caught exception: " . $e->getMessage();
    // Get stack trace
    echo $e->getTraceAsString();
} finally {
    // This code always runs
    echo "Process completed";
}

// Multiple catch blocks
try {
    // Code that might throw different exceptions
    if (rand(0, 1) == 0) {
        throw new InvalidArgumentException("Invalid argument");
    } else {
        throw new RuntimeException("Runtime error");
    }
} catch (InvalidArgumentException $e) {
    echo "Invalid argument: " . $e->getMessage();
} catch (RuntimeException $e) {
    echo "Runtime error: " . $e->getMessage();
} catch (Exception $e) {
    echo "General exception: " . $e->getMessage();
}

// Creating custom exceptions
class DatabaseException extends Exception {
    public function errorMessage() {
        return "Database error: " . $this->getMessage();
    }
}

try {
    throw new DatabaseException("Connection failed");
} catch (DatabaseException $e) {
    echo $e->errorMessage();
}

// ====================================
// FILE SYSTEM OPERATIONS
// ====================================

// Reading files
$contents = file_get_contents("example.txt"); // Read entire file
$lines = file("example.txt"); // Read file into array (one line per element)

// Reading files line by line (memory efficient)
$handle = fopen("large_file.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // Process $line
        echo $line;
    }
    fclose($handle);
}

// Writing to files
file_put_contents("output.txt", "Hello World"); // Write string to file
file_put_contents("output.txt", "More text", FILE_APPEND); // Append to file

// Advanced file operations
$handle = fopen("data.txt", "w"); // "w" for write, "r" for read, "a" for append
fwrite($handle, "Line 1\n");
fwrite($handle, "Line 2\n");
fclose($handle);

// File and directory operations
file_exists("example.txt"); // Check if file exists
is_file("example.txt"); // Check if it's a file
is_dir("directory"); // Check if it's a directory
filesize("example.txt"); // Get file size in bytes
filectime("example.txt"); // Creation time (as Unix timestamp)
filemtime("example.txt"); // Modification time
copy("source.txt", "destination.txt"); // Copy a file
rename("old.txt", "new.txt"); // Rename or move a file
unlink("file.txt"); // Delete a file
chmod("file.txt", 0644); // Change file permissions

// Directory operations
mkdir("new_directory", 0755); // Create directory
rmdir("old_directory"); // Remove empty directory
chdir("../parent_directory"); // Change current directory
getcwd(); // Get current directory

// Scanning directories
$files = scandir("directory"); // Get all files and directories
// or
$dir = opendir("directory");
while (($file = readdir($dir)) !== false) {
    echo $file . "<br>";
}
closedir($dir);

// Recursively scanning directories
function listAllFiles($dir) {
    $result = [];
    $files = scandir($dir);
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        
        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            $result = array_merge($result, listAllFiles($path));
        } else {
            $result[] = $path;
        }
    }
    
    return $result;
}

// ====================================
// SESSIONS AND COOKIES
// ====================================

// Working with sessions
session_start(); // Initialize session
$_SESSION["username"] = "john_doe"; // Set session variable
$username = $_SESSION["username"] ?? "Guest"; // Get session variable
unset($_SESSION["username"]); // Remove specific session variable
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
session_regenerate_id(true); // Generate new session ID (for security)

// Session configuration
ini_set('session.cookie_lifetime', 3600); // Session cookie lifetime in seconds
ini_set('session.gc_maxlifetime', 3600); // Session garbage collection lifetime

// Custom session handler
class DatabaseSessionHandler implements SessionHandlerInterface {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function open($savePath, $sessionName) {
        return true;
    }
    
    public function close() {
        return true;
    }
    
    public function read($id) {
        // Read session data from database
        // Return session data as string
    }
    
    public function write($id, $data) {
        // Write session data to database
    }
    
    public function destroy($id) {
        // Delete session data from database
    }
    
    public function gc($maxlifetime) {
        // Delete expired sessions from database
    }
}

// To use custom session handler:
// $handler = new DatabaseSessionHandler($db);
// session_set_save_handler($handler, true);
// session_start();

// Working with cookies
setcookie("user", "john", time() + 3600); // Set cookie (name, value, expiry)
setcookie("user", "john", time() + 3600, "/", "example.com", true, true); // With path, domain, secure, httponly
$user = $_COOKIE["user"] ?? "Guest"; // Get cookie value
setcookie("user", "", time() - 3600); // Delete cookie by setting expiry in the past

// ====================================
// REGULAR EXPRESSIONS
// ====================================

// Pattern matching
$string = "The quick brown fox jumps over the lazy dog";
if (preg_match("/fox/", $string)) {
    echo "Pattern found!";
}

// Pattern matching with capture groups
preg_match("/quick (.*?) fox/", $string, $matches);
echo $matches[0]; // Full match: "quick brown fox"
echo $matches[1]; // Capture group: "brown"

// Find all matches
preg_match_all("/[a-z]{5}/", $string, $matches);
print_r($matches[0]); // Array of all 5-letter words

// Search and replace
$newString = preg_replace("/fox/", "cat", $string);
// Multiple replacements
$newString = preg_replace(["/fox/", "/dog/"], ["cat", "rabbit"], $string);

// Complex pattern with modifiers
$pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i";
// ^ and $ match start and end of string
// i modifier makes it case-insensitive
if (preg_match($pattern, "user@example.com")) {
    echo "Valid email!";
}

// Common regex modifiers
// i - Case insensitive
// m - Multiline (^ and $ match start/end of line)
// s - Dot matches newlines
// x - Ignore whitespace in pattern
// u - Unicode support

// Common regex patterns
$patterns = [
    'email' => "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i",
    'url' => "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/",
    'ip' => "/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/",
    'date' => "/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/" // YYYY-MM-DD
];

// ====================================
// OBJECT-ORIENTED PROGRAMMING BASICS
// ====================================

// Class definition
class User {
    // Properties (class variables)
    public $username;
    private $password;
    protected $email;
    public static $userCount = 0;
    
    // Constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    
    // Constructor
    public function __construct($username, $password, $email) {
        $this->username = $username;
        $this->password = $this->hashPassword($password);
        $this->email = $email;
        self::$userCount++; // Access static property
    }
    
    // Destructor
    public function __destruct() {
        // Clean up code
        self::$userCount--;
    }
    
    // Private method
    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    // Public method
    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
    
    // Getter method
    public function getEmail() {
        return $this->email;
    }
    
    // Setter method
    public function setEmail($email) {
        $this->email = $email;
    }
    
    // Static method
    public static function getUserCount() {
        return self::$userCount;
    }
}

// Using the class
$user = new User("john_doe", "secret123", "john@example.com");
echo $user->username; // Public property access
echo $user->getEmail(); // Access protected property via getter
$user->setEmail("new_email@example.com"); // Set protected property via setter
echo User::$userCount; // Access static property
echo User::getUserCount(); // Call static method
echo User::STATUS_ACTIVE; // Access constant

// Inheritance
class Admin extends User {
    private $role;
    
    public function __construct($username, $password, $email, $role) {
        parent::__construct($username, $password, $email); // Call parent constructor
        $this->role = $role;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    // Override parent method
    public function getEmail() {
        return "Admin email: " . parent::getEmail(); // Call parent method
    }
}

// Abstract classes and methods
abstract class Vehicle {
    protected $brand;
    
    public function __construct($brand) {
        $this->brand = $brand;
    }
    
    // Abstract method (must be implemented by child classes)
    abstract public function calculateMileage();
    
    // Regular method
    public function getBrand() {
        return $this->brand;
    }
}

class Car extends Vehicle {
    private $fuel;
    private $distance;
    
    public function __construct($brand, $fuel, $distance) {
        parent::__construct($brand);
        $this->fuel = $fuel;
        $this->distance = $distance;
    }
    
    // Implement abstract method
    public function calculateMileage() {
        return $this->distance / $this->fuel;
    }
}

// Interfaces
interface PaymentProcessor {
    public function processPayment($amount);
    public function refundPayment($transactionId);
}

class StripeProcessor implements PaymentProcessor {
    public function processPayment($amount) {
        // Implementation
        return "Stripe payment of $amount processed";
    }
    
    public function refundPayment($transactionId) {
        // Implementation
        return "Stripe payment $transactionId refunded";
    }
}

class PayPalProcessor implements PaymentProcessor {
    public function processPayment($amount) {
        // Implementation
        return "PayPal payment of $amount processed";
    }
    
    public function refundPayment($transactionId) {
        // Implementation
        return "PayPal payment $transactionId refunded";
    }
}

// Traits (PHP 5.4+)
trait Loggable {
    protected function log($message) {
        echo "[" . date("Y-m-d H:i:s") . "] " . $message;
    }
}

trait Debuggable {
    public function debug($data) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}

class ApiClient {
    use Loggable, Debuggable; // Use multiple traits
    
    public function request($url) {
        $this->log("Requesting: $url");
        $data = file_get_contents($url);
        $this->debug($data);
        return $data;
    }
}

// Magic methods
class MagicDemo {
    private $data = [];
    
    // Called when accessing inaccessible or non-existent properties
    public function __get($name) {
        return $this->data[$name] ?? null;
    }
    
    // Called when writing to inaccessible or non-existent properties
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    // Called when checking if inaccessible or non-existent properties isset() or empty()
    public function __isset($name) {
        return isset($this->data[$name]);
    }
    
    // Called when unset() is used on inaccessible or non-existent properties
    public function __unset($name) {
        unset($this->data[$name]);
    }
    
    // Called when object is used as a string
    public function __toString() {
        return json_encode($this->data);
    }
    
    // Called when object is used as a function
    public function __invoke($arg) {
        return "Invoked with: $arg";
    }
    
    // Called when cloning an object
    public function __clone() {
        // Modify properties if needed after cloning
    }
    
    // Called after serialization
    public function __sleep() {
        // Return array of property names to serialize
        return ['data'];
    }
    
    // Called after unserialization
    public function __wakeup() {
        // Restore any resources or connections
    }
}

// ====================================
// NAMESPACES
// ====================================

// Define a namespace (should be at the top of the file)
namespace App\Services;

// Define class in namespace
class UserService {
    public function getUsers() {
        return "Getting users...";
    }
}

// Using classes from namespaces
$userService = new \App\Services\UserService();
echo $userService->getUsers();

// Importing namespaces with use
use App\Services\UserService;
$userService = new UserService();

// Importing with alias
use App\Services\UserService as US;
$userService = new US();

// Importing multiple classes
use App\Services\{UserService, ProductService, OrderService};

// Sub-namespaces
namespace App\Services\Auth;

class AuthService {
    // ...
}

// Global namespace
namespace {
    // Global code
    $obj = new \App\Services\UserService();
}

// ====================================