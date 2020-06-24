<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_handler {
		
	function ajax_process($urut=TRUE,$tbl_name='',$field=array(),$id_column='',$method_link=array(),$method_delimiter='',$icon_src=array()){
		//CEK DULU REQUESTNYA DARI AJAX ATO BUKAN !
		$CI =& get_instance();
		if($CI->input->is_ajax_request()){
			
			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
			 * Easy set variables
			 */
			
			/* Array of database columns which should be read and sent back to DataTables. Use a space where
			 * you want to insert a non-database field (for example a counter or static image)
			 */
			$aColumns = $field;
			
			/* Indexed column (used for fast and accurate table cardinality) */
			$sIndexColumn = $id_column;
			
			/* DB table to use */
			$sTable = $tbl_name;
			
			/* 
			 * Paging
			 */
			$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
					mysql_real_escape_string( $_GET['iDisplayLength'] );
			}
			
			
			/*
			 * Ordering
			 */
			$sOrder = "";
			if ( isset( $_GET['iSortCol_0'] ) )
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
				{
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
					{
						$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
							mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
					}
				}
				
				$sOrder = substr_replace( $sOrder, "", -2 );
				if ( $sOrder == "ORDER BY" )
				{
					$sOrder = "";
				}
			}
			
			
			/* 
			 * Filtering
			 * NOTE this does not match the built-in DataTables filtering which does it
			 * word by word on any field. It's possible to do here, but concerned about efficiency
			 * on very large tables, and MySQL's regex functionality is very limited
			 */
			$sWhere = "";
			if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
			{
				$sWhere = "WHERE (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
			}
			
			/* Individual column filtering */
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
				{
					if ( $sWhere == "" )
					{
						$sWhere = "WHERE ";
					}
					else
					{
						$sWhere .= " AND ";
					}
					$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				}
			}
			
			
			/*
			 * SQL queries
			 * Get data to display
			 */
			$sQuery = "
				SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
				FROM   $sTable
				$sWhere
				$sOrder
				$sLimit
				";
			//echo $sQuery;die();
			$rResult = $CI->db->query($sQuery)->result_array();
			//print_r($rResult);die();
			/* Data set length after filtering */
			$sQuery = "
				SELECT FOUND_ROWS() as row_found
			";
			$rResultFilterTotal = $CI->db->query($sQuery)->result_array();
			//print_r($rResultFilterTotal);die();
			//$aResultFilterTotal = count($rResultFilterTotal);
			//$iFilteredTotal = $aResultFilterTotal[0];
			$iFilteredTotal = $rResultFilterTotal[0]['row_found'];
			
			
			/* Total data set length */
			$sQuery = "
				SELECT COUNT(`".$sIndexColumn."`) as row_all
				FROM   $sTable
			";
			$rResultTotal = $CI->db->query($sQuery)->result_array();
			//$aResultTotal = count($rResultTotal);
			//$iTotal = $aResultTotal[0];
			$iTotal = $rResultTotal[0]['row_all'];
			
			/*
			 * Output
			 */
			if(!isset($_GET['sEcho'])){
				$_GET['sEcho'] = '1';
			}
			
			$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
			);
			
			if($urut){
				$hit = '1';
			}
			//while ( $aRow = mysql_fetch_array( $rResult ) )
			foreach($rResult as $aRow)
			{
				$row = array();
				//Add content for "No." Column
				if($urut){
					$row[] = $hit;				
					$hit++;
				}
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					if ( $aColumns[$i] == "version" )
					{
						/* Special output formatting for 'version' column */
						$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
					}
					else if ( $aColumns[$i] != ' ' )
					{
						/* General output */
						$row[] = $aRow[ $aColumns[$i] ];
					}
				}
				//Add content for "Action" Column
				if(!empty($method_link)){
					$full_action_link = '';
					foreach($method_link as $action_type=>$action_link){
						$create_action = '<a rel="tooltip-top" href="'.$action_link.$method_delimiter.'" original-title="'.$action_type.'"><img src="'.$icon_src[$action_type].'"></a>';
						$full_action_link .= $create_action;
					}
				}
				$row[] = $full_action_link;
				$output['aaData'][] = $row;
			}	
			echo json_encode( $output );
		} else {
			$CI->menu_handler->throw_error();
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */