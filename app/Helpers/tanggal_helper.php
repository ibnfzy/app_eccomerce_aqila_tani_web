<?php

function tahun_transaksi()
{
  $db = db_connect();

  $data = $db->table('transaksi')->select('YEAR(created_at) as tahun')->groupBy('tahun')->orderBy('tahun', 'ASC')->get()->getResultArray();

  if (is_null($data)) {
    return null;
  }

  $html = '';

  foreach ($data as $key => $value) {
    $html .= "<option value='{$value['tahun']}'>{$value['tahun']}</option>";
  }

  return $html;
}
