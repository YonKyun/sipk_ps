CREATE TABLE IF NOT EXISTS `bagan` (
	`id_bagan` int NOT NULL AUTO_INCREMENT,
	`id_pendaftaran` int DEFAULT NULL,
	`id_user` int DEFAULT NULL,
	`id_kejuaraan` int DEFAULT NULL,
	`babak` int NOT NULL,
	`nama` varchar(128) NOT NULL,
	`jenis_kelamin` enum("Laki-laki", "Perempuan") NOT NULL,
	`kelas` varchar(8) NOT NULL,
	`skor` bigint DEFAULT 0,
	PRIMARY KEY (`id_bagan`)
) DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `catatan` (
	`id_catatan` int NOT NULL AUTO_INCREMENT,
	`id_riwayat` int NOT NULL,
	`babak` int NOT NULL,
	`nama` varchar(128) NOT NULL,
	`skor` bigint DEFAULT 0,
	`active` tinyint NOT NULL DEFAULT 1,
	PRIMARY KEY (`id_catatan`)
) DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `riwayat` (
	`id_riwayat` int NOT NULL AUTO_INCREMENT,
	`id_user` int NOT NULL,
	`judul` varchar(128) DEFAULT NULL,
	`nama_kejuaraan` varchar(255) NOT NULL,
	`jenis_kelamin` enum("Laki-laki", "Perempuan") NOT NULL,
	`kelas` varchar(8) NOT NULL,
	`waktu_awal` varchar(12) NOT NULL,
	`waktu_akhir` varchar(12) NOT NULL,
	`active` tinyint NOT NULL DEFAULT 1,
	PRIMARY KEY (`id_riwayat`)
) DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `kejuaraan` (
	`id_kejuaraan` int NOT NULL AUTO_INCREMENT,
	`nama_kejuaraan` varchar(255) NOT NULL,
	`seni1_putra1` int DEFAULT NULL,
	`seni1_putra2` int DEFAULT NULL,
	`seni1_putra3` int DEFAULT NULL,
	`seni1_putri1` int DEFAULT NULL,
	`seni1_putri2` int DEFAULT NULL,
	`seni1_putri3` int DEFAULT NULL,
	`seni2_putra1` int DEFAULT NULL,
	`seni2_putra2` int DEFAULT NULL,
	`seni2_putra3` int DEFAULT NULL,
	`seni2_putri1` int DEFAULT NULL,
	`seni2_putri2` int DEFAULT NULL,
	`seni2_putri3` int DEFAULT NULL,
	`seni3_putra1` int DEFAULT NULL,
	`seni3_putra2` int DEFAULT NULL,
	`seni3_putra3` int DEFAULT NULL,
	`seni3_putri1` int DEFAULT NULL,
	`seni3_putri2` int DEFAULT NULL,
	`seni3_putri3` int DEFAULT NULL,
	`tanding_putra1` int DEFAULT NULL,
	`tanding_putra2` int DEFAULT NULL,
	`tanding_putra3` int DEFAULT NULL,
	`tanding_putri1` int DEFAULT NULL,
	`tanding_putri2` int DEFAULT NULL,
	`tanding_putri3` int DEFAULT NULL,
	`waktu_awal` bigint NOT NULL,
	`waktu_akhir` bigint NOT NULL,
	`warna` varchar(12) DEFAULT NULL,
	`active` tinyint NOT NULL DEFAULT 1,
	PRIMARY KEY (`id_kejuaraan`)
) DEFAULT CHARSET = latin1;

INSERT INTO
	`kejuaraan` (
		`nama_kejuaraan`,
		`waktu_awal`,
		`waktu_akhir`,
		`warna`
	)
VALUES
	(
		"Kejuaraan Pertama",
		1609434000,
		1612112340,
		"#FF5733"
	),
	(
		"Kejuaraan Kedua",
		1643734800,
		1646067540,
		"#5D8AA8"
	),
	(
		"Kejuaraan Ketiga",
		1677776400,
		1680281940,
		"#C70039"
	),
	(
		"Kejuaraan Keempat",
		1712163600,
		1714496340,
		"#85C1A1"
	),
	(
		"Kejuaraan Kelima",
		1746378000,
		1748710740,
		"#F4D35E"
	);

CREATE TABLE IF NOT EXISTS `pendaftaran` (
	`id_pendaftaran` int NOT NULL AUTO_INCREMENT,
	`id_user` int NOT NULL,
	`id_kejuaraan` int NOT NULL,
	`nama` varchar(128) NOT NULL,
	`jenis_kelamin` enum("Laki-laki", "Perempuan") NOT NULL,
	`berat_badan` int NOT NULL,
	`kategori` enum("Seni", "Tanding") NOT NULL,
	`kelas` varchar(8) NOT NULL,
	`skor_seni` bigint DEFAULT 0,
	`waktu` bigint NOT NULL,
	`approve` tinyint NOT NULL DEFAULT 0,
	`active` tinyint NOT NULL DEFAULT 1,
	PRIMARY KEY (`id_pendaftaran`)
) DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `user` (
	`id_user` int NOT NULL AUTO_INCREMENT,
	`id_kejuaraan` int DEFAULT NULL,
	`username` varchar(64) NOT NULL,
	`password` varchar(255) NOT NULL,
	`nama_user` varchar(128) NOT NULL,
	`jenis_kelamin` enum("Laki-laki", "Perempuan") DEFAULT NULL,
	`berat_badan` int DEFAULT NULL,
	`role` tinyint NOT NULL DEFAULT 5,
	`approve` tinyint DEFAULT NULL,
	`active` tinyint NOT NULL DEFAULT 1,
	PRIMARY KEY (`id_user`)
) DEFAULT CHARSET = latin1;

INSERT INTO
	`user` (
		`id_kejuaraan`,
		`username`,
		`password`,
		`nama_user`,
		`jenis_kelamin`,
		`berat_badan`,
		`role`,
		`approve`
	)
VALUES
	(
		NULL,
		"admin",
		"$2y$10$eUqGJp.0U7IIpbGJuTBy1.p7zrHLVLbbGsz1ClJU7zH3N69mCdWzG",
		"Admin",
		NULL,
		NULL,
		1,
		NULL
	),
	(
		1,
		"manager",
		"$2y$10$BQ1cf2nmXHZoTCmbIP5WaexOq72rHMIc/C6GdRLoh0MysteVtAvVK",
		"Manager",
		NULL,
		NULL,
		2,
		NULL
	),
	(
		1,
		"panitia1",
		"$2y$10$XyRXSDslykuXOvz5Ntmy1eu6NqCGdRwTrAgwBr8.b5c./DQBc11l6",
		"Panitia 1",
		NULL,
		NULL,
		3,
		1
	),
	(
		2,
		"panitia2",
		"$2y$10$75C5rmfkiEtr8uoPYp8i0.1mVrPyJrfLpfraHLsg7mWOCVNaARN9m",
		"Panitia 2",
		NULL,
		NULL,
		3,
		1
	),
	(
		3,
		"panitia3",
		"$2y$10$me/mCEeN/41shZtcMyLqpekEcY3k7RVvkvajp8eAV8pkPLGFELka6",
		"Panitia 3",
		NULL,
		NULL,
		3,
		1
	),
	(
		4,
		"panitia4",
		"$2y$10$/1sDE6/zq4276ZKvg9sWx.yvfYtX2E36AkCS0gpdI0tTN2087IOh.",
		"Panitia 4",
		NULL,
		NULL,
		3,
		NULL
	),
	(
		5,
		"panitia5",
		"$2y$10$gpNTrj6LOGm3O9w0hxdZV.iAN5E7j9k.8vSyOECSIM7iv4eb2j9PO",
		"Panitia 5",
		NULL,
		NULL,
		3,
		NULL
	),
	(
		NULL,
		"juri",
		"$2y$10$vSfAszqvy2S0mCypAjHvL.340kIrXhQ/Zprzs6OtL/pCpdphsm5JK",
		"Juri",
		NULL,
		NULL,
		4,
		NULL
	),
	(
		NULL,
		"peserta1",
		"$2y$10$3./59O74K2EQsL7falOMKe35XMJqJde9xgEjwTCiUzBOBIrv2ZKqu",
		"Peserta 1",
		"Laki-laki",
		63,
		5,
		NULL
	),
	(
		NULL,
		"peserta2",
		"$2y$10$77MYY6KaGWlnwQhBxJj3cuLKScQtKDJkog2ldf9HqaOmax/tPOZ8O",
		"Peserta 2",
		NULL,
		NULL,
		5,
		NULL
	);