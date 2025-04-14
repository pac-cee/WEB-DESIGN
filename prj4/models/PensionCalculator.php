<?php
class PensionCalculator {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function calculate($monthlySalary, $employeePeriod, $benefitPercentage) {
        $totalAmount = $monthlySalary * $employeePeriod * ($benefitPercentage / 100);
        $amountPerMonth = $totalAmount / ($employeePeriod * 12);
        
        return [
            'totalAmount' => $totalAmount,
            'amountPerMonth' => $amountPerMonth
        ];
    }

    public function save($data) {
        $stmt = $this->conn->prepare("INSERT INTO pension_records (employ_name, employee_address, monthly_salary, employee_period, benefit_percentage, total_amount, amount_per_month) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiddd", 
            $data['employ_name'], 
            $data['employee_address'], 
            $data['monthly_salary'], 
            $data['employee_period'], 
            $data['benefit_percentage'], 
            $data['total_amount'], 
            $data['amount_per_month']
        );
        
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function retrieve($employName) {
        $stmt = $this->conn->prepare("SELECT * FROM pension_records WHERE employ_name LIKE ?");
        $searchParam = "%$employName%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }

    public function delete($employName) {
        $stmt = $this->conn->prepare("DELETE FROM pension_records WHERE employ_name = ?");
        $stmt->bind_param("s", $employName);
        $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();
        return $affected;
    }
}
?>