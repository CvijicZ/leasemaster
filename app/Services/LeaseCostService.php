<?php

namespace App\Services;

class LeaseCostService
{
    const DEPRECIATION_RATE = 0.15;
    const MILEAGE_DEPRECIATION_FACTOR = 0.01;
    const LEASING_PERCENTAGE = 0.15;
    const MIN_VALUE_PERCENTAGE = 0.2; // Minimum residual value as a percentage of the original value
    const INITIAL_PAYMENT_MULTIPLIER = 6; // Number of monthly payments for initial payment

    /**
     * Calculate the leasing costs for a vehicle.
     *
     * @param float $value          Original value of the vehicle.
     * @param float $miles          Total miles driven.
     * @param int   $year           Year of the vehicle's manufacture.
     * @param int   $annualMiles    Expected annual miles (default: 5000).
     * @param int   $contractMonths Lease contract duration in months (default: 24).
     * 
     * @return array
     */
    public function calculateLeasingCost(
        float $value,
        float $miles,
        int $year,
        int $annualMiles = 5000,
        int $contractMonths = 24
    ): array {

        $currentYear = (int) date("Y");
        $age = max(0, $currentYear - $year);
        $depreciatedValue = $value * pow(1 - self::DEPRECIATION_RATE, $age);

        $mileageAdjustment = floor($miles / 10000) * self::MILEAGE_DEPRECIATION_FACTOR;
        $adjustedValue = $depreciatedValue * (1 - $mileageAdjustment);

        $finalValue = max($adjustedValue, $value * self::MIN_VALUE_PERCENTAGE);

        $annualLeasingCost = $finalValue * self::LEASING_PERCENTAGE;
        $monthlyLeasingCost = $annualLeasingCost / 12;

        $mileageImpact = ($annualMiles - 5000) / 10000;
        $adjustedMonthlyPrice = $monthlyLeasingCost + ($mileageImpact * 100);

        $totalPrice = $adjustedMonthlyPrice * $contractMonths;
        $initialPayment = $adjustedMonthlyPrice * self::INITIAL_PAYMENT_MULTIPLIER;

        return [
            'initial_payment' => round($initialPayment, 2),
            'monthly_price' => round($adjustedMonthlyPrice, 2),
            'total_price' => round($totalPrice, 2),
        ];
    }
}
