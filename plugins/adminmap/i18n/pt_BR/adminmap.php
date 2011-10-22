<?php
/**
 *  Admin Map English Language file
 *
 * This plugin was written for Ushahidi Liberia, by the contractors of Ushahidi Liberia
 * 2011
 *
 * @package    Admin Map plugin
 * @author     Carter Draper <carjimdra@gmail.com>
 * @author     Kpetermeni Siakor <tksiakor@gmail.com>
 * 
 */ 

	$lang = array(
	'admin_map_main_menu_tab' => 'Mapa Administrativa',
	'big_map_main_menu_tab' => 'Mapa Geral',
	'boolean_operators' => 'Booleanos:',
	'FILTERS' => 'FILTROS',
	'Categories' => 'Categorias',
	'TIME_LINE' => 'LINHA TEMPORAL',
	'ORHEADER'  => 'OU',
	'ORBODY' =>				'O operador OU permite que você veja todos os relatórios que sejam abrangidos por qualquer uma das categorias que você selecionar.
                                                         <br/>
                                                         Por exemplo, se você tivesse selecionado categorias A, B e C, então você deve ver todos os relatórios que foram
                                                         rotulados como pertencentes à categoria A ou <strong> </ strong> B <strong> ou </ strong> C. Alguns dos relatórios
                                                         mostrado só pode cair sob a categoria A. Outros só pode cair sob a categoria C. Alguns podem cair sob as duas
                                                         categoria A e B. <br/>
                                                         Quando o operador OR é selecionado, os pontos serão coloridas de acordo com as categorias que estão subordinadas.
                                                         Por exemplo, se você tiver selecionado categorias A e B, onde A é B é vermelha e azul, em seguida, os relatórios
                                                         que só são classificados como A terá pontos vermelhos, e os relatórios que são apenas classificados como B terá
                                                         pontos azuis. Se um relatório cai sob A e B as duas cores - vermelho e azul - serão fundidos e que o relatório será
                                                         ser mostrados com um ponto roxo - a cor resultante da fusão.',
	'OR' => 'OU',
	'ANDHEADER' => 'E',
	'ANDBODY' =>				'O operador AND permite que você veja todos os relatórios que se enquadram todas as categorias que você selecionar. <br/>
                                                         Por exemplo, se você tivesse selecionado categorias A, B e C, então você deve ver todos os relatórios que foram
                                                         rotulados como pertencentes à categoria A e <strong> </ strong> B <strong> e </ strong> C. <br/>
                                                         Quando o operador AND é selecionado, os pontos serão coloridas de acordo com as categorias que você selecionou.
                                                         Uma vez que todos os relatórios apresentados serão abrangidas todas as categorias selecionadas, todas as cores das categorias
                                                         selecionados serão fundidas e os pontos vão ter a cor resultante da fusão.',
	'AND' => 'E',

// Kpetermeni's Entries
	'header_info' => 'Este mapa mostra todos os relatórios que estão autorizados a ver. Isto inclui relatórios não aprovados.',
	'logical_operators' => 'Operadores lógicos',
	'unapproved_reports' => 'Mostrar relatórios não aprovados como negro',
	'status_filters' => 'Filtros estado',
	'or' => 'OU',
	'and' => 'E',
	'or_details' => 'Mostrar todos os relatórios que caem sob, pelo menos, uma das categorias selecionadas abaixo',
	'and_details' => 'Mostrar todos os relatórios que se enquadram todas as categorias selecionadas abaixo',
	'show_all_reports' => 'Mostrar todos os relatórios',
	'embedd_html' => 'Para incorporar este mapa no seu próprio site use este HTML',
	//john's entries
	'group_categories' => 'Categorias grupo',
	'site_categories' => 'Categorias local',
);
