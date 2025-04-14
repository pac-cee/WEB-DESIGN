<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/PensionCalculator.php';

class PensionController {
    private $calculator;
    private $db;

    public function __construct() {
        $this->db = new Database();
        $this->calculator = new PensionCalculator($this->db->getConnection());
    }

    public function handleRequest() {
        $response = [
            'success' => false,
            'message' => '',
            'data' => null
        ];

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['calculate'])) {
                    $response = $this->handleCalculation($_POST);
                } elseif (isset($_POST['submit'])) {
                    $response = $this->handleSubmission($_POST);
                } elseif (isset($_POST['retrieve'])) {
                    $response = $this->handleRetrieval($_POST);
                } elseif (isset($_POST['delete'])) {
                    $response = $this->handleDeletion($_POST);
                }
            }
        } catch (Exception $e) {
            $response['message'] = "Error: " . $e->getMessage();
        }

        return $response;
    }

    private function handleCalculation($data) {
        if ($this->validateInputs($data)) {
            $result = $this->calculator->calculate(
                floatval($data['monthly_salary']),
                intval($data['employee_period']),
                floatval($data['benefit_percentage'])
            );
            return [
                'success' => true,
                'data' => $result,
                'message' => 'Calculation completed successfully'
            ];
        }
        return [
            'success' => false,
            'message' => 'Please fill all fields with valid values'
        ];
    }

    private function handleSubmission($data) {
        if (!$this->validateInputs($data)) {
            return [
                'success' => false,
                'message' => 'Please fill all fields with valid values'
            ];
        }

        $calculationResult = $this->calculator->calculate(
            floatval($data['monthly_salary']),
            intval($data['employee_period']),
            floatval($data['benefit_percentage'])
        );

        $saveData = [
            'employ_name' => $data['employ_name'],
            'employee_address' => $data['employee_address'],
            'monthly_salary' => floatval($data['monthly_salary']),
            'employee_period' => intval($data['employee_period']),
            'benefit_percentage' => floatval($data['benefit_percentage']),
            'total_amount' => $calculationResult['totalAmount'],
            'amount_per_month' => $calculationResult['amountPerMonth']
        ];

        if ($this->calculator->save($saveData)) {
            return [
                'success' => true,
                'message' => 'Record saved successfully',
                'data' => $calculationResult
            ];
        }

        return [
            'success' => false,
            'message' => 'Error saving record'
        ];
    }

    private function handleRetrieval($data) {
        if (empty($data['employ_name'])) {
            return [
                'success' => false,
                'message' => 'Please enter employee name to retrieve'
            ];
        }

        $result = $this->calculator->retrieve($data['employ_name']);
        if ($result) {
            return [
                'success' => true,
                'data' => $result,
                'message' => 'Record retrieved successfully'
            ];
        }

        return [
            'success' => false,
            'message' => 'No record found'
        ];
    }

    private function handleDeletion($data) {
        if (empty($data['employ_name'])) {
            return [
                'success' => false,
                'message' => 'Please enter employee name to delete'
            ];
        }

        $affected = $this->calculator->delete($data['employ_name']);
        if ($affected > 0) {
            return [
                'success' => true,
                'message' => 'Record deleted successfully'
            ];
        }

        return [
            'success' => false,
            'message' => 'No record found to delete'
        ];
    }

    private function validateInputs($data) {
        return !empty($data['employ_name']) && 
               !empty($data['employee_address']) && 
               floatval($data['monthly_salary']) > 0 && 
               intval($data['employee_period']) > 0 && 
               floatval($data['benefit_percentage']) > 0;
    }
}
?>