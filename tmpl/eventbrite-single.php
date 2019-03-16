<?php
// Get our event based on the ID passed by query variable.
$event = new Eventbrite_Query( array( 'p' => get_query_var( 'eventbrite_id' ) ) );

if ( $event->have_posts() ) :
    while ( $event->have_posts() ) : 
        $event->the_post();
        get_header();
        $venue = eventbrite_event_venue();
		?>
	    <div id="primary" class="content-area">
		    <main id="main" class="site-main" role="main">
                <article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="article-h1 center"><?= mysql2date('j F Y', eventbrite_event_start()->local) ?>: <?php the_title(); ?></h1>
                    </header>
                    <address class="center"><a href="https://www.google.com/maps/search/<?= $venue->name ?> <?= $venue->address->city ?>" target="_blank"><?= $venue->name ?></a>, <?= $venue->address->localized_address_display ?></address>
                    <div class="entry-content">
                        <?php eventbrite_ticket_form_widget(); ?>
                        <?php the_content(); ?>
                    </div>
                </article>
            </main>
        </div>
        <?php
    endwhile;
endif;

// Return $post to its rightful owner.
wp_reset_postdata();

get_footer();
?>