<?php

function star(int $star = 0): string
{
  $html = '';

  for ($i = 0; $i < $star; $i++) {
    $html += '⭐';
  }

  return $html;
}
