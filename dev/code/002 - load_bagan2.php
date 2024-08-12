public function load_bagan()
{
global $header;
if ($header['manager'] and $header['panitia_belum']) {
redirect('dasbor');
}

$id_kejuaraan = ($header['admin']) ? $this->input->get('id_kejuaraan') : $header['saya']['id_kejuaraan'];
$jenis_kelamin = $this->input->get('jenis_kelamin');
$kelas = $this->input->get('kelas');

$queryBabak1 = $this->db
->select('bagan.*, user.nama_user')
->from('bagan')
->join('user', 'bagan.id_user = user.id_user')
->where(['bagan.id_kejuaraan' => $id_kejuaraan, 'bagan.jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => 1])
->get()
->result_array();

$queryBabak2 = $this->db
->select('bagan.*, user.nama_user')
->from('bagan')
->join('user', 'bagan.id_user = user.id_user')
->where(['bagan.id_kejuaraan' => $id_kejuaraan, 'bagan.jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => 2])
->get()
->result_array();

$jumlah_peserta1 = count($queryBabak1);
$jumlah_peserta1_dibutuhkan = (1 == $jumlah_peserta1) ? 2 : pow(2, ceil(log($jumlah_peserta1, 2)));
for ($i = $jumlah_peserta1; $i < $jumlah_peserta1_dibutuhkan; $i++) { $queryBabak1[]=['nama_user'=> null, 'id_user' => null, 'skor' => null];
	}

	$jumlah_peserta2 = count($queryBabak2);
	$jumlah_peserta2_dibutuhkan = (1 == $jumlah_peserta2) ? 2 : pow(2, ceil(log($jumlah_peserta2, 2)));
	for ($i = $jumlah_peserta2; $i < $jumlah_peserta2_dibutuhkan; $i++) { $queryBabak2[]=['nama_user'=> null, 'id_user' => null, 'skor' => null];
		}

		$baganData = [
		'teams' => [],
		'results' => [],
		];

		$teamsBabak1 = array_chunk($queryBabak1, 2);

		foreach ($teamsBabak1 as $team) {
		$baganData['teams'][] = [
		$team[0]['nama_user'],
		$team[1]['nama_user']
		];

		$baganData['results'][] = [
		[
		!is_null($team[0]['skor']) ? (int)$team[0]['skor'] : null,
		!is_null($team[1]['skor']) ? (int)$team[1]['skor'] : null
		]
		];
		}

		if (!empty($queryBabak2)) {
		$teamsBabak2 = array_chunk($queryBabak2, 2);

		foreach ($teamsBabak2 as $team) {
		$baganData['teams'][] = [
		$team[0]['nama_user'],
		$team[1]['nama_user']
		];

		$baganData['results'][] = [
		[
		!is_null($team[0]['skor']) ? (int)$team[0]['skor'] : null,
		!is_null($team[1]['skor']) ? (int)$team[1]['skor'] : null
		]
		];
		}
		}

		header('Content-Type: application/json');
		echo json_encode($baganData);
		}