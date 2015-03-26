delay = (ms, func) -> setTimeout func, ms

newsInit = false

spin_options = 
	lines: 13
	length: 21
	width: 2
	radius: 24
	corners: 0
	rotate: 0
	direction: 1
	color: '#0c4ed0'
	speed: 1
	trail: 68
	shadow: false
	hwaccel: false
	className: 'spinner'
	zIndex: 2e9
	top: '50%'
	left: '50%'

map = undefined

size = ->
	#autoHeight($('.page .tech'), '.tech__item', '.tech__title', false, true)

	autoHeight 

	heights = []
	$('.application__tabs-item').removeAttr 'style'
	if $(window).width() >= 600
		$.each $('.application__tabs-item'), ()->
			heights.push $(this).height()
		$('.application__tabs-item').height Math.max.apply(Math,heights)

	if $(window).width() > 992
		if $('.page__sidebar').length > 0
			if $('.page__sidebar').height() > $('.page__picture').height()+$('.page__sidebar-content').height()
				$('.page__sidebar-content').mod('fixed', true)
			else
				$('.page__sidebar-content').mod('fixed', false)

			if $('.page__sidebar-content').outerHeight() > $('.page__sidebar').outerHeight()
				while $('.page__sidebar-content').outerHeight() > $('.page__sidebar').outerHeight()
					$('.page__sidebar-content .block:last').remove()

			if $('.page__sidebar-content').position().top < 200
				while $('.page__sidebar-content').position().top < 200
					$('.page__sidebar-content .block:last').remove()
	$('.index .news').each ->
		if $(this).find('.news__item:last').outerHeight() > $(this).find('.news__item:first').outerHeight()
			$(this).find('.news__item:last').addClass 'news__item--fixed'

	$('body:not(.index) .page__content > .row').css
		minHeight : ->
			h = $(window).height() - $('.footer').outerHeight()*2 - $('.page__content').offset().top - 25
			if $(this).height() < h
				$.cookie 'height', h+25
				$(this).removeAttr 'style'
				return h
		

	$('[subsidiary]').each ->
		$el     = $(this)
		factor  = $(this).data 'factor'
		offset  = $(this).data 'offset'
		$parent = $(".#{$el.data('parent')}:visible")
		offset  = 0 if !offset
		factor  = 1 if !factor
		$el.removeAttr 'style'
		
		if $parent.length > 0
			if $parent.outerHeight() != $el.height()*factor+offset
				h = ($parent.outerHeight()/factor)-offset
				$el.height h
				
	###
	if !newsInit
		newsInit = true
		$('article:not(.index-page) .news').isotope
			itemSelector: '.news__item'
	###

urlInitial = undefined

setHash = (hash) ->
	window.location.hash = hash;
	window.onhashchange = ()->
		if (!location.hash)
			$("##{hash}").modal('hide');

$.openModal = (url, id, open)->
	if url
		if(open)
			$(id).modal()
		$(id).find('.text').load "/ajax#{url}", (data)->
			$('.modal .fotorama').fotorama()
			if History.enabled
				info = History.getState()
				urlInitial =
					url : info.cleanUrl
					title : document.title
				History.pushState {'url':url}, $(id).find('.text h1').text(), url
				
				History.Adapter.bind window,'statechange.namespace', ()->
					$("#{id}").modal 'hide'
					$(window).unbind 'statechange.namespace'
				
				window.title = $(id).find('.text h1').text()

autoHeight = (el, selector='', height_selector = false, use_padding=false, debug=false)->
	if el.length > 0
		item = el.find(selector)

		if height_selector
			el.find(height_selector).removeAttr 'style'
		else
			el.find(selector).removeAttr 'style'
		
		item_padding = item.css('padding-left').split('px')[0]*2
		padding      = el.css('padding-left').split('px')[0]*2
		if debug
			step = Math.round((el.width()-padding)/(item.width()+item_padding))
		else
			step = Math.round(el.width()/item.width())
		
		count = item.length-1
		loops = Math.ceil(count/step)
		i     = 0
		
		if debug
			console.log count, step, item_padding, padding, el.width(), item.width()

		while i < count
			items = {}
			for x in [0..step-1]
				items[x] = item[i+x] if item[i+x]
			
			heights = []
			$.each items, ()->
				if height_selector
					heights.push($(this).find(height_selector).height())
				else
					heights.push($(this).height())
			
			if debug
				console.log heights

			$.each items, ()->
				if height_selector
					$(this).find(height_selector).height Math.max.apply(Math,heights)
				else
					$(this).height Math.max.apply(Math,heights)

			i += step

getCaptcha = ()->
	$.get '/include/captcha.php', (data)->
		setCaptcha data

setCaptcha = (code)->
	$('input[name=captcha_code]').val(code)
	$('.captcha').css 'background-image', "url(/include/captcha.php?captcha_sid=#{code})"

init_popup = ->
	###
	$('a[rel^="prettyPhoto"]').prettyPhoto
		social_tools: ''
		overlay_gallery: false
		deeplinking: false
	###
	$('.gallery').elem('item').on 'click', (e)->
		pswpElement = document.querySelectorAll('.pswp')[0];
		items = $('.gallery').elem('slider').data('images')
		console.log items
		galleryOptions = 
			history : false
			focus   : false
			shareEl : false
			index   : $(this).data('index')
		gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, galleryOptions);
		gallery.init();
		e.preventDefault()
$(document).ready ->

	$('.news-item').elem('small-image').on 'click', (e)->
		pswpElement = document.querySelectorAll('.pswp')[0];
		items = $('.news-item').elem('gallery').data('images')
		galleryOptions = 
			history : false
			focus   : false
			shareEl : false
			index   : $(this).data('index')
		gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, galleryOptions);
		gallery.init();
		e.preventDefault()

	$('.application').elem('tabs-item').click (e)->
		id = $(this).attr('href')
		$('.application').elem('tabs-item').mod('active', false)
		$(this).mod('active', true)
		$(this).find('input').iCheck('toggle')
		$('.application').elem("tabs-content").each ->
			if "#" + $(this).attr('id') == id
				$(this).mod('disable', false)
				$(this).find('input, select').attr('required','required')
			else
				$(this).mod('disable', true)
				$(this).find('input, select').removeAttr 'required'
			size()
		e.preventDefault()
	
	$('input[type=radio], input[type=checkbox]').iCheck();

	$('.directions-list__trigger').click (e)->
		c           = $(this).block().attr 'class'
		item        = $(this).closest(".#{c}__item")
		if item.length == 0
			item = $(this).closest(".#{c}__section")
		block       = item.find(".#{c}__content").first()
		blockHeight = block.outerHeight()
		items       = $(this).parents('*[class*="item"]')

		if !item.hasMod('open')
			
			block.velocity
				properties: "transition.slideDownIn"
				options:
					duration: 300
					delay: 200
					complete: ()->
						size()
					begin: ()->
						item.mod('open', true)
						$.each items, (key, el)->
							$(el).css
								'minHeight': blockHeight + $(el).height()
					
		else
			$.each items, (key, el)->
				$(el).css
					'minHeight': 0

			block.velocity
				properties: "transition.slideUpOut"
				options:
					duration: 200
					complete: ()->
						item.mod('open', false)
						size()
						
		e.preventDefault()


	$('.gallery__slider').slick
		onInit: ()->
			init_popup()
		onAfterChange: ()->
			init_popup()
		slidesToShow: 6
		infinite: false
		customPaging: 10
		responsive: [{
			breakpoint: 396,
			settings:{
					slidesToShow: 1
				}
			},{
			breakpoint: 480,
			settings:{
					slidesToShow: 2
				}
			},{
			breakpoint: 768,
			settings:{
					slidesToShow: 3
				}
			},{
			breakpoint: 992,
			settings:{
					slidesToShow: 4
				}
			},
			{
				breakpoint: 1600,
				settings:{
					slidesToShow: 5
			}
		}]

	$('.slide').elem('trigger').click (e)->

		if !$(this).block().hasMod 'open'
			$(this).block().mod 'open', true
			$(this).block('content').velocity
				properties: "transition.slideDownIn"
				options:
					duration: 300
		else
			$(this).block().mod 'open', false
			$(this).block('content').velocity
				properties: "transition.slideUpOut"
				options:
					duration: 300

		e.preventDefault()

	init_popup()

	$('.geography__list_gallery').click (e)->
		$.prettyPhoto.open $(this).data('images')

		e.preventDefault()

	$('.search-trigger').click (e)->
		if $('.toolbar .container').width() <= 750
			$('#Search').modal()
		else
			if $('.toolbar .search-form').is ':hidden'
				$('.toolbar .search-form').velocity
					properties: "transition.slideDownIn"
					options:
						duration: 300
						complete: ()->
							$('.toolbar .search-form  .search-form__button').css 'opacity', 1
							$('.toolbar').one 'mouseleave', ()->
								$('.toolbar .search-form  .search-form__button').css 'opacity', 0
								$('.toolbar .search-form').velocity
									properties: "transition.slideUpOut"
									options:
										duration: 300
						
		e.preventDefault()

	###
	addTrigger()

	$('a[onclick*=grain_TableAddRow]').click ()->
		addTrigger()
	###
	
	$('a.captcha_refresh').click (e)->
		getCaptcha()
		e.preventDefault()

	$('.form input[type=submit]').click (e)->
		if !$('.form input[type=file]').val() && $('.form input[type=file]').length > 0
			$('.form .file-trigger').addClass 'error'

	$('.file-trigger').click (e)->
		$(this).parent().find('input[type=file]').trigger 'click'
		e.preventDefault()

	$('input[type=file]').on 'change', ()->
		$('.form .file-trigger').removeClass 'error'
		$('.file-name').text($(this).val().replace(/.+[\\\/]/, ""))



	$('.form').submit (e)->
		data = new FormData(this)
		
		$.ajax 
			type        : 'POST'
			url         : '/include/send.php'
			data        : data
			cache       : false
			contentType : false
			processData : false
			mimeType    : 'multipart/form-data'
			success     : (data) ->
	        	data = $.parseJSON(data)
	        	if data.status == "ok"
	        		$('.form').hide()
	        		$('.form').parents('.modal').find('.success').show()
	        	else if data.status == "error"
	        		$('input[name=captcha_word]').addClass('parsley-error')
	        		getCaptcha()

		e.preventDefault()

	$('.application').submit (e)->
		data = new FormData(this)
		$.ajax 
			type        : 'POST'
			url         : '/include/send_form.php'
			data        : data
			cache       : false
			contentType : false
			processData : false
			mimeType    : 'multipart/form-data'
			success     : (data) ->
				console.log data
				data = $.parseJSON(data)
				if data.status == "ok"
					$('.page__content .application').hide()
					$('.page__content .success').removeClass('hidden')
					size()
				else if data.status == "error"
					$('input[name=captcha_word]').addClass('parsley-error')
					getCaptcha()

		e.preventDefault()

	$('.application__chosen').chosen
			width: "100%"
		.change ()->
			drop = $(this).parent().find('.chosen-drop')
			drop.velocity
					properties: "transition.slideUpOut"
					options:
						duration: 300
		.on "chosen:showing_dropdown", ()->
			drop = $(this).parent().find('.chosen-drop')
			drop.velocity
					properties: "transition.slideDownIn"
					options:
						duration: 300
		.on "chosen:hiding_dropdown", ()->
			drop = $(this).parent().find('.chosen-drop')
			drop.velocity
					properties: "transition.slideUpOut"
					options:
						duration: 300
	$('.modal').on 'show.bs.modal', (a,b)->
		url = $(a.relatedTarget).data 'url'
		id  = $(a.relatedTarget).attr 'href'
		if url && id
			$.openModal(url, id)
		else
			setHash($(this).attr('id'))
	
	$('#checkType').on 'show.bs.modal', (a,b)->
		$(this).data 'id', $(a.relatedTarget).data 'id'

	$('#checkType .types__item').click (e)->
		window.location.href = $(this).attr('href') + '?id=' + $('#checkType').data('id')
		e.preventDefault()

	$('.modal').on 'hide.bs.modal', (a,b)->
		
		$(this).find('input[type="email"], input[type="text"], textarea').removeClass('parsley-error').removeAttr("value").val("")
		$(this).find('form').trigger('reset').show()
		$(this).find('.success').hide()

		if urlInitial
			History.pushState {'url':urlInitial.url}, urlInitial.title, urlInitial.url
			window.title = urlInitial.title
		if $(this).find('iframe').length > 0
			$(this).find('iframe').remove()

	$('.lang-trigger__carriage').click (e)->
		window.location.href = 'http://uic-spektr.ru'
		el = $(this).parents('.lang-trigger')
		variants = el.data('variant').split(',')
		$.each variants, (index, value)->
			value = value.toString()
			if el.mod('lang') != value
				el.mod('lang', value)
				return false
		e.preventDefault()

	$('.form-trigger').click (e)->
		form = $(this).parents('.modal').find('form')
		if form.is ':visible'
			form.velocity
				properties: "transition.slideUpOut"
				options:
					duration: 300
		else
			form.velocity
				properties: "transition.slideDownIn"
				options:
					duration: 300
	

	$('.dropdown').elem('item').click (e)->
		if $(this).attr('href')[0] == "#"
			$('.dropdown').elem('text').html($(this).text())
			$('.dropdown').elem('frame').velocity
					properties: "transition.slideUpOut"
					options:
						duration: 300
			e.preventDefault()
		else
			window.location.href = $(this).attr('href')


	closeDropdown = (x)->
		x.mod('open', false)
		x.elem('frame').velocity
			properties: "transition.slideUpOut"
			options:
				duration: 300

	openDropdown = (x)->
		clearTimeout timer
		text = x.elem('text').text()
		x.elem('item').show()
		x.elem('frame').find("a:contains(#{text})").hide()
		x.elem('frame').velocity
			properties: "transition.slideDownIn"
			options:
				duration: 300
				complete: ()->
					x.mod('open', true)
					timer = delay 3000, ()->
						$('.dropdown').elem('frame')
							.velocity
								properties: "transition.slideUpOut"
								options:
									duration: 300

	timer = false

	$('.modal .text, .geography__popup_content').spin spin_options

	###
	initType = ()->
		$('.dropdown.type').elem('item').click (e)->
			elm = $(this).attr 'href'
			alt = $(this).parents('.dropdown').elem('frame').find("a:not([href=#{elm}])").attr('href')
			if !$(elm).is ':visible'
				$(elm).velocity
					properties: "transition.slideDownIn"
					options:
						duration: 300
						complete: ()->
							google.maps.event.trigger(map, "resize");
				$(alt).velocity
					properties: "transition.slideUpOut"
					options:
						duration: 300
	###
	$('.dropdown').elem('select').on 'change', ()->
		val = $(this).val()
		$(this).block().find("a[href='#{val}']").trigger 'click'
		$(this).mod('open', true)
	
	$('.dropdown').hoverIntent
			over : ()->
				if !$.browser.mobile
					openDropdown $(this)
				else
					$(this).find('select').focus()
					$(this).mod 'open', true
			out : ()->
				if !$.browser.mobile
					closeDropdown $(this)

	$('.dropdown').elem('trigger').click (e)->
		if $.browser.mobile
			$(this).parent().find('select').focus()
			$(this).block().mod 'open', true
		e.preventDefault()

	$('.toolbar a.phone').click (e)->
		if $(window).width() <= 768
			$('#Contacts').modal()
			e.preventDefault()

	$('.site-select .site-select__trigger').click ()->
		p = $(this).parents('.site-select')
		if !p.mod('open')
			$('#Sites').modal()

	$('.site-select .site-select__trigger').hoverIntent
		over : ()->
			if($(window).width()>768)
				clearTimeout timer
				p = $(this).parents('.site-select')
				p.mod('open', true)
				p.elem('dropdown').velocity
					properties: "transition.slideDownIn"
					options:
						duration: 300
						complete: ()->
							timer = delay 3000, ()->
								$('.site-select')
									.mod('open', false)
									.elem('dropdown').velocity
										properties: "transition.slideUpOut"
										options:
											duration: 300
		out : ()->
			return

	$('.site-select').hoverIntent
		over : ()->
			return
		out : ()->
			p = $(this)
			p.mod('open', false)
			p.elem('dropdown').velocity
				properties: "transition.slideUpOut"
				options:
					duration: 300
	$('a.site-select__trigger').click (e)->
		if($(window).width()<768)
			$('#Sites').modal()
		e.preventDefault()

	delay 300, ()->
		size()

	
	x = undefined
	$(window).resize ->
		clearTimeout(x)
		x = delay 200, ()->
			size()


	mapInit = false
	if !mapInit && $('.contacts #map').length > 0
		mapInit = true
		ymaps.ready ()->
			myMap = new ymaps.Map 'map', {
				center: $('#map').data('coords').split(',')
				zoom: 15
			}
			myMap.behaviors.disable('scrollZoom')
			myPlacemark = new ymaps.Placemark myMap.getCenter(), {
				hintContent: 'Аргус СварСервис'
			},
			{
				preset: "twirl#nightDotIcon",
			}

			myMap.geoObjects.add(myPlacemark);