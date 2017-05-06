<?php

function formatDate($date, $formatSource, $formatDestination) {
    $date = Carbon\Carbon::createFromFormat($formatSource, $date);
    return $date->format($formatDestination);
}