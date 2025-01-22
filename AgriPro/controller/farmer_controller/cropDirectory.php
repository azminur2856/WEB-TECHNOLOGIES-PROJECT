<?php
require_once '../model/cropdirectorydb.php';
 
class CropDirectoryController {
    private $db;
 
    public function __construct() {
        $this->db = (new CropDirectoryDB())->getConnection();
    }
 
    public function getCrops() {
        $sql = "SELECT id, name FROM crops";
        $result = $this->db->query($sql);
 
        $crops = [];
        while ($row = $result->fetch_assoc()) {
            $crops[] = $row;
        }
        return $crops;
    }
}
 
if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    // Return crops data as JSON for AJAX requests
    $controller = new CropDirectoryController();
    $crops = $controller->getCrops();
    header('Content-Type: application/json');
    echo json_encode($crops);
    exit;
}
 
// Default behavior for rendering the view
require_once '../view/cropDirectoryView.php';
?>