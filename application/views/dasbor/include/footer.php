        </div>
        </div>
        <footer class="sticky-footer bg-white">
        	<div class="container my-auto">
        		<div class="copyright text-center my-auto">
        			&copy; <strong><span><?= var_judul(); ?></span></strong> <?= date('Y'); ?>. All Rights Reserved.
        		</div>
        	</div>
        </footer>
        </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
        	<i class="fas fa-angle-up"></i>
        </a>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        	<div class="modal-dialog" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
        				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">×</span>
        				</button>
        			</div>
        			<div class="modal-body">Klik "Logout" di bawah jika Anda sudah siap untuk mengakhiri sesi ini.</div>
        			<div class="modal-footer">
        				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        				<a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
        			</div>
        		</div>
        	</div>
        </div>
        <script src="<?= base_url('assets/dasbor/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?= base_url('assets/dasbor/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
        <script src="<?= base_url('assets/dasbor/js/sb-admin-2.min.js'); ?>"></script>
        </body>

        </html>