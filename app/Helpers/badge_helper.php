<?php

function status($status): string
{

  switch ($status) {
    case 'Menunggu Pembayaran':
      $html = "<span class='badge text-bg-primary'>$status</span>";
      break;

    case 'Menunggu Konfirmasi Pembayaran':
    case 'Menunggu Konfirmasi COD':
    case 'Dikirim':
    case 'Diproses':
      $html = "<span class='badge text-bg-info text-white'>$status</span>";
      break;

    case 'Selesai':
      $html = "<span class='badge text-bg-success'>$status</span>";
      break;

    case 'Dibatalkan':
      $html = "<span class='badge text-bg-danger'>$status</span>";
      break;

    default:
      $html = "<span class='badge text-bg-primary'>$status</span>";
      break;
  }

  return $html;
}
