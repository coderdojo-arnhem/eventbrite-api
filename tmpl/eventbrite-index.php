<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
            // Set up and call our Eventbrite query.
            $events = new Eventbrite_Query(apply_filters('eventbrite_query_args', array(
                'status' => 'live',
                'display_private' => true
            )));

            if ($events->have_posts()) :
                $first = true;
                while ($events->have_posts()) :
                    $events->the_post();
                    
                    if ($first):
                        $first = false;
                        ?>
                        <article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <h1 class="article-h1 center">Komende editie</h1>
                            </header>
                            <div class="entry-content">
                                <?php eventbrite_ticket_form_widget(); ?>
                                <?php the_content(); ?>

                            </div>
                        </article>
                        <h2>Reserveer alvast de volgende data in je agenda</h2>
                        <?php
                    else:
                        ?>
						<h4><?php echo eventbrite_event_time(); ?>, <a href="?eventbrite_id=<?php the_ID(); ?>"><?php the_title(); ?></a></h4>
                        <?php
                    endif;
                endwhile;
            else :
                // If no content, include the "No posts found" template.
                get_template_part('content', 'none');

            endif;

            // Return $post to its rightful owner.
            wp_reset_postdata();
        ?>
    </main>
</div>
<?php get_footer(); ?>