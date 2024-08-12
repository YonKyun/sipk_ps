public function load_bagan()
{
global $header;
if ($header['manager'] and $header['panitia_belum']) {
redirect('dasbor');
}

$id_kejuaraan = ($header['admin']) ? $this->input->get('id_kejuaraan') : $header['saya']['id_kejuaraan'];
$jenis_kelamin = $this->input->get('jenis_kelamin');
$kelas = $this->input->get('kelas');

$query = $this->db
->select('bagan.*, user.nama_user')
->from('bagan')
->join('user', 'bagan.id_user = user.id_user')
->where(['bagan.id_kejuaraan' => $id_kejuaraan, 'bagan.jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'babak' => 1])
->get()
->result_array();

$jumlah_peserta = count($query);
$jumlah_peserta_dibutuhkan = (1 == $jumlah_peserta) ? 2 : pow(2, ceil(log($jumlah_peserta, 2)));
for ($i = $jumlah_peserta; $i < $jumlah_peserta_dibutuhkan; $i++) { $query[]=['nama_user'=> null, 'id_user' => null, 'skor' => null];
	}

	$baganData = [
	'teams' => [],
	'results' => [],
	];

	$teams = array_chunk($query, 2);

	foreach ($teams as $team) {
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

	header('Content-Type: application/json');
	echo json_encode($baganData);
	}