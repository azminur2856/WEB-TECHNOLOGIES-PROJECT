<?php
$fertilizer_data = [
    'wheat' => ['N' => 120, 'P2O5' => 60, 'K2O' => 40],
    'rice' => ['N' => 100, 'P2O5' => 50, 'K2O' => 30],
    'tomato' => ['N' => 150, 'P2O5' => 60, 'K2O' => 60],
    'maize' => ['N' => 130, 'P2O5' => 70, 'K2O' => 50],
    'potato' => ['N' => 140, 'P2O5' => 60, 'K2O' => 90],
    'onion' => ['N' => 110, 'P2O5' => 50, 'K2O' => 80],
    'soybean' => ['N' => 20, 'P2O5' => 60, 'K2O' => 80],
    'barley' => ['N' => 100, 'P2O5' => 50, 'K2O' => 40],
    'sugarcane' => ['N' => 180, 'P2O5' => 80, 'K2O' => 100],
    'cotton' => ['N' => 90, 'P2O5' => 60, 'K2O' => 60],
];
 
function satak_to_acre($satak) {
    return $satak * 0.025;
}
 
if (isset($_POST['mydata'])) {
    $data = json_decode($_POST['mydata'], true);
 
    $land_size = $data['land_size'];
    $crop_type = $data['crop_type'];
 
    if ($land_size > 0 && array_key_exists($crop_type, $fertilizer_data)) {
        $land_size_acres = satak_to_acre($land_size);
 
        $N_required = $fertilizer_data[$crop_type]['N'] * $land_size_acres;
        $P2O5_required = $fertilizer_data[$crop_type]['P2O5'] * $land_size_acres;
        $K2O_required = $fertilizer_data[$crop_type]['K2O'] * $land_size_acres;
 
        $response = [
            'status' => 'success',
            'N' => round($N_required, 2),
            'P2O5' => round($P2O5_required, 2),
            'K2O' => round($K2O_required, 2)
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Please enter a valid land size and select a crop.'
        ];
    }
 
    echo json_encode($response);
}
?>
 
 