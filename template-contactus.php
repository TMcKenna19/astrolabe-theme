<?php 
/*
Template Name: Contact Us
*/
?>

<?php get_header()?>
<section class="page-wrapper">
    <div class="container">

        <h5> <?php the_title();?> </h5>
        <div class="row">
            
            <div class="col-lg-6">
                contact form 
            </div>

            <div class="col-lg-6">
                <?php get_template_part('includes/section', 'content'); ?>
            </div>

        </div>

    </div>
</section>
<?php get_footer()?>