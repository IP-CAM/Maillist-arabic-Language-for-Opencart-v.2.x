# Mail list
Add mail list registeration to your OpenCart website,enable your visitors to add their email addresses without forcing them to register to your store
 then you can send them offers and increase visits

# Installation
1- Download the folders, and copy them to your store home directory.

2- Install the module with admin panel

#  Usage

1- Admin Panel
  
- Add this line to your `language/YOUR_LANGUAGE_FILDER/common/column_left.php`.
 <pre> $_['text_newsletter']='Mail List'; </pre>
- Add this line to `controller/common/column_left.php`.
 <pre>
  $data['menus'][] = array(
				'id'       => 'menu-newsletter',
				'icon'	   => 'fa-envlope',
				'name'	   => $this->language->get('text_newsletter'),
				'href'     => $this->url->link('module/newsletter', 'token=' . $this->session->data['token'], true),
				'children' => array()
			);
 </pre>

-If you don not have column_left in admin/common folders then the side menu loaded from header files
So add the language line in the first step to  `language/YOUR_LANGUAGE_FILDER/common/header.php`
- Add these lines to `controller/common/header.php`
 <pre>
 $data['text_newsletter'] = $this->language->get('text_newsletter');
 $data['newsletter'] = $this->url->link('module/newsletter', 'token=' . $this->session->data['token'], 'SSL');
 </pre>
- Add these lines to `view/template/common/header.tpl` in `<ul class="mainnav">`

 `<li id="newsletter"><a href="<?php echo $newsletter; ?>" class="top"><?php echo $text_newsletter; ?></a></li>`
 

2- Catalog

Add the module to what ever place in your store pages.
