<?php

/**
 * Redirige vers une page, en faisant un exit
 *
 * @param string $location
 * @return void
 */
function redirect(string $location)
{
  header('Location: ' . $location);
  exit;
}