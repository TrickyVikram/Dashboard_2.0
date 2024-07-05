<?php

if (!function_exists('parseDateString')) {
    /**
     * Clean and parse a date string.
     *
     * @param string $dateString
     * @return \DateTime|null
     */
    function parseDateString($dateString)
    {
        // Remove the comma from the date string
        $cleanedDateString = str_replace(',', '', $dateString);

        // Define the expected format
        $format = 'F d Y H:i:s';

        // Try to create a DateTime object
        $date = \DateTime::createFromFormat($format, $cleanedDateString);

        if ($date && $date->format($format) === $cleanedDateString) {
            return $date;
        } else {
            // Handle the error, for example, log it or return null
            \Log::error("Failed to parse date string: $dateString");
            return null;
        }
    }
}
