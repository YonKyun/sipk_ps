<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2 class="my-auto"><?= $judul; ?></h2>
				<ol>
					<li><a href="<?= base_url(); ?>">Beranda</a></li>
					<li><?= $judul; ?></li>
				</ol>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container" data-aos="fade-up">
			<div class="row">
				<div class="col-12 entries">
					<article class="entry entry-single">
						<div class="entry-content">
							<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
								<?php foreach ($kejuaraan as $row) { ?>
									<div class="col">
										<div class="card">
											<div style="max-height: 140px; overflow-y: hidden;">
												<img src="<?= base_url('assets/uploads/images/kejuaraan/' . $row['id_kejuaraan'] . '.png'); ?>" class="card-img-top" alt="...">
											</div>
											<div class="card-body">
												<h5 class="card-title mb-0"><a href="<?= base_url('kejuaraan/kejuaraan_detail/' . $row['id_kejuaraan']); ?>"><?= $row['nama_kejuaraan']; ?></a></h5>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</section>
</main>