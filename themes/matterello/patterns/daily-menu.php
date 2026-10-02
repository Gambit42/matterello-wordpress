<?php
/**
 * Title: Daily menu
 * Slug: matterello/daily-menu
 * Categories: text
 * Description: Today's date over a two-column menu in a white frame. Each course is a table block: dish, then price.
 */

$food = array(
	'Antipasti' => array(
		array( 'Green olives, orange zest &amp; fennel', '£4' ),
		array( 'Sourdough &amp; new-season olive oil', '£5.5' ),
		array( 'Bitter leaves, pear, pecorino &amp; walnut', '£7' ),
		array( 'Fennel salami &amp; pickled peppers', '£8.5' ),
		array( 'Stracciatella, blood orange &amp; mint', '£9.5' ),
		array( 'Grilled bread, cannellini &amp; cavolo nero', '£10' ),
		array( 'Beef tartare, capers &amp; aged parmesan', '£13.5' ),
	),
	'Pasta'     => array(
		array( 'Spaghettini with garlic, chilli &amp; crumbs', '£9' ),
		array( 'Tagliolini with slow-cooked tomato &amp; basil', '£11.5' ),
		array( 'Pici, black pepper &amp; pecorino', '£13' ),
		array( 'Mafaldine with \'nduja, ricotta &amp; lemon', '£14' ),
		array( 'Tortelli of squash, brown butter &amp; sage', '£14.5' ),
		array( 'Cappelletti in brodo with parmesan', '£15' ),
		array( 'Linguine with clams, white wine &amp; parsley', '£15.5' ),
		array( 'Fettuccine with wild mushrooms &amp; thyme', '£15.5' ),
		array( 'Pappardelle with eight-hour beef shin ragù', '£16.5' ),
	),
	'Dolci'     => array(
		array( 'Tiramisù', '£8' ),
		array( 'Olive oil cake &amp; crème fraîche', '£7' ),
		array( 'Cantucci &amp; a glass of vin santo', '£7.5' ),
	),
	'Gelato'    => array(
		array( 'Affogato', '£6.5' ),
		array( 'Fior di latte', '£5' ),
		array( 'Toasted hazelnut', '£5' ),
		array( 'Dark chocolate', '£5' ),
		array( 'Lemon sorbet', '£5' ),
	),
);

$drinks = array(
	'Aperitivi' => array(
		array( 'House Negroni (gin, bitter, house vermouth)', '£8.5' ),
		array( 'Matterello Martini (dry gin, dry vermouth)', '£9' ),
		array( 'Campari Spritz', '£9' ),
		array( 'Aperol Spritz', '£9' ),
		array( 'Limoncello Spritz', '£9.5' ),
	),
	'Beer'      => array(
		array( 'Lager on tap (draught, 4.8%)', '£5.5' ),
		array( 'Pale ale, local brewery (bottle, 4.5%)', '£6' ),
		array( 'Alcohol-free lager (bottle, 0.5%)', '£5' ),
	),
	'Softs'     => array(
		array( 'Blood orange soda, cola, ginger beer', '£3.5' ),
		array( 'Homemade lemonade (still or sparkling)', '£4.5' ),
		array( 'Ginger &amp; honey switchel', '£5' ),
	),
	'Wine'      => array(
		array( 'Pecorino 2025, Abruzzo (white, 13%)', '£7', '£26' ),
		array( 'Vermentino 2025, Sardinia (white, 12.5%)', '£8', '£30' ),
		array( 'Rosato 2025, Puglia (rosé, 12.5%)', '£7.5', '£28' ),
		array( 'Montepulciano 2023, Abruzzo (red, 13.5%)', '£7', '£26' ),
		array( 'Nero d\'Avola 2023, Sicily (red, 13%)', '£8', '£30' ),
	),
	'Espresso'  => array(
		array( 'Espresso', '£2' ),
		array( 'Macchiato', '£2.5' ),
		array( 'Cortado', '£3' ),
	),
	'Digestivi' => array(
		array( 'Vin santo (60ml)', '£7' ),
		array( 'Marsala (60ml)', '£5.5' ),
		array( 'Grappa (25ml)', '£4' ),
		array( 'Amaro (35ml)', '£4' ),
		array( 'Limoncello (25ml)', '£3.5' ),
	),
);

$notes = array(
	'Pasta' => 'Ask for extra 24-month parmesan (50p)',
);

$heads = array(
	'Wine' => array( '', '125ml', '500ml' ),
);

/** One course: heading + table block (dish | price[, price]). */
$course = function ( $title, $rows ) use ( $notes, $heads ) {
	$html = '<table>';
	if ( isset( $heads[ $title ] ) ) {
		$html .= '<thead><tr><th>' . implode( '</th><th>', $heads[ $title ] ) . '</th></tr></thead>';
	}
	$html .= '<tbody>';
	foreach ( $rows as $row ) {
		$html .= '<tr><td>' . implode( '</td><td>', $row ) . '</td></tr>';
	}
	$html .= '</tbody></table>';
	if ( isset( $notes[ $title ] ) ) {
		$html .= '<figcaption class="wp-element-caption">' . $notes[ $title ] . '</figcaption>';
	}
	echo "<!-- wp:heading {\"level\":3} -->\n<h3 class=\"wp-block-heading\">$title</h3>\n<!-- /wp:heading -->\n\n";
	echo "<!-- wp:table {\"hasFixedLayout\":false,\"className\":\"menu-table\"} -->\n<figure class=\"wp-block-table menu-table\">$html</figure>\n<!-- /wp:table -->\n\n";
};
?>
<!-- wp:group {"anchor":"menu","align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div id="menu" class="wp-block-group alignfull" style="padding-top:0;padding-bottom:0"><!-- wp:group {"align":"wide","className":"menu-frame","style":{"border":{"color":"var:preset|color|white","width":"8px"},"spacing":{"padding":{"top":"4rem","bottom":"3rem","left":"2.5rem","right":"2.5rem"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide menu-frame has-border-color" style="border-color:var(--wp--preset--color--white);border-width:8px;padding-top:4rem;padding-right:2.5rem;padding-bottom:3rem;padding-left:2.5rem"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"3.5rem"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:3.5rem">[menu_date]</h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"6.25rem"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><?php foreach ( $food as $t => $rows ) { $course( $t, $rows ); } ?></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><?php foreach ( $drinks as $t => $rows ) { $course( $t, $rows ); } ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
