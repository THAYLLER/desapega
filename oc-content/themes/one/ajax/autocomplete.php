<?php 
	   /*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
	if(!empty($_GET["value"])){
		define('ABS_PATH', dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/');	
		require_once ABS_PATH . 'oc-load.php';		
		function word_highlight_auto($txt, $search_text, $len = 50, $start_tag = '<strong>', $end_tag = '</strong>') {
			$txt = str_replace("\n", ' ', $txt);
			$txt = trim($txt);
			if( mb_strlen($txt, 'utf8') > $len ) {
				$txt = mb_substr($txt, 0, $len, 'utf-8') . "...";
			}
			$query = $search_text;
			$query = str_replace(array('(',')','+','-','~','>','<'), array('','','','','','',''), $query);
			
			$query = str_replace(
			array('\\', '^', '$', '.', '[', '|', '?', '*', '{', '}', '/', ']'),
			array('\\\\', '\\^', '\\$', '\\.', '\\[', '\\|', '\\?', '\\*', '\\{', '\\}', '\\/', '\\]'),
			$query);
			
			$query = preg_replace('/\s+/', ' ', $query);
			
			$words = array();
			if(preg_match_all('/"([^"]*)"/', $query, $matches)) {
				$l = count($matches[1]);
				for($k=0;$k<$l;$k++) {
					$words[] = $matches[1][$k];
				}
			}
			
			$query = trim(preg_replace('/\s+/', ' ', preg_replace('/"([^"]*)"/', '', $query)));
			$words = array_merge($words, explode(" ", $query));
			
			foreach($words as $word) {
				if($word!='') {
					$txt = preg_replace("/(\PL|\s+|^)($word)(\PL|\s+|$)/i", "$01" . $start_tag . "$02". $end_tag . "$03", $txt);
				}
			}
			return $txt;
		}
		
		$value = Params::getParam("value");
		$dao = new DAO();
		$dao->dao->select('r.pk_i_id, r.fk_i_category_id, c.s_title');
		$dao->dao->from(DB_TABLE_PREFIX.'t_item'. ' r');
		$dao->dao->join(DB_TABLE_PREFIX.'t_item_description'. ' c', 'c.fk_i_item_id = r.pk_i_id');
		$dao->dao->where('r.b_enabled = 1');
		$dao->dao->where('r.b_active = 1');
		$dao->dao->like('c.s_title', $value);
		$dao->dao->limit(0, 10);	
		$result = $dao->dao->get();
		$results = $result->result();
		if(!empty($results)){
			foreach($results as $c){ 
			$category =	Category::newInstance()->findByPrimaryKey($c['fk_i_category_id']);
				?>
			<p><a href="<?php echo osc_base_url(true);?>?page=item&id=<?php echo $c['pk_i_id']; ?>"><?php echo word_highlight_auto( $c['s_title'], $value); ?><strong class="auto_ct"><?php _e('category ', 'one'); ?><b><?php echo $category['s_name']; ?></b></strong><span><?php _e('See', 'one'); ?> >></span></a></p>
			<?php }
			} else {
			echo 0;
		}
	}
?>