<?php

class Helper
{
    /**
     * Format a number to currency.
     *
     * @param float $amount
     * @param string $currencySymbol
     * @return string
     */
    public static function formatCurrency(float $amount, string $currencySymbol = 'R$'): string
    {
        return $currencySymbol . number_format($amount, 2, ',', '.');
    }

    /**
     * Generate a unique identifier for quotes.
     *
     * @return string
     */
    public static function generateQuoteId(): string
    {
        return 'QUOTE-' . strtoupper(uniqid());
    }

    /**
     * Validate an email address.
     *
     * @param string $email
     * @return bool
     */
    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Sanitize a string to prevent XSS attacks.
     *
     * @param string $string
     * @return string
     */
    public static function sanitizeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Calculate the total price based on quantity and unit price.
     *
     * @param int $quantity
     * @param float $unitPrice
     * @return float
     */
    public static function calculateTotalPrice(int $quantity, float $unitPrice): float
    {
        return $quantity * $unitPrice;
    }
}