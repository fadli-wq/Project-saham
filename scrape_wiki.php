<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://id.wikipedia.org/wiki/Daftar_perusahaan_yang_tercatat_di_Bursa_Efek_Indonesia');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
$html = curl_exec($ch);
curl_close($ch);

$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

$tables = $xpath->query('//table[contains(@class, "wikitable")]');
$csvData = [["kode", "nama", "sector_id", "harga", "market_cap", "npm", "per", "pbv", "der", "roe", "roa", "dividend_yield", "ytd_return", "volume"]];

foreach ($tables as $table) {
    $rows = $xpath->query('.//tr', $table);
    $isTargetTable = false;
    $kodeIndex = -1;
    $namaIndex = -1;

    foreach ($rows as $rowIndex => $row) {
        $cols = $xpath->query('.//th|.//td', $row);
        
        if ($rowIndex === 0) {
            foreach ($cols as $i => $col) {
                $text = trim($col->textContent);
                if (stripos($text, 'Kode') !== false) $kodeIndex = $i;
                if (stripos($text, 'Nama') !== false || stripos($text, 'Perusahaan') !== false) $namaIndex = $i;
            }
            if ($kodeIndex !== -1 && $namaIndex !== -1) {
                $isTargetTable = true;
            }
            continue;
        }

        if ($isTargetTable && $cols->length > max($kodeIndex, $namaIndex)) {
            $kode = trim($cols->item($kodeIndex)->textContent);
            $nama = trim($cols->item($namaIndex)->textContent);
            
            $nama = preg_replace('/\[\d+\]/', '', $nama);
            $kode = substr($kode, 0, 4);

            if (strlen($kode) === 4 && ctype_alpha($kode)) {
                $sector_id = rand(1, 12);
                $csvData[] = [$kode, $nama, $sector_id, "", "", "", "", "", "", "", "", "", "", ""];
            }
        }
    }
}

$fp = fopen('public/emiten_lengkap.csv', 'w');
foreach ($csvData as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);
echo "Berhasil membuat CSV dengan " . (count($csvData)-1) . " emiten.\n";
