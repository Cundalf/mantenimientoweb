<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function imprimirTicket($id,$usuario,$sector,$ubicacion,$interno,$descripcion){
	error_reporting(E_ALL);
	
	$handle = printer_open(PRINTER_TICKET);
	#printer_set_option($ph, PRINTER_MODE, "RAW");
	printer_start_doc($handle);
	printer_start_page($handle);

	$font = printer_create_font("Arial", 50, 14, PRINTER_FW_MEDIUM, false, false, false, 0);   
	printer_select_font($handle, $font);
	printer_draw_text($handle, "SOLICITUD DE MANTENIMIENTO", 45, 1);
	printer_delete_font($font);
	
	$font = printer_create_font("Arial", 30, 12, PRINTER_FW_MEDIUM, false, false, false, 0);   
	printer_select_font($handle, $font);
	printer_draw_text($handle, "Numero de reclamo: ", 20, 100);
	printer_delete_font($font);
   
	$font = printer_create_font("Arial", 110, 75, PRINTER_FW_MEDIUM, false, false, false, 0);
	printer_select_font($handle, $font);
	printer_draw_text($handle, str_pad($id, 5, "0", STR_PAD_LEFT), 55, 160);
	printer_delete_font($font);
   
	$font = printer_create_font("Arial", 30, 12, PRINTER_FW_BOLD, false, false, false, 0);   
	printer_select_font($handle, $font);
	printer_draw_text($handle, "Solicitud:", 20, 400);
	printer_draw_text($handle, "Solicitante: ", 20, 450);
	printer_draw_text($handle, "Sector: ", 20, 500);
	printer_draw_text($handle, "Ubicacion: ", 20, 550);
	printer_draw_text($handle, "Interno: ", 20, 600);
	printer_draw_text($handle, "Descripcion:", 20, 650);
	
	printer_delete_font($font);
	
	$font = printer_create_font("Arial", 30, 12, PRINTER_FW_MEDIUM, false, false, false, 0);   
	printer_select_font($handle, $font);
	printer_draw_text($handle, strtoupper($usuario), 170, 450);
	printer_draw_text($handle, strtoupper($sector), 170, 500);
	printer_draw_text($handle, strtoupper($ubicacion), 170, 550);
	printer_draw_text($handle, strtoupper($interno), 170, 600);
	
	$descripcion = strtoupper($descripcion);
	$descripcion = explode("\n", $descripcion);
	$descripcion = array_filter($descripcion, 'trim');
	
	$iY=650;
	foreach ($descripcion as $line) {
		$iY += 50;
		printer_draw_text($handle, $line, 40, $iY);
	} 
	$iY += 120;
	printer_draw_text($handle, date("d/m/y H:i"), 20, $iY);
	printer_delete_font($font);
   
	printer_end_page($handle);
	printer_end_doc($handle);
	printer_close($handle);

}