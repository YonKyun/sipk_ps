public function bagan_pertandingan()
{
global $header;
if ($header['manager'] and $header['panitia_belum']) {
redirect('dasbor');
}
$header['judul'] = 'Bagan Pertandingan';
$user = $this->UserModel->get_user_session();
$header['user'] = $user;
$body['kejuaraan'] = $this->DataModel->get_kejuaraan_active();
$this->load->view('dasbor/include/header', $header);
$this->load->view('dasbor/bagan_pertandingan', $body);
$this->load->view('dasbor/include/footer');
}

public function cek_data()
{
global $header;
if (!$header['panitia_sudah']) {
redirect('dasbor');
}

$id_kejuaraan = $this->input->get('id_kejuaraan');
$jenis_kelamin = $this->input->get('jenis_kelamin');
$kelas = $this->input->get('kelas');

$query = $this->db
->select('data')
->from('bagan')
->where(['id_kejuaraan' => $id_kejuaraan, 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas])
->get()
->row_array();

echo (null == $query) ? '' : $query['data'];
}

public function simpan_data()
{
global $header;
if (!$header['panitia_sudah']) {
redirect('dasbor');
}

$id_kejuaraan = $this->input->post('id_kejuaraan');
$jenis_kelamin = $this->input->post('jenis_kelamin');
$kelas = $this->input->post('kelas');
$data = json_encode($this->input->post('data'));

$query = $this->db
->select('id_bagan')
->from('bagan')
->where(['id_kejuaraan' => $id_kejuaraan, 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas])
->get()
->result_array();

if (null == $query) {
$this->db->insert('bagan', ['id_kejuaraan' => $id_kejuaraan, 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'data' => $data]);
} else {
$this->db->update('bagan', ['data' => $data], ['id_kejuaraan' => $id_kejuaraan, 'jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas]);
}
}

public function bagan_generate()
{
global $header;
if (!$header['panitia_sudah']) {
redirect('dasbor');
}

$id_kejuaraan = $this->input->get('id_kejuaraan');
$jenis_kelamin = $this->input->get('jenis_kelamin');
$kelas = $this->input->get('kelas');

$query = $this->db
->select('user.nama_user, pendaftaran.id_user, pendaftaran.skor')
->from('pendaftaran')
->join('user', 'pendaftaran.id_user = user.id_user')
->where(['pendaftaran.id_kejuaraan' => $id_kejuaraan, 'pendaftaran.jenis_kelamin' => $jenis_kelamin, 'kelas' => $kelas, 'pendaftaran.active' => 1])
->get()
->result_array();

shuffle($query);

$jumlah_peserta = count($query);
$jumlah_tim = ceil($jumlah_peserta / 2);
$jumlah_baris = 2 ** (ceil(log($jumlah_tim, 2)));

$id_user = '';
foreach ($query as $key => $value) {
$id_user .= $value['id_user'];
if ($key % 2 === 0) {
$id_user .= ',';
} else {
$id_user .= '|';
}
}

$id_user = rtrim($id_user, '|');

if ($jumlah_tim > 2) {
$id_user .= str_repeat('|,', $jumlah_baris - $jumlah_tim);
$jumlah_tim = $jumlah_baris;
}

$userIds = explode('|', $id_user);

$array = [
$jumlah_baris,
array_map(function ($item) {
return explode(',', $item);
}, $userIds)
];

$json_id = json_encode($array);

$jumlah_peserta = count($query);
$jumlah_tim = ceil($jumlah_peserta / 2);
$jumlah_baris = 2 ** (ceil(log($jumlah_tim, 2)));

$nama_user = '';
foreach ($query as $key => $value) {
$nama_user .= $value['nama_user'];
if ($key % 2 === 0) {
$nama_user .= ',';
} else {
$nama_user .= '|';
}
}

$nama_user = rtrim($nama_user, '|');

if ($jumlah_tim > 2) {
$nama_user .= str_repeat('|,', $jumlah_baris - $jumlah_tim);
$jumlah_tim = $jumlah_baris;
}

$teams = explode('|', $nama_user);

$array = [
$jumlah_baris,
array_map(function ($item) {
return explode(',', $item);
}, $teams)
];

$json_teams = json_encode($array);

$jumlah_peserta = count($query);
$jumlah_tim = ceil($jumlah_peserta / 2);
$jumlah_baris = 2 ** (ceil(log($jumlah_tim, 2)));

$skor = '';
foreach ($query as $key => $value) {
$skor .= $value['skor'];
if ($key % 2 === 0) {
$skor .= ',';
} else {
$skor .= '|';
}
}

$skor = rtrim($skor, '|');

if ($jumlah_tim > 2) {
$skor .= str_repeat('|,', $jumlah_baris - $jumlah_tim);
$jumlah_tim = $jumlah_baris;
}

$results = explode('|', $skor);

$array = [
array_map(function ($item) {
return explode(',', $item);
}, $results)
];

$json_results = json_encode($array);

echo '[' . $json_id . ',' . $json_teams . ',' . $json_results . ']';
// echo $json_id;
}