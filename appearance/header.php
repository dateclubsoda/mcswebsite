<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="user-scalable=yes, width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">
<div id="branding">
<div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
<?php
if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; }
echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" itemprop="url"><span itemprop="name">' . esc_html( get_bloginfo( 'name' ) ) . '</span></a>';
if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; }
?>
</div>
<div id="site-description"<?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>><?php bloginfo( 'description' ); ?>
</div>
</div>
<nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
<?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
<?php wp_nav_menu( array( 'theme_location' => 'mobile-menu-popup', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
<script>
	window.setappbutton = function() {
		var url = "https://testflight.apple.com/join/h0Hx49FS";
		var getTheAppBtn = document.getElementById("menu-item-125");
		var getTheAppBtn2 = document.getElementById("menu-item-328");
		getTheAppBtn.firstChild.href = getTheAppBtn2.firstChild.href = url;
	}
	var hamburger = document.getElementById("menu-item-475");
	var mobileMenuPopup = document.getElementsByClassName("menu-mobile-menu-popup-container")[0];
	mobileMenuPopup.classList.add("hidePopup");
	function showPopup() {
		mobileMenuPopup.classList.toggle("hidePopup");
		document.documentElement.classList.toggle("disableScroll");
		hamburger.classList.toggle("close");
	}
	hamburger.onclick = mobileMenuPopup.onclick = function() {
		showPopup();
	}
	// check if user is in US and on iPhone
	// first check local storage
	var clubsoda = localStorage.getItem("clubsoda");
	if (clubsoda && clubsoda === "success") {
		window.setappbutton();
	} else if (!clubsoda) {
		var userAgent = navigator.userAgent || navigator.vendor || window.opera;
		if (/iPhone/.test(userAgent) && !window.MSStream) {
			fetch("https://api.ipify.org/?format=json")
			.then(res => res.json())
			.then(response => {
				fetch("https://ipinfo.io/products/ip-geolocation-api", {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded",
					},
					body: new URLSearchParams({
						"input": `${response.ip}`,
					})
				})
				.then(res => res.json())
				.then(response => {
					if (response.country === "US") {
						window.setappbutton();
						localStorage.setItem("clubsoda", "success");
					} else {
						localStorage.setItem("clubsoda", "failure");
					}
				})
				.catch((data, status) => {
					console.warn("Request failed");
					localStorage.setItem("clubsoda", "failure");
				});
			})
			.catch((data, status) => {
				console.warn("Request failed");
				localStorage.setItem("clubsoda", "failure");
			});
		} else {
			localStorage.setItem("clubsoda", "failure");
		}
	}
</script>
</nav>
</header>
<div id="container" class="main-content-container">