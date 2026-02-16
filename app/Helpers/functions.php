<?php

function formatBD($amount)
{
    if (!$amount || $amount == 0) return 0;

    $amount = round($amount);

    $lastThree = substr($amount, -3);
    $restUnits = substr($amount, 0, -3);

    if ($restUnits != '') {
        $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ',', $restUnits);
        $formatted = $restUnits . ',' . $lastThree;
    } else {
        $formatted = $lastThree;
    }

    return $formatted;
}