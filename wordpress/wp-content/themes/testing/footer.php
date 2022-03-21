<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Testing
 */

	$variable = get_field("items_footer", "option");

?>

<footer id="colophon" class="site-footer">
	<div class="columns">
		<a href="http://instagram.com/_u/<?= $variable['instagram']; ?>/" target="_blank">
			<p class="mx"><?= $variable['instagram']; ?></p>
		</a>
		<ul class="mx">
			<?php foreach($variable['phones'] as $item) : ?>
				<li>
					<span class="mr"><?= $item['languague']; ?></span>
					<a href="tel:<?= $item['number']; ?>">
						<span><?= $item['number']; ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="columns">
		<a href="mailto:<?= $variable['email']; ?>?Subject=Aquí%20el%20asunto%20del%20mail">
			<p class="mx"><?= $variable['email']; ?></p>
		</a>
		<p class="mx"><?= $variable['country']; ?></p>
		<p class="mx"><?= $variable['terms']; ?></p>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
	window.addEventListener('scroll', () => {
		let scrolled = document.scrollingElement.scrollTop;
		document.querySelector(".m0").style.transform = 'translate(0, -' + scrolled / 2 + '%)';
		document.querySelector(".m1").style.transform = 'translate(0, -' + scrolled / 4 + '%)';
		document.querySelector(".m2").style.transform = 'translate(0, -' + scrolled / 6 + '%)';
		document.querySelector(".m3").style.transform = 'translate(0, -' + scrolled / 8 + '%)';
		document.querySelector(".m4").style.transform = 'translate(0, -' + scrolled / 7 + '%)';
		document.querySelector(".m5").style.transform = 'translate(0, -' + scrolled / 7.6 + '%)';
	});
</script>

</body>

</html>