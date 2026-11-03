<?php


// Payments

/**
 * return payment from it's type
 *
 * @param  mixed $type
 * @return string
 */
function getPaymentType($type)
{
    switch ($type) {
        case config('variables.payments.olimpiade_1'):
            return 'Pembayaran Olimpiade Tahap 1';

        case config('variables.payments.olimpiade_2'):
            return 'Pembayaran Olimpiade Tahap 2';

        case config('variables.payments.infografis_1'):
            return 'Pembayaran Infografis';

        default:
            return 'Pembayaran';
    }
}


// Soal * Jawaban


/**
 * getGoogleDocsLink
 *
 * open pdf or docs file in google docs
 * 
 * @param  mixed $url
 * @return void
 */
function getGoogleDocsLink($url)
{
    return "https://docs.google.com/gview?url={$url}";
}


/**
 * getSoalDownloadName
 *
 * @param  mixed $soal
 * @return void
 */
function getSoalDownloadName($soal)
{
    return $soal->name . '-' . $soal->type . '-' . $soal->code . '.pdf';
}