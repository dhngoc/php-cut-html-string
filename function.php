<?php
/**
 * Cut HTML string and keep HTML tag
 * @author ngoc <todo@imind.systems>
 * @param  {HTML STRING} $string
 * @param  {array}  $option
 * @return {HTML STRING}
 *
 */
function cutHtmlString($string, $option = array()) {
	$max_size       = isset($options['max_size']) ? $options['max_size'] : 100;
    $reg_open_tags = '/^<([^\s|\>|\/]+)\s?(\w+=.*?)?\/?>/';
   	$reg_close_tags = '/^<\/([^\s]+?)>/';
    $act_str        = '';
   	$act_size       = 0;
    $opened_tags    = array();

	while ($act_size < $max_size) {

		if (strlen($string) == 0) return $act_str;
		$res_match = preg_match($reg_open_tags, $string, $matches);

	    if ($res_match) { 
	      // Get opened tags at the start of the string.
	      if (isset($matches[2])) {
	      	$tag = '<'.$matches[1].' '.$matches[2].'>';
	      } else {
	      	$tag = '<'.$matches[1].'>';
	      }
	      $act_str = $act_str . $tag;
	      $string = substr ( $string , strlen($tag));
	      
	      if ($tag[strlen($tag)-2] != '/')
	    	array_push($opened_tags, $matches[1]);
	    } else if (preg_match($reg_close_tags, $string, $match2)) { 
	      // Get closed tags at the start of the string.
	      $tag = '</'.$match2[1].'>';
	      $act_str = $act_str . $tag;
	      
	      $string = substr ( $string , strlen($tag));

	      if ($match2[1] == $opened_tags[count($opened_tags) -1])
	        array_pop($opened_tags);
	      else
	        return strip_tags($act_str);
	    } else { 
	      // Get non-tag char at the start of the string
	      $act_str = $act_str . $string[0];
	      
	      $string = substr($string, 1);
	      $act_size++;

	    }
	  }

	  //restore the unclosed tags.
	  $opened_tags = array_reverse($opened_tags);
	  foreach ($opened_tags as $key => $item) {
	  	$act_str = $act_str . '</'.$item.'>';	
	  }
	  
	  return $act_str;
}