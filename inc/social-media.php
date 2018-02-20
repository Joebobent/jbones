<?php $socialmedia = get_theme_mod( 'jbones_social' ); ?>
<ul class="social-media">
	<?php if ( $socialmedia['facebook'] ) : ?><li><a class="facebook" href="<?php echo $socialmedia['facebook']; ?>">Facebook</a></li><?php endif; ?>
	<?php if ( $socialmedia['twitter'] ) : ?><li><a class="twitter" href="<?php echo $socialmedia['twitter']; ?>">Twitter</a></li><?php endif; ?>
	<?php if ( $socialmedia['googleplus'] ) : ?><li><a class="googleplus" href="<?php echo $socialmedia['googleplus']; ?>">Google+</a></li><?php endif; ?>
	<?php if ( $socialmedia['linkedin'] ) : ?><li><a class="linkedin" href="<?php echo $socialmedia['linkedin']; ?>">LinkedIn</a></li><?php endif; ?>
	<?php if ( $socialmedia['youtube'] ) : ?><li><a class="youtube" href="<?php echo $socialmedia['youtube']; ?>">YouTube</a></li><?php endif; ?>
	<?php if ( $socialmedia['vimeo'] ) : ?><li><a class="vimeo" href="<?php echo $socialmedia['vimeo']; ?>">Vimeo</a></li><?php endif; ?>
	<?php if ( $socialmedia['github'] ) : ?><li><a class="github" href="<?php echo $socialmedia['github']; ?>">GitHub</a></li><?php endif; ?>
	<?php if ( $socialmedia['dribbble'] ) : ?><li><a class="dribbble" href="<?php echo $socialmedia['dribbble']; ?>">Dribbble</a></li><?php endif; ?>
	<?php if ( $socialmedia['tumblr'] ) : ?><li><a class="tumblr" href="<?php echo $socialmedia['tumblr']; ?>">Tumblr</a></li><?php endif; ?>
	<?php if ( $socialmedia['instagram'] ) : ?><li><a class="instagram" href="<?php echo $socialmedia['instagram']; ?>">Instagram</a></li><?php endif; ?>
	<?php if ( $socialmedia['pinterest'] ) : ?><li><a class="pinterest" href="<?php echo $socialmedia['pinterest']; ?>">Pinterest</a></li><?php endif; ?>
	<?php if ( $socialmedia['rss'] ) : ?><li><a class="rss" href="<?php echo $socialmedia['rss']; ?>">RSS</a></li><?php endif; ?>				
</ul>