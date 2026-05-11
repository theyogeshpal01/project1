<?php
/**
 * PDF Upload & Simulation Handler for LASA Consultants
 */

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['pdfs'])) {
    $files = $_FILES['pdfs'];
    $uploaded_files = [];
    
    // In a real app, you would use a library like Spatie/PdfToText or similar
    // for actual conversion. Here we simulate the process.
    
    // Ensure uploads directory exists
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }
    
    $history_file = 'uploads.json';
    $history_data = [];
    if (file_exists($history_file)) {
        $history_data = json_decode(file_get_contents($history_file), true) ?: [];
    }

    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] === 0) {
            $tmp_name = $files['tmp_name'][$i];
            $original_name = basename($files['name'][$i]);
            $unique_name = time() . "_" . $original_name;
            $destination = "uploads/" . $unique_name;
            
            if (move_uploaded_file($tmp_name, $destination)) {
                $uploaded_files[] = $unique_name;
                
                // Add to history
                $history_data[] = [
                    'id' => time() . "_" . $i,
                    'filename' => $unique_name,
                    'original_name' => $original_name,
                    'date' => date('Y-m-d H:i:s'),
                    'status' => 'converted'
                ];
            }
        }
    }
    
    // Save history
    file_put_contents($history_file, json_encode($history_data, JSON_PRETTY_PRINT));

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Processing Complete | LASA</title>
        <link rel='stylesheet' href='style.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <style>
            .process-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 40px;
                background: #F8F9FA;
            }
            .process-card {
                background: white;
                padding: 40px;
                border-radius: 20px;
                box-shadow: 0 20px 50px rgba(0,0,0,0.1);
                max-width: 800px;
                width: 100%;
                text-align: center;
            }
            .file-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                border-bottom: 1px solid #eee;
                text-align: left;
            }
            .status-badge {
                background: #C1E1A6;
                color: #0B132B;
                padding: 5px 15px;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 700;
            }
            .btn-download {
                color: #B8860B;
                font-weight: 600;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class='process-container'>
            <div class='process-card'>
                <i class='fas fa-file-excel' style='font-size: 3rem; color: #27ae60; margin-bottom: 20px;'></i>
                <h1>Conversion Complete</h1>
                <p style='color: #666;'>We have successfully processed your PDF contracts. You can now download the generated Excel files.</p>
                <br><br>
                
                <div class='file-list-results'>";
                
                foreach ($uploaded_files as $file) {
                    $excel_name = pathinfo($file, PATHINFO_FILENAME) . ".xlsx";
                    echo "
                    <div class='file-row'>
                        <div>
                            <i class='fas fa-file-pdf' style='color: #e74c3c;'></i> <strong>$file</strong>
                            <div style='font-size: 0.8rem; color: #999;'>Converted to $excel_name</div>
                        </div>
                        <div style='display: flex; align-items: center; gap: 15px;'>
                            <span class='status-badge'>READY</span>
                            <a href='generate-excel.php?file=$file' class='btn-download'>Download Excel</a>
                        </div>
                    </div>";
                }

                if (empty($uploaded_files)) {
                    echo "<p>No files were uploaded or processed.</p>";
                }

                echo "</div>
                <br><br>
                
                <a href='index.php#tools' class='btn-main btn-outline' style='display: block; width: 100%; border: 1px solid #0B132B; color: #0B132B; text-align: center; padding: 15px; border-radius: 5px; font-weight: 600; margin-top: 10px;'>Convert More Files</a>
            </div>
        </div>
    </body>
    </html>";
} else {
    header("Location: index.php");
    exit();
}
?>
