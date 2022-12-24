<?php

namespace SuperDocs\App\Widgets;

use Elementor\Widget_Base;

class DocContent extends Widget_Base {

	public function get_name() {
		return 'superdocs-doc-content';
	}

	public function get_title() {
		return esc_html__( 'Doc Content', 'superdocs' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'superdocs', 'doc', 'content', 'knowledge base' ];
	}

	protected function render() {
		$elementor = \Elementor\Plugin::$instance;
		global $post;
		if( $elementor->editor->is_edit_mode() || is_preview() || (isset($post->post_type) && superdocs_template_post_type() === $post->post_type)) {
			?>

<article id="post-697" class="post-697 docs type-docs status-publish hentry" itemscope="" itemtype="http://schema.org/Article">
                    <header class="entry-header">
                        <h1 class="entry-title" itemprop="headline">Layout and Design</h1>
                                                    <a href="#" class="wedocs-print-article wedocs-hide-print wedocs-hide-mobile" title="Print this article"><i class="wedocs-icon wedocs-icon-print"></i></a>
                                            </header><!-- .entry-header -->

                    <div class="entry-content" itemprop="articleBody">
                        
<figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
<iframe title="How to Use the PostX Design Library?" src="https://www.youtube.com/embed/q9KVVoE4MBg?feature=oembed" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="500" height="281" frameborder="0"></iframe>
</div></figure>



<p>PostX offers numerous block variations and multiple starter packs to create news magazines and blogging sites effortlessly. You can access them while editing the page with PostX.</p>



<figure class="wp-block-image size-large"><img loading="lazy" src="https://docs.wpxpo.com/wp-content/uploads/2021/05/Block-Library-1024x479.png" alt="Block Library" class="wp-image-1823" srcset="https://docs.wpxpo.com/wp-content/uploads/2021/05/Block-Library-1024x479.png 1024w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Block-Library-300x140.png 300w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Block-Library-768x359.png 768w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Block-Library-1536x719.png 1536w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Block-Library.png 1902w" sizes="(max-width: 1024px) 100vw, 1024px" width="1024" height="479"><figcaption>Block Library</figcaption></figure>



<h2 id="readymade-block-designs">Readymade block designs<a class="anchorjs-link " href="#readymade-block-designs" aria-label="Anchor" data-anchorjs-icon="#" style="padding-left: 0.375em;"></a></h2>



<p>PostX multiple post blocks including, Post Grid, Post List, Post Slider, etc. And, for these blocks, there are multiple designs available to import within a click. So, either you can create and add desired blocks and customize them manually or you can directly import your desired blocks with premade designs.</p>



<figure class="wp-block-image size-large"><img loading="lazy" src="https://docs.wpxpo.com/wp-content/uploads/2021/05/Readymade-block-designs-1024x552.png" alt="Readymade Blocks Design" class="wp-image-700" srcset="https://docs.wpxpo.com/wp-content/uploads/2021/05/Readymade-block-designs-1024x552.png 1024w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Readymade-block-designs-300x162.png 300w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Readymade-block-designs-768x414.png 768w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Readymade-block-designs.png 1391w" sizes="(max-width: 1024px) 100vw, 1024px" width="1024" height="552"><figcaption>Readymade Blocks Design</figcaption></figure>



<h2 id="starter-packs">Starter Packs<a class="anchorjs-link " href="#starter-packs" aria-label="Anchor" data-anchorjs-icon="#" style="padding-left: 0.375em;"></a></h2>



<p>PostX also comes with multiple ready-to-go templates/layouts to create a custom home page within a few clicks. As these templates are 100% ready to go that’s why we can call these starter packs. All of these starter packs are combinations of multiple post blocks. So, either you can import and customize your desired starter pack or make your own custom home page layout with the combinations of your desired blocks.</p>



<figure class="wp-block-image size-large"><img loading="lazy" src="https://docs.wpxpo.com/wp-content/uploads/2021/05/Starter-Packs-1-1024x551.png" alt="Starter Packs " class="wp-image-701" srcset="https://docs.wpxpo.com/wp-content/uploads/2021/05/Starter-Packs-1-1024x551.png 1024w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Starter-Packs-1-300x161.png 300w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Starter-Packs-1-768x413.png 768w, https://docs.wpxpo.com/wp-content/uploads/2021/05/Starter-Packs-1.png 1390w" sizes="(max-width: 1024px) 100vw, 1024px" width="1024" height="551"><figcaption>Starter Packs</figcaption></figure>



<p></p>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer wedocs-entry-footer">
                        
                        <div class="wedocs-article-author" itemprop="author" itemscope="" itemtype="https://schema.org/Person">
                            <meta itemprop="name" content="Omith Hasan">
                            <meta itemprop="url" content="https://docs.wpxpo.com/author/omith/">
                        </div>

                        <meta itemprop="datePublished" content="2021-05-25T06:52:55+00:00">
                        <time itemprop="dateModified" datetime="2022-09-19T08:56:08+00:00">Updated on September 19, 2022</time>
                    </footer>

                    <nav class="wedocs-doc-nav wedocs-hide-print"><h3 class="assistive-text screen-reader-text">Doc navigation</h3><span class="nav-prev"><a href="https://docs.wpxpo.com/docs/postx/block-libraries/">← Block Libraries</a></span><span class="nav-next"><a href="https://docs.wpxpo.com/docs/postx/how-to-use-copy-patterns/">How to Use Copy Patterns →</a></span></nav>
                                            
<div class="wedocs-feedback-wrap wedocs-hide-print">
    
    Was this article helpful to you?
    <span class="vote-link-wrap">
        <a href="#" class="wedocs-tip positive" data-id="697" data-type="positive" title="No votes yet">
            Yes
                    </a>
        <a href="#" class="wedocs-tip negative" data-id="697" data-type="negative" title="2 persons found this not useful">
            No
                            <span class="count">2</span>
                    </a>
    </span>
</div>                    
                    
                </article>
<?php
		} else { ?>
			{{ SuperDocs Doc Content }}
		<?php }
	}
}
