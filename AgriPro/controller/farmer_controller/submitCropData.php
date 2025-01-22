<?php
require_once '../../model/cropdirectorydb.php';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = isset($_POST['mydata']) ? $_POST['mydata'] : null;
 
    if ($data) {
        $decodedData = json_decode($data, true);
 
        // Process the received data
        // For example: Inserting the data into the database
        $db = (new CropDirectoryDB())->getConnection();
 
        // Example query (you can replace this with your logic)
        $sql = "INSERT INTO crops (name) VALUES (?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $decodedData['name']);
 
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Crop added successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add crop.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No data received.']);
    }
}
?>
 