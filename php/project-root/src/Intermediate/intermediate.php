<?php
/**
 * INTERMEDIATE PHP CONCEPTS
 * - Functions
 * - Classes
 * - Error handling
 */

class Calculator {
    private float $result = 0;

    public function add(float $value): self {
        $this->result += $value;
        return $this;
    }

    public function getResult(): float {
        return $this->result;
    }
}

// Usage
try {
    $calc = new Calculator();
    echo "Result: " . $calc->add(5)->add(3.5)->getResult();
} catch (TypeError $e) {
    error_log("Calculation error: " . $e->getMessage());
    echo "Invalid input provided!";
}