<?php $socialmedia = get_theme_mod( 'jbones_social' ); ?>
<ul class="social-media">
	<?php if ( $socialmedia['facebook'] ) : ?><li><a class="facebook" rel="noopener" href="<?php echo $socialmedia['facebook']; ?>" target="_blank">Facebook</a></li><?php endif; ?>
	<?php if ( $socialmedia['twitter'] ) : ?><li><a class="twitter" rel="noopener" href="<?php echo $socialmedia['twitter']; ?>" target="_blank">Twitter</a></li><?php endif; ?>
	<?php if ( $socialmedia['googleplus'] ) : ?><li><a class="googleplus" rel="noopener" href="<?php echo $socialmedia['googleplus']; ?>" target="_blank">Google+</a></li><?php endif; ?>
	<?php if ( $socialmedia['linkedin'] ) : ?><li><a class="linkedin" rel="noopener" href="<?php echo $socialmedia['linkedin']; ?>" target="_blank">LinkedIn</a></li><?php endif; ?>
	<?php if ( $socialmedia['youtube'] ) : ?><li><a class="youtube" rel="noopener" href="<?php echo $socialmedia['youtube']; ?>" target="_blank">YouTube</a></li><?php endif; ?>
	<?php if ( $socialmedia['vimeo'] ) : ?><li><a class="vimeo" rel="noopener" href="<?php echo $socialmedia['vimeo']; ?>" target="_blank">Vimeo</a></li><?php endif; ?>
	<?php if ( $socialmedia['github'] ) : ?><li><a class="github" rel="noopener" href="<?php echo $socialmedia['github']; ?>" target="_blank">GitHub</a></li><?php endif; ?>
	<?php if ( $socialmedia['dribbble'] ) : ?><li><a class="dribbble" rel="noopener" href="<?php echo $socialmedia['dribbble']; ?>" target="_blank">Dribbble</a></li><?php endif; ?>
	<?php if ( $socialmedia['tumblr'] ) : ?><li><a class="tumblr" rel="noopener" href="<?php echo $socialmedia['tumblr']; ?>" target="_blank">Tumblr</a></li><?php endif; ?>
	<?php if ( $socialmedia['instagram'] ) : ?><li><a class="instagram" rel="noopener" href="<?php echo $socialmedia['instagram']; ?>" target="_blank">Instagram</a></li><?php endif; ?>
	<?php if ( $socialmedia['pinterest'] ) : ?><li><a class="pinterest" rel="noopener" href="<?php echo $socialmedia['pinterest']; ?>" target="_blank">Pinterest</a></li><?php endif; ?>
	<?php if ( $socialmedia['rss'] ) : ?><li><a class="rss" rel="noopener" href="<?php echo $socialmedia['rss']; ?>" target="_blank">RSS</a></li><?php endif; ?>
</ul>
