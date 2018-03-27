<link rel="stylesheet" href="js/accordion/accordion2.css" />
<ul id="navigation" class="nav">
<li>	
<a class="head">COMPANY</a> 
<ul> 
<li><a href="index.html" class="menunav">General Info</a></li>
<li><a href="company.html" class="menunav">Our Company</a></li>
<li><a href="productive.html" class="menunav">Productive Capacity</a></li>
<li><a href="customers.html" class="menunav">Customers</a></li>
</ul>
</li>
</ul>
<div id="navegador"> 
<a href="quality.html" class="enlacenav">QUALITY</a> 
</div>
        <div id="navegador"> 
<a href="product.html" class="enlacenav">OUR PRODUCTS</a> 
</div>
        <div id="navegador"> 
<a href="contact.html" class="enlacenav">CONTACT</a> 
</div>
<script type="text/javascript">
jQuery('#navigation').Accordion({
	active: false,
	header: '.head',
	alwaysOpen: false,
	navigation: true
});

jQuery('#close').click(function() {
	jQuery('#navigation').activate(-1);
});

jQuery('#navigation_2').Accordion({
	active: false,
	header: '.head',
	alwaysOpen: false,
	navigation: true
});

jQuery('#navigation_2 #close').click(function() {
	jQuery('#navigation_2').activate(-1);
});
</script>