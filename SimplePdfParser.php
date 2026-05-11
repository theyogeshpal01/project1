<?php
/**
 * Simple PDF Text Extractor (Pure PHP)
 * This is a basic fallback for environments without libraries.
 */
class SimplePdfParser {
    public function getText($filename) {
        if (!file_exists($filename)) return "";
        
        $content = file_get_contents($filename);
        if ($content === false) return "";

        // Try to extract text between ( and ) in the PDF structure
        // This works for simple/non-compressed PDFs
        preg_match_all("/\((.*?)\) Tj/s", $content, $matches);
        $text = implode(" ", $matches[1]);

        if (empty($text)) {
            // Fallback for some other PDF structures
            preg_match_all("/\[(.*?)\] TJ/s", $content, $matches);
            foreach ($matches[1] as $m) {
                preg_match_all("/\((.*?)\)/s", $m, $subMatches);
                $text .= implode(" ", $subMatches[1]) . " ";
            }
        }

        return $text;
    }

    public function parseFields($text) {
        $fields = [];
        
        // Step 1: Clean the text
        // Remove the weird <> separators from Smalot/PdfParser
        $cleanText = str_replace("<>", " ", $text);
        // Normalize whitespace
        $cleanText = preg_replace('/\s+/', ' ', $cleanText);
        
        // Step 2: Extraction with improved patterns
        
        // Contract Number
        if (preg_match("/Contract No[:\s]+(GEMC?-[A-Z0-9-]+)/i", $cleanText, $m)) {
            $fields['contract'] = trim($m[1]);
        }
        
        // Contract Generated Date
        if (preg_match("/Contract Generated Date\s*:\s*([0-9A-Za-z\s-]+)/i", $cleanText, $m)) {
            $dateStr = $this->cleanValue(trim($m[1]));
            $timestamp = strtotime($dateStr);
            $fields['contract_date'] = $timestamp ? date('Y-m-d', $timestamp) : $dateStr;
        } elseif (preg_match("/([0-9]{1,2}-[A-Za-z]{3}-[0-9]{4})/", $cleanText, $m)) {
            $timestamp = strtotime($m[1]);
            $fields['contract_date'] = $timestamp ? date('Y-m-d', $timestamp) : $m[1];
        }
        
        // Bid Number
        if (preg_match("/Bid\/RA\/PBP No\.\s*:\s*([A-Z0-9\/]+)/i", $cleanText, $m)) {
            $fields['bid_no'] = trim($m[1]);
        }
        
        // Organisation Details
        if (preg_match("/Type\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['type'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Ministry\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['ministry'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Department\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['department'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Organisation Name\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['org'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/(?:Office\s+)?Zone\s*[:\s]+([^|]+)/i", $cleanText, $m)) {
            $fields['zone'] = $this->cleanValue($m[1]);
        }
        
        // Buyer Details
        if (preg_match("/Designation\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['designation'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Contact No\.\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['buyer_contact'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Email ID\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['buyer_email'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Address\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['buyer_address'] = $this->cleanValue($m[1]);
        }
        
        // Paying Authority Details
        if (preg_match("/Paying Authority Details.*?Role\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['pao_role'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Payment Mode\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['pao_mode'] = $this->cleanValue($m[1]);
        }

        // Consignee Details
        if (preg_match("/Consignee Details.*?Contact\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['consignee_contact'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Consignee Details.*?Email ID\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['consignee_email'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Consignee Details.*?GSTIN\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['consignee_gstin'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Consignee Details.*?Address\s*:\s*(.*?India)/is", $cleanText, $m)) {
            $fields['consignee_address'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Consignee Details.*?India\s+(.*?)(?=\s+Financial Approval|Service Provider|Organisation|Buyer Details|$)/is", $cleanText, $m)) {
            $val = $this->cleanValue($m[1]);
            // Remove leading S.No if captured
            $val = preg_replace('/^\d+\s+/', '', $val);
            $fields['service_desc'] = $val;
        }
        if (preg_match("/IFD Concurrence\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['ifd_concurrence'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Designation of Administrative Approval\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['admin_approval'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Designation of Financial Approval\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['financial_approval'] = $this->cleanValue($m[1]);
        }
        // Seller / Service Provider Details
        if (preg_match("/Service Provider Details.*?GeM Seller ID\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['seller_id'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Service Provider Details.*?Company Name\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['company'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Service Provider Details.*?Contact No\.\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['seller_contact'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Service Provider Details.*?Email ID\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['seller_email'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Service Provider Details.*?Address\s*:\s*([^|]+)/is", $cleanText, $m)) {
            $fields['seller_address'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/MSME Registration number\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['msme_no'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/MSME Status as verified by buyer\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['msme_status'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/MSE Social Category\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['mse_category'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/MSE Gender\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['mse_gender'] = $this->cleanValue($m[1]);
        }
        
        // Service Details
        if (preg_match("/Service Start Date.*?:\s*([^|~]+)/i", $cleanText, $m)) {
            $fields['service_start'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Service End Date\s*:\s*([^|~]+)/i", $cleanText, $m)) {
            $fields['service_end'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Category Name\s*:\s*([^|]+)/i", $cleanText, $m)) {
            $fields['category'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Billing Cycle\s*:\s*([A-Za-z]+)/i", $cleanText, $m)) {
            $fields['billing_cycle'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/District\s+([A-Za-z0-9\/]+)/i", $cleanText, $m)) {
            $fields['district'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Zipcode\s+([A-Za-z0-9\/]+)/i", $cleanText, $m)) {
            $fields['zipcode'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Vehicle Type\s+([A-Za-z0-9\/]+)/i", $cleanText, $m)) {
            $fields['vehicle_type'] = $this->cleanValue($m[1]);
        }
        if (preg_match("/Type of car.*?options\)\s*(.*?)(?=\s+Usage Variant|$)/is", $cleanText, $m)) {
            $fields['car_type'] = $this->cleanValue($m[1]);
        }
        // Search for GSTINs
        if (preg_match_all("/[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}/", $cleanText, $m)) {
            $fields['gstin_buyer'] = $m[0][0] ?? "";
            $fields['gstin_seller'] = $m[0][1] ?? ($m[0][0] ?? "");
        }

        // Amount / Contract Value
        if (preg_match("/Total Contract Value Including All Duties and Taxes\(INR\)\s*([0-9,.]+)/i", $cleanText, $m)) {
            $fields['amount'] = str_replace(',', '', $m[1]);
        } elseif (preg_match("/Total Contract Value\s*([0-9,.]+)/i", $cleanText, $m)) {
            $fields['amount'] = str_replace(',', '', $m[1]);
        }

        // Duration
        if (preg_match("/Duration in Months\s*(\d+)/i", $cleanText, $m)) {
            $fields['duration'] = $m[1];
        }

        return $fields;
    }

    /**
     * Cleans a value by removing non-ASCII characters (like Hindi) 
     * and trimming extra spaces.
     */
    private function cleanValue($val) {
        // Remove anything that is not a standard printable ASCII character
        // This effectively removes Hindi characters
        $val = preg_replace('/[^\x20-\x7E]/', '', $val);
        
        // Remove common labels that might have been captured at the end of the value
        // Using word boundaries and ensuring it's near the end to avoid cutting off addresses like "Office of..."
        $val = preg_replace('/\s+(Department|Organisation|Office Zone|Buyer Details|Seller Details|Contact No).*$/i', '', $val);
        
        // Remove artifact characters like "P", "J", "Q", "QJ", "[", "]" if they are artifacts
        $val = preg_replace('/\b[PQJ]\b/i', '', $val);
        $val = preg_replace('/\bQJ\b/i', '', $val);
        $val = str_replace(['[', ']', '|', '"'], '', $val);
        
        // Remove common artifact strings
        $artifacts = [
            'Dश', 'D b', 'v w x', 'y MSE', 'z GST/TAX', 'D ( )', '~', 'y Category', 'yMSE', '* z GST/TAX'
        ];
        foreach ($artifacts as $art) {
            $val = str_ireplace($art, '', $val);
        }
        
        // Remove trailing single letters and artifact quotes that are often leftovers from Hindi words
        $val = preg_replace('/\s+[A-Za-z]\s*$/', '', $val);
        $val = preg_replace('/"\s*$/', '', $val);
        $val = preg_replace('/^\s*"/', '', $val);
        
        // Final trim and cleanup
        $val = trim($val);
        $val = preg_replace('/\s+/', ' ', $val);
        return trim($val, ' "');
    }
}
?>
