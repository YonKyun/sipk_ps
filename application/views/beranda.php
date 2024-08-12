<section id="hero" style="margin-top: 5.5%;">
	<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active" style="background-image: url('<?= base_url('assets/img/slide/slide1.jpeg'); ?>');">
			</div>
			<div class="carousel-item" style="background-image: url('<?= base_url('assets/img/slide/slide2.jpeg'); ?>');">
			</div>
			<div class="carousel-item" style="background-image: url('<?= base_url('assets/img/slide/slide3.jpeg'); ?>');">
			</div>
			<div class="carousel-item" style="background-image: url('<?= base_url('assets/img/slide/slide4.jpeg'); ?>');">
			</div>
		</div>
		<a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
			<span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
		</a>
		<a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
			<span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
		</a>
		<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
	</div>
</section>
<main id="main">
	<section id="about-us" class="about-us">
		<div class="container" data-aos="fade-up">
			<div class="row content g-5" style="text-align: justify;">
				<div class="col-lg-6" data-aos="fade-right">
					<h4>Selamat datang di<br /><?= var_judul(); ?></h4>
					<span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, error, reprehenderit velit ipsum explicabo architecto, corporis accusamus culpa veritatis eaque atque neque sunt rerum laborum soluta perspiciatis rem quis. Esse veniam expedita corporis, repellendus dolor quas optio rerum veritatis reprehenderit iusto illum voluptas aliquid blanditiis, reiciendis quod. Quibusdam excepturi hic esse sequi velit vero, officiis nesciunt fugiat veritatis nostrum. Ad autem suscipit veniam, ea debitis dolor at saepe quas voluptate quaerat soluta nam hic! Quidem quo voluptatem quasi autem, nemo sint debitis beatae maiores illo maxime corrupti totam tenetur sapiente?</span>
				</div>
				<div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum dolores, eligendi numquam sit voluptatem voluptas dolorem recusandae! Illum quam at quae ad alias necessitatibus laborum.</p>
					<ul>
						<li><i class="ri-check-double-line"></i> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consectetur, dolores.</li>
						<li><i class="ri-check-double-line"></i> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque, cum?</li>
						<li><i class="ri-check-double-line"></i> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste, nam.</li>
					</ul>
					<p class="fst-italic">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat eveniet eius et ducimus quae fuga asperiores, vel doloremque quisquam neque.</p>
				</div>
			</div>
		</div>
	</section>
</main>