<?php
/**
 * Dynamic Multi-Sheet Excel (XML) Generator for LASA
 * Uses a seed-based mock engine to generate unique, realistic data for each PDF file.
 */

include 'SimplePdfParser.php';

// Check if professional library is installed via composer
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
    $useProParser = true;
} else {
    $useProParser = false;
}

$files = [];
if (isset($_POST['files']) && is_array($_POST['files'])) {
    $files = $_POST['files'];
} else if (isset($_GET['file'])) {
    $files = [$_GET['file']];
}

if (!empty($files)) {
    $file_path = "uploads/" . $files[0];
    // Original name for display/download (remove timestamp)
    $original_name = preg_replace('/^\d+_/', '', $files[0]);
    $download_name = "Contract_Report_" . pathinfo($original_name, PATHINFO_FILENAME) . ".xls";

    // Attempt actual parsing
    $parsedFields = [];
    if ($useProParser) {
        try {
            $proParser = new \Smalot\PdfParser\Parser();
            $pdf = $proParser->parseFile($file_path);
            $extractedText = $pdf->getText();

            // Advanced parsing logic for Smalot Parser
            $parser = new SimplePdfParser(); // Use our keyword logic on the better extracted text
            $parsedFields = $parser->parseFields($extractedText);
        } catch (\Exception $e) {
            // Fallback to simple parser if pro fails
            $parser = new SimplePdfParser();
            $extractedText = $parser->getText($file_path);
            $parsedFields = $parser->parseFields($extractedText);
        }
    } else {
        $parser = new SimplePdfParser();
        $extractedText = $parser->getText($file_path);
        $parsedFields = $parser->parseFields($extractedText);
    }

    // Seed the random generator with the filename for fallback data consistency
    srand(crc32($files[0]));

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $download_name . '"');

    echo '<?xml version="1.0"?>' . "\n";
    echo '<?mso-application progid="Excel.Sheet"?>' . "\n";
    ?>
    <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
        xmlns:html="http://www.w3.org/TR/REC-html40">

        <Styles>
            <Style ss:ID="Header">
                <Font ss:Bold="1" ss:Color="#FFFFFF" /><Interior ss:Color="#0B132B" ss:Pattern="Solid" /><Alignment ss:Horizontal="Center" ss:Vertical="Center" /><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D3D3D3" /><Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D3D3D3" /><Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D3D3D3" /><Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D3D3D3" /></Borders>
            </Style>
            <Style ss:ID="DataCell">
                <Alignment ss:Vertical="Center" ss:WrapText="1" /><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D3D3D3" /><Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D3D3D3" /><Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D3D3D3" /><Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#D3D3D3" /></Borders>
            </Style>
            <Style ss:ID="DateCell" ss:Parent="DataCell">
                <NumberFormat ss:Format="Short Date" />
            </Style>
            <Style ss:ID="NumberCell" ss:Parent="DataCell">
                <NumberFormat ss:Format="Standard" />
            </Style>
        </Styles>

        <?php
        // Helper functions for dynamic mock data with realistic "extraction" simulation
        function getPlaceholder($type)
        {
            return "Not Found";
        }

        $sheets = [
            "Contract Data" => [
                'headers' => ["File Name", "Contract Number", "Contract Generated Date", "Bid / RA / PBP No", "Duration (Months)", "Amount of Contract"],
                'widths' => [230, 150, 130, 120, 100, 120],
                'rows' => [
                    [
                        $original_name,
                        (isset($parsedFields['contract']) ? $parsedFields['contract'] : getPlaceholder('contract')),
                        (isset($parsedFields['contract_date']) ? $parsedFields['contract_date'] : getPlaceholder('date')),
                        (isset($parsedFields['bid_no']) ? $parsedFields['bid_no'] : getPlaceholder('bid')),
                        (isset($parsedFields['duration']) ? $parsedFields['Duration in Months for which service is
required
'] : getPlaceholder('Duration in Months for which service is
required
')),
                        (isset($parsedFields['amount']) ? $parsedFields['amount'] : getPlaceholder('amount'))
                    ]
                ]
            ],
            "Organisation Details" => [
                'headers' => ["File Name", "Type", "Ministry", "Department", "Organisation Name", "Office Zone"],
                'widths' => [230, 100, 150, 150, 200, 120],
                'rows' => [
                    [$original_name, (isset($parsedFields['type']) ? $parsedFields['type'] : getPlaceholder('type')), (isset($parsedFields['ministry']) ? $parsedFields['ministry'] : getPlaceholder('ministry')), (isset($parsedFields['department']) ? $parsedFields['department'] : getPlaceholder('dept')), (isset($parsedFields['org']) ? $parsedFields['org'] : getPlaceholder('org')), (isset($parsedFields['zone']) ? $parsedFields['zone'] : getPlaceholder('zone'))]
                ]
            ],
            "Buyer Details" => [
                'headers' => ["File Name", "Designation", "Contact No.", "Email Id", "GSTIN", "Address"],
                'widths' => [230, 150, 120, 150, 150, 350],
                'rows' => [
                    [$original_name, (isset($parsedFields['designation']) ? $parsedFields['designation'] : getPlaceholder('role')), (isset($parsedFields['buyer_contact']) ? $parsedFields['buyer_contact'] : getPlaceholder('contact')), (isset($parsedFields['buyer_email']) ? $parsedFields['buyer_email'] : getPlaceholder('email')), (isset($parsedFields['gstin_buyer']) ? $parsedFields['gstin_buyer'] : getPlaceholder('gstin')), (isset($parsedFields['buyer_address']) ? $parsedFields['buyer_address'] : getPlaceholder('address'))]
                ]
            ],
            "Financial Approval Details" => [
                'headers' => ["File Name", "IFD Concurrence", "Designation of Administrative Approval", "Designation of Financial Approval"],
                'widths' => [230, 150, 200, 200],
                'rows' => [
                    [$original_name, (isset($parsedFields['ifd_concurrence']) ? $parsedFields['ifd_concurrence'] : getPlaceholder('approval')), (isset($parsedFields['admin_approval']) ? $parsedFields['admin_approval'] : getPlaceholder('role')), (isset($parsedFields['financial_approval']) ? $parsedFields['financial_approval'] : getPlaceholder('role'))]
                ]
            ],
            "Paying Authority Details" => [
                'headers' => ["File Name", "Role", "Payment Mode", "Designation", "Email Id", "GSTIN", "Address"],
                'widths' => [230, 100, 120, 150, 150, 150, 350],
                'rows' => [
                    [$original_name, (isset($parsedFields['pao_role']) ? $parsedFields['pao_role'] : getPlaceholder('pao')), (isset($parsedFields['pao_mode']) ? $parsedFields['pao_mode'] : "Online"), (isset($parsedFields['designation']) ? $parsedFields['designation'] : getPlaceholder('role')), (isset($parsedFields['buyer_email']) ? $parsedFields['buyer_email'] : getPlaceholder('email')), (isset($parsedFields['gstin_buyer']) ? $parsedFields['gstin_buyer'] : getPlaceholder('gstin')), (isset($parsedFields['buyer_address']) ? $parsedFields['buyer_address'] : getPlaceholder('address'))]
                ]
            ],
            "Consignee Details" => [
                'headers' => ["File Name", "Contact", "Email Id", "GSTIN", "Address", "Service Description"],
                'widths' => [230, 120, 150, 120, 250, 250],
                'rows' => [
                    [$original_name, (isset($parsedFields['consignee_contact']) ? $parsedFields['consignee_contact'] : getPlaceholder('contact')), (isset($parsedFields['consignee_email']) ? $parsedFields['consignee_email'] : getPlaceholder('email')), (isset($parsedFields['consignee_gstin']) ? $parsedFields['consignee_gstin'] : getPlaceholder('gstin')), (isset($parsedFields['consignee_address']) ? $parsedFields['consignee_address'] : getPlaceholder('address')), (isset($parsedFields['service_desc']) ? $parsedFields['service_desc'] : getPlaceholder('desc'))]
                ]
            ],
            "Service Provider Details" => [
                'headers' => ["File Name", "GeM Seller ID", "Company Name", "Contact Number", "Email Id", "Address", "MSME Registration Number", "GSTIN", "MSME Status", "MSE Social Category", "MSE Gender"],
                'widths' => [230, 120, 180, 120, 150, 250, 150, 120, 100, 120, 100],
                'rows' => [
                    [$original_name, (isset($parsedFields['seller_id']) ? $parsedFields['seller_id'] : getPlaceholder('seller_id')), (isset($parsedFields['company']) ? $parsedFields['company'] : getPlaceholder('company')), (isset($parsedFields['seller_contact']) ? $parsedFields['seller_contact'] : getPlaceholder('contact')), (isset($parsedFields['seller_email']) ? $parsedFields['seller_email'] : getPlaceholder('email')), (isset($parsedFields['seller_address']) ? $parsedFields['seller_address'] : getPlaceholder('address')), (isset($parsedFields['msme_no']) ? $parsedFields['msme_no'] : getPlaceholder('msme')), (isset($parsedFields['gstin_seller']) ? $parsedFields['gstin_seller'] : getPlaceholder('gstin')), (isset($parsedFields['msme_status']) ? $parsedFields['msme_status'] : getPlaceholder('msme')), (isset($parsedFields['mse_category']) ? $parsedFields['mse_category'] : getPlaceholder('msme')), (isset($parsedFields['mse_gender']) ? $parsedFields['mse_gender'] : getPlaceholder('msme'))]
                ]
            ],
            "Service Details" => [
                'headers' => ["File Name", "Service Start Date", "Service End Date", "Category Name", "Billing Cycle", "District", "Zipcode", "Vehicle Type", "Type of car"],
                'widths' => [230, 120, 120, 180, 100, 100, 100, 100, 200],
                'rows' => [
                    [$original_name, (isset($parsedFields['service_start']) ? $parsedFields['service_start'] : getPlaceholder('date')), (isset($parsedFields['service_end']) ? $parsedFields['service_end'] : getPlaceholder('date')), (isset($parsedFields['category']) ? $parsedFields['category'] : getPlaceholder('category')), (isset($parsedFields['billing_cycle']) ? $parsedFields['billing_cycle'] : getPlaceholder('billing')), (isset($parsedFields['district']) ? $parsedFields['district'] : "NA"), (isset($parsedFields['zipcode']) ? $parsedFields['zipcode'] : "NA"), (isset($parsedFields['vehicle_type']) ? $parsedFields['vehicle_type'] : "NA"), (isset($parsedFields['car_type']) ? $parsedFields['car_type'] : getPlaceholder('car'))]
                ]
            ]
        ];

        foreach ($sheets as $sheetName => $data):
            ?>
            <Worksheet ss:Name="<?php echo htmlspecialchars($sheetName); ?>">
                <Table>
                    <?php foreach ($data['widths'] as $w): ?>
                        <Column ss:Width="<?php echo $w; ?>" />
                    <?php endforeach; ?>

                    <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
                        <FreezePanes />
                        <FrozenNoSplit />
                        <SplitHorizontal>1</SplitHorizontal>
                        <TopRowBottomPane>1</TopRowBottomPane>
                    </WorksheetOptions>

                    <Row ss:Height="25">
                        <?php foreach ($data['headers'] as $header): ?>
                            <Cell ss:StyleID="Header"><Data ss:Type="String"><?php echo htmlspecialchars($header); ?></Data></Cell>
                        <?php endforeach; ?>
                    </Row>

                    <?php foreach ($data['rows'] as $row): ?>
                        <Row ss:Height="20">
                            <?php foreach ($row as $idx => $val):
                                $val = (empty($val) || $val === "") ? "Unavailable" : $val;
                                $style = "DataCell";
                                $type = "String";

                                if ($val !== "Unavailable" && strpos($data['headers'][$idx], 'Date') !== false && preg_match('/^\d{4}-\d{2}-\d{2}$/', $val)) {
                                    $style = "DateCell";
                                    $type = "DateTime";
                                    $val = $val . "T00:00:00.000";
                                } elseif ($val !== "Unavailable" && is_numeric($val)) {
                                    $style = "DataCell";
                                    $type = "Number";
                                }
                                ?>
                                <Cell ss:StyleID="<?php echo $style; ?>"><Data
                                        ss:Type="<?php echo $type; ?>"><?php echo htmlspecialchars($val); ?></Data></Cell>
                            <?php endforeach; ?>
                        </Row>
                    <?php endforeach; ?>

                </Table>
            </Worksheet>
        <?php endforeach; ?>
    </Workbook>
    <?php
    exit();
}
?>