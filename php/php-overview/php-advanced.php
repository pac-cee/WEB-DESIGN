<?php
/**
 * PHP ADVANCED
 * This file covers advanced PHP concepts
 * 
 * Topics covered:
 * - Generators and iterators
 * - Closures and anonymous functions
 * - Reflection API
 * - Dependency injection
 * - Design patterns
 * - Working with streams
 * - Performance optimization
 * - Security best practices
 */

// ====================================
// GENERATORS AND ITERATORS
// ====================================

// Generators (PHP 5.5+)
// Memory-efficient way to iterate over large datasets
function getRange($start, $end) {
    for ($i = $start; $i <= $end; $i++) {
        yield $i;
    }
}

foreach (getRange(1, 1000000) as $number) {
    echo $number . " ";
    if ($number > 10) break;
}

// Generator with key-value pairs
function getKeyValues() {
    yield 'key1' => 'value1';
    yield 'key2' => 'value2';
    yield 'key3' => 'value3';
}

foreach (getKeyValues() as $key => $value) {
    echo "$key: $value<br>";
}

// Yielding from another generator or traversable (PHP 7+)
function innerGenerator() {
    yield 1;
    yield 2;
}

function outerGenerator() {
    yield 0;
    yield from innerGenerator(); // Yields 1, 2
    yield 3;
}

// Generator delegation
function count_to_ten() {
    yield 1;
    yield 2;
    yield from [3, 4, 5];
    yield from new ArrayIterator([6, 7]);
    yield from eight_nine_ten();
}

function eight_nine_ten() {
    yield 8;
    yield 9;
    yield 10;
}

// Sending values to generators
function logger() {
    while (true) {
        $message = yield;
        echo date('Y-m-d H:i:s') . ": $message<br>";
    }
}

$logger = logger();
$logger->send('Log entry 1');
$logger->send('Log entry 2');

// Returning values from generators (PHP 7+)
function getValues() {
    yield 'a' => 1;
    yield 'b' => 2;
    
    return "Generator finished";
}

$generator = getValues();
foreach ($generator as $key => $value) {
    echo "$key: $value<br>";
}
echo $generator->getReturn(); // "Generator finished"

// Custom iterators
class MyIterator implements Iterator {
    private $position = 0;
    private $array = ['first', 'second', 'third'];
    
    public function rewind() {
        $this->position = 0;
    }
    
    public function current() {
        return $this->array[$this->position];
    }
    
    public function key() {
        return $this->position;
    }
    
    public function next() {
        ++$this->position;
    }
    
    public function valid() {
        return isset($this->array[$this->position]);
    }
}

$iterator = new MyIterator();
foreach ($iterator as $key => $value) {
    echo "$key: $value<br>";
}

// SPL iterators
// DirectoryIterator
$dir = new DirectoryIterator('/path/to/directory');
foreach ($dir as $fileInfo) {
    if ($fileInfo->isFile()) {
        echo $fileInfo->getFilename() . "<br>";
    }
}

// RecursiveDirectoryIterator
$dir = new RecursiveDirectoryIterator('/path/to/directory');
$iterator = new RecursiveIteratorIterator($dir);
foreach ($iterator as $fileInfo) {
    if ($fileInfo->isFile()) {
        echo $fileInfo->getPathname() . "<br>";
    }
}

// ArrayIterator
$array = ['apple', 'banana', 'cherry'];
$iterator = new ArrayIterator($array);
while ($iterator->valid()) {
    echo $iterator->current() . "<br>";
    $iterator->next();
}

// FilterIterator
class OddNumbersFilter extends FilterIterator {
    public function accept() {
        return $this->current() % 2 !== 0;
    }
}

$numbers = new ArrayIterator([1, 2, 3, 4, 5, 6]);
$oddNumbers = new OddNumbersFilter($numbers);
foreach ($oddNumbers as $number) {
    echo $number . "<br>"; // 1, 3, 5
}

// ====================================
// CLOSURES AND ANONYMOUS FUNCTIONS
// ====================================

// Anonymous functions
$greet = function($name) {
    return "Hello, $name!";
};
echo $greet("John"); // Hello, John!

// Closures with 'use' keyword
$message = "Welcome";
$greet = function($name) use ($message) {
    return "$message, $name!";
};
echo $greet("John"); // Welcome, John!

// Modifying variables with 'use' by reference
$counter = 0;
$increment = function() use (&$counter) {
    $counter++;
};
$increment();
$increment();
echo $counter; // 2

// Arrow functions (PHP 7.4+)
$multiply = fn($a, $b) => $a * $b;
echo $multiply(5, 3); // 15

// Implicit variable access in arrow functions
$factor = 2;
$multiply = fn($num) => $num * $factor; // $factor is implicitly captured
echo $multiply(5); // 10

// Function currying
function curry($function, ...$args) {
    return function(...$moreArgs) use ($function, $args) {
        return $function(...array_merge($args, $moreArgs));
    };
}

function add($a, $b, $c) {
    return $a + $b + $c;
}

$add5 = curry('add', 5);
$add5and10 = curry($add5, 10);
echo $add5and10(15); // 30

// Using closures with array functions
$numbers = [1, 2, 3, 4, 5];
$doubled = array_map(function($n) { return $n * 2; }, $numbers);
$filtered = array_filter($numbers, function($n) { return $n % 2 === 0; });
$sum = array_reduce($numbers, function($carry, $n) { return $carry + $n; }, 0);

// Callable type hint
function process(callable $callback, $value) {
    return $callback($value);
}
echo process(function($n) { return $n * 2; }, 5); // 10

// Closure::bind() and Closure::bindTo()
class A {
    private $value = 1;
}

$getPrivate = function() {
    return $this->value;
};

$getA = $getPrivate->bindTo(new A, 'A'); // Bind to A instance and scope
echo $getA(); // 1

// ====================================
// REFLECTION API
// ====================================

// Reflecting on classes
$reflectionClass = new ReflectionClass('DateTime');
echo $reflectionClass->getName();
var_dump($reflectionClass->isAbstract());
var_dump($reflectionClass->isFinal());
var_dump($reflectionClass->isInstantiable());

// Get class methods
$methods = $reflectionClass->getMethods();
foreach ($methods as $method) {
    echo $method->getName() . "<br>";
}

// Get specific method
$method = $reflectionClass->getMethod('format');
echo $method->getName();
var_dump($method->isPublic());
var_dump($method->isStatic());

// Get method parameters
$params = $method->getParameters();
foreach ($params as $param) {
    echo $param->getName();
    echo $param->isOptional() ? " (optional)" : " (required)";
    echo "<br>";
}

// Reflecting on functions
$reflectionFunction = new ReflectionFunction('array_map');
echo $reflectionFunction->getName();
var_dump($reflectionFunction->isInternal()); // True for PHP built-in functions

// Get function parameters
$params = $reflectionFunction->getParameters();
foreach ($params as $param) {
    echo $param->getName() . "<br>";
}

// Create an instance using Reflection
$reflectionClass = new ReflectionClass('DateTime');
$instance = $reflectionClass->newInstance('2023-01-01');
echo $instance->format('Y-m-d');

// Access private members
class MyClass {
    private $privateProperty = "secret";
    
    private function privateMethod() {
        return "private method called";
    }
}

$reflectionClass = new ReflectionClass('MyClass');
$instance = new MyClass();

// Access private property
$property = $reflectionClass->getProperty('privateProperty');
$property->setAccessible(true);
echo $property->getValue($instance); // "secret"
$property->setValue($instance, "new value");

// Call private method
$method = $reflectionClass->getMethod('privateMethod');
$method->setAccessible(true);
echo $method->invoke($instance); // "private method called"

// Using Reflection for annotations/attributes
/**
 * @Entity
 * @Table(name="users")
 */
class User {
    /**
     * @Column(type="integer")
     * @Id
     */
    private $id;
    
    /**
     * @Column(type="string", length=100)
     */
    private $name;
}

// Parse annotations (requires a specialized library or custom parser)

// PHP 8 Attributes (modern alternative to docblock annotations)
// #[Entity]
// #[Table(name: 'users')]
// class User {
//     #[Column(type: 'integer')]
//     #[Id]
//     private $id;
//    
//     #[Column(type: 'string', length: 100)]
//     private $name;
// }

// ====================================
// DEPENDENCY INJECTION
// ====================================

// Manual dependency injection
class Database {
    public function query($sql) {
        // Implementation
        return "Query result for: $sql";
    }
}

class UserRepository {
    private $database;
    
    // Constructor injection
    public function __construct(Database $database) {
        $this->database = $database;
    }
    
    public function findById($id) {
        return $this->database->query("SELECT * FROM users WHERE id = $id");
    }
}

// Usage
$database = new Database();
$userRepository = new UserRepository($database);
echo $userRepository->findById(1);

// Method injection
class UserController {
    public function show($id, UserRepository $userRepository) {
        $user = $userRepository->findById($id);
        return "User: $user";
    }
}

// Property injection
class ProductService {
    public $repository;
    
    public function setRepository(ProductRepository $repository) {
        $this->repository = $repository;
    }
    
    public function getById($id) {
        return $this->repository->findById($id);
    }
}

// Interface-based dependency injection
interface Logger {
    public function log($message);
}

class FileLogger implements Logger {
    public function log($message) {
        file_put_contents('app.log', $message . "\n", FILE_APPEND);
    }
}

class DatabaseLogger implements Logger {
    private $db;
    
    public function __construct(Database $db) {
        $this->db = $db;
    }
    
    public function log($message) {
        $this->db->query("INSERT INTO logs (message) VALUES ('$message')");
    }
}

class UserService {
    private $logger;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    public function create($userData) {
        // Create user
        $this->logger->log("User created: " . $userData['email']);
    }
}

// Simple dependency injection container
class Container {
    private $services = [];
    private $instances = [];
    
    public function set($id, $service) {
        $this->services[$id] = $service;
    }
    
    public function get($id) {
        if (!isset($this->instances[$id])) {
            $this->instances[$id] = $this->services[$id]($this);
        }
        return $this->instances[$id];
    }
}

// Usage
$container = new Container();

$container->set('database', function($c) {
    return new Database();
});

$container->set('userRepository', function($c) {
    return new UserRepository($c->get('database'));
});

$userRepository = $container->get('userRepository');

// ====================================
// DESIGN PATTERNS
// ====================================

// Singleton Pattern
class Singleton {
    private static $instance = null;
    
    private function __construct() {
        // Private constructor to prevent direct instantiation
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function someMethod() {
        return "Method called";
    }
    
    // Prevent cloning
    private function __clone() {}
    
    // Prevent unserialization
    private function __wakeup() {}
}

// Usage
$singleton = Singleton::getInstance();
echo $singleton->someMethod();

// Factory Pattern
interface Vehicle {
    public function drive();
}

class Car implements Vehicle {
    public function drive() {
        return "Driving a car";
    }
}

class Truck implements Vehicle {
    public function drive() {
        return "Driving a truck";
    }
}

class VehicleFactory {
    public static function create($type) {
        switch ($type) {
            case 'car':
                return new Car();
            case 'truck':
                return new Truck();
            default:
                throw new Exception("Unknown vehicle type");
        }
    }
}

// Usage
$car = VehicleFactory::create('car');
echo $car->drive();

// Observer Pattern
interface Observer {
    public function update($subject);
}

class Subject {
    private $observers = [];
    private $state;
    
    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }
    
    public function detach(Observer $observer) {
        $key = array_search($observer, $this->observers, true);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }
    
    public function setState($state) {
        $this->state = $state;
        $this->notify();
    }
    
    public function getState() {
        return $this->state;
    }
    
    private function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class ConcreteObserver implements Observer {
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function update($subject) {
        echo $this->name . " received update: " . $subject->getState() . "<br>";
    }
}

// Usage
$subject = new Subject();
$observer1 = new ConcreteObserver("Observer 1");
$observer2 = new ConcreteObserver("Observer 2");

$subject->attach($observer1);
$subject->attach($observer2);
$subject->setState("New state");

// Strategy Pattern
interface SortStrategy {
    public function sort(array $data): array;
}

class BubbleSort implements SortStrategy {
    public function sort(array $data): array {
        // Bubble sort implementation
        echo "Sorting using bubble sort<br>";
        return $data;
    }
}

class QuickSort implements SortStrategy {
    public function sort(array $data): array {
        // Quick sort implementation
        echo "Sorting using quick sort<br>";
        return $data;
    }
}

class Sorter {
    private $strategy;
    
    public function __construct(SortStrategy $strategy) {
        $this->strategy = $strategy;
    }
    
    public function setStrategy(SortStrategy $strategy) {
        $this->strategy = $strategy;
    }
    
    public function sort(array $data): array {
        return $this->strategy->sort($data);
    }
}

// Usage
$sorter = new Sorter(new BubbleSort());
$sorter->sort([3, 1, 4, 1, 5]);

$sorter->setStrategy(new QuickSort());
$sorter->sort([3, 1, 4, 1, 5]);

// Repository Pattern
interface UserRepositoryInterface {
    public function findById($id);
    public function findAll();
    public function save(User $user);
    public function delete(User $user);
}

class MySQLUserRepository implements UserRepositoryInterface {
    private $db;
    
    public function __construct(Database $db) {
        $this->db = $db;
    }
    
    public function findById($id) {
        return $this->db->query("SELECT * FROM users WHERE id = $id");
    }
    
    public function findAll() {
        return $this->db->query("SELECT * FROM users");
    }
    
    public function save(User $user) {
        // Implementation
    }
    
    public function delete(User $user) {
        // Implementation
    }
}

// ====================================
// WORKING WITH STREAMS
// ====================================

// Opening streams
$handle = fopen('file.txt', 'r'); // File stream
$handle = fopen('http://example.com', 'r'); // HTTP stream
$handle = fopen('php://memory', 'r+'); // Memory stream
$handle = fopen('php://temp', 'r+'); // Temp stream
$handle = fopen('php://stdin', 'r'); // Standard input stream
$handle = fopen('php://stdout', 'w'); // Standard output stream
$handle = fopen('php://filter/read=string.toupper/resource=file.txt', 'r'); // Filtered stream

// Reading from streams
$data = fread($handle, 1024); // Read up to 1024 bytes
$line = fgets($handle); // Read a line
$char = fgetc($handle); // Read a character

// Writing to streams
fwrite($handle, 'Hello, World!');
fputs($handle, 'Another message'); // Alias of fwrite

// Stream positioning
fseek($handle, 10, SEEK_SET); // Move to position 10 from start
fseek($handle, -5, SEEK_END); // Move to position 5 before end
fseek($handle, 3, SEEK_CUR); // Move 3 positions forward from current

ftell($handle); // Get current position
rewind($handle); // Move to beginning of stream

// Checking stream status
feof($handle); // Check if end of file reached
fstat($handle); // Get file status

// Stream metadata
stream_get_meta_data($handle);

// Stream contexts
$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query(['key' => 'value'])
    ]
]);
$handle = fopen('http://example.com', 'r', false, $context);

// Memory streams
$memoryStream = fopen('php://memory', 'r+');
fwrite($memoryStream, 'Data in memory');
rewind($memoryStream);
$data = stream_get_contents($memoryStream);
fclose($memoryStream);

// Stream wrappers
class CustomStreamWrapper {
    private $position;
    private $data;
    
    public function stream_open($path, $mode, $options, &$opened_path) {
        $this->position = 0;
        $this->data = "Hello from custom stream wrapper!";
        return true;
    }
    
    public function stream_read($count) {
        $ret = substr($this->data, $this->position, $count);
        $this->position += strlen($ret);
        return $ret;
    }
    
    public function stream_write($data) {
        $this->data = substr_replace($this->data, $data, $this->position, strlen($data));
        $this->position += strlen($data);
        return strlen($data);
    }
    
    public function stream_tell() {
        return $this->position;
    }
    
    public function stream_eof() {
        return $this->position >= strlen($this->data);
    }
    
    public function stream_seek($offset, $whence) {
        switch ($whence) {
            case SEEK_SET:
                $this->position = $offset;
                break;
            case SEEK_CUR:
                $this->position += $offset;
                break;
            case SEEK_END:
                $this->position = strlen($this->data) + $offset;
                break;
        }
        return true;
    }
}

stream_wrapper_register('custom', 'CustomStreamWrapper');
$handle = fopen('custom://something', 'r');
echo fread($handle, 1024);
fclose($handle);

// ====================================
// PERFORMANCE OPTIMIZATION
// ====================================

// Opcode caching
// Using OPcache (built into PHP 5.5+)
opcache_reset(); // Clear the opcode cache
opcache_get_status(); // Get cache status
opcache_compile_file('script.php'); // Pre-compile script

// Benchmarking code
$startTime = microtime(true);
// Code to benchmark
$endTime = microtime(true);
$executionTime = $endTime - $startTime;
echo "Execution time: " . ($executionTime * 1000) . " ms";

// Memory usage
$memoryBefore = memory_get_usage();
// Code to measure
$memoryAfter = memory_get_usage();
echo "Memory used: " . ($memoryAfter - $memoryBefore) . " bytes";
echo "Peak memory usage: " . memory_get_peak_usage() . " bytes";

// Optimize loops
$arr = [];
$count = count($arr); // Store count() result instead of calling in each iteration
for ($i = 0; $i < $count; $i++) {
    // Loop logic
}

// Use references for large arrays
foreach ($largeArray as &$value) {
    $value *= 2; // Modify in place without copying
}
unset($value); // Unset reference after use

// Output buffering
ob_start(); // Start output buffering
echo "Some output";
$output = ob_get_clean(); // Get output and clear buffer

// Database optimization
// Use prepared statements
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);

// Limit query results
$stmt = $pdo->query("SELECT * FROM users LIMIT 10 OFFSET 20");

// Index database tables
// CREATE INDEX idx_users_email ON users(email);

// Use transactions for multiple operations
$pdo->beginTransaction();
try {
    // Multiple queries
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    throw $e;
}

// Caching
// Simple file cache
function getDataWithCache($key, $ttl = 3600) {
    $cacheFile = 'cache/' . md5($key) . '.cache';
    
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $ttl)) {
        return unserialize(file_get_contents($cacheFile));
    }
    
    // Get fresh data
    $data = getFreshData();
    
    // Cache it
    file_put_contents($cacheFile, serialize($data));
    
    return $data;
}

// Function memoization
function memoize($func) {
    $cache = [];
    return function() use ($func, &$cache) {
        $args = func_get_args();
        $key = serialize($args);
        
        if (!isset($cache[$key])) {