<?=$this->Html->css('comment');?>
<?=$this->Html->script('text_area');?>
<?=$this->Form->create('post', array('novalidate'));?>
<?=$this->Form->textarea('text-area')?>
<?=$this->render('comment');?>