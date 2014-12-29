<?php
/**
 * Modification of `paginate_links()` Wordpress built-in function.
 * Returns an array of objects describing links instead of generating HTML for links. 
 * @param array $args Same as `paginate_links()` arguments array. Exceptions: `classes` mapping for CSS classes; `type` is ignored
 * @return array Returns an array of objects representing links that can be used to generate HTML
 */
function paginate_links_array($args = '') {
  $defaults = array(
      'base' => '%_%', // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
        //'base' => get_permalink(),
      'format' => '?page=%#%', // ?page=%#% : %#% is replaced by the page number
      'total' => 1,
      'current' => 0,
      'show_all' => false,
      'prev_next' => true,
      'prev_text' => __('&laquo; Previous'),
      'next_text' => __('Next &raquo;'),
      'end_size' => 1,
      'mid_size' => 2,
      'type' => 'plain',  // ignored - always returns an array
      'add_args' => false, // array of query args to add
      'add_fragment' => '',
      "classes" => array(
          "previous" => "prev",
          "next" => "next",
          "numbers" => "page-numbers",
          "current" => "current",
          "dots" => "dots",
      ),
  );

  $args = wp_parse_args($args, $defaults);
  extract($args, EXTR_SKIP);
  array_merge($defaults["classes"], $classes);
  
  // Merge classes
  if (!is_array($classes)) {
    $classes = array();
  }
  foreach ($defaults["classes"] as $class_name => $class_value) {
    if (!array_key_exists($class_name, $classes)) {
      $classes[$class_name] = $class_value;
    }
  }
  
  // Who knows what else people pass in $args
  $total = (int) $total;
  if ($total < 2)
    return;
  $current = (int) $current;
  $end_size = 0 < (int) $end_size ? (int) $end_size : 1; // Out of bounds?  Make it the default.
  $mid_size = 0 <= (int) $mid_size ? (int) $mid_size : 2;
  $add_args = is_array($add_args) ? $add_args : false;
  $r = '';
  $page_links = array();
  $n = 0;
  $dots = false;

  if ($prev_next && $current && 1 < $current) :
    $link = str_replace('%_%', 2 == $current ? '' : $format, $base);
    $link = str_replace('%#%', $current - 1, $link);
    if ($add_args)
      $link = add_query_arg($add_args, $link);
    $link .= $add_fragment;
    $page_links[]= (object)array("classes" => array($classes["previous"], $classes["numbers"]), "url" => apply_filters('paginate_links', $link), "text" => $prev_text, "pagenumber" => $current-1);
  endif;
  for ($n = 1; $n <= $total; $n++) :
    $n_display = number_format_i18n($n);
    if ($n == $current) :
      $page_links[]= (object)array("classes" => array($classes["numbers"], $classes["current"]), "url" => "", "text" => $n_display, "pagenumber" => $n_display);
      $dots = true;
    else :
      if ($show_all || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size )) :
        $link = str_replace('%_%', 1 == $n ? '' : $format, $base);
        $link = str_replace('%#%', $n, $link);
        if ($add_args)
          $link = add_query_arg($add_args, $link);
        $link .= $add_fragment;
        $page_links[]= (object)array("classes" => array($classes["numbers"]), "url" => apply_filters('paginate_links', $link), "text" => $n_display, "pagenumber" => $n_display);
        $dots = true;
      elseif ($dots && !$show_all) :
        $page_links[]= (object)array("classes" => array($classes["numbers"], $classes["more"]), "text" => __('&hellip;'), "pagenumber" => $n_display);
        $dots = false;
      endif;
    endif;
  endfor;
  if ($prev_next && $current && ( $current < $total || -1 == $total )) :
    $link = str_replace('%_%', $format, $base);
    $link = str_replace('%#%', $current + 1, $link);
    if ($add_args)
      $link = add_query_arg($add_args, $link);
    $link .= $add_fragment;
    $page_links[]= (object)array("classes" => array($classes["next"], $classes["numbers"]), "url" => apply_filters('paginate_links', $link), "text" => $next_text, "pagenumber" => $current+1);
  endif;
  return $page_links;
}
?>