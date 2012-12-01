<?php
 
 /* =====================================================================
Template:	OneWeb for Joomla 2.5						            
Author: 	Seth Warburton - Internet Inspired! - @nternetinspired 				            
Version: 	2.0 											             
Created: 	June 2012                                                    
Copyright:	Seth Warburton - (C) 2012 - All rights reserved		
License:	GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
			DBAD License http://philsturgeon.co.uk/code/dbad-license
Source: 	J2.5.1. com_content/views/							             		
/* ===================================================================== */

// no direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>
<section class="blog-featured <?php echo $this->pageclass_sfx;?>">
<?php if ( $this->params->get('show_page_heading')!=0) : ?>
<header>
	<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
</header>    
<?php endif; ?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<section class="leading-articles">
	<?php foreach ($this->lead_items as &$item) : ?>
		<article class="article <?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?> clearfix">
			<?php
				$this->item = &$item;
				echo $this->loadTemplate('item');
			?>
		</article>
		<?php
			$leadingcount++;
		?>
	<?php endforeach; ?>
</section>
<?php endif; ?>

<?php
	$introcount=(count($this->intro_items));
	$counter=0;
?>
<?php if (!empty($this->intro_items)) : ?>
<section class="intro-articles">
	<?php foreach ($this->intro_items as $key => &$item) : ?>
		<article class="article <?php echo $counter; ?> clearfix">
			<?php
					$this->item = &$item;
					echo $this->loadTemplate('item');
			?>
		</article>
		<?php $counter++; ?>
	<?php endforeach; ?>
</section>
<?php endif; ?>

<?php if (!empty($this->intro_items)) : ?>
<?php foreach ($this->intro_items as $key => &$item) : ?>
<?php
	$key = ($key - $leadingcount) + 1;
	$rowcount = (((int) $key - 1) % (int) $this->columns) + 1;
	$row = $counter / $this->columns;

	if ($rowcount == 1) : ?>
	<section class="items-row row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row; ?> row-fluid">
	<?php endif; ?>
		<article class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?> span<?php echo (($this->columns));?>">
			<?php
			$this->item = &$item;
			echo $this->loadTemplate('item');
		?>
		</article><!-- end item -->
		<?php $counter++; ?>
		<?php if (($rowcount == $this->columns) or ($counter == $introcount)): ?>			
	</section><!-- end row -->
		<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>

</section>
