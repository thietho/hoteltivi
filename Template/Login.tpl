<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?php echo $sitemap['sitemapname']?></h2>
                <ol>
                    <?php echo $this->breadcrumb?>
                </ol>
            </div>

        </div>
    </section>
    <?php echo $content?>
</main>
