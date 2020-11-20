<?php

namespace AchinthaRodrigo\SingularApiClient;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Singular
{
    private $baseUri = '';
    private $apiKey = '';
    private $request;

    public function __construct()
    {
        $this->baseUri = config('singular.base_url');
        $this->apiKey = config('singular.SINGULAR_API_KEY');
        $this->request = Http::withHeaders([
            'Authorization' => $this->apiKey
        ]);
    }

    public function getDataAvailability($date, $format = 'json', $showNonActive = true)
    {
        $availableDate = Carbon::parse($date)->format('Y-m-d');
        $response = $this->request->get($this->baseUri . 'v2.0/data_availability_status', [
            'data_date' => $availableDate,
            'format' => $format,
            'display_non_active_sources' => $showNonActive ? 'true' : 'false'
        ]);
        return $this->formatResponse($response);
    }

    public function getReportStatus($id)
    {
        $response = $this->request->get($this->baseUri . 'v2.0/get_report_status', [
            'report_id' => $id,
        ]);
        return $this->formatResponse($response);
    }

    public function getFilters()
    {
        $response = $this->request->get($this->baseUri . 'v2.0/reporting/filters');
        return $this->formatResponse($response);
    }

    public function getCustomDimensions()
    {
        $response = $this->request->get($this->baseUri . 'custom_dimensions');
        return $this->formatResponse($response);
    }

    public function getCohortMetrics()
    {
        $response = $this->request->get($this->baseUri . 'cohort_metrics');
        return $this->formatResponse($response);
    }

    public function getConversionMetrics()
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
    ) {
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

    public function getApps()
    {
        $response = $this->request->get($this->baseUri . 'v1/links/discover_apps');
        return $this->formatResponse($response);
    }

    public function getAvailablePartners($appId)
    {
        $response = $this->request->get($this->baseUri . 'v1/links/discover_available_partners', [
            'singular_app_id' => $appId,
        ]);
        return $this->formatResponse($response);
    }

    public function getLinks($appId = '', $partnerId = '', $linkId = '', $includeArchived = true)
    {
        $response = $this->request->get($this->baseUri . 'v1/links/view', [
            'singular_app_ids' => $appId,
            'singular_partner_ids' => $partnerId,
            'tracking_link_ids' => $linkId,
            'include_archived_links' => $includeArchived ? 'true' : 'false'
        ]);
        return $this->formatResponse($response);
    }

    public function getCustomLinks($appId = '', $customSource = '', $linkId = '', $includeArchived = true)
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
        $format = 'json',
        $timeBreakDown = 'all',
        $countryCodeFormat = 'iso3'
    ) {
        $start = Carbon::parse($start)->format('Y-m-d');
        $end = Carbon::parse($end)->format('Y-m-d');
        return $this->request->post($this->baseUri . 'v2.0/create_async_report')
            ->body([
                'start_date' => $start,
                'end_date' => $end,
                'format' => $format,
                'dimensions' => implode(',', $dimensions),
                'metrics' => implode(',', $metrics),
                'time_breakdown' => $timeBreakDown,
                'country_code_format' => $countryCodeFormat
            ]);
    }

    public function getReportData($id)
    {
        $status = $this->getReportStatus($id);
        $filePath = $status['value']['download_url'];

        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_ENCODING, '');
        curl_setopt($curlSession, CURLOPT_URL, $filePath);

        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);

        return $jsonData;
    }

    private function formatResponse($response)
    {
        return $response->json();
    }
}
