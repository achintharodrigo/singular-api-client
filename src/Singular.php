<?php

namespace AchinthaRodrigo\SingularApiClient;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Singular
{
    private $baseUri = '';
    private $apiKey = '';
    private $request;
    private $timeBreakDown = [
        'day' => 'day',
        'week' => 'week',
        'month' => 'month',
        'all' => 'all',
    ];
    private $cohortPeriods = [
        '1d' => '1d',
        '3d' => '3d',
        '5d' => '5d',
        '7d' => '7d',
        '14d' => '14d',
        '30d' => '3d',
        'ltv' => 'LTV',
        'actual' => 'Actual',
    ];
    private $metrics = [
        'arpu' => 'ARPU',
        'custom_clicks' => 'Clicks',
        'clicks_discrepancy' => 'Clicks Discrepancy',
        'completed_video_view_rate' => 'Completed Video View Rate',
        'completed_video_views' => 'Completed Video Views',
        'adn_cost' => 'Cost',
        'ctr' => 'CTR',
        'cvr' => 'CVR',
        'daily_active_users' => 'DAU',
        'ecpc' => 'eCPC',
        'ecpi' => 'eCPI',
        'ecpi_original_cost' => 'eCPI (Orig. Cost)',
        'ecpm' => 'eCPM (per Mille)',
        'ad_ecpm' => 'eCPM',
        'adn_estimated_total_conversions' => 'Est. Conversion',
        'custom_impressions' => 'Impressions',
        'impressions_discrepancy' => 'Impressions Discrepancy',
        'custom_installs' => 'Installs',
        'installs_discrepancy' => 'Installs Discrepancy',
        'adn_clicks' => 'Network Clicks',
        'adn_impressions' => 'Network Impressions',
        'adn_installs' => 'Network Installs',
        'ocvr' => 'oCVR',
        'adn_original_cost' => 'Original Cost',
        'adn_original_currency' => 'Original Currency',
        'original_revenue' => 'Original Revenue',
        'tracker_reengagements' => 'Re-Engagements',
        'revenue' => 'Revenue',
        'roi' => 'ROI',
        'tracker_clicks' => 'Tracker Clicks',
        'tracker_installs' => 'Tracker Installs',
        'video_views' => 'Video Views',
        'video_views_25pct' => 'Video Views 25%',
        'video_views_50pct' => 'Video Views 50%',
        'video_views_75pct' => 'Video Views 75%',
    ];
    private $dimensions =  [
        'adn_account_id' => 'Account ID',
        'adn_account_name' => 'Account Name',
        'app' => 'App',
        'asset_id' => 'Asset ID',
        'asset_name' => 'Asset Name',
        'bid_amount' => 'Bid Amount',
        'bid_strategy' => 'Bid Strategy',
        'unified_campaign_id' => 'Campaign ID',
        'unified_campaign_name' => 'Campaign Name',
        'campaign_objective' => 'Campaign Objective',
        'adn_campaign_url' => 'Campaign URL',
        'adn_click_type' => 'Click Type',
        'conversion_type' => 'Conversion Type',
        'country_field' => 'Country',
        'creative_height' => 'Creative Height',
        'creative_id' => 'Creative ID',
        'creative_name' => 'Creative Name',
        'creative_reported_url' => 'Creative Reported URL',
        'creative_type' => 'Creative Type',
        'creative_width' => 'Creative Width',
        'device_model' => 'Device Model',
        'dma_id_field' => 'DMA ID',
        'dma_name_field' => 'DMA Name',
        'fb_adset_id' => 'Facebook Ad Set ID',
        'fb_campaign_id' => 'Facebook Campaign ID',
        'min_roas' => 'Facebook ROAS Bid',
        'final_url' => 'Final URL',
        'is_uac' => 'Is UAC',
        'keyword' => 'Keyword',
        'keyword_id' => 'Keyword ID',
        'adn_campaign_id' => 'Network Campaign ID',
        'adn_campaign_name' => 'Network Campaign Name',
        'adn_creative_id' => 'Network Creative ID',
        'adn_creative_name' => 'Network Creative Name',
        'adn_sub_campaign_id' => 'Network Sub Campaign ID',
        'adn_sub_campaign_name' => 'Network Sub Campaign Name',
        'original_bid_amount' => 'Original Bid Amount',
        'original_metadata_currency' => 'Original Bid Currency',
        'adn_original_currency' => 'Original Currency',
        'os' => 'OS',
        'platform' => 'Platform',
        'site_public_id' => 'Public Id',
        'publisher_id' => 'Publisher ID',
        'publisher_site_id' => 'Publisher Site ID',
        'publisher_site_name' => 'Publisher Site Name',
        'retention' => 'Retargeting',
        'source' => 'Source',
        'standardized_bid_strategy' => 'Standardized Bid Strategy',
        'standardized_bid_type' => 'Standardized Bid Type',
        'adn_status' => 'Status',
        'adn_sub_adnetwork_name' => 'Sub Ad Network',
        'sub_campaign_id' => 'Sub Campaign ID',
        'sub_campaign_name' => 'Sub Campaign Name',
        'creative_text' => 'Text',
        'tracking_url' => 'Tracking URL',
        'tracker_creative_id' => 'Tracker Creative ID',
        'tracker_creative_name' => 'Tracker Creative Name',
        'tracker_name' => 'Tracker Name',
        'adn_utc_offset' => 'UTC Offset',
        'singular_campaign_id' => 'Singular Campaign ID',
        'creative_hash' => 'Creative Hash',
        'creative_image_hash' => 'Creative Image Hash',
        'singular_creative_id' => 'Singular Creative ID',
        'creative_is_video' => 'Creative Is Video',
        'creative_url' => 'Creative URL',
    ];

    public function __construct()
    {
        $this->baseUri = config('singular.base_url');
        $this->apiKey = config('singular.SINGULAR_API_KEY');
        $this->request = Http::withHeaders([
            'Authorization' => $this->apiKey
        ]);
    }

    public function getDefaultTimeBreakdown() :array
    {
        return $this->timeBreakDown;
    }

    public function getDefaultMetrics() :array
    {
        return $this->metrics;
    }

    public function getDefaultDimensions() :array
    {
        return $this->dimensions;
    }

    public function getCohortPeriods() :array
    {
        return $this->cohortPeriods;
    }

    public function getDataAvailability($date, $format = 'json', $showNonActive = true) :array
    {
        $availableDate = Carbon::parse($date)->format('Y-m-d');
        $response = $this->request->get($this->baseUri . 'v2.0/data_availability_status', [
            'data_date' => $availableDate,
            'format' => $format,
            'display_non_active_sources' => $showNonActive ? 'true' : 'false'
        ]);
        return $this->formatResponse($response);
    }

    public function getReportStatus($id) :array
    {
        $response = $this->request->get($this->baseUri . 'v2.0/get_report_status', [
            'report_id' => $id,
        ]);
        return $this->formatResponse($response);
    }

    public function getFilters() :array
    {
        $response = $this->request->get($this->baseUri . 'v2.0/reporting/filters');
        return $this->formatResponse($response);
    }

    public function getCustomDimensions() :array
    {
        $response = $this->request->get($this->baseUri . 'custom_dimensions');
        return $this->formatResponse($response);
    }

    public function getCohortMetrics() :array
    {
        $response = $this->request->get($this->baseUri . 'cohort_metrics');
        return $this->formatResponse($response);
    }

    public function getConversionMetrics() :array
    {
        $response = $this->request->get($this->baseUri . 'conversion_metrics');
        return $this->formatResponse($response);
    }

    public function getAdMonetizationReport(
        $start,
        $end,
        $dimensions = [],
        $metrics = [],
        $format = 'json',
        $timeBreakDown = 'all',
        $countryCodeFormat = 'iso3'
    )  :array {
        $start = Carbon::parse($start)->format('Y-m-d');
        $end = Carbon::parse($end)->format('Y-m-d');
        $response = $this->request->get($this->baseUri . 'v2.0/admonetization/reporting', [
            'start_date' => $start,
            'end_date' => $end,
            'format' => $format,
            'dimensions' => implode(',', $dimensions),
            'metrics' => implode(',', $metrics),
            'time_breakdown' => $timeBreakDown,
            'country_code_format' => $countryCodeFormat
        ]);
        return $this->formatResponse($response);
    }

    public function getApps() :array
    {
        $response = $this->request->get($this->baseUri . 'v1/links/discover_apps');
        return $this->formatResponse($response);
    }

    public function getAvailablePartners($appId) :array
    {
        $response = $this->request->get($this->baseUri . 'v1/links/discover_available_partners', [
            'singular_app_id' => $appId,
        ]);
        return $this->formatResponse($response);
    }

    public function getLinks($appId = '', $partnerId = '', $linkId = '', $includeArchived = true) :array
    {
        $response = $this->request->get($this->baseUri . 'v1/links/view', [
            'singular_app_ids' => $appId,
            'singular_partner_ids' => $partnerId,
            'tracking_link_ids' => $linkId,
            'include_archived_links' => $includeArchived ? 'true' : 'false'
        ]);
        return $this->formatResponse($response);
    }

    public function getCustomLinks($appId = '', $customSource = '', $linkId = '', $includeArchived = true) :array
    {
        $response = $this->request->get($this->baseUri . 'v1/links/view_custom', [
            'singular_app_ids' => $appId,
            'custom_source_name' => $customSource,
            'tracking_link_ids' => $linkId,
            'include_archived_links' => $includeArchived ? 'true' : 'false'
        ]);
        return $this->formatResponse($response);
    }

    public function createReport(
        $start,
        $end,
        $dimensions = [],
        $metrics = [],
        $timeBreakDown = 'all',
        $format = 'json',
        $countryCodeFormat = 'iso3'
    ) :string {
        $start = Carbon::parse($start)->format('Y-m-d');
        $end = Carbon::parse($end)->format('Y-m-d');

        $response = $this->request->post($this->baseUri . 'v2.0/create_async_report')
            ->body([
                'start_date' => $start,
                'end_date' => $end,
                'format' => $format,
                'dimensions' => implode(',', $dimensions),
                'metrics' => implode(',', $metrics),
                'time_breakdown' => $timeBreakDown,
                'country_code_format' => $countryCodeFormat
            ]);

        return json_decode($response)->value->report_id;
    }

    public function getReportData($id) :string
    {
        $status = $this->getReportStatus($id);
        $filePath = $status['data']['value']['download_url'];

        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_ENCODING, '');
        curl_setopt($curlSession, CURLOPT_URL, $filePath);

        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);

        return json_encode($jsonData);
    }

    private function formatResponse($response)
    {
        return [
            'status' => $response->getStatusCode(),
            'msg' => $response->getReasonPhrase(),
            'data' => $response->json()
        ];
    }
}
