<div class="wrap">
<div id="icon-themes" class="icon32"></div>	
	<h2><?php _e('WP Orbit Slider Options', 'wp-orbit-slider'); ?></h2>
	
	<div class="postbox-container" style="width:50%;">
	
		<div class="metabox-holder">
		
			<div class="meta-box-sortables ui-sortable">
			
				<form method="post" action="options.php">
					<?php settings_fields( 'slider-settings-group' ); ?>
					<?php $options = get_option('orbit_slider_options'); ?>


					<div id="general-settings" class="postbox">						
						<h3 class="hndle"><span><?php _e('General Settings', 'wp-orbit-slider'); ?></span></h3>						
						<div class="inside">
						 
                            <!-- animationSpeed -->
							<p>
								<strong><?php _e('Animation Speed:', 'wp-orbit-slider'); ?> </strong>
								<select name="orbit_slider_options[animationSpeed]">
									<?php for($i=100; $i<=3000; $i+= 100): ?>
										<option value="<?php echo $i; ?>"<?php if( $options['animationSpeed'] == $i ) echo 'selected="selected"'; ?>>
										<?php echo $i; ?> <?php _e('ms', 'wp-orbit-slider'); ?>
										</option>
									<?php endfor; ?>
								</select>
							</p>  


							<!-- directionalNav -->
							<p>
								<strong><?php _e('Show Nav Arrows', 'wp-orbit-slider'); ?></strong><br />
								<input type="radio" name="orbit_slider_options[directionalNav]" value="true" <?php if( $options['directionalNav'] == 'true' ) echo 'checked="checked"'; ?> />
								<label><?php _e('On', 'wp-orbit-slider'); ?></label><br />
								
								<input type="radio" name="orbit_slider_options[directionalNav]" value="false" <?php if( $options['directionalNav'] == 'false' ) echo 'checked="checked"'; ?> />
								<label><?php _e('Off', 'wp-orbit-slider'); ?></label>
							</p>
	
						</div>						
					</div><!-- #general-settings -->


					<div id="caption-settings" class="postbox">						
						<h3 class="hndle"><span><?php _e('Caption Settings', 'wp-orbit-slider'); ?></span></h3>						
						<div class="inside">
 
                            <!-- captionAnimationSpeed -->
							<p>
								<strong><?php _e('Caption Animation Speed:', 'wp-orbit-slider'); ?> </strong>
								<select name="orbit_slider_options[captionAnimationSpeed]">
									<?php for($i=100; $i<=3000; $i+= 100): ?>
										<option value="<?php echo $i; ?>"<?php if( $options['captionAnimationSpeed'] == $i ) echo 'selected="selected"'; ?>>
										<?php echo $i; ?> <?php _e('ms', 'wp-orbit-slider'); ?>
										</option>
									<?php endfor; ?>
								</select>
							</p>                                                        
							
                            <!-- captions -->
							<p>
								<strong><?php _e('Slide Captions:', 'wp-orbit-slider'); ?></strong><br />
								<input type="radio" name="orbit_slider_options[captions]" value="true" <?php if( $options['captions'] == 'true' ) echo 'checked="checked"'; ?> />
								<label><?php _e('On', 'wp-orbit-slider'); ?></label><br />
								
								<input type="radio" name="orbit_slider_options[captions]" value="false" <?php if( $options['captions'] == 'false' ) echo 'checked="checked"'; ?> />
								<label><?php _e('Off', 'wp-orbit-slider'); ?></label>
							</p>
							
                            <!-- captionAnimation -->	
							<p>
								<strong><?php _e('Caption Animation Style:', 'wp-orbit-slider'); ?></strong><br />
								<input type="radio" name="orbit_slider_options[captionAnimation]" value="fade" <?php if( $options['captionAnimation'] == 'fade' ) echo 'checked="checked"'; ?> />
								<label><?php _e('Fade', 'wp-orbit-slider'); ?></label><br />
								
								<input type="radio" name="orbit_slider_options[captionAnimation]" value="slideOpen" <?php if( $options['captionAnimation'] == 'slideOpen' ) echo 'checked="checked"'; ?> />
								<label><?php _e('Slide Open', 'wp-orbit-slider'); ?></label><br />
								
								<input type="radio" name="orbit_slider_options[captionAnimation]" value="none" <?php if( $options['captionAnimation'] == 'none' ) echo 'checked="checked"'; ?> />
								<label><?php _e('None', 'wp-orbit-slider'); ?></label>
							</p>
	
						</div>						
					</div><!-- #caption-settings -->


					<div id="bullet-settings" class="postbox">	
						<h3 class="hndle"><span><?php _e('Bullet Navigation', 'wp-orbit-slider'); ?></span></h3>
						<div class="inside">

                        	<!-- bullets -->
							<p>
								<strong><?php _e('Bullet Navigation:', 'wp-orbit-slider'); ?></strong><br />
								<input type="radio" name="orbit_slider_options[bullets]" value="true" <?php if( $options['bullets'] == 'true' ) echo 'checked="checked"'; ?> />
								<label><?php _e('On', 'wp-orbit-slider'); ?></label><br />
								
								<input type="radio" name="orbit_slider_options[bullets]" value="false" <?php if( 	$options['bullets'] == 'false' ) echo 'checked="checked"'; ?> />
								<label><?php _e('Off', 'wp-orbit-slider'); ?></label>
							</p>
                            
                            
	
						</div>	
					</div><!-- #bullet-settings -->


					<div id="autoplay-settings" class="postbox">	
						<h3 class="hndle"><span><?php _e('Autoplay Timer Settings', 'wp-orbit-slider'); ?></span></h3>
						<div class="inside">
						
                        	<!-- pauseOnHover -->
							<p>
								<strong><?php _e('Pause on Hover:', 'wp-orbit-slider'); ?></strong><br />
								<input type="radio" name="orbit_slider_options[pauseOnHover]" value="true" <?php if( $options['pauseOnHover'] == 'true' ) echo 'checked="checked"'; ?> />
								<label><?php _e('True', 'wp-orbit-slider'); ?></label><br />
								
								<input type="radio" name="orbit_slider_options[pauseOnHover]" value="false" <?php if( $options['pauseOnHover'] == 'false' ) echo 'checked="checked"'; ?> />
								<label><?php _e('False', 'wp-orbit-slider'); ?></label>
							</p>

                        	<!-- advanceSpeed -->
							<p>
								<strong><?php _e('Set Slider Time Delay:', 'wp-orbit-slider'); ?> </strong>
								<select name="orbit_slider_options[advanceSpeed]">
									<?php for($i=100; $i<=5000; $i+= 100): ?>
										<option value="<?php echo $i; ?>"<?php if( $options['advanceSpeed'] == $i ) echo 'selected="selected"'; ?>>
										<?php echo $i; ?> <?php _e('ms', 'wp-orbit-slider'); ?>
										</option>
									<?php endfor; ?>
								</select>
							</p>

                        	<!-- timer -->
							<p>
								<strong><?php _e('Slide Timer Animation', 'wp-orbit-slider'); ?></strong><br />
								<input type="radio" name="orbit_slider_options[timer]" value="true" <?php if( $options['timer'] == 'true' ) echo 'checked="checked"'; ?> />
								<label><?php _e('On', 'wp-orbit-slider'); ?></label><br />
								
								<input type="radio" name="orbit_slider_options[timer]" value="false" <?php if( $options['timer'] == 'false' ) echo 'checked="checked"'; ?> />
								<label><?php _e('Off', 'wp-orbit-slider'); ?></label>
							</p>
	
						</div>
					</div><!-- #autplay-settings -->
						
					<div class="submit">
						<input type="submit" class="button-primary" value="<?php _e('Save Settings', 'wp-orbit-slider') ?>" />
					</div>
			  
				</form>
			
			</div> 
		
		</div>
  
</div>	
</div>