<?php
/**
 * Advanced API Helper for GetOnDeal CMS
 */
class ApiClient {
    private static $baseUrl = getenv('API_BASE_URL') ?: "http://localhost:5000/api";

    public static function get($endpoint) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        return null;
    }

    // Helper for specifically fetching listings with filters
    public static function getListings($params = []) {
        $query = http_build_query($params);
        return self::get("/listings?" . $query);
    }
}

/**
 * Global helper function for backward compatibility or ease of use
 */
function fetchFromApi($endpoint) {
    return ApiClient::get($endpoint);
}
?>
