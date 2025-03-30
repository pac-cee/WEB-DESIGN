<?php
/**
 * JSON AND XML HANDLING
 * This file covers handling JSON and XML data formats in PHP
 */

// ====================================
// JSON HANDLING
// ====================================

// Encoding PHP arrays/objects to JSON
$data = [
    "name" => "John Doe",
    "age" => 30,
    "email" => "john@example.com",
    "active" => true,
    "skills" => ["PHP", "JavaScript", "MySQL"]
];

$jsonString = json_encode($data);
echo $jsonString;

// Pretty-print JSON (with indentation)
$jsonPretty = json_encode($data, JSON_PRETTY_PRINT);
echo $jsonPretty;

// JSON encoding options
$jsonOptions = json_encode($data, JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_UNESCAPED_SLASHES);
// JSON_HEX_TAG - Convert < and > to \u003C and \u003E
// JSON_HEX_AMP - Convert & to \u0026
// JSON_HEX_APOS - Convert ' to \u0027
// JSON_HEX_QUOT - Convert " to \u0022
// JSON_UNESCAPED_SLASHES - Don't escape /
// JSON_UNESCAPED_UNICODE - Don't escape Unicode characters
// JSON_NUMERIC_CHECK - Convert numeric strings to numbers
// JSON_FORCE_OBJECT - Force {} notation instead of [] for empty arrays

// Decoding JSON to PHP
$jsonString = '{"name":"John Doe","age":30,"active":true,"skills":["PHP","JavaScript","MySQL"]}';
$phpArray = json_decode($jsonString, true); // true = return as associative array
$phpObject = json_decode($jsonString); // false/omitted = return as object

// Accessing decoded data
echo $phpArray["name"]; // Array access
echo $phpObject->name; // Object access

// Checking for JSON errors
$jsonString = '{invalid json}';
$data = json_decode($jsonString);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Error: " . json_last_error_msg();
}

// JSON streams (for large data)
$jsonFile = fopen("large_data.json", "r");
$jsonDecoder = new JsonStreamingParser\Parser($jsonFile, new MyListener());
$jsonDecoder->parse();
fclose($jsonFile);

// Example listener class (needs JsonStreamingParser library)
class MyListener implements JsonStreamingParser\Listener {
    public function startDocument() {}
    public function endDocument() {}
    public function startObject() {}
    public function endObject() {}
    public function startArray() {}
    public function endArray() {}
    public function key($key) {}
    public function value($value) {}
    public function whitespace($whitespace) {}
}

// ====================================
// XML HANDLING
// ====================================

// Creating XML with SimpleXML
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root></root>');

// Adding elements and attributes
$user = $xml->addChild('user');
$user->addChild('name', 'John Doe');
$user->addChild('email', 'john@example.com');
$user->addAttribute('id', '123');

$skills = $user->addChild('skills');
$skills->addChild('skill', 'PHP');
$skills->addChild('skill', 'JavaScript');
$skills->addChild('skill', 'MySQL');

// Output the XML
header('Content-Type: text/xml');
echo $xml->asXML();
// Or save to file
$xml->asXML('user.xml');

// Reading XML with SimpleXML
$xml = simplexml_load_file('user.xml');
// Or from string
$xml = simplexml_load_string($xmlString);

// Accessing XML data
echo $xml->user->name; // John Doe
echo $xml->user['id']; // 123

// Looping through elements
foreach ($xml->user->skills->skill as $skill) {
    echo $skill . "<br>";
}

// Converting XML to array
$xmlArray = json_decode(json_encode($xml), true);

// Namespaces in XML
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:ns1="http://example.com/ns1" xmlns:ns2="http://example.com/ns2"></root>');

$ns1Element = $xml->addChild('ns1:element', 'value', 'http://example.com/ns1');
$ns1Element->addAttribute('ns2:attr', 'attribute value', 'http://example.com/ns2');

// Access namespaced elements
$ns1 = $xml->children('http://example.com/ns1');
echo $ns1->element;

// XPath with SimpleXML
$result = $xml->xpath('//ns1:element');
foreach ($result as $element) {
    echo $element;
}

// DOM XML (more powerful but more complex)
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true; // Pretty-print

// Create elements
$root = $dom->createElement('root');
$dom->appendChild($root);

$user = $dom->createElement('user');
$root->appendChild($user);

$name = $dom->createElement('name', 'John Doe');
$user->appendChild($name);

// Create attributes
$idAttr = $dom->createAttribute('id');
$idAttr->value = '123';
$user->appendChild($idAttr);

// Output the XML
echo $dom->saveXML();
// Or save to file
$dom->save('user.xml');

// Reading with DOM
$dom = new DOMDocument();
$dom->load('user.xml'); // From file
// Or from string
$dom->loadXML($xmlString);

// Get elements by tag name
$users = $dom->getElementsByTagName('user');
foreach ($users as $user) {
    echo $user->getElementsByTagName('name')->item(0)->nodeValue;
    echo $user->getAttribute('id');
}

// XPath with DOM
$xpath = new DOMXPath($dom);
$result = $xpath->query('//user[@id="123"]');
foreach ($result as $node) {
    echo $node->nodeValue;
}

// XML validation with schema
$dom = new DOMDocument();
$dom->load('data.xml');
if ($dom->schemaValidate('schema.xsd')) {
    echo "XML is valid according to schema";
} else {
    echo "XML is not valid according to schema";
}

// Working with large XML files (XMLReader)
$reader = new XMLReader();
$reader->open('large.xml');

while ($reader->read()) {
    if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'user') {
        $node = $reader->expand();
        $dom = new DOMDocument();
        $dom->appendChild($dom->importNode($node, true));
        
        // Process each user node
        $user = simplexml_import_dom($dom->documentElement);
        echo $user->name . "<br>";
        
        // Free memory
        $dom = null;
        $user = null;
    }
}
$reader->close();

// XML and web services (SOAP)
$client = new SoapClient('http://example.com/service.wsdl');
$result = $client->functionName(['param1' => 'value1']);

// Creating a SOAP server
class MyService {
    public function hello($name) {
        return "Hello, $name!";
    }
}

$server = new SoapServer('service.wsdl');
$server->setClass('MyService');
$server->handle();
?>
